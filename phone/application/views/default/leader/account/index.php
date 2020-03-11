<!DOCTYPE html>
<html>
<head>
    <title>领队中心</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
    <script type="text/javascript" src="/phone/public/bootstrap/js/bootstrap.min.js" ></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=18"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/index.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/nav.css">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">

    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>
    <style type="text/css" media="screen">
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover
        {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid transparent;
            border-bottom-color: #ddd;
        }
        .nav {
            height: 40px;
            margin-bottom: 1px;
            background-color: #fff;
            border-bottom: none;
        }
    </style>
</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>

<link type="text/css" rel="stylesheet" href="/phone/public/css/idangerous.swiper.css?v=20" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/my_leader.css?v=20">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=20">
<style type="text/css">
    .my-title li {
        border-right: 0px;
    }
    .my-header{
        width: 100%;
    }
    .my-banner{
        width: 100%;
    }
    .loading{
        width: 122px;
        height: 122px;
    }
    .my-title li{
        width: 25% !important;
    }
    /*商品订单相关样式*/
    .group-orders{
        background-color: #fff;
        margin-bottom: 10px;
    }
    .order-title{
        padding: 10px 0;
        margin: 0 10px;
        font-size: 12px;
        color: #787878;
        border-bottom: 1px solid #ddd;
    }
    .order-title .pull-right{
        color: #ff5000;
    }
    .my-product-order{
        margin: 0 10px;
        border-bottom: 1px solid #ddd;
    }
    .product-status, .product-money span{
        color: #ff5000;
        font-size: 12px;
    }
    .my-product-order li{
        padding: 10px 0;
        margin: 0;
        border-bottom: 1px dotted #ddd;
    }
    .my-product-order li:last-of-type{
        border-bottom: 0;
    }
    .product-size, .product-money, .product-name{
        font-size: 12px;
    }
    .rent-img{
        width: 70px;
        height: 70px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 140px;
    }
    .is-rent{
        font-size: 11px;
        background-color: #ff5000;
        color: #fff;
        padding: 1px 2px;
    }
    .leader_account {
        background: url(/phone/public/images/wechat/v4/my/leader_account.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_set {
        background: url(/phone/public/images/wechat/v4/my/setting.png?v=0) no-repeat;;
        background-size: 100%;
        background-position: center;
        background-repeat: no-repeat;
        height: 18px;
        width: 18px;
    }
    .leader_post {
        background: url(/phone/public/images/wechat/v4/my/leader_post.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .time_manage {
        background: url(/phone/public/images/wechat/v4/my/time_manage.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .material_manage {
        background: url(/phone/public/images/wechat/v4/my/material_manage.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }

    .leader_sum {
        background: url(/phone/public/images/wechat/v4/my/leader_sum.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .leader_grow {
        background: url(/phone/public/images/wechat/v4/my/leader_grow.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .leader_test {
        background: url(/phone/public/images/wechat/v4/my/leader_test.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .leader_rank {
        background: url(/phone/public/images/wechat/v4/my/leader_rank.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .leader_certification {
        background: url(/phone/public/images/wechat/v4/my/leader_certification.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_msg{
        background: url(/phone/public/images/wechat/v4/my/me_info.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }

    .red-point {
        position: absolute;
        left: 22px;
        top: 5px;
        background-color: #fb4c86;
        width: 13px;
        height: 13px;
        line-height: 13px;
        text-align: center;
        color: #fff;
        font-size: 10px;
        border-radius: 50%;
    }
    .my-title-name{
        font-size: 12px;
    }
    .images-event-info-img{
        width: 100px;
        height: 100px;
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
        font-size: 12px;
        height: 35px;
        overflow: hidden;
    }
    .article-time {
        color: #ccc;
    }
    .btn_container {
        position: absolute;
        bottom: 0;
    }
    .btn_container span{
        background: transparent;
        border: 1px solid #9B8CE5;
        color: #9B8CE5;
        padding: 5px 15px;
        margin-right: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        font-size: 10px;
        display: inline-block;
    }
    .sm_btn_container {
        position: absolute;
        bottom: 0;
    }
    .sm_btn_container span{
        background: transparent;
        border: 1px solid #9B8CE5;
        color: #9B8CE5;
        padding: 3px 10px;
        margin-right: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        font-size: 10px;
        display: inline-block;
    }


</style>
<div class="content" style="padding-bottom: 60px;">
    <div class="my-header">
        <div class="my-banner" style="background-image:url('/phone/public/images/wechat/hkr_bg_0.jpg'); background-size:cover; background-repeat:no-repeat; background-position:center;" >
            <div style="display: none" class="my-set-up">
                <a class="btn" href="#" >
                    <div class="icon_css icon_set"></div>
                </a>
            </div>
            <div class="user-avatar">
                <div >
                    <div class="bg">
                        <div class="bg2" style="transform: rotate(-180deg);-webkit-transform:rotate(-180deg);" ></div>
                    </div>
                    <div class="bg3">
                        <div class="bg4" style="transform: rotate(180deg);-webkit-transform:rotate(180deg);" ></div>
                    </div>
                    <div id="photo">
                        <a href="javascript::void(0)">
                            <img src="<?php echo $user['litpic'] ? $user['litpic'] : Common::member_nopic() ?>" alt="头像" class="img-circle images-event-info-img" />
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <div class="user-content">
            <div class="my-center-head-name">
                <p class="username-p username-shadow" style="font-size: 30px;color: #000000" >{$user['nickname']}<span style="display: none" class="icon_css icon_man"></span>
                </p>
                <a class="username-p user-score" href="#" onclick="_hmt.push(['_trackEvent', 'my', 'click', '个人中心等级说明']);" >
                    <div style="display: none" class="icon_css icon_l_g"></div>
                    <span class="fz14" style="color: #c3c3c3;" >积分 {$leader['integral']}  </span>
                </a>
                <div class="clear"></div>
                <div  style="width: 130px;margin: 0 auto">
                    <span class="fz14" style="color: #c3c3c3;float: left" >
                        <div class="starts-container">
                            <p class="grade-star"><span><em></em><b><i style=" width:<?php echo ($leader['star']*20).'%'?>"></i></b></span></p>
                        </div>
                        <div style="clear: both;"></div>
                    </span>
                    <span class="fz14" style="color: #c3c3c3;float: right" >
                        {Model_Leader::getStarNameByIntegral($leader['integral'])}</span>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <ul class="my-title">
            <li>
                <a href="/phone/member/lineapply/list">
                    <div class="my-title-img flex-center">
                        <div class="leader_post"></div>
                    </div>
                    <div class="my-title-name">自主发布</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="my-title-img flex-center">
                        <div class="time_manage"></div>
                    </div>
                    <div class="my-title-name">时间管理</div>
                </a>
            </li>
            <li>
                <a href="/phone/leader/material/list">
                    <div class="my-title-img flex-center">
                        <div class="material_manage"></div>
                    </div>
                    <div class="my-title-name">物资管理</div>
                </a>
            </li>
            <li>
                <a href="/phone/leader/report/list">
                    <div class="my-title-img flex-center">
                        <div class="leader_sum"></div>
                    </div>
                    <div class="my-title-name">查看总结</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="my-title-img flex-center">
                        <div class="leader_grow"></div>
                    </div>
                    <div class="my-title-name">领队成长</div>
                </a>
            </li>
            <li>
                <a href="/phone/leader/exam/list">
                    <div class="my-title-img flex-center">
                        <div class="leader_test"></div>
                    </div>
                    <div class="my-title-name">领队考试</div>
                </a>
            </li>
            <li>
                <a href="/phone/leader/leaderboard/line">
                    <div class="my-title-img flex-center">
                        <div class="leader_rank"></div>
                    </div>
                    <div class="my-title-name">龙虎榜</div>
                </a>
            </li>
            <li>
                <a href="/phone/leader/account/me">
                    <div class="my-title-img flex-center">
                        <div class="leader_account"></div>
                    </div>
                    <div class="my-title-name">账户</div>
                </a>
            </li>
            <li>
                <a href="/phone/leader/certification/list">
                    <div class="my-title-img flex-center">
                        <div class="leader_certification"></div>
                    </div>
                    <div class="my-title-name">领队认证</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/message/list">
                    <div class="my-title-img flex-center">
                        <div class="icon_msg"></div>
                    </div>
                    <div class="my-title-name">消息通知</div>
                </a>
            </li>

        </ul>
    </div>
    <div class="my-order">
        <ul id="myTabs" class="nav nav-tabs">
            <li class ="active"><a href="#manage" data-toggle="tab">我带队的活动</a></li>
            <li><a href="#assist" data-toggle="tab">我管理的活动</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="manage">
                {if !empty($manageList)}
                {loop $manageList  $row}
                <div class="article">
                    <a href="javascript::void(0)">
                        <div class="flex-single">
                            <div style="width:38.4%;">
                                <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'])?>); "></div>
                            </div>
                            <div style="padding-left:10px;width:61.6%; position:relative;">
                                <div class="article-title">
                                    {$row['title']}
                                </div>
                                {if $row['day']}
                                <div class="article-time">{date('m-d',$row['day'])}出发</div>
                                {/if}
                                <div class="sm_btn_container" >
                                    <a href="/phone/leader/activity/sign?line_id={$row['id']}&suit_id={$row['suitid']}&day={$row['day']}"><span>人员</span></a>
                                    <a href="/phone/leader/activity/qrcode?line_id={$row['id']}"><span>群二维码</span></a>
                                    <a href="/phone/leader/report/add?line_id={$row['id']}&suit_id={$row['suitid']}&day={$row['day']}"><span>写总结</span></a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {/loop}
                {else}
                <div class="no-order">
                    <div>
                        您还没有带队的活动
                    </div>
                </div>
                {/if}
            </div>
            <div class="tab-pane" id="assist">
                {if !empty($assistList)}
                {loop $assistList  $row}
                <div class="article">
                    <a href="javascript::void(0)">
                        <div class="flex-single">
                            <div style="width:38.4%;">
                                <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'])?>); "></div>
                            </div>
                            <div style="padding-left:10px;width:61.6%; position:relative;">
                                <div class="article-title">
                                    {$row['title']}
                                </div>
                                {if $row['day']}
                                <div class="article-time">{date('m-d',$row['day'])}出发</div>
                                {/if}
                                <div class="sm_btn_container" >
                                    <a href="javascript::void(0)"><span>活动名单</span></a>
<!--                                    <a href="javascript::void(0)"><span>物资申请</span></a>-->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {/loop}
                {else}
                <div class="no-order">
                    <div>
                        您还没有管理的活动
                    </div>
                </div>
                {/if}
            </div>
        </div>
    </div>

</div>
{request 'pub/code'}
{request 'pub/footer'}
</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=20" ></script>
<script type="text/javascript" src="/phone/public/js/idangerous.swiper-2.7.0.min.js?v=20"></script>
<script type="text/javascript" src="/phone/public/js/idangerous.swiper.3dflow-2.0.js?v=20"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>


</html>