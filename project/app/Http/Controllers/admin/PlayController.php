<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\uvideo;

class PlayController extends Controller
{
    public function index($id){

    	$res = uvideo::where('id',$id)->first();
    	$re = uvideo::get();
    	return view('/admin/user/play',['res'=>$res,'re'=>$re]);
    }
}
