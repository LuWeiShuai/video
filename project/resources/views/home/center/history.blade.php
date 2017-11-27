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
				<div class="col-md-3 resent-grid recommended-grid">
					<div class="resent-grid-img recommended-grid-img">
						<a href="http://ozssihjsk.bkt.clouddn.com/videos/{{$v->url}}">
							<img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->logo}}" alt="" style="height:150px;width: 180px;">
						</a>
						
					</div>
					<div class="resent-grid-info recommended-grid-info video-info-grid">
						<h5>
							<a href="http://ozssihjsk.bkt.clouddn.com/videos/{{$v->url}}" class="title">{{$v->title}}</a>
						</h5>
						<ul>
							<li>
								<p class="author author-info">最后播放时间：{{$v->time}}</p>
							</li>
						</ul>
					</div>
				</div>
				@endforeach
				<div class="clearfix"> </div>
			</div>
		</div>

	</div>
@endsection
