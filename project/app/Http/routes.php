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
Route::get('/admin_login/code','loginController@code');
Route::post('/admin_login/dologin','loginController@doalogin');


//后台路由

Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'admin_login'],function(){

	//后台主页
	Route::get('/index','adminController@index');
	//注销
	Route::get('/exit','adminController@exit');


	//用户管理
	Route::resource('/user','userController');

	//管理员
	Route::resource('/admin_user','admin_userController');

	//分区管理
	Route::resource('/typeSon','typeSonController');

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

	//后台视频管理
	Route::resource('/video','VideoController');

});


//后台登录
Route::get('/home_login','loginController@home');

//前台路由
 Route::group(['prefix'=>'home','namespace'=>'home'],function(){

 	//前台主业
	Route::get('/index','homeController@index');

 });



