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

        Route::prefix('skus')->name('skus.')->group(function(){
            Route::post('/add', 'SkuController@add')->name('add');
            Route::post('/deduct', 'SkuController@deduct')->name('deduct');
        });

        Route::resource('categories', 'CategoryController');
        Route::resource('orders', 'OrderController');

        Route::prefix('orders')->name('orders.')->group(function(){
            Route::get('/{order}/populate', 'OrderController@additems')->name('populate');
        });

        Route::prefix('reports')->name('reports.')->group(function(){
            Route::get('/', 'ReportController@index')->name('index');
        });

        Route::prefix('items')->name('items.')->group(function(){
            Route::post('/store', 'ItemController@store')->name('store');
        });
        
        Route::resource('customers', 'CustomerController');
        Route::resource('adminstrators', 'AdministratorController');
    });
});
Auth::routes();
