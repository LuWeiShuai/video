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
			<form class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">电话</label>
					<div class="am-form-content">
						<input id="user-phone" placeholder="telephonenumber" type="tel" name="tel">
						<br>
						<input type="button" value="获取验证码" class="btn btn-danger">
					</div>

				</div>
				
				<div class="info-btn">
					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection