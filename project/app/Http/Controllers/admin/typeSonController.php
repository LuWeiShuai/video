<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\type;

class typeSonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = type::all();
        
        $res1 = type::where('fid','=','$res[0]->id')->first();

        return view('admin.type.list',['res'=>$res],['res1'=>$res1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = type::all();
        
        $res1 = type::where('fid','=','0')->get();
        
        return view('admin.type.addSon',['res'=>$res],['res1'=>$res1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $res = type::all();
        
        $res1 = type::where('fid','=','0')->get();

        //表单验证
        $this->validate($request, [
            'name' => 'required'
        ],[
            'name.required'=>'子分区名不能为空'
        ]);
        //获取name属性
        $res2 = $request->only('name');

        //获取父类name
        $fname = $request->only('fname');

        //根据父类name查询出fid
        $res3 = type::where('name','=',$fname)->get();

        //fid
        $fid = $res3[0]->id;
        //将fid插入$res2
        $res2['fid']=$fid;

        //将数据添加到数据库
        $data = type::insert($res2);
        //判断
        if ($data) {
            return redirect('/admin/type')->with('msg','添加成功');
        }else{
            return back();
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
        $res = type::where('id',$id)->first();

        return view('admin.type.editSon',['res'=>$res]);
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
         $res = $request->except(['_token','updated_at','_method']);

        $data = type::where('id',$id)->update($res);
        
        if ($data) {
            return redirect('/admin/type')->with('msg','修改成功');
        }else{
            return back();
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
       $res = type::where('id',$id)->delete();
        
        if ($res) {
            return redirect('/admin/type')->with('msg','删除成功');
        }else{
            return back();
        }
    }
}
