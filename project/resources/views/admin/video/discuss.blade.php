@extends('layout/admin')
@section('title','评论管理')

	<meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- <link rel="icon" type="image/png" href="/admins/video/i/favicon.png"> -->
    <!-- <link rel="apple-touch-icon-precomposed" href="/admins/video/i/app-icon72x72@2x.png"> -->
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{ url('/admins/video/css/amazeui.min.css')}}" />
    <!-- <link rel="stylesheet" href="/admins/video/css/admin.css"> -->
    <link rel="stylesheet" href="{{ url('/admins/video/css/app.css')}}">
    <link rel="stylesheet" href="{{ url('/admins/video/css/popuo-box.css')}}">
    <link rel="stylesheet" href="{{ url('/admins/video/tankuang/payment.css')}}">
    <link rel="stylesheet" href="{{ url('/admins/video/tankuang/style.css')}}">
    <link rel="stylesheet" href="{{ url('/admins/video/tankuang/reset.css')}}">
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
        #mws-user-info{
            height: 40px!important;
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
        #fengmian{
        	float: left;
        	width: 200px;
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
        .tpl-pagination .active a {
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
            <span class="icon-feather"></span> 视频评论管理
        </div>
        <div class="tpl-portlet-input tpl-fz-ml">
            
        </div>
    </div>

    <div class="tpl-block">
        <div class="g">
            <div class="tpl-table-images">
                <div class="u-sm-12 u-md-6 u-lg-4">
                    <div class="tpl-table-images-content" style="height: 300px;">
                        <div class="tpl-table-images-content-i" id="fengmian">
                            <div class="tpl-table-images-content-i-info">
                                <span class="ico">
                                    <i>{{$vres['level']}}</i>
                                 </span>
                            </div>
                            <span class="tpl-table-images-content-i-shadow"></span>
                            <img src="http://ozssihjsk.bkt.clouddn.com/images/{{$vres['logo']}}" alt="">
                        </div>
                        <div class="tpl-table-images-content-block" style="padding-left: 240px;">
                            <div class="tpl-i-font" style="height: 40px; color: black;font-size: 24px; font-weight: bold;">
                            	《{{$vres['title']}}》
                            </div>
                            <hr/>
                            <div class="tpl-i-more" style="color: black;font-size: 16px;" >

                                内容介绍：
								<p></p>
                                <p style="color: black;font-size: 14px;overflow:hidden;text-overflow:ellipsis;white-space:norwap;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cres['content']}}</p>
                            </div>
                        </div>
                    </div>

					<div class="am-u-sm-12">
                            <div class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                        <tr>
                                            <th class="table-id">ID</th>
                                            <th class="table-title">用户名</th>
                                            <th class="table-author am-hide-sm-only">留言内容</th>
                                            <th class="table-date am-hide-sm-only">留言日期</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($res as $k=>$v)
                                        <tr id="id{{$v->id}}">
                                            <td>{{$v->id}}</td>
                                            <td><a href="#">{{$ures[$k]->nikeName}}</a></td>
                                            <td class="am-hide-sm-only">{{$v->content}}</td>
                                            <td class="am-hide-sm-only">{{date($v->time)}}</td>
                                            <td>
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs">
                                                        <a onclick="fun({{$v->id}})" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" id="shan" style="height: 30px;width: 60px;font-size: 16px; line-height: 10px; "><span class="am-icon-trash-o" style="height: 10px;width: 10px;font-size: 16px;margin-left: -30px; ">删除</span> </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                                <hr>

                            </div>
                        </div>


                </div>
                
                
                
            </div>

        </div>
        
    </div>
    <div class="tpl-alert"></div>
</div>

@endsection
    <script src="{{ url('/admins/video/js/jquery.min.js')}}"></script>
	<script src="{{ url('/admins/video/js/payment.js')}}"></script>
    <!-- <script src="/admins/video/js/amazeui.min.js"></script> -->
    <!-- <script src="/admins/video/js/app.js"></script> -->
    <script type="text/javascript">
    	function fun(id){
    		$.get('/admin/videos',{id:id},function(data){
    			if(data==1){
    				$("#id"+id).remove();
    			}else if(data==0){
    				alert('删除失败');
    			}
    		})
    		return false;
    	}
    </script>
