@extends('layout.Center')
@section('title','修改密码')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong></div>
		</div>
		<hr/>
		 @if(count($errors) > 0)
        <div class="mws-form-message error">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="font-size: 17px; list-style:none">{{$error}}</li>
                @endforeach
            </ul>

        </div>
    	@endif 

		<!--个人信息 -->
		<div class="info-main">
			<form action="/home/center/repass" method="post" class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">手机号:</label>
					<div class="am-form-content" id="aa">
						<input id="user-phone" placeholder="请输入手机号" type="text" value="" name="tel">
						<br>
						<input type="button" value="获取验证码" class="btn btn-danger" id="btn">
						<br>
						<script>
							var wait=60; 
							function time(o) { 

							   $.ajax({
					               type:'get',
					               url:"/home/register",
					               data:'tel='+$('input[name=tel]').val(),
					               success:function(data){
					               	console.log(data);
						               	if(data=='1'){
						               		if (wait == 0) { 
												o.removeAttribute("disabled"); 
												o.value="获取验证码"; 
												wait = 60; 
												} else { 
												o.setAttribute("disabled", true); 
												o.value="重新发送(" + wait + ")"; 
												wait--; 
												setTimeout(function() { 
												time(o) 
												}, 
												1000);
												return false;
											} 
											return false;
										}else{
											$('input[name=tel]').css('border','solid 1px red');
										}
										return false;
					               }

					            });

								return false;
							} 
							   	
							document.getElementById("btn").onclick=function(){time(this);}

						</script>
					</div>
					
				</div>
				<br><br>
				<label  class="am-form-label">手机验证码:</label>
					<div class="am-form-content">
						
						<input id="user-phone" placeholder="请输入手机验证码" type="text" name="yzm">
					</div>
				<br><br>
				<label  class="am-form-label">新密码:</label>
				<div class="am-form-content">
					<input type="password" name="password" class="email" placeholder="密码" required="required" pattern=".{6,16}" title="Enter a vali"/><span> *请输入6~16位密码</span>
				</div>
				<br><br>
				<label  class="am-form-label">确定密码:</label>
				<div class="am-form-content">
					<input type="password" name="repass" placeholder="确认密码" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" /><span> *再次输入密码</span>
				</div>
				<script type="text/javascript">
					//密码操作
					//获取焦点
					$('input[name=password]').focus(function(){

						$(this).addClass('cur');
					})
					//失去焦点
					$('input[name=password]').blur(function(){
						//获取密码的值
						var pass = $(this).val();
						//正则
						var reg = /^\S{6,16}$/;
						if(!reg.test(pass)){
							$(this).css('border','solid 2px #db192a');
							$(this).next().text(' *密码格式不正确').css('color','#db192a');
							

						} else {
							$(this).css('border','solid 2px green');
							$(this).next().text(' √').css('color','green');

							
						}
					})

					//确认密码
					//获取焦点
					$('input[name=repass]').focus(function(){

						$(this).addClass('cur');
					})
					//失去焦点
					$('input[name=repass]').blur(function(){
						//获取确认密码的值
						var rpv = $(this).val();
						//获取密码的值
						var pv = $('input[name=password]').val();

						if(rpv != pv){

							$(this).css('border','solid 2px #db192a');
							$(this).next().text(' *两次密码不一致').css('color','#db192a');

						} else {
							$(this).css('border','solid 2px green');
							$(this).next().text(' √').css('color','green');

						}
					})
				</script>
				<br><br>
				<div class="info-btn">
    				{{ csrf_field()}}

					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection