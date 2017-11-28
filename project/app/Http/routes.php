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

//前台登录
Route::get('/home_login','loginController@home');
//执行登录
Route::post('/home_login/dologin','loginController@dohlogin');
//注销
Route::get('/home_login/delete','loginController@delete');
//忘记密码
Route::get('/home/forgot','loginController@forgot');


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

	//子分区管理
	Route::resource('/typeSon','typeSonController');
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

	//后台视频管理
	Route::get('/videoa','VideoaController@index');
	Route::get('/videos','VideoaController@shan');
	Route::resource('/videochuan','VideoaController');
	Route::get('/video/huishou','VideoaController@huishou');
	Route::get('/video/del/{id}','VideoaController@delete');
	Route::get('/video/upload/{id}','VideoaController@upload');
	Route::resource('/video','VideoController');

});


//后台登录
Route::get('/home_login','loginController@home');

//前台路由
Route::group(['prefix'=>'home','namespace'=>'home'],function(){


	//前台主页
	Route::get('/index','homeController@index');
	
	//视频遍历
	Route::get('/video/{id}','videoController@video');
	Route::get('/type/{id}','videoController@type');


	//视频播放
	Route::get('/play/{id}','videoController@play');

	//用户评论
	Route::post('/discuss','videoController@discuss');

	//用户视频播放
	Route::get('/user_play/{id}','videoController@user_play');


	//用户注册
	Route::get('/register','registerController@register');
	Route::post('/regis','registerController@store');
	Route::get('/reg','registerController@code');
	Route::post('/passs','registerController@passs');

	//搜索
	Route::get('/search','searchController@index');
	Route::get('/regs','registerController@tell');
 });

//前台路由
Route::group(['prefix'=>'home','namespace'=>'home','middleware'=>'home_login'],function(){


//前台个人中心
Route::get('/center','centerController@index');
//修改手机号
Route::get('/center/tel','centerController@tel');
//联系我们
Route::get('/center/service','centerController@service');
//关于我们
Route::get('/center/about','centerController@about');
//验证码
Route::get('/center/yzm','centerController@yzm');
//修改密码
Route::get('/center/password','centerController@password');
//历史记录
Route::get('/center/history','centerController@history');
//删除历史记录
Route::get('/center/delete/{id}','centerController@delete');
//修改个人中心
Route::post('/center/update','centerController@update');
//执行更换手机号
Route::post('/center/yzmUpdate','centerController@yzmUpdate');
//执行更改密码
Route::post('/center/repass','centerController@repass');
//用户上传
Route::get('/center/up','centerController@up');
//vip开通
Route::get('/center/vip','centerController@vip');
//执行vip开通
Route::get('/center/doVip','centerController@doVip');
//购买视频页面
Route::get('/center/money/{id}','centerController@money');
//执行购买
Route::get('/center/buy','centerController@buy');
//用户上传视频
Route::resource('/up','UpController');
Route::resource('/picchuan','VideoaController');
Route::resource('/videos','ShangController');
});



