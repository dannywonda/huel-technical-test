<?php

use App\Http\Controllers\OrderController;


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
 
Route::get('/', 'HomeController@index')->name('home');
Route::get('/orders', 'OrderController@index')->name('orders');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/users', 'UserController@index')->name('users');
 