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

Auth::routes();

Route::get('/','StoreController@index')->name('index');

Route::get('goodsDetail','userController@goodsDetail')->name('goodsDetail');

Route::get('cart','userController@cart')->name('cart');
Route::post('cartPost','userController@cartPost')->name('cartPost');

Route::get('orders','userController@orders')->name('orders');

Route::post('addPost','userController@addPost')->name('addPost');
