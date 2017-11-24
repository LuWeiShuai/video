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
use zgldh\QiniuStorage\QiniuStorage;



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
        $disk = QiniuStorage::disk('qiniu');

        $res=video::find($id);
        $disk->delete('http://ozssihjsk.bkt.clouddn.com/images/'.$res['logo']);                      //删除文件
        $disk->delete('http://ozssihjsk.bkt.clouddn.com/videos/'.$res['url']);                      //删除文件
        // $disk->delete(['file1.jpg', 'file2.jpg']);   //删除多个文件
        // unlink('./admins/video/upvideo/'.$res['url']);
        // unlink('./admins/video/upload/'.$res['logo']);
        
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
    public function store(Request $request){
       // $file=$request->file('file_upload');
        // $move=$_POST;
        // $move=$_GET;
        $disk = QiniuStorage::disk('qiniu');
       
        $vsuffix = $request->file('file_upload')->getClientOriginalExtension();
        //拼装上传文件的新名字
        $vfileName =date('YmdHis',time()).rand(100000, 999999).'.'.$vsuffix;

        //拼装文件后缀的格式
        $img=array('png','gif','jpg','jpeg','bmp');
        // dd($vsuffix);

        //判断是否是图片文件
        if (in_array($vsuffix,$img)) {
            // return $vsuffix;
            //文件存放到七牛

            //获取缓存文件的路径
            $vonly=$request->file('file_upload')->getRealPath();
            // return $vonly;
            //上传到七牛
            $vbool = $disk->put('images/'.$vfileName,file_get_contents($vonly));  
            //S分段上传（不能用）
            // $vbool=$disk->put('images/'.$vfileName,fopen('http://img0.imgtn.bdimg.com/it/u=953832798,2829610548&fm=27&gp=0.jpg','r+'));
            // return $vbool;die;
            if ($vbool) {
                //把文件名存入数组中
                return $vfileName;
            }
        }else{
            // return $vsuffix;
            //文件存放到七牛

            //获取缓存文件的路径
            $vonly=$request->file('file_upload')->getRealPath();
            // return $vonly;
            // dd($only);
            //上传到七牛
            $vbool = $disk->put('videos/'.$vfileName,file_get_contents($vonly));  

            //分段上传（不能用）
            // $vbool=$disk->put('videos/'.$vfileName,fopen(file_get_contents($vonly),'r+'));
            if ($vbool) {
                //把文件名存入数组中
                return $vfileName;
            }
        }
        
        

        // return $move;

    }
}
