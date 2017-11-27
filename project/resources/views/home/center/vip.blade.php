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
					<label class="am-form-label">vip</label>
					<div class="am-form-content sex">
						<label class="am-radio-inline">
							<input type="radio" name="vip" value="m" data-am-ucheck checked>开通
						</label>
						<label class="am-radio-inline">
							<input type="radio" name="vip" value="w" data-am-ucheck >不开通
						</label> 
					</div>
				</div>

				<br><br>
				<div class="info-btn">
    				{{ csrf_field()}}
					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>
			</form>
		</div>
		<!-- 	<script>
				function func()
				{
					$.get('/home/center/doVip',{},function(data){
						alert(data);
					})

					return false;
				}
			</script>-->	
		</div>
@endsection