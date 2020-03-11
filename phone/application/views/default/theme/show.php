<!DOCTYPE html>
<html>
<head>
    <title>茄子户外运动·主题活动</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/icon.css?v=10">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css?v=7">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=17">
<link rel="stylesheet" type="text/css" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/phone/public/css/ugc/article.css?v=2">
<link rel="stylesheet" type="text/css" href="/phone/public/css/nav.css"/>
<style type="text/css">
    #loading{
        background-color: rgba(0,0,0,0.5);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        z-index: 10000;
        height: 100%;
        display: none;
    }
    .loading {
        height: auto;
        line-height: 1.1;
        padding-left: 5px;
        padding-right: 5px;
        background-position: center 15px;
        background-size: 35px;
        padding-top: 60px;
        padding-bottom: 15px;
        left: 50%;
        width: auto;
        max-width: 80%;
        min-width: 122px;
    }
    .loading-div{
        position: fixed;
        top: 44%;
        left: 50%;
        background-color: rgba(0,0,0,0.8);
        padding: 5px 10px;
        border-radius: 5px;
    }
    .loading-middle{
        text-align: center;
    }
    .loading-msg{
        padding-left: 5px;
        color: #fff;
    }
    #pop-layer {
        z-index: 900;
    }
    .back-top {
        z-index: 100;
    }
    #subusModal {
        z-index: 9999;
    }
    div.uploadImgBox {
        font-size: 0;
        word-spacing: -4;
    }
    a.uploadImgBtn {
        display: inline-block;
        width: 24px;
        height: 34px;
        background-image: url('/phone/public/images/wechat/vi.png');
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: center;
        opacity: 0.5;
    }
    #showUploadImageBox {
        cursor: pointer;
        position: relative;
        width: 30%;
        padding-top: 0;
        margin-left: 16px;
        height: 0;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        -webkit-transition: padding-top 200ms linear;
        -o-transition: padding-top 200ms linear;
        transition: padding-top 200ms linear;
    }
    #showUploadImageBox>a.clearUploadImgA {
        display: none;
        position: absolute;
        width: 20px;
        height: 20px;
        top: 0;
        right: 0;
        border-bottom-left-radius: 4px;
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        text-align: center;
        line-height: 24px;
    }
    #showUploadImageBox[data-hasimg="1"]>a.clearUploadImgA {
        display: block;
    }
    .check_btn_tip {
        width: 40px;
        height: 40px;
        line-height: 40px;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        text-align: center;
        border-radius: 50%;
    }
    /* #check_recomment ,
    #check_del ,
    #check_subject ,
    #check_hide , */
    #check_recomment.check_option ,
    .check_option ,
    #checkMeunBtn {
        display: inline-block;
        position: fixed;
        top: auto;
        bottom: 100px;
        right: 10px;
        z-index: 800;
        background-color: rgba(0, 0, 0, 0.8);
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 0;
        word-spacing: -4;
        border-radius: 50%;
        padding: 12px 10px;
    }
    /*#check_recomment ,
    #check_del ,
    #check_subject ,
    #check_hide ,*/
    #check_recomment.check_option ,
    .check_option {
        z-index: 790;
        padding: 0;
        opacity: 0;
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        -webkit-transition: all 200ms linear;
        -ms-transition: all 200ms linear;
        -o-transition: all 200ms linear;
        transition: all 200ms linear;
        background-color: rgba(0, 0, 0, 0);
    }
    #checkMeunOption {
        display: inline;
    }
    .meunLine {
        position: absolute;
        display: block;
        width: 20px;
        height: 2px;
        background-color: #fff;
        line-height: 10px;
        -webkit-transform: rotate(0);
        -ms-transform: rotate(0);
        -o-transform: rotate(0);
        transform: rotate(0);
        -webkit-transition: all 200ms linear;
        -ms-transition: all 200ms linear;
        -o-transition: all 200ms linear;
        transition: all 200ms linear;
        left: 50%;
        margin-left: -10px;
    }
    .meunLine:nth-child(1) {
        top: 12px;
    }
    .meunLine:nth-child(2) {
        opacity: 1;
        top: 19px;
    }
    .meunLine:nth-child(3) {
        top: 26px;
    }
    #checkMeunBtn.activeMeun > .meunLine:nth-child(1) {
        top: 19px;
        /*width: 24px;*/
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    #checkMeunBtn.activeMeun > .meunLine:nth-child(2) {
        opacity: 0;
    }
    #checkMeunBtn.activeMeun > .meunLine:nth-child(3) {
        top: 19px;
        /*width: 24px;*/
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(1) {
        opacity: 1;
        -webkit-transform: translate(-70px, 0);
        -ms-transform: translate(-70px, 0);
        -o-transform: translate(-70px, 0);
        transform: translate(-70px, 0);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(2) ,
    #checkMeunOption.activeMeun > .check_option:nth-child(3) ,
    #checkMeunOption.activeMeun > .check_option:nth-child(4) ,
    #checkMeunOption.activeMeun > .check_option:nth-child(5) {
        opacity: 1;
        -webkit-transform-origin: 50%;
        -moz-transform-origin: 50%;
        -ms-transform-origin: 50%;
        -o-transform-origin: 50%;
        transform-origin: 50%;
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(2) {
        -webkit-transform: rotate(45deg) translate(-70px, 0);
        -ms-transform: rotate(45deg) translate(-70px, 0);
        -o-transform: rotate(45deg) translate(-70px, 0);
        transform: rotate(45deg) translate(-70px, 0);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(2) > .check_btn_tip {
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(3) {
        -webkit-transform: rotate(-45deg) translate(-70px, 0);
        -ms-transform: rotate(-45deg) translate(-70px, 0);
        -o-transform: rotate(-45deg) translate(-70px, 0);
        transform: rotate(-45deg) translate(-70px, 0);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(3) > .check_btn_tip {
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(4) {
        -webkit-transform: rotate(90deg) translate(-70px, 0);
        -ms-transform: rotate(90deg) translate(-70px, 0);
        -o-transform: rotate(90deg) translate(-70px, 0);
        transform: rotate(90deg) translate(-70px, 0);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(4) > .check_btn_tip {
        -webkit-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(5) {
        -webkit-transform: rotate(-90deg) translate(-70px, 0);
        -ms-transform: rotate(-90deg) translate(-70px, 0);
        -o-transform: rotate(-90deg) translate(-70px, 0);
        transform: rotate(-90deg) translate(-70px, 0);
    }
    #checkMeunOption.activeMeun > .check_option:nth-child(5) > .check_btn_tip {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .subjectA ,
    .subjectA:visited {
        color: #2b99ff;
    }
    #pop-layer-title{
        padding: 0;
    }
    #pop-layer-close button{
        position: relative;
        width: 20px;
        height: 20px;
    }
    #pop-layer-close button:before{
        position: absolute;
        content: 'X';
        top: 0;
        left: 0;
        width: 20px;
        height: 20px;
        color: #333;
        border-radius: 50%;
        border: 1px solid #333;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
    }
    #pop-layer-close button img{
        display: none;
    }
    #check_subject_push_lbl {
        padding: 10px 0 0;
        margin: 0;
    }
    #check_subject_push_cbx {
        margin: 0;
        vertical-align: middle;
    }
    #check_subject_push_box {
        display: none;
    }
    .commentImg {
        width: 30%;
        padding-top: 30%;
        border: 1px solid #f0f0f0;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }


    .audio-wrapper {
        /*background-color: #fcfcfc;*/
        /*margin: 10px auto;*/
        /*max-width: 670px;*/
        width: 100%;
        height: 70%;
        /*border: 1px solid #e0e0e0;*/
        overflow:hidden;
        padding-right: 6%;
    }

    .audio-left {
        float: left;
        /*text-align: center;*/
        width: 16%;
        height: 100%;
    }

    .audio-left .audio-player-img {
        width: 40px;
        height: 40px;
        margin: 0;
        display: initial;   /* 解除与app的样式冲突 */
        cursor: pointer;
        background-color: #fff;
        background-image: url('/phone/public/images/ugc/player.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size:100% 100%;
    }

    .audio-right {
        /*margin-right: 2%;*/
        float: right;
        width: 81%;
        height: 100%;
    }

    .audio-right p {
        font-size: 15px;
        height: 35%;
        margin: 8px 0;

        /* 歌曲名称只显示在一行，超出部分显示为省略号 */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 243px;   /* 要适配小屏幕手机，所以最大宽度先设小一点，后面js根据屏幕大小重新设置 */
    }

    .progress-bar-bg {
        width: 100%;
        background-color: #e8e8e8;
        position: relative;
        height: 4px;
        cursor: pointer;
        border-radius: 4px;
        /*overflow-x:hidden;*/
    }

    .progress-bar2 {
        background-color: #0ccaa6;
        width: 0;
        height: 4px;
        border-radius: 4px;
    }

    .progress-bar-bg .progressDot {
        content: " ";
        width: 15px;
        height: 15px;
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        background-color: #fff;
        position: absolute;
        left: 0;
        top: 0;
        margin-top: -5px;
        margin-left: -10px;
        cursor: pointer;
        border:1px solid #bff0e7;
    }

    .progress-bar-bg .audio-time {
        position: absolute;
        right: 0;
        bottom: 5px;
        color: #d8d1d1;
        font-size: 12px;
    }

    .audio-length-total {
        float: right;
        font-size: 12px;
    }

    .audio-length-current {
        float: left;
        font-size: 12px;
    }
    .audio-top-left{
        width: 16%;
        height: 100%;
        font-size:14px;
    }
    .audio-item{
        height: 81px;
        background-color: #fff;
    }
    .recommendTypeLbl {
        font-weight: normal;
        margin-top: 5px;
        margin-bottom: 15px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .recommendTypeRdo {
        margin-right: 5px !important;
    }
</style>

<div class="content-body">

    <div class="content">

        <div class="content-main">

            <!-- 游记信息 -->
            <div class="article-info">
                <div class="article-title">{$info['ztname']}</div>
                <div class="article-author flex-div">
                    <div class="flex-div" style="width:100%;">
                        <div class="flex-start" style="width:70%; overflow:hidden;">
                            <a href="#">
                                <div style="padding-left:10px;">
                                    <div class="flex-div" style="color:#999;">
                                        <div class="flex-start">
                                            <img src="/phone/public/images/wechat/article/time.png" style="height:12px;">
                                            <div style="padding-left:5px;">
                                                {date('Y-m-d',$info['addtime'])}                                                                                            </div>
                                        </div>
                                        <div  class="flex-start" style="padding-left:15px;display: none">
                                            <img src="/phone/public/images/wechat/article/read_h2.png" style="height:10px;">
                                            <div id="readNum" style="padding-left:5px;">{$info['shownum']}阅读</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="items-desc" id='items-desc'>
                {$info['jieshao']}
            </div>
        </div>
    </div>

</div>

</div>
{request "pub/code"}
{request "pub/footer"}
<div class="back-top" onclick="backTop();">
    <img src="/phone/public/images/wechat/v4/back_top.png" style="height:40px;">
</div>

<style type="text/css">
    #subusModal {
        background: #fff;
        margin: 70px 20px 20px 20px;
        bottom: auto;
        border-radius: 5px;
    }
    .mbox {
        text-align: center;
        padding: 10px 0;
    }
    .modal-header {
        border: 0;
        padding: 10px;
        height: 40px;
    }
    .modal-body {
        padding: 0 10px 5px;
    }
    .close {
        -webkit-opacity: 1;
        -moz-opacity: 1;
        -ms-opacity: 1;
        -o-opacity: 1;
        opacity: 1;
    }
</style>
<div id="subusModal" class="modal in" style="display: none;">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">
            <div class="icon_css icon_close" style="margin:0 3px 3px 0;"></div>
            <!-- <img src="/images/wechat/close.png" class="small-image" /> -->
        </a>
    </div>
    <div class="modal-body" >
        <div class="mbox" >
            <div class="fl" style="line-height: 140px; margin-left: 40px; " >
                <div class="icon_css icon_sao"></div>
                <!-- <img src="/images/wechat/sao.png" style="width: 24px; height: 24px;" /> -->
            </div>
            <div class="fl llogo" >
                <div>
                    <div id="my-logo" style="width: 140px;" >
                        <img src="" style="float: left; width: 140px; height: 140px;" />
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="clr"></div>
            <div style="margin-top: 5px;">
                <span class="grey">长按识别二维码<br/>关注茄子户外运动</span>
            </div>
        </div>
    </div>
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>
<script type="text/javascript" src="/phone/public/js/wechat/cookie.js?v=2" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.each($('audio'), function(index, val) {
            var audio = val;
            if(audio != null){
                var duration;
                audio.load();
                audio.oncanplay = function () {
                    minute = Math.floor(audio.duration/60);
                    second = Math.floor(audio.duration%60);
                    if (minute >= 0 && minute <= 9) {
                        minute = '0'+minute;
                    };
                    if (second >= 0 && second <= 9) {
                        second = '0'+second;
                    };
                    $(val).siblings('.audio-wrapper').find('.audio-time').html(minute+':'+second);
                }
            }
        });
    });
    function loadingMsg(msg, hidebg, time) {
        if (msg == undefined) {
            msg = 'loadingMsg error: msg undefined';
            hidebg = true;
            time = 1000;
        }
        $('.loading').html(msg);
        $('#loading').css('display', 'block');
        if (hidebg == true) {
            $('.loading').css({
                backgroundSize: 0,
                paddingTop: '15px',
            });
        } else {
            $('.loading').css({
                backgroundSize: '35px',
                paddingTop: '60px',
            });
        }
        lelem = document.querySelector('.loading');
        console.log(lelem);
        var w = (lelem.currentStyle ? lelem.currentStyle : window.getComputedStyle(lelem, null)).width;
        w = parseFloat(w);
        $('.loading').css('marginLeft', '-' + w / 2 + 'px');
        if (!isNaN(time)) {
            hideLoading(time);
        }
        setTimeout(function() {
            w = (lelem.currentStyle ? lelem.currentStyle : window.getComputedStyle(lelem, null)).width;
            w = parseFloat(w);
            $('.loading').css('marginLeft', '-' + w / 2 + 'px');
        });
    }
    function hideLoading(time) {
        setTimeout(function() {
            $('#loading').hide();
        }, time);
    }
    $('.audio-left ').children('.audio-player-img').click(function(event) {
        var audio = $(this).parent('div').parent('div').siblings('audio')[0];
        if (audio.paused) {
            // 开始播放当前点击的音频
            audio.play();
            $(this).css('backgroundImage', 'url(/phone/public/public/images/ugc/travel_pause.png)');
            // $('#progressBarBg').css('cursor', 'pointer');
        } else {
            audio.pause();
            $(this).css('backgroundImage', 'url(/phone/public/public/images/ugc/player.png)');
            // $('#progressBarBg').css('cursor', 'default');
        }
        event.stopPropagation();
    });
    // var allAudio = $('audio');
    $.each($('audio'), function(index, val) {
        $('audio')[index].addEventListener('timeupdate', function () {
            updateProgress($(this)[0]);
        }, false);
    });


    /**
     * 更新进度条与当前播放时间
     * @param {object} audio - audio对象
     */
    function updateProgress(audio) {
        var value = audio.currentTime / audio.duration;
        var progressBar = $(audio).siblings('.audio-wrapper').children('.audio-right').children('.progressBarBg').children('.progressBar');
        // console.log($(audio).siblings('.audio-wrapper'));
        var progressDot = $(audio).siblings('.audio-wrapper').children('.audio-right').children('.progressBarBg').children('.progressDot');
        progressBar.css('width', value * 100 + '%');
        progressDot.css('left', value * 100 + '%');
    }


    // 监听播放完成事件
    $.each($('audio'), function(index, val) {
        $('audio')[index].addEventListener('ended', function () {
            audioEnded($(this)[0]);
        }, false);
    });


    /**
     * 播放完成时把进度调回开始的位置
     */
    function audioEnded(audio) {
        var progressBar = $(audio).siblings('.audio-wrapper').children('.audio-right').children('.progressBarBg').children('.progressBar');
        // console.log($(audio).siblings('.audio-wrapper'));
        var progressDot = $(audio).siblings('.audio-wrapper').children('.audio-right').children('.progressBarBg').children('.progressDot');
        $(audio).siblings('.audio-wrapper').children('.audio-left').children('.audio-player-img').css('backgroundImage', 'url(/phone/public/public/images/ugc/player.png)');
        progressBar.css('width', 0);
        progressDot.css('left', 0);
        // $('.audioPlayer').attr('src', 'image/play.png');
    }



    $('.progressDot').on('touchstart ', function(event) {
        event.preventDefault();
        var touch = event.originalEvent.changedTouches[0];
        console.log(touch);
        var audio = $(this).parent('div').parent('div').parent('div').siblings('audio')[0];
        // console.log(audio);
        // if (!audio.paused || audio.currentTime != 0) {
        var oriLeft = $(this)[0].offsetLeft;
        var mouseX = touch.clientX;
        var maxLeft = oriLeft; // 向左最大可拖动距离
        var maxRight = $(this).parent('.progressBarBg')[0].offsetWidth - oriLeft; // 向右最大可拖动距离

        // 禁止默认的选中事件（避免鼠标拖拽进度点的时候选中文字）
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        // 禁止事件冒泡
        if (event && event.stopPropagation) {
            event.stopPropagation();
        } else {
            window.event.cancelBubble = true;
        }

        // 开始拖动
        $(this).parent('.progressBarBg').parent('.audio-right').parent('.audio-wrapper').on('touchmove', function(e) {
            var touch = e.originalEvent.changedTouches[0];
            var length = touch.clientX - mouseX;
            if (length > maxRight) {
                length = maxRight;
            } else if (length < -maxLeft) {
                length = -maxLeft;
            }
            var pgsWidth = $('.progress-bar-bg').width();
            var rate = (oriLeft + length) / pgsWidth;
            audio.currentTime = audio.duration * rate;
            updateProgress(audio);
        });
        $(this).parent('.progressBarBg').parent('.audio-right').parent('.audio-wrapper').on('touchend', function(e) {
            $(this).touchmove = null;
            $(this).touchend  = null;
        });
    });
    // 鼠标拖动进度点时可以调节进度
    // 只有音乐开始播放后才可以调节，已经播放过但暂停了的也可以
    // 鼠标按下时
    // $('.progressDot').mousedown(function(e) {


    //     // 拖动结束
    //     document.onmouseup = function () {
    //         document.onmousemove = null;
    //         document.onmouseup = null;
    //     };
    // }

    // });

    // 点击进度条跳到指定点播放
    $('.progressBarBg').on('click', function (e) {
        // 只有音乐开始播放后才可以调节，已经播放过但暂停了的也可以
        var audio = $(this).parent('div').parent('div').siblings('audio')[0];
        // console.log(audio.currentTime);
        // if (!audio.paused || audio.currentTime != 0) {
        var pgsWidth = $('.progress-bar-bg').width();
        var rate = e.offsetX / pgsWidth;
        audio.currentTime = audio.duration * rate;
        updateProgress(audio);
        // }
    });
    $(".item-img img").each(function(index, el) {
        var width = $(window).width() - 40;
        var realWidth = $(this).data("width");
        var realHeight = $(this).data("height");
        if( realWidth > 0 && realHeight > 0 ){
            $(this).css("height", width * realHeight / realWidth );
        }
    });

    //预加载盖章PNG图片组
    for( var i=1; i<=35; i++ ){
        var animateReload = new Image();
        var src = '/phone/public/image/ugc/animate4/animate_'+ i +'.png';
        animateReload.src = src;
    }

    var myAuto = document.getElementById('bg-music-elem');
    var agreePlayMyAuto = false;


    function pauseMyAuto(){
        stop = 1;
        stopScrollSongName();
        myAuto.pause();
        $('.play-elem-btn img').attr('src', '/images/ugc/play.png?v=2');
    }

    if ($('.msg-elem').length > 0) {
        $('.msg-elem')[0].style.width = ($('.music-item-n').width() - 80) + 'px';
    }

    function makeExpandingArea(el) {
        var setStyle = function(el) {
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
            // console.log(el.scrollHeight);
        };
        var delayedResize = function(el) {
            window.setTimeout(function() {
                    setStyle(el);
                },
                0);
        };
        if (el.addEventListener) {
            el.addEventListener('input',function() {
                setStyle(el);
            },false);
            setStyle(el);
        } else if (el.attachEvent) {
            el.attachEvent('onpropertychange',function() {
                setStyle(el);
            });
            setStyle(el);
        }
        if (window.VBArray && window.addEventListener) { //IE9
            el.attachEvent("onkeydown",function() {
                var key = window.event.keyCode;
                if (key == 8 || key == 46) delayedResize(el);

            });
            el.attachEvent("oncut",function() {
                delayedResize(el);
            }); //处理粘贴
        }
    }
    $(".textarea-desc").each(function(index, el) {
        makeExpandingArea( this );
    });

    // 预览大图
    var imageUrls = [];
    var imgs = $("#items-desc").find("img").each(function () {
        var url = $(this).attr("data-url");

        if (url == undefined) {
            url = $(this).attr("src");
        }

        if (url != undefined) {
            imageUrls.push(url);
        }
    });

    $("#items-desc img").click(function(){
        var url = $(this).attr("data-url");
        if (url == undefined) {
            url = $(this).attr("src");
        }

        wx.previewImage({
            current: url,
            urls: imageUrls
        });
    });

    var firstCommentsCount = "<?php echo $comment_num?>";
    var isView = false;
    var article_id = "<?php echo $info['id'] ?>";
    var article_type = "1";
    var openId = "";
    var editUrl = "#";
    var page = "1"; //当前显示的评论页数
    var noComments = false; //是否可ajax获取评论，是则不能再执行获取
    var articleHikerId = "<?php echo $info['memberid']?>";
    var articleHikerName = "<?php echo $info['nickname']?>";
    var readerHeadImgUrl = "<?php echo Common::member_pic($info['avatar'])?>";
    var isAddAppreciate = false;

    function jumpUgcIndex(){
        window.location.href = '#';
    }

    function jumpVoteUrl(){
        window.location.href = "#";
    }

    //
    // var blurtime = undefined;
    // $("#replyContent").blur(function(event) {
    //     clearTimeout(blurtime);
    //     blurtime = setTimeout(function() {
    //         hiddenReply();
    //         $('.footerTwoDiv').show();
    //         $('.footerSendDiv').hide();
    //         $('.footerReplyDiv').css('width', '70%');
    //     }, 500);

    // });

    // $("#replyContent").focus(function(event) {
    //         //         //     clearTimeout(blurtime);
    //     $('.footerTwoDiv').hide();
    //     $('.footerSendDiv').show();
    //     $('.footerReplyDiv').css('width', '80%');
    //         // });

    var user_subscribe = '1';

    function jumpComment(){
        $(".content").scrollTop( $(".content").scrollTop() + $(".comments").offset().top );
    }

    var isJumpComment = false; //是否跳转评论区
    function stopScrollSongName() {
        $('.song-name').stop(true, true);
        $('.song-name-2').stop(true, true);
        $('.song-name').css('left', 0);
        $('.song-name-2').css('left', -500);
    }
    stop = 0;
    function scrollSongName() {
        if (stop == 1) {
            stopScrollSongName();
            return;
        }
        var w = $('.song-name-h').width();
        var zw = $('.msg-elem').width();
        $('.song-name').stop(true, true).animate({
                'left' : -(w - zw / 2)
            },
            w * 20, 'linear', function() {
                if (stop == 1) {
                    stopScrollSongName();
                    return;
                }
                $('.song-name').stop(true, true).animate({
                        'left' : -w
                    },
                    (w - (w - zw / 2)) * 20, 'linear', function() {
                        $('.song-name').css('left', zw);
                    }
                );
                $('.song-name-2').css('left', zw).stop(true, true).animate({
                        'left' : -(w - zw / 2)
                    },
                    w * 20, 'linear', function() {
                        if (stop == 1) {
                            stopScrollSongName();
                            return;
                        }
                        $('.song-name-2').stop(true, true).animate({
                                'left' : -w
                            },
                            (w - (w - zw / 2)) * 20, 'linear', function() {
                                $('.song-name').css('left', zw);
                            }
                        );
                        scrollSongName();
                    }
                );
            }
        );
    }
    // ios audio播放触发
    function audioPlay() {
        if( myAuto ){
            var play = function() {
                document.removeEventListener("touchstart", play, false);
                myAuto.play();
                myAuto.pause();
            };
            myAuto.play();
            myAuto.pause();
            document.addEventListener("touchstart", play, false);
        }
    }
    audioPlay();

    var thisTopItemId = -2; //当前阅读位置
    var articleId = "2883";

    //计算印记出现的随机位置，top随机，left递增范围随机
    var markWidth = 40; //设定mark的宽度为40
    var notRotateMarks = []; //特殊印记，不允许旋转
    var commentLastMarks = {};
    function adjustMarksPosition( startIndex, length ){
        if( startIndex == undefined ){
            startIndex = 0;
            length = 10;
        }
        var adjustNum = 0;
        $(".comment").each(function(index, el) {
            if( adjustNum > length ){
                return false;
            }
            if( index < startIndex ){
                return true;
            }
            var commentId = $(this).data("id");
            var startLeft = RandomNumBoth( 0, markWidth/2 ); //随机left初始范围
            var addLeft = 0; //递增left
            var imgH = parseFloat($(this).find(".commentImg").height()) * parseFloat($(this).find(".comment-main").width());
            if (isNaN(imgH)) {
                imgH = 0;
            }
            var commentHeight = parseFloat($(this).find(".comment-main").height()) - imgH;
            var commentLastMark = false;
            if( $(this).find(".mark").length > 0 ){
                $(this).find(".mark").each(function(index, el) {
                    var id = parseInt( $(this).data("id") );
                    var markTop = RandomNumBoth( -12, commentHeight - markWidth/2 ); //随机top，允许向上-12，向下透一半
                    var markLeft = startLeft + addLeft;
                    //若最大宽度超过手机屏宽，则重新从左开始
                    if( markLeft > ( $(window).width() - 20 ) * 0.85 + 10 ){
                        markLeft = RandomNumBoth( 0, markWidth/2 ); //随机left初始范围
                        addLeft = 0;
                    }
                    addLeft += RandomNumBoth( markWidth/2, markWidth*1.5 ); //随机递增，最少为mark宽度的一半，最多为mark宽度的1.5倍
                    var markRotate = 0;
                    //不是特殊印记才随机旋转角度
                    if( $.inArray(id, notRotateMarks) == -1 ){
                        markRotate = RandomNumBoth( -60, 60 ); //随机旋转角度
                    }
                    $(this).attr('style','top:'+ markTop +'px; left:'+ markLeft +'px; transform:rotate('+ markRotate +'deg); -webkit-transform:rotate('+ markRotate +'deg);');
                    // console.log("top："+markTop+"；left："+markLeft+"；rotate："+markRotate);
                    commentLastMark = {"top":markTop,"left":markLeft,"rotate":markRotate,"addLeft":addLeft};
                });
            }
            commentLastMarks[ commentId ] = commentLastMark;
            adjustNum++;
            // console.log('----------------');
        });
        console.log(commentLastMarks);
        $(".marks").show();
        $(".marks").animate({"opacity":"1"});
    }
    adjustMarksPosition();

    function RandomNumBoth(Min,Max){
        var Range = Max - Min;
        var Rand = Math.random();
        var num = Min + Math.round(Rand * Range); //四舍五入
        return num;
    }

    var swiperModal = new Swiper("#markList",{
        width : 60,
        spaceBetween: 0,
    });

    var device = 1; //机型判断
    var wxoid = "";
    var isM = true;
    var myIndexUrl = '';

    var lookTop = $(window).height();
    $(document).ready(function () {
        $(".content").scroll(function () {
            //显示返回顶部
            if( $(".content").scrollTop() >= lookTop ){
                $(".back-top").show();
            }else{
                $(".back-top").hide();
            }
        });
    });

    function backTop(){
        $(".content").scrollTop(0);
    }

    //调整评论弹窗高度
    var replyContentHeight = $(window).height() * 0.4 - 20;
    var replyHeight = replyContentHeight + 20 + 50;
    $("#replyContent").css("min-height",replyContentHeight+"px");
    $(".reply-modal-body").css("top",(-replyHeight)+"px");

    var commentsCount = 48;

    //加载视频监听事件
    window.addEventListener("load", initVideoEvent);
    function initVideoEvent() {
        var videoes = document.getElementsByTagName("video");
        for (var i = 0; i < videoes.length; i++) {
            setVideoEvent( videoes[i] );
        }
    }
    function setVideoEvent( Media ) {
        //播放监听
        videoAddEvent = function(e){
            Media.addEventListener(e, function() {
                pauseMyAuto(); //暂停音乐
            });
        }
        // videoAddEvent("loadstart"); //客户端开始请求数据
        // videoAddEvent("progress"); //客户端正在请求数据
        // videoAddEvent("suspend"); //延迟下载
        // videoAddEvent("abort"); //客户端主动终止下载（不是因为错误引起），
        // videoAddEvent("error"); //请求数据时遇到错误
        // videoAddEvent("stalled"); //网速失速
        videoAddEvent("play"); //play()和autoplay开始播放时触发
        // videoAddEvent("pause"); //pause()触发
        // videoAddEvent("loadedmetadata"); //成功获取资源长度
        // videoAddEvent("loadeddata"); //
        // videoAddEvent("waiting"); //等待数据，并非错误
        // videoAddEvent("playing"); //开始回放
        // videoAddEvent("canplay"); //可以播放，但中途可能因为加载而暂停
        // videoAddEvent("canplaythrough"); //可以播放，歌曲全部加载完毕
        // videoAddEvent("seeking"); //寻找中
        // videoAddEvent("seeked"); //寻找完毕
        // videoAddEvent("timeupdate"); //播放时间改变
        // videoAddEvent("ended"); //播放结束
        // videoAddEvent("ratechange"); //播放速率改变
        // videoAddEvent("durationchange"); //资源长度改变
        // videoAddEvent("volumechange"); //音量改变
    }

    /**
     * [uploadImgFun 选择照片]
     * @Author   XieShaoLi
     * @DateTime 2017-09-20
     */
    function uploadImgFun() {
        wx.ready(function() {
            wx.chooseImage({
                count: 1,
                success: function(res) {
                    var localIds = res.localIds;
                    // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    if (localIds.length == 1) {
                        loadingMsg('正在上传...');
                        setTimeout(function() {
                            wx.uploadImage({
                                localId: localIds[0],
                                isShowProgressTips: 0,
                                success: function(res) {
                                    $.ajax({
                                        type: "post",
                                        data: {
                                            serverId: res.serverId
                                        },
                                        url: "/wechat/leader/uploadImage",
                                        dataType: "json",
                                        success: function(ret) {
                                            if (ret.errcode == 0) {
                                                successUploadImg(ret);
                                            } else {
                                                hideLoading(0);
                                                popLayer({
                                                    title: '温馨提示',
                                                    btnsName: '确定',
                                                    btnsCallback: 'closePopLayer()',
                                                    content: ret.errmsg,
                                                });
                                            }
                                        },
                                        error: function(ret) {
                                            hideLoading(0);
                                            popLayer({
                                                title: '温馨提示',
                                                btnsName: '确定',
                                                btnsCallback: 'closePopLayer()',
                                                content: '上传图片失败。errcode:2',
                                            });
                                        }
                                    });
                                },
                                error: function(res) {
                                    hideLoading(0);
                                    popLayer({
                                        title: '温馨提示',
                                        btnsName: '确定',
                                        btnsCallback: 'closePopLayer()',
                                        content: '上传图片失败:' + JSON.stringify(res),
                                    });
                                }
                            });
                        }, 100);
                    } else {
                        popLayer({
                            title: '温馨提示',
                            btnsName: '确定',
                            btnsCallback: 'closePopLayer()',
                            content: '上传图片数量超过限制',
                        });
                    }
                },
                fail: function(res) {
                    // console.log(res);
                    popLayer({
                        title: '温馨提示',
                        btnsName: '确定',
                        btnsCallback: 'closePopLayer()',
                        content: '选择图片错误:' + JSON.stringify(res),
                    });
                }
            });
        });
    }

    /**
     * [successUploadImg 成功上传图片]
     * @Author   XieShaoLi
     * @DateTime 2017-09-20
     */
    function successUploadImg(imgJson) {
        hideLoading(0);
        // console.log(imgJson)
        if (undefined == imgJson || undefined == imgJson.errcode || imgJson.errcode != 0) {
            // console.log('imgJson')
            return false;
        }
        $('#showUploadImageBox').data('hasimg', 1).attr('data-hasimg', '1').css({'backgroundImage': 'url(' + imgJson.data + ')', 'paddingTop': '30%'});
        $('#replyImageIpt').val(imgJson.data);
    }

    /**
     * [clearUploadImg 清除上传图片]
     * @Author   XieShaoLi
     * @DateTime 2017-09-20
     */
    function clearUploadImg() {
        event.preventDefault();
        event.stopPropagation();
        $('#showUploadImageBox').data('hasimg', 0).attr('data-hasimg', '0').css('paddingTop', '0');
        var t = setTimeout(function() {
            clearTimeout(t);
            $('#showUploadImageBox').css('backgroundImage', '');
            $('#replyImageIpt').val('');
        }, 300);
    }

    function updateUrl(url, key) {
        var url = url || window.location.href;
        var key = (key || 'reloadt') + '=';
        var reg = new RegExp(key + '[0-9]+');
        var timestamp = +new Date();
        if (url.indexOf(key) > -1) { //有时间戳，直接更新
            return url.replace(reg, key + timestamp);
        } else { //没有时间戳，加上时间戳
            if (url.indexOf('\?') > -1) {
                var urlArr = url.split('\?');
                if (urlArr[1]) {
                    return urlArr[0] + '?' + key + timestamp + '&' + urlArr[1];
                } else {
                    return urlArr[0] + '?' + key + timestamp;
                }
            } else {
                if (url.indexOf('#') > -1) {
                    return url.split('#')[0] + '?' + key + timestamp + location.hash;
                } else {
                    return url + '?' + key + timestamp;
                }
            }
        }
    }
    // 显示大图
    function showImages(obj) {
        event.stopPropagation();
        event.preventDefault();
        var url = $(obj).data("url");
        wx.previewImage({
            current: url, // 当前显示图片的http链接
            urls: [url] // 需要预览的图片http链接列表
        })
    }
</script>
<!-- <script type="text/javascript" src="/phone/public/js/ugc/article_detail.js?v=70"></script> -->
<script type="text/javascript" src="/phone/public/js/ugc/article_detail.min.js?v=70"></script>


</html>