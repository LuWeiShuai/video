@extends('layout/admin')
@section('title','视频管理')

	<meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- <link rel="icon" type="image/png" href="/admins/video/i/favicon.png"> -->
    <!-- <link rel="apple-touch-icon-precomposed" href="/admins/video/i/app-icon72x72@2x.png"> -->
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/admins/video/css/amazeui.min.css" />
    <!-- <link rel="stylesheet" href="/admins/video/css/admin.css"> -->
    <link rel="stylesheet" href="/admins/video/css/app.css">
    <link rel="stylesheet" href="/admins/video/css/popuo-box.css">
    <link rel="stylesheet" href="/admins/video/tankuang/payment.css">
    <link rel="stylesheet" href="/admins/video/tankuang/style.css">
    <link rel="stylesheet" href="/admins/video/tankuang/reset.css">
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
    </style>
@section('content')



<div class="tpl-portlet-components">
    <div class="portlet-title">
        <div class="caption font-green bold">
            <span class="am-icon-code"></span> 列表
        </div>
        <div class="tpl-portlet-input tpl-fz-ml">
            
        </div>
    </div>

    <div class="tpl-block">
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="/admin/video/create" style='color:white;'> 
                            <button type="button" class="am-btn am-btn-default am-btn-success"  id="tianjia"><span class="am-icon-plus"></span>新增
                            </button>
                        </a>
                        
                        <!-- <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                        <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-unlock"></span> 审核</button>
                        <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button> -->
                    </div>
                </div>
            </div>
            
            <div class="am-u-sm-12 am-u-md-6" id="seach">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" class="am-form-field">
                    <span class="am-input-group-btn">
                    <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button"></button>
                    </span>
                </div>
            </div>
        </div>
        <div class="jianxi"></div>
        <div class="am-g">
            <div class="tpl-table-images">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="tpl-table-images-content">
                        <div class="tpl-table-images-content-i-time">发布时间：2016-09-12
                        
                            <div class="fenqu">分区</div>
                        </div>
                        <div class="tpl-i-title">
                            电影名称
                        </div>
                        <a href="javascript:;" class="tpl-table-images-content-i">
                            <div class="tpl-table-images-content-i-info">
                                <span class="ico">
                        <img src="/admins/video/img/user02.png" alt="">发布人
                     </span>

                            </div>
                            <span class="tpl-table-images-content-i-shadow"></span>
                            <img src="/admins/video/img/a1.png" alt="">
                        </a>
                        <div class="tpl-table-images-content-block">
                            <div class="tpl-i-font">
                                电影介绍
                            </div>
                            <div class="tpl-i-more">
                                <ul>
                                    <!-- <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                    <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                    <li><span class="am-icon-github font-green"> 600+</span></li> -->
                                    <li>查看评论</li>
                                    <li>电影评分</li>
                                    <li>电影状态</li>
                                </ul>
                            </div>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                    
                                    <a href="/admin/video/1/edit" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-secondary" id="anniu"><span class="am-icon-edit"></span> 编辑</button></a>


                                    


                                    <form method="post" action="/admin/video/1">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="am-btn am-btn-default am-btn-danger" id="anniu"><span class="am-icon-trash-o"></span> 删除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="tpl-table-images-content">
                        <div class="tpl-table-images-content-i-time">发布时间：2016-09-12
                        
                            <div class="fenqu">分区</div>
                        </div>
                        <div class="tpl-i-title">
                            电影名称
                        </div>
                        <a href="javascript:;" class="tpl-table-images-content-i">
                            <div class="tpl-table-images-content-i-info">
                                <span class="ico">
                        <img src="/admins/video/img/user02.png" alt="">发布人
                     </span>

                            </div>
                            <span class="tpl-table-images-content-i-shadow"></span>
                            <img src="/admins/video/img/a1.png" alt="">
                        </a>
                        <div class="tpl-table-images-content-block">
                            <div class="tpl-i-font">
                                电影介绍
                            </div>
                            <div class="tpl-i-more">
                                <ul>
                                    <!-- <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                    <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                    <li><span class="am-icon-github font-green"> 600+</span></li> -->
                                    <li>查看评论</li>
                                    <li>电影评分</li>
                                    <li>电影状态</li>
                                </ul>
                            </div>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                    
                                    <a href="/admin/video/1/edit" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-secondary" id="anniu"><span class="am-icon-edit"></span> 编辑</button></a>


                                    


                                    <form method="post" action="/admin/video/1">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="am-btn am-btn-default am-btn-danger" id="anniu"><span class="am-icon-trash-o"></span> 删除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="tpl-table-images-content">
                        <div class="tpl-table-images-content-i-time">发布时间：2016-09-12
                        
                            <div class="fenqu">分区</div>
                        </div>
                        <div class="tpl-i-title">
                            电影名称
                        </div>
                        <a href="javascript:;" class="tpl-table-images-content-i">
                            <div class="tpl-table-images-content-i-info">
                                <span class="ico">
                        <img src="/admins/video/img/user02.png" alt="">发布人
                     </span>

                            </div>
                            <span class="tpl-table-images-content-i-shadow"></span>
                            <img src="/admins/video/img/a1.png" alt="">
                        </a>
                        <div class="tpl-table-images-content-block">
                            <div class="tpl-i-font">
                                电影介绍
                            </div>
                            <div class="tpl-i-more">
                                <ul>
                                    <!-- <li><span class="am-icon-qq am-text-warning"> 100+</span></li>
                                    <li><span class="am-icon-weixin am-text-success"> 235+</span></li>
                                    <li><span class="am-icon-github font-green"> 600+</span></li> -->
                                    <li>查看评论</li>
                                    <li>电影评分</li>
                                    <li>电影状态</li>
                                </ul>
                            </div>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                    
                                    <a href="/admin/video/1/edit" style="text-decoration: none;"><button type="button" class="am-btn am-btn-default am-btn-secondary" id="anniu"><span class="am-icon-edit"></span> 编辑</button></a>


                                    


                                    <form method="post" action="/admin/video/1">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="am-btn am-btn-default am-btn-danger" id="anniu"><span class="am-icon-trash-o"></span> 删除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="am-u-lg-12">
                    <div class="am-cf">

                        <div class="am-fr">
                            <ul class="am-pagination tpl-pagination">
                                <li class="am-disabled"><a href="#">«</a></li>
                                <li class="am-active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                </div>

            </div>

        </div>
        
    </div>
    <div class="tpl-alert"></div>
</div>

@endsection
    <script src="/admins/video/js/jquery.min.js"></script>
	<script src="/admins/video/js/payment.js"></script>
    <!-- <script src="/admins/video/js/amazeui.min.js"></script> -->
    <!-- <script src="/admins/video/js/app.js"></script> -->
    