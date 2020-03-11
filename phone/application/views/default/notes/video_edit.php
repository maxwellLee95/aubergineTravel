<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>发布游记</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link type="text/css" href="/phone/public/css/amazeui.css" rel="stylesheet" />
    <link type="text/css" href="/phone/public/css/notes_videos.css" rel="stylesheet" />
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
    #videoUploadContent div[id^="rt_rt_"]{ z-index: 1; }
</style>

<body style="background: #ffffff;">
<form id="note_info">
    <input type="hidden" id="noteid" name="noteid" value="{$info['id']}" />
    <input type="hidden" id="video" name="video" value="{$info['video']}" />
    <input type="hidden" id="litpic" name="litpic" value="{$info['litpic']}" />
    <input type="hidden" id="notes_type" name="notes_type" value="2">

    <input type="hidden" name="frmcode" value="{$frmcode}" />
    <div class="publish-note-area">
        <div class="publish-note-fm" id="videoUploadContent">
            <div class="upload_content">
                {if $info['video']}
                <video controls="controls" src="{$info['video']}"></video>
                {/if}
            </div>
        </div>
        <div class="publish-note-title">
            <img style="height: 20px;margin: 5px;" src="/phone/public/images/wx/v4/list/post_write.png"><textarea class="input-edit"  id="inputEdit" name="title" maxlength="40" placeholder="输入游记标题(40个字以内)">{$info['title']}</textarea>
        </div>
        <div class="publish-note-desc">
            <textarea name="description" placeholder="这里可以输入描述">{$info['description']}</textarea>
        </div>

        <div class="clear"></div>
    </div>
    <div class="footer-btn-bar">
        <a href="javascript:;" id="save_notes" class="btn-v">发布</a>
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
            server: '/phone/notes/ajax_upload_videos?litpic=1',
            pick: $('#videoUploadContent'),
            duplicate: true,
            resize: false,
            accept: {
                title: 'Video',
                extensions: 'mp4',
                mimeTypes: 'video/mp4'
            },
            fileVal: 'video',
            fileNumLimit: 1
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
                if (data.status) {
                    $('div.upload_content').html('<video controls="controls" src="' + data.url + '"/></video>');
                    $('#video').val(data.url);
                    $('#litpic').val(data.litpic);
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
            $("#videoUploadContent").trigger('click');
        });
        $("#save_notes").unbind('click').bind('click',
            function() {
                var _video = $("#video").val();
                if (!_video) {
                    layer.open({
                        content: '请上传视频',
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
                var _description=$("textarea[name=description]").val();
                var _notes_type = $("#notes_type").val();
                var litpic = $("#litpic").val();
                $.ajax({
                    type: 'POST',
                    url: '/phone/notes/ajax_save',
                    data: {
                        "frmcode": frmcode,
                        "noteid": noteid,
                        "title": _title,
                        "description": _description,
                        "video":_video,
                        "notes_type":_notes_type,
                        'cover':litpic
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            layer.open({
                                content: data.msg,
                                skin: 'msg',
                                time: 2 //2秒后自动关闭
                            });
                            window.location.href="/phone/member/article/index";
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