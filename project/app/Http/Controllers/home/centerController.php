<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\info;
use Session;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class centerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询info表
        $res = info::where('uid',session('uid'))->first();

        $data = explode('-',$res['birthday']);
        // dd($data);
        return view('/home/center/center',['res'=>$res,'data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tel()
    {
         return view('/home/center/tel');
    }

     public function service()
    {
         return view('/home/center/service');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'nikeName' => 'required|regex:/^\S{1,30}$/',
            'email'=>'required|email'
            
        ],[
            'nikeName.required'=>'昵称不能为空!!!!!',
            'nikeName.regex'=>'昵称格式不正确',
            'email.required'=>'邮箱密码不能为空!!!!!',
            'email.email'=>'邮箱格式不正确'
        ]);

        //获取年月日
        $res = $request->only('year','month','day');

        //把年月日拼装成一个字符串
        $birthday = implode('-',$res);

        //获取info表中的字段
        $data = $request->only('email','sex','nikeName');

        //获取uid
        $uid = session('uid');

        if ($request->hasFile('profile')) {

            $info = info::where('uid',$uid)->first();
            if($info->profile !== 'default.jpg'){
                
                unlink('./homes/pic/'.$info->profile);
            }
            
            
            //修改名字
            $name = rand(1111,9999).time();

            //获取后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();

            //移动图片
            $pic = $request->file('profile')->move('./homes/pic/',$name.'.'.$suffix);

            $data['profile'] = $name.'.'.$suffix;
        }
        
        //把生日插入数组       
        $data['birthday'] = $birthday;
        
        //将数据添加到数据库
        $array = info::where('uid',$uid)->update($data);

        //判断
        if ($array) {
            return redirect('/home/index')->with('msg','修改成功');
        }else{
            return back();
        }
        
        return view('/home/center/center/index');
    }

    public function yzm()
    {
        $tel = $_GET['tel'];
        // var_dump($tel);
        session(['tel'=>$tel]); 
        $config = [
        'accessKeyId'    => 'LTAI4YCQiEAcdIYl',
        'accessKeySecret' => 'Z0TLQJAGOT24fsvNGpUhr9VnQHmyCi',
        // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];

        $code = rand(100000, 999999);
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($tel);
        $sendSms->setSignName('王向前');
        $sendSms->setTemplateCode('SMS_113135066');
        $sendSms->setTemplateParam(['code' => $code]);
        $sendSms->setOutId('demo');
        $res=$client->execute($sendSms);
        session(['code'=>$code]);
        return $code;
        
    }
    public function codeUpdate()
    {

    }
}
