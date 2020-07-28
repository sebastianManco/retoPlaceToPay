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

        $image = \App\Product::with('images')->where('products.id', '=', 'images.product_id')->get();
        dd($image);
        $buscar = $request->get('buscarpor');
        $tipo = $request->get('tipo');
        $products = DB::table('products')
        ->join('images', 'products.id','=','images.product_id')
        ->select('products.name', 'images.name')
        ->get();
        
       

    //$image = Image::with('product')->whereId(10)->first();
   // ->buscarpor($tipo, $buscar)
    //->paginate(3);
    //$products = Product::buscarpor($tipo, $buscar)->paginate(3);
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
        //Cache::forget('categories');
    $categories = Cache::rememberForever(
        'categories', function() {
            return Category::all();
        }
    );
        return view('products.create', compact('categories'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(  Request $request, Product $products )
    {
    
        $images = new Image();
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->stock = $request->input('stock');
        $products->save();
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
        $category = Category::all();
        return view('products.edit', compact('product'), compact('category'));
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
