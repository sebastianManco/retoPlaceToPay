<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
    }

    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request):\Illuminate\View\View
    {
       $products = Product::active()->name($request->input('filter.name'))->paginate(4);
        return view('clients.index', compact('products'));

    }
}
