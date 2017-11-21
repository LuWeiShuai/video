<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\vdetail;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$type=type::where('fid',0)->get();
    	// dd($video);
    	$fid=[];
    	foreach ($type as $key => $value) {
    		$num='';
    		$zitype=type::where('fid',$value->id)->get();
    		foreach ($zitype as $k => $v) {
    			// dd($key);
    			$num.=$v->id.',';
    		}
    		// dd($num);
    		$num=rtrim($num,',');
    		$num=explode(',',$num);
    		$fid[$key]=$num;
    	}
    	$video=video::all();
    	$vdetail=[];
    	foreach ($video as $key => $value) {
    		$vid=$value->id;
    		$vd=vdetail::where('vid',$vid)->first();
    		$vdetail[$key]=$vd;
    	}
    	// dd($vdetail);
    	// dd($fid);
    	return view('home.index',['type'=>$type,'video'=>$video,'fid'=>$fid,'vdetail'=>$vdetail]);
    }

}
