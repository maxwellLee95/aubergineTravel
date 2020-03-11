//滑块相关
var swiperReadyCount = $("#timeListSwiper").length + $(".time-activitys-swiper").length;
var swiperReadyNum = 0;
var timeSwiper = new Swiper('#timeListSwiper', {
    width : 70,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    on: {
        init: function(swiper){
            swiperReadyNum++;
        },
    }
});
if( $(".time-month").length * 70 <= $(window).width() - 40 ){
    $(".swiper-button-next").hide();
    $(".swiper-button-prev").hide();
    $("#timeListSwiper .swiper-slide").addClass("swiper-no-swiping");
}
function changeTimeListSide( e ){
    var index = $(e).data("index");
    $(".time-month").removeClass("active");
    $(".time-month").eq( index ).addClass("active");
    var month = $(e).data("month");
    var show_index = $(".time-activitys-swiper.active .swiper-slide[data-month='"+ month +"']:first").data("index");
    initialSwiper.slideTo( show_index, 1000 );
}
var timeActivitySwipers = [];
var initialSwiper = false;
$(".time-activitys-swiper").each(function(index, el) {
    var timeActivitySwiper = new Swiper(this, {
        width : 150,
        spaceBetween: 0,
        on: {
            init: function(swiper){
                swiperReadyNum++;
            },
            slideChangeTransitionEnd: function(){
                var show_month = $(".time-activitys-swiper.active .swiper-slide[data-index='"+ this.activeIndex +"']").data("month");
                if( show_month == undefined ){
                    return false;
                }
                $(".time-month").removeClass("active");
                $("#timeListSwiper .swiper-slide[data-month='"+ show_month +"'] .time-month").addClass("active");
                var timeMonthLeft = $("#timeListSwiper .swiper-slide[data-month='"+ show_month +"'] .time-month").offset().left;
                if( timeMonthLeft < 0 ){
                    timeSwiper.slidePrev();
                }else if( timeMonthLeft > $(window).width() - 100 ){
                    timeSwiper.slideNext();
                }
            }
        }
    });
    var initial = $(this).data("initial");
    if( initial == 1 ){
        initialSwiper = timeActivitySwiper;
    }
    timeActivitySwipers.push( timeActivitySwiper );
});
if( initialSwiper ){
    initialSwiper.slideTo( initialSlide, 1000 );
}
var swiperCheckInterval = setInterval( function(){
    if( swiperReadyNum >= swiperReadyCount ){
        clearInterval( swiperCheckInterval );
        $(".show-others-loading").hide();
    }
}, 100 );

var isLoadComment = false;
function changeTab( tabNum ){
    $(".activity-tab").removeClass("active");
    $(".activity-tabs").each(function(index, el) {
        $(this).find(".activity-tab").eq( tabNum ).addClass("active");
    });
    $(".tab-content").removeClass("active");
    $(".tab-content").eq( tabNum ).addClass("active");
    $(window).scrollTop( $(".tab-content.active").offset().top - 41 );
    if( tabNum == 3 && !isLoadComment ){
        isLoadComment = true;
        // getArticles(); //获取推荐游记
        getActivityComment();
    }
}

//限定banner的高度
var bannerHeight = $(window).width() * 302 / 640;
$(".activity-banner").css("height",bannerHeight+"px");
$(document).ready(function () {
    var tabTop = $("#activityTabs").offset().top;
    $(window).scroll(function () {
        //显示定位详情TAB
        if( $(window).scrollTop() >= tabTop ){
            $(".activity-tabs.fixed").addClass("showing");
        }else{
            $(".activity-tabs.fixed").removeClass('showing');
        }
    });
});

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

