@extends('layout.home')
@section('title','尚视视频网')
@section('content')
<style type="text/css">
	.main-grids{
		padding-top:-70px;
		margin-top:-70px;
	}
</style>
	<div class="recommended">
		@foreach($type as $k=>$v)
		<div class="recommended-grids">
			<div class="recommended-info">
				<h3>{{$v->name}}</h3>
			</div>
			@foreach ($video as $key => $val)
				@if(in_array($val->tid,$fid[$k]))
					@if($key<=3)
					<div class="col-md-3 resent-grid recommended-grid">
						<div class="resent-grid-img recommended-grid-img">
							<a href="single.html"><img style="height: 200px;" src="/admins/video/upload/{{$val->logo}}" alt=""></a>
							<div class="time small-time">
								<p><i style="font-size: 18px;color: red;">{{$val->level}}分</i></p>
							</div>
							<!-- <div class="clck small-clck">
							</div> -->
						</div>
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<h5><a href="single.html" class="title">{{$val->title}}</a></h5>
							<ul>
								<li style="height: 30px;"><p class="author author-info"><a href="#" class="author" >演员：{{$vdetail[$key]->actor}}</a></p></li>
								<li class="right-list"><p class="views views-info">{{$val->num}} 次点击</p></li>
							</ul>
						</div>
					</div>
					@endif
				@endif
			@endforeach
			<!-- <div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/homes/images/r1.jpg" alt=""></a>
					<div class="time small-time">
						<p>2:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">电影名</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">导演/演员</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 次点击</p></li>
					</ul>
				</div>
			</div> -->
			<div class="clearfix"> </div>
		</div>
		@endforeach
	</div>
@endsection