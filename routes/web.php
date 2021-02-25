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

Route::get('/cart', 'StoreController@cart')->name('cart');
Route::get('/increase-one/{id}', 'StoreController@increaseByOne');
Route::get('/decrease-one/{id}', 'StoreController@decreaseByOne');
Route::get('/remove-item/{id}', 'StoreController@removeItem');
Route::get('/add-to-cart/{id}', 'StoreController@addToCart');