var imgList = [];
$(document).ready(function () {
    //实现图片慢慢浮现出来的效果
    $("img").load(function () {
        //图片默认隐藏
        $(this).hide();
        //使用fadeIn特效
        $(this).fadeIn("5000");
    });
    $("#description img").addClass("scrollLoading");
    // 异步加载图片，实现逐屏加载图片
    $(".scrollLoading").scrollLoading();
    //取出所有可预览图片
    $("#description img").each(function(index, el) {
        $(this).attr('onclick', 'showImg(this)');
        if ( $(this).attr("data-url") ) {
            imgList.push( $(this).attr("data-url") );
        }else{
            imgList.push( $(this).attr("src") );
        }
    });
});

function showImg( obj ){
    wx.previewImage({
        current: $(obj).attr("src"),
        urls: imgList
    });
}

if( showIsUserActivity ){
    //用户发起活动提示
    $(".is-user-activity").animate({top:"-60px"});
    function hiddenUserActivityNotice(){
        $(".is-user-activity").animate({top:"0"});
    }
}

//满员有名额通知弹窗
function subscribeActivity( activityIsRss, type ){
    var addHtml = '';
    var title = '';
    if( activityIsRss != 1 ){
        return;
    }else{
        if ( type == 1 ) {
            title += '开启活动名额通知';
            addHtml += '<div>本活动有名额时茄子户外运动公众号将通知您。可在【个人中心】右上角设置中关闭通知。</div>' + nextActivityHtml;
        } else {
            title += '开启活动开抢通知';
            addHtml += '<div>本活动开始报名前半小时，茄子户外运动公众号将通知您</div>';
        }

        btnsName = '取消;开启名额通知';
        btnsCallback = 'closePopLayer();doSubscribeActivity('+ type +')';
    }
    popLayer(
        //基本属性配置,closePopLayer为默认关闭按钮的方法
        {
            title: title, //头部标题
            btnsName: btnsName, //按钮的名称组字符串
            btnsCallback: btnsCallback, //按钮的回调方法名字符串(按照按钮名称的顺序)
            content: addHtml, //内容HTML
        }
    );
}

//满员有名额通知操作
function doSubscribeActivity( type ){
    closePopLayer();
    $("#loading .loading").html("正在处理...");
    $("#loading").css('display', 'inherit');
    $.ajax({
        url: '/wechat/rss/subactivity',
        type: 'POST',
        dataType: 'json',
        data: {
            aid: aid,
            type: type
        },
        success: function(getdata){
            // console.log(getdata);
            $("#loading .loading").html("");
            $("#loading").css('display', 'none');
            if( getdata.status != 1 ){
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '温馨提示', //头部标题
                        btnsName: '确认', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer()', //按钮的回调方法名字符串(按照按钮名称的顺序)
                        content: '<div class="text-center">'+ getdata.msg +'</div>', //内容HTML
                    }
                );
            }else{
                if ( type == 1 ) {
                    //改变订阅按钮
                    $("#buy").find('a').attr('onclick', 'subscribeActivity(0, '+type+')');
                    $("#buy").find('a').html( "已开启名额通知" );
                } else {
                    $("#collect").attr('onclick', 'subscribeActivity(0, '+type+')');
                    $("#collect").find('img').attr('src', '/images/wechat/rss.png');
                    $("#opr_"+aid).css('color', '#272727');
                    $("#opr_"+aid).html("已开启提醒");
                }
            }
        }
    })
}

