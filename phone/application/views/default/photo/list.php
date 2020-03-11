<!DOCTYPE html>
<html>
<head>
    <title>游记 - 相册</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link rel="stylesheet" type="text/css" href="/phone/public/css/ugc/show_edit.css?v=3">
    <link rel="stylesheet" type="text/css" href="/phone/public/css/nav.css?v=3">
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=13">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=2">
<style type="text/css">
    .no-data{
        font-size: 12px;
        color: #999;
        padding: 10px 0;
        text-align: center;
    }
    .relative{
        position: relative;
    }
    .plr-10{
        padding: 0 10px;
    }
    .inline{
        display: inline-block;
    }

    .item{
        background-color: #fff;
        padding: 10px 0;
        margin-bottom: 10px;
        position: relative;
    }
    .item-name{
        padding: 10px;
        font-size: 16px;
        color: #000;
    }
    .item-name a{
        display: inline-block;
        width: 100%;
        color: #000;
    }
    .item-img-list{
        padding: 0 7px;
    }
    .list-img{
        width: 33.33%;
        min-height: 100px;
        border: 3px solid #fff;
    }
    .list-img.first{
        width: 100%;
    }
    .list-img:last-of-type{
        padding-right: 0;
    }
    .list-img-div{
        width: 100%;
        min-height: 90px;
        background-color: #ddd;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: 5px;
    }
    .item-title{
        width: 50%;
    }
    .item-title span{
        font-size: 12px;
        background-color: #00d7ca;
        color: #fff;
        padding: 0 10px;
    }
    .item-title.video span{
        background-color: #fa7777;
    }
    .item-title.photo span{
        background-color: #ffab0b;
    }
    .item-time{
        color: #999;
    }

    .article{
        background-color: #fff;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        width: 100%;
    }
    .article-img{
        width: 100%;
        min-height: 80px;
        background-color: #ddd;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .article-title{
        padding: 0 10px;
        line-height: 20px;
        height: 40px;
        overflow: hidden;
    }
    .article-title span{
        font-size: 12px;
        line-height: 20px;
        background-color: #fa7777;
        color: #fff;
        padding: 0 4px;
    }
    .article-author{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        padding: 0 10px;
    }
    .article-hiker{
        padding: 0 10px;
        overflow: hidden;
        color: #666;
        font-size: 12px;
    }
    .article-time{
        color: #999;
        font-size: 12px;
    }

    .hiker-desc{
        padding: 0 10px;
    }
    .hiker-desc span{
        color: #9B8CE5;
    }
    .follows-item .hiker-header .hiker-desc ,
    .follows-item .hiker-header .line-name ,
    .follows-item .hiker-header .hiker-stars {
        display: inline-block;
    }
    .follows-item .hiker-header .hiker-stars img{
        vertical-align: middle;
    }
    .header-time {
        font-size: 12px;
        color: #999;
        padding: 0 10px;
    }
    .item-type {
        padding: 0px 10px;
        color: #fff;
        font-size: 12px;
    }
    .bg_purple{
        background-color: #00d7ca;
    }
    .bg_green {
        background-color: #9B8CE5;
    }
    .bg_orange {
        background-color: #ffab0b;
    }
    .bg_orange_deep {
        background-color: #fa7606;
    }
    .bg_red {
        background-color: #fa6b6b;
    }
    .bg_blue {
        background-color: #69c3e8;
    }
    .article-desc{
        font-size: 12px;
        color: #999;
        padding-left: 20px;
    }
    .article-desc > img{
        margin-right: 4px;
    }
    .activity-days {
        padding-left: 12px;
    }
    .article-banner{
        background-color: #ddd;
        background-position: center;
        background-size: cover;
        width: 100%;
        min-height: 160px;
    }
    #pageResult{
        display: none;
        text-align: center;
        font-size: 12px;
        color: #999;
        padding: 10px 0;
    }
    .no-list-data{
        padding: 30% 0;
        color: #999;
        font-size: 12px;
    }
