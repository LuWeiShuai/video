<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Hash;
use App\Http\Model\admin;
use App\Http\Model\login;
use App\Http\Model\info;
use DB;

class loginController extends Controller
{
    public  function admin()
    {
    	// session(['id'=>12]);
    	return view("admin.login");
    }

    public  function doalogin(Request $request)
    {
    	$res = $request->except('_token');

    	$request->flash();
    	// dd($res);
		// dd($res['username']);      
        	$uname = admin::where('userName',$res['username'])->first();

    	    	if(!$uname){

    	    		return back()->with('msg','您输入的用户名或密码错误');
    	    	}

    	    	if(!Hash::check($res['password'],$uname->password)){
    	    	// if($res['password'] != $uname->password){

    	    		return back()->with('msg','您输入的用户名或密码错误');
    	    	}

    	    	if(session('vcode') != $res['code']){

    	    		return back()->with('msg','验证码错误');
    	    	}
    	
    	//存session
    	session(['id'=>$uname->id]);
    	// $request->session()->put('uid',$uname->id);
    	return redirect('/admin/index');
    }

    public function code()
    {
    	// var_dump(session('uid'));die;

    	//生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 120, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('vcode', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

     public  function home()
    {
        // session(['uid'=>12]);
        return view("home.index");
    }

    public  function dohlogin(Request $request)
    {
        $res = $request->except('_token');

        // dd($res);die;
        $request->flash();
        // dd($res);die;
        // dd($res['tel']);  
            $tel = login::where('tel',$res['tel'])->first();
            
                if(!$tel){

                    return back()->with('msg','您输入的手机号或密码错误');
                }

                if(!Hash::check($res['password'],$tel->password)){

                    return back()->with('msg','您输入的手机号或密码错误');
                }

        //存session
        $request->session()->put('uid',$tel->id);

        //把最后登录时间存入数据库
        $last = $request->only('lastlogin');
        $id = session('uid');
        login::where('id',$id)->update($last);

        return redirect('/home/index')->with('msg','登录成功');
    }

     public  function delete(Request $request)
    {
        $request->session('uid')->flush();

        return redirect('/home/index');
    }

    public function forgot()
    {
        return view('/home/forgot');
    }
}
