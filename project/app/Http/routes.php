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
Route::get('/admin_login','loginController@admin');

//后台路由

Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'alogin'],function(){

	//后台主页
	Route::get('/index','adminController@index');

	//用户管理
	Route::resource('/user','userController');

	//分区管理

	Route::resource('/type','typeController');


	//用户上传
		//待审核
	Route::resource('/userup','UserUpController');
		//已通过
	Route::resource('/userguo','UserGuoController');


	//网站配置
	Route::resource('/config','configController');

	//友情链接
	Route::resource('/friendlink','friendlinkController');

});

//前台路由

// Route::group(['prefix'=>'home','namespace'=>'home','middleware'=>'alogin'],function(){

// });



