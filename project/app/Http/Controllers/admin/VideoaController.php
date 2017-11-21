<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\vdetail;
use App\Http\model\discuss;
use App\Http\model\replay;
use App\Http\model\money;
use App\Http\model\history;


class VideoaController extends Controller
{
    //
    public function index()
    {
    	$fid=$_GET['fid'];
    	$ziid=type::where('fid',$fid)->get();

    	return json_encode($ziid);

    }
    public function shan()
    {
    	$id=$_GET['id'];
    	// $disc=discuss::find($id);
    	// $did=$disc['']
    	replay::where('did',$id)->delete();
    	$del=discuss::where('id',$id)->delete();
    	if ($del) {
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
    public function delete($id){
        // $id=$_GET('id');
        $res=video::find($id);
        // unlink('./admins/video/upvideo/'.$res['url']);
        unlink('./admins/video/upload/'.$res['logo']);
        
        // unlink();
        // dd($res);
        video::where('id',$id)->delete();
        vdetail::where('vid',$id)->delete();
        discuss::where('vid',$id)->delete();
        replay::where('vid',$id)->delete();
        money::where('vid',$id)->delete();
        history::where('vid',$id)->delete();
        return redirect('/admin/video/huishou');
    }
    public function upload($id){
        $res=[];
        $res['status']='1';
        $up=video::where('id', $id)->update($res);
        return redirect('/admin/video/huishou');
    }
    public function huishou(Request $request){
       //根据查询条件进行分页查询
        $res=video::where('status','0')->where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->paginate(3);
        //定义一个空数组
        $cres=[];
        //遍历查询到的数据
        foreach ($res as $key => $value) {
            $vid=$value->id;
            // var_dump($vid);
            //根据查询的vid进行查询并逐个存入创建的新数组中
            $detail=vdetail::where('vid',$vid)->first();
            // dd($detail);
            $cres[$key]=$detail;
        }
        return view('/admin/video/huishou',['res'=>$res,'cres'=>$cres]);

    }
}
