<!DOCTYPE html>
<html>
<head>
    <title>境外精品</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=130">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/line_new.css?v=19">
<style>
    #homeBox {
        width: 35px;
        height: 35px;
        position: fixed;
        z-index: 10;
        bottom: 15px;
        right: 15px;
    }
    #homeA {
        display: inline-block;
        width: 100%;
        height: 100%;
        background-image: url('/phone/public/images/wechat/coin/home.png');
        background-position: center;
        background-size: cover;
    }
    .guizhou-desc{
        background-color: #fff;
        padding: 20px 15px;
        margin-bottom: 15px;
        display: none;
    }
</style>
<div class="content">

    <div id="pageLoading" class="text-center pt-10">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:1.2rem; margin-bottom:0.2rem;">
        <span>loading</span>
    </div>



    <!--  -->

    <div class="list" id="list">

    </div>

    <div id="homeBox">
        <a id="homeA" href="/phone"></a>
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

        var showJsId = "100056";
        var longTouchJsId = "100057";

        var timeOutEvent= 0;
        var team_index_url = "#";
        function showTeamModal(){
            $.ajax({
                url: '/wechat/v4/list/getcompanyqrcode',
                type: 'POST',
                dataType: 'json',
                data: {},
            })
                .done(function(getdata) {
                    console.log(getdata);
                    if( getdata.errcode == 0 ){
                        var show_qrcodes = getdata.data.qrcodes;
                        team_index_url = getdata.data.team_index_url;

                        $("#teamManager").attr("src",show_qrcodes[0]['qrcode']);
                        $(".team-modal").addClass('showing');
                        $(".team-modal").animate({"opacity":1});

                        //长按统计
                        timeOutEvent= 0;
                        $("#teamManager").on('touchstart',function(){
                            timeOutEvent = setTimeout(function(){
                            },500)
                        })
                        $("#teamManager").on('touchmove',function(){
                            clearTimeout(timeOutEvent);
                            timeOutEvent = 0;
                        })
                        $("#teamManager").on('touchend',function(){
                            clearTimeout(timeOutEvent);
                        })
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        }

        function jumpTeamIndex(){
            window.location.href = team_index_url;
        }

        function hideTeamModal(){
            $(".team-modal").animate({"opacity":0},function(){
                $(".team-modal").removeClass('showing');
            })
        }

    </script>

</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
</script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script type="text/javascript">
    function setFontSize(){
        var fontSize = document.documentElement.clientWidth / 37.5; //10px作为1个rem
        if( fontSize > 10 ){
            fontSize = 10;
        }
        document.documentElement.style.fontSize = fontSize + 'px';
    }
    setFontSize();
    $(window).resize(function(){
        setFontSize();
    });
</script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=130" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/v4/jq.lazy_loading_img.js?v=2"></script>
<script type="text/javascript">

    /**
     * [initDate 转换时间戳为日期]
     * @Author   xhb
     * @DateTime 2017-03-23
     * @param    {[type]}   strtime [description]
     * @return   {[type]}           [description]
     */
    String.prototype.initDate = function(){
        var obj = getLocalTime( 8, parseInt( this ) * 1000 );
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

    var prependAtids = false;

    //获取列表数据
    function getList(){
        $.ajax({
            url: '/phone/line/ajax_line',
            type: 'POST',
            dataType: 'json',
            data: {
                distance: '2',
                style: '2',
                city: '0',
                sort_type: '',
                show_invite: 1,
                prependAtids: prependAtids,
                theme_id:2
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $("#pageLoading").hide();
                $(".guizhou-desc").show();
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
        addHtml += '<div class="line">';
        addHtml +=     '<div class="line-img relative">';
        addHtml +=         '<a href="'+ data['url'] +'">';
        addHtml +=             '<img class="lazy-img-loading" src="" data-img="'+ data['imageurl_s'] +'" data-type="2" style="width:100%;">';
        addHtml +=         '</a>';
        addHtml +=     '</div>';
        if( data['highlights'].length >= 3 ){
            addHtml += '<div class="line-highlights flex-single justify-between">';
            $.each(data['highlights'], function(index, highlight) {
                addHtml += '<div class="line-highlight flex-center">';
                addHtml +=     '<img class="line-highlight-img" src="'+ highlight['icon'] +'">';
                addHtml +=     '<div class="line-highlight-desc">'+ highlight['name'] +'</div>';
                addHtml += '</div>';
            });
            addHtml += '</div>';
        }
        addHtml +=     '<div class="line-name flex-center">';
        addHtml +=         '<div class="line-desc">';
        addHtml +=             '<div class="flex-center">'+ data['activity_name'] +'</div>';
        if( data['tips'].length > 0 ){
            addHtml +=         '<div class="line-tips flex-center">';
            $.each(data['tips'], function(index, tip) {
                addHtml +=         '<div class="line-tip flex-start">';
                addHtml +=         '<div class="line-tip-title flex-center">'+ tip['title'] +'</div>';
                addHtml +=         '<div class="line-tip-desc">'+ tip['desc'] +'</div>';
                addHtml +=     '</div>';
            });
            addHtml += '</div>';
        }
        addHtml +=         '</div>';
        addHtml +=     '</div>';
        addHtml +=     '<div class="activitys">';
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
            addHtml += '<div class="show-more flex-center" onclick="showMore(this);" show="0">';
            addHtml +=     '<span data-length="'+ ( times.length - 3 ) +'">亲~~还有'+ ( times.length - 3 ) +'期活动哦，点击展开</span> <img class="show-more-icon" src="/phone/public/images/wechat/v4/arrow_b.png" style="height:0.6rem; padding-left:0.5rem;">';
            addHtml += '</div>';
        }
        addHtml += '</div>';
        return addHtml;
    }

    function getActivityHtml( time ){
        var addHtml = '';
        addHtml +=     '<div class="activity">';
        addHtml +=         '<a href="'+ time['url'] +'" class="flex-div justify-between" style="line-height:3rem;">';
        addHtml +=             '<div class="flex-start">';
        addHtml +=                 '<div class="hiker-img text-left">';
        addHtml +=                     '<img class="img-circle lazy-img-loading" data-img="'+ time['leader']['headImgUrl'] +'" data-type="2" style="width:3.4rem; height:3.4rem;">';
        addHtml +=                 '</div>';
        if( time['show_str'] == undefined ){
            var startTime = time['starttime_i'].toString().initDate();
            addHtml +=                 '<div class="activity-time text-center">'+ startTime['M'] +'月'+ startTime['D'] +'日出发</div>';
            addHtml +=                 '<div style="padding:0 0.5rem;">/</div>';
            addHtml +=                 '<div class="activity-day text-center">'+ time['day_i'] +'天</div>';
            addHtml +=                 '<div class="activity-money text-center">￥'+ time['money_f'] +'</div>';
        }else{
            addHtml +=                 '<div class="activity-time text-center">'+ time['show_str'] +'</div>';
            addHtml +=                 '<div style="padding:0 0.6rem;">/</div>';
            addHtml +=                 '<div class="activity-day text-center">'+ time['show_str2'] +'</div>';
            addHtml +=                 '<div class="activity-money text-center">￥'+ time['money_f'] +'</div>';
        }
        addHtml +=             '</div>';
        addHtml +=             '<div class="flex-end">';
        addHtml +=                 '<div class="activity-status text-center">';
        addHtml +=                     '<div class="'+ time['status']['style'] +'">'+ ( time['status']['name'] == "团队定制" ? "定制活动" : time['status']['name'] ) +'</div>';
        addHtml +=                 '</div>';
        addHtml +=                 '<div class="activity-icon text-right">';
        addHtml +=                     '<img src="/phone/public/images/wechat/v4/right_v3.png" style="height:1rem;">';
        addHtml +=                 '</div>';
        addHtml +=             '</div>';
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

    //得到标准时区的时间的函数
    function getLocalTime( i, times ) {
        //参数i为时区值数字，比如北京为东八区则输进8,西5输入-5
        if (typeof i !== 'number') return;
        var d = new Date( times );
        //得到1970年一月一日到现在的秒数
        var len = d.getTime();
        //本地时间与GMT时间的时间偏移差
        var offset = d.getTimezoneOffset() * 60000;
        //得到现在的格林尼治时间
        var utcTime = len + offset;
        return new Date(utcTime + 3600000 * i);
    }

</script>


</html>