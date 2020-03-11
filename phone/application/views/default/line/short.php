<!DOCTYPE html>
<html>
<head>
    <title>周边短线</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=14"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/pop-layer.css?v=17">
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
    </style>
    <style type="text/css" media="screen">
        body{
            font-size: 1.4rem;
            display: none;
        }
    </style>
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

<link rel="stylesheet" type="text/css" href="/phone/public/plugins/Swiper-4.1.0/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list/short_v3.css?v=35">
<div class="content">

    <div class="banners">
        {st:ad action="getad" name="s_index_2"}
        {if $data['aditems']}
        <div class="swiper-container" id="bannerSwiper">
            <div class="swiper-wrapper">

                {loop $data['aditems'] $v}
                <div class="swiper-slide">
                    <div class="inner">
                        <a href="{$v['adlink']}">
                            <img class="banner-img"  title="{$v['adname']}"  src="{Common::img($v['adsrc'],640,300)} "
                                 style="width:100%;">
                        </a>
                    </div>
                </div>
                {/loop}

            </div>
            <div class="swiper-pagination banner-swiper-pagination" id="bannerSwiperPagination"></div>
        </div>
        {else}
        <div class="banner">
            <img src="{Common::img($data['adsrc'],640,300)}" style="width:100%;">
        </div>
        {/if}
        {/st}
    </div>
    <div style="display: none" class="navbtns flex-div">
        {loop $category['classList'] $k $sub}
        <a class="navbtn flex-center" href="{$sub['url']}" style="width:20%;">
            <div>
                <div style="padding: 0 3vw;"><img class="lazy-img-loading" src="/phone/public/images/wechat/grey.gif" data-img="{$sub['img']}" data-type="2" width="100%"></div>
                <div class="navbtn-name">{$sub['title']}</div>
            </div>
        </a>
        {/loop}
    </div>


    <div class="navbtns flex-div" style="display:none;">
        <a class="navbtn flex-center" href="#" style="width:25%;">
            <div>
                <div class="navbtn-icon"><img class="lazy-img-loading" src="/phone/public/images/wechat/grey.gif" data-img="/phone/public/images/wx/v4/list/home_hiking.png" data-type="2" width="100%"></div>
                <div class="navbtn-name">本周活动</div>
            </div>
        </a>
        <a class="navbtn flex-center" href="#" style="width:25%;">
            <div>
                <div class="navbtn-icon"><img class="lazy-img-loading" src="/phone/public/images/wechat/grey.gif" data-img="/phone/public/images/wx/v4/list/home_hiking.png" data-type="2" width="100%"></div>
                <div class="navbtn-name">下周活动</div>
            </div>
        </a>
        <a class="navbtn flex-center" href="#" style="width:25%;">
            <div>
                <div class="navbtn-icon"><img class="lazy-img-loading" src="/phone/public/images/wechat/grey.gif" data-img="/phone/public/images/wx/v4/list/home_hiking.png" data-type="2" width="100%"></div>
                <div class="navbtn-name">特别线路</div>
            </div>
        </a>
    </div>
    {if !empty($cate_sub_data)}
    {loop $cate_sub_data $item}
    <div class="items">

        <div class="items-title flex-center">
            <span>{$item['title']}</span>
        </div>
        {if !empty($item['list'])}
        <div class="items-body">
            <div class="item">
                <div class="item-lines">
                    <div class="swiper-container item-lines-swiper">
                        <div class="swiper-wrapper">
                            {loop $item['list']  $e $row}
                            {if $e % 3==0 }
                            <div class="swiper-slide flex-single">
                                {php}
                                    for($d=$e;$d<=$e+2;$d++){
                                    if(!empty($item['list'][$d])){
                                {/php}
                                <a class="item-line" href="{$row['url']}">
                                    <div class="item-line-img lazy-img-loading" data-img="{$item['list'][$d]['litpic']}" data-type="1"></div>
                                    <div class="item-line-info">
                                        <div class="item-line-name">{$item['list'][$d]['title']}</div>
                                        <div class="item-line-other flex-single justify-between">
                                            <div class="item-line-time">{$item['list'][$d]['lineday']}天</div>
                                            <div class="item-line-money">{Currency_Tool::symbol()}{$item['list'][$d]['price']}</div>
                                        </div>
                                    </div>
                                </a>
                                {php}
                                } }
                                {/php}
                            </div>
                            {/if}
                            {/loop}
                        </div>
                        <div class="swiper-pagination item-swiper-pagination flex-center"></div>
                    </div>
                </div>
            </div>
        </div>
        {/if}
    </div>
    {/loop}
    {/if}
    <div class="items">
        <div class="items-title flex-center">
            <span>热门产品</span>
        </div>
        {if !empty($hot_line)}
        <div class="items-body">
            <div class="item">
                {loop $hot_line $row}
                <div class="item-top">
                    <div class="item-first-line-img lazy-img-loading" data-img="{$row['litpic']}" style="background-image: url({$row[litpic]});"></div>
                    <div class="item-line-info">
                        <div class="item-line-each flex-single justify-between">
                            <div class="item-first-line-name">{if $row['startcity']}【{$row['startcity']}】{/if}{$row['title']}</div>
                            <div class="item-line-btn">
                                <a href="{$row['url']}"><span style="color: #9b8ce5;">查看</span></a>
                                <img src="/phone/public/images/wechat/v4/right_g.png" style="height:0.8rem;">
                            </div>
                        </div>
                        <div class="item-line-each flex-single">
                            <div class="item-first-line-time" style="padding-right:1rem;">共{php} echo  count($row['times']) {/php}期</div>
                            <div class="item-first-line-money">最近一期: {date('m月d日',$row['times'][0])}</div>
                        </div>
                    </div>
                </div>
                {/loop}
            </div>
        </div>
        {/if}
    </div>
    <div class="list">
        <div class="list-title flex-center" style="padding-bottom:0;">
            <span>全部线路</span>
        </div>
        <div class="list-filters-seize">
            <div class="list-filters">
                <div class="flex-single justify-between">
                    <div class="list-filter flex-center" onclick="filter(this);" data-type="0">
                        类型<span>不限</span><div class="triangle"></div>
                    </div>
                    <div class="list-filter flex-center" onclick="filter(this);" data-type="1">
                        难度<span>不限</span><div class="triangle"></div>
                    </div>
                    <div class="list-filter flex-center" onclick="filter(this);" data-type="2">
                        天数<span>不限</span><div class="triangle"></div>
                    </div>
                    <div class="list-filter-content">
                        <div class="list-filter-bg" onclick="hideFilterContent(this);" data-type="0"></div>
                        <div class="list-fiter-title">类型选择</div>
                        <div class="list-filter-body flex-div">
                            <div class="list-filter-btn" onclick="selectedFilter(this);" data-type="0" data-search="">
                                <span>不限</span>
                            </div>
                            {loop $category['classList'] $row}
                            <div class="list-filter-btn" onclick="selectedFilter(this);" data-type="0" data-search="{$row['id']}">
                                <span>{$row['title']}</span>
                            </div>
                            {/loop}
                        </div>
                    </div>
                    <div class="list-filter-content">
                        <div class="list-filter-bg" onclick="hideFilterContent(this);" data-type="1"></div>
                        <div class="list-fiter-title">难度选择</div>
                        <div class="list-filter-body flex-div">
                            <div class="list-filter-btn" onclick="selectedFilter(this);" data-type="1" data-search="0">
                                <span>不限</span>
                            </div>
                            {loop $category['difficultyList'] $row}
                            <div class="list-filter-btn" onclick="selectedFilter(this);" data-type="1" data-search="{$row['id']}">
                                <span>{$row['title']}</span>
                            </div>
                            {/loop}
                        </div>
                    </div>
                    <div class="list-filter-content">
                        <div class="list-filter-bg" onclick="hideFilterContent(this);" data-type="2"></div>
                        <div class="list-fiter-title">天数选择</div>
                        <div class="list-filter-body flex-div">
                            <div class="list-filter-btn" onclick="selectedFilter(this);" data-type="2" data-search="0">
                                <span>不限</span>
                            </div>
                            {loop $category['dayList'] $row}
                            <div class="list-filter-btn" onclick="selectedFilter(this);" data-type="2" data-search="{$row['id']}">
                                <span>{$row['title']}</span>
                            </div>
                            {/loop}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-content">
            <div class="list-loading flex-center">
                <img src="/phone/public/images/wechat/loading2.gif" height="16">
            </div>
        </div>
    </div>

    <div id="homeBox">
        <a id="homeA" href="/phone"></a>
    </div>
