<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\login; 
use App\Http\model\info;
use App\Http\model\admin; 
use Hash;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //用户列表页
    public function index(Request $request)
    {
        $res = login::where('tel','like','%'.$request->input('search').'%')
         ->orderBy('id','asc')
         ->paginate($request->input('num',10));

        return view('admin.user.list',['res'=>$res,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //管理员添加页
    public function create()
    {
        //
        return view('admin.user.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //执行管理员添加
    public function store(Request $request)
    {
        $request->flash();
         $this->validate($request, [
            'userName' => 'required|regex:/^\w{3,12}$/',
            'password' => 'required|regex:/^\S{3,16}$/',
            'repassword'=>'same:password',
            'phone'=>'required|regex:/^1[34578]\d{9}$/'
            
        ],[
            'userName.required'=>'用户名不能为空!!!!!',
            'userName.regex'=>'用户名格式不正确',
            'password.required'=>'密码不能为空!!!!!',
            'password.regex'=>'密码格式不正确',
            'repassword.same'=>'两次密码不一致',
            'phone.required'=>'手机号不能为空!!!!!',
            'phone.regex'=>'手机号格式不正确'

        ]);
         
        $res = $request->except('_token','repassword');
        $res['password'] = Hash::make($request->input('password'));

        $result = admin::insert($res);

        if($result){
            return redirect('/admin/admin_user')->with('msg','添加管理员成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //管理员列表
    public function show($id)
    {
        return view('admin.user.alist');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //用户信息修改
    public function edit($id)
    {
        $res = login::where('id',$id)->first();
        // dd($res);
       return view('admin.user.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //执行修改
    public function update(Request $request, $id)
    {
        $res = $request->except('_token','_method');


        // dd($res);
        $result = login::where('id',$id)->update($res);

        if($result){
            return redirect('/admin/user')->with('msg','修改成功');
        }else{
            return redirect('/admin/user')->with('msg','修改失败');
        }

        // dd($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //执行用户的删除
    public function destroy($id)
    {
        // echo "执行删除";
        $res = login::where('id',$id)->delete();

        if($res){
            return redirect('/admin/user');
        }
    }
}
