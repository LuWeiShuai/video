<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use session;
use App\Http\model\type;
use App\Http\model\video;
use App\Http\model\vdetail;
use App\Http\model\discuss;
use App\Http\model\info;
use App\Http\model\login;
use App\Http\model\history;
use App\Http\model\money;


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
		$tid=[];
		foreach ($res as $key => $val) {

			$tid[]= $val->id;
        }
        $res1 = video::whereIn('tid',$tid)->get();
        // var_dump($res1);
	   return view('home.video.list',['res1'=>$res1,'name'=>$name]); 			
    }
    //子分区 列表
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

        //普通视频
        if($auth == 0 ){
           //点击量 
            $arr = [];       
            $arr['num'] = $res->num;
            $arr['num'] += 1;
            video::where('id',$id)->update($arr);

            //存历史记录
            $res4 = history::where('vid',$id)->first();
            if($res4){
                $data = [];
                $data['time'] = date('Y-m-d H:i:s',time());
                history::where('id',$res4->id)->update($data);
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
            
            return view('home.video.play',['res'=>$res,'res1'=>$res1]);
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
                    $res4 = history::where('vid',$id)->first();
                    if($res4){
                        $data = [];
                        $data['time'] = date('Y-m-d H:i:s',time());
                        history::where('id',$res4->id)->update($data);
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
                    
                    return view('home.video.play',['res'=>$res,'res1'=>$res1]);
                }
            }
        }
        //查看该用户是否购买过此视频
        $money = money::where('vid',$id)->first();
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
                    $res4 = history::where('vid',$id)->first();
                    if($res4){
                        $data = [];
                        $data['time'] = date('Y-m-d H:i:s',time());
                        history::where('id',$res4->id)->update($data);
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
                    
                    return view('home.video.play',['res'=>$res,'res1'=>$res1]);
                }
            }
        }      
    }

    //视频评论
    public function discuss(Request $request)
    {

       if(session('uid')){
            $data = [];
            $title = $_POST['title'];
            $dis = $_POST['dis'];
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

    }
}