function showSliderUnlock() {
    slider.showElm();
    $('#wechatGroupQrcodeBox').hide();
    $('#wechatGroupQrcodeImg').attr('src', ' ');
    $('#consultmore').modal('show');
}
function getWechatGroupQcode() {
    // 二维码判定
    if (undefined != erweima && erweima) {
        closePopLayer();
        $('#wechatGroupQrcodeImg').attr('src', erweima);
        slider.hideElm();
        $('#wechatGroupQrcodeBox').show();
        $('#consultmore').modal('show');
    } else {
        var code = $.trim($("#invitationCode").val());
        if (pop_type > 0) {
            if (!code) {
                $("#show-error").html("邀请码不能为空！");
                $("#show-error").animate({
                    left: "-10px"
                }, 100).animate({
                    left: "10px"
                }, 100).animate({
                    left: "-10px"
                }, 100).animate({
                    left: "10px"
                }, 100).animate({
                    left: "0px"
                }, 100);
                return false;
            }
        }
        var codeurl = '/wechat/v4/activity/getWechatGroupQcode';
        if (undefined != fromPreview && fromPreview != '') {
            codeurl += '?wxoid=' + fromPreview;
        }
        $.ajax({
            url: codeurl,
            type: 'POST',
            dataType: 'json',
            data: {
                aid: aid,
                code: code
            },
        })
            .done(function(ret) {
                if (ret.errcode == 0) {
                    closePopLayer();
                    $('#wechatGroupQrcodeImg').attr('src', ret.errmsg);
                    slider.hideElm();
                    $('#wechatGroupQrcodeBox').show();
                    $('#consultmore').modal('show');
                } else {
                    if (ret.errcode == 1003) {
                        closePopLayer();
                        $('#subscriptme').modal('show');
                    } else {
                        alert(ret.errmsg);
                    }
                }
            })
            .fail(function(ret) {
                alert('获取二维码失败');
            });
    }
}

//验证邀请码
function submitCode(){
    var invitationCode = $("#invitationCode").val();
    if( invitationCode == "" ){
        $("#show-error").html("邀请码不能为空！");
        $("#show-error").animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
            .animate({ left: "0px" }, 100);
    } else{
        $.ajax({
            url: '/wechat/activity/checkinvitationcode',
            type: 'POST',
            dataType: 'json',
            data: {
                invitationCode: invitationCode,
                aid: aid,
                hikerId: hikerId
            },
            success:function(getdata){
                if( getdata.status == 1 ){
                    $("#pop-layer").remove();
                    if ( pop_type == 1 ) {
                        $('#consult').html('<a data-toggle="modal" href="#consultmore" >进群</a>');
                        $('#buy').html('<a href="'+ oprUrl +'" >'+ oprStr +'</a>')
                        $('#consultmore').modal('show');
                    } else if ( pop_type == 2 ) {
                        window.location.href = ''+ oprUrl +'';
                    }
                }else{
                    $("#show-error").html("邀请码输入错误，请重新输入！");
                    $("#show-error").animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                        .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                        .animate({ left: "0px" }, 100);
                }
            },
        })
    }
}
//监听聚焦输入邀请码框
$(document).on('focus', '#invitationCode', function(event) {
    $(this).prop('placeholder', '');
    $(this).blur(function(event) {
        $(this).prop('placeholder', '请输入活动邀请码');
    });
});

