<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$seoinfo['seotitle']}-{$webname}</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}"/>
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}"/>
    {/if}
    <meta name="author" content="{$webname}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="{$GLOBALS['cfg_m_main_url']}/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="{$GLOBALS['cfg_m_main_url']}/favicon.ico" type="image/x-icon"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css">
    {php echo Common::css('wechat/bootstrap.min.css,wechat/style.css,wechat/global.min.css,wechat/icon.css,wechat/index.css,wechat/v4/flex_box.css,nav.css');}
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
{php echo Common::css('public/plugins/swiper3.3.1/css/swiper.min.css',false,false);}
{php echo Common::css('wechat/pop-layer.css,wechat/v4/index.css,wechat/v4/flex_box.css');}
<style type="text/css">

    .new-hiker-packet {
        position: fixed;
        top: 60%;
        right: 10px;
        z-index: 9999;
        animation: backslash 1s linear infinite;
        -webkit-animation: backslash 1s linear infinite;
    }

    .new-hiker-packet {
        right: auto;
        left: 10px;
        width: 16%;
    }

    .popupScore__redbtnimg {
        width: 70px;
    }

    .new-hiker-packet .popupScore__redbtnimg {
        width: 100%;
    }

    @keyframes backslash {
        from,
        50%,
        to {
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
        }
        25% {
            transform: translate3d(5px, -5px, 0);
            -webkit-transform: translate3d(5px, -5px, 0);
        }
        75% {
            transform: translate3d(-5px, 5px, 0);
            -webkit-transform: translate3d(-5px, 5px, 0);
        }
    }

    @-webkit-keyframes backslash {
        from,
        50%,
        to {
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
        }
        25% {
            transform: translate3d(5px, -5px, 0);
            -webkit-transform: translate3d(5px, -5px, 0);
        }
        75% {
            transform: translate3d(-5px, 5px, 0);
            -webkit-transform: translate3d(-5px, 5px, 0);
        }
    }

    .packet-layer {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
        opacity: 0;
    }

    .packet-layer-body {
        width: 100%;
        height: 100%;
    }

    .packet-layer-main {
        background-color: #fff;
        width: 90%;
        border-radius: 12px;
        margin: 0 5%;
    }

    .packet-list {
        padding: 15px 15px 0 15px;
    }

    .packet-each {
        margin-bottom: 15px;
        position: relative;
        border: 1px solid #eceaeb;
        box-shadow: 0 0 5px #eceaeb;
        border-radius: 6px;
    }

    .packet-line {
        position: absolute;
        left: 34%;
        top: -10%;
        height: 121%;
        background-color: #fff;
        padding: 2% 0;
    }

    .packet-money {
        color: #f76468;
        font-size: 40px;
        border-left: 5px solid #f76468;
        border-radius: 6px;
        width: 35%;
        padding: 5px 0;
    }

    .packet-money span {
        font-size: 20px;
        font-weight: bold;
        padding-top: 8px;
    }

    .packet-desc {
        width: 50%;
        padding-left: 5%;
        font-size: 12px;
        color: #666;
    }

    .packet-num {
        color: #f76468;
        font-size: 22px;
        width: 15%;
    }

    .packet-btn {
        font-size: 18px;
        color: #fff;
        background-color: #f76468;
        line-height: 24px;
        padding: 5px 20px;
        margin-bottom: 20px;
        border-radius: 17px;
    }

    .packet-close {
        width: 90%;
        margin: 0 5%;
    }

    .index-info {
        background-color: #fff;
    }

    .news {
        width: 100%;
        margin: 10px 0;
        padding: 0 5px 0 10px;
    }

    .news .div-center {
        border: 0 !important;
    }

    .news .div-center img {
        width: 100% !important;
    }

    .coin {
        width: 33%;
        background-color: #fff;
        padding: 0 15px;
    }

    .coin-desc {
        color: #f09e62;
        font-weight: bold;
        padding-left: 7px;
        width: 80%;
    }

    .info-line {
        width: 1px;
        height: 12px;
        background-color: #C7C7C7;
    }

    /*新版搜索框样式*/
    .search {
        background-color: #ffffff;
        padding: 6px 0;
    }

    .city-show {
        font-size: 16px;
        color: #333;
        width: 19%;
    }

    .city-show img {
        padding-left: 5px;
    }

    .record-btn {
        width: 13%;
        background:url(/phone/public/images/wechat/v5/home_collcet.png) center top no-repeat;
        background-size:22px 22px;
    }

    .search-input {
        width: 68%;
        position: relative;
        line-height: 36px;
    }

    input[type="text"]#search_text {
        border-radius: 20px;
        height: 36px;
        padding: 0 15px;
        text-align: left;
        background: #F3F3F3;
    }

    .search-placeholder {
        border-radius: 20px;
        height: 36px;
        padding: 0 15px;
    }

    .search-placeholder span {
        padding-left: 8px;
    }

    /*新版调整样式*/
    body, .content {
        background-color: #f7f7f7;
    }

    .navs {
        padding: 10px 0 0 0;
    }

    .nav-btn {
        padding-bottom: 10px;
    }

    .nav-name {
        margin-top: 8px;
        color: #333;
        font-size: 13px;
    }

    .index-info {
        margin-top: -5px;
    }

    .news {
        margin: 15px 0;
        width: 100%;
    }

    .coin {
        width: 28%;
    }

    .top-tab {
        padding: 5px 0;
    }

    .top-tab.active span {
        border: 0;
    }

    .top-tab-line {
        position: absolute;
        left: -4%;
        bottom: -3px;
        width: 108%;
        opacity: 0;
    }

    .top-tab.active .top-tab-line {
        opacity: 1;
    }


