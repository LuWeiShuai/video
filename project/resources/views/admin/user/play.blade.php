@extends('layout.admin')
@section('title','播放页面')
@section('content')
			<div class="show-top-grids" >
				<div class="col-sm-8 single-left">
					<div class="song">
						<div class="song-info">
							<h3 id="title" align="center"></h3>
					</div>
						<div class="video-grid" >
							<iframe style="width:70%;height:450px;margin-left: 150px;border:solid 1px black" src="http://ozssihjsk.bkt.clouddn.com/videos/{{$res->url}}" allowfullscreen=""></iframe>
						
						</div>
						
					</div>
				</div>
			</div>
			<br>
			<br>
			<ul style="font-size:20px;list-style: none;margin-left: 300px ">
				<li style="font-size:20px;color:#333333"><b style="font-size: 25px;color:#999999">&nbsp;&nbsp;&nbsp;&nbsp;演员 :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$res->actor}}</li>
					<br><br>
					<li style="font-size:20px;color:#333333"><b style="font-size: 25px;color:#999999">内容简介 :</b> &nbsp;&nbsp;&nbsp;{{$res->content}}</li>

			</ul>
					
				
			<div style="margin-left: 350px">
				<a href="{{ url('/admin/userup/'.$res->id) }}"><button class="btn btn-danger">通过</button></a>
                <form action="{{ url('/admin/userup/'.$res->id) }}" method='post' style='display:inline'>
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input type="submit" value="不通过" class="btn btn-warning">
               </form>
			</div>
@endsection