//报名倒计时
if( isShowSurplusTime ){
    var showPointSeconds = [0,9,8,7,6,5,4,3,2,1];
    var showPointSecondNum = 0;
    var surplusTimeInterval = setInterval( function(){
        //若已到报名时间，则清除计时器，修改按钮为报名按钮
        if( surplusTime <= 0 ){
            clearInterval( surplusTimeInterval );
            $("#canSignupSurplusTime").parent().css('display', 'none');
            $("#showSignupBtn").css("display","inherit");
        }else{
            surplusTime = parseFloat(surplusTime - 0.1).toFixed(1);
            showPointSecondNum++;
            //获取剩余天数、小时、分钟以及秒数
            var day = Math.floor(surplusTime / (60 * 60 * 24));
            var hour = Math.floor(surplusTime / (3600)) - (day * 24);
            var minute = Math.floor(surplusTime / (60)) - (day * 24 * 60) - (hour * 60);
            var second = Math.floor(surplusTime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            $("#canSignupSurplusTime").html( day+"天"+(hour<10?("0"+hour):hour)+"时"+(minute<10?("0"+minute):minute)+"分"+(second<10?("0"+second):second)+"."+showPointSeconds[showPointSecondNum]+"秒" );
            if( showPointSecondNum == 9 ){
                showPointSecondNum = 0;
            }
        }
    }, 100 );
}

//优惠倒计时
if( dicountTimeLimit ){
    var showLimitPointSeconds = [0,9,8,7,6,5,4,3,2,1];
    var showLimitPointSecondNum = 0;
    var timeLimitsurplusTimeInterval = setInterval( function(){
        //若已到报名时间，则清除计时器，修改按钮为报名按钮
        if( timeLimitSurplusTime <= 0 ){
            clearInterval( timeLimitsurplusTimeInterval );
            $("#countDown").parent().parent().html( '<span class="green">'+ activityMoney +'</span> 元/人' );
        }else{
            timeLimitSurplusTime = parseFloat(timeLimitSurplusTime - 0.1).toFixed(1);
            showLimitPointSecondNum++;
            //获取剩余天数、小时、分钟以及秒数
            var day = Math.floor(timeLimitSurplusTime / (60 * 60 * 24));
            var hour = Math.floor(timeLimitSurplusTime / (3600)) - (day * 24);
            var minute = Math.floor(timeLimitSurplusTime / (60)) - (day * 24 * 60) - (hour * 60);
            var second = Math.floor(timeLimitSurplusTime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            $("#countDown").html( day+"天"+(hour<10?("0"+hour):hour)+"时"+(minute<10?("0"+minute):minute)+"分"+(second<10?("0"+second):second)+"."+showLimitPointSeconds[showLimitPointSecondNum]+"秒" );
            if( showLimitPointSecondNum == 9 ){
                showLimitPointSecondNum = 0;
            }
        }
    }, 100 );
}

$('#subscriptme').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var jsid = button.data('jsid');
});

//显示订阅活动路线弹窗
function subscribeLine( lineIsRss, status ){
    var titleHtml = '';
    var contentHtml = '';
    if( lineIsRss == 0 && status == 0 ){
        doSubscribeLine( lineIsRss, status );
        return;
    }else{
        titleHtml += '开启路线提醒：' + activityLineName;
        contentHtml += '<div>该路线有新活动时茄子户外运动公众号将通知您。可在【个人中心】右上角设置中关闭。'+ lineListUrlHtml +'</div>';
        btnsName = '取消;确认';
        btnsCallback = 'closePopLayer();doSubscribeLine( ' + lineIsRss + ', ' + status + ' )';
    }
    popLayer(
        //基本属性配置,closePopLayer为默认关闭按钮的方法
        {
            title: titleHtml, //头部标题
            btnsName: btnsName, //按钮的名称组字符串
            btnsCallback: btnsCallback, //按钮的回调方法名字符串(按照按钮名称的顺序)
            content: contentHtml, //内容HTML
        }
    );
}

//订阅活动路线操作
function doSubscribeLine( lineIsRss, status ){
    closePopLayer();
    $("#loading .loading").html("正在处理...");
    $("#loading").css('display', 'inherit');
    $.ajax({
        url: '/wechat/rss/subline',
        type: 'POST',
        dataType: 'json',
        data: {
            line: activityLineId,
            status: status,
        },
        success: function(getdata){
            // console.log(getdata);
            $("#loading .loading").html("");
            $("#loading").css('display', 'none');
            if( getdata.status != 1 ){
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '温馨提示', //头部标题
                        btnsName: '确认', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer()', //按钮的回调方法名字符串(按照按钮名称的顺序)
                        content: '<div class="text-center">'+ getdata.msg +'</div>', //内容HTML
                    }
                );
            }else{
                if( status == 1 ){
                    $(".clock-msg").html("已开启");
                    $(".clock-msg").parent().parent().parent().parent().parent().attr('onclick', 'subscribeLine(0,0)');
                }else{
                    $(".clock-msg").html("路线提醒");
                    $(".clock-msg").parent().parent().parent().parent().parent().attr('onclick', 'subscribeLine(1,1)');
                }
            }
        }
    })
}

