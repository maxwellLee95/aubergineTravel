<!DOCTYPE html>
<html>
<head>
    <title>成就</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">


    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>

</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<div id="getLoading">
    <div class="get-loading-main">
        <img src="/phone/public/images/wechat/loading2.gif" width="20" height="20">
        <div class="getloading"></div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/event.css?v=565">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/my.css?v=15">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/timeline.css?v=2">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=12">
<style type="text/css">
    .no-content {
        text-align: center;
        padding: 10px;
        color: #c4c4c4;
        padding-top: 10%;
    }
</style>
<div class="content">
    <div id="tab-timeline">
        {if $list}
        <a onclick="_hmt.push(['_trackEvent', 'my', 'click', '个人中心添加成就']);" href="/phone/member/achievement/add">
            <div id="add-timeline">
                <div id="add" class="radius">
                    <span>+</span>
                </div>
                <div style="float:left;color: #808080; line-height: 40px; padding-left: 10px;">
                    <span>添加户外行程</span>
                </div>
            </div>
        </a>
        <ul id='timeline' >
            {loop $list $row}
            <li class='work'>
                <div class='tradio' id='work5' name='works' ></div>
                <div class="relative">
                    <span class='date'>{date('Y-m-d',$row['finish_time'])}</span>
                    <div class="circlebox radius">
                        <span class='tcircle'></span>
                    </div>
                </div>
                <div class='tcontent'>
                    <label for='work5' onclick="window.location.href='/phone/member/achievement/edit?id='+{$row['id']}">{$row['content']}</label>
                </div>
                <div class="clr"></div>
            </li>
            {/loop}
        </ul>
    </div>
    {else}
    <div class="no-content">
        <div>
            <img src="/phone/public/images/wx/v4/list/me-norrecorder.png" width="32%">
        </div>
        <a onclick="_hmt.push(['_trackEvent', 'my', 'click', '个人中心添加成就']);" href="/phone/member/achievement/add">
            <div>
                <div style="clear: both;width: 34px;height: 34px;background: #9B8CE5;border-radius: 50%;display: inline-block;margin: 1px;font-size: 21px;color: #FFFFFF"  class="radius" >
                    <span>+</span>
                </div>
                <div style="clear: both" style="color: #808080; line-height: 40px; padding-left: 10px;">
                    <span>添加户外行程</span>
                </div>
            </div>
            <div class="clear"></div>
        </a>
        <div>
            您没有任务行程记录
        </div>
    </div>
    {/if}
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>



</html>