<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductApiController extends Controller
{

    /**
     * retorna una coleccion de productos
     * get /products/index
     *
     */
    public function index()
    {
        $products = Product::applySorts(request('sort'))->get();
        //$products = DB::table('Products');
        return ProductCollection::make($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    /**
     *  get /products/show/int
     * retorna un json con la siguiente información { { product: 'id', 'name', 'description', 'category', 'price', 'stock' } }
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return ProductResource
     */
    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return new ProductResource($product);
    }
}