function updateItemImg(){
    var width = ( $(window).width() - 20 ) * 0.384;
    var height = width * 196 / 288;
    $(".article-img").each(function(index, el) {
        $(this).css({
            "width": width+"px",
            "height": height+"px"
        });
    });
}
updateItemImg();

function showArticleMore( e, isShow ){
    if( isShow == 1 ){
        $(e).attr('onclick', 'showArticleMore(this,0)');
        $(e).html('查看更多游记&nbsp;&nbsp;<i class="fa fa-angle-double-down"></i>');
        $("#hideArticleList").slideUp();
    }else{
        $(e).attr('onclick', 'showArticleMore(this,1)');
        $(e).html('隐藏更多游记&nbsp;&nbsp;<i class="fa fa-angle-double-up"></i>');
        $("#hideArticleList").slideDown();
    }
}
var slider;
$(function() {
    slider = new ImageSliderUnlock(
        "#slider-unlock-div", { //配置项
            labelTip: '完成拼图查看群二维码',
            successLabelTip: '完成拼图查看群二维码',
            imgSliderUnlockTip: '<p>由于最近广告机器人过多</p>为维护群聊干净增加图形验证',
            deviation: 8,
            img: smallImageUrl,
            unlockimg: unlockimg
        },
        function() {
            slider.hideElm();
            $('#wechatGroupQrcodeBox').show();
            getWechatGroupQcode(pop_type);
            slider.reset();
        },
        function() {
            //滑动过程调用
        });
    slider.init();
});