</div>

</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
    var openId = "";

    //自适应字体，使用该Base样式不能使用px，必须是rem
    function setFontSize(){
        var fontSize = document.documentElement.clientWidth / 37.5; //10px作为1个rem
        if( fontSize > 10 ){
            fontSize = 10;
        }
        document.documentElement.style.fontSize = fontSize + 'px';
        $("body").show();
    }
    setFontSize();
    $(window).resize(function(){
        setFontSize();
    });
    function loadingMsg(msg, hidebg, time) {
        if (msg == undefined) {
            msg = 'loadingMsg error: msg undefined';
            hidebg = true;
            time = 1000;
        }
        $('.loading').html(msg);
        $('#loading').show();
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
        $('.loading').css('marginLeft', '-' + (document.querySelector('.loading').offsetWidth / 2) + 'px');
        if (!isNaN(time)) {
            hideLoading(time);
        }
    }
    function hideLoading(time) {
        setTimeout(function() {
            $('#loading').hide();
        }, time);
    }
</script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js"></script>

<script type="text/javascript" src="/phone/public/plugins/Swiper-4.1.0/js/swiper.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/timeInterval.js?v=3"></script>
<script type="text/javascript" src="/phone/public/js/wechat/v4/jq.lazy_loading_img.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/jquery.textSlider.js"></script>
<script type="text/javascript">


    var bannerSwiper = new Swiper("#bannerSwiper", {
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        loop : true,
        pagination: {
            el: "#bannerSwiperPagination",
        },
    })

    var itemSwipers = [];
    $(".item-lines-swiper").each(function(index, el) {
        var paginationId = "itemSwiperPagination"+index;
        $(this).find(".swiper-pagination").attr("id",paginationId);
        var itemSwiper = new Swiper(this, {
            pagination: {
                el: "#"+paginationId,
            },
            on: {
                slideChangeTransitionStart: function(){
                    $(this.el).find(".swiper-pagination-bullet").html("");
                },
                slideChangeTransitionEnd: function(){
                    $(this.el).find(".swiper-pagination-bullet.swiper-pagination-bullet-active").html( this.activeIndex + 1 );
                },
            },
        });
        $(itemSwiper.pagination.el).find(".swiper-pagination-bullet-active").html( itemSwiper.activeIndex + 1 );
        itemSwipers.push( itemSwiper );
    });

    var selectedLineSwipers = [];
    $(".selected-lines-swiper").each(function(index, el) {
        var selectLineSwiper = new Swiper(this, {
            slidesPerView: 'auto',
            on: {
                slideChangeTransitionStart: function(){
                    $(this.el).find(".swiper-pagination-bullet").html("");
                },
                slideChangeTransitionEnd: function(){
                    $(this.el).find(".swiper-pagination-bullet.swiper-pagination-bullet-active").html( this.activeIndex + 1 );
                },
            },
        });
        $(selectLineSwiper.pagination.el).find(".swiper-pagination-bullet-active").html( selectLineSwiper.activeIndex + 1 );
        selectedLineSwipers.push( selectLineSwiper );
    });

    if( $(".discount-surplus-time").length > 0 ){
        $(".discount-surplus-time").setTimeInterval({
            stopTime: $(".discount-surplus-time").data("stopTime"), //结束时间,2016/07/28 19:00:00
            showType: 2,
            //倒计时结束后的回调函数
            eachCallBack: function( times, element, minTime ){
                var html = getTimeHtml( times );
                $(element).html( html );
            },
            overTimeCallBack: function( element ){
                $(element).html('已结束');
            }
        });
    }

    function getTimeHtml( times ){
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
        var html = '<div class="discount-desc">距结束:</div>';
        for(i=0;i<times.hour.length;i++){
            html += '<div class="discount-time flex-center">'+ times.hour.charAt(i) +'</div>';
        }
        html += '<div class="discount-dou flex-center">:</div>';
        for(i=0;i<times.minute.length;i++){
            html += '<div class="discount-time flex-center">'+ times.minute.charAt(i) +'</div>';
        }
        html += '<div class="discount-dou flex-center">:</div>';
        for(i=0;i<times.second.length;i++){
            html += '<div class="discount-time flex-center">'+ times.second.charAt(i) +'</div>';
        }
        return html;
    }

    $(document).ready(function() {
        searchList();
        $(window).scroll(function () {
            var scrollTop = $(window).scrollTop();
            var listFiltersTop = $(".list-filters-seize").offset().top;
            if( scrollTop >= listFiltersTop ){
                $(".list-filters").addClass("fixed-top");
            }else{
                $(".list-filters").removeClass("fixed-top");
            }
        });
    });

    function filter( e ){
        $(".list-filter-content").each(function(index, el) {
            if( $(this).find(".list-filter-btn.selected").length <= 0 ){
                $(".list-filter").eq( index ).removeClass("selected");
            }
        });
        $(e).addClass("selected");
        var type = $(e).data("type");
        $(".list-filter-content").hide();
        $(".list-filter-content").eq( type ).slideDown();

    }

    function selectedFilter( e ){
        $(window).scrollTop( $(".list-filters-seize").offset().top );
        var type = $(e).data("type");
        var btns = $(".list-filter-content").eq( type ).find(".list-filter-btn");
        btns.removeClass("selected");
        $(e).addClass("selected");
        var search = $(e).data("search");
        if( search == "" || search == 0 || search == 0 ){
            $(".list-filter").eq( type ).removeClass("selected");
        }
        $(".list-filter").eq( type ).find("span").html( $(e).html() );
        hideFilterContent( e );
        searchList();
    }

    function hideFilterContent( e ){
        var type = $(e).data("type");
        $(".list-filter-content").eq( type ).slideUp();
        var btns = $(".list-filter-content").eq( type ).find(".list-filter-btn.selected");
        if( btns.length <= 0 ){
            $(".list-filter").eq( type ).removeClass("selected");

        }
    }

    var difficultTexts = {
        '1': '休闲深度',
        '1.5': '轻松徒步',
        '2': '稍有难度',
        '3': '中等难度',
        '4': '较高难度',
    };
    function searchList(){
        var name = '';
        var difficult = 0;
        var day = 0;
        $(".list-filter-content").each(function(index, el) {
            var selectedObj = $(this).find(".list-filter-btn.selected");
            if( selectedObj.length > 0 ){
                var type = selectedObj.data("type");
                switch( type ){
                    case 0:
                        name = selectedObj.data("search");
                        break;
                    case 1:
                        difficult = selectedObj.data("search");
                        break;
                    case 2:
                        day = selectedObj.data("search");
                        break;
                }
            }
        });
        $(".list-content").html('<div class="list-loading flex-center"><img src="/phone/public/images/wechat/loading2.gif" height="16"></div>');
        $.ajax({
            url: '/phone/line/ajax_line',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                difficult: difficult,
                day: day,
                distance: 1,
                style: 1,
                person_count: 1,
                theme_id:1
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                $(".list-loading").remove();
                if( getdata.status == 1 ){
                    var addHtml = '';
                    $.each(getdata.list, function(index, val) {
                        addHtml += '<a class="search-line flex-single" href="'+ val.url +'">';
                        addHtml +=     '<div class="search-img lazy-img-loading" data-img="'+ val.small_imageurl_s +'" data-type="1"></div>';
                        addHtml +=     '<div class="search-line-info">';
                        addHtml +=         '<div class="search-line-name">'+ val.activity_name +'</div>';
                        addHtml +=         '<div class="search-line-times">排期（'+ val.times.length +'期），最近一期：'+ val.times[0].startTime +'</div>';
                        addHtml +=         '<div class="search-line-other flex-start">';
                        addHtml +=             '<div class="search-line-day">'+ val.person_count +'人去过</div>';
                        addHtml +=         '</div>';
                        addHtml +=         '<div class="search-line-other flex-start">';
                        addHtml +=            '<div class="starts-container"><p class="grade-star"><span><em></em><b><i style=" width:'+val.stars*20+'%"></i></b></span></p>  '+val.satisfyscore+'星'+"</div>";
                        addHtml +=         '</div>';
                        addHtml +=     '</div>';
                        addHtml += '</a>';
                    });
                    $(".list-content").html( addHtml );
                    doLazyLoadingImg($(window).scrollTop());
                }else{
                    $(".list-content").html('<div class="error-list" onclick="searchList();">查找失败，点击重新查找</div>')
                }
            })
            .fail(function() {
                // console.log("error");
                $(".list-loading").remove();
                $(".list-content").html('<div class="error-list" onclick="searchList();">查找失败，点击重新查找</div>')
            });
    }

    function initDate( time ){
        console.log(time);
        var now = new Date(time*1000);
        console.log(now);
        var   year=now.getFullYear();
        var   month=now.getMonth()+1;
        console.log(month);
        var   date=now.getDate();
        return   month+"月"+date+"日";
    }

</script>

</html>