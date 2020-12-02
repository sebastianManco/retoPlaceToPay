<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsCollection;
use App\Product;
use Illuminate\Http\Request;


class ProductApiController extends Controller
{

    /**
     *   * retorna una coleccion de productos
     * get /products/index
     * @return ProductsCollection
     */
    public function index()
    {
        $products = Product::applySorts()->jsonPaginate();
        return ProductsCollection::make($products);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->jsonApiProduct($product);
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
