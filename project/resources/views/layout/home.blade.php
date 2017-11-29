<!DOCTYPE HTML>
<html>
<head>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
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
<script src="/layer/layer.js"></script>

<link href="/homes/css/admin.css" rel="stylesheet" type="text/css">
<link href="/homes/css/amazeui.css" rel="stylesheet" type="text/css">
<link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
<link href="/homes/css/infstyle.css" rel="stylesheet" type="text/css">
<script src="/homes/js/jquery.min.js"></script>
<script src="/homes/js/amazeui.js"></script>		
	
<style>
	.cur{border:solid 2px lightblue;}
	.main-grids{
		padding-top:-50px;
		margin-top:-50px;
	}
</style>
<!--start-smoth-scrolling-->

</head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid" style="margin-top: -18px;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle 162navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php $res = DB::table('config')->get();  ?>
          <?php foreach($res as $k=>$v) ?>
          <a class="navbar-brand" href="/home/index"><h1><img src="/admins/logos/{{$v->logo}}" alt="" style="height: 60px;" /></h1></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<div class="top-search">
				<form class="navbar-form navbar-right" action="/home/search" method="get"> 
					<input type="text" class="form-control" placeholder="Search..." name="cha" value="">
					<input type="submit" value="">
				</form>
			</div>
	
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
											<form action="#small-dialog3" method="get">
												<input  type="text" name="tel" class="email" placeholder="手机号" maxlength="11" pattern="1[345789]\d{9}" title="Enter a valid mobile number"/>
												
												<p > *请输入11位手机号</p>
												<div  class="signup" style="float:left;margin-right:200px;">
												<span  id="qwe" style="color: red;"></span>
												</div>
												<input type="text" name="code" class="email" placeholder="输入验证码" maxlength="11" title="Enter a valid mobile number" style="width: 40%;float: left;margin-right: 20px;" />
											<div class="continue-button" id="yan">
												{{ csrf_field() }}
												
												<input type="button" required onclick="sendCode(this)" id="btn" value="获取验证码" class="btn btn-danger" style="margin:12px;height:40px;font-size: 10px">
												<span id='aaa' style="color:red;font-size:20px"></span>
								
											</div>
											</form>	
											<div class="continue-button" id='coded'>
												<a id="anc" style="float:left" href="#small-dialog2" class="hvr-shutter-out-horizontal play-icon popup-with-zoom-anim">下一步</a>
											</div>
										
											<script type="text/javascript">
											//手机号
											$('#btn').attr("disabled",true);
												//获取焦点
												$('input[name=tel]').focus(function(){

													$(this).addClass('cur');
												})
												//失去焦点
												$('input[name=tel]').blur(function(){
													//获取手机号
													var tel = $(this).val();
													//正则
													var reg = /^1[34578]\d{9}$/;
													//检测
													$.get('/home/regs',{tel:tel},function(data){
														if(data == "0"){
															$('input[name=tel]').css('border','solid 2px #db192a').next().text('该手机号已存在').css('color','#db192a');
															$('#btn').attr("disabled",true);
														}
													});
													//检测
													if(!reg.test(tel)){
														$(this).css('border','solid 2px #db192a');
														$(this).next().text(' *手机号码不正确').css('color','#db192a');
														$('#btn').attr("disabled",true);


													} else {
														$(this).css('border','solid 2px green');
														$(this).next().text(' √').css('color','green');
														 $('#btn').attr("disabled",false);
													}

												});

												var clock = '';
													 var nums = 60;
													 var btn;

													 function sendCode(thisBtn)
													 { 
														


														//获取手机号
														var tel = $('input[name=tel]').val();
														//发送ajax
														$.get('/home/register',{tel:tel},function(data){

															console.log(data);
														})
														 btn = thisBtn;
														 btn.disabled = true; //将按钮置为不可点击
														 btn.value = nums+'秒后可重新获取';
														 clock = setInterval(doLoop, 1000); //一秒执行一次
														 }
														 function doLoop()
														 {
														 nums--;
														 if(nums > 0){
														  btn.value = nums+'秒后可重新获取';
														 }else{
														  clearInterval(clock); //清除js定时器
														  btn.disabled = false;
														  btn.value = '点击发送验证码';
														  nums = 60; //重置时间
														 }
													 }
												




											   	
											$('input[name=code]').blur(function(){

												// alert('213');
												var code = $('input[name=code]').val();
												$.get('/home/reg',{code:code},function(data){
														// alert(data);
														if(data == "0"){
															$('input[name=code]').css('border','solid 1px red');
															$('#anc').attr('href','#small-dialog2');

														}else if(data == "1"){
															$('#anc').attr('href','#small-dialog3');
														}
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

											<form action="/home/regis" method="post">

												<input type="password" name="password" class="email" placeholder="密码" required="required"  />
												<input type="password" name="repass" placeholder="确认密码" required="required"  autocomplete="off" />
												
												{{csrf_field()}}

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
								<a href="/home/forgot">忘记密码?</a>
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
					<li class=""><a href="{{ url('/home/index') }}" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>前台主页</a></li>
					<li><a href="/home/center/history" class="sub-icon"><span class="glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>浏览历史</a></li>
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
						<div id="aaa" style="height: 20px; width: 195px;"></div>
						<div class="side-bottom" style="background-color:#272C2E; position: fixed; width: 193px;bottom: 0px;">
							<div class="copyright" >
								<p>Copyright &copy; 2017.Company name </p>
								<p>All rights reserved.</p>
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
							
						<?php $res = DB::table('friendlink')->get() ?>
							
							<ul>
								<li style="font-size: 20px;color: white;">友情链接:</li>
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
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  </body>
</html>
<script> 
    $('.mws-form-message').delay(1000).slideUp(1000);
</script>