<!DOCTYPE html>
<html>
<head>
    <title>香港</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap.min.css"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/fontawesome/4.1.0/css/font-awesome.min.css"/> -->
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
<link href="/phone/public/css/wechat/imgvote.css?v=7" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/line.css">
<style type="text/css">
    .top{
        background-image: url('/images/wechat/topic/top_bg.jpg');
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-color: #9B8CE5;
    }
    .topBar{
        width: 100%;
        background-color: rgba(0,0,0,0.1);
    }
    .topBar p{
        color: #fff;
    }
    .user{
        color: #fff;
        padding: 20px;
    }
    .user > .pull-right > .pull-left{
        color: #1e7e4b;
        font-size: 16px;
    }
    .get-num{
        font-size: 54px;
        font-weight: bold;
        line-height: 44px;
        color: #fff;
    }
    .get-num span{
        font-size: 54px;
        font-weight: bold;
        line-height: 44px;
        color: #1e7e4b;
    }
    .activity-money {
        padding: 0px;
    }
    .progress-bar{
        border: 1px solid #fff;
        height: 8px;
        border-radius: 10px;
        width: 70%;
        background-color: transparent;
        position: relative;
        margin-top: 5px;
        margin-left: 13%;
    }
    .progress-bar-num{
        position: absolute;
        width: 20%;
        right: -18px;
        top: 0;
        height: 7px;
        line-height: 7px;
        font-size: 10px;
    }
    .show-title{
        text-align: center;
        color: #1e7e4b;
        padding-right: 15px;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        font-size: 16px;
        height: 131px;
        line-height: 110px;
    }
    /*勋章*/
    .medals{
        background-color: #fff;
    }
    .medals-title{
        padding: 15px 10px 0 10px;
    }
    .medals-title a{
        color: #9B8CE5;
        text-decoration: underline;
    }
    .medals-title i{
        transform:rotate(180deg);
        -ms-transform:rotate(180deg);
        -moz-transform:rotate(180deg);
        -webkit-transform:rotate(180deg);
        -o-transform:rotate(180deg);
    }
    .medal-list{
        padding: 10px 0;
    }
    .medal{
        width: 25%;
        padding: 10px;
    }
    .medal-name{
        font-size: 12px;
    }
    .medal-img{
        position: relative;
    }
    .no-get{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255,255,255,0.7);
    }
    .achieve-show-more{
        width: 100%;
        height: 50px;
        line-height: 50px;
        text-align: center;
        color: #9B8CE5;
        border-top: 1px solid #e5e5e5;
    }
    /*本期推荐*/
    .banners{
        background-color: #fff;
        margin-top: 10px;
        padding: 10px 0;
    }
    .title{
        font-size: 18px;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e5e5;
        position: relative;
        margin: 0 10px;
    }
    .title-desc{
        position: absolute;
        left: 0;
        bottom: -9px;
        width: 100%;
        text-align: center;
    }
    .title-desc span{
        font-size: 12px;
        color: #ccc;
        background-color: #fff;
        padding: 0 10px;
    }
    .swiper-container{
        overflow: hidden;
        margin: 20px 10px 0 10px;
    }
    .banner{
        margin-bottom: 20px;
        position: relative;
    }
    .banner-name{
        position: absolute;
        left: 0;
        bottom: 0;
        color: #fff;
        width: 100%;
        background: -webkit-linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        background: -o-linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        background: -moz-linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        background: linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        padding-top: 30px;
    }
    .banner-name-main{
        margin: 0 0 10px 10px;
        border-left: 4px solid #fff;
        padding-left: 5px;
        font-size: 18px;
        font-weight: bold;
    }
    .banner-desc{
        font-size: 14px;
        font-weight: normal;
        color: rgba(255,254,254,0.6);
    }
    .swiper-container-horizontal > .swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{
        bottom: 0;
    }
    .swiper-pagination-bullet-active{
        background-color: #9B8CE5;
    }
    /*线路样式*/
    .hot-lines, .all-lines, .other-speak{
        background-color: #fff;
        margin-top: 10px;
        padding-top: 10px;
    }
    .footprint{
        position: absolute;
        left: 10px;
        top: 10px;
        color: #fff;
        height: 20px;
        line-height: 16px;
        background-color: rgba(0,0,0,0.3);
        padding: 2px 5px;
        border-radius: 10px;
    }
    .footprint img{
        height: 16px;
        line-height: 20px;
    }
    .line-info-main{
        padding: 10px;
        background: -webkit-linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        background: -o-linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        background: -moz-linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
        background: linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
    }

    .line {
        border: none;
    }

    .line-time{
        color: rgba(255,254,254,0.6);
        font-weight: normal;
    }
    /*tab样式*/
    .tabs{
        border: 1px solid #9B8CE5;
        margin: 20px 10px;
        border-radius: 6px;
        height: 36px;
        overflow: hidden;
    }
    .tab{
        float: left;
        color: #9B8CE5;
        height: 34px;
        line-height: 34px;
        text-align: center;
        border-right: 1px solid #9B8CE5;
    }
    .tab:first-of-type{
        border-right: 0;
    }
    .tab:last-of-type{
        border-right: 0;
    }
    .tab.active{
        background-color: #9B8CE5;
        color: #fff;
    }
    .tab-100{
        width: 100%;
        font-size: 18px;
    }
    .tab-50{
        width: 50%;
        font-size: 18px;
    }
    .tab-33{
        width: 33.3%;
        font-size: 16px;
    }
    .tab-25{
        width: 25%;
        font-size: 14px;
    }
    /*他们说说*/
    .user-comments{
        padding-top: 20px;
    }
    .user-comment{
        padding-bottom: 10px;
        margin: 0 10px 10px 80px;
        border-bottom: 1px solid #e5e5e5;
        position: relative;
    }
    .user-comments a:last-of-type .user-comment{
        border-bottom: 0;
    }
    .status-icon{
        transform:rotate(45deg);
        -ms-transform:rotate(45deg);
        -moz-transform:rotate(45deg);
        -webkit-transform:rotate(45deg);
        -o-transform:rotate(45deg);
        width: 5px;
        height: 5px;
        position: absolute;
        right: 41px;
        bottom: 6px;
        z-index: 99;
    }
    .user-img{
        position: absolute;
        left: -70px;
        top: 0;
    }
    .user-content{
        padding: 8px 0;
    }
    .user-name, .other-info{
        font-size: 12px;
        color: #888;
        height: 20px;
        line-height: 20px;
    }
    .se{ background-color: rgba(138, 138, 138, 1); }
    .su{ background-color: rgba(138, 138, 138, 1); }
    .sf{ background-color: rgba(252, 146, 22, 1); }
    .ss{ background-color: rgba(72, 203, 132, 1); }
    .si{ background-color: rgba(193, 76, 251, 1); }
    /*查看规则*/
    .rules-content{
        padding: 10px;
    }
    .swiper-pagination-bullet-active {
        width: 12px;
        border-radius: 5px;
    }
    .rule{
        padding: 10px;
        background-color: #fff;
        margin-bottom: 10px;
    }
    .rule-title{
        font-size: 18px;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 1px solid #efefef;
    }
    .rule-content{
        padding: 10px;
    }
    .rule-content p {
        line-height: 22px;
        color: #8b8b8b;
    }
    .rule-content strong {
        color: #666;
    }
    .rule-content table {
        margin: 0px;
    }
    /*.rule-content table tr td {
        border: none;
    }*/
    .rule-content table tr td:first-child {
        width: 18%;
    }
    /*.rule-content table tr td {
        width: 25%;
    }*/
    #no-border-table td {
        border: none;
    }
    /*弹窗动画*/
    .move-modal{
        display: none;
        opacity: 0;
    }
    .move-modal-content{
        width: 90%;
        position: fixed;
        top: 24%;
        z-index: 1000;
        text-align: center;
        color: #333;
        /*color: #fff;*/
        background-color: #fff;
        margin: 0 5%;
        border-radius: 6px;
        border-radius: 6px;
        opacity: 0;
    }
    .move-modal-content-top{
        color: #fff;
        background-color: #9B8CE5;
        line-height: 40px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        font-size: 18px;
    }
    .move-modal-content-mian{
        width: 100%;
        padding-top: 20px;
    }
    .move-modal-bg{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 999;
    }
    .last-medal{
        float: left;
        width: 25%;
        font-size: 14px;
        opacity: 0;
        transform:rotateY(180deg);
    }
    .last-medal img{
        opacity: 0.3;
    }
    .last-medal > div:last-of-type{
        /*background-color: rgba(0,0,0,0.5);*/
        margin: 0 5%;
        width: 90%;
        margin-top: 10px;
    }
    .move-btn{
        /*position: fixed;*/
        /*left: 0;*/
        /*bottom: 30%;*/
        width: 100%;
        opacity: 0;
        margin: 20px 0;
    }
    .move-btn button{
        background-color: #9B8CE5;
        color: #fff;
        border: 0;
        margin: 0;
        width: 50%;
        line-height: 34px;
        border-radius: 4px;
    }
    .move-modal-notice{
        padding:20px 10px 0 10px;
        opacity: 0;
    }
