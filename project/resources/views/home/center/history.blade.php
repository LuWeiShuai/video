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
					<div class="resent-grid-img recommended-grid-img" style="margin-top: 15px;">
						<a href="/home/play/{{$v->vid}}">
							<img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->logo}}" style="height:150px;width: 100%;">
						</a>
					</div>
					
					<div class="resent-grid-info recommended-grid-info video-info-grid">
						<ul>
							<li>
								<a href="/home/play/{{$v->vid}}" class="title">{{$v->title}}</a>

							</li>
						</ul>
						<ul>
							<li>
								<p class="author author-info">最后播放时间：{{$v->time}}</p>
							</li>
							<li>
    							{{ csrf_field()}}

								<span id="{{$v->id}}" class="btn btn-danger" onclick="del({{$v->id}})">删除记录</span>
								
								
							</li>
						</ul>
					</div>
				</div>
				@endforeach
				<script type="text/javascript">
					
			    	var del = function(id)
			    	{

			    		$.get('/home/center/delete',{id:id},function(data){
			    			 layer.alert(data);

			    		});
			    	}
				</script>

			</div>
		</div>

	</div>
@endsection
