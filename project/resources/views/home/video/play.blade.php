@extends('layout.home')
@section('title','播放页面')
@section('content')
<div class="show-top-grids">
				<div class="col-sm-8 single-left">
					<div class="song">
						<div class="song-info">
							<h3 id="title" align="center">{{ $res->title}}</h3>
					</div>
						<div class="video-grid">
							<iframe src="http://ozssihjsk.bkt.clouddn.com/videos/{{$res->url}}" allowfullscreen=""></iframe>
						</div>
					</div>						
					<script>
						window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"16"},"slide":{"type":"slide","bdImg":"0","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
					</script>
					<div class="clearfix"> </div>
					<div class="published">
							<script>
								$(document).ready(function () {
									size_li = $("#myList li").size();
									x=1;
									$('#myList li:lt('+x+')').show();
									$('#loadMore').click(function () {
										x= (x+1 <= size_li) ? x+1 : size_li;
										$('#myList li:lt('+x+')').show();
									});
									$('#showLess').click(function () {
										x=(x-1<0) ? 1 : x-1;
										$('#myList li').not(':lt('+x+')').hide();
									});
								});
							</script>
							<div class="load_more">	
								<ul id="myList">
									<li style="display: list-item;">
										<h4>Published on 15 June 2015</h4>
										<p>Nullam fringilla sagittis tortor ut rhoncus. Nam vel ultricies erat, vel sodales leo. Maecenas pellentesque, est suscipit laoreet tincidunt, ipsum tortor vestibulum leo, ac dignissim diam velit id tellus. Morbi luctus velit quis semper egestas. Nam condimentum sem eget ex iaculis bibendum. Nam tortor felis, commodo faucibus sollicitudin ac, luctus a turpis. Donec congue pretium nisl, sed fringilla tellus tempus in.</p>
									</li>
									<li>
										<p>Nullam fringilla sagittis tortor ut rhoncus. Nam vel ultricies erat, vel sodales leo. Maecenas pellentesque, est suscipit laoreet tincidunt, ipsum tortor vestibulum leo, ac dignissim diam velit id tellus. Morbi luctus velit quis semper egestas. Nam condimentum sem eget ex iaculis bibendum. Nam tortor felis, commodo faucibus sollicitudin ac, luctus a turpis. Donec congue pretium nisl, sed fringilla tellus tempus in.</p>
										<p>Nullam fringilla sagittis tortor ut rhoncus. Nam vel ultricies erat, vel sodales leo. Maecenas pellentesque, est suscipit laoreet tincidunt, ipsum tortor vestibulum leo, ac dignissim diam velit id tellus. Morbi luctus velit quis semper egestas. Nam condimentum sem eget ex iaculis bibendum. Nam tortor felis, commodo faucibus sollicitudin ac, luctus a turpis. Donec congue pretium nisl, sed fringilla tellus tempus in.</p>
										<div class="load-grids">
											<div class="load-grid">
												<p>Category</p>
											</div>
											<div class="load-grid">
												<a href="movies.html">Entertainment</a>
											</div>
											<div class="clearfix"> </div>
										</div>
									</li>
								</ul>
							</div>
					</div>
					<div class="all-comments">
						<div class="all-comments-info">
							<a href="#">所有评论(8,657)</a>
							<div class="box">
								<form action="" method="get">
									<input type="hidden" name="time" value="{{ date('Y-m-d',time()) }}">
									<textarea id="discuss" placeholder="Message" required=" " name="discuss"></textarea>
									{{csrf_field()}}
									<input type="submit" value="发送" id="dis">
									<div class="clearfix"> </div>
								</form>
							</div>
							<script>
								$.ajaxSetup({
							        headers: {
							            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							        }
								});								
								var title = $('#title').text();								
								var time = $('input[type=hidden]').val();								
								$('#dis').click(function(){		

									var discuss = $('#discuss').val();
									$.post("{{url('/home/discuss')}}",{'_token':'{{csrf_token()}}',dis:discuss,title:title,time:time},function(data){
										if(data == '评论失败'){
											
											// alert('请先登录在评论');
											layer.msg('请先登录,在评论');
										}else{
											layer.msg('评论成功!');
										}
									})
									return false;
								})
							</script>
							<div class="all-comments-buttons">
								<ul>
									<li><a href="#" class="top">顶层评论</a></li>
									<li><a href="#" class="top newest">最新评论</a></li>
									<li><a href="#" class="top my-comment">我的评论</a></li>
								</ul>
							</div>
						</div>
						<div class="media-grids">
							@foreach($res1 as $key=>$val)
							<?php $res2 = DB::table('info')->where('uid',$val->uid)->first(); ?>
							<div class="media" style="border:solid 1px #D4D3D3;margin:0px;padding:0px;">
								<h5 class="btn btn-info">{{ $res2->nikeName }}</h5>
								<div class="media-left" >
									<div style="width:50px;height:50px;margin:0px;padding:0px;border-radius:50%;overflow:hidden;"><img style="position:relative;top:-30px;left:-40px;" class="am-circle am-img-thumbnail" src="{{url('/homes/pic/'.$res2->profile)}}" alt=""></div>
								</div>
								<div class="media-body">
									<p>{{ $val->content}}</p>
								</div>
							</div>
							@endforeach							
						</div>
					</div>
				</div>
				<div class="col-md-4 single-right">
					<h3>排行榜</h3>
					<div class="single-grid-right">
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r1.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r2.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views </p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r3.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r4.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r5.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r6.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author">By <a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r1.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r2.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r3.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r4.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r5.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="single.html"><img src="/homes/images/r6.jpg" alt=""></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.html" class="title"> Nullam interdum metus</a>
								<p class="author"><a href="#" class="author">John Maniya</a></p>
								<p class="views">2,114,200 views</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>

@endsection