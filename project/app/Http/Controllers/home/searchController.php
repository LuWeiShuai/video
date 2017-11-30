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
    		$textname=$request->only('cha')['cha'];
	    	//=========管理员上传的视频===================
	    	//根据查询条件进行分页查询
	        $res=video::where('status','1')->where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->paginate(20);
	        $count = count($res);//这是计算搜索出来的一个数量，因为搜索的关键字不可能是一个，也许是多个
	        for ($i=0; $i <$count ; $i++) {
		        //这里直接用PHP一个函数搞定了str_replace函数第一个参数是要搜索的字符串，第二个要替换的，第三个被搜索的字符串
		        $res[$i]->title = str_replace($textname,"<span style='color:red; font-size: 16px;'>".$textname ."</span>",$res[$i]->title);
		    }
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
	        $ucount = count($ures);//这是计算搜索出来的一个数量，因为搜索的关键字不可能是一个，也许是多个
	        for ($i=0; $i <$ucount ; $i++) {
		        //这里直接用PHP一个函数搞定了str_replace函数第一个参数是要搜索的字符串，第二个要替换的，第三个被搜索的字符串
		        $ures[$i]->title = str_replace($textname,"<span style='color:red; font-size: 16px;'>".$textname ."</span>",$ures[$i]->title);
		    }
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
