<!DOCTYPE html>
<html>
<head>
    <title>活动日历</title>
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

<link href="/phone/public/plugins/fullcalendar/fullcalendar.min.css?v=7" rel="stylesheet" type="text/css" />
<link href="/phone/public/plugins/fullcalendar/fullcalendar.print.css?v=2" rel="stylesheet" type="text/css" />
<link media="screen" rel="stylesheet" href="/phone/public/css/wechat/activity_calendar.css?v=21">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11">

<div id="load" style="text-align: center; margin-top: 30px; ">
    <img src="/phone/public/images/wechat/loading2.gif" style="width:30px;"> 日历加载中
</div>
<div id="loadCalendar" style="position:absolute; top:50px; left:0; z-index:10000; height:259px; width:100%; text-align: center; line-height:259px; display:none;">
    <img src="/phone/public/images/wechat/loading2.gif" style="width:30px;"> 日历加载中
</div>
<!-- 日历 -->
<div class="activity-calendar" style="height: 323px;" >

</div>

<!-- 活动内容 -->
<div id="activity-list" class="activity-ul" style="display: none;" >
    <ul>
        {loop $list $row}
        <li>
            <a onclick="checkIsHaveCode(this)" data-url="{$row['aurl']}" data-aid="{$row['activityId']}" data-ishavecode="0">
                <div class="activity-name">
                    <div class="pull-left">{$row['name']}</div>
                    <div class="activity-status pull-right">
                        <span class="{$row['status']['style']}">{$row['status']['name']}</span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="activity-leader">
                    <div class="pull-left">领队：{$row['hiker']['nickname']}</div>
                    <div class="activity-department-time pull-right">
                        {$row['startDate']} / {$row['day']}天
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="right-btn">
                    <img src="/phone/public/images/wechat/in.png">
                </div>
            </a>
        </li>
        {/loop}
        <li>
            <a href="/phone/flop/index">
                <div class="text-center">
                    <div style="color:#8b8b8b; font-size:12px;">以上没有合适您的活动？</div>
                    <div style="color: #9B8CE5">立即自选 <i class="fa fa-angle-right"></i></div>
                </div>
            </a>
        </li>
    </ul>
</div>



