<!DOCTYPE html>
<html>
<head>
    <title>成就</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="/phone/public/css/wechat/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/phone/public/css/wechat/global.min.css?v=565" type="text/css" rel="stylesheet" />
    <link href="/phone/public/css/wechat/datetime.css" type="text/css" rel="stylesheet" />
    <link href="/phone/public/css/wechat/etimeline.css?v=565" type="text/css" rel="stylesheet" />
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?1c003f1016d075a4fbe363dbd46774a2";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

</head>
<body>
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<div class="content" style="padding-top: 10px;">
    <div class="tc">
        <label>完成时间</label>
        <input id="finishTime" name="finishTime" value="{if $info['finish_time']}{date('Y-m-d',$info['finish_time'])}{else}{date('Y-m-d')}{/if}" size="16" type="text" placeholder="请选择一个日期" />
    </div>
    <input type="hidden" name="id" value="{$info['id']}">
    <div class="tc">
        <label>完成内容</label><br />
        <textarea name="description" >{$info['content']}</textarea>
    </div>
    {if $info['id']}
    <input id="delete" type="submit" value="删除" />
    <input id="save" type="submit" value="保存" />
    {else}
    <input style="width: 100%;left: 0; border-radius: 20px;" id="save" type="submit" value="保存" />
    {/if}

</div>
<div id="datePlugin"></div>
<script type="text/javascript" src="/phone/public/js/jquery.min.js" ></script>

<script type="text/javascript" src="/phone/public/js/datetime.js" ></script>
<script type="text/javascript" src="/phone/public/js/datetime_iscroll.js" ></script>
<script type="text/javascript">
    $(function(){
        $('#finishTime').date();
    });
</script>

<script type="text/javascript">

    $("#save").click(function(){
        var finishTime = $("input[name='finishTime']").val();
        var description = $("textarea[name='description']").val();
        var id = $("input[name='id']").val();

        var data = {};
        data.finishTime = finishTime;
        data.description = description;
        data.id = id;

        $.ajax({
            type: "post",
            data: data,
            url: "ajax_save",
            dataType: "json",
            beforeSend: function() {
                //发送请求前loading
                $(".loading").html("保存中...");
                $("#loading").show();
            },
            success: function(response){
                $(".loading").html("");
                $('#loading').hide();
                if (response.status == 1) {
                    alert(response.msg);
                    location.href='/phone/member/achievement/list'
                } else {
                    alert(response.msg);
                }
            }
        });
    });

    $("#delete").click(function(){
        var truthBeTold = window.confirm("单击“确定”继续。单击“取消”停止。");
        if (truthBeTold) {

            var id = $("input[name='id']").val();

            if (typeof(id) == undefined || id == "") {
                return;
            }

            $.ajax({
                type: "post",
                url: "ajax_del",
                data: {
                    id: id,
                },
                beforeSend: function() {
                    //发送请求前loading
                    $(".loading").html("删除中...");
                    $("#loading").show();
                },
                dataType: "json",
                success: function(response) {
                    $(".loading").html("");
                    $('#loading').hide();
                    if (response.status == 1) {
                        alert(response.msg );
                        location.href='/phone/member/achievement/list'
                    } else {
                        alert(response.msg );
                    }
                }
            });
        }
    });
</script>
</body>
</hmtl>
