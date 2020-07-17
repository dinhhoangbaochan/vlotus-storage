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
	return redirect('/login');
});
Route::get('report', function () { return "Reports"; });


Route::resource('posts','PostsController');

// Products route
Route::resource('products', 'ProductsController');

// Authentication Route
Auth::routes();

// Product Category Route
Route::get('product-category/delete/{id}', 'ProductCategoryController@destroy');
Route::get('product-category/{id}', 'ProductCategoryController@customUpdate');
Route::resource('product-category', 'ProductCategoryController');

// Product Brand Route
Route::get('product-brand/delete/{id}', 'ProductBrandController@destroy');
Route::resource('product-brand', 'ProductBrandController');


// Dashboard
Route::get('dashboard', 'DashboardController@index');

// Users
Route::get('/users', 'UsersController@index');

// Request admin to create an account
Route::get('request-account', 'UsersController@requestAccount');
Route::post('send-mail', 'UsersController@sendMail');

// Create staff account 
Route::get('new-staff/{email}/{staff_name}', 'UsersController@createStaffAccount');
Route::post('register-staff/', 'UsersController@createStaff');

// Delete account
Route::get('users/delete/{id}', 'UsersController@deleteStaff');

Route::match(['put', 'patch'],'users/{id}', 'UsersController@update');

// Orders
Route::get('orders', 'OrderController@allOrder');
Route::get('order/create', 'OrderController@create');