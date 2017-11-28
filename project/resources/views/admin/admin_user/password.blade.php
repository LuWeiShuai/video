@extends('layout/admin')
@section('title','修改密码')


@section('content')

     @if (count($errors) > 0)
          <div class="mws-form-message error">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li style='font-size:17px;list-style:none'>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加管理员</font></font></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="{{ url('/admin/center/dopassword') }}" method="post">
                              {{ csrf_field() }}
                    		<div class="mws-form-inline">                   		
                           <div class="mws-form-row">
                                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">密码</font></font></label>
                                <div class="mws-form-item">
                                     <input type="password" class="small" name="password">
                                </div>
                           </div>
                           <div class="mws-form-row">
                                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">确认密码</font></font></label>
                                <div class="mws-form-item">
                                     <input type="password" class="small" name="repassword">
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

@section('script')
<script> 
    $('.mws-form-message').delay(1000).slideUp(1000);
</script>
@endsection
