<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\info;

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
        //获取年月日
        $res = $request->only('year','month','day');
        //把年月日拼装成一个字符串
        $birthday = implode('-',$res);
        //获取info表中的字段
        $data = $request->only('email','profile','sex','nikeName');
        
        //修改名字
        /*$name = rand(1111,9999).time();

        //获取后缀
        $suffix = $request->file('profile')->getClientOriginalExtension();

        //移动图片
        $pic = $request->file('profile')->move('./homes/pic/',$name.'.'.$suffix);*/

        //获取uid
        $uid = session('uid');
        //把生日插入数组       
        $data['birthday'] = $birthday;
        // $data['profile'] = $pic;
        
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

    public function telUpdate(Request $request)
    {
        $config = [
        'accessKeyId'    => 'LTAI4YCQiEAcdIYl',
        'accessKeySecret' => 'Z0TLQJAGOT24fsvNGpUhr9VnQHmyCi',
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
}
