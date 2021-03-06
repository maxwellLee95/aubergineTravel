<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>领队认证</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <script type="text/javascript" src="/phone/public/js/lib-flexible.js"></script>
    <script type="text/javascript" src="/phone/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/template.js"></script>
    <script type="text/javascript" src="/phone/public/js/layer/layer.m.js"></script>
    <script type="text/javascript" src="/phone/public/js/webuploader/webuploader.min.js"></script>
</head>
<style>
    /* 全局搜索 */
    body{
        margin: 0;
        padding: 0;
    }
    .st-search{
        padding: 0.266667rem;
        margin-bottom: 0.266667rem;
        background: #fff
    }
    .st-search-box{
        height: 1rem;
        overflow: hidden;
        position:relative;
        -webkit-border-radius: 0.1rem;
        border-radius: 0.1rem;
        background:#eaeaea
    }
    .st-search-box .st-search-text{
        width: 100%;
        height: 1rem;
        line-height: 1rem;
        padding: 0 0.2rem;
        font-size: 0.373333rem;
        background:#eaeaea;
    }
    .st-search-box .st-search-btn{
        display:block;
        width: 0.693333rem;
        height: 0.693333rem;
        position:absolute;
        right: 0.2rem;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        background:url("../images/faq-search-btn-icon.png") center no-repeat;
        background-size: contain;}

    .order-topfix-menu{
        display: -webkit-box;
        display: -moz-box;
        height: 1.2rem;
        margin-bottom: 0.266667rem;
        background: #fff
    }
    .order-topfix-menu.fixed{
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
    }
    .order-topfix-menu .item{
        color: #666;
        display: block;
        width: 50%;
        height: 1.2rem;
        line-height: 1.2rem;
        -webkit-box-flex: 1;
        -moz-box-flex: 1;
        text-align: center;
        font-size: 0.373333rem
    }
    .order-topfix-menu .item.on{
        color: #22a4e0;
        border-bottom: 2px solid #22a4e0
    }


    .travel-diary-content{

    }
    .travel-diary-list{

    }
    .travel-diary-list .item{
        padding: 0.4rem;
        margin-bottom: 0.266667rem;
        background: #fff
    }
    .travel-diary-list .item:last-child{
        margin-bottom: 0
    }
    .travel-diary-list .item .pic{
        display: block;
        width: 100%;
        height: 4.6rem;
        position: relative;
        margin-bottom: 0.4rem;
        overflow: hidden;
        background: #e7e7e7
    }
    .travel-diary-list .item .pic img{
        max-width: 100%;
        max-height: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
    }
    .travel-diary-list .item .tit{
        display: block;
        max-height: 0.96rem;
        line-height: 0.48rem;
        margin-bottom: 0.4rem;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        font-size: 0.373333rem
    }
    .travel-diary-list .item .info{
        display: -webkit-box;
        display: -moz-box;
        padding-top: 0.4rem;
        border-top: 1px solid #f3f3f3;
    }
    .travel-diary-list .item .info .label{
        display: block;
        color: #999;
        width: 33.333333%;
        -webkit-box-flex: 1;
        -moz-box-flex: 1;
        font-size: 0.373333rem
    }
    .travel-diary-list .item .info .num{
        text-align: right;
    }
    .travel-diary-list .item .info .num .icon{
        display: inline-block;
        width: 0.4rem;
        height: 0.4rem;
        vertical-align: middle;
        margin: -0.08rem 0.2rem 0 0;
        background: url("../images/look-icon.png") center no-repeat;
        background-size: contain;
    }


    .list_more{
        padding: 0.266667rem 0;
        text-align: center;
    }
    .list_more .more-link{
        color: #ff6b1a;
        display: inline-block;
        width: 2.92rem;
        height: 0.88rem;
        line-height: 0.88rem;
        border: 1px solid #e9e9e9;
        border-radius: 0.08rem;
        font-size: 0.373333rem;
        background: #fff
    }

    .travel-diary-show{
        background: #fff
    }
    .travel-diary-hd{
        width: 100%;
        height: 5rem;
        position: relative;
        overflow: hidden;
        background: #e7e7e7
    }
    .travel-diary-hd .tit{
        color: #fff;
        padding: 0.2rem;
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        font-size: 0.48rem;
        background: rgba(0,0,0,.3)
    }
    .travel-diary-hd img{
        max-width: 100%;
        max-height: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 99;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
    }

    .travel-diary-info{
        display: -webkit-box;
        display: -moz-box;
        padding: 0.4rem;
        border-top: 1px solid #f3f3f3;
    }
    .travel-diary-info .label{
        display: block;
        color: #999;
        width: 33.333333%;
        text-align: center;
        -webkit-box-flex: 1;
        -moz-box-flex: 1;
        font-size: 0.373333rem
    }
    .travel-diary-info .num .icon{
        display: inline-block;
        width: 0.4rem;
        height: 0.4rem;
        vertical-align: middle;
        margin: -0.08rem 0.2rem 0 0;
        background: url("../images/look-icon.png") center no-repeat;
        background-size: contain;
    }

    .travel-diary-key{
        color: #666;
        line-height: 0.6rem;
        padding: 0.4rem;
        margin: 0 0.4rem;
        border: 1px solid #e6e6e6;
        font-size: 0.32rem
    }
    .travel-diary-content{
        color: #666;
        line-height: 0.6rem;
        padding: 0.4rem;
        font-size: 0.32rem
    }
    .travel-diary-content *{
        max-width: 100%
    }

    .comment-bom-bar{
        height: 1.2rem;
    }
    .comment-fix-bar{
        height: 1.2rem;
        display: -webkit-box;
        display: -moz-box;
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 0 0.2rem;
        border-top: 1px solid #edecec;
        background: #fff;
    }
    .comment-fb-link{
        display: block;
        height: 0.9rem;
        line-height: 0.9rem;
        padding: 0 0.2rem;
        margin-top: 0.13rem;
        -webkit-box-flex: 1;
        -moz-box-flex: 1;
        border: 0;
        font-size: 0.32rem;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #eee;
    }
    .comment-list-link{
        display: block;
        width: 0.8rem;
        height: 0.8rem;
        margin: 0.266667rem 0.4rem 0 0.266667rem;
        position: relative;
        background: url("../images/comment-icon.png") center no-repeat;
        background-size: contain;
    }
    .comment-list-link em{
        display: inline-block;
        color: #fff;
        min-width: 0.48rem;
        height:0.48rem;
        line-height: 0.48rem;
        padding: 0 0.08rem;
        text-align: center;
        position: absolute;
        bottom: 0;
        right: -30%;
        font-size: 0.32rem;
        font-style: normal;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        background: #e8645f;
    }
    /*今日推荐*/
    .mt-20{
        margin-top: 0.266666rem;
    }
    .mb-20{
        margin-bottom: 0.266666rem;
    }
    .recommend-show{
        background: #fff;
        padding: 0 0.4rem;
    }
    .recommend-title-bar{
        width: 9.2rem;
        margin: 0 auto;
        height: 1.2rem;
        line-height: 1.2rem;
        position: relative;
        overflow: hidden;
    }
    .recommend-title-bar .line-icon{
        display: inline-block;
        width: 0;
        height: 0.48rem;
        vertical-align: middle;
        margin: -0.2rem 0.2rem 0 0;
        border-left: 0.08rem solid #ff6b1a;
    }
    .recommend-title-bar .title-txt {
        display: inline-block;
        font-size: 0.426667rem;
    }
    .recommend-title-bar .del-icon{
        position: absolute;
        right:0;
        top: 50%;
        margin-top: -0.28rem;
        width: 0.56rem;
        height: 0.56rem;
        background: url(../images/recommend-del-icon.png) no-repeat;
        background-size: contain;
    }
    .recommend-list{
        width: 9.2rem;
        margin: 0 auto;
        padding-bottom: 0.266666rem;
    }
    .recommend-list li{
        float: left;
        width: 4.4rem;
        margin-right: 0.4rem;
    }
    .recommend-list li.mr-0{
        margin-right: 0;
    }
    .recommend-list li > a{
        display: block;
    }
    .recommend-list li .pic{
        width: 4.4rem;
        height: 2.986666rem;
        overflow: hidden;
        position: relative;
        background: #e7e7e7;
    }
    .recommend-list li .pic img{
        max-width: 100%;
        max-height: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
    }
    .recommend-list li .bt{
        font-size: 0.373333rem;
        line-height: 0.426666rem;
        height: 0.853333rem;
        overflow: hidden;
        margin-top: 0.106666rem;
    }
    .recommend-list li .attr{
        margin-top: 0.133333rem;
    }
    .recommend-list li .price{
        float: left;
        width: 50%;
        color: #fc6000;
        font-size: 0.32rem;
        overflow: hidden;
    }
    .recommend-list li .price b{
        font-size: 0.373333rem;
    }
    .recommend-list li .myd{
        float: right;
        width: 50%;
        text-align: right;
        color: #999999;
        font-size: 0.32rem;
        overflow: hidden;
    }
    .recommend-list li .myd em{
        color: #fc6000;
        font-style: normal;
    }



    /* 列表 */
    .travel-notes-wrapper{}
    .travel-notes-wrapper .item{
        padding: 0.333333rem;
        margin-bottom: 0.333333rem;
        background: #fff
    }
    .travel-notes-wrapper .item:last-child{
        margin-bottom: 0
    }
    .tn-tip-bar{
        display: -webkit-box;
        font-size: 0.4rem
    }
    .tn-tip-bar .tn-title{
        display: block;
        -webkit-box-flex: 1;
        font-size: 0.4rem
    }
    .tn-tip-bar .tn-label{
        color: #fff;
        display: block;
        height: 0.48rem;
        line-height: 0.48rem;
        padding: 0 0.2rem;
        margin-left: 0.4rem;
        border-top-left-radius: 0.14rem;
        border-top-right-radius: 0.14rem;
        border-bottom-right-radius: 0.14rem;
        font-size: 0.32rem;
        background: #ff9f00
    }
    .tn-tip-bar .tn-label.pass{
        background: #59c574
    }
    .tn-content-box{
        display: -webkit-box;
        padding-top: 0.2rem;
    }
    .tn-content-box .hd-box{
        width: 3.733333rem;
        height: 2.493333rem;
        margin-right: 0.333333rem
    }
    .tn-content-box .hd-box .pic{
        display: table-cell;
        width: 3.733333rem;
        height: 2.493333rem;
        text-align: center;
        vertical-align: middle;
        background: #e7e7e7
    }
    .tn-content-box .hd-box .pic img{
        max-width: 100%;
        max-height: 100%;
        vertical-align: middle;
    }
    .tn-content-box .bd-box{
        height: 2.493333rem;
        position: relative;
        -webkit-box-flex: 1;
    }
    .tn-content-box .bd-box .txt{
        color: #999;
        line-height: 0.48rem;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        font-size: 0.373333rem
    }
    .tn-content-box .bd-box .info{
        width: 100%;
        position: absolute;
        left: 0;
        bottom: 0;
        text-align: right;
    }
    .tn-content-box .bd-box .info .date{
        color: #999;
        display: inline-block;
        font-size: 0.32rem
    }
    .tn-content-box .bd-box .info .edit{
        display: inline-block;
        width: 0.32rem;
        height: 0.32rem;
        vertical-align: middle;
        margin-top: -0.04rem;
        background: url("../images/tn-edit-icon.png") center no-repeat;
        background-size: contain;
    }
    .tn-content-box .bd-box .info .delete{
        display: inline-block;
        width: 0.36rem;
        height: 0.4rem;
        margin-left: 0.4rem;
        margin-top: -0.08rem;
        vertical-align: middle;
        background: url("../images/tn-delete-icon.png") center no-repeat;
        background-size: contain;
    }


    .bottom-box{
        padding: 0.6rem 0;
        text-align: center;
        color: #a9a9ad;
        font-size: 0.426667rem;
    }
    .bottom-box .load-box i{
        display: inline-block;
        vertical-align: middle;
        width: 0.4266667rem;
        height: 0.4266667rem;
        margin:-0.02rem 0.2rem 0 0;
        background: url(../images/onload.gif) no-repeat;
        background-size: contain;
    }

    /* 发布游记 */
    .publish-note-area{
        height: 100%;
        background: #fff;
    }
    .publish-note-fm{
        height:200px;
        position: relative;
        background: #efefef;
    }
    .publish-note-fm img{
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1
    }
    .publish-note-fm:after{
        content: "+添加证书";
        color: #9B8CE5;
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font-size: 0.4rem
    }
    .publish-note-title{
        border-bottom: 1px solid #e5e5e5;
        background: #fff;
        margin-top: 10px;
    }
    .publish-note-title .input-edit{
        width: 85%;
        border: 0;
        line-height: 30px;
        height: 30px;
        margin: 0;
        resize: none;
    }

    .footer-btn-bar{
        margin-top: 20px;
    }
    .footer-btn-bar .btn-v{
        color: #fff;
        display: block;
        height: 1.2rem;
        line-height: 1.2rem;
        text-align: center;
        font-size: 0.426667rem;
        border-radius: 0.6rem;
        background: #9B8CE5;
        width: 50%;
        margin: 0 auto;
        text-decoration-line: none;
    }

    .publish-note-area .article-content {
        padding: 0.4rem;
        top: 0;
        right: 0;
        bottom: 4.16rem;
        left: 0;
        font-size: 0.426667rem;
        height: 323px;
    }
    .publish-note-area .footer-btn {
        color: #9B8CE5;
        padding: 0.4rem;
        position: absolute;
        bottom: 2.8rem;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 0.4rem;
        border-top: 1px solid #e5e5e5;
        border-bottom: 1px solid #e5e5e5;
    }
    .publish-note-area .footer-btn .upload-img {
        display: inline-block;
        width: 0.373333rem;
        height: 0.373333rem;
        vertical-align: middle;
        margin: -0.12rem 0.16rem 0 0;
        background: url(/phone/public/images/upload-img-icon.png) 0 no-repeat;
        background-size: 100%;
    }
    .publish-note-area .placeholader{
        color: #ccc;
        font-size: 0.426667rem
    }
    .input-file{
        position:absolute;
        left:0;
        opacity:0;
        width:100%;
    }
    .publish-notes-link{
        position: absolute;
        top: 0;
        right: 0;
        height: 1.28rem;
        line-height: 1.28rem;
        font-size: 0.40rem;
        padding: 0 0.75em;
        text-align: center;
    }

    .img-box {
        width:100%;
        height:auto;
        padding: 5px;
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        overflow: hidden;
    }
    .img-box img {
        max-width: 100%;
        max-height: 100%;
        vertical-align: middle;
    }
    .hide{
        display:none;
    }
    .publish-note-tools{
        padding: 0 1.6rem;
        border-bottom: 1px solid #e5e5e5;
        background: #fff
    }
    .navs{
        display: none;
        width: 180px;
        margin: 0 auto;
        position: relative;
    }
    .nav {
        width: 40px;
        height: auto;
        padding: 10px 0;
        font-size: 10px;
        background-color: #fff;
        border-bottom: 1px solid #ebeae8;
        list-style: none;
        float: left;
        margin: 10px;
    }
    .input-image-file{
        position: absolute;
        left: 10px;
        top: 20px;
        opacity: 0;
        width: 40px;
        height: 60px;
    }

    #notesContent{
        width: 100%;
        min-height: 300px;
        box-sizing: border-box;
        padding: 1px;
        color: #444;
        margin-bottom: 150px;
    }
    #notesContent p{
        letter-spacing: 0.25px;
        font: 16px/25px Tahoma, Verdana, 宋体;
        margin: 20px 0px;
    }
    #notesContent h4 {
        font-weight: bold;
        line-height: 1.333em;
        margin: 10px 0 20px;
        padding: 25px 0 0;
    }
    #notesContent img{
        width: 100%;
        height: auto;
        box-sizing: border-box;
    }
    .dempTip{
        border-left: 2px solid #00BCD4;
        padding-left: 5px;
        margin: 10px;
        font-size: 16px;
    }
    code{
        white-space: pre-wrap;
        background: #2D2D2D;
        display: block;
        margin: 10px;
        border-radius: 5px;
        color: #fff;
    }
    .upload_content{ width: 100%;height:200px; }
    .webuploader-container
    .webuploader-element-invisible{
        display: none;
    }
    .inputEdit{ width: 100%; min-height: 300px; box-sizing: border-box; padding: 10px; color: #444; }
    #imageUploadContent div[id^="rt_rt_"]{ z-index: 1; }
</style>

<body style="background: #ffffff;">
<form id="note_info">
    <input type="hidden" id="certificate_id" name="certificate_id" value="{$certificate['id']}" />
    <input type="hidden" id="id" name="id" value="{$info['id']}" />
    <input type="hidden" id="image" name="image" value="{$info['image']}" />
    <div class="publish-note-area">
        <div style="padding: 10px;">
        <span>证书名称：{$certificate['title']}</span>
        <br>
        <span>证书描述：{$certificate['desc']}</span>
        <br>
        <span>证书审核：{$info['status_name']}</span>
        </div>
        <div class="publish-note-fm" id="imageUploadContent">
            <div class="upload_content">
                {if $info['image']}
                <img src="{$info['image']}">
                {/if}
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="footer-btn-bar">
        <a href="javascript:;" id="save_notes" class="btn-v">上传</a>
    </div>
</form>

<script>
    $(function() {
        //banner上传实例
        var uploader1 = new WebUploader.Uploader({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: "/phone/public/js/webuploader/Uploader.swf",
            // 文件接收服务端。
            server: '/phone/pub/upload_image?input_name=file',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id: '#imageUploadContent',
                multiple: false
            },
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            //限制只能上传一个文件
            fileNumLimit: 1,
            compress: {
                width: 1600,
                height: 1600,
                // 图片质量。仅仅有type为`image/jpeg`的时候才有效。
                quality: 90,
                // 是否同意放大，假设想要生成小图的时候不失真。此选项应该设置为false.
                allowMagnify: false,
                // 是否同意裁剪。
                crop: false,
                // 是否保留头部meta信息。
                preserveHeaders: true,
                // 假设发现压缩后文件大小比原来还大，则使用原来图片
                // 此属性可能会影响图片自己主动纠正功能
                noCompressIfLarger: false,
                // 单位字节，假设图片大小小于此值。不会採用压缩。(大于2M压缩)
                compressSize: 1024 * 1024 * 2
            }
        });
        // 文件上传过程中创建进度条实时显示。
        uploader1.on('uploadProgress',
            function(file, percentage) {
                layer.open({
                    type: 2
                });
            });
        // 文件上传成功
        uploader1.on('uploadSuccess',
            function(file, data) {
                if (data.success) {
                    $('div.upload_content').html('<img src="' + data.litpic + '"/>');
                    $('#image').val(data.litpic);
                } else {
                    layer.open({
                        content: data.msg,
                        skin: 'msg',
                        time: 2 //2秒后自动关闭
                    });
                }
            });
        // 完成上传完了，成功或者失败，先删除进度条。
        uploader1.on('uploadComplete',
            function(file) {
                layer.closeAll();
            });
        $(".publish-note-fm:after").click(function() {
            $("#imageUploadContent").trigger('click');
        });
        $("#save_notes").unbind('click').bind('click',
            function() {
                var image = $('#image').val();
                if (!image) {
                    layer.open({
                        content: '证书不能为空',
                        skin: 'msg',
                        time: 2 //2秒后自动关闭
                    });
                    return false;
                }
                var certificate_id = $("#certificate_id").val();
                $.ajax({
                    type: 'POST',
                    url: '/phone/leader/certification/ajax_save',
                    data: {
                        "certificate_id": certificate_id,
                        "image": image,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            layer.open({
                                content: data.msg,
                                skin: 'msg',
                                time: 2 //2秒后自动关闭
                            });
                            window.location.href="/phone/leader/certification/list";
                        } else {
                            layer.open({
                                content: data.msg,
                                skin: 'msg',
                                time: 2 //2秒后自动关闭
                            });
                        }
                    }
                });
            });
    });</script>
</body>

</html>