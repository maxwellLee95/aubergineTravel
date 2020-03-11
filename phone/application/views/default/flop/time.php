<!DOCTYPE html>
<html>
<head>
    <title>茄子自选</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link rel="stylesheet" type="text/css" href="/phone/public/css/weui/weui.min.css" >
    <link rel="stylesheet" type="text/css" href="/phone/public/css/weui/weui_new.min.css" >
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=10"/>
    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/icon.css?v=10">
    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>
    <style type="text/css">
        .back,.home{
            padding-top: 3px;
        }
    </style>
</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>

<link href="/phone/public/css/wechat/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="/phone/public/css/wechat/datetime.css?v=3" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11">
<link href="/phone/public/plugins/fullcalendar/fullcalendar.min.css?v=7" rel="stylesheet" type="text/css" />
<link href="/phone/public/plugins/fullcalendar/fullcalendar.print.css?v=2" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/reset_calendar.css?v=4">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/activity_line_choice.css?v=4">
<style type="text/css">
    .line-step {
        padding: 10px;
        position: relative;
        background:#ffffff;
    }

    .line-step img {
        opacity: 0;
    }
    .fc{
        background-color: #ffffff;
        border-bottom: 0;
    }
    .fc-widget-content, .fc-day-grid-container thead{
        background-color: #ffffff;
    }
    .fc-event{
        background-color: #ffffff;
    }
    .arrow-transform{
        transform:rotate(180deg);
        -ms-transform:rotate(180deg);
        -moz-transform:rotate(180deg);
        -webkit-transform:rotate(180deg);
        -o-transform:rotate(180deg);
    }
    .bottom-btn-div{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .bottom-btn{
        display: flex;
        justify-content: center;
        align-items: center;
        border-top: 0;
    }
    .bottom-btn:active, .bottom-btn:hover, .bottom-btn:visited{
        text-decoration: none;
        color: #fff;
    }
    .bottom-btn:first-of-type{
        background-color: #468fd4;
    }
    .choice-leader-title{
        font-size: 14px;
        line-height: 16px;
    }
    .leader-choice{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding-top: 5px;
    }
    .leader-img{
        width: 20%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 5px;
        height: 66px;
    }
    .leader-img img{
        width: 46px;
        height: 46px;
    }
    .leader-info{
        width: 80%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;
        border-bottom: 1px solid #e5e5e5;
        padding-bottom: 5px;
        padding-right: 10px;
        padding-left: 0;
    }
    #hideLeaderList .leader-choice:last-of-type .leader-info{
        border-bottom: 0;
    }
    .leader-score{
        padding: 0;
        font-size: 13px;
        display: none;
    }
    .leader-desc{
        width: 90%;
        font-size: 15px;
    }
    .leader-check{
        width: 10%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
    .hide-leader-list{
        display: none;
    }
    .show-more{
        text-align: center;
        font-size: 12px;
        padding: 10px 0;
    }
    .no-time-list{
        border-top: 1px solid #e5e5e5;
        display: none;
    }

    .line-step.fixed {
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1001;
        width: 100%;
    }
    .line-step.fixed img{
        opacity: 1;
    }
    .invitation-set{
        margin: 5px 10px;
        border: 1px solid #e5e5e5;
        border-radius: 4px;
    }
    .invitation{
        display: flex;
        flex-direction: row;
    }
    .invitation-placeholder{
        padding: 0 10px 10px 10px;
        font-size: 12px;
        color: #999;
    }
    #invitation_code{
        width: 100%;
        padding: 5px 10px;
        text-align: center;
        border: 0;
    }
    .fc-day-number{
        position: relative;
    }
    .have-activity{
        position: absolute;
        right: 25%;
        top: 2px;
        background-color: #9B8CE5;
        /*background-color: #468fd4;*/
        width: 5px;
        height: 5px;
        border-radius: 50%;
    }
    .calendar-notice{
        padding-bottom: 10px;
        font-size: 12px;
        text-align: center;
    }
    .calendar-notice span{
        color: #9B8CE5;
        /*color: #468fd4;*/
        font-size: 12px;
    }
    .fc-left, .fc-right{
        padding-top: 10px;
    }
    .fc-state-default.fc-corner-left{
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .fc-state-default.fc-corner-right{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .fc .fc-button-group > *{
        position: static;
    }
    .fc-left{
        line-height: 24px;
    }
    .line-step-jump{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .line-step-a{
        width: 33.33%;
    }
</style>
<div class="content" style="padding-bottom: 60px;">
    <div class="line-step">
        <img src="/phone/public/images/wx/wechat/line_step2_2.png" style="width:100%;height: 100%;">
        <div class="line-step-jump">
            <a class="line-step-a" href="{Common::_flop_url($info['id'])}"></a>
        </div>
    </div>
    <div class="line-step fixed">
        <img src="/phone/public/images/wx/wechat/line_step2_2.png" style="width:100%;height: 100%;">
        <div class="line-step-jump">
            <a class="line-step-a" href="{Common::_flop_url($info['id'])}"></a>
        </div>
    </div>
    <div class="choice-time">
        <div style="background-color:#f3f3f3;">
            <div id="loadCalendar" style="position:absolute; top:50px; left:0; z-index:10000; height:259px; width:100%; text-align: center; line-height:259px; display:none;">
                <img src="/phone/public/images/wechat/loading2.gif" style="width:30px;"> 日历加载中
            </div>
            <!-- 价格日历 -->
            <div id="moneyCalendar" style="min-height:323px;"></div>
            <div class="calendar-notice">* 带<span>紫色</span>的日期表示本线路当天已有活动</div>
        </div>
        <div id="choiceTimeResult2" class="choice-time-result">
            <div class="choice-time-info pull-left" style="padding-left:10px;">
                <span id="startTime2"></span>
            </div>
            <div class="pull-right" style="height:46px; line-height:46px; padding-right:10px;">
                <a id="joinA" href="#" style="color:#9B8CE5;">直接报名 <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="clear"></div>
        </div>
        <div id="choiceTimeResult3" class="choice-time-result">

        </div>
    </div>
    <div class="weui_cells weui_cells_radio" style="margin:0;">
        <div class="choice-leader-title">选择意向领队</div>
        <div class="leader-choice">
            <div class="leader-img">
                <img class="img-circle" src="/phone/public/images/wx/v4/leader_img.png">
            </div>
            <div class="leader-info" onclick="checkedLeaders(this);">
                <div class="leader-desc">
                    <div class="purple">由茄子户外运动指派领队</div>
                </div>
                <div class="leader-check">
                    <input type="checkbox" class="leaderId" name="leaderId" value="44" style="display:none;" checked="checked">
                    <img src="/phone/public/images/wechat/choice_leader.png" style="height:18px;">
                </div>
            </div>
        </div>
        <div id="choiceLeaderList">
            <?php $leader=array_slice($leader,0,3) ?>
            {if $leader}
                {loop $leader $row}
                <div class="leader-choice">

                    <div class="leader-img" onclick="showLeaderMsg( {$row['guide_id']} );">
                        <img class="img-circle" src="{Common::member_pic($row['litpic'])}">
                    </div>
                    <div class="leader-info" onclick="checkedLeaders(this);">
                        <div class="leader-desc">
                            <div>{$row['nickname']}</div>
                            <div class="leader-score">评分：4.94&nbsp;&nbsp;带队本线路9次</div>
                        </div>
                        <div class="leader-check">
                            <input type="checkbox" class="leaderId" name="leaderId" value="{$row['guide_id']}" style="display:none;">
                            <img src="/phone/public/images/wechat/choice_false.png" style="height:18px;">
                        </div>
                    </div>
                </div>
                {/loop}
            {/if}
        </div>
        <div class="hide-leader-list" id="hideLeaderList">
            <?php $hide_leader=array_slice($leader,3) ?>
            {if $hide_leader}
            {loop $hide_leader $row}
            <div class="leader-choice">
                <div class="leader-img" onclick="showLeaderMsg( {$row['guide_id']} );">
                    <img class="img-circle" src="{Common::member_pic($row['litpic'])}">
                </div>
                <div  class="leader-info" onclick="checkedLeaders(this);">
                    <div class="leader-desc">
                        <div>{$row['nickname']}</div>
                        <div class="leader-score">评分：4.94&nbsp;&nbsp;带队本线路7次</div>
                    </div>
                    <div class="leader-check">
                        <input type="checkbox" class="leaderId" name="leaderId" value="{$row['guide_id']}" style="display:none;">
                        <img src="/phone/public/images/wechat/choice_false.png" style="height:18px;">
                    </div>
                </div>
            </div>
            {/loop}
            {/if}
        </div>
        <div class="show-more" onclick="showMoreLeaders();" >
            更多领队 <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
        </div>
    </div>
    <div style="height: 60px;background: #ffffff;border-top: 1px solid #9B8CE6;" class="bottom-btn-div">
        <a class="bottom-btn" href="fanpai_setp1.html" style="width:30%;background: none;font-size: 16px;color: #9B8CE5;margin: 7px 0px 7px 0px;">返回</a>
        <a id="sureChoiceBtn" class="bottom-btn" onclick="sureChoice()" style="width:70%;width: 60%;margin: 7px 5px 7px 27px;">下一步，报名</a>
    </div>

    <!-- 领队介绍弹出窗 -->
    <div class="modal" id="leader_introduction" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:9%;">
                <div class="modal-header">
                    <span class="closeBtn">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </span>
                    <span id="leader-introduction-title" class="modal-title" id="myModalLabel"></span>
                </div>
                <div class="modal-body">
                    <div id="leader-introduction-content" class="modal-leader-introduction-content">
                        内容
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="datePlugin"></div> <!-- 日期选择弹出层 -->
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>

<script src="/phone/public/js/bootstrap.min.js?v=2" type="text/javascript"></script>
<script type="text/javascript" src="/phone/public/js/datetime.js?v=5" ></script><script type="text/javascript" src="/phone/public/js/datetime_iscroll.js" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js" ></script>
<script src="/phone/public/plugins/fullcalendar/moment.min.js" type="text/javascript" ></script>
<script src="/phone/public/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript" ></script>
<script src="/phone/public/plugins/fullcalendar/lang-all.js" type="text/javascript" ></script>
<script src="/phone/public/js/jquery.event.move.js" type="text/javascript" ></script>
<script src="/phone/public/js/jquery.event.swipe.js" type="text/javascript" ></script>
<script src="/phone/public/js/getDateMsg.js?v=8" type="text/javascript"></script>
<script type="text/javascript">

    /**
     * [remove 删除数据元素]
     * @Author   Jason
     * @DateTime 2015-12-24T15:49:18+0800
     * @param    {[type]}                 val [description]
     * @return   {[type]}                     [description]
     */
    Array.prototype.remove = function(val) {
        var index = this.indexOf(val);
        if (index > -1) {
            this.splice(index, 1);
        }
    };

    //领队选择
    var choiceLeaderIds = [];
    choiceLeaderIds.push(45); //默认选中指派
    function checkedLeaders( obj ){
        var leaderIdObj = $(obj).find(".leaderId");
        var isChecked = leaderIdObj.is(":checked");
        if( isChecked ){
            choiceLeaderIds.remove( leaderIdObj.val() );
            leaderIdObj.prop('checked', false);
            leaderIdObj.next().attr("src","/phone/public/images/wechat/choice_false.png");
        }else{
            choiceLeaderIds.push( leaderIdObj.val() );
            leaderIdObj.prop('checked', 'checked');
            leaderIdObj.next().attr("src","/phone/public/images/wechat/choice_leader.png");
        }
        if( choiceLeaderIds.length > 5 ){
            popLayer(
                //基本属性配置,closePopLayer为默认关闭按钮的方法
                {
                    title: '', //头部标题
                    btnsName: '确定', //按钮的名称组字符串
                    btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                    content: '<div class="text-center">最多只能选择5个领队啦！</div>', //内容HTML
                }
            );
            choiceLeaderIds.remove( leaderIdObj.val() );
            leaderIdObj.prop('checked', false);
            leaderIdObj.next().attr("src","/phone/public/images/wechat/choice_false.png");
        }
    }

    function showMoreLeaders(){
        $("#hideLeaderList").slideDown('fast',function(){
            $(".show-more").hide();
        });
    }

    var activityDays = "<?php echo $info['lineday'] ?>";
    var activityPreDay = "1";
    var activityType = "3";
    var nowDate = new Date();

    var month = "<?php echo date("m") ?>";
    //日历上显示的价格JSON数组
    var calendarDatas ="<?php json_encode($calendar_data)?>";
    var defaultMoney = "<?php echo $info['price'] ?>";
    var specialMoneyDates = []; //特殊价格的日期数组
    var specialDateMoneys = {}; //特殊价格的数据数组
    var haveActivitysDates = <?php echo json_encode($have_activitys_dates); ?>; //存在活动的日期数组
    var nowTime = "<?php echo strtotime(date('Y-m')) ?>"; //当天时间戳
    var canStartTime = nowTime * 1000 + activityPreDay * 86400000;
    var sponsorDate = "<?php echo date('Y-m-d')?>"; //发起活动时间
    var suit_id="<?php echo $suit_id ?>";

    var slides = $('#moneyCalendar');
    slides.on('swipeleft', function(e) {
        // console.log();
        // var slideX = e.distX;
        $('#loadCalendar').show();
        var nowWidth = $(".fc-day-grid-container").width();
        $(".fc-day-grid-container").css('position', 'absolute');
        var startSlideX = 0;
        var speed = $(window).width()/30;
        var endSlideX = $(window).width();
        var move = setInterval( function(){
            $(".fc-day-grid-container").css('width', nowWidth+'px');
            var nowX = -(startSlideX*speed);
            // console.log(nowX);
            if( -nowX <= endSlideX ){
                $(".fc-day-grid-container").css('left', nowX+'px');
                startSlideX++;
            }else{
                clearInterval(move);
                $('#loadCalendar').hide();
                $(".fc-next-button").click();
                $(".fc-day-grid-container").css('left', '0px');
            }
        },1 );
    }).on('swiperight', function(e) {
        // console.log(e);
        // var slideX = e.distX;
        $('#loadCalendar').show();
        $("#moneyCalendar").css('width', $(window).width());
        $("#moneyCalendar").css('overflow', 'hidden');
        // var nowWidth = $(".fc-day-grid-container").width();
        var nowWidth = $("#moneyCalendar").width();
        $(".fc-day-grid-container").css('position', 'absolute');
        var startSlideX = 0;
        var speed = $(window).width()/30;
        var endSlideX = $(window).width();
        var move = setInterval( function(){
            $(".fc-day-grid-container").css('width', nowWidth+'px');
            var nowX = -(startSlideX*speed);
            // console.log(nowX);
            if( -nowX <= endSlideX ){
                $(".fc-day-grid-container").css('left', -nowX+'px');
                startSlideX++;
            }else{
                clearInterval(move);
                $('#loadCalendar').hide();
                $(".fc-prev-button").click();
                $(".fc-day-grid-container").css('left', '0px');
            }
        },1 );
    });

    //绑定价格日历
    $('#moneyCalendar').fullCalendar({
        defaultDate: "<?php echo date('Y-m-d') ?>",
        lang: 'zh-cn',
        height: 316,
        contentHeight: 40,
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        titleFormat: {
            month: 'YYYY MMMM',
        },
        events:calendarDatas,
        editable: false,
        selectable: true,
        slotEventOverlap: false,
        loading: function (bool) {
            if (bool) {
                $('#load').show();
            } else {
                $('#load').hide();
            }
        },
        viewRender: function (view) {
            //组装日历上默认显示的数组
            var centerDate = $(".fc-day-number").eq(20).attr('data-date');
            var monthObj = new Date( centerDate.substr(0,centerDate.length-2) + "01" );
            var month = monthObj.getMonth() + 1;
            var monthFirstTime = Date.parse( monthObj );
            var monthFirstTimeWeek = monthObj.getDay();
            if( monthFirstTimeWeek == 0 ){
                monthFirstTimeWeek = 7;
            }
            var showStartTime = monthFirstTime - 86400000 * ( monthFirstTimeWeek - 1 );
            var showEndTime = showStartTime + 86400000 * 41;
            var updatas = [];
            var updataNum = 0;
            var removeDatas = [];
            $(".have-activity").remove();
            for( var i = showStartTime; i <= showEndTime; i+=86400000 ){
                if( i >= canStartTime ){
                    var date = timeToDate( i );
                    var dateObj = new Date( date );
                    var dateMonth = dateObj.getMonth() + 1;
                    // console.log(date);
                    //判断该日期是否存在于特殊价格日期数组，存在则不处理
                    if( $.inArray(date, specialMoneyDates) == -1 ){
                        var isHaveFestival = checkHaveFestival( date );
                        var updata = {};
                        updata['id'] = date;
                        updata['start'] = date;
                        if( isHaveFestival ){
                            updata['title'] = '';
                        }else{
                            updata['title'] = '￥' + defaultMoney;
                        }
                        updata['title'] = '';
                        updata['className'] = new Array();
                        updata['className'][0] = 'fc-day-content';
                        updata['className'][1] = 'fc-day-content-' + date;
                        if( dateMonth != month ){
                            updata['className'][2] = 'is-other-month';
                        }
                        updatas[updataNum] = updata;
                        updataNum++;
                    }else{
                        // console.log(specialDateMoneys[date]);
                        var specialDateMoney = specialDateMoneys[date];
                        var updata = {};
                        updata['id'] = date;
                        updata['start'] = date;
                        if( specialDateMoney['money'] <= 0 ){
                            updata['title'] = '';
                        }else{
                            updata['title'] = '￥' + specialDateMoney['money'];
                        }
                        updata['className'] = new Array();
                        updata['className'][0] = 'fc-day-content';
                        updata['className'][1] = 'fc-day-content-' + date;
                        if( dateMonth != month ){
                            updata['className'][2] = 'is-other-month';
                        }
                        updatas[updataNum] = updata;
                        updataNum++;
                    }
                    // console.log(updatas);
                    // var tdObj = $(".fc-day-number[data-date='"+ date +"']");
                    // tdObj.html('<div class="">'+tdObj.html()+'</div>');
                    //判断是否为存在活动的日期
                    if( $.inArray(date, haveActivitysDates) != -1 ){
                        var tdObj = $(".fc-day-number[data-date='"+ date +"']");
                        var addHtml = '<div class="have-activity"></div>';
                        tdObj.attr("have-activity",'1');
                        tdObj.append( addHtml );
                    }
                }
            }
            // console.log(updatas);
            if( updatas.length > 0 ){
                $('#moneyCalendar').fullCalendar( 'removeEvents' );
                $('#moneyCalendar').fullCalendar( 'addEventSource', updatas );
            }
        },
        eventClick: function(event, element) {
            checkStartDate( event.id );
        }
    });

    //点击某日期
    $(document).on('click', '.fc-day-number', function(event) {
        var date = $(this).attr("data-date");
        checkStartDate( date );
    });

    //选中某日期，对应活动天数的其他日期也选中
    function choiceDate( date ){
        $(".fc-day-number").removeClass("active");
        $(".fc-day-content").removeClass("active");
        $(".fc-day-content").removeClass("active-other");
        var time = Date.parse( new Date( date ) );
        for( var i = activityDays; i > 0; i-- ){
            var newDate = timeToDate( time );
            if( i != activityDays ){
                $(".fc-day-content-"+newDate).addClass("active-other");
            }
            addDateStyle( newDate );
            time += 86400000;
        }
    }

    //给某日期添加选中样式
    function addDateStyle( date ){
        var dateEle = $(".fc-day-number[data-date='"+ date +"']");
        var day = parseInt( date.substr(date.length-2) );
        dateEle.addClass("active");
        dateEle.html(day);
        $(".fc-day-content-"+date).addClass("active");
    }

    //JS的时间戳转日期
    function timeToDate( time )
    {
        var timestamp = time;
        var newDate = new Date();
        newDate.setTime(timestamp);
        var year = newDate.getFullYear();
        var month = newDate.getMonth() + 1;
        var day = newDate.getDate();
        return year + "-" + ( month < 10 ? ( "0" + month ) : month ) + "-" + ( day < 10 ? ( "0" + day ) : day );
    }

    //关闭活动时间选择
    function closeChoiceTime(){
        $("#startDate").val("");
        $("#showStartDate").html("点击选择");
        $("#startTime1").html("--:--");
        $("#endTime").html("--:--");
        $("#sureChoiceBtn").hide();
        $("#showTimeChoiceBtn").show();
        $(".choice-time-result").hide();
        $("#startTime2").html("");
        $("#joinA").attr("href","#");
        $(".choice-time").slideUp('fast',function(){
            $(".content").css('padding-bottom', '30px');
            $("#sureChoiceBtn").attr("onclick","sureChoice();");
            $(".choice-time-bg").hide();
        });
    }

    //检查活动出发时间选择情况
    function checkStartDate( date ){
        var thisDateParse = Date.parse( date );
        //若日期没有改变，则不进行之后的操作
        if( sponsorDate == date ){
            return false;
        }
        //小于今天的日期无法选择
        if( thisDateParse <= nowTime * 1000 ){
            // popLayer(
            //     //基本属性配置,closePopLayer为默认关闭按钮的方法
            //     {
            //         title: '', //头部标题
            //         btnsName: '确定', //按钮的名称组字符串
            //         btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
            //         content: '<div class="text-center">日期不符合条件，无法发起！</div>', //内容HTML
            //     }
            // );
            return false;
        }
        //判断日期是否符合要求
        var dateParse = Date.parse( new Date() );
        var activityPreTime = new Date( dateParse + 86400000*activityPreDay );
        var Year = activityPreTime.getFullYear();
        var Month = activityPreTime.getMonth()+1;
        var Day = activityPreTime.getDate();
        var activityPreDate = Year + "-" + (Month<10?("0"+Month):Month) + "-" + (Day<10?("0"+Day):Day);
        if( thisDateParse < Date.parse( activityPreDate ) ){
            // popLayer(
            //     //基本属性配置,closePopLayer为默认关闭按钮的方法
            //     {
            //         title: '', //头部标题
            //         btnsName: '确定', //按钮的名称组字符串
            //         btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
            //         content: '<div class="text-center">活动出发时间必须提前'+ activityPreDay +'天！</div>', //内容HTML
            //     }
            // );
            return false;
        }
        //判断是否为特殊价格日期，是且价格为0时无法选择
        if( $.inArray(date, specialMoneyDates) != -1 ){
            var specialDateMoney = specialDateMoneys[date];
            if( specialDateMoney['money'] <= 0 ){
                var dateObj = new Date( date );
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '', //头部标题
                        btnsName: '确定', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                        content: '<div class="text-center">很抱歉，'+ (dateObj.getMonth() + 1) +'月'+ dateObj.getDate() +'日不可自选！</div>', //内容HTML
                    }
                );
                return false;
            }
        }
        //若该日期不是特殊价格日期，且前后3天存在节日，则不可自选
        var isHaveFestival = checkHaveFestival( date );
        getLineDetails( activityType, date, activityDays, isHaveFestival );
    }

    //检查该日期及前后3天是否存在节日
    function checkHaveFestival( date ){
        var thisDateParse = Date.parse( date );
        var isHaveFestival = false;
        if( $.inArray(date, specialMoneyDates) == -1 ){
            for( var i=( thisDateParse - 86400000 * 3 ); i<=( thisDateParse + 86400000 * 3 ); i+=86400000 ){
                var thisDate = new Date(i);
                var thisDateU = new U( thisDate );
                if( thisDateU.solarFestival != '' && thisDateU.solarFestival != '班' && thisDateU.solarFestival != '休' ){
                    isHaveFestival = true;
                    break;
                }
            }
        }
        return isHaveFestival;
    }

    //ajax查询获取该日期的路线活动情况，及该日期下有活动的领队信息
    var lineDetailsResult;
    var jumpDetailUrl = '';
    function getLineDetails( activityType, date, activityDays, isHaveFestival ){
        var haveActivity = $(".fc-day-number[data-date='"+ date +"']").attr("have-activity");
        if (!haveActivity){
            return false;
        }
        if( !isHaveFestival || haveActivity ){
            $(".loading").html("正在获取数据");
            $("#loading").css("display","inherit");
        }
        //绑定页面不允许滚动
        $('body').bind('touchmove', function (event) {
            event.preventDefault();
        });
        $.ajax({
            url: '/phone/flop/get_leader',
            type: 'POST',
            dataType: 'json',
            data: {
                activityType: activityType,
                date: date,
                activityDays: activityDays
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                $("#loading").css("display","none");
                //解除绑定页面不允许滚动
                $('body').unbind('touchmove');
                if( getdata.status == 0 ){
                    popLayer(
                        //基本属性配置,closePopLayer为默认关闭按钮的方法
                        {
                            title: '', //头部标题
                            btnsName: '确定', //按钮的名称组字符串
                            btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                            content: '<div class="text-center">数据获取失败，请稍后再试！</div>', //内容HTML
                        }
                    );
                    return false;
                }else{
                    //显示结果
                    var result = getdata.status;
                    var showDate = getdata.showDate;
                    lineDetailsResult = getdata;
                    //判断是否为存在活动的日期
                    $(".have-activity").remove();
                    $(".fc-day-number").each(function(index, el) {
                        var fcDate = $(this).data("date");
                        if( $.inArray(fcDate, haveActivitysDates) != -1 ){
                            var addHtml = '<div class="have-activity"></div>';
                            $(this).attr("have-activity",'1');
                            $(this).append( addHtml );
                        }
                    });
                    if( result == 2 ){
                        var confirmBtn = {};
                        var content = '';
                        content += '<div class="text-center">你选择的 '+ showDate +' 本线路已有可报名活动</div>';
                        if( getdata.surplusNum <= 0 ){
                            content += '<div class="text-center">剩余名额 '+ getdata.surplusNum +' 人， <a href="'+ getdata.joinUrl +'">前往查看活动 ></a></div>';
                            content += '<div class="text-center">仍要自选，请点击继续自选按钮</div>';
                            confirmBtn['name'] = '继续自选';
                            confirmBtn['function'] = "setLineDetailsResult('"+ date +"')";
                        }else{
                            content += '<div class="text-center">剩余名额 '+ getdata.surplusNum +' 人</div>';
                            confirmBtn['name'] = '前往报名';
                            confirmBtn['function'] = 'jumpActivityDetail()';
                            jumpDetailUrl = getdata.joinUrl;
                        }
                        popLayer(
                            //基本属性配置,closePopLayer为默认关闭按钮的方法
                            {
                                title: '温馨提示', //头部标题
                                btnsName: '取消;'+confirmBtn['name'], //按钮的名称组字符串
                                btnsCallback: "closePopLayer();"+confirmBtn['function'], //按钮的回调方法名字符串(按照按钮名称的顺序)
                                content: content, //内容HTML
                            }
                        );
                    }else{
                        if( !isHaveFestival ){
                            setLineDetailsResult( date );
                        }
                    }
                    return true;
                }
            })
            .fail(function() {
                $("#loading").hide();
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '', //头部标题
                        btnsName: '确定', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                        content: '<div class="text-center">请求失败，请稍后再试！</div>', //内容HTML
                    }
                );
                return false;
            });
    }

    function jumpActivityDetail(){
        closePopLayer();
        window.location.href = jumpDetailUrl;
    }

    function setLineDetailsResult( date ){
        closePopLayer();
        var getdata = lineDetailsResult;
        $("#sureChoiceBtn").attr("onclick","sureChoice();");
        //给领队选择列表重新赋值，移除该日期有活动的领队(不再作判断)
        var addHtml = '';
        var addNum = 0;
        var hideHtml = '';
        $.each(getdata.leaders, function(index, leader) {
            addNum++;
            if( addNum > 3 ){
                hideHtml += getLeaderChoiceHtml( leader, true );
            }else{
                addHtml += getLeaderChoiceHtml( leader, true );
            }
        });
        $("#choiceLeaderList").html( addHtml );
        if( hideHtml != '' ){
            $(".show-more").show();
        }else{
            $(".show-more").hide();
        }
        $("#hideLeaderList").html( hideHtml );
        choiceDate( date );
        sponsorDate = date;
    }

    function getLeaderChoiceHtml( data, canChecked ){
        var addHtml = '';
        addHtml += '<div class="leader-choice">';
        addHtml +=     '<div class="leader-img" onclick="showLeaderMsg( '+ data['hikerId'] +' );">';
        addHtml +=         '<img class="img-circle" src="'+ data['headImgUrl'] +'">';
        addHtml +=     '</div>';
        if( canChecked ){
            addHtml +=     '<div class="leader-info" onclick="checkedLeaders(this);">';
            addHtml +=         '<div class="leader-desc">';
            addHtml +=             '<div>'+ data['nickname'] +'</div>';
            addHtml +=             '<div class="leader-score">评分：'+ (data['leaderScore']==undefined?0:data['leaderScore']['score']) +'&nbsp;&nbsp;带队本线路'+ data['leaderCounts'] +'次</div>';
            addHtml +=         '</div>';
            addHtml +=         '<div class="leader-check">';
            if( $.inArray(data['hikerId'], choiceLeaderIds) != -1 ){
                addHtml +=             '<input type="checkbox" class="leaderId" name="leaderId" value="'+ data['hikerId'] +'" checked="checked" style="display:none;">';
                addHtml +=             '<img src="/phone/public/images/wechat/choice_leader.png" style="height:18px;">';
            }else {
                addHtml += '<input type="checkbox" class="leaderId" name="leaderId" value="' + data['hikerId'] + '" style="display:none;">';
                addHtml += '<img src="/phone/public/images/wechat/choice_false.png" style="height:18px;">';
                addHtml += '</div>';
                addHtml += '</div>';
            }
        }else{
            addHtml +=     '<div class="leader-info">';
            addHtml +=         '<div class="leader-desc">';
            addHtml +=             '<div>'+ data['nickname'] +'</div>';
            addHtml +=             '<div class="leader-score">评分：'+ (data['leaderScore']==undefined?0:data['leaderScore']['score']) +'&nbsp;&nbsp;带队本线路'+ data['leaderCounts'] +'次</div>';
            addHtml +=         '</div>';
            addHtml +=     '</div>';
        }
        addHtml += '</div>';
        return addHtml;
    }

    //存在当天活动，无法再发起活动
    function haveActivitys( date ){
        popLayer(
            //基本属性配置,closePopLayer为默认关闭按钮的方法
            {
                title: '', //头部标题
                btnsName: '确定', //按钮的名称组字符串
                btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                content: '<div class="text-center">已有人在'+ date +'发起本线路活动，您可以直接报名，或者选择其他时间发起活动！</div>', //内容HTML
            }
        );
    }

    //确认选择操作
    function sureChoice(){
        // var startDate = $("#startDate").val();
        if( sponsorDate == "" ){
            popLayer(
                //基本属性配置,closePopLayer为默认关闭按钮的方法
                {
                    title: '', //头部标题
                    btnsName: '确定', //按钮的名称组字符串
                    btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                    content: '<div class="text-center">请选择活动出发时间！</div>', //内容HTML
                }
            );
        }else{
            if( choiceLeaderIds.length <= 0 ){
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '温馨提示', //头部标题
                        btnsName: '去选择;由茄子户外运动指派', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer();setDefaultLeader()', //按钮的回调方法名字符串(按照按钮名称的顺序)
                        content: '<div class="text-center">你还未选择领队。</div>', //内容HTML
                    }
                );
            }else{
                //进入发起活动操作
                confirmDoChoice();
            }
        }
    }

    function setDefaultLeader(){
        closePopLayer();
        $(".leaderId[value='44']").parent().parent().click();
        //进入发起活动操作
        confirmDoChoice();
    }

    //邀请码二次确认弹窗
    function confirmDoChoice(){
        doChoice();
    }

    //取消配置邀请码
    function cancelInvitationCode(){
        closePopLayer();
        $("#invitation_code").val("");
    }

    //发起活动操作
    var joinPageUrl = "";
    function doChoice(){
        closePopLayer();
        $(".loading").html("正在发起活动");
        $("#loading").css("display","inherit");
        //绑定页面不允许滚动
        $('body').bind('touchmove', function (event) {
            event.preventDefault();
        });
        $.ajax({
            url: '/phone/flop/createactivity',
            type: 'POST',
            dataType: 'json',
            data: {
                line_id: {$info['id']},
                choiceLeaderIds: choiceLeaderIds,
                start_time: sponsorDate,
                invitation_code: $("#invitation_code").val(),
                suitid:suit_id
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                if( getdata.status == 1 || getdata.status == -1 ){
                    $("#loading").css("display","none");
                    joinPageUrl = getdata.joinPageUrl;
                    closePopLayerAndJump( getdata.status );
                }else{
                    $("#loading").css("display","none");
                    popLayer(
                        //基本属性配置,closePopLayer为默认关闭按钮的方法
                        {
                            title: '', //头部标题
                            btnsName: '确定', //按钮的名称组字符串
                            btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                            content: '<div class="text-center">'+ getdata.msg +'</div>', //内容HTML
                        }
                    );
                }
                //解除绑定页面不允许滚动
                $('body').unbind('touchmove');
            })
            .fail(function() {
                $("#loading").css("display","none");
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '', //头部标题
                        btnsName: '确定', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer();', //按钮的回调方法名字符串(按照按钮名称的顺序)
                        content: '<div class="text-center">请求失败，请稍后再试！</div>', //内容HTML
                    }
                );
            });
    }

    function closePopLayerAndJump( status ){
        closePopLayer();
        // $(".loading").html("正在跳转");
        // $("#loading").css("display","inherit");
        window.location.href = joinPageUrl;
    }

    //限制弹窗的最大高度
    $(".modal-body").css('max-height', ($(window).height()-100)+"px" );

    //查看领队
    var leadersByIdKey = {};
    function showLeaderMsg( leaderId ){
        // $("#leaderId"+leaderId).click(); //模拟再次点击，取消选择
        // var name = leadersByIdKey[leaderId]['nickname'];
        // var desc = leadersByIdKey[leaderId]['leader_desc'];
        // $("#leader-introduction-title").html("领队：" + name);
        // $("#leader-introduction-content").html(desc);
        // $("#leader_introduction").modal();
    }

</script>


</html>