</style>
<div class="content" style="padding-bottom:50px;">


    <style id="goldCoinStyle">
        .hideGoldBoomCoin {
            transform: translate(0, -200px) rotateY(0deg) scale(0);
            -webkit-transform: translate(0, -200px) rotateY(0deg) scale(0);
            /*transform-origin: 50% 150%;*/
            /*-webkit-transform-origin: 50% 150%;*/
        }

        .showGoldCoin {
            /*animation: showGoldCoinAnt 3000ms ease-in-out forwards;*/
            /*-webkit-animation: showGoldCoinAnt 3000ms ease-in-out forwards;*/
            left: 35px !important;
            bottom: 80px !important;
            /*right: 35px;*/
            animation: showGoldCoinAnt2 800ms linear forwards, backslash 1s 800ms linear infinite;
            -webkit-animation: showGoldCoinAnt2 800ms linear forwards, backslash 1s 800ms linear infinite;
            /*animation: backslash 1s 1s linear infinite;*/
            /*-webkit-animation: backslash 1s 1s linear infinite;*/
            z-index: 999;
        }

        .hideGoldCoin {
            display: none !important;
            /*animation: hideGoldCoinAnt 2000ms linear forwards;*/
            /*-webkit-animation: hideGoldCoinAnt 2000ms linear forwards;*/
            /*z-index: 999;*/
        }

        .showGoldNum {
            display: none !important;
            /*animation: showGoldNumAnt 3200ms linear forwards;*/
            /*-webkit-animation: showGoldNumAnt 3200ms linear forwards;*/
            /*z-index: 999;*/
        }

        .boomGoldAntCls {
            display: none !important;
            /*transform-origin: 50% 150%;*/
            /*-webkit-transform-origin: 50% 150%;*/
        }

        @keyframes backslash {
            from,
            50%,
            to {
                transform: translate3d(0, 0, 0);
                -webkit-transform: translate3d(0, 0, 0);
            }
            25% {
                transform: translate3d(0, -5px, 0);
                -webkit-transform: translate3d(0, -5px, 0);
            }
            75% {
                transform: translate3d(0, 5px, 0);
                -webkit-transform: translate3d(0, 5px, 0);
            }
        }

        @-webkit-keyframes backslash {
            from,
            50%,
            to {
                transform: translate3d(0, 0, 0);
                -webkit-transform: translate3d(0, 0, 0);
            }
            25% {
                transform: translate3d(0, -5px, 0);
                -webkit-transform: translate3d(0, -5px, 0);
            }
            75% {
                transform: translate3d(0, 5px, 0);
                -webkit-transform: translate3d(0, 5px, 0);
            }
        }

        @keyframes showGoldCoinAnt2 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        @-webkit-keyframes showGoldCoinAnt2 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes showGoldCoinAnt {
            0% {
                transform: translate(0, -20vh) rotateY(0deg) scale(0);
            }
            33% {
                transform: translate(0, -50vh) rotateY(1080deg) scale(0.8);
            }
            100% {
                transform: translate(0, 0px) rotateY(3240deg) scale(1);
            }
        }

        @-webkit-keyframes showGoldCoinAnt {
            0% {
                -webkit-transform: translate(0, -20vh) rotateY(0deg) scale(0);
            }
            33% {
                -webkit-transform: translate(0, -50vh) rotateY(1080deg) scale(0.8);
            }
            100% {
                -webkit-transform: translate(0, 0px) rotateY(3240deg) scale(1);
            }
        }

        @keyframes hideGoldCoinAnt {
            0% {
                transform: translate(0, 0) rotateY(0deg) scale(1);
            }
            80% {
                transform: translate(0, -200px) rotateY(4160deg) scale(1);
            }
            99% {
                transform: translate(0, -210px) rotateY(5600deg) scale(0.5);
                opacity: 1;
            }
            100% {
                transform: translate(0, -210px) rotateY(5600deg) scale(0.5);
                opacity: 0;
            }
        }

        @-webkit-keyframes hideGoldCoinAnt {
            0% {
                -webkit-transform: translate(0, 0) rotateY(0deg) scale(1);
            }
            80% {
                -webkit-transform: translate(0, -200px) rotateY(4160deg) scale(1);
            }
            99% {
                -webkit-transform: translate(0, -210px) rotateY(5600deg) scale(0.5);
                opacity: 1;
            }
            100% {
                -webkit-transform: translate(0, -210px) rotateY(5600deg) scale(0.5);
                opacity: 0;
            }
        }

        @keyframes showGoldNumAnt {
            0% {
                transform: translate(0, -200px) scale(0);
                opacity: 0;
            }
            49% {
                transform: translate(0, -200px) scale(0);
                opacity: 0;
            }
            50% {
                transform: translate(0, -200px) scale(0.5);
                opacity: 1;
            }
            80% {
                transform: translate(0, -250px) scale(1.6);
                opacity: 1;
            }
            100% {
                transform: translate(0, -250px) scale(1.6);
                opacity: 0;
            }
        }

        @-webkit-keyframes showGoldNumAnt {
            0% {
                transform: translate(0, -200px) scale(0);
                opacity: 0;
            }
            49% {
                transform: translate(0, -200px) scale(0);
                opacity: 0;
            }
            50% {
                transform: translate(0, -200px) scale(0.5);
                opacity: 1;
            }
            80% {
                transform: translate(0, -250px) scale(1.6);
                opacity: 1;
            }
            100% {
                transform: translate(0, -250px) scale(1.6);
                opacity: 0;
            }
        }
    </style>
    <script>
        function hideCallBack() {
            closePopLayer();
        }
    </script>

    <div class="city-list" id="cityList">
        <div class="city-list-body">
            <div class="city-bg"></div>
            <div class="city-list-main">
                <div class="city-list-close" onclick="hideCity();">
                    <img src="/phone/public/images/wechat/v4/close_b.png" style="width:26px;" class="scrollLoading"/>
                </div>
                <div class="city-notice">请选择您所在的城市</div>
                <div class="citys-main">
                    {loop $city_list $city}
                        <div class="city"  onclick="doChangeCity( {$city['id']} );">
                            <div>
                                <img src="{$city['icon']}" style="width:100%;">
                            </div>
                            <div>{$city['cityname']}</div>
                        </div>
                    {/loop}
                </div>
            </div>
        </div>
    </div>

    <div class="top-module">
        <form id="searchForm" method="get" action="/phone/search" onsubmit="return checkNull()">
            <div class="search flex-div justify-between">
                {if $city_id}
                {loop $city_list $city}
                    {if $city['id'] == $city_id }
                    <div class="flex-center city-show" onclick="changeCity(this);">
                        <div>{$city['cityname']}</div>
                        <img src="/phone/public/images/wechat/v5/arrow_down.png" height="7">
                    </div>
                    {/if}
                {/loop}
                {else}
                    <div class="flex-center city-show" onclick="changeCity(this);">
                        <div>{$city_list[0]['cityname']}</div>
                        <img src="/phone/public/images/wechat/v5/arrow_down.png" height="7">
                    </div>
                {/if}
                <div class="search-input">
                    <input class="search-text" type="text" id="search_text" name="keyword" value="">
                    <div class="search-placeholder flex-start" onclick="showSearchInput(1);">
                        <img style="display: none" src="/phone/public/images/wechat/v5/search.png" height="16">
                        <span style="margin: 0 auto;">线路/相册/游记</span>
                    </div>
                </div>
                <a class="flex-center record-btn" href="/phone/member/account/collection">
                    <span style="font-size: 10px;margin-top: 20px;">收藏</span>
                </a>
            </div>
        </form>
        <div class="banners">
            <!-- 图片轮播 -->
            {st:ad action="getad" name="s_index_1"}
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
            <div class="navs flex-div">
                {st:channel action="getchannel" row="100"}
                {loop $data $row}
                <div class="nav-btn" style="width:20%;">
                    <a onclick="jumpNavUrl(this);"
                       data-url="{$row['url']}" data-bid="1">
                        <div class="div-center">
                            <img class="button-img"
                                 src="{$row['ico']}">
                        </div>
                        <div class="div-center nav-name">
                            {$row['title']}
                        </div>
                    </a>
                </div>
                {/loop}
                {/st}
            </div>
            <div class="flex-single index-info">
                <div class="news flex-start">
                    <img src="/phone/public/images/wechat/v5/news.png" height="16">
                    <div id="news">
                        <div class="scrollText">
                            {if !empty($top_msg)}
                            <ul>
                                {loop $top_msg  $row}
                                <li>
                                    <a href="javascript::void(0)">
                                        <span>{$row['nickname']} 报名了 {$row['productname']}</span>
                                    </a>
                                </li>
                                {/loop}
                            </ul>
                            {/if}
                        </div>
                    </div>
                </div>
                <div style="display: none" class="flex-center">
                    <div class="info-line"></div>
                </div>
                <a style="display: none" class="coin flex-center" href="#">
                    <img src="/phone/public/images/wx/wechat/home_sign.png" height="20" style="padding-right:5px;">
                    <img src="/phone/public/images/wx/wechat/free5.png" height="13">
                </a>
            </div>
        </div>

        <div id="pageModules">


            <!-- 本周下周样式配置 -->
            <div class="index-modal">
                <div class="flex-div div-center">
                    <div class="text-center top-tab active" onclick="changeTab('0',this);" data-module="1">
                        <div class="div-center">
                                <span style="position:relative;">
                                    本周活动<img class="top-tab-line" src="/phone/public/images/wechat/v5/line2.png">
                                </span>
                        </div>
                        <input type="hidden" class="modal_rand_type" value="">
                    </div>
                    <div class="text-center top-tab " onclick="changeTab('1',this);" data-module="2">
                        <div class="div-center">
                                <span style="position:relative;">
                                    下周活动 <img class="top-tab-line" src="/phone/public/images/wechat/v5/line2.png">
                                </span>
                        </div>
                        <input type="hidden" class="modal_rand_type" value="">
                    </div>
                    <div class="text-center top-tab " onclick="changeTab('2',this);" data-module="3">
                        <div class="div-center">
                            <span style="position:relative;">
                                    更多活动 <img class="top-tab-line" src="/phone/public/images/wechat/v5/line2.png">
                            </span>
                        </div>
                        <input type="hidden" class="modal_rand_type" value="">
                    </div>
                </div>
                
                <div class="tab-swipers" style="min-height: 225px">
                    <div class="tab-swipers-loading">
                        <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
                    </div>
                    <div class="tab-swiper-main ">
                        <div class="swiper-container tab-swiper" id="tabSwiper0">
                            <div class="swiper-wrapper">
                                {if  count($indexmodule1)>=6}
                                    {loop $indexmodule1  $e $row}
                                        {if $e % 6==0 }
                                        <div class="swiper-slide flex-div" style="width:100%; padding:0 5px;">
                                            {php}
                                            for($d=$e;$d<=$e+5;$d++){
                                                if(!empty($indexmodule1[$d])){
                                            {/php}
                                            <a href="{$indexmodule1[$d]['url']}"
                                               style="width:33.33%; padding-bottom:10px;">
                                                <div style="padding:0 5px;position: relative;">
                                                    <div class="flex-div">
                                                        <div class="modal15-line-img lazy-img-loading" style="display:inherit;"
                                                             data-img="{$indexmodule1[$d]['index_litpic']}"
                                                             data-type="1"></div>
                                                    </div>
                                                    <div class="line-name text-left">{$indexmodule1[$d]['index_title']}</div>
                                                    <div class="line-info">
                                                        <div class="pull-left">{Common::date_text_week($indexmodule1[$d]['day'])}</div>
                                                        <div class="pull-right">
                                                            <div class="status tab-status {$indexmodule1[$d]['status']['style']}">
                                                                {$indexmodule1[$d]['status']['name']}
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </a>
                                            {php}
                                            }
                                                }
                                            {/php}
                                        </div>
                                        {/if}
                                    {/loop}
                                {else}
                                    <div class="swiper-slide flex-div" style="width:100%; padding:0 5px;">
                                        {loop $indexmodule1  $e $row}
                                        <a href="{$row['url']}"
                                           style="width:33.33%; padding-bottom:10px;">
                                            <div style="padding:0 5px;position: relative;">
                                                <div class="flex-div">
                                                    <div class="modal15-line-img lazy-img-loading" style="display: inherit; background-image: url({$row['index_litpic']});height: 130px;"
                                                         data-img="{$row['index_litpic']}"
                                                         data-type="1"></div>
                                                </div>
                                                <div class="line-name text-left">{$row['index_title']}</div>
                                                <div class="line-info">
                                                    <div class="pull-left">{Common::date_text_week($row['day'])}</div>
                                                    <div class="pull-right">
                                                        <div class="status tab-status {$row['status']['style']}">
                                                            {$row['status']['name']}
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </a>
                                        {/loop}
                                    </div>
                                {/if}

                            </div>
                            <div class="swiper-pagination tab-swiper-pagination" id="tabSwiperPagination0"></div>
                        </div>
                    </div>
                    <div class="tab-swiper-main not-show">
                        <div class="swiper-container tab-swiper" id="tabSwiper1">
                            <div class="swiper-wrapper">
                            </div>
                            <div class="swiper-pagination tab-swiper-pagination" id="tabSwiperPagination1"></div>
                        </div>
                    </div>
                    <div class="tab-swiper-main not-show">
                        <div class="swiper-container tab-swiper" id="tabSwiper2">
                            <div class="swiper-wrapper">
                            </div>
                            <div class="swiper-pagination tab-swiper-pagination" id="tabSwiperPagination2"></div>
                        </div>
                    </div>
                </div>
            </div>

            {if !empty($indexmoudle4) }
            <div class="flex-div index-modal modal29" data-style="29" data-position="4" data-module="4">
                <div class="index-modal-content">
                    <div class="flex-div modal29-list">
                        {loop $indexmoudle4 $row}
                        <div class="modal29-img"  style="background-image:url({$row['index_litpic']}); width:100%;">
                            <a href="{$row['url']}">
                                <div class="flex-center" style="height:100%;">
                                    <div class="text-center">
                                        <div class="modal29-name">{$row['index_title']}</div>
                                        <div class="modal29-desc">[{$row['index_sub_title']}]</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {/loop}
                    </div>
                </div>
            </div>
            {/if}

        </div>

        <div class="index-modal look" id="look">
            <div class="index-modal-title black">
                <div>随便逛逛</div>
                <div>— 发现精彩 —</div>
            </div>
            <div id="lookList" class="index-modal-content" style="padding-top:10px;">
            </div>
        </div>

        <div class="page-loading div-center">
