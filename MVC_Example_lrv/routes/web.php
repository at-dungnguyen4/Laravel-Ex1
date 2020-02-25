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

Route::get('/MVC_Example_lrv', function () {
    return view('welcome');
});
Route::resource('/MVC_Example_lrv/users','UserController');
ROute::get('/MVC_Example_lrv/searchuser','UserController@getSearch');

Route::resource('/MVC_Example_lrv/blogs','BlogController');
ROute::get('/MVC_Example_lrv/searchblog','BlogController@getSearch');

Route::resource('/MVC_Example_lrv/products','ProductController');
ROute::get('/MVC_Example_lrv/searchproduct','ProductController@getSearch');

Route::resource('/MVC_Example_lrv/categories','CategoryController');
ROute::get('/MVC_Example_lrv/searchcategory','CategoryController@getSearch');
