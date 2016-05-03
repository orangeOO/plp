<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'GoodsController@index');
//Route::get('/home', 'AdminController@index');
Route::get('/type/{typeid}', 'GoodsController@index');
Route::get('/search', 'GoodsController@search');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('goods', 'GoodsController');
Route::controller('user', 'UserController');
Route::controller('admin', 'AdminController');
