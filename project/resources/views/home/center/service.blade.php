@extends('layout.Center')
@section('title','客服信息')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">客服信息</strong></div>
		</div>
		<hr/>

		<!--个人信息 -->
		<div class="info-main">
			<form action="/home/center/telUpdate" method="post" class="am-form am-form-horizontal">

				<div style="margin-top: 30px;text-align: center;">
					
				<strong class="am-text-danger am-text-lg">客服一联系方式:</strong>
				<strong class="am-text-danger am-text-lg">&nbsp;&nbsp;QQ : 772379768</strong><br><br>

				<strong class="am-text-danger am-text-lg">客服二联系方式:</strong>
				<strong class="am-text-danger am-text-lg">&nbsp;&nbsp;QQ : 670332237</strong><br><br>

				<strong class="am-text-danger am-text-lg">客服三联系方式:</strong>
				<strong class="am-text-danger am-text-lg">&nbsp;&nbsp;QQ : 175023117</strong><br><br>

				<strong class="am-text-danger am-text-lg">客服四联系方式:</strong>
				<strong class="am-text-danger am-text-lg">&nbsp;&nbsp;QQ : 853870163</strong>
					
				</div>
				

			</form>
		</div>

	</div>
@endsection