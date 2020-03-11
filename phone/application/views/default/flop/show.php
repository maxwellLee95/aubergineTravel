<!DOCTYPE html>
<html>
<head>
    <title>茄子户外运动自选</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css">
    <link type="text/css" rel="stylesheet"
          href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5">

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">


    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>

</head>
<body>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/event.css?v=1">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/grade.css?v=1">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/activity_line.css?v=7">
<link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/pop-layer.css?v=17">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/fanpai/detail.css?v=3">
<style type="text/css">
    .line-step.fixed {
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1001;
        width: 100%;
    }

    .line-step.fixed img {
        opacity: 1;
    }
    .line-step{
        padding: 10px;
        background: #ffffff;
    }

    .line-tab {
        width: 25%;
    }
</style>
<div class="content">
    <div class="line-step">
        <img src="/phone/public/images/wx/wechat/line_step1_1.png" style="width: 100%; height:100%">
    </div>
    <div class="line-step fixed" >
        <img src="/phone/public/images/wx/wechat/line_step1_1.png" style="width: 100%; height: 100%">
    </div>

    <div class="line-img">
        <img class="line-banner" src="{Common::img($info['litpic'],640,300)}" style="width: 100%;">
        <div class="line-name"><span style="float: left">{$info['title']}</span><span style="float: right">{Currency_Tool::symbol()}{$info['price']}</span></div>
    </div>

    <div class="line-infos" style="padding-bottom:0;">
        <div class="flex-div">
            <div style="width:100%;">
                <div class="line-info flex-div" style="justify-content: space-between;">
                    <div style="display:flex;">
                        <div>难度:&nbsp;</div>
                        <div>
                            <span>{Common::difficulty_desc($info['difficultylevel'])}</span>
                            <span></span>
                        </div>
                    </div>
                    <div class="line-money-div" style="display: none">
                        <div>
                            <div class="line-money">{Currency_Tool::symbol()}{$info['price']}</div>
                            元/人
                        </div>
                    </div>
                </div>
                <div class="line-info flex-div">
                    <div style="display:flex;">
                        <div>集合:&nbsp;</div>
                        <div>【{$info['startcity']}】{$info['meetingplace']}</div>
                    </div>
                </div>
                <div class="line-info flex-div" style="margin-bottom:10px;">
                    <div>说明:&nbsp;</div>
                    <div>{$info['beizu']}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 详情TAB -->
    <div id="lineTabs" class="line-tabs flex-div">
        <div class="line-tab active" onclick="changeTab(0);">
            <span>路线介绍</span>
        </div>
        <div class="line-tab" onclick="changeTab(1);">
            <span>行程与准备</span>
        </div>
        <div class="line-tab" onclick="changeTab(2);">
            <span>费用说明</span>
        </div>
        <div class="line-tab" onclick="changeTab(3);">
            <span>评价</span>
        </div>
    </div>
    <div class="line-tabs fixed flex-div" style="margin-top: 50.4px;">
        <div class="line-tab active" onclick="changeTab(0);">
            <span>路线介绍</span>
        </div>
        <div class="line-tab" onclick="changeTab(1);">
            <span>行程与准备</span>
        </div>
        <div class="line-tab" onclick="changeTab(2);">
            <span>费用说明</span>
        </div>
        <div class="line-tab" onclick="changeTab(3);">
            <span>评价<span style="display: none" class="evaluation-num"></span></span>
        </div>
    </div>

    <div class="tab-content active">
        <div class="content-content">
            {$info['features']}
        </div>
    </div>
    <div class="tab-content">
        <!-- 详细行程 -->
        <div class="trip-content">
            {$info['jieshao']}
            <div class="content-title">详细行程（共{$info['lineday']}天）</div>
            {if preg_match('/^\d+$/',$info['id']) && $info['isstyle']==2}
            {loop Model_Line_Jieshao::detail($info['id'],$info['lineday']) $v}
            <div class="one-day-trip">
                <div class="day-title">第{$v['day']}天 </div>
                <div class="one-day-content">
                    {$v['jieshao']}
                </div>
                {if $info['showrepast']==1}
                <div class="trip-other">
                    <div class="trip-other-title">
                        <img src="/phone/public/images/wechat/v4/food_icon.png" style="height:18px; margin-bottom:2px;">
                        <span>用餐：</span>
                    </div>
                    <div class="trip-other-desc">
                        {if breakfirsthas}
                        <span class="tc">早餐：{$v['breakfirst']}</span>；
                        {/if}
                        {if lunchhas}
                        <span class="tc">中餐：{$v['lunch']}</span>；
                        {/if}
                        {if supperhas}
                        <span class="tc">晚餐：{$v['supper']}</span>；
                        {/if}
                    </div>
                </div>
                {/if}
                <div class="trip-other">
                    <div class="trip-other-title">
                        <img src="/phone/public/images/wechat/v4/traffic_icon.png" style="height:18px; margin-bottom:2px;">
                        <span>住宿：</span>
                    </div>
                    <div class="trip-other-desc">
                        {$v['hotel']}
                    </div>
                </div>
                <div class="trip-other">
                    <div class="trip-other-title">
                        <img src="/phone/public/images/wechat/v4/traffic_icon.png" style="height:18px; margin-bottom:2px;">
                        <span>交通：</span>
                    </div>
                    <div class="trip-other-desc">
                        {loop explode(',',$v['transport']) $t}
                        <span class="gj">{$t}</span>
                        {/loop}
                    </div>
                </div>

            </div>
            {/loop}
            {elseif $info['isstyle']==1}
            {$info['jieshao']}
            {/if}
        </div>
        <!-- 活动准备 -->
        <div class="ready-content">
            <div class="content-title">活动准备</div>
            <div class="content-content signup-desc">
                {$info['reserved1']}
            </div>
        </div>

    </div>
    <div class="tab-content">
        <div class="content-content">
            {$info['feeinclude']}
        </div>
    </div>
    <div class="tab-content" style="background-color:#fff; padding:10px;">
        <div class="comment-main" style="background-color:#fff; padding:10px 10px 0;">
            <div class="comment-list">
                <div class="flex-center comment-loading">
                    <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
                </div>
            </div>
            <!-- 精彩回顾 -->
            <div class="review-list"></div>
        </div>
    </div>

    <div style="height: 60px;background: #ffffff;border-top: 1px solid #9B8CE6;" class="bottom-btn-div">
        <a  style="background: none;font-size: 16px;color: #9B8CE5;margin: 7px 5px 7px 0px;" href="#" class="bottom-btn back-btn">返回</a>
        <a  href="/phone/flop/time?aid={$info['id']}" class="bottom-btn" style="width: 55%;margin: 7px 5px 7px 27px;">下一步，选时间选领队</a>
    </div>
