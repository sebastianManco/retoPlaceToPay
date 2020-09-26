<?php

namespace App\Http\Controllers;

use App\Paimen;
use App\Product;
use App\User;
use App\Order;
use Darryldecode\Cart\Cart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order )
    {
        /*orden del cliente, y la vas a identificar con la referencia del pedido*/
        //$cartProduct = \Cart::session(auth()->id())->getContent();
//aqui estoy creando la orden parce
        $user =  User::find(auth()->id());
        $order->total =  $request->input('total');
        $order->user_id = $user->id;
        $order->save();
        $user->orders()->save($order);

        // mueva esta linea para despues de la 69 y la organiza para guardar referencia
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
                    'returnUrl' => route('response.placeToPay', $order->id),
                    'ipAddress' => request()->getClientIp(),
                    'userAgent' => request()->header('User-Agent')]
            ]);
        $response = json_decode($res->getBody()->getContents());
        $requestId = $response->requestId;
        $processUrl = $response->processUrl;

        //aqui estoy guardando unos datos el paimen esta mal escrito para que no lo coloque asi
        //esto es para el proceso de la compra
        Paimen::Create([
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

//esta es la funcion que recibe la info de place topay
    public function getRequestInformation(Request $request, $reference)
    {
     //pille ahi donde dice id cambielo a como nombro el campo referencia
        $order = Order::where('id', $reference)->get()->first();
        $requestId = Paimen::where('order_id', $order->id)->get()->first()->requestId;


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
        $client = new Client();
        $res = $client->post('https://test.placetopay.com/redirection/api/session/'. $requestId,
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
        dd($response); //con este dd es que estoy recibiendo la respues ta place to pay

        redirect()->away($processUrl)->send();

    }



    /**
     *
     */
    public function approved(Request $request)
    {
        dd($request);
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
