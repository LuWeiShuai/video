@extends('layout.admin')

@section('title','网站配置')

@section('content')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">内联表格</font></font></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	@foreach($res as $k=>$v)
                         <form class="mws-form" action="/admin/config/{{$v->id}}" method="post" enctype="multipart/form-data">    
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站名称</font></font></label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="{{$v->name}}">
                    				</div>
                    			</div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站介绍</font></font></label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small" name="keywords" value="{{$v->keywords}}">
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">链接地址</font></font></label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small" name="url" value="{{$v->url}}">
                                        </div>
                                   </div>
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站logo</font></font></label>
                                        <div class="mws-form-item">
                                             <input type="file" class="small" name="logo" value="{{$v->logo}}">
                                             <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                        </div>
                                   </div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">权限</font></font></label>
                    				<div class="mws-form-item">
                    					<select name="status" class="large">
                    						<option value="0"
                                                {{$v->status==0?'selected':''}}><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">关闭</font></font></option>
                    						<option value="1"
                                                  {{$v->status==1?'selected':''}}><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">开启</font></font></option>
                    					</select>
                    				</div>
                    			</div>
                                   @endforeach
                                   
                                   {{ csrf_field() }}
                              {{ method_field('PUT') }}
                    		</div>
                    		<div class="mws-button-row" align="center">
                    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="修改" class="btn btn-danger"></font></font>
                    		</div>
                    	</form>
                    </div>    	
                </div>


@endsection