<!--            <img src="/phone/public/images/wechat/v4/footprint.gif" style="height:24px;">-->
            &nbsp;&nbsp;正在加载中...
        </div>

        <div class="is-last div-center" style="display:none;">已经到底啦</div>

        <div class="back-top" onclick="backTop();">
            <img src="/phone/public/images/wechat/v4/back_top.png" style="height:40px;">
        </div>

    </div>
    {request "pub/code"}
    {request "pub/footer"}

</body>
{php echo Common::js('jweixin-1.0.0.min.js');}
{php echo Common::js('public/plugins/jQuery/jQuery-2.1.3.min.js',false,false);}
{php echo Common::js('public/plugins/swiper3.3.1/js/swiper.min.js',false,false);}
{php echo Common::js('jquery.scrollLoading.js,wechat/pop-layer.js,jquery.textSlider.js,wechat/cookie.js');}
<script>
    // $(function(){
    //     $(".top-tab.active").click();
    // })
</script>
<script type="text/javascript">
    var windowWidth = $(window).width();
    var openId = "";
    var isSubscribe = "1";
    var isBack = "0";
    var showTab = "0";
    var weekFestActiveIndex = "0";
    var bannersLegnth = "5";
    var indexUrl = '#';
    var device = "1";

</script>
{php echo Common::js('timeInterval.js,wechat/v4/index.min.js,wechat/v4/jq.lazy_loading_img.js');}
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }

    $(document).ready(function () {
        $(".tab-notice").addClass("show-tab-notice");
    });
</script>
</html>