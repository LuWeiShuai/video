@extends('layout/admin')
@section('title','修改视频')

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
    	<span>修改视频</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="{{ url('/admin/video/'.$res['id'])}}" method="post" enctype="multipart/form-data">
    		<div class="mws-form-block">
    			<div class="mws-form-row">
    				<label class="mws-form-label">视频名称</label>
    				<div class="mws-form-item">
    					<input type="text" class="large" name="title" value="{{$res['title']}}">
    					
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">主演</label>
    				<div class="mws-form-item">
    					<input type="text" class="large" name="actor" value="{{$cres['actor']}}">
    				</div>
    			</div>
                <div class="mws-form-row">
                    <label class="mws-form-label">观看权限</label>
                    <div class="mws-form-item">
                        <select class="large" name="auth">
                            <option value="0" @if($res['auth']=='0')selected
                            @endif>免费</option>
                            <option value="1" @if($res['auth']=='1')selected
                            @endif>VIP</option>
                            <option value="2" @if($res['auth']=='2')selected
                            @endif>付费</option>
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">视频分区</label>
                    <div class="mws-form-item">
                        <select name="tid" id="city">
                            <option value="{{$fres['id']}}">{{$fres['name']}}</option>
                            @foreach($tres as $k=>$v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                        </select>
                        <select name="zitid" id="area">
                            <option value="{{$type['id']}}">{{$type['name']}}</option>

                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">视频类型</label>
                    <div class="mws-form-item">
                        <select name="address">
                            <option value="0" @if($cres['address']=='0')selected
                            @endif>---请选择类型---</option>
                            <option value="1" @if($cres['address']=='1')selected
                            @endif>内陆</option>
                            <option value="2" @if($cres['address']=='2')selected
                            @endif>欧美</option>
                            <option value="3" @if($cres['address']=='3')selected
                            @endif>日韩</option>
                        </select>
                    </div>
                </div>
    			<!-- <div class="mws-form-row">
    				<label class="mws-form-label">内容介绍</label>
    				<div class="mws-form-item">
    					<textarea rows="" name="content" cols="" class="large">{!!$cres['content']!!}</textarea>
    				</div>
    			</div> -->

                <script type="text/javascript" charset="utf-8" src="{{ url('/ueditor/ueditor.config.js')}}"></script>  
              
                <!--使用版-->  
                <script type="text/javascript" charset="utf-8" src="{{ url('/ueditor/ueditor.all.js')}}"></script>  
              
                <!--开发版-->  
                <!-- <script type="text/javascript" charset="utf-8" src="editor_api.js"></script>   -->
                <script type="text/javascript" src="{{ url('/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                <div class="mws-form-row">
                    <label class="mws-form-label">内容介绍</label>
                    <div class="mws-form-item">
                        <textarea name="content" id="content">{!!$cres['content']!!}</textarea>  
                        <script type="text/javascript">  
                            // var editor = new UE.ui.Editor();  
                            // editor.render("myEditor");  

                            //1.2.4以后可以使用一下代码实例化编辑器  
                            var ue = UE.getEditor('content', {
                                toolbars: [
                                    [ 'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 
            'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', '|',
             'preview', 'searchreplace', ]
                                ],
                                autoHeightEnabled: true,
                                autoFloatEnabled: true
                            });
                           
                        </script>  
                    </div>
                </div>
                <input type="hidden" name="status" value="1">
    		</div>
    		<div class="mws-button-row">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
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

        $.get("{{ url('/admin/videoa')}}",{fid:fid},function(data){
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
