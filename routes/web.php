<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/', function () {
        return view('home');
    }
);

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/home/userList', 'UserController@index')->name('userList')->middleware('AuthAdmin');
Route::resource('users', 'UserController');
Route::get('products/indexClient', 'ClientController@index')->name('products/indexClient')->middleware('verified');
Route::resource('products', 'ProductController');
Route::resource('categories', 'categoryController');

Route::get('add-to-cart/{product}', 'CartController@add')->name('cart.add');
Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/cart/update/{product}','CartController@update')->name('cart.update');
Route::get('/cart/destroy/{product}','CartController@destroy')->name('cart.destroy');

