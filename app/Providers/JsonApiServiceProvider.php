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
        Response::macro('jsonApiStoreModel', function ($value) {
            return Response::json([
                'message' => 'product created',
                 $value->fields(),
            ]);
        });

        Builder::mixin(new JsonApiBuilder());
    }
}
