<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\model\video;
use App\Http\model\vdetail;
use App\Http\model\type;
use App\Http\model\discuss;
use App\Http\model\info;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // echo "string";
        //根据查询条件进行分页查询
        $res=video::where('status','1')->where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->paginate(3);
        //定义一个空数组
        $cres=[];
        //遍历查询到的数据
        foreach ($res as $key => $value) {
            $vid=$value->id;
            // var_dump($vid);
            //根据查询的vid进行查询并逐个存入创建的新数组中
            $detail=vdetail::where('vid',$vid)->first();
            $cres[$key]=$detail;
        }
        // dd($res);

/*
        // 定义Redis的key
        $listKey = 'LIST:TEST:ADMIN';
        $hashKey = 'HASH:TEST:ADMIN:';

        // 查看key是否存在？
        if(empty(\Redis::exists($listKey))){
            // 如果Redis不存在 读数据库然后写入redis
            // $where = ['status'=>'1'];
            $obj = video::where('status','1')->where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->paginate(3);
            // $array = $this->objectToArray($obj);
            // 遍历时写入Redis list为索引 hash为数据
            

            foreach($obj as $key=>$v){
                $vid=$v->id;
                // var_dump($vid);
                //根据查询的vid进行查询并逐个存入创建的新数组中
                $detail=vdetail::where('vid',$vid)->first();
                $cres[$key]=$detail;
                \Redis::rpush($listKey,$v->id);

                \Redis::hMset($hashKey,$v);

                \Redis::rpush($listKey.$key,$cres);

                \Redis::hMset($hashKey.$key,$cres);
                // dd($v);
            }
            


           
            // dd($obj);
            // return $array;
        }*/
        //取数据
        // $list = \Redis::lrange($listKey,0,-1);
        // $array = null;
        // 取出哈希里的数据写入大数组中
        // $array[] = \Redis::hGetall($hashKey);
        // dd($array);
        // dd($list);

        // $cres=vdetail::where('vid',$res['id'])->get();
        // return view('/admin/video/list');
        return view('/admin/video/list',['res'=>$res,'cres'=>$cres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $res=type::where('fid','0')->get();
        return view('/admin/video/add',compact('res'));
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
        // dd($request->all());
        $res=$request->except(['_token','url','logo']);
        
        // dd($res['zitid']);


        // //检查表单提交的时候是否有文件
        // if ($request->hasFile('url')) {
        //     //获取后缀
        //     $vsuffix = $request->file('url')->getClientOriginalExtension();
        //     //拼接视频的格式
        //     $vsuffixarr=['mp4','flv','wmv','rmvb','mkv','avi','rm','asf','mov','mp3','vod','dat'];
        //     // dd($vsuffix);
        //     //判断获取的后缀是否满足要求
        //     if(in_array($vsuffix, $vsuffixarr)){
        //         //拼装上传文件的新名字
        //         $vfileName =date('YmdHis',time()).rand(100000, 999999).'.'.$vsuffix;
        //         //文件的存放目录 ./代表当前， / 在linux系统下是服务器更目录，在windows系统中是某盘的根目录
        //         //拼接文件路径,将文件存入指定目录
        //         $vpath = './admins/video/upvideo/';
        //         $request->file('url')->move($vpath, $vfileName);
        //         //把文件名存入数组中
        //         $res['url']=$vfileName;
        //     }else{
        //         //当上传格式不正确的时候，返回info info已经存入session中  在页面中直接使用session('info')直接可以取到
        //         return back()->with('into','文件不是视频，请上传格式为mp4/flv/wmv/rmvb/mkv/avi/rm/asf/mov/mp3/vod/dat类型文件');
        //     }
        // }
        //检查表单提交的时候是否有文件
        if ($request->hasFile('logo')) {
            //获取后缀
            $suffix = $request->file('logo')->getClientOriginalExtension();
            
            //拼装有可能上传文件的后缀格式
            $suffixarr=['jpg','png','gif','jpeg','bmp'];
            if(in_array($suffix, $suffixarr)){
                //拼装上传文件的新名字
                $fileName = date('YmdHis',time()).rand(100000, 999999).'.'.$suffix;
                //文件的存放目录 ./代表当前， / 在linux系统下是服务器更目录，在windows系统中是某盘的根目录
                //拼接文件路径
                $path = './admins/video/upload';
                $request->file('logo')->move($path, $fileName);
                //把文件名存入数组中
                $res['logo']=$fileName;
            }else{
                //当上传格式不正确的时候，返回info info已经存入session中  在页面中直接使用session('info')直接可以取到
                return back()->with('info','文件不是视频，请上传格式为jpg/gif/png/jpeg/bmp类型文件');
            }
        }
        //定义一个新数组
        $vres=[];
        $vres['tid']=$res['zitid'];
        $vres['auth']=$res['auth'];
        $vres['status']=$res['status'];
        $vres['logo']=$res['logo'];
        $vres['url']=$res['url'];
        $vres['title']=$res['title'];
        $vres['level']='0';
        video::insert($vres);
        //根据url查询添加新数据的vid
        $fir=DB::table('video')->where('url',$res['url'])->first();
        $vid=$fir->id;
        //定义一个新数组
        $cres=[];
        $cres['vid']=$vid;
        $cres['actor']=$res['actor'];
        $cres['content']=$res['content'];
        $cres['address']=$res['address'];
        $cres['time']=$res['time'];
        vdetail::insert($cres);
        // var_dump($fir);
        
        // dd( $fir->id);
        return redirect('/admin/video');
        
        // $cres['']=$fir->
        // DB::table('users')->first()
        // echo "string";
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
        $vres=video::find($id);
        $cres=vdetail::where('vid',$id)->first();

        $res=discuss::where('vid',$vres['id'])->paginate(10);
        $ures=[];
        foreach ($res as $key => $value) {
            $uid=$value->uid;
            $info=info::where('uid',$uid)->first();

            $ures[$key]=$info;
        }
        // dd($ures);
        // echo "string";
        return view('/admin/video/discuss',['res'=>$res,'vres'=>$vres,'cres'=>$cres,'ures'=>$ures]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        // echo $id;
        $res=video::find($id);
        $vid=$res['id'];
        $tres=type::where('fid','0')->get();
        $cres=vdetail::where('vid',$vid)->first();

        // dd($tres);
        $tid=$res['tid'];
        // dd($tid);
        $type=type::where('id',$tid)->first();
        $fres=type::where('id',$type['fid'])->first();
        // dd($res['id']);
        // dd($cres);
        // dd($fres['name']);
        // dd($tres['fid']);
        return view('/admin/video/edit',['res'=>$res,'cres'=>$cres,'fres'=>$fres,'tres'=>$tres,'type'=>$type]);
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
        //
        // dd($request->all());
        $res=$request->except('_method','_token');
        $vres=[];
        $cres=[];
        // dd($res);
        $vres['tid']=$res['zitid'];
        $vres['auth']=$res['auth'];
        $vres['title']=$res['title'];
        $cres['content']=$res['content'];
        $cres['actor']=$res['actor'];
        $cres['address']=$res['address'];
        vdetail::where('vid', $id)->update($cres);
        video::where('id', $id)->update($vres);
        vdetail::where('vid', $id)->update($cres);
        return redirect('/admin/video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        $res=[];
        $res['status']='0';
        video::where('id', $id)->update($res);
        return redirect('/admin/video');
    }
}
