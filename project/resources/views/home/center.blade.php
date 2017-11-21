@extends('layout.Center')
@section('title','个人中心')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
		</div>
		<hr/>

		<!--头像 -->
		<div class="user-infoPic">

			<div class="filePic">
				<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
				<img class="am-circle am-img-thumbnail" src="/homes/images/getAvatar.do.jpg" alt="" />
			</div>

			<p class="am-form-help">头像</p>

			<div class="info-m">
				<div><b>用户名：<i>小叮当</i></b></div>
				<div class="vip">
                      <span></span><a href="#">会员专享</a>
				</div>
			</div>
		</div>

		<!--个人信息 -->
		<div class="info-main">
			<form class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-name2" class="am-form-label">昵称</label>
					<div class="am-form-content">
						<input type="text" id="user-name2" placeholder="nickname" name="nikeName">
                          <small>昵称长度不能超过10个汉字</small>
					</div>
				</div>
				<div class="am-form-group">
					<label class="am-form-label">性别</label>
					<div class="am-form-content sex">
						<label class="am-radio-inline">
							<input type="radio" name="sex" value="" data-am-ucheck checked> 男
						</label>
						<label class="am-radio-inline">
							<input type="radio" name="sex" value="" data-am-ucheck> 女
						</label>
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-birth" class="am-form-label">生日</label>
					<div class="am-form-content birth">
						<div class="birth-select">
							<select data-am-selected>
								<option value="a">2015</option>
								<option value="b">1987</option>
							</select>
							<em>年</em>
						</div>
						<div class="birth-select2">
							<select data-am-selected>
								<option value="a">12</option>
								<option value="b">8</option>
							</select>
							<em>月</em></div>
						<div class="birth-select2">
							<select data-am-selected>
								<option value="a">21</option>
								<option value="b">23</option>
							</select>
							<em>日</em></div>
					</div>
			
				</div>
				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">电话</label>
					<div class="am-form-content">
						<input id="user-phone" placeholder="telephonenumber" type="tel" name="tel">
						<br>
						<input type="button" value="获取验证码" class="btn btn-danger">
					</div>

				</div><br>
				<div class="am-form-group">
					<label for="user-email" class="am-form-label">电子邮件</label>
					<div class="am-form-content">
						<input id="user-email" placeholder="Email" type="email">

					</div>
				</div>
				
				
				<div class="info-btn">
					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection