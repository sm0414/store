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

Route::get('/goodsDetail/{id}', 'StoreController@goodsDetail');

Route::get('/cart', 'StoreController@cart')->name('cart');
Route::get('/increase-one/{id}', 'StoreController@increaseByOne');
Route::get('/decrease-one/{id}', 'StoreController@decreaseByOne');
Route::get('/remove-item/{id}', 'StoreController@removeItem');
Route::get('/add-to-cart/{id}', 'StoreController@addToCart');

Route::get('/orders', 'StoreController@orders')->name('orders');
Route::get('/order/{id}', 'StoreController@orderItems');
Route::post('/checkout', 'StoreController@checkout');

Route::get('/manage/index', 'Manage\ManageController@index');
Route::get('/manage/members', 'Manage\ManageController@members');
Route::get('/manage/member_orders/{id}', 'Manage\ManageController@memberOrders');
