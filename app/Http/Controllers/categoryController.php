<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response\Illuminate\View\View
     */
    public function index():\Illuminate\View\View
    {
         $category = Category::all();
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