</style>
<div class="content">

    <!-- 头部 -->
    <div class="top">
        <div class="topBar" style="display: none">
            <a class="back" href="javascript:history.go(-1);">
                <i class="fa fa-angle-left" style="font-size:18px; color:#fff;"></i>
            </a>
            <a class="home" href="/phone">
                <i class="fa fa-home" style="font-size:18px; color:#fff;"></i>
            </a>
            <p class="text-overflow">香港专区</p>
        </div>
        <div class="line pt-10 pl-10 pr-10">
            <div class="line-img relative">
                    <img class="lazy-img-loading" src="/phone/public/images/hk.png" data-img="/phone/public/images/hk.png" data-type="2" style="width:100%;">
            </div>
            <div style="background: #f5f5f5;padding: 10px;">
                <span style="    font-size: 20px;">玩遍这些才算来过香港！</span>
                <p>坽着大包小包，从铜锣湾一路北上到尖沙咀、旺角血拼仍不过瘾；从旺角的街边美食，从深藏于五星酒店的米其林餐厅；香港，这个神奇的地方，有无数种玩法等你来。</p>

            </div>
        </div>
    </div>

    <!-- 本期推荐 -->

    <div id="pageLoading" class="text-center pt-10">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:12px; margin-bottom:2px;">
        <span>loading</span>
    </div>

    <div class="all-lines">
        <div class="title">
            全部路线
            <div class="title-desc"><span>另一个角度认识香港</span></div>
        </div>
        <div class="list" id="list" style="margin-top: 20px;">

        </div>
    </div>
