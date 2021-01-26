<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/shopify/orders', 'OrderController@show')->name('orders');
Route::get('/shopify/customers', 'UserController@show')->name('customers');
Route::get('/shopify/products', 'ProductController@show')->name('products');
Route::get('/shopify/stats', 'HomeController@orderStats')->name('stats');