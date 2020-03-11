<!DOCTYPE html>
<html>
<head>
    <title>个人中心</title>
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
            color: #9B8CE5;
            cursor: default;
            background-color: #fff;
            border: 1px solid transparent;
            border-bottom-color: #9B8CE5;
        }
        .nav {
            height: 40px;
            margin-bottom: 1px;
            background-color: #fff;
            border-bottom: none;
        }
        .nav li{
            width: 25%;
        }
    </style>
</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>

<link type="text/css" rel="stylesheet" href="/phone/public/css/idangerous.swiper.css?v=20" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/my_new.css?v=20">
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
    .icon_account {
        background: url(/phone/public/images/wechat/v4/my/account.png?v=0) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }

    .icon_article {
        background: url(/phone/public/images/wechat/v4/my/article.png?v=0) no-repeat;
        background-size: 100%;
        height: 25px;
        width: 22px;
    }
    .icon_set {
        background: url(/phone/public/images/wechat/v4/my/setting.png?v=0) no-repeat;;
        background-size: 100%;
        background-position: center;
        background-repeat: no-repeat;
        height: 18px;
        width: 18px;
    }
    .icon_achievement {
        background: url(/phone/public/images/wechat/v4/my/me_success.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_publish {
        background: url(/phone/public/images/wechat/v4/my/me_post.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_line{
        background: url(/phone/public/images/wechat/v4/my/me_line.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_introduce{
        background: url(/phone/public/images/wechat/v4/my/me_ablum.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_article{
        background: url(/phone/public/images/wechat/v4/my/article.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_article{
        background: url(/phone/public/images/wechat/v4/my/article.png) no-repeat;
        background-size: 100%;
        height: 40px;
        width: 40px;
    }
    .icon_feedback{
        background: url(/phone/public/images/wechat/v4/my/me_feedback.png) no-repeat;
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
        <div class="my-banner" style="background-image:url({$user['bg_pic']}); background-size:cover; background-repeat:no-repeat; background-position:center;" >
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
                        <a href="/phone/member/account/edit">
                            <img src="<?php echo $user['litpic'] ? $user['litpic'] : Common::member_nopic() ?>" alt="头像" class="img-circle images-event-info-img" />
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <div class="user-content">
            <div class="my-center-head-name">
                <p class="username-p username-shadow" style="font-size: 30px;color: #000000" >{$user['nickname']}<span style="margin-left: 3px" class="icon_css {if $user['sex']=='男'}icon_man{/if}{if $user['sex']=='女'}icon_woman{/if}"></span>
                </p>
                <a class="username-p user-score" href="#" onclick="_hmt.push(['_trackEvent', 'my', 'click', '个人中心等级说明']);" >
                    <div style="display: none" class="icon_css icon_l_g"></div>
                    <span class="fz14" style="color: #c3c3c3;" >
                         等级 {$user['rank']}<span class="s fz12" >|</span>学分 {$user['jifen']}  </span>
                </a>
                <p class="fz12 subs-and-fans">
                    <a href="#">
                        <span>关注:<span class="fz12" id="sc_690587" >{$user['attention_count']}</span> </span>
                        <span class="s fz12" >|</span>
                        <span>粉丝:<span class="fz12" id="fc_690587" >{$user['fans_count']}</span> </span>
                    </a>
                </p>
            </div>
        </div>
        <ul class="my-title">
            <li>
                <a href="/phone/member/account/index">
                    <div class="my-title-img flex-center">
                        <div class="icon_account"></div>
                    </div>
                    <div class="my-title-name">账户</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/achievement/list">
                    <div class="my-title-img flex-center">
                        <div class="icon_achievement"></div>
                    </div>
                    <div class="my-title-name">成就</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/lineapply/add">
                    <div class="my-title-img flex-center">
                        <div class="icon_publish"></div>
                    </div>
                    <div class="my-title-name">自主发布</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/lineapply/list">
                    <div class="my-title-img flex-center">
                        <div class="icon_line"></div>
                    </div>
                    <div class="my-title-name">线路管理</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/photo/list">
                    <div class="my-title-img flex-center">
                        <div class="icon_introduce"></div>
                    </div>
                    <div class="my-title-name">相册</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/article/index">
                    <div class="my-title-img flex-center">
                        <div class="icon_article"></div>
                    </div>
                    <div class="my-title-name">游记</div>
                </a>
            </li>
            <li>
                <a href="/phone/member/consult/index">
                    <div class="my-title-img flex-center">
                        <div class="icon_feedback"></div>
                    </div>
                    <div class="my-title-name">意见反馈</div>
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
            <li class ="active"><a href="#line_order_list" data-toggle="tab">已报名</a></li>
            <li><a href="#line_order_list2" data-toggle="tab">已结束</a></li>
            <li><a href="#line_order_list3" data-toggle="tab">已退出</a></li>
            <li><a href="#goods_list" data-toggle="tab">商品订单</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="line_order_list">
                {if !empty($order_list['line_paid'])}
                {loop $order_list['line_paid']  $row}
                <div class="article">
                    <a href="{$row['url']}">
                        <div class="flex-single">
                            <div style="width:38.4%;">
                                <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'])?>); "></div>
                            </div>
                            <div style="padding-left:10px;width:61.6%; position:relative;">
                                <div class="article-title">
                                    {$row['productname']}
                                </div>
                                {if $row['usedate']}
                                <div class="article-time">{$row['usedate']}出发</div>
                                {/if}
                                <div class="btn_container" >

                                    {if $row['status']==2 && $row['status']!=5}
                                    <a href="{$row['refundurl']}"><span >申请退款</span></a>
                                    {/if}
                                    {if $row['status']!=2}
                                    {if $row['status']==1}
                                    <a href="{$row['payurl']}"><span>付款</span></a>
                                    {/if}
                                    <a href="{$row['cancelurl']}"><span>取消订单</span></a>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {/loop}
                {else}
                <div class="no-order">
                    <div>
                        <img src="/phone/public/images/wechat/my/payed_pay.png" width="32%">
                    </div>
                    <div>
                        您还未参加过活动
                    </div>
                </div>
                {/if}
            </div>
            <div class="tab-pane" id="line_order_list2">
                {if !empty($order_list['line_complete'])}
                {loop $order_list['line_complete']  $row}
                <div class="article">
                    <a href="{$row['url']}">
                        <div class="flex-single">
                            <div style="width:38.4%;">
                                <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'])?>); "></div>
                            </div>
                            <div style="padding-left:10px;width:61.6%; position:relative;">
                                <div class="article-title">
                                    {$row['productname']}
                                </div>
                                <div class="sm_btn_container">
                                    <div style="margin-bottom: 4px;">
                                        <a href="{$row['lineurl']}"><span>再走一个</span></a>
                                        {if $row['ispinlun'] == 0}
                                        <a href="{$row['commenturl']}"><span>评价</span></a>
                                        {/if}
                                    </div>
                                    <div>
                                        <a href="/phone/notes/add"><span>发游记</span></a>
                                        <a href="#"><span>发相片</span></a>
                                        <a href="/phone/notes/video_add"><span> 发视频</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {/loop}
                {else}
                <div class="no-order">
                    <div>
                        <img src="/phone/public/images/wechat/my/end_pay.png" width="32%">
                    </div>
                    <div>
                        您还未参加过活动
                    </div>
                </div>
                {/if}
            </div>
            <div class="tab-pane" id="line_order_list3">
                {if !empty($order_list['line_refund'])}
                {loop $order_list['line_refund']  $row}
                <div class="article">
                    <a href="{$row['url']}">
                        <div class="flex-single">
                            <div style="width:38.4%;">
                                <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'])?>); "></div>
                            </div>
                            <div style="padding-left:10px;width:61.6%; position:relative;">
                                <div class="article-title">
                                    {$row['productname']}
                                </div>
                                <div class="btn_container" >
                                    {if $row['status']!=2}
                                    <a href="{$row['delurl']}"><span>删除</span></a>
                                    {/if}
                                    <a href="{$row['lineurl']}"><span>再走一个</span></a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {/loop}
                {else}
                <div class="no-order">
                    <div>
                        <img src="/phone/public/images/wechat/my/refund_pay.png" width="32%">
                    </div>
                    <div>
                        您没有退款的活动
                    </div>
                </div>
                {/if}
            </div>
            <div class="tab-pane" id="goods_list">
                {if !empty($order_list['mall_all'])}
                {loop $order_list['mall_all']  $row}
                <div class="article">
                    <a href="{$row['url']}">
                        <div class="flex-single">
                            <div style="width:38.4%;">
                                <div class="article-img" style="background-image: url(<?php echo Common::img($row['litpic'])?>); "></div>
                            </div>
                            <div style="padding-left:10px;width:61.6%; position:relative;">
                                <div class="article-title">
                                    {$row['productname']}
                                </div>
                                {if $row['usedate']}
                                <div class="article-time">购买时间 {$row['usedate']}</div>
                                {/if}                 
                                <div class="btn_container">
                                <?php  if ($row['status'] == 5){?>
                                    <a href="javascript::void(0)"><span style="border: none;">交易成功</span></a>
                                    <?php  if($row['ispinlun'] == 0) {?>
                                        <a href="{$row['commenturl']}"><span >去评论</span></a>
                                    <?php }?>
                                <?php }else if ($row['status'] == 4){?>
                                    <a href="javascript::void(0)"><span style="border: none;">已退款</span></a>
                                <?php }else if ($row['status'] == 3){?>
                                    <a href="javascript::void(0)"><span style="border: none;">订单已取消</span></a>
                                <?php }else if ($row['status'] == 2){?>
                                    <a href="{$row['refundurl']}"><span >申请退款</span></a>
                                <?php }else if ($row['status'] == 1 || $row['status'] == 0){?>
                                    <a href="{$row['payurl']}"><span >去付款</span></a>
                                    <a href="{$row['cancelurl']}"><span >取消订单</span></a>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {/loop}
                {else}
                <div class="no-order">
                    <div>
                        <img src="/phone/public/images/wechat/my/refund_pay.png" width="32%">
                    </div>
                    <div>
                        您的购物订单空空的，快去买买买
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

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=20" ></script>
<script type="text/javascript" src="/phone/public/js/idangerous.swiper-2.7.0.min.js?v=20"></script>
<script type="text/javascript" src="/phone/public/js/idangerous.swiper.3dflow-2.0.js?v=20"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>
</html>