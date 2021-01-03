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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function (){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        Route::resource('products', 'ProductController');
        Route::prefix('products')->name('products.')->group(function(){
            Route::post('/add', 'ProductController@add')->name('add');
            Route::post('/remove', 'ProductController@remove')->name('remove');
        });
        Route::resource('skus', 'SkuController');
        Route::resource('categories', 'CategoryController');
        Route::resource('orders', 'OrderController');
        Route::prefix('orders')->name('orders.')->group(function(){
            Route::get('/{order}/populate', 'OrderController@additems')->name('populate');
        });
        Route::prefix('items')->name('items.')->group(function(){
            Route::post('/store', 'ItemController@store')->name('store');
        });
        Route::resource('customers', 'CustomerController');
        Route::resource('adminstrators', 'AdministratorController');
    });
});

Auth::routes();