</style>
<style type="text/css" media="screen">
    .new-index-nav {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2000;
        width: 100%;
        border-top: 1px solid #e7e7e7;
        background-color: #fff;
        font-size: 12px;
    }

    .new-index-nav > a {
        width: 20%;
        height: 50px;
        line-height: 20px;
        text-align: center;
        line-height: 12px;
    }

    .new-index-nav > a.checked {
        color: rgba(163,148,243, 0.9);
    }

    .tab-notice {
        position: fixed;
        left: 40%;
        bottom: 0;
        z-index: 3000;
        width: 20%;
        opacity: 0;
    }

    .show-tab-notice {
        animation: showTabNotice 500ms linear forwards;
        -webkit-animation: showTabNotice 500ms linear forwards;
    }

    @keyframes showTabNotice {
        0% {
            bottom: 0px;
            opacity: 0;
        }
        100% {
            bottom: 48px;
            opacity: 1;
        }
    }

    @-webkit-keyframes showTabNotice {
        0% {
            bottom: 0px;
            opacity: 0;
        }
        100% {
            bottom: 48px;
            opacity: 1;
        }
    }
</style>
<style type="text/css">
    .index-nav a {
        position: relative;
    }

    .red-point {
        position: absolute;
        right: 30%;
        top: 5px;
        width: 6px;
        height: 6px;
        background-color: red;
        border-radius: 50%;
    }
</style>
<div class="content">

    <div class="list" id="list">
        {loop $photo $row}
        <div class="item news-item" style="paddig:7px 0;">
            <a href="{$row['url']}">
                <div class="item-name" style="padding:0 10px 5px 10px;"> {$row['title']}</div>
                <div class="item-img-list flex-div">
                    {loop $row['imgs'] $v}
                    <div class="list-img" data-type="1">
                        <div class="list-img-div" style="background-image: url({$v});"></div>
                    </div>
                    {/loop}
                </div>
                <div class="flex-start flex-single plr-10">
                    <div class="item-time">更新于{$row['date']}</div>
                </div>
            </a>
        </div>
        {/loop}
    </div>
    <div id="pageLoading" class="flex-center" style="padding:10px 0;">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
    </div>
    <div id="pageResult"></div>
    {request "pub/notes_modal"}

    <div class="back-top" onclick="backTop();" style="display: none;">
        <img src="/phone/public/images/wechat/v4/back_top.png" style="height:40px;">
    </div>
    {request "pub/code"}
    {request "pub/footer"}

