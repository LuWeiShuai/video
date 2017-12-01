@extends('layout/admin')
@section('title','视频管理')

	<meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- <link rel="icon" type="image/png" href="/admins/video/i/favicon.png"> -->
    <!-- <link rel="apple-touch-icon-precomposed" href="/admins/video/i/app-icon72x72@2x.png"> -->
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{ asset('/admins/video/css/amazeui.min.css')}}" />
    <!-- <link rel="stylesheet" href="/admins/video/css/admin.css"> -->
    <link rel="stylesheet" href="{{ asset('/admins/video/css/app.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('/admins/video/css/popuo-box.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('/admins/video/tankuang/payment.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('/admins/video/tankuang/style.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('/admins/video/tankuang/reset.css')}}"> -->
    <style type="text/css">
    	#mws-wrapper {
		    height: auto;
		    min-height: 100%;
		    margin-top: -62px;
		    padding-top: 62px;
		    position: relative;
		    box-sizing: border-box;
		    -moz-box-sizing: border-box;
		    -ms-box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		    background-color:#333338!important;
		    background-image: url(/admins/images/core/mws-dark-bg.png)!important;
		}


        #anniu{
            width: 70px!important;
            margin-left: 10%;
            height: 30px;
            font-size: 18px!important;
            line-height: 10px!important;
            float: left!important;

        }
        .am-btn{
            padding: 0px;
        }
        .jianxi{
            clear: both;
            width: 100%;
            height: 20px!important;
        }
        #seach input,#seach button{
            height: 40px!important;
            line-height: 40px;/*
            padding-left:20px;
            padding-right:20px;*/
            padding: 0px;
        }
        #seach button{
            padding-left:20px;
            padding-right:20px;
        }
        #tianjia{
            height: 40px!important;
            width: 160px;
            font-size: 20px;
        }
        .fenqu{
            float: right;
            width: 40px;
        }
        .ico{
            margin-bottom: -10px;
        }
        .ico i{
            color: red;
            font-size: 20px;
            font-weight:bold;
        }
        #fengmian img{
            height: 250px;
        }
        .pagination{
            display: inline-block;
        }
        .pagination li{
            float: left;
        }
        .pagination li a{
            border-radius: 5px;
            color: #23abf0;
            padding: 6px 12px;
            float: left;

        }
        .pagination > li > a, .pagination > li > span {
            background-color: #fff;
            border: 1px solid #ddd;
            display: block;
            line-height: 1.2;
            margin-bottom: 5px;
            margin-right: 5px;
            position: relative;
            text-decoration: none;
        }
        .tpl-pagination .am-active a {
            background: none repeat scroll 0 0 #23abf0;
            border: 1px solid #23abf0;
            color: #fff;
            padding: 6px 12px;
        }
        .active span{
            /*background: none repeat scroll 0 0 #23abf0;*/
            background-color: #23ABF0!important;
            border: 1px solid #23abf0;
            color: #fff;
            padding: 6px 12px;
            border-radius: 5px;
        }
        .disabled span{
            border-radius: 5px;
            color: #23abf0;
            padding: 6px 12px;
            float: left;
        }
        #mws-user-info{
            height: 40px!important;
        }
    </style>
