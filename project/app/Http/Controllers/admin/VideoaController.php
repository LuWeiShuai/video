<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
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
use Illuminate\Support\Facades\Redis;




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
        $listKey = 'LIST:VIDEO:ADMIN';
        $hashKey = 'HASH:VIDEO:ADMIN:';
        $disk = QiniuStorage::disk('qiniu');



        $listKey = 'LIST:VIDEO:ADMIN';
        $hashKey = 'HASH:VIDEO:ADMIN:';
        Redis::hdel($hashKey.$id,'id');
        Redis::hdel($hashKey.$id,'tid');
        Redis::hdel($hashKey.$id,'url');
        Redis::hdel($hashKey.$id,'logo');
        Redis::hdel($hashKey.$id,'title');
        Redis::hdel($hashKey.$id,'level');
        Redis::hdel($hashKey.$id,'num');
        Redis::hdel($hashKey.$id,'auth');
        Redis::hdel($hashKey.$id,'status');
        Redis::hdel($hashKey.$id,'vid');
        Redis::hdel($hashKey.$id,'actor');
        Redis::hdel($hashKey.$id,'content');
        Redis::hdel($hashKey.$id,'address');
        Redis::hdel($hashKey.$id,'time');

        Redis::lrem($listKey,1,$id);
        // dd($id);
        // $list=Redis::hdelall($listKey,$id);
        $res=video::where('id',$id)->first();
        // dd($res);
        $disk->delete('images/'.$res['logo']);                      //删除文件
        $disk->delete('videos/'.$res['url']);                      //删除文件
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
        $hashKey = 'HASH:VIDEO:ADMIN:';
// dd($id);
        Redis::hmset($hashKey.$id,'status','1');

        $res=[];
        $res['status']='1';
        $up=video::where('id', $id)->update($res);
        return redirect('/admin/video/huishou');
    }
    public function huishou(Request $request){
        
        if (!empty($request->input('cha'))) {
            $cha=$request->input('cha');
            //根据查询条件进行分页查询
            $res=video::where('status','0')->where('title','like','%'.$cha.'%')->orderBy('id','asc')->paginate(3);
            //定义一个空数组
            // dd($res);
            $cres=[];
            //遍历查询到的数据
            foreach ($res as $key => $value) {
                $vid=$value->id;
                // var_dump($vid);
                //根据查询的vid进行查询并逐个存入创建的新数组中
                $detail=vdetail::where('vid',$vid)->first();
                $cres[$key]=$detail;
            }
            // dd($cres);
             return view('/admin/video/huishou',['res'=>$res,'cres'=>$cres,'aaa'=>0]);
        }else{
        

                $listKey = 'LIST:VIDEO:ADMIN';
                $hashKey = 'HASH:VIDEO:ADMIN:';
                // 查看key是否存在？ 
                if(empty(Redis::exists($listKey))){
                    // 如果Redis不存在 读数据库然后写入redis
                    // $where = ['status'=>'1'];
                    $obj = video::where('title','like','%'.$request->input('cha').'%')->orderBy('id','asc')->get();
                    // $array = $this->objectToArray($obj);
                    // dd($obj);
                    
                    // $list=[];
                    foreach($obj as $key=>$v){
                        $vid=$v->id;
                        // echo $vid;
                        // Redis::hset('?');
                        // var_dump($vid);
                        //根据查询的vid进行查询并逐个存入创建的新数组中
                        $detail=vdetail::where('vid',$vid)->first();
                        // $cres[$key]=$detail;
                        // \Redis::rpush($listKey,$v->id);

                        
                        Redis::hMset($hashKey.$v->id,'id',$v->id);
                        Redis::hMset($hashKey.$v->id,'tid',$v->tid);
                        Redis::hMset($hashKey.$v->id,'auth',$v->auth);
                        Redis::hMset($hashKey.$v->id,'status',$v->status);
                        Redis::hMset($hashKey.$v->id,'url',$v->url);
                        Redis::hMset($hashKey.$v->id,'logo',$v->logo);
                        Redis::hMset($hashKey.$v->id,'title',$v->title);
                        Redis::hMset($hashKey.$v->id,'level',$v->level);
                        Redis::hMset($hashKey.$v->id,'num',$v->num);
                        Redis::hMset($hashKey.$v->id,'vid',$detail['vid']);
                        Redis::hMset($hashKey.$v->id,'actor',$detail['actor']);
                        Redis::hMset($hashKey.$v->id,'content',$detail['content']);
                        Redis::hMset($hashKey.$v->id,'address',$detail['address']);
                        Redis::hMset($hashKey.$v->id,'time',$detail['time']);

                        $list = Redis::lrange($listKey,0,-1);

                        if (!in_array($v->id, $list)) {
                            Redis::rpush($listKey,$v->id);
                        }

                        // \Redis::rpush($listKey.$key,$cres);

                        // $redis->hset('key'.$key,$cres);
                    }
                   
                }
                //取数据
                $list = Redis::lrange($listKey,0,-1);
                $array=[];
                foreach($list as $k=>$v){
                    // 取出哈希里的数据写入大数组中
                    // echo $v;
                    $tiqu=Redis::hGetall($hashKey.$v);
                    if ($tiqu['status']==0) {
                        $array[$k] = Redis::hGetall($hashKey.$v);
                    }
                    
                }
                // dd($array);


                //根据从redis中查到的数据进行分页
                
                $perPage = 3;
                if ($request->has('page')) {
                        $current_page = $request->input('page');
                        $current_page = $current_page <= 0 ? 1 :$current_page;
                } else {
                        $current_page = 1;
                }

                $item = array_slice($array, ($current_page-1)*$perPage, $perPage); //注释1
                $total = count($array);

                $paginator =new LengthAwarePaginator($item, $total, $perPage, $current_page, [
                        'path' => Paginator::resolveCurrentPath(),  //注释2
                        'pageName' => 'page',
                ]);

                $userlist = $paginator->toArray()['data'];
                return view('/admin/video/huishou',['res'=>$userlist,'paginator'=>$paginator,'aaa'=>1]);

        // dd($paginator);
        }
    }
    public function store(Request $request){
       // $file=$request->file('file_upload');
        // $move=$_POST;
        // $move=$_GET;
        $disk = QiniuStorage::disk('qiniu');
       
        $vsuffix = $request->file('file_upload')->getClientOriginalExtension();
        //拼装上传文件的新名字
        $vfileName =date('YmdHis',time()).rand(100000, 999999).'.'.$vsuffix;

        //将获取的后缀名变成小写
        // $vsuffix=strtolower($vsuffix);
        //拼装文件后缀的格式
        $img=array('png','gif','jpg','jpeg','bmp');
        // return $vsuffix;

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
