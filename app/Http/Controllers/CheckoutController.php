<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Darryldecode\Cart\Cart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
    public function index()
    {
        // pago por place to play

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
        $cliente = new Client();
        $res = $cliente->post('https://test.placetopay.com/redirection/api/session/',
            [
                'json' => [
                    'auth' => [
                        'login' => $login,
                        'seed' => $seed,
                        'nonce' => $nonceBase64,
                        'tranKey' => $tranKey
                    ],
                    'payment' => [
                        'reference' => 7777,
                        'description' => 'prueba pago',
                        'amount' => [
                            'currency' => 'COP',
                            'total' => '999'
                        ]
                    ],
                    'expiration' => $expiration,
                    'returnUrl' => route('products/indexClient'),
                    'ipAddress' => request()->getClientIp(),
                    'userAgent' => request()->header('User-Agent')]
            ]);
        $response = json_decode($res->getBody()->getContents());
        $requestId = $response->requestId;
        $processUrl = $response->processUrl;

        redirect()->away($processUrl)->send();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
