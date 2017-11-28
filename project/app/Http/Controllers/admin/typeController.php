<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\type;
use App\Http\model\video;
use DB;

class typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //查询type数据库
         $res = type::all();

        return view('admin.type.list',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'name' => 'required'
        ],[
            'name.required'=>'父分区名不能为空'
        ]);

        $res = $request->only('name');
        //将数据添加到数据库
        $data = type::insert($res);
        //判断
        if ($data) {
            return redirect('/admin/type')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
       
    
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据id执行查询语句
        $res = type::where('id',$id)->first();

        return view('admin.type.edit',['res'=>$res]);
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
        //去除'_token','updated_at','_method'属性
       $res = $request->except(['_token','updated_at','_method']);
       //根据id执行修改
        $data = type::where('id',$id)->update($res);
        //判断数据库是否更改成功
        if ($data) {
            return redirect('/admin/type')->with('msg','修改成功');
        }else{
            return back()->with('msg','修改失败');
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
        //根据id执行删除语句
         $res = type::where('id',$id)->delete();
        //判断数据库是否删除成功
        if ($res) {
            return redirect('/admin/type')->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
    }
}