</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>
<script type="text/javascript" src="/phone/public/js/ugc/show_edit.js?v=2"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=18" ></script>
<script type="text/javascript">

    function updateItemImg(){
        var width = ( $(window).width() - 20 ) * 0.384;
        var height = width * 196 / 288;
        $(".article-img").each(function(index, el) {
            $(this).css({
                "width": width+"px",
                "height": height+"px"
            });
        });
    }

    function updateListImg(){
        $(".list-img").each(function(index, el) {
            var type = $(this).data("type");
            var classArr = $(this).attr("class").split(" ");
            if( $.inArray("first", classArr) != -1 && type == 2 ){
                var width = $(window).width() - 20;
                var height = width * 336 / 710;
            }else{
                var width = ( $(window).width() - 20 - 12 ) / 3;
                var height = width * 230 / 230;
            }
            $(this).find(".list-img-div").css({
                "width": width+"px",
                "height": height+"px"
            });
        });
    }

    var articleBannerHeight = ($(window).width() - 20) * 0.54;
    function updateArticleBanner(){
        $(".article-banner").css("height",articleBannerHeight+"px");
    }

    updateItemImg();
    updateListImg();
    updateArticleBanner();

    var page = 1;
    var isPageGetting = false;
    var pageEnd = false;
    $(document).ready(function() {
        $(window).scroll(function(){
            var height = $(".content").height();
            //提前一屏加载分页
            if( $(window).scrollTop() + $(window).height() >= height - $(window).height() ){
                if( isPageGetting || pageEnd ){
                    return false;
                }
                isPageGetting = true;
                page++;
                $.ajax({
                    url: '/phone/photo/ajax_get_list',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        t: "1",
                        page: page,
                        wxoid: ""
                    },
                })
                    .done(function(getdata) {
                        console.log(getdata);
                        isPageGetting = false;
                        if( getdata.status == 1 ){
                            if( getdata.datas.items == undefined ){
                                getdata.datas.items = [];
                            }
                            $.each(getdata.datas.items, function(index, item) {
                                setArticle( item );
                            });
                            updateItemImg();
                            updateListImg();
                            updateArticleBanner();
                            if( getdata.datas.items.length < 10 ){
                                pageEnd = true;
                                $("#pageLoading").hide();
                                $("#pageResult").show();
                                $("#pageResult").html("没有更多数据了");
                            }
                        }else{
                            $("#pageLoading").hide();
                            $("#pageResult").show();
                            $("#pageResult").html("无法获取数据");
                        }
                    })
                    .fail(function() {
                        isPageGetting = false;
                        $("#pageLoading").hide();
                        $("#pageResult").show();
                        $("#pageResult").html("无法获取数据");
                    });
            }
        });
    });

    var t = 1;
    var maxComment = 120; //裁剪字数
    function setArticle( data ){
        var addHtml = '';
        switch( t ){
            case 1:
                addHtml += '<div class="item news-item" style="paddig:7px 0;">';
                addHtml +=     '<a href="'+ data['url'] +'">';
                addHtml +=     '<div class="item-name" style="padding:0 10px 5px 10px;">'+ data['title'] +'</div>';
                addHtml +=     '<div class="item-img-list flex-div">';
                $.each(data['imgs'], function(index, img) {
                    if( index > 2 ){
                        return false;
                    }
                    addHtml +=     '<div class="list-img" data-type="1">';
                    addHtml +=         '<div class="list-img-div" style="background-image:url('+ img +');"></div>';
                    addHtml +=     '</div>';
                });
                addHtml +=     '</div>';
                addHtml +=     '<div class="flex-start flex-single plr-10">';
                addHtml +=         '<div class="item-time">更新于'+ data['date'] +'</div>';
                addHtml +=     '</div>';
                addHtml +=     '</a>';
                addHtml += '</div>';
                break;
            case 2:
                addHtml += '<div class="article">';
                addHtml +=     '<a href="'+ data['url'] +'">';
                addHtml +=     '<div class="flex-single">';
                addHtml +=         '<div style="width:38.4%;">';
                addHtml +=             '<div class="article-img flex-center" style="background-image:url(/images/wechat/article/video_bg.jpg);">';
                addHtml +=                 '<img src="/phone/public/images/ugc/video.png" style="height:25px;min-height:25px;">';
                addHtml +=             '</div>';
                addHtml +=         '</div>';
                addHtml +=         '<div style="width:61.6%; position:relative;">';
                addHtml +=             '<div class="article-title">'+ data['title'] +'</div>';
                addHtml +=             '<div class="article-author flex-div items-end">';
                addHtml +=                 '<div class="flex-single">';
                addHtml +=                     '<img class="img-circle" src="'+ data['hiker']['headImgUrl'] +'" style="width:35px; height:35px;">';
                addHtml +=                     '<div class="flex-center article-hiker">'+ data['hiker']['nickname'] +'</div>';
                addHtml +=                 '</div>';
                addHtml +=             '</div>';
                addHtml +=         '</div>';
                addHtml +=     '</div>';
                addHtml +=     '</a>';
                addHtml +=     '<div class="flex-single" style="padding-top:5px;">';
                addHtml +=         '<div style="width:50%;">';
                addHtml +=             '<div class="article-time">'+ data['date'] +'</div>';
                addHtml +=         '</div>';
                addHtml +=         '<div class="flex-end" style="width:50%; color:#999; font-size:12px;">';
                addHtml +=             '<div class="flex-center">';
                addHtml +=                 '<img src="/phone/public/images/ugc/comment.png" style="height:14px;">';
                addHtml +=                 '<div style="padding-left:5px;">'+ data['comments'] +'</div>';
                addHtml +=             '</div>';
                addHtml +=             '<div class="flex-center" style="padding-left:10px;" '+ ( data['is_likes'] ? '' : 'onclick="like(this, event)"' ) +' data-id="'+ data['bussiness_id'] +'">';
                addHtml +=                 '<img src="/phone/public/images/wechat/article/'+ ( data['is_likes'] ? 'good2_g' : 'good2' ) +'.png" style="height:14px;">';
                addHtml +=                 '<div style="padding-left:5px;">'+ data['likes'] +'</div>';
                addHtml +=             '</div>';
                addHtml +=         '</div>';
                addHtml +=     '</div>';
                addHtml += '</div>';
                break;
            case 3:
                addHtml += '<div class="item follows-item">';
                switch( parseInt( data['type'] ) ){
                    case 1:
                        addHtml +=     '<a href="'+ data['url'] +'">';
                        addHtml +=     '<div class="flex-start flex-single plr-10">';
                        addHtml +=         '<div class="hiker-img">';
                        addHtml +=             '<img data-url="' + data['hikerurl'] + '" class="img-circle gotoHikerCenter" src="'+ data['hiker']['headImgUrl'] +'" style="width:30px; height:30px;">';
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="hiker-header">';
                        addHtml +=         '    <div class="hiker-desc">';
                        addHtml +=                  data['hiker']['nickname'];
                        if( data['line'] ){
                            addHtml +=         '    在 <span class="line-name">'+ data['line']['name'] +'</span>';
                        }
                        addHtml +=             '    发布了新的游记';
                        addHtml +=         '    </div>';
                        addHtml +=         '    <div class="header-time">'+ data['date'] +'</div>';
                        addHtml +=     '    </div>';
                        addHtml +=     '</div>';
                        addHtml +=     '<div class="item-name">'+ data['title'] +'</div>';
                        addHtml +=     '<div class="item-content plr-10">';
                        addHtml +=         '<div class="item-article">';
                        addHtml +=             '<div class="item-img">';
                        addHtml +=                 '<div class="article-banner" style="background-image:url('+ data['img'] +');"></div>';
                        addHtml +=             '</div>';
                        addHtml +=             '<div class="flex-div justify-between items-center" style="padding-top:10px;">';
                        addHtml +=                 '<div class="item-type bg_purple flex-start">游记</div>';
                        addHtml +=                 '<div>';
                        addHtml +=                     '<div class="article-desc inline">';
                        addHtml +=                         '<img src="/phone/public/images/ugc/comment.png" style="height:14px;"> '+ data['comments'];
                        addHtml +=                     '</div>';
                        if (data['is_likes']) {
                            addHtml +=                         '<div class="article-desc inline">';
                            addHtml +=                             '<img src="/phone/public/images/wechat/article/good2_g.png" style="height:14px;"> '+ data['likes'];
                            addHtml +=                         '</div>'
                        } else {
                            addHtml +=                         '<div class="article-desc inline" onclick="like(this, event)" data-id="' + data['bussiness_id'] + '">';
                            addHtml +=                             '<img src="/phone/public/images/wechat/article/good2.png" style="height:14px;"> '+ data['likes'];
                            addHtml +=                         '</div>';
                        }
                        addHtml +=                 '</div>';
                        addHtml +=             '</div>';
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        addHtml +=     '</a>';
                        break;
                    case 2:
                    case 3:
                        addHtml +=     '<a href="'+ data['url'] +'">';
                        addHtml +=     '<div class="flex-start flex-single plr-10">';
                        addHtml +=         '<div class="hiker-img">';
                        addHtml +=             '<img data-url="' + data['hikerurl'] + '" class="img-circle gotoHikerCenter" src="'+ data['hiker']['headImgUrl'] +'" style="width:30px; height:30px;">';
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="hiker-header">';
                        addHtml +=         '    <div class="hiker-desc">'+ data['hiker']['nickname'];
                        if( data['line'] ){
                            addHtml +=     '        在 <span class="line-name">'+ data['line']['name'] +'</span>';
                        }
                        addHtml +=         '        新上传了'+ data['imgs'].length +'张照片</div>';
                        addHtml +=     '        <div class="header-time">'+ data['date'] +'</div>';
                        addHtml +=     '    </div>';
                        addHtml +=     '</div>';
                        addHtml +=     '<div class="item-name">'+ data['title'] +'</div>';
                        addHtml +=     '<div class="item-content">';
                        addHtml +=         '<div class="item-img-list flex-div">';
                        $.each(data['imgs'], function(index, img) {
                            if( index > 2 ){
                                return false;
                            }
                            addHtml +=         '<div class="list-img '+ ( data['imgs'].lenght == 1 ? 'first' : '' ) +'" data-type="3">';
                            addHtml +=             '<div class="list-img-div" style="background-image:url('+ img +');"></div>';
                            addHtml +=         '</div>';
                        });
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="flex-div justify-between items-center plr-10" style="padding-top:10px;">';
                        addHtml +=         '    <div class="item-type bg_orange" style="text-align:left;">相册</div>';
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        addHtml +=     '</a>';
                        break;
                    case 4:
                        addHtml +=     '<a href="'+ data['url'] +'">';
                        addHtml +=     '<div class="flex-start flex-single plr-10">';
                        addHtml +=         '<div class="hiker-img">';
                        addHtml +=             '<img data-url="' + data['hikerurl'] + '" class="img-circle gotoHikerCenter" src="'+ data['hiker']['headImgUrl'] +'" style="width:30px; height:30px;">';
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="hiker-header">';
                        addHtml +=         '    <div class="hiker-desc">';
                        addHtml +=                  '<span>领队 </span>' + data['hiker']['nickname'];
                        if( data['line'] ){
                            addHtml +=         '    在 <span class="line-name">'+ data['line']['name'] +'</span>';
                        }
                        addHtml +=             '    发布了新的活动';
                        addHtml +=         '    </div>';
                        addHtml +=         '    <div class="header-time">'+ data['date'] +'</div>';
                        addHtml +=     '    </div>';
                        addHtml +=     '</div>';
                        addHtml +=     '<div class="item-name">'+ data['title'] +'</div>';
                        addHtml +=     '<div class="item-content plr-10">';
                        addHtml +=         '<div class="item-article">';
                        addHtml +=             '<div class="item-img">';
                        addHtml +=                 '<img src="'+ data['img'] +'" style="width:100%;">';
                        addHtml +=             '</div>';
                        addHtml +=             '<div class="flex-div justify-between items-center" style="padding-top:10px;">';
                        addHtml +=                 '<div class="item-type bg_red flex-start">活动</div>';
                        addHtml +=                 '<div>';
                        addHtml +=                     '<div class="article-desc inline">';
                        addHtml +=                         data['startDate'] + '出发 <span class="activity-days">' + data['days'] + '天</span>';
                        addHtml +=                     '</div>';
                        addHtml +=                 '</div>';
                        addHtml +=             '</div>';
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        addHtml +=     '</a>';
                        break;
                    case 5:
                        addHtml +=     '<div class="flex-start flex-single plr-10">';
                        addHtml +=         '<div class="hiker-img">';
                        addHtml +=             '<img data-url="' + data['hikerurl'] + '" class="img-circle gotoHikerCenter" src="'+ data['hiker']['headImgUrl'] +'" style="width:30px; height:30px;">';
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="hiker-header">';
                        addHtml +=         '    <div class="hiker-desc">来自'+ data['hiker']['nickname'] +'的评论</div>';
                        addHtml +=         '    <div class="hiker-stars">';
                        for( var i=0; i<data['score']; i++ ){
                            addHtml +=             '<img src="/phone/public/images/ugc/star.png" style="height:14px;">';
                        }
                        addHtml +=         '    </div>';
                        addHtml +=     '        <div class="header-time">'+ data['date'] +'</div>';
                        addHtml +=     '    </div>';

                        addHtml +=     '</div>';
                        addHtml +=     '<div class="item-name"><a href="' + data['activityurl'] + '">'+ data['activity']['name'] +'</a></div>';
                        if( data['comment'].length > maxComment ){
                            addHtml +=     '<div class="item-content plr-10 showAllCommentDiv">';
                            addHtml +=         data['comment'].substring(0,maxComment);
                            addHtml +=         '......<a class="show-all" onclick="showAllComment(this);" data-comment="'+ data['comment'] +'">查看全文</a>';
                        }else{
                            addHtml +=     '<div class="item-content plr-10">';
                            addHtml +=         '<a href="'+ data['url'] +'">'+ data['comment'] +'</a>';
                        }
                        addHtml +=         '<div class="flex-div justify-between items-center" style="padding-top:10px;">';
                        addHtml +=         '    <div class="item-type bg_orange_deep" style="text-align:left;">评论</div>';
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        break;
                    case 6:
                        addHtml +=     '<a href="'+ data['url'] +'">';
                        addHtml +=     '<div class="flex-start flex-single plr-10">';
                        addHtml +=         '<div class="hiker-img">';
                        addHtml +=             '<img data-url="' + data['hikerurl'] + '" class="img-circle gotoHikerCenter" src="'+ data['hiker']['headImgUrl'] +'" style="width:30px; height:30px;">';
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="hiker-header">';
                        addHtml +=         '    <div class="hiker-desc">';
                        addHtml +=                  data['hiker']['nickname'];
                        if( data['line'] ){
                            addHtml +=         '    在 <span class="line-name">'+ data['line']['name'] +'</span>';
                        }
                        addHtml +=             '    发布新的视频';
                        addHtml +=         '    </div>';
                        addHtml +=         '    <div class="header-time">'+ data['date'] +'</div>';
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        addHtml +=     '</a>';
                        addHtml +=     '<div class="item-name">'+ data['title'] +'</div>';
                        addHtml +=     '<div class="item-content plr-10">';
                        addHtml +=         '<div class="item-article">';
                        addHtml +=             '<div class="item-img relative">';
                        addHtml +=                 '<div class="article-banner flex-center" style="background-image: url(/images/wechat/article/video_bg.jpg);">';
                        addHtml +=                     '<img src="/phone/public/images/ugc/video.png" style="height:25px;min-height:25px;">';
                        addHtml +=                 '</div>';
                        addHtml +=             '</div>';
                        addHtml +=             '<a href="'+ data['url'] +'">';
                        addHtml +=                 '<div class="flex-div justify-between items-center" style="padding-top:10px;">';
                        addHtml +=                     '<div class="item-type bg_blue flex-start">视频</div>';
                        addHtml +=                     '<div>';
                        addHtml +=                         '<div class="article-desc inline">';
                        addHtml +=                             '<img src="/phone/public/images/ugc/comment.png" style="height:14px;"> '+ data['comments'];
                        addHtml +=                         '</div>';
                        if (data['is_likes']) {
                            addHtml +=                         '<div class="article-desc inline">';
                            addHtml +=                             '<img src="/phone/public/images/wechat/article/good2_g.png" style="height:14px;"> '+ data['likes'];
                            addHtml +=                         '</div>'
                        } else {
                            addHtml +=                         '<div class="article-desc inline" onclick="like(this, event)" data-id="' + data['bussiness_id'] + '">';
                            addHtml +=                             '<img src="/phone/public/images/wechat/article/good2.png" style="height:14px;"> '+ data['likes'];
                            addHtml +=                         '</div>';
                        }
                        addHtml +=                     '</div>';
                        addHtml +=                 '</div>';
                        addHtml +=             '</a>';
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        break;
                    default:
                        break;
                }
                addHtml += '</div>';
                break;
            default:
                break;
        }
        $("#list").append( addHtml );
    }

    function like(e, event){
        event.preventDefault();
        event.stopPropagation();
        var article_id = $(e).data('id');
        $.ajax({
            url: '/wechat/article/likearticle',
            type: 'POST',
            dataType: 'json',
            data: {
                article_id: article_id,
                wxoid: ""
            },
        })
            .done(function(getdata) {
                $("#loading").hide();
                if( getdata.status == 1 ){
                    $(e).removeAttr('onclick');
                    var t = parseInt($(e).text());
                    $(e).html('<img src="/phone/public/images/wechat/article/good2_g.png" style="height:14px;"> ' + (t + 1));
                }else{
                    popLayer(
                        {
                            title: '温馨提示',
                            btnsName: '确定',
                            btnsCallback: 'closePopLayer()',
                            content: '<div class="text-center">操作失败，请稍候再试！</div>',
                        }
                    );
                }
            })
            .fail(function() {
                $("#loading").hide();
                popLayer(
                    {
                        title: '温馨提示',
                        btnsName: '确定',
                        btnsCallback: 'closePopLayer()',
                        content: '<div class="text-center">请求失败，请稍候再试！</div>',
                    }
                );
            });
    }

</script>


</html>