<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/products', 'ProductController');

/*Route::prefix('products')->name('products.')->group(function() {
    Route::get('/', 'API\\ProductController@index')->name('index');
    Route::get('/{product}', 'API\\ProductController@show')->name('show');

    Route::middleware('auth')->group(function() {
        Route::post('/', 'API\\ProductController@store')->name('store');
        Route::match(['PUT', 'PATCH'], '/{product}', 'API\\ProductController@update')->name('update');
        Route::delete('/{product}', 'API\\ProductController@destroy')->name('destroy');
    });
});*/
