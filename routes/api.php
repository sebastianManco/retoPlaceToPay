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



Route::as('api.')->group(function(){
    Route::apiResource('products', 'Api\ProductApiController')->only('index', 'show', 'store', 'update');
    Route::apiResource('categories', 'Api\CategoryApiController')->only('index', 'show', 'store');
});


