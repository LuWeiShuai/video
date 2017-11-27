<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use session;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\uvideo;
use App\Http\model\vdetail;
use App\Http\model\discuss;
use App\Http\model\info;
use App\Http\model\login;
use App\Http\model\history;
use App\Http\model\money;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	// dd($request->only('cha')['cha']);
    	if ($request->only('cha')['cha']=='') {
    		// dd(1);
	        return view('/home/search',['cha'=>0]);

    	}else {
 			// dd(2);
    	
	    	//=========管理员上传的视频===================
	    	//根据查询条件进行分页查询
	        $res=video::where('status','1')->where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->paginate(20);
	        //定义一个空数组
	        $cres=[];
	        //遍历查询到的数据
	        foreach ($res as $key => $value) {
	            $vid=$value->id;
	            // var_dump($vid);
	            //根据查询的vid进行查询并逐个存入创建的新数组中
	            $detail=vdetail::where('vid',$vid)->first();
	            $cres[$key]=$detail;
	        }
	        // return view('/home/search');

	    	//=========用户上传的视频===================

	        $ures=uvideo::where('status','1')->where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->paginate(15);
	        //定义一个空数组
	        // dd($ures);
	        $info=[];
	        //遍历查询到的数据
	        foreach ($ures as $key => $value) {
	            $uid=$value->uid;
	            // var_dump($vid);
	            // dd($uid);
	            //根据查询的vid进行查询并逐个存入创建的新数组中
	            $in=info::where('uid',$uid)->first();
	            $info[$key]=$in;

	        }
			// dd($res['items']);
			// dd($ures[0]);
	        return view('/home/search',['res'=>$res,'cres'=>$cres,'ures'=>$ures,'info'=>$info,'cha'=>1]);
		}
    }
}
