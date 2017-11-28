<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\admin;
use Hash;
use zgldh\QiniuStorage\QiniuStorage;
use session;

class centerController extends Controller
{
     //修改管理员密码
    public function password()
    {
        return view('admin.admin_user.password');
    }

    //执行密码修改
    public function dopassword(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|regex:/^\S{3,16}$/',
            'repassword'=>'same:password',           
        ],[           
            'password.required'=>'密码不能为空!!!!!',
            'password.regex'=>'密码格式不正确',
            'repassword.same'=>'两次密码不一致',
        ]);

        $res = $request->except('_token','repassword');
        $res['password'] = Hash::make($request->input('password'));

        $result = admin::where('id',session('id'))->update($res);

        if($result){
            return redirect('/admin_login')->with('msg','密码修改成功');
            $request->session('id')->flush();
        }else{
            return back()->with('msg','密码修改失败');
        }
    }
    //修改管理员头像
    public function profile()
    {
        return view('admin.admin_user.profile');
    }
    //上传头像(修改)
    public function up(Request $request)
    {
        $disk = QiniuStorage::disk('qiniu');
       
        //获取上传文件的后缀名
        $vsuffix = $request->file('file_upload')->getClientOriginalExtension();
        //拼装上传文件的新名字
        $vfileName =date('YmdHis',time()).rand(100000, 999999).'.'.$vsuffix;

        //获取缓存文件的路径
        $vonly=$request->file('file_upload')->getRealPath();
        //上传到七牛
        $vbool = $disk->put('images/'.$vfileName,file_get_contents($vonly));

        //删除原头像
        $res = admin::where('id',session('id'))->first();
        //获取原头像名
        $oldname = $res->profile;
        $disk->delete('images/'.$oldname);

        if ($vbool) {
            //把文件名存入数组中
            return $vfileName;
        }
    }

    //执行修改管理员头像
    public function doprofile(Request $request)
    {
        $res = $request->except('_token','_method');
        $id = session('id');
        $result = admin::where('id',$id)->update($res);

        if($result){
            return redirect('/admin/index')->with('msg','修改成功');
        }else{
            return redirect('/admin/index')->with('msg','修改失败');
        }
    }
}
