<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryCreateRequest;

class categoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
$placeToPay = new CheckoutController();
        $payments = Payment::with('order')
            ->where('status','PENDING')
            ->get();

        foreach ($payments as $payment) {
            $order = $payment->order;
        }
        $response = $placeToPay->updatePayment( $order);
            $category = Category::all();
            dd($response);

        return view('categories.index', ['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {


        return view('categories.create');
    }

    /**
     * @param CategoryCreateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();
        return redirect('/categories')->with('message', 'Guardado con éxito') ;


    }



}
