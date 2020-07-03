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

Route::get('/', 'PagesController@index');
Route::get('report', function () { return "Reports"; });


Route::resource('posts','PostsController');

// Products route
Route::resource('products', 'ProductsController');

// Authentication Route
Auth::routes();

// Product Category Route
Route::resource('product-category', 'ProductCategoryController');

// Dashboard
Route::get('dashboard', 'DashboardController@index');

