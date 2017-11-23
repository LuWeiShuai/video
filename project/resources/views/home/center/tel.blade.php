@extends('layout.Center')
@section('title','电话号码')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">电话号码</strong></div>
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
			<form action="/home/center/yzmUpdate" method="post" class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">新手机号:</label>
					<div class="am-form-content" id="aa">
						<input id="user-phone" placeholder="请输入新手机号" type="text" value="" name="tel">
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
				<br><br><br><br><br><br>
				<div class="info-btn">
    			{{ csrf_field()}}

					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection

<!-- <script>
	
	$('.mws-form-message').delay(3000).slideUp(1000);

</script> -->