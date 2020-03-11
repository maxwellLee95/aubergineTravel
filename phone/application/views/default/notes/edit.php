<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>发布游记</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link type="text/css" href="/phone/public/css/note.css" rel="stylesheet" />
    <script type="text/javascript" src="/phone/public/js/lib-flexible.js"></script>
    <script type="text/javascript" src="/phone/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/template.js"></script>
    <script type="text/javascript" src="/phone/public/js/layer/layer.m.js"></script>
    <script type="text/javascript" src="/phone/public/js/artEditor.js"></script>
    <script type="text/javascript" src="/phone/public/js/eleditor/Eleditor.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/webuploader/webuploader.min.js"></script>
</head>
<style>

    .upload_content{ width: 100%;height:200px; }
    .webuploader-container
    .webuploader-element-invisible{
        display: none;
    }
    .inputEdit{ width: 100%; min-height: 300px; box-sizing: border-box; padding: 10px; color: #444; }
    #imageUploadContent div[id^="rt_rt_"]{ z-index: 1; }
    #audioUploadContent div[id^="rt_rt_"]{ z-index: 1; }
    .upload_audio_content{ width: 100%;height:40px; }
    .upload_audio_content span{
        z-index: 1;
        display: block;
        line-height: 40px;
        text-align: center;
        position: relative;
        height: 40px;
        border-radius: 10px;
        background: #efefef;
    }
    .publish-audio-fm{
        margin-top: 10px;
        position: relative;
        background: #efefef;
        /* width: 90%; */
        border-radius: 10px;
        height: 40px;
    }
    .publish-audio-fm audio{
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1
    }
    .publish-audio-fm:after{
        content: '点此添加背景音乐';
        /*background: url("/phone/public/images/wx/v4/list/icon_write_default.png");*/
        color: #9B8CE5;
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font-size: 0.4rem
    }
</style>

<body style="background: #ffffff;">
<form id="note_info">
    <input type="hidden" id="banner" name="banner" value="{$info['litpic']}" />
    <input type="hidden" id="noteid" name="noteid" value="{$info['id']}" />
    <input type="hidden" id="music" name="music" value="{$info['music']}" />
    <input type="hidden" id="notes_type" name="notes_type" value="1">
    <input type="hidden" id="submit_type" value="0">
    <input type="hidden" name="frmcode" value="{$frmcode}" />
    <div class="publish-note-area">
        <div class="publish-note-fm" id="imageUploadContent">
            <div class="upload_content">
                {if $info['litpic']}
                <img src="{$info['litpic']}">
                {/if}
            </div>
        </div>
        <div class="publish-note-title">
            <img style="height: 20px;margin: 5px;" src="/phone/public/images/wx/v4/list/post_write.png"><textarea class="input-edit"  id="inputEdit" name="title" maxlength="40" placeholder="输入游记标题(40个字以内)">{$info['title']}</textarea>
        </div>
        <div  class="publish-audio-fm" id="audioUploadContent">
            <div class="upload_audio_content">
                {if $info['music']}
                <span>
                    已上传
                </span>
                {/if}
            </div>
        </div>
        <div id="target" style="display: none" >{$info['content']} </div>
        <div class="article-content" id="notesContent">
        </div>
        <div class="clear"></div>
    </div>
    <div class="footer-btn-bar">
        <a style="width: 30%;background: #c3c3c3;float: left;" href="javascript:;" id="save_notes" class="btn-v">保存</a>
        <a style="width: 60%;float: right;" href="javascript:;" id="submit_notes" class="btn-v">发布</a>
        <div style="clear: both"></div>
    </div>
</form>
<!-- 发布游记 -->
<script>var is_editing = false;
    $(function() {
        //banner上传实例
        var uploader1 = new WebUploader.Uploader({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: "/phone/public/js/webuploader/Uploader.swf",
            // 文件接收服务端。
            server: '/phone/notes/ajax_upload_img',
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
                var $imgBanner = $('#banner');
                if (data.status) {
                    $('div.upload_content').html('<img src="' + data.cover + '"/>');
                    $imgBanner.val(data.litpic);
                    is_editing = true;
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
        $("#inputEdit").change(function() {
            is_editing = true;
        });
        $('#notesContent').change(function() {
            is_editing = true;
        });
        if ($("#noteid").val()) {
            is_editing = true;
        }
        $("a.back_my_notes").unbind('click').bind('click',
            function() {
                var url = $(this).data('href');
                if (is_editing) {
                    layer.open({
                        content: '要放弃本次编辑吗？',
                        btn: ['放弃', '继续'],
                        yes: function(index) {
                            window.location.href = url;
                        }
                    })
                } else {
                    window.location.href = url;
                }
            });
        $(".publish-note-fm:after").click(function() {
            $("#imageUploadContent").trigger('click');
        });
        $("#submit_notes").unbind('click').bind('click',
            function() {
                $("#submit_type").val(0);
                form_save();
            });
        $("#save_notes").unbind('click').bind('click',
            function() {
                $("#submit_type").val(1);
                form_save();
            });


        function form_save(){
            var _content = artEditor.getContent();
            if (!_content) {
                layer.open({
                    content: '内容不能为空',
                    skin: 'msg',
                    time: 2 //2秒后自动关闭
                });
                return false;
            }
            var _banner = $("[name=banner]").val();
            if (!_banner) {
                layer.open({
                    content: '封面图片未设置',
                    skin: 'msg',
                    time: 2 //2秒后自动关闭
                });
                return false;
            }
            var _title = $("[name=title]").val();
            if (!$.trim(_title)) {
                layer.open({
                    content: '标题不能为空',
                    skin: 'msg',
                    time: 2 //2秒后自动关闭
                });
                return false;
            }
            var noteid = $("#noteid").val();
            var frmcode = $("input[name=frmcode]").val();
            var _notes_type = $("#notes_type").val();
            var submit_type = $("#submit_type").val();
            var music = $("#music").val();
            $.ajax({
                type: 'POST',
                url: '/phone/notes/ajax_save',
                data: {
                    "frmcode": frmcode,
                    "noteid": noteid,
                    "cover": _banner,
                    "title": _title,
                    "content": _content,
                    'notes_type':_notes_type,
                    'submit_type':submit_type,
                    'music':music
                },
                dataType: 'json',
                success: function(data) {
                    layer.open({
                        content: data.msg,
                        skin: 'msg',
                        time: 2 //2秒后自动关闭
                    });
                    window.location.href="/phone/member/article/index";
                }
            });
        }
        var artEditor  = new Eleditor({
            el: '#notesContent',
            upload:{
                server: '/phone/notes/ajax_upload_img',
                fileSizeLimit:5,
                formName:'file',
                accept: {//accept一般不用设置
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png,webp',
                    mimeTypes: 'image/gif,image/jpg,image/jpeg,image/bmp,image/png,image/webp'
                }
            },
            /*初始化完成钩子*/
            mounted: function(){

                /*以下是扩展插入视频的演示*/
                var _videoUploader = WebUploader.create({
                    auto: true,
                    server: '/phone/notes/ajax_upload_videos',
                    /*按钮类就是[Eleditor-你的自定义按钮id]*/
                    pick: $('.Eleditor-insertVideo'),
                    duplicate: true,
                    resize: false,
                    accept: {
                        title: 'Images',
                        extensions: 'mp4',
                        mimeTypes: 'video/mp4'
                    },
                    fileVal: 'video',
                });
                _videoUploader.on( 'uploadSuccess', function( _file, _call ) {

                    if( _call.status == 0 ){
                        return window.alert(_call.msg);
                    }

                    /*保存状态，以便撤销*/
                    artEditor.saveState();
                    var html=`<div class='Eleditor-video-area'><video src="${_call.url}" controls="controls"></video></div>`
                    artEditor.getEditNode().after(html);
                    artEditor.hideEditorControllerLayer();
                });
            },
            changer: function(){
                console.log('文档修改');
            },
            /*自定义按钮的例子*/
            toolbars: [
                'insertText',
                'editText',
                'insertImage',
                'insertLink',
                'insertHr',
                'delete',
                // //自定义一个视频按钮
                // {
                //     id: 'insertVideo',
                //     // tag: 'p,img', //指定P标签操作，可不填
                //     name: '插入视频',
                //     handle: function(select, controll){//回调返回选择的dom对象和控制按钮对象
                //
                //         /*因为上传要提前绑定按钮到webuploader，所以这里不做上传逻辑，写在mounted*/
                //
                //         /*!!!!!!返回false编辑面板不会关掉*/
                //         return false;
                //     }
                // },
                'undo',
                'cancel'
            ]
        });
        if($("#noteid").val()){
            artEditor.append($("#target").html());
            $("#target").html('');
        }



        var audioUploader = new WebUploader.Uploader({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: "/phone/public/js/webuploader/Uploader.swf",
            // 文件接收服务端。
            server: '/phone/notes/ajax_upload_audio',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id: '#audioUploadContent',
                multiple: false
            },
            duplicate: true,
            resize: false,
            accept: {
                title: 'Music',
                extensions: 'mp3',
                mimeTypes: 'audio/mp3'
            },
            fileVal: 'audio',
            //限制只能上传一个文件
            fileNumLimit: 1
        });
        // 文件上传过程中创建进度条实时显示。
        audioUploader.on('uploadProgress',
            function(file, percentage) {
                layer.open({
                    type: 2
                });
            });
        // 文件上传成功
        audioUploader.on('uploadSuccess',
            function(file, data) {
                if (data.status) {
                    $('div.upload_audio_content').html('<span>已添加</span>');
                    $('#music').val(data.url);
                } else {
                    layer.open({
                        content: data.msg,
                        skin: 'msg',
                        time: 2 //2秒后自动关闭
                    });
                }
            });
        // 完成上传完了，成功或者失败，先删除进度条。
        audioUploader.on('uploadComplete',
            function(file) {
                layer.closeAll();
            });
    });</script>
</body>

</html>