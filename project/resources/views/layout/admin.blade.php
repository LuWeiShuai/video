<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/admins/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/admins/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/admins/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admins/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admins/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admins/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/themer.css" media="screen">

<style type="text/css">
    .clearfix{
        color: #f39800 !important;
    }
</style>
<title>@yield('title')</title>

</head>

<body>
    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <?php $res = DB::table('config')->get();  ?>
          <?php foreach($res as $k=>$v) ?>
                <img src="/admins/logos/{{$v->logo}}" alt="mws admin">
            </div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
            <span>
                <!-- 日历 -->
                <SCRIPT type=text/javascript src="/admins/js/clock.js"></SCRIPT>
                <SCRIPT type=text/javascript>showcal();</SCRIPT>
            </span> 
            <!-- Messages -->
            <div id="mws-user-message" class="mws-dropdown-menu">
                <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a>
                <!-- Unred messages count -->
                <span class="mws-dropdown-notif">35</span>
                
                <!-- Messages dropdown -->
                <div class="mws-dropdown-box">
                    <div class="mws-dropdown-content">
                        <ul class="mws-messages">
                            <li class="read">
                                <a href="#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
                            <a href="#">View All Messages</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            <?php $res = DB::table('admin')->where('id',session('id'))->first()?>
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="http://ozssihjsk.bkt.clouddn.com/images/{{$res->profile}}" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, {{ $res->userName }}
                    </div>
                    <ul>
                        <li><a href="{{ url('/admin/center/profile')}}">修改头像</a></li>
                        <li><a href="{{ url('/admin/center/password')}}">修改密码</a></li>
                        <li><a href="{{ url('admin/exit') }}">注销</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Searchbox -->
            <!-- <div id="mws-searchbox" class="mws-inset">
                <form action="typography.html">
                    <input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div> -->
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li>
                        <a href="#"><i class="icon-list"></i>用户管理</a>
                        <ul class="closed">
                            <li><a href="{{ url('/admin/user') }}">用户列表</a></li>
                            <li><a href="{{ url('/admin/user/create') }}">添加管理员</a></li>
                            <li><a href="{{ url('/admin/admin_user') }}">管理员列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i>视频分区</a>
                        <ul class="closed">
                            <li><a href="/admin/type">分区列表</a></li>
                            <li><a href="/admin/type/create">添加分区</a></li>                           
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 视频管理</a>
                        <ul class="closed">
                            <li><a href="{{url('/admin/video')}}">视频列表</a></li>
                            <li><a href="{{url('/admin/video/huishou')}}">回收站</a></li>
                        </ul>
                    </li>
                <?php $ures = DB::table('uvideo')->where("status","0")->count();?>
                @if($ures==0)
                    <li>
                        <a href="#"><i class="icon-list"></i>用户上传</a>
                        <ul class="closed">
                            <li><a href="/admin/userup">待审核</a></li>
                 @else
                    <li>
                        <a href="#"><i class="icon-list"></i>用户上传<span class="mws-nav-tooltip" style="margin-top:-10px; color: red!important; ">{{$ures}}</span></a>
                        <ul class="closed">
                            <li><a href="/admin/userup">待审核</a> <span class="mws-nav-tooltip" style="margin-top:-4px; color: red!important; ">{{$ures}}</span></li>
                 @endif
                            <li><a href="/admin/userguo">已通过</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i>网站配置</a>
                        <ul class="closed">
                            <li><a href="{{ url('/admin/config') }}">网站配置</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i>友情链接</a>
                        <ul class="closed">
                            <li><a href="/admin/friendlink">浏览链接</a></li>
                            <li><a href="/admin/friendlink/create">添加链接</a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
            <!-- Inner Container Start -->
            <div class="container">
            
                 @if(session('msg'))
                <div class="mws-form-message info">                 

                    {{session('msg')}}

                </div>
                @endif
            @section('content')

            
            @show
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
                Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="/admins/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/admins/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/admins/js/libs/jquery.placeholder.min.js"></script>
    <!-- <script src="/admins/custom-plugins/fileinput.js"></script> -->
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/admins/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/admins/jui/jquery-ui.custom.min.js"></script>
    <script src="/admins/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/admins/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/admins/plugins/flot/jquery.flot.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/admins/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/admins/plugins/validate/jquery.validate-min.js"></script>
    <script src="/admins/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/admins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admins/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/admins/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/admins/js/demo/demo.dashboard.js"></script>
    
    <!-- layer -->
    <script src="/layer/layer.js"></script>
    @section('script')
        <script>    
            $('.mws-form-message').delay(1000).slideUp(1000);
        </script>
    @show
</body>
</html>
