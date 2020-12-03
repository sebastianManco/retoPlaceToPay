<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Product;
use App\User;
use App\Order;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Classes\PlaceTopay;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**
     * @param Order $order
     * @param Request $request
     * @throws \Exception
     */
    public function index(Order $order, Request $request)
    {
        $ordersProducts = Product::where('id', $request->input(['name']))->first();
        $user = User::find(auth()->id());
        $order->total = $request->input('total');
        $order->reference = $user->id . Str::random(10);
        $order->user_id = $user->id;
        $order->save();
        $user->orders()->save($order);

        $order->products()->attach($ordersProducts);

        $response = $this->placeToPay('create', $order);

        $requestId = $response->requestId;
        $processUrl = $response->processUrl;

        Payment::Create([
            'order_id' => $order->id,
            'requestId' => $requestId,
            'processUrl' => $processUrl,
            'status' => 'iniciado',
        ]);
        redirect()->away($processUrl)->send();
    }

    /**
     * @param string $reference
     * @param Order $order
     * @return Application|Factory|View
     */
    public function getRequestInformation( string $reference)
    {
        $order = Order::where('reference', $reference)->get()->first();

        $response = $this->updatePayment($order);

        return view('Payment.ResponsePlaceToPay', ['response' => $response]);
    }

    /**
     * @param Order $order
     */
    public function retryPayment(Order $order)
    {
        //$order = Order::find($id);

        $response = $this->placeToPay('create', $order);
        $requestId = $response->requestId;
        $processUrl = $response->processUrl;

        Payment::where('order_id', $order->id)
            ->get()
            ->first()
            ->update([
                'order_id' => $order->id,
                'requestId' => $requestId,
                'processUrl' => $processUrl,
                'status' => 'iniciadoo',
            ]);
        redirect()->away($processUrl)->send();
    }


    public function authenticationPlaceToPay(){
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);
        $login = config('placeToPay.login');
        $secretKey = config('placeToPay.secretKey');
        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));
        return [
            'login'   => $login,
            'seed'    => $seed,
            'nonce'   => $nonceBase64,
            'tranKey' => $tranKey
        ];
    }

    public function placeToPay($requestType, $order)
    {
        $client = new Client();
        $request = [
            'auth' => $this->authenticationPlaceToPay(),
            'payment' => [
                'reference' => $order->reference,
                'description' => 'prueba pago',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total,
                ]
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => route('response.placeToPay', $order->reference),
            'ipAddress' => request()->getClientIp(),
            'userAgent' => request()->header('User-Agent'),

        ];
        switch ($requestType) {
            case  'create':
                $res = $client->post('https://test.placetopay.com/redirection/api/session/',
                    ['json' => $request]
                );
                return json_decode($res->getBody()->getContents());
                break;
            case 'getRequestInformation':
                $requestId = $order->payment->requestId;
                $request['auth'];
                $res = $client->post(
                    'https://test.placetopay.com/redirection/api/session/' . $requestId,
                    ['json' => $request]
                );
                return json_decode($res->getBody()->getContents());
                break;
            case 'reverse':
                $requestReverse = ['auth' => $this->authenticationPlaceToPay(),
                    'internalReference' => $order->payment->internalReference
                ];

                $res = $client->post('https://test.placetopay.com/redirection/api/session/',
                    ['json' => $requestReverse]
                );
                return json_decode($res->getBody()->getContents());
                break;
            default;

        }
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function updatePayment(Order $order)
    {
        $response = $this->placeToPay('getRequestInformation', $order);
        $updatePayment = Payment::where('order_id', $order->id)->get()->first();
        if($response->status->status != 'PENDING'){
            $updatePayment->internalReference = $response->payment[0]->internalReference;
        }
        $updatePayment->status = $response->status->status;
        $updatePayment->save();

        return $response;
    }
}
