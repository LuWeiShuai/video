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

Route::get('/', function () {
    return view('welcome');
});

//后台登录
Route::get('/admin/login','adminController@login');

//后台路由
Route::group(['middleware'=>'alogin'],function(){

	//后台主页
	Route::get('/admin','adminController@index');

	//用户管理
	Route::resource('/admin/user','userController');

	//分区管理
	Route::resource('/admin/type','typeController');

	//友情链接
	Route::resource('/admin/config','configController');

});

//前台路由
// Route::group(['middleware'=>'hlogin'],function(){

// 	Route::get('/admin','adminController@index');

// });

