<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::where('user_id', '=', auth()->id())->get();

        return view('Payment.HistoryOrders',  ['orders' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //de este controlador solo estoy utilizando este metodo no se preocupe por lo demas
        //la vista donde muestro la orden fue un copie y pegue del carrito sin los botones
        $cartProducts = \Cart::session(auth()->id())->getContent();

        return view('Orders.index', compact('cartProducts'));
    }

}
