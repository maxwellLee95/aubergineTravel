<!DOCTYPE html>
<html>
<head>
    <title>我的游记</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/my_other.css?v=22">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=2">
<style type="text/css">

    .empty_data {
        color: #999;
        text-align: center;
        padding: 40px;
        margin-top: 80px;
    }
    .empty_imgbox {
        height: 110px;
    }
    .empty_data img{
        width: 150px;
    }
    .articlesbox {
        background-color: #F0F0F0;
    }
    .articleBox {
        margin-bottom: 10px;
        background-color: #fff;
        cursor: pointer;
    }
    .article-img {
        background-color: #ddd;
        background-position: center;
        background-size: cover;
        width: 100%;
    }

    .edit-modal.hiding{
        display: none;
        opacity: 0;
    }
    .edit-modal, .edit-modal-bg{
        position: fixed;
        left: 0;
        top: 0;
        z-index: 3000;
        width: 100%;
        height: 100%;
    }
    .edit-modal-bg{
        background-color: rgba(0,0,0,0.5);
    }
    .edit-modal-body{
        position: relative;
        z-index: 3000;
        width: 70%;
        margin-bottom: 20%;
        background-color: #fff;
        border-radius: 4px;
        padding-bottom: 20px;
    }
    .show-edit-btn, .edit-modal-close{
        position: fixed;
        left: 45%;
        bottom: 5px;
        z-index: 3001;
        width: 40px;
        display: inline-block;
    }
    .show-running{
        animation: showRunning 500ms linear forwards;
        -webkit-animation: showRunning 500ms linear forwards;
    }
    .hide-running{
        animation: hideRunning 500ms linear forwards;
        -webkit-animation: hideRunning 500ms linear forwards;
    }
    .opacity-show{
        animation: opacityShow 500ms linear forwards;
        -webkit-animation: opacityShow 500ms linear forwards;
    }
    .opacity-hide{
        animation: opacityHide 500ms linear forwards;
        -webkit-animation: opacityHide 500ms linear forwards;
    }
    @keyframes showRunning
    {
        0% {
            transform:rotate(0);
            -webkit-transform:rotate(0);
        }
        100% {
            transform:rotate(-45deg);
            -webkit-transform:rotate(-45deg);
        }
    }
    @-webkit-keyframes showRunning
    {
        0% {
            transform:rotate(0);
            -webkit-transform:rotate(0);
        }
        100% {
            transform:rotate(-45deg);
            -webkit-transform:rotate(-45deg);
        }
    }
    @keyframes hideRunning
    {
        0% {
            transform:rotate(-45deg);
            -webkit-transform:rotate(-45deg);
        }
        100% {
            transform:rotate(0);
            -webkit-transform:rotate(0);
        }
    }
    @-webkit-keyframes hideRunning
    {
        0% {
            transform:rotate(-45deg);
            -webkit-transform:rotate(-45deg);
        }
        100% {
            transform:rotate(0);
            -webkit-transform:rotate(0);
        }
    }
    @keyframes opacityShow
    {
        0% {
            opacity: 0;
            display: none;
        }
        100% {
            opacity: 1;
            display: -webkit-box; /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
            display: -moz-box; /* 老版本语法: Firefox (buggy) */
            display: -ms-flexbox; /* 混合版本语法: IE 10 */
            display: -webkit-flex; /* 新版本语法: Chrome 21+ */
            display: flex; /* 新版本语法: Opera 12.1, Firefox 22+ */
        }
    }
    @-webkit-keyframes opacityShow
    {
        0% {
            opacity: 0;
            display: none;
        }
        100% {
            opacity: 1;
            display: -webkit-box; /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
            display: -moz-box; /* 老版本语法: Firefox (buggy) */
            display: -ms-flexbox; /* 混合版本语法: IE 10 */
            display: -webkit-flex; /* 新版本语法: Chrome 21+ */
            display: flex; /* 新版本语法: Opera 12.1, Firefox 22+ */
        }
    }
    @keyframes opacityHide
    {
        0% {
            opacity: 1;
            display: -webkit-box; /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
            display: -moz-box; /* 老版本语法: Firefox (buggy) */
            display: -ms-flexbox; /* 混合版本语法: IE 10 */
            display: -webkit-flex; /* 新版本语法: Chrome 21+ */
            display: flex; /* 新版本语法: Opera 12.1, Firefox 22+ */
        }
        100% {
            opacity: 0;
            display: none;
        }
    }
    @-webkit-keyframes opacityHide
    {
        0% {
            opacity: 1;
            display: -webkit-box; /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
            display: -moz-box; /* 老版本语法: Firefox (buggy) */
            display: -ms-flexbox; /* 混合版本语法: IE 10 */
            display: -webkit-flex; /* 新版本语法: Chrome 21+ */
            display: flex; /* 新版本语法: Opera 12.1, Firefox 22+ */
        }
        100% {
            opacity: 0;
            display: none;
        }
    }
    .article {
        padding: 10px;
    }

    .article-img {
        width: 136.32px;
        height: 92.7733px;
        border-radius: 10px;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .article-title {
        font-size: 16px;
    }
    .article-time {
        color: #ccc;
    }
</style>

<div class="content" style="padding-bottom: 0;">
    <div id="tab-articles">
        {if !empty($notes)}
        {loop $notes  $row}
        <div class="article">

            <?php
            $action=$row['type']==1?'edit':'video_edit';?>
            <a href="/phone/notes/{$action}?noteid={$row['id']}">
                <div class="flex-single">
                    <div style="width:40%;">
                        <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'],640,300)?>); "></div>
                    </div>
                    <div style="padding-left:10px;width:60%; position:relative;">
                        <div class="article-title">
                            {$row['title']}
                        </div>
                        {if $row['modtime']}
                        <div class="article-time"><?php echo date('Y-m-d H:i:s',$row['modtime']);?></div>
                        {/if}
                        <div class="article-time">
                            <a class="on" href="javascript::void(0)">{$row['status_name']}</a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {/loop}
        {else}
        <div class="empty_data">
            <div class="empty_imgbox">
                <img src="/phone/public/images/wechat/v4/my/empty_travels.png?v=2" alt="banner">
            </div>
            <div>您还未发表游记</div>
        </div>
        {/if}

    </div>
</div>

<!--<div class="show-edit-btn">-->
<!--    <img src="/phone/public/images/ugc/show.png" width="100%" onclick="showEditModal(this);">-->
<!--</div>-->

<div id="editModal" class="edit-modal flex-center hiding">
    <div class="edit-modal-bg"></div>
    <div class="edit-modal-body">
        <div class="text-center">
            <img src="/phone/public/images/ugc/code4.png" style="width:100%;">
        </div>
    </div>

</div>



</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script type="text/javascript">
    $(function() {
        // var bannerHeight = ($(window).width() - 20) * 0.54;
        // $(".article-img").css("height",bannerHeight+"px");
    });
    $(document).on('click', 'video', function(e) {
        e.stopPropagation();
    });
    $(document).on('click', '.articleBox', function() {
        var url = $(this).data('url');
        if (url) {
            window.location.href = url;
        }
    });
    var page = 2;
    var pageEnd = false;
    var abajax = undefined;
    function checkAndLoadArticles() {
        if (pageEnd) {
            return false;
        }
        var articleBoxs = $('.articleBox');
        if (articleBoxs.length >= 5 && ($(articleBoxs[articleBoxs.length - 2]).offset().top - $(window).scrollTop()) < 700) {
            if (abajax != undefined && abajax['readyState'] != 4) {
                return false;
            }
            abajax = $.ajax({
                url: '#',
                type: 'POST',
                dataType: 'json',
                data: {
                    page: page,
                    targetHikerId: '690587',
                },
            })
                .done(function(ret) {
                    page ++;
                    if (ret.errcode == 0) {
                        var h = '';
                        var datas = ret.errmsg;
                        if (datas.length < 5) {
                            pageEnd = true;
                        }
                        for (var i = 0; i < datas.length; i++) {
                            h += '<div class="articleBox" data-url="' + datas[i]['url'] + '">';
                            h += '    <div class="articleImg">';
                            if (datas[i]['type'] == 2) {
                                h += '        <video controls="controls" preload="auto" src="' + datas[i]['videourl'] + '" class="video-elem" poster="/phone/public/images/wechat/article/video_bg.jpg"></video>';
                            } else {
                                h += '        <div class="article-img" style="background-image: url(' + datas[i]['banner'] + ');"></div>';
                            }
                            h += '    </div>';
                            h += '    <div class="articleTitle">' + datas[i]['title'] + '</div>';
                            h += '    <div class="articleInfo">';
                            h += '        <div class="articleCommand">' + datas[i]['comments'] + '</div>';
                            h += '        <div class="articleLikes">' + datas[i]['likes'] + '</div>';
                            h += '        <div class="articleTime">' + datas[i]['enable_time'] + '</div>';
                            h += '    </div>';
                            h += '</div>';
                        };
                        $('.articlesbox').append(h);
                    }
                })
                .fail(function() {
                });
        }
    }

    var ticking = false;
    function realFunc() {
        checkAndLoadArticles();
        ticking = false;
    }
    var scrolln = 0;
    var lastScrolln = 0;
    function onScroll() {
        if (!ticking) {
            scrolln = $("body").scrollTop();
            requestAnimationFrame(realFunc);
            ticking = true;
        }
    }
    // 滚动事件监听
    window.addEventListener('scroll', onScroll, false);

    function showEditModal( e ){
        //绑定页面不允许滚动
        $('body').bind('touchmove', function (event) {
            event.preventDefault();
        });
        $(".show-edit-btn").removeClass("hide-running");
        $(".show-edit-btn").addClass("show-running");
        $("#editModal").removeClass("hiding");
        $("#editModal").removeClass("opacity-hide");
        $("#editModal").addClass("opacity-show");
        $(e).attr("onclick","hideEditModal(this);");
    }

    function hideEditModal( e ){
        //解除绑定页面不允许滚动
        $('body').unbind('touchmove');
        $(".show-edit-btn").removeClass("show-running");
        $(".show-edit-btn").addClass("hide-running");
        $("#editModal").removeClass("opacity-show");
        $("#editModal").addClass("opacity-hide");
        $(e).attr("onclick","showEditModal(this);");
        setTimeout(function(){
            $("#editModal").addClass("hiding");
        },500)
    }
</script>


</html>