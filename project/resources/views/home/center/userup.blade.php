@extends('layout.Center')
@section('title','上传视频')
<meta name="csrf-token" content="{{ csrf_token() }}">

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

@section('content')
    <div class="user-info">
        <!--标题 -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">上传视频</strong></div>
        </div>
        <hr/>
        <!--上传视频 -->
        <div class="info-main">
            <form action="/home/videos" method="post" class="am-form am-form-horizontal">

                <div class="am-form-group">
                    <label for="video-name" class="am-form-label">视频名称</label>
                    <div class="am-form-content" id="aa">
                        <input id="vname" placeholder="请输入视频名称" type="text" value="" name="title">   
                    </div>                   
                </div>
                <div class="am-form-group">
                    <label for="video-name" class="am-form-label">视频介绍</label>
                    <div class="am-form-content" id="aa">
                        <input id="vname" placeholder="请输入视频介绍" type="text" value="" name="content">   
                    </div>                   
                </div>
                <label  class="am-form-label">主演:</label>
                    <div class="am-form-content">                        
                        <input id="user-phone" placeholder="主演名称" type="text" name="actor">
                    </div>
                <br>
                <br>
                <label  class="am-form-label">图片:</label>
                <div class="am-form-content">
                    <input type="text" name="pic" id="tu" style="width:150px;float:left" />
                    <input type="button" value="上传封面图片" class="btn btn-info" id="upic">
                    <script src="/layer/layer.js"></script>

                        <script type="text/javascript">
                        document.getElementById('upic').onclick=function(){
                                // alert($);
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
                                        url: "/home/picchuan",
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
                                            $('#tu').val(data);
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            alert("上传失败，请检查网络后重试");
                                            layer.closeAll('loading');
                                        }
                                    });
                                layer.close(index);
                            }
                        });

                     }

                             
                </script>
                </div>
                <br>
                <br>
                <label  class="am-form-label">视频:</label>
                <div class="am-form-content">
                    <input type="text" name="url" id="shipin" style="width:150px;float:left" />
                    <input type="button" value="上传视频" class="btn btn-danger" id="uvideo">
                </div>
                <script type="text/javascript">
                    document.getElementById('uvideo').onclick=function(){

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
                                    if (strExtension != 'mp4' && strExtension != 'flv'
                                        && strExtension != 'wmv' && strExtension != 'rmvb' && strExtension != 'mkv' && strExtension != 'avi' && strExtension != 'rm' && strExtension != 'asf' && strExtension != 'mov' && strExtension != 'mp3' && strExtension != 'vod' && strExtension != 'dat' && strExtension != 'kux') {
                                        alert("请选择视频文件");
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
                                        url: "/home/picchuan",
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
                                            console.log(data);
                                            layer.closeAll('loading');
                                            $('#shipin').val(data);
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            alert("上传失败，请检查网络后重试");
                                            layer.closeAll('loading');
                                        }
                                    });
                                layer.close(index);
                            }
                        });

                    }


                </script>
                <br>
                <input type="hidden" name="uid" value="{{session('uid')}}">
                <input type="hidden" name="time" value="{{time()}}">
                <input type="hidden" name="username" value="{{$res->nikeName}}">
                <br>
                <div class="info-btn">
                    {{ csrf_field()}}

                    <input type="submit" value="上传" class="btn btn-danger">
                </div>

            </form>
        </div>

    </div>
@endsection