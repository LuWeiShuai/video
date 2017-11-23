<!DOCTYPE html>
<html>
<head>
    <title>上传图片</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('admins/js/libs/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('layer/layer.js') }}" type="text/javascript"></script>
</head>
<body>
    <form  id="art_form" >
        {{csrf_field()}}
        <input type="text" name="art_thumb" id="art_thumb"  value="{{old('art_thumb')}}" >
        <input type="file" name="file_upload" id="file_upload" value="">
        <p><img src="{{ asset('/1.jpg')}}" alt="" id="img1" style="width:100px" ></p>
    </form>
    
    <script type="text/javascript">
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $(function () {
                                $("#file_upload").change(function (){ 
                                    uploadImage();
                                });
                            });
                            function uploadImage() {
//                            判断是否有选择上传文件
//                            input type file
                                var imgPath = $("#file_upload").val();
                                if (imgPath == "") {
                                    alert("请选择上传图片！");
                                    return;
                                }
                                //判断上传文件的后缀名
                                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                if (strExtension != 'jpg' && strExtension != 'gif'
                                    && strExtension != 'png' && strExtension != 'bmp') {
                                    alert("请选择图片文件");
                                    return;
                                }
                                var formData = new FormData($( "#art_form" )[0]);
                                console.log(formData);
                                $.ajax({
                                    type: "post",
                                    url: "/admin/videochuan",
                                    data: formData,
                                    async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    beforeSend:function(){
                                          // 菊花转转图
                                          // $('#img1').attr('src', 'http://img.lanrentuku.com/img/allimg/1212/5-121204193R0-50.gif');
                                          //
                                           a = layer.load();

                                      },
                                    success: function(data) {
                                        layer.close(a);
                                        $('#img1').attr('src','5.jpg');
                                     

<<<<<<< HEAD
                                      $('#art_thumb').val(data);
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert("上传失败，请检查网络后重试");
                                        $('#img1').attr('src','1.jpg');
                                    }
                                });
                            }
                        </script>
                    
</body>
</html>
=======
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
                
            </div>
        </div>
    </body>
</html>
>>>>>>> 7fe8c53bfca07635f98453c21768ad15a3648740
