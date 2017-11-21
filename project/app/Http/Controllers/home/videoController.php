<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\vdetail;


class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function video($id)
    {
		$res = type::where('fid',$id)->get();
        $res3 = type::where('id',$id)->first();
        $name = $res3->name;
		$tid=[];
		foreach ($res as $key => $val) {

			$tid[]= $val->id;
        }
        $res1 = video::whereIn('tid',$tid)->get();
        // var_dump($res1);
	   return view('home.video.list',['res1'=>$res1,'name'=>$name]); 			
    }

    public function type($id)
    {
        // echo $id;
        $res = type::where('id',$id)->first();
        $name = $res->name;
        $res2 = type::where('id',$res->fid)->first();

        $fname =$res2->name;
        $res1 = video::where('tid',$id)->get();
        return view('home.video.type',['name'=>$name,'fname'=>$fname,'res'=>$res1]); 
    }

}
