<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\View\View;


class OrderController extends Controller
{

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**

     *  @return View
     */
    public function index():View
    {
        $order = Order::where('user_id', '=', auth()->id())->get();

        return view('Payment.HistoryOrders',  ['orders' => $order]);
    }

    /**
     *  @return View
     */
    public function create(): View
    {
        $cartProducts = \Cart::session(auth()->id())->getContent();

        return view('Orders.index', compact('cartProducts'));
    }

}
