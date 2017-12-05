<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    	<meta name="csrf-token" content="{{ csrf_token() }}" />
		
		<title>@yield('title')</title>

		<link href="{{asset('/homes/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('/homes/css/amazeui.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('/homes/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' media="all" />
		<link href="{{asset('/homes/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('/homes/css/infstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('/homes/js/jquery.min.js')}}"></script>
		<script src="{{asset('/homes/js/amazeui.js')}}"></script>		
		<script src="{{asset('/layer/layer.js')}}"></script>		
		<style>
			.cur{border:solid 2px lightblue;}
			.main-grids{
				padding-top:-50px;
				margin-top:-50px;
			}
		</style>	
	</head>

	<body>
		@if(session('msg'))
	        <div class="mws-form-message info" style="font-size: 20px;">
				<script>
	            	layer.alert("{{session('msg')}}");						
				</script>
	        </div>               
        @endif

        @if (count($errors) > 0)
		    <div class="mws-form-message warning">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li style="font-size: 20px;list-style: none">{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
			@endif
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="{{url('/')}}" target="_top" class="h">网站首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="{{url('/home/center')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="{{url('/home/up')}}" target="_top"><i class="am-icon-user am-icon-fw"></i><span>上传列表</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="{{url('/home/center/history')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>历史记录</span></a></div>
						</ul>
						</div>

						<div class="nav white">
							<div class="logoBig">
								<?php $res = DB::table('config')->get();  ?>
          							<?php foreach($res as $k=>$v) ?>
								<li><a href="/"><img src="{{url('/admins/logos/'.$v->logo)}}" style="margin-left: -40px;height: 80px;width: 150px;" /></a></li>
							</div>

							<div class="search-bar pr">
								<img src="{{url('/homes/images/center.png')}}" style="margin-left: -40px;margin-top: -25px;">
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
				
					@section('content')

					@show
				
				</div>
				<!--底部-->
					<?php $res = DB::table('friendlink')->get() ?>

				<div class="footer">
					<div class="footer-hd" >
						<p style="text-align: center!important;">
							@if($res == Null)
									
									<a href="javascript:void(0);" style="font-size: 15px;">暂无友情链接</a>
							@else
								@foreach($res as $k => $v)

								<a href="{{$v->url}}">{{$v->linkName}}</a>
								<b>|</b>
								@endforeach
							@endif
						</p>
					</div>
					<div class="footer-bd">
						<p style="text-align: center!important;">
							<a href="{{url('/home/center/about')}}">关于尚视</a>
							<a href="{{url('/home/center/service')}}">联系我们</a>
							<em>© 2017-2037 ShangShi.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person active">
						<a href="{{url('/home/center')}}"><i class="am-icon-user"></i>个人中心</a>
					</li>
					<li class="person">
						<p><i class="am-icon-newspaper-o"></i>个人资料</p>
						<ul>
							<li> <a href="{{url('/home/center')}}">个人信息</a></li>
							<li> <a href="{{url('/home/center/tel')}}">电话号码</a></li>
							<li> <a href="{{url('/home/center/password')}}">修改密码</a></li>
							<li> <a href="{{url('/home/center/vip')}}">开通vip</a></li>
						</ul>
					</li>
					<li class="person">
						<p><i class="am-icon-balance-scale"></i>用户上传</p>
						<ul>
							<li><a href="{{url('/home/up')}}">上传列表</a></li>

						</ul>
					</li>

					<li class="person">
						<p><i class="am-icon-tags"></i>历史记录</p>
						<ul>
							<li> <a href="{{url('/home/center/history')}}">历史记录</a></li>												
						</ul>
					</li>

					<li class="person">
						<p><i class="am-icon-qq"></i>关于尚视</p>
						<ul>
							<li> <a href="{{url('/home/center/about')}}">关于尚视</a></li>
							<li> <a href="{{url('/home/center/service')}}">联系我们</a></li>
						</ul>
					</li>
				</ul>

			</aside>
		</div>

	</body>

</html>