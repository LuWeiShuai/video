<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\config;

class configController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        //更改logo的变量
        $res = config::all();
        
        return view('admin.config.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            //获取收到的值
        $re = $request->except('_token','_method','logo','MAX_FILE_SIZE');
        if($request->hasFile('logo')){
            //给图片重命名
            $name = rand(1111,9999).time();
            //获取图片后缀
            $suffix = $request->file('logo')->getClientOriginalExtension();
            $type = array('jpeg','gif','png','jpg','bmp');
            //如果后缀在这个数组里边则存入
            if(in_array($suffix,$type)){
                $request->file('logo')->move('./admins/logos',$name.'.'.$suffix);
                $re['logo'] = $name.'.'.$suffix;
            }
        }
            //提取上一个图片
        $old = config::where('id',$id)->first();
            //将图片更新
        $res = config::where('id',$id)->update($re);
            //如果图片不是默认则删除,是默认则不删除
        // if($res && $old->logo != "moren.png"){
        //     unlink('./admins/logos/'.$old->logo);
        // }

        return redirect('/admin/config')->with('msg','操作成功');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
