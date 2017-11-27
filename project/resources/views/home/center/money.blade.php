@extends('layout.Center')
@section('title','购买视频')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf" align="center">
				<strong class="am-text-danger am-text-lg">购买视频</strong>
			</div>
		</div>
		<hr/> 
		<!--个人信息 -->
		<div class="info-main">
			<form action="/home/center/buy" method="get" class="am-form am-form-horizontal">
				<div class="am-form-group">
					<label for="user-birth" class="am-form-label">购买视频列表</label>
					<div class="am-form-content birth">
						<div class="birth-select">
							<select name="money">
								@foreach($res as $k=>$v)
									<option value="{{$v->id}}" @if($v->id == $vid) selected @endif >{{ $v->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
			
				</div>

				<br><br>
				<div class="info-btn">
    				{{ csrf_field()}}
					<input type="submit" value="购买" class="btn btn-danger">
				</div>
			</form>
		</div>	
	</div>
@endsection