//获取评论
function getActivityComment()
{
    $.ajax({
        url: '/phone/line/ajax_commnet?atid='+atid,
        timeout : 6000, //超时时间设置，单位毫秒
        type: 'POST',
        dataType: 'json',
        data: {
            atid: atid
        },
    })
        .done(function(getdata) {
            console.log(getdata);
            $(".comment-loading").remove();
            var addHtml = getCommentHtml( getdata.comment );
            $(".comment-list").append( addHtml );
            // addHtml = getReviewHtml( getdata.reviews );
            // $(".review-list").append( addHtml );
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

function getArticles()
{
    $.ajax({
        url: '/wechat/v4/activity/getarticles',
        type: 'POST',
        dataType: 'json',
        data: {
            atid: atid
        },
    })
        .done(function(getdata) {
            console.log(getdata);
            if( getdata.status == 1 ){
                if( getdata.datas.length <= 0 ){
                    $(".ugc-show").show();
                    $(".articles-list").hide();
                    return;
                }
                var addHtml = '';
                addHtml += '<div class="articles-title">';
                addHtml +=     '<span class="green">精彩游记</span>';
                addHtml += '</div>';
                addHtml += '<div class="articles-content">';
                $.each(getdata.datas, function(index, item) {
                    addHtml += '<div class="article-item">';
                    addHtml +=     '<a class="flex-div" href="'+ item['url'] +'">';
                    addHtml +=         '<div class="article-img" style="background-image:url('+ item['banner'] +');"></div>';
                    addHtml +=         '<div class="article-info">';
                    addHtml +=             '<div class="article-title">'+ item['title'] +'</div>';
                    addHtml +=             '<div class="article-author flex-start">';
                    addHtml +=                 '<img class="img-circle" src="'+ item['author']['headImgUrl'] +'" style="width:30px; height:30px;">';
                    addHtml +=                 '<span>'+ item['author']['nickname'] +'</span>';
                    addHtml +=             '</div>';
                    addHtml +=             '<div class="article-other flex-div justify-between">';
                    addHtml +=                 '<div class="article-time"><img src="/images/wechat/article/time.png" style="height:12px;"> '+ item['show_time'] +'</div>';
                    addHtml +=                 '<div class="article-read"><img src="/images/wechat/article/read_h.png" style="height:13px;"> '+ item['read'] +'次阅读</div>';
                    addHtml +=             '</div>';
                    addHtml +=         '</div>';
                    addHtml +=     '</a>';
                    addHtml += '</div>';
                });
                addHtml += '</div>';
                addHtml += '<a href="'+ getdata.url +'">';
                addHtml +=     '<div class="more-articles flex-center">更多游记<i class="fa fa-angle-double-right" aria-hidden="true"></i></div>';
                addHtml += '</a>';
                $(".articles-list").html( addHtml );
                $(".ugc-show").hide();
                $(".articles-list").show();
            }else{
                console.log("get articles failed...");
            }
        })
        .fail(function() {
            console.log("get articles error...");
        });
}

function refreshComment(){
    $(".comment-loading").html('<img src="'+ url_prefix +'/images/wechat/loading2.gif" style="height:16px;">');
    getActivityComment();
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

function getReviewHtml( reviews ){
    if (undefined == reviews || typeof reviews != 'object') {
        return false;
    }
    var addHtml = '';
    if( reviews.length > 0 ){
        addHtml += '<div class="comment-title">';
        addHtml +=     '<span class="green" >精彩回顾</span>';
        addHtml += '</div>';
        $.each(reviews, function(index, review) {
            addHtml += '<div class="comment-box">';
            addHtml +=     '<a href="'+ review['review']['hyperlinks'] +'">';
            addHtml +=         '<div class="comment-body">';
            addHtml +=             '<div class="fl mhead">';
            addHtml +=                 '<img src="'+ review['review']['imageUrl'] +'" width="50" height="50">';
            addHtml +=             '</div>';
            addHtml +=             '<div class="fl mcomment">';
            addHtml +=                 '<div>'+ review['review']['title'] +'</div>';
            addHtml +=                 '<div class="clr"></div>';
            addHtml +=                 '<div class="comefrom grey fz11">来自:'+ review['activity']['startDate'] +'出发 '+ review['activity']['name'] +'</div>';
            addHtml +=             '</div>';
            addHtml +=             '<div class="clr"></div>';
            addHtml +=         '</div>';
            addHtml +=     '</a>';
            addHtml += '</div>';
        });
    }

    return addHtml;
}

var isGetRecommend = false;
$(document).ready(function() {
    $(window).scroll(function(){
        //获取推荐
        if( isGetRecommend || isVip ){
            return false;
        }
        var scrollTop = $(this).scrollTop();
        var recommendListTop = $(".recommend-list").offset().top;
        if( scrollTop + $(window).height() >= recommendListTop - $(window).height() ){
            isGetRecommend = true;
            getRecommend(); //获取推荐活动
        }
    });
});

function getRecommend(){
    $.ajax({
        url: '',
        type: 'POST',
        dataType: 'json',
        data: {
            atid: atid,
            aid: aid
        },
    })
        .done(function(getdata) {
            console.log(getdata);
            var addHtml = getRecommendHtml( getdata.recommend );
            $(".recommend-list").append( addHtml );
        })
        .fail(function() {
            console.log("get recommend error");
        });
}

function getRecommendHtml( recommend ){
    var addHtml = '';
    if( recommend.activitys.length > 0 ){
        addHtml += '<div class="guess" style="margin-bottom:10px;">';
        addHtml +=     '<div class="guess-title">';
        addHtml +=         recommend['title'];
        addHtml +=         '<div style="width:40%; text-align:right; float: right;">';
        addHtml +=             '<a href="'+ recommend['url'] +'">更多活动&nbsp;<i class="fa fa-angle-right"></i></a>';
        addHtml +=         '</div>';
        addHtml +=     '</div>';

        addHtml +=     '<div class="guess-content">';
        $.each(recommend['activitys'], function(index, activity) {
            if( index >= 4 ){
                return true;
            }
            addHtml +=     '<div class="guess-activity pull-left">';
            addHtml +=         '<a href="'+ activity['url'] +'">';
            addHtml +=             '<div class="guess-img">';
            addHtml +=                 '<img src="'+ activity['smallImageUrl'] +'" style="min-height:30px;">';
            addHtml +=                 '<div class="guess-name">'+ activity['sub_title'] +'</div>';
            addHtml +=             '</div>';
            addHtml +=             '<div class="guess-laeder">领队：'+ activity['hiker']['nickname'] +'</div>';
            addHtml +=             '<div class="guess-info">';
            addHtml +=                 '<div class="pull-left">'+ activity['startDate'] +' 出发</div>';
            addHtml +=                 '<div class="pull-right status">';
            addHtml +=                     '<div class="triangle2 '+ activity['status']['style'] +'"></div>';
            addHtml +=                     '<span class="'+ activity['status']['style'] +'">'+ activity['status']['name'] +'</span>';
            addHtml +=                 '</div>';
            addHtml +=                 '<div class="clear"></div>';
            addHtml +=             '</div>';
            addHtml +=         '</a>';
            addHtml +=     '</div>';
        });
        addHtml +=     '</div>';
        addHtml +=     '<div class="clear"></div>';
        addHtml += '</div>';
    }

    return addHtml;
}

//预报名倒计时
if( isShowSignupSurplusTime ){
    var showSignupPointSeconds = [0,9,8,7,6,5,4,3,2,1];
    var showSignupPointSecondNum = 0;
    var signupSurplusTimeInterval = setInterval( function(){
        //若已到报名时间，则清除计时器，修改按钮为报名按钮
        if( signupSurplusTime <= 0 ){
            clearInterval( signupSurplusTimeInterval );
            $("#canSignupSurplusTime").parent().css('display', 'none');
            $("#showSignupBtn").css("display","inherit");
        }else{
            signupSurplusTime = parseFloat(signupSurplusTime - 0.1).toFixed(1);
            showSignupPointSecondNum++;
            //获取剩余天数、小时、分钟以及秒数
            var day = Math.floor(signupSurplusTime / (60 * 60 * 24));
            var hour = Math.floor(signupSurplusTime / (3600)) - (day * 24);
            var minute = Math.floor(signupSurplusTime / (60)) - (day * 24 * 60) - (hour * 60);
            var second = Math.floor(signupSurplusTime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            $("#canSignupSurplusTime").html( day+"天"+(hour<10?("0"+hour):hour)+"时"+(minute<10?("0"+minute):minute)+"分"+(second<10?("0"+second):second)+"."+showSignupPointSeconds[showSignupPointSecondNum]+"秒" );
            if( showSignupPointSecondNum == 9 ){
                showSignupPointSecondNum = 0;
            }
        }
    }, 100 );
}

var timeOutEvent= 0;
function showqrCode( is_activity ){
    var title = '想要定制活动？';
    if( is_activity == 1 ){
        title = '本活动为团队定制活动，不对外开放';
    }
    var content = '';
    if( is_activity == 1 ){
        content += '<div style="color:#666;">'
        content +=     '<div class="text-center">如有团队定制需求，可联系：</div>';
        content += '</div>';
    }else{
        content += '<div style="color:#666;">'
        content +=     '<div class="text-center">300多家企业选择茄子户外运动</div>';
        content +=     '<div class="text-center">如果您有团队出行需求可联系我们</div>';
        content += '</div>';
    }
    content += '<div class="text-center">';
    content +=     '<div class="team-qrcode"><img src="'+ customize_qrcode +'" width="40%" /></div>';
    content +=     '<div class="qrcode-notice">长按识别二维码，添加团建策划师微信</div>';
    content += '</div>';
    popLayer(
        //基本属性配置,closePopLayer为默认关闭按钮的方法
        {
            title: title, //头部标题
            btnsName: '不了;查看定制活动', //按钮的名称组字符串
            btnsCallback: 'closePopLayer();jumpTeamIndex()', //按钮的回调方法名字符串(按照按钮名称的顺序)
            content: content, //内容HTML
        }
    );
}

function jumpTeamIndex(){
    window.location.href = team_index_url;
}