@extends('layout/admin')
@section('title','添加分区')


@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>分区添加页面</span>
    </div>

   <!--  @if(count($errors) > 0)
    		<div class="mws-form-message error">
    			<ul>
    				@foreach($errors->all() as $error)
    					<li style="font-size: 17px; list-style:none">{{$error}}</li>
    				@endforeach
    			</ul>
    
    		</div>
    	@endif  -->

    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/type/store" method="post" enctype="multipart/form-data">
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">父分区名:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name="username" value="">
    				</div>
    			</div>
    			

    		</div>
    		<div class="mws-button-row">
    			{{ csrf_field()}}
    			<input type="submit" value="添加" class="btn btn-danger">
    			
    		</div>
    	</form>
    </div>    	
</div>
@endsection