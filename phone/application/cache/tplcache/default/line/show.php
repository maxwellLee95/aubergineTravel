<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>活动详情-<?php echo $GLOBALS['cfg_webname'];?></title>
    <?php if($seoinfo['keyword']) { ?>
    <meta name="keywords" content="<?php echo $seoinfo['keyword'];?>" />
    <?php } ?>
    <?php if($seoinfo['description']) { ?>
    <meta name="description" content="<?php echo $seoinfo['description'];?>" />
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php echo Common::css('wechat/bootstrap.min.css,font-awesome/css/font-awesome.min.css,wechat/style.css,wechat/global.min.css');?>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>
    <?php echo Common::css('public/plugins/Swiper-4.1.0/css/swiper.min.css',false,false);?>
    <?php echo Common::css('wechat/event.css,wechat/grade.css,wechat/v4/activity.css,wechat/pop-layer.css,wechat/v4/flex_box.css');?>
    <?php echo Common::css('public/plugins/jq-image-slider-unlock/jquery.imgsliderunlock.css',false,false);?>
</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<div id="getLoading" style="display: none">
    <div class="get-loading-main">
        <img src="/phone/public/images/wechat/loading2.gif" width="20" height="20">
        <div class="getloading"></div>
    </div>
</div>
<style type="text/css">
    .opacity-show {
        animation: opacityShow 500ms linear forwards;
        -webkit-animation: opacityShow 500ms linear forwards;
    }
    .edit-modal{
        position: fixed;
        left: 0;
        top: 0;
        z-index: 3000;
        width: 100%;
        height: 100%;
    }
    .edit-modal-body {
        position: absolute;
        z-index: 3000;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        height: 100%;
    }
    .edit-modal-body img{
        margin: 0 auto;
        margin-top: 119px;
        display: block;
        color: #ffffff;
    }
</style>
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
    @keyframes showGoldCoinAnt2
    {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @-webkit-keyframes showGoldCoinAnt2
    {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes showGoldCoinAnt
    {
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
    @-webkit-keyframes showGoldCoinAnt
    {
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
    @keyframes hideGoldCoinAnt
    {
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
    @-webkit-keyframes hideGoldCoinAnt
    {
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
    @keyframes showGoldNumAnt
    {
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
    @-webkit-keyframes showGoldNumAnt
    {
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
<style type="text/css">
    #mstar li img{
        max-width: inherit;
    }
    .activity-tab{
        width: 25%;
    }
    .coin-show{
        background-color: #fff;
        color: #fda934;
        margin-bottom: 20px;
        display: block;
    }
    .coin{
        padding: 10px 0;
    }
    .coin .flex-start{
        border-left: 5px solid #fda934;
        padding: 2px 15px;
    }
    .self-help {
        color: rgba(252, 146, 22, 0.9);
    }
    .self-help.checked {
        border-color: rgba(252, 146, 22, 0.9);
    }
    .activity-infos{
        padding: 10px 0 0 0;
    }
    .activity-infos > div{
        padding: 0 10px;
    }
    .activity-discount {
        padding: 10px !important;
    }
    .activity-infos .activity-timelimit{
        padding: 10px 0;
        border-top: 1px solid #ddd;
    }
    .activity-timelimit-money{
        padding-left: 10px;
        color: #ff6666;
    }
    .activity-timelimit-money span{
        font-size: 20px;
        font-weight: bold;
    }
    .activity-timelimit-time{
        color: #fff;
        background: -webkit-linear-gradient(left, #ff6078, #ff9090);
        background: linear-gradient(to right, #ff6078, #ff9090);
        padding: 0 15px;
        line-height: 20px;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }
    .timelimit-each{
        color: #ff6b73;
        background-color: #fff;
        margin: 0 2px;
        border-radius: 2px;
        width: 13px;
    }
    .activity-infos .activity-cut-price{
        border-top: 10px solid #F0F0F0;
        padding: 10px;
    }
    .activity-cut-price img{
        padding-right: 10px;
    }
    .activity-cut-price span{
        color: #ff6666;
    }
    .activity-cut-price-btn{
        color: #35c87b;
    }
    .activity-cut-price-btn i{
        padding-left: 4px;
    }
    .qrcode-line-close{
        height: 100px;
        background: #000;
        opacity: 0.5;
    }
    .qrcode-close{
        height: 40px;
        background: #000;
        opacity: 0.5;
    }
    .qrcode-close .close{
        opacity: 1;
    }
    .share-text{
        position: absolute;
        color: #ffffff;
        font-size: 26px;
        transform: rotate(-18deg);
        -ms-transform: rotate(-18deg);
        -webkit-transform: rotate(-18deg);
        -o-transform: rotate(-18deg);
        -moz-transform: rotate(-18deg);
        top: 70px;
        right: 111px;
        font-weight: bold;
    }
    #select-map{
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        height: 29px;
        padding: 0;
        font-size: 12px;
    }
</style>
<div class="content">
    <!-- banner -->
    <div class="activity-img">
        <a href="#">
            <img class="activity-banner" src="<?php echo $info['litpic'];?>" style="width:100%;">
            <div class="activity-name"><?php echo $info['title'];?></div>
        </a>
    </div>
    <!-- 活动信息 -->
    <div class="activity-infos">
        <div class="activity-leader-info">
            <div class="pull-left" style="position:relative;">
                <a href="#">
                    <img class="img-circle" src="<?php echo Common::member_pic($info['leader']['litpic']);?>" style="width:50px; height:50px;">
                    <img src="/phone/public/images/wx/v4/list/leader_star_<?php echo $info['leader']['star'];?>.png" class="leader-level">
                </a>
            </div>
            <div class="pull-left" style="padding:5px 10px;">
                <div>
                    <div class="activity-leader"><?php echo $info['leader']['nickname'];?></div>
                    <div  class="activity-score"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="activity-info">
            <div>难度:&nbsp;<span><?php echo Common::difficulty_desc($info['difficultylevel']);?></span>&nbsp;&nbsp;<span><?php if($info['jifenbook']) { ?>+<?php echo $info['jifenbook'];?>学分<?php } ?>
</span></div>
        </div>
        <div class="activity-info" style="padding-bottom:10px; height:34px;">
            <div class="pull-left">
                <p>
                    <span style="    color: #333;">集合点：</span>
                    <select id="select-map" >
                        <?php $n=1; if(is_array($info['marshal_point_list'])) { foreach($info['marshal_point_list'] as $row) { ?>
                            <option value="<?php echo $row['id'];?>" data-longitude="<?php echo $row['longitude'];?>" data-latitude="<?php echo $row['latitude'];?>"><?php echo $row['name'];?></option>
                        <?php $n++;}unset($n); } ?>
                    </select>
                </p>
            </div>
            <div class="pull-right">
                <?php if(!empty($info['price'])) { ?>
                <div><div class="activity-money"><?php echo Currency_Tool::symbol();?><?php echo $info['price'];?></div></div>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php if($GLOBALS['cfg_open_baidumap'] && $info['marshal_point_list']['0']) { ?>
        <div class="map">
        <iframe id="baidumap" style="border: none" src="/phone/pub/baidumap?longitude=<?php echo $info['marshal_point_list']['0']['longitude'];?>&latitude=<?php echo $info['marshal_point_list']['0']['latitude'];?>" width="350px" height="225px" ></iframe>
        </div>
        <?php } ?>
    </div>
    <!-- 出发时间 -->
    <div class="activity-each" style="padding-bottom:0;">
        <div class="each-title">
            出发时间
            <div class="pull-right" style="color:#9B8CE5;" onclick="showqrCode();">我要定制 <i class="fa fa-angle-right"></i></div>
        </div>
        <div class="activity-list" style="min-height:85px;">
            <div class="show-others-loading text-center" style="height:85px; line-height:85px;">加载中...</div>
            <div class="time-list-swiper">
            </div>
            <div class="time-activity-list" style="margin:10px 0 0 0;">
                <div class="time-activity-list-main">
                    <div class="swiper-container time-activitys-swiper active" data-index="0" data-initial="1">
                        <div class="swiper-wrapper">
                            <?php if(!empty($activitys)) { ?>
                            <?php $n=1; if(is_array($activitys)) { foreach($activitys as $row) { ?>
                            <div class="swiper-slide" data-index="" data-month="">
                                <a href="<?php echo Common::_detail_url($info['aid'],$row['suitid'],$row['day']);?>">
                                    <div class="other-activity">
                                        <div class="other-activity-main <?php if($row['day']==$info['day'] && $row['suitid']==$info['suitid']) { ?> checked <?php } ?>
">
                                            <div class="other-activity-content">
                                                <div class="other-activity-time">
                                                    <span><?php echo date('m月d',$row['day']);?></span>
                                                    <span style="padding-left:5px;"><?php echo Common::date_text_week($row['day']);?></span>
                                                </div>
                                                <div class="other-activity-status">
                                                                <span style="    background-color: rgba(53,179,112,0.05);" class="<?php echo $row['status']['style'];?>"><?php echo $row['status']['name'];?> | 剩<?php echo $row['number'];?>名额</span>
                                                </div>
                                                <?php if($row['day']==$info['day'] && $row['suitid']==$info['suitid']) { ?>
                                                <div class="checked-square"></div>
                                                <div class="checked-icon">
                                                    <img src="/phone/public/images/wechat/v4/correct_s.png" style="height:6px;">
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="right-lian">
                                            <div class="left-circle <?php if($row['day']==$info['day'] && $row['suitid']==$info['suitid']) { ?> checked <?php } ?>
"></div>
                                            <div class="right-circle <?php if($row['day']==$info['day'] && $row['suitid']==$info['suitid']) { ?> checked <?php } ?>
"></div>
                                            <div class="left-center-bg"></div>
                                            <div class="right-center-bg"></div>
                                            <div class="small-left-circle"></div>
                                            <div class="small-right-circle"></div>
                                            <div class="left-center-line"></div>
                                            <div class="right-center-line"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php $n++;}unset($n); } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 已参加的人 -->
    <div class="activity-each">
        <a class="each-title" href="/phone/line/line_suit_tourer?aid=<?php echo $info['id'];?>&suitid=<?php echo $info['suitid'];?>&day=<?php echo $info['day'];?>">
            <div class="pull-left">
                已参加的人
                ( <span style="color:#9B8CE5;"><?php echo $info['min_person_count'];?> </span>人成行 )
            </div>
            <div class="pull-right">
                总共<span style="color:#9B8CE5;"><?php echo $info['sell_numm']?></span>/<?php echo $info['person_count'];?>人&nbsp;<img src="/phone/public/images/wechat/v4/right_h.png" style="height:10px; margin-bottom:2px;">
            </div>
            <div class="clear"></div>
        </a>
        <div class="join-hikers" style="height: 85px;overflow: hidden;">
            <?php if(!empty($leaders)) { ?>
            <?php $n=1; if(is_array($leaders)) { foreach($leaders as $row) { ?>
            <div class="join-hiker">
                <a href="#">
                    <div class="hiker-img">
                        <div style="position:relative; display:inline-block;">
                            <div style="position:relative; display:inline-block; overflow:hidden; border-radius:50%;">
                                <img class="img-circle" src="<?php echo Common::member_pic($row['litpic']);?>" style="width:50px; height:50px;">
                            </div>
                            <img src="/phone/public/images/wx/v4/list/leader_star_<?php echo $row['star'];?>.png" class="leader-level">
                        </div>
                    </div>
                    <div class="hiker-name" style="color:red;font-size: 14px;" ><?php echo $row['nickname'];?></div>
                </a>
            </div>
            <?php $n++;}unset($n); } ?>
            <?php } ?>
            <?php if(!empty($info['suit_tourer'])) { ?>
            <?php $n=1; if(is_array($info['suit_tourer'])) { foreach($info['suit_tourer'] as $row) { ?>
            <div class="join-hiker">
                <a href="#">
                    <div class="hiker-img">
                        <div style="position:relative; display:inline-block;">
                            <div style="position:relative; display:inline-block; overflow:hidden; border-radius:50%;">
                                <img class="img-circle" src="<?php echo Common::member_pic($row['litpic']);?>" style="width:50px; height:50px;">
                                <?php if($row['dingnum']>1) { ?>
                                    <div class="join-num">
                                        <div><?php echo $row['dingnum'];?>人</div>
                                    </div>
                                <?php } ?>
                            </div>
                            <span style="position: absolute;right: -7px;top: 0;width: 16px;" class="icon_css <?php if($row['sex']=='男') { ?>icon_man<?php } ?>
<?php if($row['sex']=='女') { ?>icon_woman<?php } ?>
"></span>
                        </div>
                    </div>
                    <div class="hiker-name" style="font-size: 14px;" ><?php echo $row['nickname'];?></div>
                </a>
            </div>
            <?php $n++;}unset($n); } ?>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>
    <!-- 详情TAB -->
    <div id="activityTabs" class="activity-tabs">
        <div class="activity-tab active" onclick="changeTab(0);">
            <span>活动详情</span>
        </div>
        <div class="activity-tab" onclick="changeTab(1);">
            <span>行程与准备</span>
        </div>
        <div class="activity-tab" onclick="changeTab(2);">
            <span>费用说明</span>
        </div>
        <div class="activity-tab" onclick="changeTab(3);">
            <span>评价<span class="evaluation-num" style="display: none">2052</span></span>
        </div>
        <div class="clear"></div>
    </div>
    <div class="activity-tabs fixed">
        <div class="activity-tab active" onclick="changeTab(0);">
            <span>活动详情</span>
        </div>
        <div class="activity-tab" onclick="changeTab(1);">
            <span>行程与准备</span>
        </div>
        <div class="activity-tab" onclick="changeTab(2);">
            <span>费用说明</span>
        </div>
        <div class="activity-tab" onclick="changeTab(3);">
            <span>评价<span class="evaluation-num" style="display: none;">2052</span></span>
        </div>
        <div class="clear"></div>
    </div>
    <!-- 详情内容 -->
    <div id="description" class="tab-content active">
        <div class="content-content">
            <?php echo $info['features'];?>
        </div>
    </div>
    <div class="tab-content">
        <!-- 详细行程 -->
        <div class="trip-content">
            <?php echo $info['jieshao'];?>
            <div class="content-title">详细行程（共<?php echo $info['lineday'];?>天）</div>
            <?php if(preg_match('/^\d+$/',$info['id']) && $info['isstyle']==2) { ?>
            <?php $n=1; if(is_array(Model_Line_Jieshao::detail($info['id'],$info['lineday']))) { foreach(Model_Line_Jieshao::detail($info['id'],$info['lineday']) as $v) { ?>
            <div class="one-day-trip">
                <div class="day-title">第<?php echo $v['day'];?>天 </div>
                <div class="one-day-content">
                    <?php echo $v['jieshao'];?>
                </div>
                <?php if($info['showrepast']==1) { ?>
                <div class="trip-other">
                    <div class="trip-other-title">
                        <img src="/phone/public/images/wechat/v4/food_icon.png" style="height:18px; margin-bottom:2px;">
                        <span>用餐：</span>
                    </div>
                    <div class="trip-other-desc">
                        <?php if(breakfirsthas) { ?>
                        <span class="tc">早餐：<?php echo $v['breakfirst'];?></span>；
                        <?php } ?>
                        <?php if(lunchhas) { ?>
                        <span class="tc">中餐：<?php echo $v['lunch'];?></span>；
                        <?php } ?>
                        <?php if(supperhas) { ?>
                        <span class="tc">晚餐：<?php echo $v['supper'];?></span>；
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <div class="trip-other">
                    <div class="trip-other-title">
                        <img src="/phone/public/images/wechat/v4/traffic_icon.png" style="height:18px; margin-bottom:2px;">
                        <span>住宿：</span>
                    </div>
                    <div class="trip-other-desc">
                        <?php echo $v['hotel'];?>
                    </div>
                </div>
                <div class="trip-other">
                    <div class="trip-other-title">
                        <img src="/phone/public/images/wechat/v4/traffic_icon.png" style="height:18px; margin-bottom:2px;">
                        <span>交通：</span>
                    </div>
                    <div class="trip-other-desc">
                        <?php $n=1; if(is_array(explode(',',$v['transport']))) { foreach(explode(',',$v['transport']) as $t) { ?>
                        <span class="gj"><?php echo $t;?></span>
                        <?php $n++;}unset($n); } ?>
                    </div>
                </div>
            </div>
            <?php $n++;}unset($n); } ?>
            <?php } else if($info['isstyle']==1) { ?>
            <?php echo $info['jieshao'];?>
            <?php } ?>
        </div>
        <!-- 活动准备 -->
        <div class="ready-content">
            <div class="content-title">活动准备</div>
            <div class="content-content signup-desc">
                <?php echo $info['reserved1'];?>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="content-content money-desc">
            <?php echo $info['feeinclude'];?>
        </div>
    </div>
    <div class="tab-content">
        <div class="comment-main" style="background-color:#fff; padding:10px 10px 0;">
            <div class="comment-list">
                <div class="flex-center comment-loading">
                    <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
                </div>
            </div>
            <!-- 精彩回顾 -->
            <div class="review-list"></div>
        </div>
        <!-- 推荐游记 -->
        <div class="articles-list"></div>
        <!-- 主题数据 -->
        <a class="ugc-show" href="#">
            <div class="flex-div justify-between article" style="margin-bottom: 0px;" >
                <div class="flex-start">
                    <span class="new">NEW</span>
                    <span style="padding-left:5px;">茄子户外运动 • 游记</span>
                </div>
                <div style="padding-right: 5px;">去看看&nbsp;<i class="fa fa-angle-right"></i></div>
            </div>
        </a>
    </div>
    <!-- 相关推荐 -->
    <div class="recommend-list"></div>
    <!-- 顶部按钮 -->
    <div class="bottom-btns">
        <div class="bottom-btn">
            <a href="/phone">
                <div class="text-center"><img class="center-block" src="/phone/public/images/wechat/v4/home_a.png" style="height:25px;"></div>
                <div class="btn-name" style="color:#f88834;">更多活动</div>
            </a>
        </div>
        <div id="consult" class="bottom-btn group">
            <a onclick="getWechatGroupQcodePre( 0 )">
                <div class="text-center"><img class="center-block" src="/phone/public/images/wechat/v4/icon_group.png" style="height:25px;"></div>
                <div class="btn-name">进群</div>
            </a>
        </div>
        <div  class="bottom-btn group">
            <a onclick="weChatCircle()">
                <div class="text-center"><img class="center-block" src="/phone/public/images/wechat/v4/icon_dispatch.png" style="height:25px;"></div>
                <div class="btn-name">分销</div>
            </a>
        </div>
        <div style="width: 20%" class="bottom-btn group">
            <a >
                <div class="text-center"><img class="center-block" src="/phone/public/images/wechat/v4/icon_sign.png" style="height:25px;"></div>
                <div class="btn-name">邀好友报名</div>
            </a>
        </div>
        <div id="buy" class="bottom-btn join" style="width:30%;<?php if(!$info['signUpBtnStatus']) { ?>background-color: #ccc;<?php } ?>
">
            <!-- 判断是否可以显示倒计时 -->
            <a id="showSurplusTime" onclick="javascript:void(0);" style="display:none;">
                <div class="surplus-time-desc">距离活动开抢还有</div>
                <div id="canSignupSurplusTime"></div>
            </a>
            <input id="sign-up-tips" type="hidden" value="<?php echo $info['signUpTips'];?>">
            <?php if($info['signUpBtnStatus']) { ?>
                <a id="showSignupBtn" href="<?php echo $info['bookUrl'];?>" ><?php echo $info['signUpBtnText'];?></a>
            <?php } else { ?>
                <a id="disableSignUpBtn" href="javascript::void(0)" ><?php echo $info['signUpBtnText'];?></a>
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--hiding-->
<div id="editModal" class="edit-modal" style="display: none">
    <div class="edit-modal-body">
        <img style="position: absolute;right: 38px;top: -110px;" src="/phone/public/images/wx/v4/list/share_arrow.png" >
        <img style=" margin-top: 170px;" src="/phone/public/images/wx/v4/list/icon_share.png" >
        <span class="share-text" >点击箭头进行分享</span>
    </div>
</div>
<!-- 进群二维码 -->
<div id="consultmore" class="modal in" style="display: none;">
    <div class="modal-header">
    </div>
    <div class="modal-body">
        <div id="slider-unlock-div">
        </div>
        <div class="mbox" id="wechatGroupQrcodeBox">
            <div class="fl" style="line-height: 140px; margin-left: 40px;height: 140px " >
            </div>
            <div class="fl llogo" >
                <div>
                    <div id="my-logo" style="width: 140px;">
                        <img id="wechatGroupQrcodeImg" src="<?php echo Common::img($info['qrcode']) ?>" style="float: left; width: 140px; height: 140px;background-position: center;background-repeat: no-repeat;background-size: 30%;" />
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="clr"></div>
            <div style="margin-top: 5px;">
                <span class="grey">
                                                                        欢迎长按二维码<br><?php echo $info['qrcode_text'];?></span>
            </div>
            <div class="clr"></div>
            <div class="consult-notice">
                这是公开接受咨询的活动群，无法逐一审核，小伙伴请谨慎对待陌生群友的好友请求。
            </div>
        </div>
    </div>
    <div></div>
    <div class="qrcode-line-close">
        <div style="    width: 3px;
    background: #ffffff;
    height: 100%;
    margin: 0 auto;"></div>
    </div>
    <div class="qrcode-close">
        <a class="close" data-dismiss="modal" style="margin-right: 45.5%;">
            <img  src="/phone/public/images/wechat/close.png" style="width: 32px;height: 32px;    margin-top: -3px;" />
        </a>
    </div>
</div>
<!-- 关注弹窗 -->
<div id="subscriptme" class="modal in" style="display: none;">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">
            <img src="/phone/public/images/wechat/close.png" class="small-image" />
        </a>
    </div>
    <div class="modal-body" >
        <div class="mbox" >
            <div class="fl" style="line-height: 140px; margin-left: 40px; " >
            </div>
            <div class="fl llogo" >
                <div>
                    <div id="my-logo" style="width: 140px;" >
                        <img src="#" />
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="clr"></div>
            <div style="margin-top: 5px;">
                <img src="/phone/public/images/wx/fllow_txt.png" style="width: 84px;">
            </div>
        </div>
    </div>
</div>
<div id="terms_model" class="modal in" style="display:none;background: #fff; margin:20px;" aria-hidden="true" >
    <div class="modal-header">
        <h5 class="text-center"><strong>【户外旅行活动免责声明及安全警示】</strong></h5>
    </div>
    <div class="modal-body" aria-hidden="true" >
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="ti_2">
                        户外旅行活动具有一定的危险并且这些危险性无法完全预知，在参加此类活动时，应注意人身安全和财物安全，并对由此产生的后果、责任和义务应有充分的考虑。
                    </li>
                    <li>
                        请认真阅读本免责声明及安全警示。
                    </li>
                    <li>
                        <div class="fl l">一． </div>
                        <div class="fl r">本免责声明适用于茄子户外运动(包括但不限于微信公众号)上发布的所有户外活动。 每位活动参与者已经提前充分了解活动的线路行程及面临的风险，了解、掌握了面临可能发生的危险时应该采取的减轻和避免伤害的措施。 已经充分了解活动过程中可能面临的风险，包括但不限于交通工具带来的危险，疾病带来的危险，第三人带来的危险，动物带来的危险等山野户外活动带来的危险等。</div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">二． </div>
                        <div class="fl r">茄子户外运动将为每个参与活动的队员强制购买保险，对于活动中可能出现的意外事故，由保险公司进行理赔，茄子户外运动及领队进行协助处理不承担具体责任。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">三．</div>
                        <div class="fl r">茄子户外运动将尽可能考虑每次活动的安全性，采取以下的适当安全防护措施：
                            <ol>
                                <li>茄子户外运动会严格审核每个行程的整体安全系数，及该领队对该行程的必需经历</li>
                                <li>清楚告知用户每次行程的难度及强度，帮助用户理解该行程对体力的要求</li>
                                <li>清楚告知用户每次行程需要准备的装备,饮食及其它物料，提醒用户做好充分的准备</li>
                                <li>提醒用户根据行程需要携带必要医用药品，如感冒,创伤,腹泻,中暑等药品</li>
                                <li>发布行程的领队都经过安全防护及救护知识培训，并经茄子户外运动考核通过</li>
                                <li>领队会在行程中根据实际情况进行必要的调整，如果活动中遇到任何不可抗力（如自然灾害等）
                                    或危及队员的生命财产安全的情形，领队有权更改线路或者立刻取消活动以确保每个队员的安全。</li>
                            </ol>
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">四．</div>
                        <div class="fl r">凡户外旅行活动参加者均必须为或被法律法规视为具有完全民事行为能力人，如在活动中发生意外事故或人身损害，如果不年满18岁，应在监护人携带下参与活动，若监护人携带未成年人参加茄子户外运动的户外活动，表明监护人已评估户外运动的风险，且同意对于户外活动中发生的意外事故或人身损害，茄子户外运动及领队均不承担赔偿责任。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">五．</div>
                        <div class="fl r">茄子户外运动发布的活动均属于自愿参加、风险自担、责任自负，参与者均应为完全行为能力人，茄子户外运动不对任何个人或机构承担民事赔偿责任或补充民事赔偿责任。并不担保或提供任何参加人的人身和财产的安全保障。茄子户外运动的组织和发起户外活动之行为，在任何情况下不构成违反对设施设备未尽安全保障义务，不构成违反服务管理未尽安全保障义务，不构成违反防范制止侵权行为未尽安全保障义务，也不构成对未成年人、无民事行为能力人、限制民事行为能力人未尽安全保障义务。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">六．</div>
                        <div class="fl r">凡户外旅行活动参加者必须根据行程情况评估自身身体及意志是否可适应，如果身体有疾病的，比如心脏病、哮喘病、恐高症等不适合从事户外运动的疾病，请不要报名参加此活动，隐瞒自己身体疾病，所引发的任何事故由参加者自己负责。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">七．</div>
                        <div class="fl r">凡户外旅行活动参加者在参与活动过程中应按照领队安排进行，不擅自离队，不擅自更改行程，有突发情况需要调整行程的，应跟领队商量并取得认可再行动。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">八．</div>
                        <div class="fl r">户外旅行活动属于自愿出行活动，当由于意外事故，突发气候变化和急性疾病等不可预测因素造成身体损害时，团队的发起者和同行者有义务尽力救助，但如果造成了不可逆转的损害，团队的其他成员不负担任何责任。本活动的参与人员都应本着：“尽力救助，风险自担”的原则参加这次活动，活动发起者和组织者亦不承担任何法律和经济责任。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">九．</div>
                        <div class="fl r">在车辆本身安全以及车辆驾驶人员竭尽安全驾驶义务仍不能避免车辆毁损、人员伤亡事故时，按照国家有关法律规定承担各自责任，团队内部成员在诉诸法律之前，应进行充分的友好协商。活动过程中遇到危险，相信团队中其他所有成员均会尽力救助，但即使如此仍不能完全避免伤害的产生时，声明人不向其他成员主张任何赔偿责任，除非该伤害是由于其他成员的故意所导致。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">十．</div>
                        <div class="fl r">如在活动过程中恶意侵犯他人或其它涉及犯罪行为，则不在此免责范围内，必须承担相应的法律责任。
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li>
                        <div class="fl l">十一．</div>
                        <div class="fl r">
                            【户外旅行活动安全警示】
                            <ol>
                                <li>出行前要认真收看、查看当日的天气预报，遇到天气不佳时考虑是否继续参加活动。</li>
                                <li>出行前做好充分的身体和心理准备，并准备好活动必需的装备和其它物资。</li>
                                <li>出行前及行程中不宜过量饮酒，尤其是驾车的朋友应忌酒，以免发生意外。</li>
                                <li>出行前将行程情况告知家人或朋友，并告知领队的联系方式</li>
                                <li>行程中所有成员应彼此相互照顾、相互帮助，相互分享。</li>
                                <li>登山、徒步、露营、自驾、游泳等具有一定危险性，请自带相应防护设施。</li>
                                <li>遇到雷雨、台风、雪崩、山体滑坡等不可抗天气或自然阻碍，请您据情躲避，以防不测。</li>
                                <li>同行互动参与者要互相尊重，互相帮助，遇到事端要有谦让精神，避免矛盾发生。</li>
                                <li>参加户外旅行活动时，请勿擅自脱离队伍，如身体不适，及时与领队联系。</li>
                                <li>请尊重户外旅行目的地的风俗与规矩，与当地人和谐共处，不挑事不闹事。</li>
                            </ol>
                        </div>
                        <div class="clr"></div>
                    </li>
                    <li class="ti_2">
                        该免责声明目的是为活动发起人组织者和同行者再次明确户外活动的风险，提高自律能力和抗风险能力，免除一些不必要的后果，让户外活动更安全更快乐。
                    </li>
                    <li class="ti_2">
                        凡报名参加茄子户外运动户外旅行活动的朋友，均视为已仔细阅读过【户外旅行活动免责声明及安全警示】，并且已经接受了本免责声明，对户外活动的风险已经有了认知及评估，自愿承担相应风险。
                    </li>
                    <li>
                        <div class="row" style="margin-top:15px 0 5px 0;">
                            <div id="termsBtns" class="text-center">
                                <a id="confirmTermsBtn" class="btn btn-default btn-success center-block" data-dismiss="modal" role="button">确认</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style type="text/css" media="screen">
    .team-modal{
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10;
        width: 100%;
        height: 100%;
    }
    .team-modal.showing{
        display: flex;
    }
    .team-modal-body{
        width: 80%;
        background-color: #fff;
        text-align: center;
        padding: 40px 0 60px 0;
        border-radius: 6px;
        position: relative;
        margin-top: -50px;
    }
    .team-modal-bg{
        background-color: rgba(0,0,0,0.3);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .team-modal-close{
        position: absolute;
        left: 50%;
        bottom: -60px;
        width: 36px;
        height: 36px;
        margin-left: -18px;
        background-image: url("/phone/public/images/wechat/close_w.png");
        background-repeat: no-repeat;
        background-size: 100%;
    }
    .team-title{
        font-size: 15px;
    }
    .team-img{
        padding-top: 30px;
    }
    #teamManager{
        box-shadow: 0 0 10px #ddd;
    }
    .team-img-desc{
        font-size: 12px;
        color: #666;
        padding-top: 10px;
    }
</style>
<div class="team-modal flex-center">
    <div class="team-modal-bg" onclick="hideTeamModal();"></div>
    <div class="team-modal-body">
        <div class="team-title">本活动为定制活动，不对外开放</div>
        <div class="team-title">如有定制需求，可联系</div>
        <div class="team-img">
            <img id="teamManager" src="" width="45%">
        </div>
        <div class="team-img-desc">长按二维码，添加策划师</div>
        <div class="team-modal-close" onclick="hideTeamModal();"></div>
    </div>
</div>
<script type="text/javascript">
    var showJsId = "100058";
    var longTouchJsId = "100059";
    var timeOutEvent= 0;
    var team_index_url = "/phone/customize";
    function jumpTeamIndex(){
        window.location.href = team_index_url;
    }
    function hideTeamModal(){
        $(".team-modal").animate({"opacity":0},function(){
            $(".team-modal").removeClass('showing');
        })
    }
</script>
</body>
<?php echo Common::js('public/plugins/jQuery/jQuery-2.1.3.min.js',false,false);?>
<?php echo Common::js('bootstrap.min.js');?>
<script type="text/javascript"  src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
    wx.config({
        debug: false,
        appId: '<?php echo $jssdk["appId"];?>',
        timestamp: <?php echo $jssdk["timestamp"];?>,
        nonceStr: '<?php echo $jssdk["nonceStr"];?>',
        signature: '<?php echo $jssdk["signature"];?>',
        jsApiList: [
            "showMenuItems", "hideMenuItems", "closeWindow", "previewImage", "openCard", "onMenuShareTimeline", "onMenuShareAppMessage", "chooseImage", "uploadImage"
        ]
    });
    wx.ready(function () {
        wx.onMenuShareTimeline({
            debug: false,
            link: '<?php echo $info["share_url"]; ?>',
            title: '<?php echo $info["title"]; ?>', // 分享标题
            imgUrl: '<?php echo $info["litpic"]; ?>', // 分享图标
            desc:'<?php echo $info["share_desc"]; ?>',
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                // alert("timeline cancel");
            }
        });
        wx.onMenuShareAppMessage({
            debug: false,
            link: '<?php echo $info["share_url"]; ?>',
            title: '<?php echo $info["title"]; ?>', // 分享标题
            imgUrl: '<?php echo $info["litpic"]; ?>', // 分享图标
            desc:'<?php echo $info["share_desc"]; ?>',
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                // alert("timeline cancel");
            }
        });
    });
</script>
<?php echo Common::js('public/plugins/Swiper-4.1.0/js/swiper.min.js',false,false);?>
<?php echo Common::js('jquery.scrollLoading.js,wechat/pop-layer.js');?>
<?php echo Common::js('public/plugins/jq-image-slider-unlock/jquery.imgsliderunlock.js',false,false);?>
<?php echo Common::js('timeInterval.js');?>
<script type="text/javascript">
    $("select#select-map").change(function(){
        var longitude=$("select#select-map").find("option:selected").data('longitude');
        var latitude=$("select#select-map").find("option:selected").data('latitude');
        var baidu_url='/phone/pub/baidumap?longitude='+longitude+'&latitude='+latitude
        $("#baidumap").attr('src',baidu_url)
    });
    var shareTitle = "<?php echo $info['title']?>",
        shareLink = '#',
        shareImgUrl = "<?php echo $info['litpic']?>",
        shareDesc =  "<?php echo $info['title']?>",
        initialSlide = "<?php echo $info['initialSlide'] ?>",
        activityType = "<?php echo $info['id']?>",
        nowPage = 1,
        pageSize = 10,
        showIsUserActivity = false,
        aid = 27207,
        hikerId = 690587,
        oprUrl = "#",
        oprStr = "立即报名",
        isShowSurplusTime = false,
        dicountTimeLimit = false,
        activityMoney = "138",
        activityLineName = "<?php echo $info['title']?>",
        activityLineId = "<?php echo $info['id']?>",
        smallImageUrl = "<?php echo $info['litpic']?>",
        unlockimg = './images/wechat/unlock_tip.png',
        atid = "<?php echo $info['id']?>",
        img_com = ".",
        url_prefix = "/phone/public/",
        isVip = false,
        fromPreview = '',
        erweima = '',
        show_qrcodes = <?php echo json_encode($activitys)?>,
        team_index_url = "/phone/customize",
        isShowSignupSurplusTime = false,
        listActivitysInitialSlide = "0",
        customize_qrcode = "<?php echo $customize_qrcode;?>";
    var nextActivityHtml = '';
    nextActivityHtml += '<br>';
    nextActivityHtml += '<a href="#">';
    nextActivityHtml +=     '<div class="grey">下一期活动，点击查看：</div>';
    nextActivityHtml += '</a>';
    nextActivityHtml += '<div style="padding: 5px 0;">';
    nextActivityHtml +=     '<a href="#">';
    nextActivityHtml +=         '<div class="fl imgl">';
    nextActivityHtml +=             '<img class="img-responsive" src="/phone/public/upload/test/1169417ea03c0926e24d4eb89b25b7e1.jpg"/>';
    nextActivityHtml +=         '</div>';
    nextActivityHtml +=         '<div class="fl actd">';
    nextActivityHtml +=             '<div>【户外美食专列】登高明茶山，品柴火鸡</div>';
    nextActivityHtml +=             '<div>&nbsp&nbsp8月25日 出发</div>';
    nextActivityHtml +=             '<div>&nbsp&nbsp剩余名额：18个</div>';
    nextActivityHtml +=         '</div>';
    nextActivityHtml +=         '<div class="clr"></div>';
    nextActivityHtml +=     '</a>';
    nextActivityHtml += '</div>';
    var lineListUrlHtml = '';
    function getWechatGroupQcodePre(type) {
        if (type > 0) {
            pop_type = type;
            popLayer({
                title: '本次活动为团队定制活动',
                btnsName: '返回;确认',
                btnsCallback: 'closePopLayer();getWechatGroupQcode()',
                content: '<div class="invitationCode"><div class="code-input"><input type="text" placeholder="请输入活动邀请码" id="invitationCode"></div></div><div id="show-error"></div>',
            });
        } else {
            pop_type = 0;
            closePopLayer();
            slider.hideElm();
            $('#wechatGroupQrcodeBox').show();
            $('#consultmore').modal('show');
            // showSliderUnlock();
        }
    }
    $("#editModal").click(function(){
        $("#editModal").hide();
    });
    function weChatCircle() {
        $("#editModal").show();
    }
    /**
     * [signUpWithInvitationCode 邀请码报名]
     * @Author   XieShaoLi
     */
    function signUpWithInvitationCode() {
        pop_type = 2;
        popLayer({
            title: '本次活动为团队定制活动',
            btnsName: '返回;确认',
            btnsCallback: 'closePopLayer();submitCode()',
            content: '<div class="invitationCode"><div class="code-input"><input type="text" placeholder="请输入活动邀请码" id="invitationCode"></div></div><div id="show-error"></div>',
        });
    }
    $(".activity-timelimit-time").each(function(index, el) {
        var endTime = $(this).data("endTime");
        $(this).setTimeInterval({
            stopTime: endTime, //结束时间,2016/07/28 19:00:00
            showType: 2,
            //倒计时结束后的回调函数
            eachCallBack: function( times, element, minTime ){
                var html = getTimeHtml( times );
                $(element).html( html );
            },
            overTimeCallBack: function( element ){
                $(element).remove();
            }
        });
    });
    function getTimeHtml( times ){
        if( times.day > 0 ){
            times.hour += times.day * 24;
        }
        times.hour = times.hour.toString();
        times.minute = times.minute.toString();
        times.second = times.second.toString();
        if( times.hour < 10 ){
            times.hour = '0' + times.hour;
        }
        if( times.minute < 10 ){
            times.minute = '0' + times.minute;
        }
        if( times.second < 10 ){
            times.second = '0' + times.second;
        }
        var html = '离结束：';
        for(i=0;i<times.hour.length;i++){
            html += '<span class="timelimit-each flex-center">'+ times.hour.charAt(i) +'</span>';
        }
        html += ':';
        for(i=0;i<times.minute.length;i++){
            html += '<span class="timelimit-each flex-center">'+ times.minute.charAt(i) +'</span>';
        }
        html += ':';
        for(i=0;i<times.second.length;i++){
            html += '<span class="timelimit-each flex-center">'+ times.second.charAt(i) +'</span>';
        }
        return html;
    }
    $("#disableSignUpBtn").click(function(){
        alert($("#sign-up-tips").val());
        return false;
    });
</script>
<?php echo Common::js('wechat/v4/activity.js');?>
</html>