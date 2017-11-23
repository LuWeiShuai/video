<!DOCTYPE HTML>
<html>
<head>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap -->
<link href="/homes/css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
<!-- //bootstrap -->
<link href="/homes/css/dashboard.css" rel="stylesheet">
<!-- Custom Theme files -->
<link href="/homes/css/style.css" rel='stylesheet' type='text/css' media="all" />
<script src="/homes/js/jquery-1.11.1.min.js"></script>
<!--start-smoth-scrolling-->

</head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle 162navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><h1><img src="/homes/images/Logo.png" alt="" style="height: 60px;" /></h1></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<div class="top-search">
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
					<input type="submit" value=" ">
				</form>
			</div>
			@if(session('msg'))
                <div class="mws-form-message info" style="font-size: 20px;">                 

                    {{session('msg')}}

                </div>
            @endif

			<div class="header-top-right">

				@if(!session('uid'))

				<div class="signin">
					<a href="#small-dialog2" class="play-icon popup-with-zoom-anim">注册</a>
					<!-- pop-up-box -->
									<script type="text/javascript" src="/homes/js/modernizr.custom.min.js"></script>    
									<link href="/homes/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
									<script src="/homes/js/jquery.magnific-popup.js" type="text/javascript"></script>
									<!--//pop-up-box -->
									
									<div id="small-dialog2" class="mfp-hide">
										<h3>注册</h3> 
										<div class="social-sits">
											<img src="/homes/images/zhuce.png">
										</div>
										 <div class="signup">
											
												<input type="text" name="tel" class="email" placeholder="手机号" maxlength="11" pattern="1[345789]\d{9}" title="Enter a valid mobile number"/>
											
											<div class="continue-button" id="yan">
												<a href="#small-dialog3" class="hvr-shutter-out-horizontal play-icon popup-with-zoom-anim">获取验证码</a>
											</div>
											<script type="text/javascript">
											$.ajaxSetup({
										        headers: {
										            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										        }
											});
											$('#yan a').click(function(){
												var tel = $('input[name=tel]').val();
												
												$.get('/home/register',{tel:tel},function(data){
													/*document.write(data);*/
													
												})
												
											})
										</script>
										</div>
										
										<div class="clearfix"> </div>
									</div>
									<div id="small-dialog3" class="mfp-hide">
										<h3>注册帐号</h3> 
										<div class="social-sits">
											
											<img src="/homes/images/zhuce.png">
										</div>
										<div class="signup">

											<form action="/home/regis" method="get">
												<input type="password" name="password" class="email" placeholder="密码" required="required" pattern=".{6,16}" title="Enter a vali"/>
												<input type="password" name="repass" placeholder="确认密码" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
												<input type="text" name="code" class="email" placeholder="验证码" maxlength="10" title="Enter a valid mobile number" />
												

												<input type="submit"  value="注册"/>
												

											</form>	
											
											
										</div>
									
										<div class="clearfix"> </div>
									</div>
									<div id="small-dialog7" class="mfp-hide">
										<h3>创建帐号</h3> 
										<div class="social-sits">
											<div class="facebook-button">
												<a href="#">脸书登录</a>
											</div>
											<div class="chrome-button">
												<a href="#">谷歌登录</a>
											</div>
											<div class="button-bottom">
												<p>已经拥有帐号 <a href="#small-dialog" class="play-icon popup-with-zoom-anim">登录</a></p>
											</div>
										</div>
										<div class="signup">
											<form action="" method="">
												<input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
												<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
												<input type="submit"  value="Sign In"/>
											</form>
										</div>
										<div class="clearfix"> </div>
									</div>		
									<div id="small-dialog4" class="mfp-hide">
										<h3>回复</h3> 
										<div class="feedback-grids">
											<div class="feedback-grid">
												<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											</div>
											<div class="button-bottom">
												<p><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign in</a> to get started.</p>
											</div>
										</div>
									</div>
									<div id="small-dialog5" class="mfp-hide">
										<h3>Help</h3> 
											<div class="help-grid">
												<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											</div>
											<div class="help-grids">
												<div class="help-button-bottom">
													<p><a href="#small-dialog4" class="play-icon popup-with-zoom-anim">Feedback</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Lorem ipsum dolor sit amet</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Nunc vitae rutrum enim</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris at volutpat leo</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris vehicula rutrum velit</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Aliquam eget ante non orci fac</a></p>
												</div>
											</div>
									</div>
									<div id="small-dialog6" class="mfp-hide">
										<div class="video-information-text">
											<h4>Video information & settings</h4>
											<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											<ol>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
											</ol>
										</div>
									</div>
									<script>
											$(document).ready(function() {
											$('.popup-with-zoom-anim').magnificPopup({
												type: 'inline',
												fixedContentPos: false,
												fixedBgPos: true,
												overflowY: 'auto',
												closeBtnInside: true,
												preloader: false,
												midClick: true,
												removalDelay: 300,
												mainClass: 'my-mfp-zoom-in'
											});
																											
											});
									</script>	
				</div>
				
				<div class="signin">
					
					<a href="#small-dialog" class="play-icon popup-with-zoom-anim">登录</a>
					
					<div id="small-dialog" class="mfp-hide">
						<h3>Login</h3>
						<div class="social-sits">
							<img src="/homes/images/login.png">
						</div>
						<div class="signup">
							
							<form action="/home_login/dologin" method="post">
								<input type="text" name="tel" class="email" placeholder="手机号" required="required" pattern="1[34578]\d{9}"/>
								<input type="password" name="password" placeholder="密码" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
								<input type="hidden" name="lastlogin" value="{{date('Y-m-d H:i:s',time())}}">
								{{csrf_field()}}
								<input type="submit"  value="登录"/>

							</form>
							<div class="forgot">
								<a href="#">忘记密码?</a>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				@else
					<div class="signin">
					<a href="/home/center" class="play-icon popup-with-zoom-anim">个人中心</a>
					<a href="/home_login/delete" class="play-icon popup-with-zoom-anim">注销</a>
						
					</div>
				@endif
				<div class="clearfix"> </div>
				
			</div>
        </div>
		<div class="clearfix"> </div>
      </div>
    </nav>
	<div class="copyrights">Collect from <a href="http://www.17sucai.com/" >企业网站模板</a></div>
        <div class="col-sm-3 col-md-2 sidebar">
			<div class="top-navigation">
				<div class="t-menu">MENU</div>
				<div class="t-img">
					<img src="/homes/images/lines.png" alt="" />
				</div>
				<div class="clearfix"> </div>
			</div>
				<div class="drop-navigation drop-navigation">
				  <ul class="nav nav-sidebar">
					<li class="active"><a href="{{ url('/home/index') }}" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>前台主页</a></li>
					<li><a href="shows.html" class="user-icon"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>电视节目</a></li>
					<li><a href="history.html" class="sub-icon"><span class="glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>浏览历史</a></li>
					<?php $res1 = DB::table('type')->get();?>
					@foreach($res1 as $k1 => $v1)
						@if($v1->fid == 0)
						<li><a href="{{ url('/home/video/'.$v1->id)}}" class="menu{{ $v1->id }}"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>{{ $v1->name }}<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
						<ul class="cl-effect-{{ $v1->id }}" style="display:none;">
							@foreach($res1 as $k2 => $v2)
								@if($v2->fid == $v1->id )
								<li><a href="{{ url('/home/type/'.$v2->id)}}" class="typeSon{{$v2->id}}">{{ $v2->name }}</a></li>
								@endif
							@endforeach       
						</ul>
							
							<!-- script-for-menu -->
							<script>
								$( "li a.menu"+"{{ $v1->id }}" ).mouseover(function(){			
									 var type = $(this).text();
									$( "ul.cl-effect-"+"{{ $v1->id }}" ).slideToggle(300, function(){
									// Animation complete.
									});
								});							
							</script>
						@endif
					@endforeach
				  </ul>
				  	 <!-- script-for-menu -->
						<script>
							$( ".top-navigation" ).click(function() {
							$( ".drop-navigation" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<div class="side-bottom">
						
						<div class="copyright">
							<p>Copyright &copy; 2015.Company name All rights reserved.</p>
						</div>
					</div>
				</div>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			
			<div class="main-grids">
			@section('content')

            
            @show
            </div>
			<!-- footer -->
			<div class="footer">
				<div class="footer-grids">
					<div class="footer-top">
						<div class="footer-top-nav">
							<ul>
								<li><a href="about.html">本站四英</a></li>
								<li><a href="press.html">出版方</a></li>
								<li><a href="copyright.html">版权</a></li>
								<li><a href="creators.html">厂家</a></li>
								<li><a href="#">广告</a></li>
								<li><a href="developers.html">开发者平台</a></li>
							</ul>
						</div>
						<?php $res = DB::table('friendlink')->get() ?>
						<div class="footer-bottom-nav">
							<ul>
								@foreach($res as $k => $v)
									<li><a href="{{$v->url}}">{{$v->linkName}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="footer-bottom">
						
					</div>
				</div>
			</div>
			<!-- //footer -->
		</div>
		<div class="clearfix"> </div>
	<div class="drop-menu">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
		  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
		  <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
		  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
		</ul>
	</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/homes/js/bootstrap.min.js"></script>
    <script src="/layer/layer.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  </body>
</html>
<script> 
    $('.mws-form-message').delay(1000).slideUp(1000);
</script>