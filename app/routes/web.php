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

Route::get('/manage/index', 'Manage\ManageController@index')->name('manage.index');
Route::get('/manage/create', 'Manage\ManageController@create');
Route::post('/manage/store', 'Manage\ManageController@store');
Route::get('/manage/edit/{id}', 'Manage\ManageController@edit');
Route::put('/manage/update/{id}', 'Manage\ManageController@update');
Route::delete('/manage/delete/{id}', 'Manage\ManageController@delete');
