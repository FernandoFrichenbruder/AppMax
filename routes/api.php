<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products', 'Api\ProductController@apindex');



Route::group(['middleware' => ['auth:api']], function (){

        // Route::post('/baixar-produtos', 'Admin\SkuController@deduct')->name('deduct');
        // Route::post('/adicionar-produtos', 'Admin\SkuController@add')->name('add');
        
});

Route::post('login', 'Api\JwtAuthController@login');
Route::post('register', 'Api\JwtAuthController@register');
  
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('/baixar-produtos', 'Api\SkuController@deduct')->name('deduct');
    Route::post('/adicionar-produtos', 'Api\SkuController@add')->name('add');
    Route::get('logout', 'Api\JwtAuthController@logout');
});