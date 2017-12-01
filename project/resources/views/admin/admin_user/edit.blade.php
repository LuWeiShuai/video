@extends('layout/admin')
@section('title','管理员修改')


@section('content')
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">管理员修改</font></font></span>
                    </div>
                    @if(session('msg'))
                    <div class="mws-form-message info">                 

                        {{session('msg')}}

                    </div>
                    @endif
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="{{ url('/admin/admin_user/'.$res->id) }}" method="post">
                              {{ csrf_field() }}
                            {{method_field('PUT')}}

                    		<div class="mws-form-inline">
                           <div class="mws-form-row">
                                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户名</font></font></label>
                                <div class="mws-form-item">
                                     <input type="text" class="small" name="userName" value="{{ $res->userName }}">
                              </div>
                           </div>
                            <div class="mws-form-row">
                                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手机号</font></font></label>
                                <div class="mws-form-item">
                                     <input type="text" class="small" name="phone" value="{{ $res->phone }}">
                                </div>
                           </div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">管理员权限</font></font></label>
                    				<div class="mws-form-item">
                    					<select class="large" name="auth">
                    						<option value="0" @if($res->auth== 0) selected @endif><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">普通管理员</font></font></option>
                    						<option value="1" @if($res->auth == 1) selected @endif><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">视频管理员</font></font></option>
                                            <option value="2" @if($res->auth == 2) selected @endif><font 
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">超级管理员</font></font></option>
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
@section('script')
<script>

    $('.mws-form-message').delay(3000).slideUp(1000);

</script>

@endsection
