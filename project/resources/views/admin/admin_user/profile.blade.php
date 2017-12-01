@extends('layout/admin')
@section('title','修改头像')


@section('content')
  
<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="mws-panel grid_8">
      	<div class="mws-panel-header">
          	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加管理员</font></font></span>
          </div>
          <div class="mws-panel-body no-padding">
          	<form class="mws-form" action="{{ url('/admin/center/doprofile') }}" method="post">
                    {{ csrf_field() }}
          		<div class="mws-form-inline">
          			<div class="mws-form-row">
                  <?php $res = DB::table('admin')->where('id',session('id'))->first(); ?>
          				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户</font></font></label>
          				<div class="mws-form-item">
          					<input type="text" class="small" name="userName" value="{{ $res->userName}}" readonly>
          				</div>
          			</div>
                  <div class="mws-form-row">
                      <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">头像</font></font></label>
                      <div class="mws-form-item">
                           <input type="text" class="small" name="profile" value="" style="width:150px;">
                           <input type="button" value="上传头像" class="btn btn-info" id="imgs">       
                      </div>
                 </div>
                  <script type="text/javascript">
                                      
                document.getElementById('imgs').onclick=function(){
                 // alert(123);
                    layer.alert('<form id="move" ><i class="icon-upload-2" id="wngbng"></i><input type="file" name="file_upload" id="video" value=""></form>',{
                            skin: 'layui-layer-molv',
                            btn: ['确认', '取消'],
                            area: ['300px', '200px'],
                            title: '上传文件',
                        yes:function(index){

                                var imgPath = $("#video").val();
                                if (imgPath == "") {
                                    alert("请选择上传图片！");
                                    return;
                                }
                                
                                //判断上传文件的后缀名
                                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                if (strExtension != 'jpg' && strExtension != 'gif'
                                    && strExtension != 'png' && strExtension != 'bmp' && strExtension != 'jpeg') {
                                    alert("请选择图片文件");
                                    return;
                                }

                                var formData = new FormData($('#move')[0]);

                                $.ajaxSetup({
                                   headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                // alert("1234");
                                $.ajax({
                                    type: "post",
                                    url: "{{url('/admin/center/up')}}",
                                    data: formData ,
                                    cache: false,
                                    async: true,
                                    contentType: false,
                                    processData: false,
                                    beforeSend:function(){
                                          
                                        layer.load(2);

                                      },
                                    success: function(data) {
                                        layer.closeAll('loading');
                                        $('input[name=profile]').val(data);
                                        // alert(data);
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert("上传失败，请检查网络后重试");
                                        layer.closeAll('loading');
                                    }
                                });
                            layer.close(index);
                        }
                    });
                };
                </script>
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
