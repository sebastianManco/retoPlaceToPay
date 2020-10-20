<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use App\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order, Request $request)
    {
        $user = User::find(auth()->id());
        $order->total = $request->input('total');
        $order->reference = $user->id . Str::random(10);
        $order->user_id = $user->id;
        $order->save();
        $user->orders()->save($order);

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
        $expiration = date('c', strtotime('+2 days'));
        $client = new Client();
        $res = $client->post('https://test.placetopay.com/redirection/api/session/',
            [
                'json' => [
                    'auth' => [
                        'login' => $login,
                        'seed' => $seed,
                        'nonce' => $nonceBase64,
                        'tranKey' => $tranKey
                    ],
                    'payment' => [
                        'reference' => $order->reference,

                        'description' => 'prueba pago',
                        'amount' => [
                            'currency' => 'COP',
                            'total' => $order->total,
                        ]
                    ],
                    'expiration' => $expiration,
                    'returnUrl' => route('response.placeToPay', $order->reference),
                    'ipAddress' => request()->getClientIp(),
                    'userAgent' => request()->header('User-Agent')]
            ]);
        $response = json_decode($res->getBody()->getContents());
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $reference
     * @return void
     */

    public function getRequestInformation(Request $request, string $reference)
    {
        $order = Order::where('reference', $reference)->get()->first();
        $requestId = Payment::where('order_id', $order->id)->get()->first()->requestId;

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
        $client = new Client();
        $res = $client->post('https://test.placetopay.com/redirection/api/session/' . $requestId,
            [
                'json' => [
                    'auth' => [
                        'login' => $login,
                        'seed' => $seed,
                        'nonce' => $nonceBase64,
                        'tranKey' => $tranKey
                    ],

                ],
            ]);

        $response = json_decode($res->getBody()->getContents());
        //dd($response);

        $updatePayment = Payment::where('order_id', $order->id)->get()->first();
        $updatePayment->status = $response->status->status;
        $updatePayment->save();


        return view('Payment.ResponsePlaceToPay', ['response' => $response]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */

    public function RetryPaiment(int $id)
    {
        $order = Order::find($id);

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
        $expiration = date('c', strtotime('+2 days'));
        $client = new Client();
        $res = $client->post('https://test.placetopay.com/redirection/api/session/',
            [
                'json' => [
                    'auth' => [
                        'login' => $login,
                        'seed' => $seed,
                        'nonce' => $nonceBase64,
                        'tranKey' => $tranKey
                    ],
                    'payment' => [
                        'reference' => $order->reference,

                        'description' => 'prueba pago',
                        'amount' => [
                            'currency' => 'COP',
                            'total' => $order->total,
                        ]
                    ],
                    'expiration' => $expiration,
                    'returnUrl' => route('retry.placeToPay', $order->reference),
                    'ipAddress' => request()->getClientIp(),
                    'userAgent' => request()->header('User-Agent')]
            ]);
        $response = json_decode($res->getBody()->getContents());
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


    public function updateRetry(Request $request, $reference)
    {
        $order = Order::where('reference', $reference)->get()->first();
        $requestId = Payment::where('order_id', $order->id)->get()->first()->requestId;

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
        $client = new Client();
        $res = $client->post('https://test.placetopay.com/redirection/api/session/' . $requestId,
            [
                'json' => [
                    'auth' => [
                        'login' => $login,
                        'seed' => $seed,
                        'nonce' => $nonceBase64,
                        'tranKey' => $tranKey
                    ],

                ],
            ]);

        $response = json_decode($res->getBody()->getContents());

        $updatePayment = Payment::where('order_id', $order->id)->get()->first();
        $updatePayment->status = $response->status->status;
        $updatePayment->save();


        return view('Payment.ResponsePlaceToPay', ['response' => $response]);


    }
}


