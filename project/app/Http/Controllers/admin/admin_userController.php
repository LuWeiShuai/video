<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\admin; 
use zgldh\QiniuStorage\QiniuStorage;


class admin_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $res = admin::paginate(3);
         $res = admin::where('username','like','%'.$request->input('search').'%')
         ->orderBy('id','asc')
         ->paginate($request->input('num',10));

        return view('admin.admin_user.list',['res'=>$res,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //执行头像的上传
    public function store(Request $request)
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
        
        if ($vbool) {
            //把文件名存入数组中
            return $vfileName;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = admin::where('id',$id)->first();

        return view('admin.admin_user.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res = $request->except('_token','_method');

        // dd($res);
        $result = admin::where('id',$id)->update($res);

        if($result){
            return redirect('/admin/admin_user')->with('msg','修改成功');
        }else{
            return redirect('/admin/admin_user')->with('msg','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = admin::where('id',$id)->delete();

        if($res){
            return redirect('/admin/admin_user');
        }
    }
}
