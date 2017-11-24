@extends('layout.Center')
@section('title','个人中心')
@section('content')
	<div class="user-info">
		
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
		</div>
		@if(session('msg'))
            <div class="mws-form-message info">                 

                {{session('msg')}}

            </div>
        @endif
        @if(count($errors) > 0)
        <div class="mws-form-message error">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="font-size: 17px; list-style:none">{{$error}}</li>
                @endforeach
            </ul>

        </div>
    	@endif 
		<hr/>
		<form method="post" action="/home/center/update" class="am-form am-form-horizontal" enctype="multipart/form-data">
			<!-- enctype="multipart/form-data" -->
		<!--头像 -->
		<div class="user-infoPic">

			<div class="filePic">
				<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" value="/homes/pic/{{$res->profile}}" name="profile">
				<img class="am-circle am-img-thumbnail" src="/homes/pic/{{$res->profile}}" alt="" />
			</div>

			<p class="am-form-help">头像</p>
			
			<div class="info-m">
				<div><b>昵称：<i>{{$res->nikeName}}</i></b></div>
				<div class="vip">
					<!-- vip0 -->
       				<div style="height:22px;width:51px;overflow:hidden;float:left;"><img src="/homes/images/icon_progress_24.png" style="position:relative;top:0px;left:0px;"></div><a href="" >会员专享</a>
                    <!-- vip1 -->
                    <!-- <div style="height:22px;width:51px;overflow:hidden;float:left;"><img src="/homes/images/icon_progress_24.png" style="position:relative;top:px;left:-51px;"></div><a href="" >会员专享</a> -->
                    <!-- vip2 -->
                    <!-- <div style="height:22px;width:51px;overflow:hidden;float:left;"><img src="/homes/images/icon_progress_24.png" style="position:relative;top:px;left:-102px;"></div><a href="" >会员专享</a> -->
                    <!-- vip3 -->
                    <!-- <div style="height:22px;width:51px;overflow:hidden; float:left;"><img src="/homes/images/icon_progress_24.png" style="position:relative;top:-22px;left:0px;"></div><a href="" >会员专享</a> -->
				</div>
			</div>
		</div>

		<!--个人信息 -->
		<div class="info-main">
			

				<div class="am-form-group">
					<label for="user-name2" class="am-form-label">昵称</label>
					<div class="am-form-content">
						<input type="text" id="user-name2" placeholder="nickname" name="nikeName" value="{{$res->nikeName}}">
                          <small>昵称长度不能超过10个汉字</small>
					</div>
				</div>
				<div class="am-form-group">
					<label class="am-form-label">性别</label>
					<div class="am-form-content sex">
						@if($res->sex == 'm')
						<label class="am-radio-inline">
							<input type="radio" name="sex" value="m" data-am-ucheck checked> 男
						</label>
						<label class="am-radio-inline">
							<input type="radio" name="sex" value="w" data-am-ucheck > 女
						</label>
						@else
						<label class="am-radio-inline">
							<input type="radio" name="sex" value="m" data-am-ucheck> 男
						</label>
						<label class="am-radio-inline">
							<input type="radio" name="sex" value="w" data-am-ucheck  checked> 女
						</label>
						@endif 
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-birth" class="am-form-label">生日</label>
					<div class="am-form-content birth">
						<div class="birth-select">
							<select name="year">
								@if($res->birthday == null)
									<option value="1980">1980</option>
								
									@for($a=1981; $a<=2017; $a++)
										<option value="{{$a}}">{{$a}}</option>
									@endfor

								@else
									<option value="{{$data[0]}}">{{$data[0]}}</option>
									@for($a=1980; $a<=2017; $a++)
									
									<option value="{{$a}}">{{$a}}</option>
									
									@endfor
								@endif

							</select>
							<em>年</em>
						</div>
						<div class="birth-select2">
							<select name="month">
								@if($res->birthday == null)
									<option value="1">1</option>
								
									@for($b=2; $b<=12; $b++)
										<option value="{{$b}}">{{$b}}</option>
									@endfor

								@else
									<option value="{{$data[1]}}">{{$data[1]}}</option>
									@for($b=1; $b<=12; $b++)
										<option value="{{$b}}">{{$b}}</option>
									@endfor
									
								@endif

							</select>
							<em>月</em>
						</div>
						<div class="birth-select2">
							<select name="day">
							<!-- <select data-am-selected> -->
								@if($res->birthday == null)
									<option value="1">1</option>
								
									@for($c=2; $c<=30; $c++)
										<option value="{{$c}}">{{$c}}</option>
									@endfor

								@else
									<option value="{{$data[2]}}">{{$data[2]}}</option>
									@for($c=1; $c<=30; $c++)
										<option value="{{$c}}">{{$c}}</option>
									@endfor
								@endif
							</select>
							<em>日</em>
						</div>
					</div>
			
				</div>
				
				<div class="am-form-group">
					<label for="user-email" class="am-form-label">电子邮件</label>
					<div class="am-form-content">
						<input id="user-email" placeholder="Email" type="email" value="{{$res->email}}" name="email">

					</div>
				</div>
				
				
				<div class="info-btn">
    			{{ csrf_field()}}

					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection
