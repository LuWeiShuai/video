@extends('layout.Center')
@section('title','vip开通')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf" align="center">
				<strong class="am-text-danger am-text-lg">vip开通</strong>
			</div>
		</div>
		<hr/> 
		<!--个人信息 -->
		<div class="info-main">
			<form action="/home/center/doVip" method="get" class="am-form am-form-horizontal">
				<div class="am-form-group">
					<label class="am-form-label">vip：</label>
					<div class="am-form-content sex">
						<label class="am-radio-inline">
							<input type="radio" name="vip" value="m" data-am-ucheck checked>开通
						</label>
					</div>
					<br>
					<label class="am-form-label">月份：</label>
					<div class="birth-select2">
						<select name="month">
							@for($a=1; $a<=12; $a++)
								<option value="{{$a}}">{{$a}}</option>
							@endfor
						</select>
						<em>月</em>
						<input type="hidden" value="{{ date('Y-m-d H:i:s',time())}}" name="time">
					</div>
				</div>

				<br><br>
				<div class="info-btn">
    				{{ csrf_field()}}
					<input type="submit" value="开通vip" class="btn btn-danger">
				</div>
			</form>
		</div>
		
		</div>
@endsection