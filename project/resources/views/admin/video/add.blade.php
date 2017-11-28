@extends('layout/admin')
@section('title','添加视频')
<style type="text/css">
    #cuowu{
        color:red;
    }
    #area{
        width: 150px!important;
    }
    .mws-form-label{
        font-size: 14px;
    }
    .mws-form-item{
        font-size: 10px;
        color: black;
    }
    #ann{
        /*font-size: 12px;*/
        cursor: pointer;
    }
    #doc-form-file{
        width: 120px;
        height: 25px;
        /*cursor: pointer!important;*/
        font-size: 12px;
        /*margin-top: 10px;*/

    }
    .tpl-form-file-img{
        font-size: 12px;
        color: #666;
        margin-bottom: 20px;

    }
    #video{
        width: 200px;
        opacity: 1;
        margin-left: 50px;
        position: relative;
    }
    #wngbng{
        position: absolute;
        top: 23px;
        left: 55px;
        z-index: 9999;
    }
    .mws-form-label{
        cursor: default!important;
    }

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
   <script type="text/javascript" src="/admins/js/libs/jquery-1.8.3.min.js"></script>

@section('content')
    <!-- <link rel="stylesheet" href="/admins/video/css/amazeui.min.css" /> -->
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
    					<input type="text" class="large" name="title" required>
    				</div>
    			</div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">主演</label>
    				<div class="mws-form-item">
    					<input type="text" class="large" name="actor" required>
    				</div>
    			</div>
                <div class="mws-form-row">
                    <label class="mws-form-label">观看权限</label>
                    <div class="mws-form-item">
                        <select class="large" name="auth">
                            <option value="0" selected>免费</option>
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
                            <?php var_dump($v)?>
                            <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                        </select>
                        <select name="zitid" id="area">
                            <option value="-1">---请选择子分区---</option>

                        </select>
                    </div>
                </div>

<<<<<<< HEAD
=======
                        $.get('/admin/videoa',{fid:fid},function(data){
                            console.log(data);
                            // alert(arr);
                            area.innerHTML='';
                            for (var i = 0; i <data.length; i++) {
                                // console.log(data[i].id);
                                area.innerHTML += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                            };
                        },'json');
                        return false;
                    }
                    
                   
                </script>
