<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use zgldh\QiniuStorage\QiniuStorage;



class VideoaController extends Controller
{
  
    
    public function store(Request $request){
       // $file=$request->file('file_upload');
        // $move=$_POST;
        // $move=$_GET;
        $disk = QiniuStorage::disk('qiniu');
       
        $vsuffix = $request->file('file_upload')->getClientOriginalExtension();
        //拼装上传文件的新名字
        $vfileName =date('YmdHis',time()).rand(100000, 999999).'.'.$vsuffix;
            // return $vfileName;
        
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
