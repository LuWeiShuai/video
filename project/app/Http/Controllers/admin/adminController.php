<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\model\config;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    //

    public  function index()
    {
        //更改logo的变量
    	$re = config::first();
    
    	return view("admin.index",['re'=>$re]);
    }

    public function exit(Request $request)
    {

    	// unset(session('id'));
    	$request->session()->flush();

    	return redirect('/admin_login');
    }
}
