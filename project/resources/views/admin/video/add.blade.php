@extends('layout/admin')
@section('title','添加视频')
<style type="text/css">
    #cuowu{
        color:red;
    }
    #area{
        width: 150px!important;
    }
</style>
@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>添加视频</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/video" method="post" enctype="multipart/form-data">
    		<div class="mws-form-block">
    			<div class="mws-form-row">
    				<label class="mws-form-label">视频名称</label>
    				<div class="mws-form-item">
    					<input type="text" class="large" name="title">
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">主演</label>
    				<div class="mws-form-item">
    					<input type="text" class="large" name="actor">
    				</div>
    			</div>
                <div class="mws-form-row">
                    <label class="mws-form-label">观看权限</label>
                    <div class="mws-form-item">
                        <select class="large" name="auth">
                            <option value="0">免费</option>
                            <option value="1">VIP</option>
                            <option value="2">付费</option>
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">视频分区</label>
                    <div class="mws-form-item">
                        <select name="tid" id="city">
                            <option value="-1">---请选择父分区---</option>
                            @foreach($res as $k=>$v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                        </select>
                        <select name="zitid" id="area">
                            <option value="-1">---请选择子分区---</option>

                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">视频类型</label>
                    <div class="mws-form-item">
                        <select name="address">
                            <option value="0">---请选择类型---</option>
                            <option value="1">内陆</option>
                            <option value="2">欧美</option>
                            <option value="3">日韩</option>
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">上传文件</label>
                    <div class="mws-form-item">
                        <div class="fileinput-holder" style="position: relative;"><input type="file" name="url" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;" value=""></div>
                    </div>
                    @if(!empty(session('into')))
                       <p id="cuowu">* {{session('into')}}</p>
                    @endif
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">封面图片</label>
                    <div class="mws-form-item">
                        <div class="fileinput-holder" style="position: relative;"><input type="file" name="logo" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;" value=""></div>
                    </div>
                    @if(!empty(session('info')))
                       <p id="cuowu">* {{session('info')}}</p>
                    @endif
                </div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">内容介绍</label>
    				<div class="mws-form-item">
    					<textarea rows="" name="content" cols="" class="large"></textarea>
    				</div>
    			</div>
                
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="time" value="{{time()}}">
    		</div>
    		<div class="mws-button-row">
                {{ csrf_field() }}
    			<input type="submit" value="保存" class="btn btn-danger">
    		</div>
    	</form>
    </div>
</div>
<script type="text/javascript">
    var city=document.getElementById('city');
    var area=document.getElementById('area');
    var fid;
    var arr;
    city.onchange=function(){
        fid=this.value;

        $.get('/admin/videoa',{fid:fid},function(data){
            // console.log(data);
            // alert(arr);
            area.innerHTML='';
            for (var i = 0; i <data.length; i++) {
                // console.log(data[i].name);
                area.innerHTML += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
            };
        },'json');
        return false;
    }
        
</script>
@endsection
