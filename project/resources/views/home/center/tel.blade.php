@extends('layout.Center')
@section('title','电话号码')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">电话号码</strong></div>
		</div>
		<hr/>

		<!--个人信息 -->
		<div class="info-main">
			<form action="/home/center/telUpdate" method="post" class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">新手机号:</label>
					<div class="am-form-content">
						<input id="user-phone" placeholder="请输入新手机号" type="tel" name="tel">
						<br>
						<input type="button" value="获取验证码" class="btn btn-danger" onclick="">
						<br>
						
					</div>
					
				</div>
				<br><br>
				<label  class="am-form-label">手机验证码:</label>
					<div class="am-form-content">
						
						<input id="user-phone" placeholder="请输入手机验证码" type="text" name="yzm">
					</div>
				<br><br><br><br><br><br>
				<div class="info-btn">
					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection