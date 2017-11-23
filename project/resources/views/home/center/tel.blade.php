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
						<input type="button" value="获取验证码" class="btn btn-danger">
						<br>
						<script>
							$('.btn').click(function(){
								//获取tel值
								var tel = $('#user-phone').val();
								
								//发送ajax
								$.get('/home/center/yzm',{tel:tel},function(data){
									// alert(data);
								})

							})

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

<script>
	
	$('.mws-form-message').delay(3000).slideUp(1000);

</script>