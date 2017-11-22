<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\login;
use Session;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

use Hash;


class registerController extends Controller
{
    public function add(){
    	 
        $tel= $_GET['tel'];

       session(['tel'=>$tel]); 
        // return $tel;
        // var_dump($tel);
  		$config = [
        'accessKeyId'    => 'LTAI0SrxJEqRfqlf',
        'accessKeySecret' => 'BypG3S4ChCl5EIgVj5o6uvk9rtHYkD',
        // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];

		$client  = new Client($config);
		$sendSms = new SendSms;
		$sendSms->setPhoneNumbers($tel);
		$sendSms->setSignName('卢伟帅');
		$sendSms->setTemplateCode('SMS_110845196');
		$sendSms->setTemplateParam(['code' => rand(100000, 999999)]);
		$sendSms->setOutId('demo');
       	$res=$client->execute($sendSms);
       	session(['code'=>$res]);

    }

    public function store(Request $request){
    	$a = session('tel');
    	$res = $request->only(['password','lastlogin']);
    	$v['password'] = $_GET['password'];
    	$v['tel'] = $a;
    	

    	$v['password'] = Hash::make($v['password']);

    	// $login = $_GET->except('repass');
    	$res = login::insert($v);
    	

    }
}
