<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>二维码</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="/phone/public/js/jquery.min.js"></script>
    <script src="/phone/public/bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <script type="text/javascript" src="/phone/public/js/webuploader/webuploader.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/jquery.layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/phone/public/js/webuploader/webuploader.css">
    <style>
        .hd-pic-block img{
            width: 100%;
        }
        .webuploader-pick{
            background: #ffffff;
        }
    </style>
</head>

<body>
<form action="/phone/leader/activity/qrcode_save" style="padding: 10px;" method="post">
    <div class="form-group">
    <div style="width: 230px;margin: 0 auto">
    <input type="hidden" value="{$info['id']}" name="id">
    <span class="hd-pic-block" >
        <img  src="{$info['qrcode']}" />
        <input type="hidden" value="{$info['qrcode']}" name="qrcode">
    </span>
    </div>
    </div>
    <p style="text-align: center">{$info['title']}</p>
    <p style="text-align: center">更新时间：{date('Y-m-d H:i:s',$info['qrcode_up_time'])}</p>
    <div class="clearfix"></div>
   <button style="margin: 0px auto;display: table;" type="submit" class="btn btn-default">保存</button>

</form>


{request 'pub/code'}


</body>
<script>
    // 初始化Web Uploader
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,

        // 文件接收服务端。
        server: SITEURL+'/pub/upload_image?input_name=Filedata',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '.hd-pic-block',

        fileVal: 'Filedata',
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });

    uploader.on('uploadProgress',function(){
        $.layer({
            type:4
        })
    })
    uploader.on('uploadComplete',function(){
        $.layer.close();
    })

    uploader.on( 'uploadSuccess', function( file,response ) {
        if(response.success=='true') {
            var html = '<img src="'+response.litpic+'" /> <input type="hidden" value="'+response.litpic+'" name="qrcode">';
            $('.hd-pic-block').html(html);
        }else{
            alert(response.msg);
        }

    });
    //上传图片
    $('.hd-pic-block').click(function(){
        $('#addfile input[type="file"]').trigger('click');
    })

</script>
</html>
