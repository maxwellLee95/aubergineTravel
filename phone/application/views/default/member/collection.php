<!DOCTYPE html>
<html>
<head>
    <title>浏览记录</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=17">
<style type="text/css">
    .content{
        background-color: #fff;
        padding-bottom: 0;
        margin-bottom: 20px;
    }
    .flex-div{
        display: flex;
        flex-flow: row wrap;
    }
    .activity{
        padding: 10px 0;
        margin: 0 10px;
        border-bottom: 1px solid #ddd;
    }
    a:hover{
        color: #333;
    }
    .activity-img{
        width: 100%;
    }
    .activity-info{
        padding-left: 10px;
        font-size: 12px;
        color: #888;
        display: flex;
        align-items: center;
    }
    .activity-name{
        font-size: 16px;
        color: #333;
    }
    .no-record{
        padding: 10px;
        text-align: center;
        color: #888;
        font-size: 12px;
    }
    .no-record a{
        color: #fff;
        font-size: 14px;
        background-color: #9B8CE5;
        padding: 8px 30px;
        border-radius: 4px;
    }
    .no-data{
        padding: 10px;
    }
    .no-data a{
        color: #9B8CE5;
        font-size: 12px;
    }
    .status{
        font-size: 11px;
        color: #fff;
        display: inline-block;
        padding: 0 5px;
    }
    .status.se{ background-color: rgba(138, 138, 138, 0.9); }
    .status.su{ background-color: rgba(138, 138, 138, 0.9); }
    .status.sf{ background-color: rgba(252, 146, 22, 0.9); }
    .status.ss{ background-color: rgba(72, 203, 132, 0.9); }
    .status.si{ background-color: rgba(193, 76, 251, 0.9); }
    .show-more{
        padding: 10px;
    }
</style>
<div class="content">
    {if 0}
    <div class="activitys">
        <a href="#">
            <div class="activity flex-div">
                <div style="width:25%;">
                    <img src="#" class="activity-img">
                </div>
                <div class="activity-info" style="width:75%;">
                    <div style="width:100%;">
                        <div class="activity-name">【轻贵州·深体验】黄果树瀑布2日</div>
                        <div>领队：草莓</div>
                        <div class="flex-div">
                            <div style="width:50%;">11月03日出发</div>
                            <div class="text-right" style="width:50%;">
                                <div class="status su">已截止</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="no-data text-center" >
        <a href="#">没有更多了，前往首页看看吧</a>
    </div>
    {else}
    <div class="no-data text-center" >
        <a href="javascript::void(0);">暂时无收藏哦</a>
    </div>
    {/if}
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/bootstrap/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=17" ></script>
<script type="text/javascript">
    var page = "1";
    var noData = false;
    var isGetting = false;
    function showMore(){
        isGetting = true;
        page++;
        $.ajax({
            url: '/wechat/my/getpagerecord',
            type: 'POST',
            dataType: 'json',
            data: {
                page: page
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                isGetting = false;
                if( getdata.activitys.length < 10 ){
                    $(".show-more").hide();
                    $(".no-record").show();
                    noData = true;
                }
                if( getdata.activitys.length > 0 ){
                    var addHtml = '';
                    $.each(getdata.activitys, function(index, activity) {
                        addHtml += getActivityHtml( activity );
                    });
                    $(".activitys").append( addHtml );
                }
            })
            .fail(function() {
                console.log("error");
                page--;
            });
    }

    function getActivityHtml( activity ){
        var addHtml = '';
        addHtml += '<a href="' + activity['url'] + '">';
        addHtml +=     '<div class="activity flex-div">';
        addHtml +=         '<div style="width:25%;">';
        addHtml +=             '<img src="' + activity['smallImageUrl'] + '" class="activity-img">';
        addHtml +=         '</div>';
        addHtml +=         '<div class="activity-info" style="width:75%;">';
        addHtml +=             '<div style="width:100%;">';
        addHtml +=                 '<div class="activity-name">' + activity['name'] + '</div>';
        addHtml +=                 '<div>领队：' + activity['leader']['nickname'] + '</div>';
        addHtml +=                 '<div class="flex-div">';
        addHtml +=                     '<div style="width:50%;">' + activity['startDate'] + '出发</div>';
        addHtml +=                     '<div class="text-right" style="width:50%;">';
        addHtml +=                         '<div class="status ' + activity['status']['style'] + '">' + activity['status']['name'] + '</div>';
        addHtml +=                     '</div>';
        addHtml +=                 '</div>';
        addHtml +=             '</div>';
        addHtml +=         '</div>';
        addHtml +=     '</div>';
        addHtml += '</a>';
        return addHtml;
    }

    $(document).ready(function () {
        $(window).scroll(function () {
            var bot = 50;
            if ((bot + $(window).scrollTop()) >= ($(document).height() - $(window).height())) {
                if( !noData && !isGetting ){
                    showMore();
                }
            }
        });
    });
</script>


</html>