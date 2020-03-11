<!DOCTYPE html>
<html>
<head>
    <title>游记</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=18"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/index.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>
    <style type="text/css" media="screen">
        .new-index-nav{
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
        .new-index-nav > a{
            width: 20%;
            height: 50px;
            line-height: 20px;
            text-align: center;
            line-height: 12px;
        }

        .new-index-nav > a.checked {
            color: rgba(163,148,243, 0.9);
        }
        .tab-notice{
            position: fixed;
            left: 40%;
            bottom: 0;
            z-index: 3000;
            width: 20%;
            opacity: 0;
        }
        .show-tab-notice{
            animation: showTabNotice 500ms linear forwards;
            -webkit-animation: showTabNotice 500ms linear forwards;
        }
        @keyframes showTabNotice
        {
            0% {
                bottom: 0px;
                opacity: 0;
            }
            100% {
                bottom: 48px;
                opacity: 1;
            }
        }
        @-webkit-keyframes showTabNotice
        {
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
        .index-nav a{
            position: relative;
        }
        .red-point{
            position: absolute;
            right: 30%;
            top: 5px;
            width: 6px;
            height: 6px;
            background-color: red;
            border-radius: 50%;
        }
    </style>
</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>

<link rel="stylesheet" type="text/css" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=13">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=2">

<style type="text/css">
    .content{
        padding-bottom: 50px;
    }
    .banner-img{
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        width: 100%;
        height: 120px;
    }
    .swiper-container-horizontal > .swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{
        bottom: 5px;
    }
    .swiper-pagination-bullet-active{
        background-color: #37c87b;
    }
    .article-name, .column-name{
        font-size: 16px;
        padding-bottom: 5px;
    }
    .column-name{
        background: -webkit-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.8));
        background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.8));
        padding: 15px 10px;
        color: #fff;
        width: 100%;
    }
    .nav{
        width: 25%;
        height: auto;
        margin: 0;
        padding: 10px 0;
        font-size: 12px;
    }
    .article-img{
        width: 100%;
        min-height: 80px;
        background-color: #ddd;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .list{
        padding-top: 10px;
    }
    .article{
        background-color: #fff;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        width: 100%;
    }
    .article-title{
        padding: 0 10px;
        line-height: 22px;
        height: 44px;
        overflow: hidden;
        font-size: 16px;
    }
    .title-icon{
        font-size: 12px;
        line-height: 18px;
        background-color: #fa7777;
        color: #fff;
        margin: 2px 0;
        padding: 0 4px;
        display: inline-block;
    }
    .article-author{
        padding: 10px;
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
        padding: 5px 0px 0px 10px
    }
    #pageResult{
        display: none;
        text-align: center;
        font-size: 12px;
        color: #999;
        padding: 10px 0;
    }
    .back-top{
        position: fixed;
        right: 10px;
        bottom: 60px;
        z-index: 1000;
        display: none;
    }

    .pk-main{
        background-color: #FFD600;
        margin-top: 10px;
    }
    .pk-body{
        position: relative;
        max-width: 520px;
        margin: 0 auto;
    }
    .pk-hiker{
        padding: 10px 15px;
    }
    .pk-top{
        padding-top: 20px;
    }
    .main-bg{
        position: relative;
        z-index: 2;
    }
    .pk-img{
        width: 42%;
        padding: 0 5px;
        position: absolute;
        top: 4%;
        z-index: 1;
    }
    .pk-img.left{
        left: 9%;
    }
    .pk-img.right{
        right: 8%;
    }
    .main-img{
        width: 100%;
        min-height: 60px;
    }
    .pk-img-title{
        width: 50%;
        position: relative;
        margin-top: 10px;
    }
    .pk-img-title-name{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .pk-hiker-info{
        padding-top: 10px;
    }
    .hiker-img{
        width: 40px;
        height: 40px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .hiker-name{
        padding-left: 10px;
        padding-top: 10px;
        position: relative;
        z-index: 2;
    }
    .list-btn{
        position: relative;
        padding: 0 10px;
    }
    .comment-num{
        position: absolute;
        right: 0;
        top: -10px;
        color: #999;
    }
    .pk-btns > a{
        padding-bottom: 10px;
    }
    .banner-img{
        position: relative;
    }
    .banner-column{
        position: absolute;
        left: 0;
        top: 10px;
        font-size: 12px;
        color: #fff;
        padding: 2px 10px;
        background-color: #FF6600;
    }
    .subjectsBox {
        padding: 10px;
        background-color: #fff;
        margin-top: 10px;
    }
    .subjectTip {
        color: #fa6f6f;
        padding-left: 22px;
        background-image: url('/phone/public/images/wechat/subject/coupon.png');
        background-size: auto 12px;
        background-repeat: no-repeat;
        background-position: center left;
        line-height: 24px;
        font-size: 12px;
    }
    .boxTitle ,
    .subjectTitle {
        font-size: 16px;
    }
    .subjectTitle img {
        vertical-align: middle;
    }
    .boxTitle {
        background-color: #fff;
        padding: 10px 0 0 10px;

    }
    .subjectBox {
        padding: 5px 0;
    }
    .subjectABtn {
        display: inline-block;
        padding-left: 10px;
    }
    .subjectABtn:nth-child(1) {
        padding-left: 0;
    }
    .subjectABtn img{
        max-width: 100%;
    }
    .subjectA ,
    .subjectA:visited {
        color: #2b99ff;
    }
    .pk-img-desc{
        background-image: url('/phone/public/images/marketing/pk/desc.png');
        background-size: 100% 100%;
        padding: 10px 15px;
        width: 100%;
    }
</style>
<div class="content">

    <!-- 图片轮播 -->
    {st:ad action="getad" name="s_article_index_1"}
    {if $data['aditems']}
    <div class="swiper-wrapper" id="bannerSwiper">
        <div class="swiper-wrapper">
            {loop $data['aditems'] $v}
            <div class="swiper-slide">
                <div class="inner">
                    <a href="{$v['adlink']}">
                        <img title="{$v['adname']}" src="{Common::img($v['adsrc'],640,300)}"
                             style="width:100%;">
                    </a>
                </div>
            </div>
            {/loop}
            <div class="swiper-pagination banner-swiper-pagination" id="bannerSwiperPagination"></div>
        </div>
    </div>
    {else}
    <div class="banner">
        <img src="{Common::img($data['adsrc'],640,300)}" style="width:100%;">
    </div>
    {/if}
    {/st}

    <!-- nav -->
    <div class="navs flex-div">
        <div class="nav flex-center">
            <a href="/phone/notes/list">
                <div class="text-center">
                    <img src="/phone/public/images/wx/v4/list/me_text06.png"
                         style="width:50%;">
                    <div style="padding-top:5px;">有個专栏</div>
                </div>
            </a>
        </div>
        <div class="nav flex-center">
            <a href="/phone/notes/video_list">
                <div class="text-center">
                    <img src="/phone/public/images/wx/v4/list/write_newvideo.png"
                         style="width:50%;">
                    <div style="padding-top:5px;">最新视频</div>
                </div>
            </a>
        </div>
        <div class="nav flex-center">
            <a href="/phone/photo/list">
                <div class="text-center">
                    <img src="/phone/public/images/wx/v4/list/write_specilablum.png"
                         style="width:50%;">
                    <div style="padding-top:5px;">精选相册</div>
                </div>
            </a>
        </div>
        <div class="nav flex-center">
            <a href="/phone/theme/list">
                <div class="text-center">
                    <img src="/phone/public/images/wx/v4/list/write_topic.png"
                         style="width:50%;">
                    <div style="padding-top:5px;">主题活动</div>
                </div>
            </a>
        </div>
    </div>

    <!-- 主题数据 -->

    <div id="list" class="list">
        <!-- <p class="boxTitle">精选游记</p> -->
        {loop $list $row}
        <div class="article">
            <a href="{$row['url']}">
                <div class="flex-single">
                    <div style="width:38.4%;">
                        <div class="article-img" style="background-image:url({$row['img']});"></div>
                    </div>
                    <div style="width:61.6%; position:relative;">
                        <div class="article-title">{$row['title']}</div>
                        <div class="article-time">{$row['first_enable_date']}</div>
                        <div class="article-author">
                            <div class="left">
                                <div class="flex-single">
                                    <img class="img-circle" src="{$row['hiker']['headImgUrl']}" style="width:20px; height:20px;">
                                    <div class="flex-center article-hiker">{$row['hiker']['nickname']}</div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="flex-single">
                                    <img src="/phone/public/images/wechat/article/read_h2.png" style="height:12px;margin: 4px">
                                    <div style="padding-left:5px;">{$row['read']}阅读</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {/loop}
    </div>
    <div id="pageLoading" class="flex-center" style="padding:10px 0;">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
    </div>
    <div id="pageResult"></div>

</div>

{request "pub/notes_modal"}


<div class="back-top" onclick="backTop();" style="display: none;">
    <img src="/phone/public/images/wechat/v4/back_top.png" style="height:40px;">
</div>

{request "pub/code"}
{request "pub/footer"}
</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
    $(document).ready(function() {
        $(".tab-notice").addClass("show-tab-notice");
    });
</script>
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=18" ></script>
<script type="text/javascript">

    //是否直接弹出小程序码

    $(".banner-img").css("height",($(window).height()*0.3)+"px");

    var bannerSwiper = new Swiper("#bannerSwiper", {
        pagination : '#bannerSwiperPagination',
        paginationClickable: true,
        autoHeight: true,
        loop: true,
        autoplay: 4000,
    });

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
    updateItemImg(); //调整游记图片高度

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
                    url: '/phone/notes/ajax_notes',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        page: page,
                        wxoid: ""
                    },
                })
                    .done(function(getdata) {
                        console.log(getdata);
                        isPageGetting = false;
                        if( getdata.status == 1 ){
                            $.each(getdata.articles, function(index, article) {
                                setArticle( article );
                            });
                            updateItemImg();
                            if( getdata.articles.length < 5 ){
                                pageEnd = true;
                                $("#pageLoading").hide();
                                $("#pageResult").show();
                                $("#pageResult").html("没有更多游记了");
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

    function setArticle( data ){
        if (data['title'].indexOf('test') > -1 || data['title'].indexOf('测试') > -1) {
            return false;
        }
        var addHtml = '';
        addHtml += '<div class="article">';
        addHtml +=     '<a href="'+ data['url'] +'">';
        addHtml +=     '<div class="flex-single">';
        addHtml +=         '<div style="width:38.4%;">';
        addHtml +=             '<div class="article-img" style="background-image:url('+ data['img'] +');"></div>';
        addHtml +=         '</div>';
        addHtml +=         '<div style="width:61.6%; position:relative;">';
        addHtml +=             '<div class="article-title">';
        addHtml +=                 ( data['select_status'] == 1 || data['select_status'] == 3 ? '<div class="title-icon flex-start">精选</div>' : '' ) + ' '+ data['title'] +'';
        addHtml +=             '</div>';
        addHtml +=             '<div class="article-time">';
        addHtml +=                 data['first_enable_date'];
        addHtml +=             '</div>';
        addHtml +=             '<div class="article-author">';
        addHtml +=                 '<div class="left">';
        addHtml +=                      '<div class="flex-single">';
        addHtml +=                          '<img class="img-circle" src="'+ data['hiker']['headImgUrl'] +'"  style="width:20px; height:20px;">';
        addHtml +=                          '<div class="flex-center article-hiker">'+ data['hiker']['nickname'] +'</div>';
        addHtml +=                       '</div>';
        addHtml +=                 '</div>';
        addHtml +=                 '<div class="right">';
        addHtml +=                      '<div class="flex-single">';
        addHtml +=                          '<img  src="/phone/public/images/wechat/article/read_h2.png" style="height:12px;margin: 4px">';
        addHtml +=                          '<div style="padding-left:5px;">'+ data['read'] +'阅读</div>';
        addHtml +=                       '</div>';
        addHtml +=                 '</div>';
        addHtml +=             '</div>';
        addHtml +=         '</div>';
        addHtml +=     '</div>';
        addHtml +=     '</a>';
        addHtml += '</div>';
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
                    $(e).html('<img src="/images/wechat/article/good2_g.png" style="height:14px;"><div style="padding-left:5px;">' + (t + 1)) + '</div>';
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

    var lookTop = $(window).height();
    $(document).ready(function () {
        $(window).scroll(function () {
            //显示返回顶部
            if( $(window).scrollTop() >= lookTop ){
                $(".back-top").show();
            }else{
                $(".back-top").hide();
            }
        });
    });

    function backTop(){
        $(window).scrollTop(0);
    }

</script>

</html>