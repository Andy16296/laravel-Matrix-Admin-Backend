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

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/admin','AdminController@login'); */

Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();

Route::get('/home','HomeController@index')->name('home');

/* To use this Group of Routes below you have to change the RedirectAuthenicated.php file in Middleware */
Route::group(['middleware' => ['auth']],function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

	// Categories Route (Admin)
	Route::match(['get','post'],'/admin/add_category','CategoryController@addCategory');
	Route::match(['get','post'],'/admin/edit_category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'/admin/delete_category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view_categories','CategoryController@viewCategories');

	// Produce Routes
	Route::match(['get','post'],'/admin/add_product','ProductsController@addProduct');
	Route::match(['get','post'],'/admin/edit_product/{id}','ProductsController@editProduct');
	Route::get('/admin/view_products','ProductsController@viewProducts');
	Route::get('/admin/delete_product/{id}','ProductsController@deleteProduct');
	Route::get('/admin/delete_product_image/{id}','ProductsController@deleteProductImage');

	// Products Attributes Routes
	Route::match(['get','post'],'admin/add_attributes/{id}','ProductsController@addAttributes');
	Route::get('/admin/delete_attribute/{id}','ProductsController@deleteAttribute');
});

// Route::get('/admin/dashboard','AdminController@dashboard');

Route::get('/logout','AdminController@logout');


