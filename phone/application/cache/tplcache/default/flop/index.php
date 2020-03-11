<!DOCTYPE html>
<html>
<head>
    <title>茄子户外运动自选</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=15"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/index.css?v=10"/>
    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=2"/>
    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>
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
</head>
<body>
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11"/>
<style type="text/css">
    /*滚动条样式 结束*/
    .banner {
        height: 100%;
        background-color: #ddd;
        overflow: hidden;
    }
    .search {
        padding: 0 10px;
        margin-top: -10px;
    }
    .search-main {
        width: 82%;
        padding: 8px 0;
        background-color: #f0f0f0;
        position: relative;
        border-radius: 25px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
        margin: 22px auto;
    }
    #search_text {
        height: 22px;
        line-height: 22px;
        border-radius: 4px;
        text-align: center;
        display: none;
        background: #F0F0F0;
    }
    .search-placeholder {
        height: 22px;
        line-height: 22px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        color: #b2b2b2;
    }
    .flex-div {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .discount {
        background-color: #fa2e4f;
        color: #fff;
        border-radius: 8px;
        font-size: 10px;
        height: 18px;
        line-height: 18px;
        width: 40px;
        text-align: center;
    }
    .discount-icon {
        position: absolute;
        left: 3px;
        bottom: -3px;
        height: 3px;
    }
    .discount-desc {
        font-size: 12px;
        color: #999;
        padding: 10px 0 10px 5px;
    }
    .class-list {
        display: flex;
        flex-direction: row;
        background-color: #fff;
        width: 100%;
        position: relative;
    }
    .class-tabs {
        position: absolute;
        left: 0;
        top: 0;
        width: 80px;
    }
    .class-tabs-main {
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch; /*使IOS滚动更流畅，可能会影响性能*/
    }
    .class-tab {
        background-color: #f4f4f4;
        padding: 16px 0;
        width: 80px;
        text-align: center;
        border-left: 4px solid #f4f4f4;
        border-bottom: 1px solid #fff;
        font-size: 12px;
    }
    .class-tabs-main .class-tab:first-of-type {
        color: #ff6600;
    }
    .class-tabs-main .class-tab.active {
        background-color: #fff;
        border-left-color: #a394f3;
        color: #a394f3;
    }
    .class-content {
        padding: 5px 0;
        padding-left: 80px;
        display: none;
    }
    .class-content-main {
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch; /*使IOS滚动更流畅，可能会影响性能*/
    }
    .class-content.active {
        display: inherit;
    }
    .class-content.active .class-content-main {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .class-line {
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
        position: relative;
        width: 50%;
    }
    .class-line a > div:first-of-type {
        position: relative;
    }
    .class-top {
        position: absolute;
        left: -5px;
        top: 0;
        z-index: 100;
        color: #fff;
        width: 55px;
        height: 18px;
        background-image: url('/phone/public/images/wechat/v4/top2.png');
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
        font-size: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .class-line-img {
        width: 100%;
        border-radius: 4px;
    }
    .line-name {
        padding-top: 5px;
    }
    .line-info {
        font-size: 12px;
        color: #999;
        padding-left: 5px;
    }
    .class-go {
        position: absolute;
        right: 0;
        bottom: 5px;
        color: #fff;
        font-size: 12px;
        background-color: #fa6b6b;
        padding: 0 2px;
    }
    .apply-modal {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        width: 100%;
        height: 100%;
    }
    .apply-modal.active {
        display: flex;
        justify-content: center;
        /*align-items: center;*/
    }
    .apply-bg {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .apply-content-bg {
        width: 80%;
        height: 70%;
        background-image: url('/phone/public/image/wx/wechat/apply_bg.png');
        background-size: 100%;
        background-repeat: no-repeat;
        position: relative;
        z-index: 1001;
        margin-top: 15%;
    }
    .apply-content {
        position: absolute;
        left: 0;
        top: 31%;
        z-index: 1001;
        width: 100%;
        height: 100%;
        padding: 0 10px;
    }
    .apply-title {
        text-align: center;
        font-size: 16px;
        color: #000;
    }
    .apply-close {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
        height: 22px;
    }
    .apply-input textarea {
        width: 100%;
        height: 20%;
        border: 0;
        margin: 0;
        padding: 10px;
    }
    .apply-same {
        padding-top: 10px;
        display: none;
    }
    .apply-same.active {
        display: inherit;
    }
    .apply-same-title {
        font-size: 12px;
        color: #999;
    }
    #applySameList {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding-top: 5px;
        display: none;
        height: 62px;
        overflow: hidden;
    }
    #applySameList a {
        font-size: 12px;
        border: 1px solid rgba(51, 51, 51, 0.2);
        border-radius: 3px;
        padding: 2px 5px;
        margin-right: 10px;
        margin-bottom: 5px;
    }
    .apply-btns {
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: 1001;
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 2%;
    }
    .apply-btn {
        width: 50%;
        text-align: center;
        border-top: 1px solid #a394f3;
        height: 34px;
        line-height: 34px;
        padding: 2px 0;
    }
    .apply-btn div {
        height: 30px;
        line-height: 30px;
        border-right: 1px solid #a394f3;
    }
    .apply-btn:last-of-type div {
        border-right: 0;
    }
    .content {
        padding-bottom: 0;
        /*overflow: hidden;*/
    }
    .list-loading {
        text-align: center;
    }
    .class-line-money {
        position: absolute;
        right: 0;
        bottom: 10px;
        font-size: 12px;
        color: #fff;
        /*background-color: rgba(250, 107, 107, 0.8);*/
        padding: 0 5px;
    }
    .apply-text {
        border: 1px solid #e4e4e4;
        border-radius: 4px;
    }
    .apply-text textarea {
        width: 100%;
        padding: 5px 10px;
        border: 0;
        margin: 0;
        height: 58px;
        line-height: 16px;
        border-radius: 4px;
    }
    .loading.right {
        background-image: url(/phone/public/images/wechat/right.png);
    }
</style>
<div class="content">
    <!-- 图片轮播 -->
    <?php require_once ("/data/web/qiezi_travel/phone/taglib/ad.php");$ad_tag = new Taglib_Ad();if (method_exists($ad_tag, 'getad')) {$data = $ad_tag->getad(array('action'=>'getad','name'=>'s_index_3',));}?>
    <?php if($data['aditems']) { ?>
    <div class="swiper-wrapper" id="bannerSwiper">
        <div class="swiper-wrapper">
            <?php $n=1; if(is_array($data['aditems'])) { foreach($data['aditems'] as $v) { ?>
            <div class="swiper-slide">
                <div class="inner">
                    <a href="<?php echo $v['adlink'];?>">
                        <img title="<?php echo $v['adname'];?>" src="<?php echo Common::img($v['adsrc'],640,300);?>"
                             style="width:100%;">
                    </a>
                </div>
            </div>
            <?php $n++;}unset($n); } ?>
            <div class="swiper-pagination banner-swiper-pagination" id="bannerSwiperPagination"></div>
        </div>
    </div>
    <?php } else { ?>
    <div class="banner">
        <img src="<?php echo Common::img($data['adsrc'],640,300);?>" style="width:100%;">
    </div>
    <?php } ?>
    
    <!-- 搜索框 -->
    <form id="searchForm" method="get" style="margin-bottom: 10px;" action="/phone/flop/search"
          onsubmit="return checkNull()">
        <div class="search">
            <div class="search-main">
                <input class="search-text" type="text" id="search_text" name="keyword" value="">
                <div class="search-placeholder" onclick="showSearchInput(1);">
                    <img src="/phone/public/images/wechat/v4/search.png" style="height:14px;">
                    <span>&nbsp;&nbsp;点我搜索自选线路</span>
                </div>
            </div>
        </div>
    </form>
    <!-- 优惠 -->
    <div style="display: none" class="flex-div flex-center discount-show">
        <div style="position:relative;">
            <div class="discount">奖励</div>
        </div>
        <div class="discount-desc">自选活动前5一天优惠15元，两至三天优惠30元</div>
    </div>
    <!-- 分类列表 -->
    <div class="list-loading" style="display: none;">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
    </div>
    <div class="class-list" style="height: 478px;">
        <div class="class-tabs">
            <div class="class-tabs-main" style="height: 468px;">
                <?php $k=0; ?>
                <?php foreach ($nav as $v){ ?>
                <div class="class-tab <?php echo $k==0?'active':''; ?>" onclick="changeTab(<?php echo $k; ?>);"><?php echo  $v ?></div>
                <?php $k++; }?>
            </div>
        </div>
        <?php $n=1; if(is_array($line_list)) { foreach($line_list as $k => $item) { ?>
        <div class="class-content <?php if($k==1) { ?>active <?php } ?>
">
            <div class="class-content-main" style="height: 468px;">
                <?php $n=1; if(is_array($item)) { foreach($item as $row) { ?>
                <div class="class-line" style="width:100%;height: 100%">
                    <a href="<?php echo $row['url'];?>">
                        <div style="position:relative;">
                            <img class="class-line-img" src="<?php echo Common::img($row['litpic']);?>">
                            <div class="class-line-money"><?php echo Common::price($row['price']);?></div>
                        </div>
                        <div class="line-name"><?php echo $row['title'];?></div>
                        <div class="line-info"><?php echo $row['lineday'];?>天&nbsp;&nbsp;难度:<?php echo Common::difficulty_desc($row['difficultylevel']);?></div>
                    </a>
                </div>
                <?php $n++;}unset($n); } ?>
<!--                <div class="class-line" style="width:100%;" onclick="showHopeAdd();">-->
<!--                    <div>-->
<!--                        <img class="class-line-img" src="/phone/public/images/wx/wechat/line_add.png">-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
        <?php $n++;}unset($n); } ?>
    </div>
</div>
<?php echo Request::factory('pub/code')->execute()->body(); ?>
<?php echo Request::factory('pub/footer')->execute()->body(); ?>
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
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=12"></script>
<script type="text/javascript">
    function updateListHeight() {
        var windowHeight = $(window).height();
        var topHeight = $(".search").height() + 10 + $(".discount-show").height();
        var listHeight = windowHeight - topHeight;
        $(".class-list").css('height', listHeight + "px");
        var mainListHeight = (listHeight - 10) - $(".index-nav").height();
        $(".class-content-main").css('height', mainListHeight + "px");
        $(".class-tabs-main").css('height', mainListHeight + "px");
        $(".list-loading").hide();
        $(".class-list").show();
    }
    updateListHeight();
    //屏幕宽度改变时再调整
    $(document).ready(function () {
        window.onresize = function () {
            updateImgHeight();
        };
    });
    $(document).ready(function () {
        var maxBannerHeight = $(window).width() * 396 / 750;
        var maxTop = maxBannerHeight - 20;
        // var lastScrollTop = 0;
        //内容滚动也改变页面滚动
        $(".class-content-main").each(function (index, el) {
            $(this).scroll(function () {
                var scrollTop = $(".banner").attr("scroll-num");
                // var offset = $(this).scrollTop() - lastScrollTop;
                var beforeTab = $(".banner").attr("before-tab");
                var showTab = $(".banner").attr("show-tab");
                var checkScrollTop = 0;
                if (beforeTab != showTab) {
                    checkScrollTop = scrollTop + $(this).scrollTop();
                    if ($(this).scrollTop() > maxTop) {
                        $(".banner").attr("before-tab", showTab);
                    }
                } else {
                    checkScrollTop = $(this).scrollTop();
                }
                // $(".discount-desc").html("页面滚动值："+scrollTop+"；判断值："+checkScrollTop+"；之前TAB："+beforeTab+"；显示TAB："+showTab);
                if (checkScrollTop <= maxTop) {
                    $(window).scrollTop($(this).scrollTop());
                    $(".banner").attr("scroll-num", $(this).scrollTop());
                } else {
                    $(window).scrollTop(maxTop);
                    $(".banner").attr("scroll-num", maxTop);
                }
                // lastScrollTop = $(this).scrollTop();
            });
        });
        $(".class-tabs-main").each(function (index, el) {
            $(this).scroll(function () {
                var scrollTop = $(".banner").attr("scroll-num");
                // var offset = $(this).scrollTop() - lastScrollTop;
                var beforeTab = $(".banner").attr("before-tab");
                var showTab = $(".banner").attr("show-tab");
                var checkScrollTop = 0;
                if (beforeTab != showTab) {
                    checkScrollTop = scrollTop + $(this).scrollTop();
                    if ($(this).scrollTop() > maxTop) {
                        $(".banner").attr("before-tab", showTab);
                    }
                } else {
                    checkScrollTop = $(this).scrollTop();
                }
                // $(".discount-desc").html("页面滚动值："+scrollTop+"；判断值："+checkScrollTop+"；之前TAB："+beforeTab+"；显示TAB："+showTab);
                if (checkScrollTop <= maxTop) {
                    $(window).scrollTop($(this).scrollTop());
                    $(".banner").attr("scroll-num", $(this).scrollTop());
                } else {
                    $(window).scrollTop(maxTop);
                    $(".banner").attr("scroll-num", maxTop);
                }
                // lastScrollTop = $(this).scrollTop();
            });
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() <= maxTop) {
                $(".banner").attr("scroll-num", $(window).scrollTop());
            } else {
                $(".banner").attr("scroll-num", maxTop);
            }
        });
        $(".class-tabs-main").find(".class-tab").eq(0).click();
    });
    //计算弹窗的高度
    // var applyModalHeight = $(window).width() * 0.8 * 801 / 620;
    // $(".apply-content-bg").css('height', applyModalHeight+'px');
    // var applyTextareaHeight = applyModalHeight - applyModalHeight * 0.31 - 180 + 80;
    // $("#applyText").css("height", applyTextareaHeight+"px");
    function showSearchInput(ishide) {
        if (ishide == 1) {
            $(".search-placeholder").hide();
            $("#search_text").show();
            $("#search_text").focus();
        } else {
            $(".search-placeholder").show();
            $("#search_text").hide();
        }
    }
    $(document).on('blur', '#search_text', function (event) {
        $(".search-placeholder span span").html("“" + $("#search_text").val() + "”");
        showSearchInput(0);
    });
    function checkNull() {
        if ($("#search_text").val() == '') {
            return false;
        }
        return true;
    }
    //tab切换
    var showTab = 0;
    var beforeTab = 0;
    function changeTab(tabNum) {
        beforeTab = showTab;
        showTab = tabNum;
        $(".banner").attr("before-tab", beforeTab);
        $(".banner").attr("show-tab", showTab);
        $(".class-tab").removeClass("active");
        $(".class-tab").eq(tabNum).addClass("active");
        $(".class-content").removeClass("active");
        $(".class-content").eq(tabNum).addClass("active");
    }
    //预加载弹窗背景图
    // var img = new Image();
    // img.src = 'https://f01.qiezi.local/public/image/wx/wechat/apply_bg.png';
    function hideApplyModal() {
        closePopLayer();
        $("#applyModal").removeClass('active');
    }
    function submitApply() {
        var applyText = $("#applyText").val();
        closePopLayer();
        if (applyText == "") {
            popLayer(
                //基本属性配置,closePopLayer为默认关闭按钮的方法
                {
                    title: '', //头部标题
                    btnsName: '确认', //按钮的名称组字符串
                    btnsCallback: 'closePopLayer();', //按钮的回调方法名(按照按钮名称的顺序)
                    content: '<div class="text-center">申请内容不能为空！</div>', //内容HTML
                }
            );
        }
        $(".loading").html("正在申请");
        $("#loading").show();
        $.ajax({
            url: '/wechat/v4/fanpai/saveapply',
            type: 'POST',
            dataType: 'json',
            data: {
                applyText: applyText,
                wxoid: ""
            },
        })
            .done(function (getdata) {
                console.log(getdata);
                if (getdata.status == 1) {
                    $("#loading").show();
                    $(".loading").addClass('right');
                    $(".loading").html("申请成功");
                    setTimeout(function () {
                        $(".loading").removeClass('right');
                        $("#loading").hide();
                    }, 2000);
                } else {
                    $("#loading").hide();
                    popLayer(
                        //基本属性配置,closePopLayer为默认关闭按钮的方法
                        {
                            title: '', //头部标题
                            btnsName: '确认', //按钮的名称组字符串
                            btnsCallback: 'closePopLayer();', //按钮的回调方法名(按照按钮名称的顺序)
                            content: '<div class="text-center">申请失败，请稍候再试！</div>', //内容HTML
                        }
                    );
                }
            })
            .fail(function () {
                $("#loading").hide();
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '', //头部标题
                        btnsName: '确认', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer();', //按钮的回调方法名(按照按钮名称的顺序)
                        content: '<div class="text-center">请求失败，请稍候再试！</div>', //内容HTML
                    }
                );
            });
    }
</script>
</body>
</html>