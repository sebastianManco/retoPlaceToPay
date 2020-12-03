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
        $category = Category::all();
        return view('categories.index', ['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('categories.create', ['category' => new Category()]);
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
        $category->flushCache();

        return redirect('/categories')->with('message', 'Guardado con éxito') ;


    }



}