@section('content')

    @if($aaa==1)
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="icon-monitor"></span> 视频列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    
                </div>
            </div>

            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <a href="{{url('/admin/video/create')}}" style='color:white;'> 
                                    <button type="button" class="am-btn am-btn-default am-btn-success"  id="tianjia"><span class="am-icon-plus"></span>新增
                                    </button>
                                </a>
                                
                                <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-unlock"></span> 审核</button>
                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                            </div>
                        </div>
                    </div>
                            <form action="{{url('/admin/video')}}" method="get">
                    
                    <div class="am-u-sm-12 am-u-md-6" id="seach">
                        <div class="am-input-group am-input-group-sm">
                                    <input type="text" class="am-form-field" name="cha">
                                    <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="submit"></button>
                                    </span>
                        </div>
                    </div>
                            </form>

                </div>
                <div class="jianxi"></div>
                <div class="am-g">
                    <div class="tpl-table-images">
                        @foreach ($res as $key=>$val)
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                            <div class="tpl-table-images-content">
                                <div class="tpl-table-images-content-i-time">发布时间：{{date('Y-m-d',$val['time'])}}
                                
                                    <div class="fenqu">
                                        @if($val['address']==1)内陆
                                        @elseif($val['address']==2)欧美
                                        @elseif($val['address']==3)日韩
                                        @endif
                                    </div>
                                </div>
                                <div class="tpl-i-title">
                                    {{$val['title']}}
                                </div>
                                <div class="tpl-table-images-content-i" id="fengmian">
                                    <div class="tpl-table-images-content-i-info">
                                        <span class="ico">
                                            <i>{{$val['level']}}</i>
                                         </span>
                                    </div>
                                    <span class="tpl-table-images-content-i-shadow"></span>
                                    <img src="http://ozssihjsk.bkt.clouddn.com/images/{{$val['logo']}}" alt="">
                                </div>
                                <div class="tpl-table-images-content-block">
                                    <div class="tpl-i-font" style="height: 80px;">
                                        {!! $val['content'] !!}
                                    </div>
                                    <div class="tpl-i-more">
                                        <ul>
                                            <!-- <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                            <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                            <li><span class="am-icon-github font-green"> 600+</span></li> -->
                                            <a href="{{url('/admin/video/'.$val['id'])}}"><li>查看评论</li></a>
                                            <li>
                                                @if($val['auth']==0)免费
                                                @elseif($val['auth']==1)VIP
                                                @elseif($val['auth']==2)付费
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                            
                                            <a href="{{url('/admin/video/'.$val['id'])}}/edit" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-secondary" id="anniu"><span class="am-icon-edit"></span> 编辑</button></a>

                                            


                                            <form method="post" action="{{url('/admin/video/'.$val['id'])}}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="am-btn am-btn-default am-btn-danger" id="anniu"><span class="am-icon-trash-o"></span>下架</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- 分页的开始 -->
                        <div class="am-u-lg-12">
                            <div class="am-cf">

                                <div class="am-fr">
                                    {!! $paginator->appends($_GET)->render() !!}
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- 分页的结束 -->
                    </div>

                </div>
                
            </div>
            <div class="tpl-alert"></div>
        </div>
    @elseif($aaa==0)
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="icon-monitor"></span> 视频列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">

                </div>
            </div>

            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <a href="{{ url('/admin/video/create')}}" style='color:white;'> 
                                    <button type="button" class="am-btn am-btn-default am-btn-success"  id="tianjia"><span class="am-icon-plus"></span>新增
                                    </button>
                                </a>
                                
                                <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-unlock"></span> 审核</button>
                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                            </div>
                        </div>
                    </div>
                            <form action="{{ url('/admin/video')}}" method="get">
                    
                    <div class="am-u-sm-12 am-u-md-6" id="seach">
                        <div class="am-input-group am-input-group-sm">
                                    <input type="text" class="am-form-field" name="cha">
                                    <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="submit"></button>
                                    </span>
                        </div>
                    </div>
                            </form>

                </div>
                <div class="jianxi"></div>
                <div class="am-g">
                    <div class="tpl-table-images">
                        @foreach ($res as $key=>$val)
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                            <div class="tpl-table-images-content">
                                <div class="tpl-table-images-content-i-time">发布时间：{{date('Y-m-d',$cres[$key]->time)}}
                                
                                    <div class="fenqu">
                                        @if($cres[$key]->address==1)内陆
                                        @elseif($cres[$key]->address==2)欧美
                                        @elseif($cres[$key]->address==3)日韩
                                        @endif
                                    </div>
                                </div>
                                <div class="tpl-i-title">
                                    {{$val->title}}
                                </div>
                                <div class="tpl-table-images-content-i" id="fengmian">
                                    <div class="tpl-table-images-content-i-info">
                                        <span class="ico">
                                            <i>{{$val->level}}</i>
                                         </span>
                                    </div>
                                    <span class="tpl-table-images-content-i-shadow"></span>
                                    <img src="http://ozssihjsk.bkt.clouddn.com/images/{{$val->logo}}" alt="">
                                </div>
                                <div class="tpl-table-images-content-block">
                                    <div class="tpl-i-font" style="height: 80px;">
                                        {!! $cres[$key]->content !!}
                                    </div>
                                    <div class="tpl-i-more">
                                        <ul>
                                            <!-- <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                            <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                            <li><span class="am-icon-github font-green"> 600+</span></li> -->
                                            <a href="{{ url('/admin/video/'.$val->id)}}"><li>查看评论</li></a>
                                            <li>
                                                @if($val->auth==0)免费
                                                @elseif($val->auth==1)VIP
                                                @elseif($val->auth==2)付费
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                            
                                            <a href="{{ url('/admin/video/'.$val->id.'/edit')}}" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-secondary" id="anniu"><span class="am-icon-edit"></span> 编辑</button></a>
                                            <form method="post" action="{{ url('/admin/video/'.$val->id)}}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="am-btn am-btn-default am-btn-danger" id="anniu"><span class="am-icon-trash-o"></span>下架</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                        <!-- 分页的开始 -->
                        <div class="am-u-lg-12">
                            <div class="am-cf">

                                <div class="am-fr">
                                    {!! $res->appends($_GET)->render() !!}
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- 分页的结束 -->
                    </div>

                </div>
                
            </div>
            <div class="tpl-alert"></div>
        </div>
    @endif        
@endsection
    <!-- <script src="{{ asset('/admins/video/js/jquery.min.js')}}"></script> -->
	<!-- <script src="{{ asset('/admins/video/js/payment.js')}}"></script> -->
    <!-- <script src="/admins/video/js/amazeui.min.js"></script> -->
    <!-- <script src="/admins/video/js/app.js"></script> -->
    