</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script src="/phone/public/plugins/fullcalendar/moment.min.js" type="text/javascript" ></script>
<script src="/phone/public/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript" ></script>
<script src="/phone/public/plugins/fullcalendar/lang-all.js" type="text/javascript" ></script>
<script src="/phone/public/js/jquery.event.move.js" type="text/javascript" ></script>
<script src="/phone/public/js/jquery.event.swipe.js" type="text/javascript" ></script>
<script src="/phone/public/js/getDateMsg.js?v=8" type="text/javascript"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=11" ></script>
<script type="text/javascript">
    //在列表后面默认添加一个链接
    function addLineUrl(){
        var addHtml = '';
        addHtml    += '<li>';
        addHtml    +=     '<a href="#">';
        addHtml    +=         '<div class="text-center">';
        addHtml    +=             '<div style="color:#8b8b8b; font-size:12px;">以上没有合适您的活动？</div>';
        addHtml    +=             '<div>立即自选 <i class="fa fa-angle-right"></i></div>';
        addHtml    +=         '</div>';
        addHtml    +=     '</a>';
        addHtml    += '</li>';
        $("#activity-list ul").append( addHtml );
    }

    //获取有活动的日期数组，按日期的升序排列
    //今天以后有活动的日期

    var dateArr = '<?php echo $after_time ?>';
    //今天之前有活动的日期
    var oldDateArr = '<?php echo $before_time ?>';

    var month = "<?php echo date('m') ?>";
    var year = "<?php echo date('Y') ?>";
    var cityId = 12
    var isFirstShow = 1; //初次加载日历的判断依据
    $('.activity-calendar').fullCalendar({
        lang: 'zh-cn',
        height: 316,
        contentHeight: 40,
        defaultDate: {
            year: year,
            month: (month-1),
        },
        header: {
            left: '',
            center: 'title',
            right: 'prev,next'
        },
        titleFormat: {
            month: 'YYYY MMMM',
        },
        // events:calendarData,
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
            if( isFirstShow == 1 ){
                //给日历的左侧添加HOME链接
                $(".fc-left").append($(".fc-prev-button"));
                isFirstShow++;
                //添加日历右侧的内容
                // $(".fc-prev-button").html("");
                // $(".fc-prev-button").append('上一月');
                // $(".fc-next-button").html("");
                // $(".fc-next-button").append('下一月');
            }
            $('#activity-list').show();
            $('#load').hide();
            haveActivity();
        }
    });


    $(document).on('click', '.fc-prev-button', function(event) {
        var oneDate = $(".fc-day-number").eq(20).attr('data-date');
        haveActivity();
        $.ajax({
            type: "post",
            data: {day: oneDate, cid: cityId},
            url: "/phone/linecalendar/ajax_get_day_activitys",
            async: false,
            cache: false,
            dataType: "json",
            success: function (response) {
                if ( response.status == 1 ) {
                    $(".activity-ul ul").html("");

                    if ( response.data.length > 0 ) {
                        $.each(response.data, function(key, value) {
                            if( value.hiker.nickname == null || value.hiker.nickname == '' ){
                                value.hiker.nickname = '领队安排中';
                            }
                            $(".activity-ul ul").append('<li><a onclick="checkIsHaveCode(this)" data-url="'+value.aurl+'" data-aid="'+value.activityId+'" data-ishavecode="'+value.isHaveCode+'"><div class="activity-name"><div class="pull-left">'+ value.name +'</div><div class="activity-status pull-right"><div class="triangle2 '+value.status.style+'"></div><span class="'+value.status.style+'">'+value.status.name+'</span></div><div class="clear"></div></div><div class="activity-leader"><div class="pull-left">领队：'+value.hiker.nickname+'</div><div class="activity-department-time pull-right">'+value.startDate+'出发 / '+value.day+'天</div><div class="clear"></div></div><div class="right-btn"><img src="/phone/public/images/wechat/in.png"></div></a></li>');
                        });
                    } else {
                        // $(".activity-ul ul").append('<li class="text-center mr20" >本月活动已结束</li>');
                    }
                    //默认添加一个路线链接
                    addLineUrl();
                } else {
                    alert(response.msg);
                }
            }
        });

    });

    $(document).on('click', '.fc-next-button', function(event) {
        var oneDate = $(".fc-day-number").eq(20).attr('data-date');
        haveActivity();
        $.ajax({
            type: "post",
            data: {day: oneDate, cid: cityId},
            url: "/phone/linecalendar/ajax_get_month_activitys",
            async: false,
            cache: false,
            dataType: "json",
            success: function (response) {
                if ( response.status == 1 ) {
                    $(".activity-ul ul").html("");

                    if ( response.data.length > 0 ) {
                        $.each(response.data, function(key, value) {
                            if( value.hiker.nickname == null || value.hiker.nickname == '' ){
                                value.hiker.nickname = '领队安排中';
                            }
                            $(".activity-ul ul").append('<li><a onclick="checkIsHaveCode(this)" data-url="'+value.aurl+'" data-aid="'+value.activityId+'" data-ishavecode="'+value.isHaveCode+'"><div class="activity-name"><div class="pull-left">'+ value.name +'</div><div class="activity-status pull-right"><div class="triangle2 '+value.status.style+'"></div><span class="'+value.status.style+'">'+value.status.name+'</span></div><div class="clear"></div></div><div class="activity-leader"><div class="pull-left">领队：'+value.hiker.nickname+'</div><div class="activity-department-time pull-right">'+value.startDate+'出发 / '+value.day+'天</div><div class="clear"></div></div><div class="right-btn"><img src="/phone/public/images/wechat/in.png"></div></a></li>');
                        });
                    } else {
                        // $(".activity-ul ul").append('<li class="text-center mr20" >活动策划中，敬请期待</li>');
                    }
                    //默认添加一个路线链接
                    addLineUrl();
                } else {
                    alert(response.msg);
                }
            }
        });

    });

    $(document).on('click', '.fc-day-number', function(event) {
        $(".active").removeClass('active');
        $(".fc-other-month").css('opacity', '0.3');
        $(this).find('div:first').addClass('active');
        var thisDate = $(this).attr('data-date');
        $(this).css('opacity', 10);

        $.ajax({
            type: "post",
            data: {day: thisDate, cid: cityId},
            url: "/phone/linecalendar/ajax_get_day_activitys",
            async: false,
            cache: false,
            dataType: "json",
            success: function (response) {
                if ( response.status == 1 ) {
                    $(".activity-ul ul").html("");
                    if ( response.data.length > 0 ) {
                        $.each(response.data, function(key, value) {
                            if( value.hiker.nickname == null || value.hiker.nickname == '' ){
                                value.hiker.nickname = '领队安排中';
                            }
                            $(".activity-ul ul").append('<li><a onclick="checkIsHaveCode(this)" data-url="'+value.aurl+'" data-aid="'+value.activityId+'" data-ishavecode="'+value.isHaveCode+'"><div class="activity-name"><div class="pull-left">'+ value.name +'</div><div class="activity-status pull-right"><div class="triangle2 '+value.status.style+'"></div><span class="'+value.status.style+'">'+value.status.name+'</span></div><div class="clear"></div></div><div class="activity-leader"><div class="pull-left">领队：'+value.hiker.nickname+'</div><div class="activity-department-time pull-right">'+value.startDate+'出发 / '+value.day+'天</div><div class="clear"></div></div><div class="right-btn"><img src="/phone/public/images/wechat/in.png"></div></a></li>');
                        });
                    } else {
                        // $(".activity-ul ul").append('<li class="text-center mr20" >无当天出发的活动</li>');
                    }
                    //默认添加一个路线链接
                    addLineUrl();
                } else {
                    alert(response.msg);
                }
            }
        });

    });

    //循环判断该日期是否有活动，有则变色
    function haveActivity(){
        $(".date_a").remove();
        $(".fc-day-number").each(function(index, el) {
            var date = $(this).attr('data-date');
            var thisDate = new Date(date);
            var thisDateU = new U( thisDate );
            console.log('--------')
            //判断日期是今天之前还是之后
            var nowTime = Date.parse(new Date());
            var thisTime = Date.parse(date);
            var thisHtml = $(this).html();
            $(this).html('<div class="">'+thisHtml+'</div>');
            // $(this).find('div').css('height', '24');
            $(this).append('<div class="date_a">'+thisDateU.solarFestival+'</div>');
            if( thisTime >= nowTime ){
                //今天之后的日期判断
                for( var i=0; i<dateArr.length; i++ ){
                    if( date == dateArr[i]  ){
                        $(this).css('color', '#fe6553');

                        if ( !$(this).children().hasClass('haveActivityPoint') )
                        {
                            var date_a = $(this).find('.date_a').html();
                            $(this).find('.date_a').html('<span class="date_dot"></span><span class="date_n">'+date_a+'</span>');
                            // ●
                        }
                    }else{
                        // $(this).find(".date_a").css('font-size', '8px');
                    }
                }
            }else{
                //今天之前的日期判断
                for( var i=0; i<oldDateArr.length; i++ ){
                    if( date == oldDateArr[i]  ){
                        // $(this).css('color', '#ccc');

                        if ( !$(this).children().hasClass('haveActivityPoint') )
                        {
                            var date_a = $(this).find('.date_a').html();
                            $(this).find('.date_a').html('<span class="date_dot"></span><span class="date_n">'+date_a+'</span>');
                            $(this).find('.date_a').css('color', '#ccc');
                            // $(this).append('<div class="haveActivityPoint"></div>');
                            $(this).find('.date_a .date_dot').css('background', '#ccc');
                        }
                    }else{
                        // $(this).find(".date_a").css('font-size', '8px');
                    }
                }
            }
        });
        $(".fc-content-skeleton tbody").remove();
    }

    var slides = $('.activity-calendar');
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
        $(".activity-calendar").css('width', $(window).width());
        $(".activity-calendar").css('overflow', 'hidden');
        // var nowWidth = $(".fc-day-grid-container").width();
        var nowWidth = $(".activity-calendar").width();
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

    //判断活动是否需要输入邀请码，不是则直接地址跳转，是则进入邀请码验证操作
    var hikerId = 690587; //邀请码用全局 用户ID
    var aid = ""; //邀请码用全局 活动ID
    var aUrl = ""; //邀请码用全局 活动链接
    function checkIsHaveCode( obj ){
        // var ishavecode = $(obj).data('ishavecode');
        aid = $(obj).data('aid');
        aUrl = $(obj).data('url');
        // if( ishavecode == 1 ){
        // 	showPopLayer();
        // }else{
        window.location.href = aUrl;
        // }
    }
    //邀请码输入弹出层
    function showPopLayer(){
        popLayer(
            //基本属性配置,closePopLayer为默认关闭按钮的方法
            {
                title: '', //头部标题
                btnsName: '返回;确认', //按钮的名称组字符串，用英文逗号分隔开
                btnsCallback: 'closePopLayer();submitCode()', //按钮的回调方法名字符串(按照按钮名称的顺序)，用英文逗号分隔开
                content: '<div>本次活动为团队定制活动，需要输入邀请码才能参与</div><div><input type="text" placeholder="请输入活动邀请码" id="invitationCode" class="form-control"></div><div id="show-error"></div>', //内容HTML
            }
        );
    }
    //验证邀请码
    function submitCode(){
        var invitationCode = $("#invitationCode").val();
        if( invitationCode == "" ){
            // alert("邀请码不能为空！");
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
                    // console.log(getdata);
                    if( getdata.status == 1 ){
                        $("#pop-layer").remove();
                        window.location.href = aUrl;
                    }else{
                        $("#show-error").html("邀请码输入错误，请重新输入！");
                        $("#show-error").animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                            .animate({ left: "0px" }, 100);
                        // alert("请输入正确的邀请码！");
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
    
</script>


</html>