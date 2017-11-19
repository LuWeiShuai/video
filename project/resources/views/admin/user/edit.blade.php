@extends('layout/admin')
@section('title','用户修改')


@section('content')
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">内联表格</font></font></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="{{ url('/admin/user/'.$res->id) }}" method="post">
                              {{ csrf_field() }}
                            {{method_field('PUT')}}

                    		<div class="mws-form-inline">
                           <div class="mws-form-row">
                                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手机号</font></font></label>
                                <div class="mws-form-item">
                                     <input type="text" class="small" name="tel" value="{{ $res->tel }}">
                              </div>
                           </div>
                            <div class="mws-form-row">
                                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上次登陆时间</font></font></label>
                                <div class="mws-form-item">
                                     <input type="text" class="small" name="lastlogin" value="{{ $res->lastlogin }}" readonly>
                                </div>
                           </div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户观看权限</font></font></label>
                    				<div class="mws-form-item">
                    					<select class="large" name="status">
                    						<option value="0" @if($res->status == 0) selected @endif><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">普通用户</font></font></option>
                    						<option value="1" @if($res->status == 1) selected @endif><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">vip用户</font></font></option>
                    					</select>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row" align="center">
                    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="提交" class="btn btn-danger"></font></font>
                    		</div>
                    	</form>
                    </div>    	
                </div>
@endsection