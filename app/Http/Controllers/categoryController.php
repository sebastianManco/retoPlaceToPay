<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

class categoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**
     * @return View
     */
    public function index(Request $request): View
    {
        $request->user()->authorizeRoles('admin');
        $category = (new Category)->getCachedCategories();
        return view('categories.index', ['category'=>$category]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('categories.create', ['category' => new Category()]);
    }

    /**
     * @param CategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();
        $category->flushCache();
        return redirect('/categories')->with('message', 'Guardado con éxito') ;
    }



}
