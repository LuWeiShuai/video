<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\friendlink;

class friendlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         $res = friendlink::where('linkName','like','%'.$request->input('search').'%')->orderBy('id','asc')->paginate($request->input('num',10));

        
        return view('admin.friendlink.list',['res'=>$res,'request'=>$request]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.friendlink.add');

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
            'linkName' => 'required',
            'keywords' => 'required',
            'url' => 'required|regex:/[a-zA-z]+://[^\s]*/'
        ],[
            'linkName.required'=>'链接名称不能为空',
            'keywords.required'=>'关键字不能为空',
            'url.required'=>'链接格式不能为空',
            'url.regex'=>'链接格式不正确'
        ]);

        //去除token
        $res = $request->except('_token');
        //将数据添加到数据库
        $data = friendlink::insert($res);
        //判断
        if ($data) {
            return redirect('/admin/friendlink')->with('msg','添加成功');
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
        $res = friendlink::where('id',$id)->first();

        return view('admin.friendlink.edit',['res'=>$res]);
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

        $data = friendlink::where('id',$id)->update($res);
        
        if ($data) {
            return redirect('/admin/friendlink')->with('msg','修改成功');
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
        //
        $res = friendlink::where('id',$id)->delete();
        
        if ($res) {
            return redirect('/admin/friendlink')->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败');
        }
        
    }
}
