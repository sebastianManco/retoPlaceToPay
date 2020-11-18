<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/index', 'Api\ProductApicontroller@index')->name('api.products.index');

Route::post('/products/create', 'Api\ProductApicontroller@index')->name('api.products.store');

Route::get('/products/show/{id}', 'Api\ProductApicontroller@show')->name('api.products.show');

Route::put('/products/update/{id}', 'Api\ProductApicontroller@update')->name('api.products.update');