</div>


<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js"></script>
<script type="text/javascript" src="/phone/public/js/tool.js"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js"></script>
<script type="text/javascript">
    var url_prefix = "/phone/public/";
    //切换TAB
    var isLoadComment = false;
    function changeTab(tabNum) {
        $(".line-tab").removeClass("active");
        $(".line-tabs").each(function (index, el) {
            $(this).find(".line-tab").eq(tabNum).addClass("active");
        });
        $(".tab-content").removeClass("active");
        $(".tab-content").eq(tabNum).addClass("active");
        $(window).scrollTop( $(".tab-content.active").offset().top - 41 );
        if( tabNum == 3 && !isLoadComment ){
            isLoadComment = true;
            getActivityComment();
        }
    }

    var lineStepHeight = $(window).width() * 105 / 750;
    // $(".line-step img").css("height", lineStepHeight + "px");
    $(".line-tabs.fixed").css("margin-top", lineStepHeight + "px");
    // var lineImgHeight = $(window).width() * 302 / 640;
    // $(".line-img img").css("height", lineImgHeight + "px");
    var tabTop = $("#lineTabs").offset().top - lineStepHeight;
    $(document).ready(function () {
        $(window).scroll(function () {
            //显示定位详情TAB
            if ($(window).scrollTop() >= tabTop) {
                $(".line-tabs.fixed").addClass("showing");
            } else {
                $(".line-tabs.fixed").removeClass('showing');
            }
        });
    });

    // 预览大图
    var imageUrls = [];
    var imgs = $("#event-box").find("img").each(function () {
        var url = $(this).attr("data-url");

        if (url == undefined) {
            url = $(this).attr("src");
        }

        if (url != undefined) {
            url = checkUrlHost(url + "");
            imageUrls.push(url);
        }
    });

    $("#event-box img").click(function () {
        var url = $(this).attr("data-url");
        // console.log(1+" "+url);
        if (url == undefined) {
            // console.log(2+" "+url);
            url = $(this).attr("src");
        }

        url = checkUrlHost(url + "");
        // console.log(url);
        wx.previewImage({
            current: url,
            urls: imageUrls
        });
    });

    $(document).ready(function () {
        //实现图片慢慢浮现出来的效果
        $("img").load(function () {
            //图片默认隐藏
            $(this).hide();
            //使用fadeIn特效
            $(this).fadeIn("5000");
            // $(this).show();
        });
        $("#box-intro img").addClass("scrollLoading");
        // 异步加载图片，实现逐屏加载图片
        $(".scrollLoading").scrollLoading();
    });

    //AJAX加载更多评论
    var activityType = "<?php echo $info['id'] ?>";
    var nowPage = 1;
    var pageSize = 10;

    //获取评论
    function getActivityComment()
    {
        $.ajax({
            url: '/phone/line/ajax_commnet?atid='+activityType,
            timeout : 6000, //超时时间设置，单位毫秒
            type: 'POST',
            dataType: 'json',
            data: {
                atid: activityType
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $(".comment-loading").remove();
                var addHtml = getCommentHtml( getdata.comment );
                $(".comment-list").append( addHtml );
            })
            .fail(function() {
                //请求失败，超时都会调用
                var failHtml = '';
                failHtml += '<div class="text-center refresh-show" onclick="refreshComment();">';
                failHtml +=     '<div><img src="/phone/public/images/wx/wechat/refresh.png" style="width:55%;"></div>';
                failHtml +=     '<div class="refresh-btn flex-center">';
                failHtml +=         '<span>刷新一下</span>';
                failHtml +=     '</div>';
                failHtml += '</div>';
                $(".comment-loading").html( failHtml );
            });
    }
    function refreshComment(){
        $(".comment-loading").html('<img src="'+ url_prefix +'/images/wechat/loading2.gif" style="height:16px;">');
        getActivityComment();
    }

    //AJAX加载更多评论
    function showMoreComments(){
        nowPage++; //获取下一页的评论
        $.ajax({
            url: '/phone/line/ajax_commnet',
            type: 'GET',
            dataType: 'json',
            data: {
                atid: activityType,
                page: nowPage,
                pagesize: pageSize
            },
            success: function(data){
                var getdata=data.comment;
                var lastDate = $(".activity-comment .comment-box:last .comment-body .mcomment .comefrom span").html();
                //循环加载评论内容
                for( var i=0; i<pageSize; i++ ){
                    if( getdata.coments[i] != undefined ){
                        var addHtml = '<div class="comment-box">';
                        //对比上一个评论的日期，判断是否加style
                        if( i != 0 ){
                            lastDate = getdata.coments[i-1]['activity']['date'];
                        }
                        addHtml    +=     '<div class="comment-body">';
                        addHtml    +=         '<div class="fl mhead">';
                        //判断是否为匿名评论
                        if( getdata.coments[i]['hiker'] == null ){
                            addHtml    +=             '<img class="img-circle images-event-info-img center-block scrollLoading" src="#">';
                            addHtml    +=             '<div class="fz12 text-overflow text-center hname">匿名</div>';
                        }else{
                            addHtml    +=             '<img class="img-circle images-event-info-img center-block scrollLoading" src="' + getdata.coments[i]['hiker']['headImgUrl'] + '">';
                            addHtml    +=             '<div class="fz12 text-overflow text-center hname">' + getdata.coments[i]['hiker']['nickname'] + '</div>';
                        }
                        addHtml    +=         '</div>';
                        addHtml    +=         '<div class="fl mcomment">';
                        //判断是否有评论内容
                        if( getdata.coments[i]['comment'] == "" ){
                            addHtml    +=             '<div> 用户未填写评论内容 </div>';
                        }else{
                            addHtml    +=             '<div> ' + getdata.coments[i]['comment'] + ' </div>';
                        }
                        addHtml    +=             '<div>';
                        addHtml    +=                 '<div class="starts">';
                        addHtml    +=                 '<div class="starts-container"><p class="grade-star"><span><em></em><b><i style=" width:'+getdata.coments[i]['stars']*20+'%"></i></b></span></p></div>';
                        addHtml    +=                 '</div>';
                        addHtml    +=             '</div>';
                        addHtml    +=             '<div class="clr"></div>';
                        addHtml    +=             '<div style="display: none" class="comefrom grey fz11 comment-activity-leader">';
                        addHtml    +=                 '<span style="font-size:11px;">'+ getdata.coments[i]['activity']['date'] +'</span>出发 领队：'+ getdata.coments[i]['activity']['leader_name_str'];
                        addHtml    +=             '</div>';
                        addHtml    +=         '</div>';
                        addHtml    +=         '<div class="clr"></div>';
                        addHtml    +=     '</div>';
                        if ( getdata.coments[i]['replyHiker'] ) {
                            addHtml    += '<div class="comment-reply fz12"><span class="reply-hiker fz12">'+getdata.coments[i]['replyHiker']+' 回复：</span> '+getdata.coments[i]['replyComment']+'</div>';
                        }
                        addHtml    += '</div>';
                        $( addHtml ).insertAfter(".activity-comment .comment-box:last");
                    }else{
                        var addHtml = '没有更多评论了';
                        $(".activity-comment div:last .grey").html( addHtml );
                    }
                }
            },
        })
    }

    function getCommentHtml( comment )
    {
        var addHtml = '';
        if( comment['coments'].length > 0 ){
            addHtml += '<div class="activity-grade" style="margin-top:0;">';
            addHtml +=     '<div class="fl" style="margin-right:5px; width:30%">';
            addHtml +=         '<div class="grade-box">';
            addHtml +=             '<div class="box-title"><span>综合评星</span></div>';
            addHtml +=             '<div class="box-body">';
            addHtml +=                 '<div class="score grey">'+ comment['averScore'] +'</div>';
            addHtml +=                 '<div class="starts">';
            addHtml +=                 '<div class="starts-container"><p class="grade-star"><span><em></em><b><i style=" width:'+comment['averScore']*20+'%"></i></b></span></p></div>';
            addHtml +=                 '</div>';
            addHtml +=             '</div>';
            addHtml +=             '<div class="clr"></div>';
            addHtml +=             '<div>';
            addHtml +=                 '<span class="grey fz12">'+ comment['count'] +'人评分</span>';
            addHtml +=             '</div>';
            addHtml +=         '</div>';
            addHtml +=     '</div>';
            addHtml +=     '<div class="fl" style="padding: 5px; width: 65%;">';
            addHtml +=         '<ul id="score-level">';
            $.each(comment['stars'], function(index, star) {
                addHtml +=         '<li>';
                addHtml +=             '<div class="row">';
                addHtml +=                 '<div class="col-xs-2">'+ star['name'] +'</div>';
                addHtml +=                 '<div class="col-xs-offset-1 col-xs-7">';
                addHtml +=                     '<div class="bar fl left" style="width:'+ star['percent'] +'%; '+ ( star['percent'] == 100 ? 'border-radius:3px;' : '' ) +'" ></div>';
                addHtml +=                     '<div class="bar fl greybar right" style="width:'+ ( 100 - star['percent'] ) +'%; '+ ( star['percent'] == 0 ? 'border-radius:3px;' : '' ) +'" ></div>';
                addHtml +=                 '</div>';
                addHtml +=                 '<div class="col-xs-offset-1 col-xs-1">'+ star['percent'] +'%</div>';
                addHtml +=             '</div>';
                addHtml +=         '</li>';
            });
            addHtml +=         '</ul>';
            addHtml +=     '</div>';
            addHtml +=     '<div class="clr"></div>';
            addHtml += '</div>';
            addHtml += '<div class="activity-comment">';
            addHtml +=     '<div class="comment-title">';
            addHtml +=         '<span class="purple" >最新评价</span>';
            addHtml +=     '</div>';
            var prev_aid = comment['coments'][0]['activity']['activityId'];
            $.each(comment['coments'], function(index, commentItem) {
                addHtml += '<div class="comment-box">';
                addHtml +=     '<div class="comment-body">';
                addHtml +=         '<div class="fl mhead" style="text-align:center;">';
                addHtml +=             '<img src="'+ commentItem['hiker']['headImgUrl'] +'" class="img-circle images-event-info-img center-block"  />';
                addHtml +=             '<div class="fz12 text-overflow text-center hname">'+ commentItem['hiker']["nickname"] +'</div>';
                addHtml +=         '</div>';
                addHtml +=         '<div class="fl mcomment" >';
                addHtml +=             '<div>'+ commentItem['comment'] +'</div>';
                addHtml +=             '<div>';
                addHtml +=                 '<div class="starts">';
                addHtml +=                 '<div class="starts-container"><p class="grade-star"><span><em></em><b><i style=" width:'+commentItem['stars']*20+'%"></i></b></span></p></div>';
                addHtml +=                 '</div>';
                addHtml +=             '</div>';
                addHtml +=             '<div class="clr"></div>';
                addHtml +=             '<div style="display: none" class="comefrom grey fz11 comment-activity-leader">';
                addHtml +=                 '<span style="font-size:11px;">'+ commentItem['activity']['date'] +'</span>出发 领队：'+ commentItem['activity']['leader_name_str'];
                addHtml +=             '</div>';
                addHtml +=         '</div>';
                addHtml +=         '<div class="clr"></div>';
                addHtml +=     '</div>';
                if( commentItem['replyHiker'] ){
                    addHtml += '<div class="comment-reply fz12">';
                    addHtml +=     '<span class="reply-hiker fz12">'+ commentItem['replyHiker'] +' 回复：</span> '+ commentItem['replyComment'];
                    addHtml += '</div>';
                }
                addHtml += '</div>';
                prev_aid = commentItem['activity']['activityId'];
            });
            addHtml += '<div class="text-center" style="padding:10px 0 5px 0;border-top:1px solid #e8e8e8;">';
            addHtml +=     '<a onclick="showMoreComments()">';
            addHtml +=         '<span class="grey">加载更多评论<i class="fa fa-angle-double-down"></i></span>';
            addHtml +=     '</a>';
            addHtml += '</div>';
        }

        return addHtml;
    }


    $(document).on('focus', '#invitation_code', function () {
        $(this).removeAttr("placeholder");
    });
    $(document).on('blur', '#invitation_code', function () {
        $(this).attr('placeholder', '设置后报名需先输入邀请码');
    });

    // $(document).ready(function () {
    //     $(window).scroll(function () {
    //         //显示定位详情TAB
    //         if( $(window).scrollTop() >= 0 ){
    //             $(".line-step.fixed").show();
    //         }else{
    //             $(".line-step.fixed").hide();
    //         }
    //     });
    // });

    function otherCityTip(e) {
        popLayer({
            title: '温馨提示',
            btnsName: '确认',
            btnsCallback: 'closePopLayer()',
            content: '<div class="text-center">本活动为广州出发活动，你当前城市为肇庆，无法发起本活动。</div>',
        });
    }

</script>


</body>
</html>