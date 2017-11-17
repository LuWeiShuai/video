@extends('layout/admin')
@section('title','添加管理员')


@section('content')

	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">内联表格</font></font></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="form_layouts.html">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">小文本字段</font></font></label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">中等文本字段</font></font></label>
                    				<div class="mws-form-item">
                    					<input type="text" class="medium">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">大的文本字段</font></font></label>
                    				<div class="mws-form-item">
                    					<input type="text" class="large">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">多行文本</font></font></label>
                    				<div class="mws-form-item">
                    					<textarea rows="" cols="" class="large"></textarea>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">下拉列表</font></font></label>
                    				<div class="mws-form-item">
                    					<select class="large">
                    						<option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选项1</font></font></option>
                    						<option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选项3</font></font></option>
                    						<option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选项4</font></font></option>
                    						<option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选项5</font></font></option>
                    					</select>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">复选框</font></font></label>
                    				<div class="mws-form-item clearfix">
                    					<ul class="mws-form-list inline">
                    						<li><input type="checkbox"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">复选框1</font></font></label></li>
                    						<li><input type="checkbox"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">复选框2</font></font></label></li>
                    						<li><input type="checkbox"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">复选框3</font></font></label></li>
                    						<li><input type="checkbox"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">复选框4</font></font></label></li>
                    					</ul>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">单选按钮</font></font></label>
                    				<div class="mws-form-item clearfix">
                    					<ul class="mws-form-list inline">
                    						<li><input type="radio"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收音机1</font></font></label></li>
                    						<li><input type="radio"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收音机1</font></font></label></li>
                    						<li><input type="radio"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收音机1</font></font></label></li>
                    						<li><input type="radio"> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收音机1</font></font></label></li>
                    					</ul>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="提交" class="btn btn-danger"></font></font>
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
@endsection