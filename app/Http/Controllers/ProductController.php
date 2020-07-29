<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$buscar = $request->get('buscarpor');
        $tipo = $request->get('tipo');
        $products = Product::buscarpor($tipo, $buscar)->paginate(3);*/
        



   // ->buscarpor($tipo, $buscar)
    //->paginate(3);
   
    //$products = Product::name($request->input('filter.name'))->paginate();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(  ProductCreateRequest $request, Product $products )
    {
    
        
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->stock = $request->input('stock');
        $products->save();
        $images = new Image();
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $images->name = $image;
            $images->product_id = $products->id;
            $images->save();
        }

        return redirect('/products')->with('message', 'Guardado con éxito') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        app()->setLocale('en');
        $product = Product::find($id);
        $image = Image::find($id);
        return view('products.details', compact('product'), compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Cache::remember(
            'categories', now()->addDay(), function() {
                return Category::all();
            }
    );
        return view('products.edit', compact('product'), compact('categories'));
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
        $products = Product::find($id);
        $images = Image::find($id);
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->stock = $request->input('stock');
        $products->active = (!request()->has('active') == '1' ? '0' : '1');
        $products->save();

        if($request->file('image')) {
            $image = $request->file('image')->store('public');
            $images->fill(['name'=>asset($image)]);
            $images->product_id = $products->id;
            $images->save();
        }

        return redirect(route('products.index')) ;
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
