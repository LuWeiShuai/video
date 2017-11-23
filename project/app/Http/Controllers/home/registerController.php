<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\login;
use App\Http\model\info;
use Session;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

use Hash;


class registerController extends Controller
{
    public function register(){
    	 //获取ajax传的手机号
        $tel= $_GET['tel'];

        //正则匹配手机号
        $re = '/1[345789]\d{9}/';
        $a = preg_match('/1[345789]\d{9}/',$tel);
        if ($a) {
        	//将手机号存入session
        	session(['tel'=>$tel]); 
        	//发短信      
	  		$config = [
	        'accessKeyId'    => 'LTAI0SrxJEqRfqlf',
	        'accessKeySecret' => 'BypG3S4ChCl5EIgVj5o6uvk9rtHYkD',
	        // 'sandbox'    => true,  // 是否为沙箱环境，默认false
	        ];
	        $code = rand(100000, 999999);
			$client  = new Client($config);
			$sendSms = new SendSms;
			$sendSms->setPhoneNumbers($tel);
			$sendSms->setSignName('卢伟帅');
			$sendSms->setTemplateCode('SMS_110845196');
		    $sendSms->setTemplateParam(['code'=>$code]);
			$sendSms->setOutId('demo');
	       	$client->execute($sendSms);
	       	session(['code'=>$code]);
	       	return  "1";
        }else{
        	return "0";
        }
      	
  }  

  	//将生成的短信存入session,并进行验证
    public function code(){
    	$code = $_GET['code'];    	
    	$recode = (session('code'));
    	
    	if($code == $recode){
    		return "1";
    	}else {
    		return "0";
    	}

    }
	
    //存入数据库
    public function store(Request $request){
    	//验证密码
    	 $this->validate($request, [
       
        'password' => 'required|regex:/\S{8,16}/',
        'repass' => 'same:password'
        
         ],[
        
        'password.required'=>'密码不能为空',
        "password.regex"=>'密码格式不正确'
       
         ]);

        //把缓存的电话存入一个$v的数组中
    	$tel = session('tel');
    	$code = session('code');
    	$v['tel'] = $tel;
    	$v['password'] = $_POST['password'];
    	//哈希加密密码
    	$v['password'] = Hash::make($v['password']);
    	
    	$res = login::insert($v);
    	
    	if($res){
    		//存储成功,把id当做uid存入info表
    		$re = login::where('tel','=',$tel)->first();
    			$data['uid']=$re['id'];
    		$ss = info::insert($data);
    		
    		//清除所有缓存
    		session()->flush();
    		
    		return redirect('/home/index');
    	} else {
    		return back();
    	}

    }

}
