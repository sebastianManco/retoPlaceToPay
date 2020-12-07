<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiCategoriesRequest;
use App\Http\Resources\resourceCollection;
use App\Http\Resources\ResourceObject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryApiController extends Controller
{
    /**
     * @return resourceCollection
     */
    public function index(): resourceCollection
    {
        return ResourceCollection::make(Category::all());
    }

    /**
     * @param ApiCategoriesRequest $request
     */
    public function store(ApiCategoriesRequest $request)
    {
        $category = Category::create($request->all());
        return response()->jsonApiStoreModel($category);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ResourceObject
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return new ResourceObject($category);
    }
}
