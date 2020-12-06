<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
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
     * esta funcion me dirije a la vista del historial de ordenes
     *  @return View
     */
    public function index()
    {
       $payments = Payment::with([ 'order'=>
            function($query) {
                $query->where('user_id', '=', auth()->id());
            }])->get();

        return view('Payment.HistoryOrders',  ['payments' => $payments]);
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
