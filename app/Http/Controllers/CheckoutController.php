<?php

namespace App\Http\Controllers;

use App\Paimen;
use App\Product;
use App\User;
use App\Order;
use Darryldecode\Cart\Cart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //369061 requestId
        //369053
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $login = '6dd490faf9cb87a9862245da41170ff2';
        $secretKey = '024h1IlD';

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));
        $cliente = new Client();
        $res = $cliente->post('https://test.placetopay.com/redirection/api/session/369053',
            [
                'json' => [
                    'auth' => [
                        'login' => $login,
                        'seed' => $seed,
                        'nonce' => $nonceBase64,
                        'tranKey' => $tranKey
                    ]
                ]
            ]);
        $response = json_decode($res->getBody()->getContents());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order )
    {
        /*orden del cliente, y la vas a identificar con la referencia del pedido*/
        //$cartProduct = \Cart::session(auth()->id())->getContent();

        $user =  User::find(auth()->id());
        $order->total =  $request->input('total');
        $order->user_id = $user->id;
        $order->save();
        $user->orders()->save($order);

        $reference = $order->id.Str::random(5);


        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);
        $login = '6dd490faf9cb87a9862245da41170ff2';
        $secretKey = '024h1IlD';
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
                        'reference' => $reference,/*Aqui va la orden o numero de referencia,*/

                        'description' => 'prueba pago',
                        'amount' => [
                            'currency' => 'COP',
                            'total' => $order->total,
                        ]
                    ],
                    'expiration' => $expiration,
                    'returnUrl' => route('response.placeToPay', $reference),
                    'ipAddress' => request()->getClientIp(),
                    'userAgent' => request()->header('User-Agent')]
            ]);
        $response = json_decode($res->getBody()->getContents());
        $requestId = $response->requestId;
        $processUrl = $response->processUrl;


        Paimen::Create([
            'order_id' => $order->id,
            'requestId' => $requestId,
            'processUrl' => $processUrl,
            'status' => 'ok',
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


    public function getRequestInformation(Request $request, $reference)
    {
        dd($request);
    }




    /**
     *
     */
    public function notApproved()
    {

    }

    /**
     *
     */
    public function approved()
    {

    }

    /**
     *
     *
     */
    public function rejected()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
