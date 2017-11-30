<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\uvideo;

class UserUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //将状态为0的视频查询出来,并设置搜索框和分页
        $res = uvideo::where("status",0)
        ->where('username','like','%'.$request->input('search').'%')
        ->orderBy('id','asc')
         ->paginate($request->input('num',10));
         // var_dump($request->input('search'));
        
        return  view('/admin/user/userUpdate',['res'=>$res,'request'=>$request]);
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
            //审核通过
        $res = uvideo::find($id);
        if($res->status == 0){
            $res->status = 1;
            $res->save();        
        }   else {
           echo back();
        }
        return  back();



        // return  redirect('/admin/userup');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //不通过让其status为2  不在后台显示.
        $res = uvideo::find($id);

        if($res->status !== 2){
            $res->status = 2;
            $res->save();
            return redirect('/admin/userup')->with('msg','操作成功');
        }else{
            return redirect('/admin/userup')->with('msg','操作失败');
        }
        
    }
}
