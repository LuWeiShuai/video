<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    //

    public  function index()
    {
    	
    	return view("admin.index");
    }

    public function exit(Request $request)
    {

    	// unset(session('id'));
    	$request->session()->flush();

    	return redirect('/admin_login');
    }
}
