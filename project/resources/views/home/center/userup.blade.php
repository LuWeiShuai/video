@extends('/layout.Center')

@section('title','上传列表')

@section('content')
	<div class="upload">
			<!-- container -->
		<div class="container">
			<div class="upload-grids">
					<div class="upload-right">
					<form action="/home/userup" method="post" enctype="multipart/form-data">

						<div class="upload-file">
							<div class="services-icon">
								<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
							</div>
							<input type="file" name="title" value="Choose file..">
							<h5 style="text-align:center">选择提交的文件</h5>
							<br>	
						</div>
						<div class="upload-info">
							
						{{ csrf_field() }}
						<button class="btn btn-info">提交</button>
						</div>
						</form>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<!-- //container -->
		</div>
		<!-- //upload -->
@endsection