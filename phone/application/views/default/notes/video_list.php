<!DOCTYPE html>
<html>
<head>
    <title>游记-视频</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=15"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/index.css?v=10"/>
    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=2"/>
    <link rel="stylesheet" type="text/css" href="/phone/public/css/nav.css"/>
    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>
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
</head>
<body>
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>

<link rel="stylesheet" type="text/css" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11"/>
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=2"/>
<link rel="stylesheet" type="text/css" href="/phone/public/css/ugc/show_edit.css?v=3">
<style type="text/css">
    .content {
        padding-bottom: 50px;
    }

    .banner-img {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        width: 100%;
        height: 120px;
    }

    .swiper-container-horizontal > .swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction {
        bottom: 5px;
    }

    .swiper-pagination-bullet-active {
        background-color: #37c87b;
    }

    .article-name, .column-name {
        font-size: 16px;
        padding-bottom: 5px;
    }

    .column-name {
        background: -webkit-linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
        padding: 15px 10px;
        color: #fff;
        width: 100%;
    }

    .nav {
        width: 25%;
        height: auto;
        margin: 0;
        padding: 10px 0;
        font-size: 12px;
    }

    .article-img {
        width: 100%;
        min-height: 80px;
        background-color: #ddd;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: 5px;
    }

    .list {
        padding-top: 10px;
    }

    .article {
        background-color: #fff;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        width: 100%;
    }

    .article-title {
        padding: 0 10px;
        line-height: 22px;
        height: 44px;
        overflow: hidden;
        font-size: 16px;
    }

    .title-icon {
        font-size: 12px;
        line-height: 18px;
        background-color: #fa7777;
        color: #fff;
        margin: 2px 0;
        padding: 0 4px;
        display: inline-block;
    }

    .article-author {
        padding: 10px;
    }

    .article-hiker {
        padding: 0 10px;
        overflow: hidden;
        color: #666;
        font-size: 12px;
    }

    .article-time {
        color: #999;
        font-size: 12px;
        padding: 5px 0px 0px 10px
    }

    #pageResult {
        display: none;
        text-align: center;
        font-size: 12px;
        color: #999;
        padding: 10px 0;
    }

    .back-top {
        position: fixed;
        right: 10px;
        bottom: 60px;
        z-index: 1000;
        display: none;
    }

    .pk-main {
        background-color: #FFD600;
        margin-top: 10px;
    }

    .pk-body {
        position: relative;
        max-width: 520px;
        margin: 0 auto;
    }

    .pk-hiker {
        padding: 10px 15px;
    }

    .pk-top {
        padding-top: 20px;
    }

    .main-bg {
        position: relative;
        z-index: 2;
    }

    .pk-img {
        width: 42%;
        padding: 0 5px;
        position: absolute;
        top: 4%;
        z-index: 1;
    }

    .pk-img.left {
        left: 9%;
    }

    .pk-img.right {
        right: 8%;
    }

    .main-img {
        width: 100%;
        min-height: 60px;
    }

    .pk-img-title {
        width: 50%;
        position: relative;
        margin-top: 10px;
    }

    .pk-img-title-name {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }

    .pk-hiker-info {
        padding-top: 10px;
    }

    .hiker-img {
        width: 40px;
        height: 40px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .hiker-name {
        padding-left: 10px;
        padding-top: 10px;
        position: relative;
        z-index: 2;
    }

    .list-btn {
        position: relative;
        padding: 0 10px;
    }

    .comment-num {
        position: absolute;
        right: 0;
        top: -10px;
        color: #999;
    }

    .pk-btns > a {
        padding-bottom: 10px;
    }

    .banner-img {
        position: relative;
    }

    .banner-column {
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

    .boxTitle,
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

    .subjectABtn img {
        max-width: 100%;
    }

    .subjectA,
    .subjectA:visited {
        color: #2b99ff;
    }

    .pk-img-desc {
        background-image: url('/phone/public/images/marketing/pk/desc.png');
        background-size: 100% 100%;
        padding: 10px 15px;
        width: 100%;
    }
</style>
<div class="content">
    <!-- 主题数据 -->

    <div id="list" class="list">
        <!-- <p class="boxTitle">精选游记</p> -->
        {loop $articles $row}
        <div class="article">
            <a href="{$row['url']}">
                <div class="flex-single">
                    <div style="width:38.4%;">
                        <div class="article-img flex-center" style="background-image: url({$row['img']}); width: 130.56px; height: 88.8533px;">
                            <img src="/phone/public/images/ugc/video.png" style="height:25px;min-height:25px;">
                        </div>
                    </div>
                    <div style="width:61.6%; position:relative;">
                        <div class="article-title">
                            {$row['title']}
                        </div>
                        <div class="article-time">{$row['first_enable_date']}</div>
                        <div class="article-author">
                            <div class="left">
                                <div class="flex-single">
                                    <img class="img-circle"
                                         src="{$row['hiker']['headImgUrl']}"
                                         style="width:20px; height:20px;">
                                    <div class="flex-center article-hiker">{$row['hiker']['nickname']}</div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="flex-single">
                                    <img src="/phone/public/images/ugc/comment.png" style="height:12px;margin: 4px">
                                    <div style="padding-left:5px;">{$row['comment_count']}</div>
                                    <img src="/phone/public/images/wechat/article/read_h2.png" style="height:12px;margin: 4px">
                                    <div style="padding-left:5px;">{$row['read']}</div>
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


<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }

    $(document).ready(function () {
        $(".tab-notice").addClass("show-tab-notice");
    });
</script>
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=18"></script>
<script type="text/javascript" src="/phone/public/js/ugc/show_edit.js?v=2"></script>
<script type="text/javascript">

    //是否直接弹出小程序码

    $(".banner-img").css("height", ($(window).height() * 0.3) + "px");

    var bannerSwiper = new Swiper("#bannerSwiper", {
        pagination: '#bannerSwiperPagination',
        paginationClickable: true,
        autoHeight: true,
        loop: true,
        autoplay: 4000,
    });

    function updateItemImg() {
        var width = ($(window).width() - 20) * 0.384;
        var height = width * 196 / 288;
        $(".article-img").each(function (index, el) {
            $(this).css({
                "width": width + "px",
                "height": height + "px"
            });
        });
    }

    updateItemImg(); //调整游记图片高度

    var page = 1;
    var isPageGetting = false;
    var pageEnd = false;
    $(document).ready(function () {
        $(window).scroll(function () {
            var height = $(".content").height();
            //提前一屏加载分页
            if ($(window).scrollTop() + $(window).height() >= height - $(window).height()) {
                if (isPageGetting || pageEnd) {
                    return false;
                }
                isPageGetting = true;
                page++;
                $.ajax({
                    url: '/phone/notes/ajax_get_video_list',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        page: page,
                        wxoid: ""
                    },
                })
                    .done(function (getdata) {
                        console.log(getdata);
                        isPageGetting = false;
                        if (getdata.status == 1) {
                            $.each(getdata.articles, function (index, article) {
                                setArticle(article);
                            });
                            updateItemImg();
                            if (getdata.articles.length < 5) {
                                pageEnd = true;
                                $("#pageLoading").hide();
                                $("#pageResult").show();
                                $("#pageResult").html("没有更多游记了");
                            }
                        } else {
                            $("#pageLoading").hide();
                            $("#pageResult").show();
                            $("#pageResult").html("无法获取数据");
                        }
                    })
                    .fail(function () {
                        isPageGetting = false;
                        $("#pageLoading").hide();
                        $("#pageResult").show();
                        $("#pageResult").html("无法获取数据");
                    });
            }
        });
    });

    function setArticle(data) {
        var addHtml = '';
        addHtml +='<div class="article">' +
            '            <a href="'+data['url']+'">' +
            '                <div class="flex-single">' +
            '                    <div style="width:38.4%;">' +
            '                        <div class="article-img flex-center" style="background-image: url('+data['img']+'); width: 136.32px; height: 92.7733px;">' +
            '                            <img src="/phone/public/images/ugc/video.png" style="height:25px;min-height:25px;">' +
            '                        </div>' +
            '                    </div>' +
            '                    <div style="width:61.6%; position:relative;">' +
            '                        <div class="article-title">' +
            '                            '+data['title']+'                        </div>' +
            '                        <div class="article-time">'+data['first_enable_date']+'</div>' +
            '                        <div class="article-author">' +
            '                            <div class="left">' +
            '                                <div class="flex-single">' +
            '                                    <img class="img-circle" src="'+data['hiker']['headImgUrl']+'" style="width:20px; height:20px;">' +
            '                                    <div class="flex-center article-hiker">'+data['hiker']['nickname']+'</div>' +
            '                                </div>' +
            '                            </div>' +
            '                            <div class="right">' +
            '                                <div class="flex-single">' +
            '                                    <img src="/phone/public/images/ugc/comment.png" style="height:12px;margin: 4px">' +
            '                                    <div style="padding-left:5px;">'+data['comment_count']+'</div>' +
            '                                    <img src="/phone/public/images/wechat/article/read_h2.png" style="height:12px;margin: 4px">' +
            '                                    <div style="padding-left:5px;">'+data['read']+'</div>' +
            '                                </div>' +
            '                            </div>' +
            '                        </div>' +
            '                    </div>' +
            '                </div>' +
            '            </a>' +
            '        </div>';
        $("#list").append(addHtml);
    }

    function like(e, event) {
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
            .done(function (getdata) {
                $("#loading").hide();
                if (getdata.status == 1) {
                    $(e).removeAttr('onclick');
                    var t = parseInt($(e).text());
                    $(e).html('<img src="/phone/images/wechat/article/good2_g.png" style="height:14px;"><div style="padding-left:5px;">' + (t + 1)) + '</div>';
                } else {
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
            .fail(function () {
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
            if ($(window).scrollTop() >= lookTop) {
                $(".back-top").show();
            } else {
                $(".back-top").hide();
            }
        });
    });

    function backTop() {
        $(window).scrollTop(0);
    }

</script>

</body>
</html>