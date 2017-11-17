@extends('layout.admin')

@section('title','网站配置')

@section('content')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">内联表格</font></font></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="form_layouts.html">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站名称</font></font></label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small">
                    				</div>
                    			</div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站介绍</font></font></label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small">
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">链接地址</font></font></label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small">
                                        </div>
                                   </div>
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站logo</font></font></label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small">
                                        </div>
                                   </div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">权限</font></font></label>
                    				<div class="mws-form-item">
                    					<select class="large">
                    						<option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">关闭</font></font></option>
                    						<option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">开启</font></font></option>
                    					</select>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row" align="center">
                    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="修改" class="btn btn-danger"></font></font>
                    		</div>
                    	</form>
                    </div>    	
                </div>


@endsection