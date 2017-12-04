<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\uvideo;
use App\Http\model\info;
use App\Http\model\type;
use App\Http\model\udiscuss;
use App\Http\model\uhistory;
use zgldh\QiniuStorage\QiniuStorage;

class UpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //搜索框的设置和分页
        $res = uvideo::where('title','like','%'.$request->input('search').'%')
        ->orderBy('status','asc')
         ->paginate(5);
        return view('/home/center/up',['res'=>$res,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        // 将uid,tid,username存入hidden,然后一并存入uvideo表
        $uid = session('uid');
        $res = info::where('uid',$uid)->first();
        $r=type::where('fid','0')->Where('name','用户上传')->first();
        $ziid=$res['id'];
        $re = type::where('fid',$ziid)->get();
        return view('/home/center/userup',['res'=>$res,'re'=>$re,'r'=>$r]);
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
        //下架删除
        $res = uvideo::where('id',$id)->first();
        $disk->delete('images/'.$res->pic);
        $disk->delete('images/'.$res->url);
        $res->delete();
        udiscuss::where('vid',$res->id)->delete();
        uhistory::where('vid',$res->id)->delete();
        return redirect('/home/up')->with('msg','删除成功');
    }
}
