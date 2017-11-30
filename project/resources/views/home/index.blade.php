@extends('layout.home')
@section('title','尚视视频网')
@section('content')
<style type="text/css">
	.main-grids{
		padding-top:-50px;
		margin-top:-50px;

	}
</style>
	<div class="recommended">
		@foreach($type as $k=>$v)
		<div class="recommended-grids">
			<div class="recommended-info">
				<h3 style="float: left; padding: 0px; margin: 0px;  line-height: 40px;" class="glyphicon glyphicon-film" >&nbsp;{{$v->name}}</h3>
				<a class="gengduo" style="float: right;margin-right: 20px; margin-top:10px; " href="{{ url('/home/video/'.$v->id)}}">更多>></a>
				
			</div>
			<div class="cler" style="clear:both; width: 100%;border:solid 1px #999999;opacity: 0.3;margin-bottom: 10px; "></div> 
			@if($v->name!='用户上传')
				@foreach ($video as $key => $val)
					@if(in_array($val->tid,$fid[$k]))
						@if($key<=3)
						<div class="col-md-3 resent-grid recommended-grid">
							<div class="resent-grid-img recommended-grid-img">
								<a href="{{ url('/home/play/'.$val->id)}}"><img style="height: 200px;" src="http://ozssihjsk.bkt.clouddn.com/images/{{$val->logo}}" alt=""></a>
								<div class="time small-time">
									<p><i style="font-size: 18px;color: red;">{{$val->level}}分</i></p>
								</div>
								<!-- <div class="clck small-clck">
								</div> -->
							</div>
							<div class="resent-grid-info recommended-grid-info video-info-grid">
								<h5 style="height: 20px;"><a href="single.html" class="title" >{{$val->title}}</a></h5>
								<ul>

									<li style="height: 30px;"><p class="author author-info" style="width: 200px;"><a href="javascript:void(0);" class="author" >演员：{{$vdetail[$key]->actor}}</a></p></li>
									<li class="right-list"><p class="views views-info">{{$val->num}} 次浏览</p></li>
								</ul>
							</div>
						</div>
						@endif
					@endif
				@endforeach
			@else
				@foreach ($uvideo as $key => $val)
					@if($key<=3)
						<div class="col-md-3 resent-grid recommended-grid">
							<div class="resent-grid-img recommended-grid-img">
								<a href="{{ url('/home/user_play/'.$val->id)}}"><img style="height: 200px;" src="http://ozssihjsk.bkt.clouddn.com/images/{{$val->pic}}" alt=""></a>
								<div class="time small-time">
									<!-- <p><i style="font-size: 18px;color: red;">分</i></p> -->
								</div>
								<!-- <div class="clck small-clck">
								</div> -->
							</div>
							<div class="resent-grid-info recommended-grid-info video-info-grid">
								<h5 style="height: 20px;"><a href="single.html" class="title">{{$val->title}}</a></h5>
								<ul>
									<li style="height: 30px;"><p class="author author-info" style="width: 200px;"><a href="javascript:void(0);" class="author">发布人：{{$val->username}}</a></p></li>
									<li class="right-list"><p class="views views-info">{{$val->num}} 次点击</p></li>
								</ul>
							</div>
						</div>
					@endif
				@endforeach
			@endif
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