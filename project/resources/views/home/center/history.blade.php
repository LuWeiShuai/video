@extends('layout.Center')
@section('title','历史记录')

@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">历史记录</strong></div>
		</div>
		<hr/>
		 @if(count($errors) > 0)
        <div class="mws-form-message error">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="font-size: 17px; list-style:none">{{$error}}</li>
                @endforeach
            </ul>

        </div>
    	@endif 

		<div class="recommended">
			<div class="recommended-grids">
				
				@foreach($res as $k => $v)
					<?php
				        //从video表中查询
				        $video = DB::table('video')->where('id',$v->vid)->first();
					?>
					@if($video->status == 1)
					<div class="col-md-3 resent-grid recommended-grid">
						<div class="resent-grid-img recommended-grid-img" style="margin-top: 15px;">
							<a href="{{ url('/home/play/'.$v->vid)}}">
								<img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->logo}}" style="height:150px;width: 100%;">
							</a>
						</div>
						
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<ul>
								<li>
									<a href="{{ url('/home/play/'.$v->vid)}}" class="title">{{$v->title}}</a>

								</li>
							</ul>
							<ul>
								<li>
									<p class="author author-info">最后播放时间：{{$v->time}}</p>
								</li>
								<li>
									<form action="{{ url('/home/center/delete/'.$v->id)}}" method="get">
										<button type="submit" class="btn btn-danger">删除记录</button>

									</form>
									
								</li>
							</ul>
						</div>
					</div>
					@endif
				@endforeach
				
				@foreach($res1 as $key => $val)
					<?php
				        //从uvideo表中查询
				        $uvideo = DB::table('uvideo')->where('id',$val->vid)->first();
					?>
					@if($uvideo->status == 1)
					<div class="col-md-3 resent-grid recommended-grid">
						<div class="resent-grid-img recommended-grid-img" style="margin-top: 15px;">
							<a href="{{ url('/home/play/'.$val->vid)}}">
								<img src="http://ozssihjsk.bkt.clouddn.com/images/{{$val->logo}}" style="height:150px;width: 100%;">
							</a>
						</div>
						
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<ul>
								<li>
									<a href="{{ url('/home/play/'.$val->vid)}}" class="title">{{$val->title}}</a>

								</li>
							</ul>
							<ul>
								<li>
									<p class="author author-info">最后播放时间：{{$val->time}}</p>
								</li>
								<li>
									<form action="{{ url('/home/center/delete/'.$val->id)}}" method="get">
										<button type="submit" class="btn btn-danger">删除记录</button>

									</form>
									
								</li>
							</ul>
						</div>
					</div>
					@endif
				@endforeach
			</div>
		</div>

	</div>


@endsection
