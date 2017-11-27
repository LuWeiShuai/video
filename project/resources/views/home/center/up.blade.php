@extends('layout/center')
@section('title','视频列表')

    <meta name="description" content="">
    <meta name="keywords" content="index">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- <link rel="icon" type="image/png" href="/admins/video/i/favicon.png"> -->
    <!-- <link rel="apple-touch-icon-precomposed" href="/admins/video/i/app-icon72x72@2x.png"> -->
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/homes/video/css/amazeui.min.css" />
    <!-- <link rel="stylesheet" href="/admins/video/css/admin.css"> -->
    <link rel="stylesheet" href="/homes/video/css/app.css">
    <link rel="stylesheet" href="/homes/css/popuo-box.css">
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
            background-image: url('/home/images/core/mws-dark-bg.png')!important;
        }


        #anniu{
            width: 100px!important;
            margin-left: 25px;
            height: 30px;
            font-size: 18px!important;
            line-height: 10px!important;
            float: left!important;

        }
         #ann{
            width: 100px!important;
            margin-left: 25px;
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
            color: black;
            font-size: 12px;
            font-weight:bold;
            font-family:楷体;
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
    </style>
@section('content')

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
                        <a href="/home/up/create" style='color:white;'> 
                            <button type="button" class="am-btn am-btn-default am-btn-success"  id="tianjia"><span class="am-icon-plus"></span>新增
                            </button>
                        </a>
                    </div>
                </div>
            </div>
                    <form action="/home/up" method="get">
            
            <div class="am-u-sm-12 am-u-md-6" id="seach">
                <div class="am-input-group am-input-group-sm">
                            <input type="text" class="am-form-field" name="search" value="{{isset($_GET['search']) ? $_GET['search'] : '' }}">
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
               @foreach($res as $k=>$v)
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="tpl-table-images-content">
                        <div class="tpl-table-images-content-i-time">
                        
                            <div class="fenqu">
                              
                            </div>
                        </div>
                        
                        <div class="tpl-i-title">
                           {{$v->title}}
                        </div>
                        
                        <div class="tpl-table-images-content-i" id="fengmian">
                            
                            <span class="tpl-table-images-content-i-shadow"></span>
                            <a href=""><img style="float:left" src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->pic}}" alt=""></a>
                                
                        </div>
                        <div class="tpl-table-images-content-i-info">
                                <span class="ico">
                                    <i>{{$v->content}}</i>
                                 </span>
                            </div>
                        <div class="tpl-table-images-content-block">  

                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                @if(  $v->status == 0)
                                    <a href="" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-info" id="anniu"><span class="am-icon-edit">待审核</span></button></a>
                                @else 
                                    <a href="" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-secondary" id="ann"><span class="am-icon-edit">已通过</span></button></a>
                                @endif
                                    <form method="post" action="/home/up/{{$v->id}}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="am-btn am-btn-default am-btn-danger" id="anniu" style="width:190px;"><span class="am-icon-trash-o"></span>下架</button>
                                    </form>

                                </div>

                            </div>

                        </div>
                        
                    </div>
                </div>
               @endforeach 
              <!-- end遍历 -->
                
                
                <!-- 分页的开始 -->
                <div class="am-u-lg-12">
                    <div class="am-cf">

                        <div class="am-fr">
                           <!-- 分页 -->
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

@endsection
    <script src="/homes/video/js/jquery.min.js"></script>
    <!-- <script src="/homes/video/js/payment.js"></script> -->
    <!-- <script src="/admins/video/js/amazeui.min.js"></script> -->
    <!-- <script src="/admins/video/js/app.js"></script> -->
    