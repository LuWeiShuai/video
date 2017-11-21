<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function movie($id)
    {

    	if($id == 1){
    		
    	}
	 	
    	return view('home.video.list'); 		
	
    }

}
