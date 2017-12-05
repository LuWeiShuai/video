<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use App\Http\model\info;
use App\Http\model\login;
use App\Http\model\history;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use zgldh\QiniuStorage\QiniuStorage;
use App\Http\model\config;
use App\Http\model\money;
use App\Http\model\video;
use App\Http\model\user_vip;
use App\Http\model\uhistory;


class centerController extends Controller
{
    //加载个人中心主页
    public function index()
    {
        //查询info表
        $res = info::where('uid',session('uid'))->first();
        //查询login表
        $res1 = login::where('id',session('uid'))->first();
        //进行拆分生日
        $data = explode('-',$res['birthday']);
        //更改logo的变量
        $re = config::first();
        return view('/home/center/center',['res'=>$res,'res1'=>$res1,'data'=>$data,'re'=>$re]);
    }

    // 获取个人中心页面的电话号码页面
    public function tel()
    {
         return view('/home/center/tel');
    }
    // 获取个人中心页面的联系我们页面
     public function service()
    {
         return view('/home/center/service');
    }
    // 获取个人中心页面的关于尚视页面
    public function about()
    {
        return view('home/center/about');
    }    
    // 获取个人中心页面的修改密码页面
     public function password()
    {
        return view('home.center.password');
    }

    //修改个人中心
    public function update(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'nikeName' => 'required|regex:/^\S{1,30}$/',
            'email'=>'required|email'
            
        ],[
            'nikeName.required'=>'昵称不能为空!!!!!',
            'nikeName.regex'=>'昵称格式不正确',
            'email.required'=>'邮箱不能为空!!!!!',
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
        //判断是否更改了头像
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
            return redirect('/home/center')->with('msg','修改成功');
        }else{
            return back()->with('msg','修改失败');
        }
        
        return view('/home/center/center/index');
    }
    //获取验证码
    public function yzm()
    {
        // 获取手机号
        $tel = $_GET['tel'];

        //将手机号存入session
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
    //执行更换手机号
    public function yzmUpdate(Request $request)
    {
        //获取验证码
        $yzm = $request['yzm'];

        //获取手机号
        $tel = $request['tel'];

        //将手机号放入新数组
        $data['tel'] = $tel;

        //获取session的验证码
        $session = session('code');
       
        //获取uid的uid
        $id = session('uid');
        
        //判断验证码是否正确
        if($session == $yzm && $session!== null && $yzm !== ''){
            //将新手机号插入数据库
            login::where('id',$id)->update($data);

            return redirect('/home/center')->with('msg','修改成功');
        }else{
             return back()->with('msg','修改失败');
        }

    }
     //执行忘记密码
    public function forgot(Request $request)
    {
        $tel = $request['tel'];

        $login = login::where('tel',$tel)->first();

        if($login != null){

            //获取密码
            $pass = $request['password'];

            //进行hash加密
            $data['password'] = Hash::make($pass);

            //获取验证码
            $yzm = $request['yzm'];

            //获取session的验证码
            $session = session('code');

            //判断验证码是否正确
            if($session == $yzm && $session!== null && $yzm !== ''){
                
                //将新密码插入数据库
                login::where('tel',$tel)->update($data);
                
                return back()->with('msg','修改成功');
            }else{
                return back()->with('msg','修改失败');
            }

        }else{
            return back()->with('msg','此账号不存在');
        }
       
    }
    
    //执行更改密码
    public function repass(Request $request)
    {
        //获取密码
        $pass = $request['password'];

        //进行hash加密
        $data['password'] = Hash::make($pass);

        //获取验证码
        $yzm = $request['yzm'];

        //获取session的验证码
        $session = session('code');

        //获取session的uid
        $id = session('uid');

        //判断验证码是否正确
        if($session == $yzm && $session!= null && $yzm != ''){
            
            //将新密码插入数据库
            login::where('id',$id)->update($data);
            $request->session('uid')->flush();
            return redirect('/')->with('msg','修改成功,请重新登录');
        }else{
            return back()->with('msg','修改失败');
        }

    }

    //用户上传
    public function up(){
        

        return view('/home/center/up');
    }

    //获取用户历史记录的页面
    public function history()
    {
        //从session中获取uid
        $uid = session('uid');

        //从history数据库查询
        $res = history::where('uid',$uid)->orderBy('time','desc')->get();

        //从uhistory数据库查询
        $res1 = uhistory::where('uid',$uid)->orderBy('time','desc')->get();
        // dd($res1);

        return view('/home/center/history',['res'=>$res,'res1'=>$res1]);
    }

    //执行删除历史记录
    public function delete($id)
    {
        //删除数据库中的数据
        $res = history::where('id',$id)->delete();
        $res1 = uhistory::where('id',$id)->delete();

        //判断
        if ($res || $res1) {
            return redirect('/home/center/history')->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
    }

    //vip开通
    public function vip()
    {
        return view('/home/center/vip');
    }

    //执行vip开通
    public function doVip()
    {
        //获取开通了几个月
        $month = $_GET['month'];
        //获取开通的时间
        $time = $_GET['time'];

        //获取到期时间
        switch($month){
            case 1:
                $lasttime = date('Y-m-d H:i:s',strtotime('+1 month'));
            break;
            case 2:
                $lasttime = date('Y-m-d H:i:s',strtotime('+2 month'));
            break;
            case 3:
                $lasttime = date('Y-m-d H:i:s',strtotime('+3 month'));
            break;
            case 4:
                $lasttime = date('Y-m-d H:i:s',strtotime('+4 month'));
            break;
            case 5:
                $lasttime = date('Y-m-d H:i:s',strtotime('+5 month'));
            break;
            case 6:
                $lasttime = date('Y-m-d H:i:s',strtotime('+6 month'));
            break;
            case 7:
                $lasttime = date('Y-m-d H:i:s',strtotime('+7 month'));
            break;
            case 8:
                $lasttime = date('Y-m-d H:i:s',strtotime('+8 month'));
            break;
            case 9:
                $lasttime = date('Y-m-d H:i:s',strtotime('+9 month'));
            break;
            case 10:
                $lasttime = date('Y-m-d H:i:s',strtotime('+10 month'));
            break;
            case 11:
                $lasttime = date('Y-m-d H:i:s',strtotime('+11 month'));
            break;
            case 12:
                $lasttime = date('Y-m-d H:i:s',strtotime('+12 month'));
            break;
        };
        
        //获取session的uid
        $id = session('uid');
        //根据uid来查询login表
        $res = login::where('id',$id)->first();
        $data = [];
        $vip = [];
        if($res->status == 0){

            $data['status'] = 1;
            $vip['uid'] = $id;
            $vip['month'] = $month;
            $vip['time'] = $time;
            $vip['lasttime'] = $lasttime;
            user_vip::insert($vip);
        }else{

            return back()->with('msg','您已经开通了vip,祝您观看愉快');
        }

        $result = login::where('id',$id)->update($data);

        if($result){

            return back()->with('msg','vip开通成功');
        }else{
            return back()->with('msg','vip开通失败');
            
        }

    }

    //购买视频页面
    public function money($id)
    {
        $res = video::where('id',$id)->first();
        return view('home/center/money',['res'=>$res]);
    }

    //购买
    public function buy(Request $request)
    {
        $data =[];
        $data['vid'] = $request->input('money');
        $data['uid'] = session('uid');
        $res = video::where('id',$request->input('money'))->first();
        $data['title'] = $res->title;

        $res1 = money::insert($data);
        if($res1){
            return redirect('/')->with('msg','购买成功');
        }else{
            return back()->with('msg','购买失败');
        }
    }
}
