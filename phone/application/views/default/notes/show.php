<!DOCTYPE html>
<html>
<head>
    <title>{$info['nickname']}的游记</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/nav.css?v=10">
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
<link rel="stylesheet" type="text/css" href="/phone/public/css/ugc/article.css?v=3">
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
                <div class="article-title">{$info['title']}</div>
                <div class="article-author flex-div">
                    <div class="flex-div" style="width:100%;">
                        <div class="flex-start" style="width:70%; overflow:hidden;">
                            <a href="#">
                                <div style="padding-left:10px;">
                                    <div class="flex-div" style="color:#999;">
                                        <div class="flex-start">
                                            <img src="/phone/public/images/wechat/article/time.png" style="height:12px;">
                                            <div style="padding-left:5px;">
                                                {if $info['addtime']}
                                                {date('Y-m-d',$info['addtime'])}
                                                {/if}                                                                                      </div>
                                        </div>
                                        <div class="flex-start" style="padding-left:15px;">
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

            {if $info['music']}
            <div class="music-item">
                <div class="music-item-n">
                    <span class="music-elem" role="button">
<!--                            <span class="music-icon">-->
<!--                                <img src="/phone/public/images/ugc/music.png">-->
<!--                            </span>-->
<!--                            <span class="msg-elem">-->
<!--                                <span class="song-name"> You Are My Sunshine - Nikki Loney,James Heatherington   </span>-->
<!--                            </span>-->
                            <span class="play-elem-btn">
                                <img src="/phone/public/images/ugc/play.png">
                            </span>
                    </span>
                    <audio id="mp3Btn">
                        <source src="{$info['music']}" type="audio/mpeg"/>
                    </audio>
                </div>
            </div>
            {/if}
            <div class="items-desc" id='items-desc'>
                {$info['content']}
            </div>

        </div>
        <!-- 游记标签 -->

            <div class="end" id="end">
                <div class="flex-center" style="display: none;">
                    <div class="end-point"></div>
                    <div class="end-border"><div></div></div>
                    <div style="padding:0 5px; color:#666;">END</div>
                    <div class="end-border"><div></div></div>
                    <div class="end-point"></div>
                </div>
                <div class="end-notice text-center" style="display: none;">您已阅读完毕啦</div>
                <!-- 作者简介 -->
                <div class="author-info">
                    <div class="flex-div" style="padding:0 20px;">
                        <div class="flex-div" style="width:69%;">
                            <div class="photo">
                                <a href="#">
                                    <img class="img-circle scrollLoading" src="{Common::member_pic($info['avatar'])}"  width="50" height="50">
                                </a>
                            </div>
                            <div class="flex-start" style="width:70%; overflow:hidden;">
                                <a href="#">
                                    <div style="padding-left:10px;">
                                        <div>
                                            <span class="article-author-name">{$info['nickname']}</span>
                                        </div>
                                        <div class="article-time" style="color:#666; line-height:12px;">作者</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div  class="text-right flex-end">
                            <span class="article-sub" onclick="follow(this);" follow-status="1" data-tollowtype="0">{if $info['is_attention']}已关注{else}+ 关注{/if}</span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 主题数据 -->

            <div class="comments" id="comments">
                <div id="commentsCountDiv" style="padding-bottom:10px;">
                    全部评论({$comment_num}条)
                </div>
                {loop $comment['articleComments'] $row}
                <div class="comment flex-div" id="comment{$row['id']}" data-id="{$row['id']}">
                    <div style="width:15%;">
                        <a href="javascript::void(0)">
                            <img class="img-circle" src="{$row['headImgUrl']}" width="40" height="40">
                        </a>
                    </div>
                    <div style="width:85%; line-height:22px;">
                        <div style="position:relative;">
                            <div class="marks">
                                <div class="mark" data-id="8">
                                    <img class="mark-img" src="#" style="width:100%;">
                                </div>
                            </div>
                            <div class="comment-main">
                                <div class="comment-hiker">
                                    <div>{$row['nickname']}
                                        <div style="display: none" class="pull-right flex-single">
                                            <div class="reply-show" replyname="{$row['nickname']}" onclick="showReply( 10, 16179, 16179, 896864, this, 1 );">回复</div>
                                        </div>
                                    </div>
                                    <div style="color:#999; font-size: 12px;">{$row['create_date']}</div>
                                </div>
                                <div class="comment-content" replyname="{$row['nickname']}" ">
                                    {$row['content']}                                                                            </div>
                            </div>
                        </div>
                        <div class="comment-replys-icon"  style="display: none" >
                            <img src="/phone/public/images/wechat/article/triangle2.png" style="height:12px; display:block;">
                        </div>
                        <div class="comment-replys" style="display: none" >
                            <div class="left-circle"></div>
                            <div class="comment-reply" replyname="虹云Y^3^Y" onclick="showReply( 10, 16180, 16179, 329613, this, 1 );">
                                <span>虹云Y^3^Y</span>
                                &nbsp;回复&nbsp;<span>美月</span>
                                ：谢谢！🌹                                    </div>
                        </div>
                    </div>
                </div>
                {/loop}
            </div>
            <div class="flex-div">
                <div class="footerReplyDiv" style="width:85%; padding:8px 10px;">
                    <div class="reply-content" onclick="showReplyModal();">说点儿什么吧~</div>
                </div>
                <div class="flex-center footerTwoDiv" style="width:10%;" onclick="like(this);" data-type="1">
                    <div class="relative">
                        {if $info['is_like']}
                        <img src="/phone/public/images/wechat/article/good2_g.png" style="height:18px;">
                        {else}
                        <img src="/phone/public/images/wechat/article/good2.png" style="height:18px;">
                        {/if}
                        <div id="likeNum">{$info['like_total']}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="reply-modal" id="replyModal">
        <div class="reply-modal-bg"></div>
        <div class="reply-modal-body">
            <form action="" id="footerReplyForm" method="get" accept-charset="utf-8" onsubmit="return submitForm();">
                <input type="hidden" id="replyFloor" name="replyFloor" value="0">
                <input type="hidden" id="replyParentId" name="replyParentId" value="0">
                <input type="hidden" id="replyId" name="replyId" value="0">
                <input type="hidden" id="replyHikerId" name="replyHikerId" value="0">
                <div>
                    <textarea id="replyContent" name="replyContent" placeholder="说点儿什么吧~"></textarea>
                </div>
                <input type="hidden" id="replyImageIpt" name="replyImage" value="">
                <div class="flex-base justify-end items-center reply-modal-btns">
                    <div class="reply-modal-btn cancel">
                        <button type="button" onclick="hideReplyModal();">取消</button>
                    </div>
                    <div class="reply-modal-btn submit">
                        <button type="submit">发送</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
{request "pub/footer"}
<!---->
<!--<div style="display: none" class="back-top" onclick="backTop();">-->
<!--    <img src="/phone/public/images/wechat/v4/back_top.png" style="height:40px;">-->
<!--</div>-->

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


    $(".item-img img").each(function(index, el) {
        var width = $(window).width() - 40;
        var realWidth = $(this).data("width");
        var realHeight = $(this).data("height");
        if( realWidth > 0 && realHeight > 0 ){
            $(this).css("height", width * realHeight / realWidth );
        }
    });


    var myAuto = document.getElementById('bg-music-elem');


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
    $(function () {
        //播放完毕
        $('#mp3Btn').on('ended', function () {
            console.log("音频已播放完成");
            $('.play-elem-btn').css({
                'background': 'url(images/voice_stop.png) no-repeat center bottom',
                'background-size': 'cover'
            });
        })
        //播放器控制
        var audio = document.getElementById('mp3Btn');
        audio.volume = .3;
        $('.play-elem-btn').click(function () {
            event.stopPropagation();//防止冒泡
            if (audio.paused) { //如果当前是暂停状态
                $('.play-elem-btn img').attr('src','/phone/public/images/ugc/pause.png');

                audio.play(); //播放
                return;
            } else {//当前是播放状态
                $('.play-elem-btn img').attr('src','/phone/public/images/ugc/play.png');
                audio.pause(); //暂停
            }
        });
    })
</script>
<!-- <script type="text/javascript" src="/phone/public/js/ugc/article_detail.js?v=70"></script> -->
<script type="text/javascript" src="/phone/public/js/ugc/article_detail.min.js?v=70"></script>


</html>