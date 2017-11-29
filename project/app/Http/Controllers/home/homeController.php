<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\uvideo;
use App\Http\model\vdetail;
use App\Http\model\config;


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
    	 foreach ($type as $key => $value) 
         {
    	 	
            if ($value->id!=16) {
                $num='';
                $zitype=type::where('fid',$value->id)->get();
                foreach ($zitype as $k => $v) {
                    // dd($key);
                    // echo $v->id;
                    $num.=$v->id.',';
                }
                $num=rtrim($num,',');
                $num=explode(',',$num);
                // dd($num);
            }
            $fid[$key]=$num;
    	}
        // dd($fid);
        $video=video::where('status','1')->get();
    	$uvideo=uvideo::where('status','1')->get();
    	 $vdetail=[];
    	 foreach ($video as $key => $value) {
    		$vid=$value->id;
    		$vd=vdetail::where('vid',$vid)->first();
    		$vdetail[$key]=$vd;
    	}
        // dd($vdetail);
    	// dd($vdetail);
    	// dd($fid);
    	return view('home.index',['type'=>$type,'video'=>$video,'fid'=>$fid,'vdetail'=>$vdetail,'uvideo'=>$uvideo]);
    }

}