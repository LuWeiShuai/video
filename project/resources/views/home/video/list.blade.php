@extends('layout.home')
@section('title','尚视视频网')
@section('content')
				<div class="recommended">
					<div class="recommended-grids">
						<div class="recommended-info">
							<h3>{{$name}}</h3>
						</div>
						<div class="cler" style="clear:both; width: 100%;border:solid 1px #999999;opacity: 0.3;margin-bottom: 10px; "></div>
						@if($name != '用户上传')
							@foreach($res1 as $k => $v)							
								 <?php $res2 =DB::table('vdetail')->where('vid',$v->id)->first(); ?>

							<div class="col-md-3 resent-grid recommended-grid">
								<div class="resent-grid-img recommended-grid-img">
									<a href="{{ url('/home/play/'.$v->id)}}"><img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->logo}}" alt="" style="height:200px;"></a>
									<div class="time small-time">
										<p><i style="font-size: 18px;color: red;">{{$v->level}}分</i></p>	
									</div>
									<!-- <div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div> -->
								</div>
								<div class="resent-grid-info recommended-grid-info video-info-grid">
									<h5><a href="{{ url('/home/play/'.$v->id)}}" class="title">{{$v->title}}</a></h5>
									<ul>
										<li><p class="author author-info"><a href="#" class="author">演员：{{ $res2->actor }}</a></p></li>
										<li class="right-list"><p class="views views-info">{{$v->num}}次点击</p></li>
									</ul>
								</div>
							</div>
							@endforeach
						@else
							@foreach($res1 as $k => $v)							

							<div class="col-md-3 resent-grid recommended-grid">
								<div class="resent-grid-img recommended-grid-img">
									<a href="{{ url('/home/user_play/'.$v->id)}}"><img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->pic}}" alt="" style="height:200px;"></a>
									<div class="time small-time">
										<p><i style="font-size: 18px;color: red;"></i></p>	
									</div>
									<!-- <div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div> -->
								</div>
								<div class="resent-grid-info recommended-grid-info video-info-grid">
									<h5><a href="{{ url('/home/user_play/'.$v->id)}}" class="title">{{$v->title}}</a></h5>
									<ul>
										<li><p class="author author-info"><a href="#" class="author">演员：{{ $v->actor }}</a></p></li>
										<li class="right-list"><p class="views views-info">{{$v->num}}次点击</p></li>
									</ul>
								</div>
							</div>
							@endforeach
						@endif
						<div class="clearfix"> </div>
					</div>
				</div>
@endsection