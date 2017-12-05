<?php

namespace App\Http\Controllers\admin;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\model\video;
use App\Http\model\vdetail;
use App\Http\model\type;
use App\Http\model\discuss;
use App\Http\model\info;
use App\Http\model\history;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use zgldh\QiniuStorage\QiniuStorage;
use Illuminate\Support\Facades\Redis;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request)
    {
        // return $request;
        //
        // echo "string";
        
        if (!empty($request->input('cha'))) {
            $cha=$request->input('cha');
            //根据查询条件进行分页查询
            $res=video::where('status','1')->where('title','like','%'.$cha.'%')->orderBy('id','asc')->paginate(3);
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
             return view('/admin/video/list',['res'=>$res,'cres'=>$cres,'aaa'=>0]);
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
                $array = [];
                foreach($list as $k=>$v){
                    // 取出哈希里的数据写入大数组中
                    // echo $v;
                    $tiqu=Redis::hGetall($hashKey.$v);
                    if ($tiqu['status']==1) {
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
                return view('/admin/video/list',['res'=>$userlist,'paginator'=>$paginator,'aaa'=>1]);

        // dd($paginator);
        }
        // $cres=vdetail::where('vid',$res['id'])->get();
        // return view('/admin/video/list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //根据父id进行查询
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
        $listKey = 'LIST:VIDEO:ADMIN';
        $hashKey = 'HASH:VIDEO:ADMIN:';
        // dd($request->all());
        //获取除去token之外的所有值
        $res=$request->except(['_token']);
       
        // dd($res);
        //定义一个新数组，把获取到的内容存入新定义的数组中
        $vres=[];
        $vres['tid']=$res['zitid'];
        $vres['auth']=$res['auth'];
        $vres['status']=$res['status'];
        $vres['logo']=$res['tp'];
        $vres['url']=$res['sp'];
        $vres['title']=$res['title'];
        $vres['level']='0';
        $vres['num']='0';
        video::insert($vres);
        // dd($a);
        //根据url查询添加新数据的vid
        $fir=video::where('url',$res['sp'])->first();
        // dd($fir);
        $vid=$fir->id;
        //定义一个新数组，把获取到的内容存入新定义的数组中
        $cres=[];
        $cres['vid']=$vid;
        $cres['actor']=$res['actor'];
        $cres['content']=$res['content'];
        $cres['address']=$res['address'];
        $cres['time']=$res['time'];
        vdetail::insert($cres);
        // var_dump($fir);
        
        Redis::hMset($hashKey.$vid,'id',$vid);
        Redis::hMset($hashKey.$vid,'tid',$vres['tid']);
        Redis::hMset($hashKey.$vid,'auth',$vres['auth']);
        Redis::hMset($hashKey.$vid,'status',$vres['status']);
        Redis::hMset($hashKey.$vid,'url',$vres['url']);
        Redis::hMset($hashKey.$vid,'logo',$vres['logo']);
        Redis::hMset($hashKey.$vid,'title',$vres['title']);
        Redis::hMset($hashKey.$vid,'level',$vres['level']);
        Redis::hMset($hashKey.$vid,'num',$vres['num']);
        Redis::hMset($hashKey.$vid,'vid',$cres['vid']);
        Redis::hMset($hashKey.$vid,'actor',$cres['actor']);
        Redis::hMset($hashKey.$vid,'content',$cres['content']);
        Redis::hMset($hashKey.$vid,'address',$cres['address']);
        Redis::hMset($hashKey.$vid,'time',$cres['time']);
        Redis::rpush($listKey,$vid);


        
        // dd( $fir->id);
        return redirect('/admin/video');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //评论管理页面
    public function show($id)
    {
        //
        $vres=video::find($id);

        $cres=vdetail::where('vid',$id)->first();

        $res=discuss::where('vid',$vres['id'])->paginate(10);
        // dd($res);
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
        $listKey = 'LIST:VIDEO:ADMIN';
        $hashKey = 'HASH:VIDEO:ADMIN:';

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

        $history=[];
        $history['title']=$res['title'];
        vdetail::where('vid', $id)->update($cres);
        video::where('id', $id)->update($vres);
        history::where('vid', $id)->update($history);
        // vdetail::where('vid', $id)->update($cres);
        $redis=Redis::lrange($listKey,0,-1);
        
        foreach ($redis as $value) {
            if ($id==$value) {
                // dd($cres['content']);
                // $hash=Redis::hgetall($hashKey.$id);
                Redis::hMset($hashKey.$id,'tid',$vres['tid']);
                Redis::hMset($hashKey.$id,'auth',$vres['auth']);
                Redis::hMset($hashKey.$id,'title',$vres['title']);
                Redis::hMset($hashKey.$id,'content',$cres['content']);
                Redis::hMset($hashKey.$id,'actor',$cres['actor']);
                Redis::hMset($hashKey.$id,'address',$cres['address']);
            }
        }
        

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

        $hashKey = 'HASH:VIDEO:ADMIN:';
        Redis::hmset($hashKey.$id,'status','0');

        // echo $id;
        $res=[];
        $res['status']='0';

        video::where('id', $id)->update($res);
        return redirect('/admin/video');
    }
}
