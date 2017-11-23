<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\config;

class configController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        //更改logo的变量
        $res = config::all();
        
        return view('admin.config.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        /*var_dump($request);
        die;*/
        $re = $request->except('_token','_method','logo','MAX_FILE_SIZE');
        if($request->hasFile('logo')){
            //重命名
            $name = rand(1111,9999).time();
            //获取后缀
            $suffix = $request->file('logo')->getClientOriginalExtension();
            $type = array('jpeg','gif','png','jpg','bmp');
            if(in_array($suffix,$type)){
                $request->file('logo')->move('./admins/logos',$name.'.'.$suffix);
                $re['logo'] = $name.'.'.$suffix;
            }
        }

        $old = config::where('id',$id)->first();
      
        $res = config::where('id',$id)->update($re);
        if($res){
            unlink('./admins/logos/'.$old->logo);
               
        }

        return redirect('/admin/config');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
