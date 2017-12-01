@extends('layout.home')
@section('title','尚视视频网')
@section('content')
<style type="text/css">
body{
	font-family:"微软雅黑";
}
	.main-grids{
		padding-top:0px;
		margin-top:0px;
	}
	.recommended ul{
		margin:0px!important;
		padding: 0px!important;
	} 
	.recommended li{
		margin-left: 10px;

		width: 95%;
		list-style: none;
	}
	.search_move{
		width: 15%;
		height: 200px;
		float: left;

	}
	.search_move img{
		height: 200px;
		width: 150px;
		
	}
	.search_move1{
		width: 20%;
		height: 130px;
		float: left;

	}
	.search_move1 img{
		height: 130px;
		width: 200px;
		
	}
	.clear{
		clear: both;
	}
	.search_right{
		width: 70%;
		float: left;
		margin-left: 15px;
		position: relative;

	}
	.search_title{
		width: 100%;
		height: 20px;
		font-size:16px;
		
		line-height: 20px;
		padding:5px;
	}
	.search_zhong{
		width: 100%;
		height: 20px;
		padding:5px;
		margin-top: 10px;
		color: #999999;
		
	}
	.search_time{
		width: 50%;
		float: left;
		font-size: 12px;
	}
	.search_type{
		float: left;
		font-size: 12px;
	}
	.search_content{
		clear: both;
		font-size: 12px;
		color: black;
		padding:5px;
		margin-top: 5px;
	}
	#bofang{
		margin-left: 5px;
		position: absolute;
		top:160px;
	}
	#bofang1{
		margin-left: 5px;
		position: absolute;
		top:90px;
	}
	.tou{
		width:90%;
		font-size: 24px;
		/*margin-top: -10px;*/
		margin-left: 10px;
		margin-bottom: 10px;
	}
















/*============分页的样式=============*/
	 .pagination{
            display: inline-block;
        }
        .pagination li{
            float: left;
        }
        .pagination li a{
            border-radius: 5px;
            color: #23abf0;
            padding: 6px 12px;
            float: left;

        }
        .pagination > li > a, .pagination > li > span {
            background-color: #fff;
            border: 1px solid #ddd;
            display: block;
            line-height: 1.2;
            margin-bottom: 5px;
            margin-right: 5px;
            position: relative;
            text-decoration: none;
        }
        .tpl-pagination .am-active a {
            background: none repeat scroll 0 0 #23abf0;
            border: 1px solid #23abf0;
            color: #fff;
            padding: 6px 12px;
        }
        .active span{
            /*background: none repeat scroll 0 0 #23abf0;*/
            background-color: #23ABF0!important;
            border: 1px solid #23abf0;
            color: #fff;
            padding: 6px 12px;
            border-radius: 5px;
        }
        .disabled span{
            border-radius: 5px;
            color: #23abf0;
            padding: 6px 12px;
            float: left;
        }
</style>
@if($cha==1)
	<div class="recommended" style="margin-top:50px ">
		<div class="tou">搜索结果</div>
		<hr>
		<ul>
			@if($ures[0]!='' || $res[0]!='')
				@foreach($res as $k=>$v)
				<li>
					<div class="search_move">
						<img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->logo}}">
					</div>
					<div class="search_right">
						<div class="search_title" title="">{!!$v->title!!}</div>
						<div class="search_zhong">
							<div class="search_time">发布时间:<span>{{date('Y-m-d',$cres[$k]->time)}}</span></div>
							<div class="search_type">视频类型:
								<span>
									@if($cres[$k]->address==1)内陆
	                                @elseif($cres[$k]->address==2)欧美
	                                @elseif($cres[$k]->address==3)日韩
	                                @endif
								</span>
							</div>
						</div>
						<div class="search_content">简介:<span>{{$cres[$k]->content}}</span></div>
						<a href="{{url('/home/play/'.$v->id)}}"><button class="btn btn-warning" id="bofang">立即播放</button></a>
					</div>
					<div class="clear" style="height: 20px;"></div>

				</li>
				@endforeach
				@foreach($ures as $k=>$v)
				<li>
					<div class="search_move1">
						<img src="http://ozssihjsk.bkt.clouddn.com/images/{{$v->pic}}">
					</div>
					<div class="search_right">
						<div class="search_title" title="">{!!$v->title!!}</div>
						<div class="search_zhong">
							<div class="search_time">发布时间:<span>{{date('Y-m-d',$v->time)}}</span></div>
							<div class="search_type">发布人:<span>{{$info[$k]->nikeName}}</span></div>
						</div>
						<div class="search_content">简介:<span>{{$v->content}}</span></div>
						<a href="{{url('/home/user_play/'.$v->id)}}"><button class="btn btn-warning" id="bofang1">立即播放</button></a>
					</div>
					<div class="clear" style="height: 20px;"></div>

				</li>
				@endforeach
			@elseif($res[0]=='' && $ures[0]=='')
				<div class="recommended" style="height: 282px ">
					<p style="margin-left: 50px;">没有找到您搜索的影片</p>
				</div>
			@endif
			<div class="clear"></div>
		</ul>
		<div class="clear"></div>
	</div>
	<!-- 分页的开始 -->
	 {!! $ures->appends($_GET)->render() !!}
	<!-- 分页的结束 -->
@elseif($cha==0)
	<div class="recommended" style="margin-top:50px;height: 331px ">
		请输入查询内容
	</div>
@endif        
@endsection