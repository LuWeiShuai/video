<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use session;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\uvideo;
use App\Http\model\vdetail;
use App\Http\model\discuss;
use App\Http\model\udiscuss;
use App\Http\model\info;
use App\Http\model\login;
use App\Http\model\history;
use App\Http\model\money;
use App\Http\model\uhistory;

class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //父分区列表
    public function video($id)
    {
		$res = type::where('fid',$id)->get();
        $res3 = type::where('id',$id)->first();
        $name = $res3->name;
        if($name != '用户上传'){
    		$tid=[];
    		foreach ($res as $key => $val) {

    			$tid[]= $val->id;
            }
            $res1 = video::whereIn('tid',$tid)->where('status','1')->get();
            // var_dump($res1);
    	    return view('home.video.list',['res1'=>$res1,'name'=>$name]);
        }else{
            $tid=[];
            foreach ($res as $key => $val) {

                $tid[]= $val->id;
            }
            $res1 = uvideo::whereIn('tid',$tid)->where('status','1')->get();
            // var_dump($res1);
            return view('home.video.list',['res1'=>$res1,'name'=>$name]);
        } 			
    }
    //子分区 列表
    public function type($id)
    {
        // echo $id;
        $res = type::where('id',$id)->first();
        $name = $res->name;
        $res2 = type::where('id',$res->fid)->first();

        $fname =$res2->name;
        if($fname != '用户上传'){
            $res1 = video::where('tid',$id)->where('status','1')->get();
            return view('home.video.type',['name'=>$name,'fname'=>$fname,'res'=>$res1]);
        }else{
            $res1 = uvideo::where('tid',$id)->where('status','1')->get();
            return view('home.video.type',['name'=>$name,'fname'=>$fname,'res'=>$res1]);
        }
    }

    //视频播放页面
    public function play($id)
    {
        if(session('uid')){
            $uid = session('uid'); 
            $user = login::where('id',$uid)->first();
            //获取用视频观看权限
            $userAuth = $user->status;
        }

        $res = video::where('id',$id)->first();
        //视频的权限
        $auth = $res->auth;
        //排行榜
        $tid = $res->tid;
        $type = type::where('id',$tid)->first();
        $fid = $type->fid;
        $res5 = type::where('fid',$fid)->get();
        $tid = [];
        foreach ($res5 as $key => $val) {

            $tid[]= $val->id;
        }
        $res6 = video::whereIn('tid',$tid)->orderby('num','desc')->get();
        //普通视频
        if($auth == 0 ){
           //点击量 
            $arr = [];       
            $arr['num'] = $res->num;
            $arr['num'] += 1;
            video::where('id',$id)->update($arr);

            //存历史记录
            if(session('uid')){
                $res4 = history::where('uid',$uid)->get();
                $video_id = [];
                foreach ($res4 as $k => $v){
                    $video_id[] = $v->vid;
                    if($id == $v->vid){
                        $id1 = $v->id;
                    }
                }
                if(in_array($id,$video_id)){
                    $data = [];
                    $data['time'] = date('Y-m-d H:i:s',time());
                    history::where('id',$id1)->update($data);
                }else{
                    $his = [];
                    $his['uid'] = $uid;
                    $his['vid'] = $id;
                    $his['title'] = $res->title;
                    $his['time'] = date('Y-m-d H:i:s',time());
                    $his['url'] =$res->url;
                    $his['logo'] = $res->logo;

                    history::insert($his);               
                }
            }
             //评论
            $res1 = discuss::where('vid',$id)->get();
            
            return view('home.video.play',['res'=>$res,'res1'=>$res1,'res6'=>$res6]);
        }

        //vip视频
        if($auth == 1 ){
            if(!session('uid')){
                return back()->with('msg','请先登录在观看vip视频');;
            }else{
                if($userAuth != 1){
                    return back()->with('msg','请先开通vip在观看');
                }else{
                    //点击量 
                    $arr = [];       
                    $arr['num'] = $res->num;
                    $arr['num'] += 1;
                    video::where('id',$id)->update($arr);

                    //存历史记录
                    $res4 = history::where('uid',$uid)->get();                    
                    $video_id = [];
                    foreach ($res4 as $k => $v){
                        $video_id[] = $v->vid;
                          if($id == $v->vid){
                            $id1 = $v->id;
                        }
                    }

                    if(in_array($id,$video_id)){
                        $data = [];
                        $data['time'] = date('Y-m-d H:i:s',time());
                        history::where('id',$id1)->update($data);
                    }else{
                        $his = [];
                        $his['uid'] = $uid;
                        $his['vid'] = $id;
                        $his['title'] = $res->title;
                        $his['time'] = date('Y-m-d H:i:s',time());
                        $his['url'] =$res->url;
                        $his['logo'] = $res->logo;

                        history::insert($his);               
                    }

                     

                     //评论
                    $res1 = discuss::where('vid',$id)->get();
                    
                    return view('home.video.play',['res'=>$res,'res1'=>$res1,'res6'=>$res6]);
                }
            }
        }
        //查看该用户是否购买过此视频
        $money = money::where('uid',session('uid'))->where('vid',$id)->first();
        //付费视频
        if($auth == 2 ){
            if(!session('uid')){
                return back()->with('msg','请先登录在观看付费视频');;
            }else{
                if(!$money){
                    return redirect("/home/center/money/{$id}")->with('msg','请先购买此视频在观看');
                }else{
                    //点击量 
                    $arr = [];       
                    $arr['num'] = $res->num;
                    $arr['num'] += 1;
                    video::where('id',$id)->update($arr);

                    //存历史记录
                    $res4 = history::where('uid',$uid)->get();
                    $video_id = [];
                    foreach ($res4 as $k => $v){
                        $video_id[] = $v->vid;
                        if($id == $v->vid){
                            $id1 = $v->id;
                        }
                    }
                    if(in_array($id,$video_id)){
                        $data = [];
                        $data['time'] = date('Y-m-d H:i:s',time());
                        history::where('id',$id1)->update($data);
                    }else{
                        $his = [];
                        $his['uid'] = $uid;
                        $his['vid'] = $id;
                        $his['title'] = $res->title;
                        $his['time'] = date('Y-m-d H:i:s',time());
                        $his['url'] =$res->url;
                        $his['logo'] = $res->logo;

                        history::insert($his);               
                    }

                     //评论
                    $res1 = discuss::where('vid',$id)->get();
                    
                    return view('home.video.play',['res'=>$res,'res1'=>$res1,'res6'=>$res6]);
                }
            }
        }      
    }

    //视频评论
    public function discuss(Request $request)
    {

       if(session('uid')){
            $dis = $_POST['dis'];
            if($dis){
                $data = [];
                $title = $_POST['title'];
                $res = video::where('title',$title)->first();
                $data['vid'] = $res->id;
                $data['uid'] =session('uid');
                $data['time'] = $_POST['time'];
                $data['content'] = $dis;           
                $res = discuss::insert($data);
                if($res){
                    return '评论成功';
                }
            }else{
                return '评论失败';
            }
        }else{
            return '请先登录再评论';
        }          
    }
    //用户视频播放
    public function user_play($id)
    {
        $res = uvideo::where('id',$id)->first();
        //点击量 
        $arr = [];       
        $arr['num'] = $res->num;
        $arr['num'] += 1;
        uvideo::where('id',$id)->update($arr);
        if(session('uid')){
            $uid = session('uid');
          //存历史记录
            $res4 = uhistory::where('uid',$uid)->get();
            $video_id = [];
            foreach ($res4 as $k => $v){
                $video_id[] = $v->vid;
                if($id == $v->vid){
                    $id1 = $v->id;
                }
            }
            if(in_array($id,$video_id)){
                $data = [];
                $data['time'] = date('Y-m-d H:i:s',time());
                uhistory::where('id',$id1)->update($data);
            }else{
                $his = [];
                $his['uid'] = session('uid');
                $his['vid'] = $id;
                $his['title'] = $res->title;
                $his['time'] = date('Y-m-d H:i:s',time());
                $his['url'] =$res->url;
                $his['logo'] = $res->pic;

                uhistory::insert($his); 
            } 
        }

        //排行榜
        $res1 = uvideo::where('status',1)->orderby('num','desc')->get();

        // //评论
        $res3= udiscuss::where('vid',$id)->get();
       
        return view('home.video.user_play',['res'=>$res,'res1'=>$res1,'res3'=>$res3]);
    }

     //用户视频评论
    public function user_discuss(Request $request)
    {
        // var_dump($_POST);
       if(session('uid')){
            $dis = $_POST['dis'];
            if($dis){
                $data = [];
                $title = $_POST['title'];
                $res = uvideo::where('title',$title)->first();
                $data['vid'] = $res->id;
                $data['uid'] =session('uid');
                $data['time'] = $_POST['time'];
                $data['content'] = $dis;           
                $res = udiscuss::insert($data);
                if($res){
                    return '评论成功';
                }
            }else{
                return '评论失败';
            }
        }else{
            return '请先登录再评论';
        }         
    }
}
