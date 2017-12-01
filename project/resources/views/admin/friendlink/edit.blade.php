@extends('layout/admin')
@section('title','修改链接')


@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>链接修改页面</span>
    </div>

        @if(count($errors) > 0)
            <div class="mws-form-message error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li style="font-size: 17px; list-style:none">{{$error}}</li>
                    @endforeach
                </ul>
        
            </div>
        @endif 
    
    <div class="mws-panel-body no-padding">

    	<form class="mws-form" action="{{ url('/admin/friendlink/'.$res->id)}}" method="post">
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">链接名称:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name="linkName" value="{{$res->linkName}}">
    				</div>
                    <br>
                    <label class="mws-form-label">关键字:</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="keywords" value="{{$res->keywords}}">
                    </div>
                    <br>
                    <label class="mws-form-label">链接地址:</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="url" value="{{$res->url}}">
                    </div>
    			</div>
    			

    		</div>
    		<div class="mws-button-row">
    			{{ csrf_field()}}
                {{method_field('PUT')}}

    			<input type="submit" value="修改" class="btn btn-danger">
    			
    		</div>
    	</form>
    </div>    	
</div>
@endsection



@section('script')
<script>

    $('.mws-form-message').delay(3000).slideUp(1000);

</script>

@endsection