</div>

</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/v4/jq.lazy_loading_img.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>
<script type="text/javascript">


    $(document).ready(function () {
        // 异步加载图片，实现逐屏加载图片
        $(".scrollLoading").scrollLoading();
    });

    function showRules(){
        window.history.pushState("rules",null,"");
        changeContent();
    }
    function hideRules(){
        window.history.go(-1);
    }
    //监听返回
    $(window).on('popstate', function () {
        changeContent();
    });
    function changeContent(){
        var state = window.history.state;
        if( state == "rules" ){
            $(".content").hide();
            $(".rules").show();
            $("body").css("background-color","#9b8ce5");
        }else{
            $(".rules").hide();
            $(".content").show();
            $("body").removeClass("background-color");
        }
    }

    //切换TAB
    function changeTab( tabNum ){
        $(".tabs .tab").removeClass("active");
        // $(".all-lines .line-list").hide();
        $(".tabs .tab").eq( tabNum ).addClass("active");
        // $(".all-lines .line-list").eq( tabNum ).show();
        lineSwiper.slideTo( tabNum );
    }

    //成就展开更多
    function showMoreMedal( isDown, obj ){
        if( isDown == 1 ){
            $(".hide-medal-list").slideDown();
            $(obj).html('收起更多 <i aria-hidden="true" class="fa fa-angle-up"></i>');
            $(obj).attr("onclick","showMoreMedal(0,this)");
        }else{
            $(".hide-medal-list").slideUp();
            $(obj).html('展开更多 <i aria-hidden="true" class="fa fa-angle-down"></i>');
            $(obj).attr("onclick","showMoreMedal(1,this)");
        }
    }

    // banner滑块

    var hotswiper = new Swiper('#hotLineSwiper', {
        pagination : '.hot-pagination',
        paginationClickable: true,
        autoHeight: true, //enable auto height
        // autoplay: 6000,
        loop: true,
    });

    var lineSwiper = new Swiper('#lineSwiper', {
        pagination : '.line-pagination',
        paginationClickable: true,
        autoHeight: true, //enable auto height
        // autoplay: 6000,
        // loop: true,
        onSlideChangeEnd: function(swiper){
            var activeIndex = swiper.activeIndex;
            // console.log(activeIndex);
            $(".tabs .tab").removeClass("active");
            $(".tabs .tab").eq( activeIndex ).addClass("active");
        },
    });



    /**
     * [initDate 转换时间戳为日期]
     * @Author   xhb
     * @DateTime 2017-03-23
     * @param    {[type]}   strtime [description]
     * @return   {[type]}           [description]
     */
    String.prototype.initDate = function(){
        var obj = new Date( parseInt( this ) * 1000 );
        var Y = obj.getFullYear();
        var M = obj.getMonth() + 1;
        M = M < 10 ? ("0"+M) : M;
        var D = obj.getDate();
        D = D < 10 ? ("0"+D) : D;
        var h = obj.getHours();
        h = h < 10 ? ("0"+h) : h;
        var m = obj.getMinutes();
        m = m < 10 ? ("0"+m) : m;
        var s = obj.getSeconds();
        s = s < 10 ? ("0"+s) : s;
        var w = obj.getDay();
        var result = {};
        result['Y'] = Y.toString();
        result['M'] = M.toString();
        result['D'] = D.toString();
        result['h'] = h.toString();
        result['m'] = m.toString();
        result['s'] = s.toString();
        result['w'] = w.toString();
        return result;
    }

    var weekNames = {'0':'日','1':'一','2':'二','3':'三','4':'四','5':'五','6':'六','7':'日'};

    //获取列表数据
    function getList(){
        $.ajax({
            url: '/phone/line/ajax_line',
            type: 'POST',
            dataType: 'json',
            data: {
                city: '9',
                style: '2',
                ft: 'hk',
                theme_id:3
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $("#pageLoading").hide();
                var addHtml = '';
                if( getdata.list.length > 0 ){
                    $.each(getdata.list, function(index, line) {
                        addHtml += eachHtml( line );
                    });
                }else{
                    addHtml += '<div class="text-center p-10">活动紧张筹备中</div>';
                }
                $("#list").html( addHtml );
                doLazyLoadingImg($(window).scrollTop()); //加载第一屏的图片
            })
            .fail(function() {
                console.log("error");
            });
    }
    getList();

    function eachHtml( data ){
        var addHtml = '';
        addHtml += '<div class="line pt-10 pl-10 pr-10">';
        addHtml +=     '<div class="line-img relative">';
        addHtml +=         '<a href="'+ data['url'] +'">';
        addHtml +=             '<img class="lazy-img-loading" src="" data-img="'+ data['imageurl_s'] +'" data-type="2" style="width:100%;">';
        addHtml +=             '<div class="line-name text-center p-5">'+ data['activity_name'] +'</div>';
        addHtml +=         '</a>';
        addHtml +=     '</div>';
        addHtml +=     '<div class="activitys pt-10">';
        var times = data['times'] == undefined ? [] : data['times'];
        $.each(times, function(tindex, time) {
            if( tindex >= 3 ){
                return false;
            }
            addHtml += getActivityHtml( time );
        });
        addHtml +=     '</div>';
        addHtml +=     '<div class="hide-activitys">';
        var times = data['times'] == undefined ? [] : data['times'];
        $.each(times, function(tindex, time) {
            if( tindex >= 3 ){
                addHtml += getActivityHtml( time );
            }
        });
        addHtml +=     '</div>';
        if( times.length > 3 ){
            addHtml += '<div class="show-more text-center pl-10 pr-10 pb-10" onclick="showMore(this);" show="0">';
            addHtml +=     '<div><span data-length="'+ ( times.length - 3 ) +'">亲~~还有'+ ( times.length - 3 ) +'期活动哦，点击展开</span> <img class="show-more-icon" src="/phone/public/images/wechat/v4/arrow_r_g.png" style="height:12px; margin-bottom:2px;"></div>';
            addHtml += '</div>';
        }
        addHtml += '</div>';
        return addHtml;
    }

    function getActivityHtml( time ){
        var addHtml = '';
        addHtml +=     '<div class="activity pl-10 pr-10 pb-10">';
        addHtml +=         '<a href="'+ time['url'] +'" class="flex-center" style="line-height:30px;">';
        addHtml +=         '<div class="hiker-img text-left">';
        addHtml +=             '<img class="img-circle lazy-img-loading" data-img="'+ time['leader']['headImgUrl'] +'" data-type="2" style="width:40px; height:40px;">';
        addHtml +=         '</div>';
        var startTime = time['starttime_i'].toString().initDate();
        addHtml +=         '<div class="activity-time text-center">'+ startTime['M'] +'月'+ startTime['D'] +'日出发</div>';
        addHtml +=         '<div class="activity-day text-center">'+ time['day_i'] +'天</div>';
        addHtml +=         '<div class="activity-money text-center">￥'+ time['money_f']/100 +'</div>';
        addHtml +=         '<div class="activity-status text-center">';
        addHtml +=             '<div class="'+ time['status']['style'] +'">'+ time['status']['name'] +'</div>';
        addHtml +=         '</div>';
        addHtml +=         '<div class="activity-icon text-right">';
        addHtml +=             '<img src="/phone/public/images/wechat/v4/right2.png" style="height:12px;">';
        addHtml +=         '</div>';
        addHtml +=         '</a>';
        addHtml +=     '</div>';
        return addHtml;
    }

    function showMore( e ){
        var hideObj = $(e).parent().find(".hide-activitys");
        var show = $(e).attr("show");
        if( show == 0 ){
            hideObj.slideDown();
            $(e).attr("show","1");
            $(e).find(".show-more-icon").addClass("back");
            $(e).find("span").html('点击收起');
        }else{
            hideObj.slideUp();
            $(e).attr("show","0");
            $(e).find(".show-more-icon").removeClass("back");
            $(e).find("span").html('亲~~还有'+ $(e).find("span").data('length') +'期活动哦，点击展开');
        }
    }
</script>


</html>