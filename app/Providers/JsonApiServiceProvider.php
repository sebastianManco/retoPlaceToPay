<?php

namespace App\Providers;

use App\JsonApi\JsonApiBuilder;
use App\JsonApi\JsonIpiBuilder;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class JsonApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        Response::macro('jsonApiProduct', function ($value) {
            return Response::json([
                'message' => 'product created',
                'id' => $value->id,
                'name' => $value->name,
                'description' => $value->description,
                'category_' => $value->category->name,
                'price' => $value->price,
                'stock' => $value->stock
            ]);
        });

        Builder::mixin(new JsonApiBuilder);
    }
}
