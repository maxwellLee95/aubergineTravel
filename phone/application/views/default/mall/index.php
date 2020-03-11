<!DOCTYPE html>
<html>
<head>
    <title>茄子户外运动装备小店</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css">
<link href="/phone/public/css/wechat/index_3v.css?v=6" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/mall/index.css?v=4">
<style type="text/css">
    .tabs{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .tab{
        width: 50%;
        padding: 10px 20px;
        text-align: center;
    }
    .tab a{
        color: #000000;
        background-color: #f3f3f3;
        border-bottom: 1px solid #ddd;
        display: block;
        padding: 7px;
        border-radius: 5px;
    }
    .tab.active a{
        background: #9B8CE5;
        color: #ffffff;
    }
    .tab-content{
        display: none;
    }
    .tab-content.active{
        display: inherit;
    }
    .one-three-module-content {
         padding: 0 0px;
    }
</style>
<div class="content">

    <!-- tab -->
    <div class="tabs">
        <div class="tab active ">
            <a href="/phone/mall/index">精选商品</a>
            <!-- <a onclick="changeTab(0);">精选商品</a> -->
        </div>
        <div class="tab ">
            <a href="/phone/mall/attr_list">补款与租赁</a>
            <!-- <a onclick="changeTab(1);">补款与租赁</a> -->
        </div>
    </div>

    <div class="tab-content active">
        {if $cartNum}
        <!-- 购物车入口 -->
        <div class="cart">
            <a href="/phone/mall/cart">
                <div class="cart-num">{$cartNum}</div>
                <img src="/phone/public/images/mall/cart_icon.png" width="50" height="50">
            </a>
        </div>
        {/if}
        {loop $list $row}
        <div class="one-three-module" style="padding-top: 15px; margin:0;">
            <div class="one-three-module-content">
                <div class="one-col" style="position:relative;">
                    <div class="one-three-img-title">
                        <a href="{$row['url']}">
                            <img src="/phone/public/images/wechat/grey_long.gif" data-url="{Common::img($row['litpic'],640,300)}" width="100%" alt="装备图">
                        </a>
                    </div>
                    <div class="one-three-activity-info">
                        <a href="{$row['url']}">
                            <div>
                                <div class="pull-left" style="padding-left: 5px; width: 100%; text-align: left;">{$row['title']}</div>
                                <div class="clear" style="padding:0;"></div>
                            </div>
                            <div style="padding-top: 15px;">
                                <div class="pull-left goods-money" money="{$row['price']}">
                                    <i class="fa fa-cny" style="color:rgba(252, 146, 22, 0.9);"></i>
                                    {$row['price']}                                                                                                                        </div>
                                <div class="pull-right sold-num">已售：<span>{$row['sellnum']}</span>件</div>
                                <div class="clear" style="padding:0;"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {/loop}
    </div>

    <div class="tab-content">

    </div>
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>


<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/bootstrap/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/timeInterval.js" ></script>
<script type="text/javascript">
    $(document).ready(function () {
        //实现图片慢慢浮现出来的效果
        $(".week-fest img").load(function () {
            //图片默认隐藏
            $(this).hide();
            //使用fadeIn特效
            $(this).fadeIn("5000");
            // $(this).show();
        });
        $(".content img").addClass("scrollLoading");
        // 异步加载图片，实现逐屏加载图片
        $(".scrollLoading").scrollLoading();
    });

    //滑块绑定

    function changeTab( tabNum ){
        $(".tab").removeClass("active");
        $(".tab").eq( tabNum ).addClass("active");
        $(".tab-content").removeClass("active");
        $(".tab-content").eq( tabNum ).addClass("active");
    }
</script>


</html>