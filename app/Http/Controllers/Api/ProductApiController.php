<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    /**
     * retorna una coleccion de productos
     * get /products/index
     *
     * @return ProductCollection
     */
    public function index()
    {
        return new ProductCollection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    /**
     *  get /products/show/int
     * retorna un json con la siguiente información { { product: 'id', 'name', 'description', 'category', 'price', 'stock' } }
     * @param $productId
     * @return ProductResource
     */
    public function show(int $id)
    {
        $product = Product::findOrFail($id);

        return new ProductResource($product);
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
