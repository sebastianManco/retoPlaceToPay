<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiProductRequest;
use App\Http\Resources\ResourceObject;
use App\Http\Resources\resourceCollection;
use App\Product;
use Illuminate\Http\Request;


class ProductApiController extends Controller
{

    /**
     *   * retorna una coleccion de productos
     * get /products/index
     * @return resourceCollection
     */
    public function index()
    {
        $products = Product::applySorts()->jsonPaginate();
        return resourceCollection::make($products);
    }

    /**
     * @param ApiProductRequest $request
     * @return mixed
     */
    public function store(ApiProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->jsonApiStoreModel($product);
    }

    /**
     *  get /products/show/int
     * retorna un json con la siguiente información { { product: 'id', 'name', 'description', 'category', 'price', 'stock' } }
     * @param Product $product
     * @return ResourceObject
     */
    public function show(int $id)
    {
        $product = Product::findOrfail($id);
        return ResourceObject::make($product);
    }


    /**
     * @param ApiProductRequest $request
     * @param int $id
     * @return ResourceObject
     */
    public function update(ApiProductRequest $request, int $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return new ResourceObject($product);
    }
}