>>>>>>> 6df54edc344bd742c73ffe9ff875a3ae388ec384
                <div class="mws-form-row">
                    <label class="mws-form-label">视频类型</label>
                    <div class="mws-form-item">
                        <select name="address" id="dress">
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
                        <input type="text" id="sp" name="sp" readonly>
                        <input type="button" value="上传文件" class="btn btn-info" id="moves">
                    </div>
                </div>
                <script type="text/javascript">
                    // alert($);
                    document.getElementById('moves').onclick=function(){

                        layer.alert('<form id="move" ><i class="icon-upload-2" id="wngbng"></i><input type="file" name="file_upload" id="video" value=""></form>',{
                                skin: 'layui-layer-molv',
                                btn: ['确认', '取消'],
                                area: ['300px', '200px'],
                                title: '上传文件',
                            yes:function(index){

                                    var imgPath = $("#video").val();
                                    if (imgPath == "") {
                                        alert("请选择上传视频文件！");
                                        return;
                                    }
                                    
                                    //判断上传文件的后缀名
                                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                    if (strExtension != 'mp4' && strExtension != 'flv' && strExtension != 'kux' && strExtension != 'wmv' && strExtension != 'rmvb' && strExtension != 'mkv' && strExtension != 'avi' && strExtension != 'rm' && strExtension != 'asf' && strExtension != 'mov' && strExtension != 'mp3' && strExtension != 'vod' && strExtension != 'dat') {
                                        layer.alert("请选择视频文件");
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
                                        url: "/admin/videochuan",
                                        data: formData ,
                                        cache: false,
                                        async: true,
                                        contentType: false,
                                        processData: false,
                                        beforeSend:function(){
                                              
                                            layer.load(2);
                                            // console.log(data);

                                          },
                                        success: function(data) {
                                            // layer.close(a);
                                            // $('#sp').attr('src',data);
                                            layer.closeAll('loading');
                                            $('#sp').val(data);
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            layer.alert("上传失败，请检查网络后重试");
                                            layer.closeAll('loading');
                                        }
                                    });
                                layer.close(index);
                            }
                        });

                        // $("#video").change(function (){ 
                        //     shipin();

                    // })
                    };
                </script>
                <div class="mws-form-row">
                    <label class="mws-form-label">上传封面图片</label>
                    <div class="mws-form-item">
                        <input type="text" id="tp" name="tp" readonly>
                        <input type="button" value="上传封面图片" class="btn btn-info" id="imgs">
                        
                    </div>
                </div>
               
                <script type="text/javascript">
                    // alert($);
                    document.getElementById('imgs').onclick=function(){
                        
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

                                    // var formData = new FormData();
                                    // formData.append('file',$("#video"));
                                   
                                    // console.log($("#video"));
                                  
                                     
                                    // $.get('/admin/videochuan',{'data':formData},function(data){
                                    //     console.log(data);
                                    // })
                                    $.ajaxSetup({
                                       headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    // alert("1234");
                                    $.ajax({
                                        type: "post",
                                        url: "/admin/videochuan",
                                        data: formData ,
                                        cache: false,
                                        async: true,
                                        contentType: false,
                                        processData: false,
                                        beforeSend:function(){
                                              
                                            layer.load(2);
                                            // console.log(data);

                                          },
                                        success: function(data) {
                                            // layer.close(a);
                                            // $('#sp').attr('src',data);
                                            layer.closeAll('loading');
                                            $('#tp').val(data);
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            alert("上传失败，请检查网络后重试");
                                            layer.closeAll('loading');
                                        }
                                    });
                                layer.close(index);
                            }
                        });

                        // $("#video").change(function (){ 
                        //     shipin();

                    // })
                    };
                </script>










                
    			
    				

                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>  
              
                <!--使用版-->  
                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.js"></script>  
              
                <!--开发版-->  
                <!-- <script type="text/javascript" charset="utf-8" src="editor_api.js"></script>   -->
                <script type="text/javascript" src="/ueditor/lang/zh-cn/zh-cn.js"></script> 
                <div class="mws-form-row">
                    <label class="mws-form-label">内容介绍</label>
                    <div class="mws-form-item">
                        <textarea name="content" id="content">视频内容介绍</textarea>  
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
                <input type="hidden" name="time" value="{{time()}}">
    		</div>
    		<div class="mws-button-row">
                {{ csrf_field() }}
    			<input type="submit" value="保存" id="baocun" class="btn btn-danger">
    		</div>
    	</form>
    </div>
</div>

  



                 <script type="text/javascript">
                    //  
                    var city=document.getElementById('city');
                    var area=document.getElementById('area');
                    var dress=document.getElementById('dress');
                    var sp=document.getElementById('sp');
                    var tp=document.getElementById('tp');
                    var fid;
                    var arr;
                    //点击提交时判断输入的内容是否为空，为空时弹框提示
                    $('#baocun').click(function(){
                        var fqid=city.value;
                        var zqid=area.value;
                        var dre=dress.value;
                        var shi=sp.value;
                        var tu=tp.value;
                        if (fqid==-1) {
                            layer.alert("请选择父分区");
                            return false;
                        }
                        if (zqid==-1) {
                            layer.alert("请选择子分区");
                            return false;
                        }
                        // console.log(dre);
                        if(dre==0){
                            layer.alert("请选择视频类型");
                            return false;
                        }
                        if(shi==''){
                            layer.alert("请上传视频文件");
                            return false;
                        }
                        if(tu==''){
                            layer.alert("请上传封面图片");
                            return false;
                        }
                        // return false;
                    })
                    //二级联动，父分区和子分区的遍历，根据父分区发送ajax
                    city.onchange=function(){
                        fid=this.value;

                        $.get('/admin/videoa',{fid:fid},function(data){
                            // console.log(data);
                            // alert(arr);
                            area.innerHTML='';
                            for (var i = 0; i <data.length; i++) {
                                // console.log(data[i].id);
                                area.innerHTML += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                            };
                        },'json');
                        return false;
                    }
                    
                   
                </script>

@endsection

