<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>分类</title>
    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/full_content.css?v=14">
    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/full_base.css?v=24">
    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=110">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/nav.css">
</head>
<body >

<!-- 主要内容 -->
<div class="container" id="container"></div>

{request "pub/code"}
{request "pub/footer/curnav/$curnav"}



<style type="text/css">
    .show-home{
        display: none;
        position: fixed;
        right: 15px;
        bottom: 15px;
        z-index: 3;
    }
</style>
<!-- 单页插件CSS -->
<link rel="stylesheet" type="text/css" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css">
<!-- 单页插件JS -->
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js" ></script>
<script type="text/javascript">
    //设置全局变量
    <?php if (json_encode($category['classList'])){ ?>
    var classList  = <?php echo json_encode($category['classList']) ?>;
    <?php }else{ ?>
    var classList  = [];
    <?php } ?>

    <?php if (json_encode($category['difficultyList'])){ ?>
    var difficultyList  = <?php echo json_encode($category['difficultyList']) ?>;
    <?php }else{ ?>
    var difficultyList  = [];
    <?php } ?>

    <?php if (json_encode($category['dayList'])){ ?>
    var dayList  = <?php echo json_encode($category['dayList']) ?>;
    <?php }else{ ?>
    var dayList  = [];
    <?php } ?>

    var nearsList      = [];
    <?php if (json_encode($destinations['inlandList'])){ ?>
    var inlandList  = <?php echo json_encode($destinations['inlandList']) ?>;
    <?php }else{ ?>
    var inlandList  = [];
    <?php } ?>

    <?php if (json_encode($destinations['international'])){ ?>
    var international  = <?php echo json_encode($destinations['international']) ?>;
    <?php }else{ ?>
    var international  = [];
    <?php } ?>

</script>


<script type="text/html" id="tpl_home"> <!-- 必须，指定模板ID，以tpl_开头 -->
    <div class="page"> <!-- 必须DIV，指定page -->

        <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list_home.css?v=5">
        {if $category['classList']}
        <div class="index-list">
            <div class="list-title">花样撒野</div>
            <div class="list-content">
                {loop $category['classList'] $k $sub}
                <div class="class pull-left">
                    <a class="page-a" href="#nav/1/{$k}" data-js-id="{$sub['id']}" data-id="{$sub['id']}" data-share-title="{$sub['share_title']}" data-share-desc="{$sub['share_desc']}" data-share-img-url="{Common::img($sub['litpic'],185,120)}" data-share-url="#" >
                        <div class="class-img">
                            <img src="{$sub['img']}" style="width:60%;">
                        </div>
                        <div class="class-title">{$sub['title']}</div>
                    </a>
                </div>
                {/loop}
                <div class="clear"></div>
            </div>
        </div>
        {/if}
        {if $category['difficultyList']}
        <div class="index-list">
            <div class="list-title">探索难度</div>
            <div class="list-content">
                {loop $category['difficultyList'] $k $sub}
                <div class="class pull-left">
                    <a class="page-a" href="#nav/2/{$k}" data-js-id="{$sub['id']}" data-id="{$sub['id']}" data-share-title="{$sub['share_title']}" data-share-desc="{$sub['share_desc']}" data-share-img-url="{Common::img($sub['litpic'],185,120)}" data-share-url="#" >
                        <div class="class-img">
                            <img src="{$sub['img']}" style="width:60%;">
                        </div>
                        <div class="class-title">{$sub['title']}</div>
                    </a>
                </div>
                {/loop}
                <div class="clear"></div>
            </div>
        </div>
        {/if}
        {if $category['dayList']}
        <div class="index-list">
            <div class="list-title">时间跨度</div>
            <div class="list-content">
                {loop $category['dayList'] $k $sub}
                <div class="class pull-left">
                    <a class="page-a" href="#nav/3/{$k}" data-js-id="{$sub['id']}" data-id="{$sub['id']}" data-share-title="{$sub['share_title']}" data-share-desc="{$sub['share_desc']}" data-share-img-url="{Common::img($sub['litpic'],185,120)}" data-share-url="#" >
                        <div class="class-img">
                            <img src="{$sub['img']}" style="width:60%;">
                        </div>
                        <div class="class-title">{$sub['title']}</div>
                    </a>
                </div>
                {/loop}
                <div class="clear"></div>
            </div>
        </div>
        {/if}
        {if $destinations['inlandList'] || $destinations['inlandList']}
        <!-- 发现目的地 -->
        <div class="index-list">
            <div class="list-title">发现目的地</div>
            <div class="list-content">
                {if $destinations['inlandList']}
                <div class="destination-list">
                    <div class="destination-title">
                        <div>境内游</div>
                        <div class="title-line"><div></div></div>
                    </div>
                    <div class="destination-content">
                        {loop $destinations['inlandList'] $k $sub}
                        <div class="destination pull-left">
                            <a class="page-a" onclick="statAndJump(this);" data-stat="100041" data-id="{$sub['id']}" data-url="#list/4/{$k}" data-share-title="{$sub['share_title']}" data-share-desc="{$sub['share_desc']}" data-share-img-url="{$sub['img']}">
                                <div style="padding:0 5px;">
                                    <div class="destination-img" style="background-image:url({$sub['img']});">
                                        <div class="destination-name">{$sub['title']}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {/loop}
                        <div class="clear"></div>
                    </div>
                </div>
                {/if}
                {if $destinations['international']}
                <div class="destination-list">
                    <div class="destination-title">
                        <div>境外游</div>
                        <div class="title-line"><div></div></div>
                    </div>
                    <div class="destination-content">
                        {loop $destinations['international'] $k $sub}
                        <div class="destination pull-left">
                            <a class="page-a" onclick="statAndJump(this);" data-stat="100041" data-id="{$sub['id']}" data-url="#list/5/{$k}" data-share-title="{$sub['share_title']}" data-share-desc="{$sub['share_desc']}" data-share-img-url="{$sub['img']}">
                                <div style="padding:0 5px;">
                                    <div class="destination-img" style="background-image:url({$sub['img']});">
                                        <div class="destination-name">{$sub['title']}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {/loop}
                    </div>
                </div>
                {/if}
            </div>
        </div>
        {/if}

        <script type="text/javascript">

            //设置title
            page.setTitle(0,"分类");

            function updateImgHeight(){
                //计算目的地图片高度
                var destinationImgWidth = ( $(window).width() - 60 ) / 3;
                var destinationImgHeight = destinationImgWidth / 190 * 200;
                $(".destination-img").css("height", destinationImgHeight+"px");
            }
            updateImgHeight();
            //屏幕宽度改变时再调整
            $(document).ready(function() {
                window.onresize=function(){
                    updateImgHeight();
                };
            });

            function statAndJump( e ){
                window.location.href = $(e).data("url");
            }

</script>

</div>
</script>
<script type="text/html" id="tpl_nav">
    <div class="page">

    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list_list.css?v=8">
    <style type="text/css">
.class-list{
    background-color: transparent;
}
.class-top-tabs{
    width: 100%;
    background-color: #fff;
    padding: 10px;
    padding-bottom: 0;
}
.class-top-tab{
    width: 20%;
    text-align: center;
    margin-bottom: 10px;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
}
.class-name{
    font-size: 12px;
    color: #333;
    border: 1px solid #fff;
    border-radius: 4px;
    padding: 5px 0;
}
.class-top-tab.active .class-name{
    border-color: rgba(155,140,229, 0.9);
    color: rgba(155,140,229, 0.9);
}
.has-icon .class-name{
    border: 0;
    border-radius: 0;
    display: inline-block;
    border-bottom: 1px solid #fff;
}
.has-icon.active .class-name{
    border: 0;
    border-radius: 0;
    display: inline-block;
    border-bottom: 1px solid rgba(155,140,229, 0.9);
}
.class-contents{
    position: static;
    left: auto;
    top: auto;
    margin-top: 10px;
    background-color: #fff;
}
.class-swiper{
    overflow: hidden;
}
.swiper-wrapper{
    background-color: #fff
}
.class-icon img{
    min-height: 36px;
}
.class-activity-img{
    min-height: 140px;
    background-color: #ddd;
}
</style>

<div id="classList" class="class-list" style="display:none;">
    <div class="class-top-tabs" id="classTopTabs"></div>
    <div class="class-contents" id="classContents" style="padding:0;">
    </div>
    </div>

    <script type="text/javascript">


//拆分地址，去#及之后的，再通过/分组，第一个参数为锚点，后面为参数
var thisUrl = window.location.href;
var anchorStr = thisUrl.substring( thisUrl.indexOf("#") );
var anchorArr = anchorStr.split('/');
var anchorParameters = {};

$.each(anchorArr, function(index, val) {
    switch( index ){
        case 1:
            anchorParameters['showType'] = parseInt( val );
            break;
        case 2:
            anchorParameters['showClass'] = parseInt( val );
    }
});
//显示对应的TAB列表，设置title
var tabDatas = [];
var pageTitle = '';
var startJsId = 0;
switch( anchorParameters['showType'] ){
    case 1:
        tabDatas = classList;
        pageTitle = "花样撒野";
        startJsId = 21;
        break;
    case 2:
        tabDatas = difficultyList;
        pageTitle = "探索难度";
        startJsId = 31;
        break;
    case 3:
        tabDatas = dayList;
        pageTitle = "时间跨度";
        startJsId = 36;
        break;
}
page.setTitle( 1, pageTitle );

var mySwiper;
function setBaseHtml(){
    var tabsHtml = '';
    var contentsHtml = '';
    var topTabsRow = Math.ceil( tabDatas.length / 5 );
    $.each(tabDatas, function(index, tabData) {
        //tabHtml
        tabsHtml += '<div class="class-top-tab '+ ( topTabsRow == 1 ? 'has-icon':'' ) +' pull-left" onclick="changeListTab('+ index +');" data-js-id="'+ startJsId +'" data-search="'+ tabData['search'] +'" data-id="'+ tabData['id'] +'" data-share-title="'+ tabData['share_title'] +'" data-share-desc="'+ tabData['share_desc'] +'" data-share-img-url="'+ tabData['img'] +'">';
        if( topTabsRow == 1 ){
            tabsHtml +=     '<div class="class-icon"><img src="'+ tabData['img'] +'" style="width:60%;"></div>';
        }
        tabsHtml +=     '<div class="class-name">'+ tabData['title'] +'</div>';
        tabsHtml += '</div>';
        // tabsHtml += '<div class="class-tab" onclick="changeListTab('+ index +');" data-search="'+ tabData['search'] +'" data-share-title="'+ tabData['share_title'] +'" data-share-desc="'+ tabData['share_desc'] +'" data-id="'+ tabData['id'] +'" data-share-img-url="'+ tabData['img'] +'">'+ tabData['title'] +'</div>';
        startJsId++;
    });
    tabsHtml += '<div class="clear"></div>';
    //滑块html
    contentsHtml += '<div class="class-swiper swiper-containe" id="classSwiper">';
    contentsHtml +=     '<div class="swiper-wrapper">';
    $.each(tabDatas, function(index, tabData) {
        contentsHtml +=     '<div class="swiper-slide" data-tab="'+ index +'">';
        contentsHtml +=         '<div class="page-loading" style="padding:10px 0;">';
        contentsHtml +=             '<img src="/phone/public/images/wechat/loading2.gif" style="height:14px;">&nbsp;';
        contentsHtml +=             '<span>loading</span>';
        contentsHtml +=         '</div>';
        contentsHtml +=         '<div class="class-content-main">';
        contentsHtml +=             '<div class="class-content-body"></div>';
        contentsHtml +=         '</div>';
        contentsHtml +=     '</div>';
    });
    contentsHtml +=     '</div>';
    contentsHtml += '</div>';
    $("#classTopTabs").html( tabsHtml );
    // $("#classTabsMain").html( tabsHtml );
    $("#classContents").html( contentsHtml );
    //设置滑块
    mySwiper = new Swiper("#classSwiper", {
        width: $(window).width(),
        autoHeight: true, //enable auto height
        onSlideChangeEnd: function(swiper){
            var isSlideEnd = 1;
            changeListTab( swiper.activeIndex, isSlideEnd );
        },
    });
}
setBaseHtml();

var classContentMainHeight = 0;
function updateListHeight(){
    var windowHeight = $(window).height();
    var windowWidth = $(window).width();
    var topHeight = $(".topBar").height();
    var classTopTabRow = Math.ceil( tabDatas.length / 5 );
    if( classTopTabRow == 1 ){
        var navHeight = ( windowWidth * 0.2 * 0.6 + 39 ) * classTopTabRow + 10;
    }else{
        var navHeight = 39 * classTopTabRow + 10;
    }
    var listHeight = windowHeight - topHeight - navHeight - 10;
    $(".class-list").css('height',listHeight+"px");
    $(".class-tabs-main").css('height',listHeight+"px");
    classContentMainHeight = listHeight;
    $(".class-content-main").css('height',classContentMainHeight+"px");
    $('#classSwiper').css('height',classContentMainHeight+"px");
    $("#classList").show();
}
updateListHeight();

var showListTab = 0; //当前显示的tab
//分类首页跳转
if( parseInt( anchorParameters['showClass'] ) >= 0 ){
    showListTab = anchorParameters['showClass'];
}
// var tabPages = {}; //添加每个tab的分页数
// var pageEndTabs = []; //每个tab的分页结束判断
var isGetDataTabs = []; //已经获取数据的tab
$("#classTopTabs .class-top-tab").each(function(index, el) {
    // tabPages[index] = 0;
    // pageEndTabs[index] = false;
    isGetDataTabs[index] = false;
});
//tab切换
function changeListTab( tabNum, isSlideEnd ){
    // var jsId = $("#classTopTabs .class-top-tab").eq( tabNum ).data("jsId");
    // if( jsId != undefined && jsId > 0 ){
    // }
    showListTab = tabNum;
    $("#classTopTabs .class-top-tab").removeClass("active");
    $("#classTopTabs .class-top-tab").eq( tabNum ).addClass("active");
    // $("#classList .class-content").removeClass("active");
    // $("#classList .class-content").eq( tabNum ).addClass("active");
    getPage( tabNum );
    //重置分享分案
    // var linkArr = thisUrl.split("#");
    var thisShareLink = "#"+tabNum;
    page.setShare( 1, $("#classTopTabs .class-top-tab").eq( tabNum ).data("shareTitle"), $("#classTopTabs .class-top-tab").eq( tabNum ).data("shareDesc"), $("#classTopTabs .class-top-tab").eq( tabNum ).data("shareImgUrl"), thisShareLink );
    if( isSlideEnd != 1 ){
        mySwiper.slideTo(tabNum, 400, false);
    }
}
changeListTab( showListTab ); //初始tab显示

//获取分页数据
// var pageLimit = 5;
// var pageGeting = false;
function getPage( tabNum ){
    // if( pageGeting ){
    //     return false;
    // }
    // pageGeting = true;
    // var page = tabPages[tabNum];
    // var pageEnd = pageEndTabs[tabNum];
    // if( pageEnd ){
    //     pageGeting = false;
    //     return false;
    // }
    if( isGetDataTabs[tabNum] ){
        return false;
    }
    isGetDataTabs[tabNum] = true;
    var data = {};
    console.log(data);
    data['id']=$("#classTopTabs .class-top-tab").eq( tabNum ).data('id');
    //ajax获取数据
    $("#classSwiper .swiper-slide").eq( tabNum ).find(".page-loading img").show();
    $("#classSwiper .swiper-slide").eq( tabNum ).find(".page-loading span").html("loading");
    $("#classSwiper .swiper-slide").eq( tabNum ).find(".page-loading").show();
    $.ajax({
        type: 'POST',
        url: '/phone/linecate/ajax_classify',
        data: data,
        dataType: 'json',
        success: function(getdata){
            // if( getdata.status == 1 ){
            if( getdata.list.length <= 0 && getdata.old_list.length <= 0 ){
                $(".page-loading img").hide();
                $(".page-loading span").html("活动规划中");
                $(".page-loading span").css("color","red");
            }else{
                $("#classSwiper .swiper-slide").eq( tabNum ).find(".page-loading").hide();
                var addHtml = '';
                $.each(getdata.list, function(index, activity) {
                    addHtml += getEachHtml( activity, 1 );
                });
                if( getdata.old_list.length > 0 ){
                    addHtml += '<div class="no-notice-border"></div><div class="no-notice"><div>以下线路正在规划中</div></div>';
                }
                $.each(getdata.old_list, function(index, oldActivity) {
                    addHtml += getEachHtml( oldActivity, 2 );
                });
                $("#classList .class-content-main").eq( tabNum ).find(".class-content-body").html( addHtml );
                // tabPages[tabNum]++;
            }
        },
        error: function(xhr, type){
            $("#classSwiper .swiper-slide").eq( tabNum ).find(".page-loading img").hide();
            $("#classSwiper .swiper-slide").eq( tabNum ).find(".page-loading span").html("请求失败，请刷新");
            // pageGeting = false;
        }
    })
}

//获取每块数据
function getEachHtml( data, type ){
    var addHtml = '';
    addHtml +=     '<div class="class-activity" style="width:100%;">';
    addHtml +=         '<a href="'+ data['url'] +'">';
    addHtml +=             '<div>';
    addHtml +=                 '<img class="class-activity-img" src="'+ data['imageurl_s'] +'">';
    if( type == 1 ){
        addHtml +=             '<div class="class-activity-money">'+ data['money_f'] +'</div>';
    }
    addHtml +=             '</div>';
    addHtml +=             '<div class="activit-name">'+ data['activity_name'] +'</div>';
    addHtml +=             '<div class="activity-info">';
    if( type == 1 ){
        var dataStr = '';
        $.each(data['times'], function(index, time) {
            var dateArr = time.toString().initDate();
            dataStr += ', ' + parseInt( dateArr['M'] ) + '月' + parseInt( dateArr['D'] ) + '日';
        });
        addHtml +=                 '共'+ dataStr.length+'期, ';
        addHtml +=                 '出发日期:'+ dataStr.substring(2);
    }else{
        addHtml +=                 '查看往期';
    }
    addHtml +=             '</div>';
    addHtml +=         '</a>';
    addHtml +=     '</div>';
    return addHtml;
}

//监听内容滚动到底部，加载分页
// var windowHeight = $(window).height();
// $(document).ready(function() {
//     $(".class-content-main").each(function(index, el) {
//         $(this).scroll(function () {
//             var showTabHeight = $(this).find(".class-content-body").height();
//             if( $(this).scrollTop() + windowHeight >= showTabHeight - 20 ){
//                 getPage( showListTab );
//             }
//         });
//     });
// });

</script>

</div>
</script>
<script type="text/html" id="tpl_list"> <!-- 必须，指定模板ID，以tpl_开头 -->
    <div class="page"> <!-- 必须DIV，指定page -->

    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list_list.css?v=8">

    <div id="classList" class="class-list" style="display:none;">
    <div class="class-tabs">
    <div class="class-tabs-main" id="classTabsMain">
    </div>
    </div>
    <div class="page-loading">
    <img src="/phone/public/images/wechat/loading2.gif" style="height:14px;">
    <span>loading</span>
    </div>
    <div class="class-contents" id="classContents">
    </div>
    </div>

    <script type="text/javascript">


//拆分地址，去#及之后的，再通过/分组，第一个参数为锚点，后面为参数
var thisUrl = window.location.href;
var anchorStr = thisUrl.substring( thisUrl.indexOf("#") );
var anchorArr = anchorStr.split('/');
var anchorParameters = {};

$.each(anchorArr, function(index, val) {
    switch( index ){
        case 1:
            anchorParameters['showType'] = parseInt( val );
            break;
        case 2:
            anchorParameters['showClass'] = parseInt( val );
    }
});

//设置title
var pageTitle = '';
switch( anchorParameters['showType'] ){
    case 1:
        pageTitle = "花样撒野";
        break;
    case 2:
        pageTitle = "探索难度";
        break;
    case 3:
        pageTitle = "时间跨度";
        break;
    case 4:
        pageTitle = "境内游";
        break;
    case 5:
        pageTitle = "境外游";
        break;
}
page.setTitle( 1, pageTitle );

//显示对应的TAB列表
var tabDatas = [];
var startJsId = 0;
switch( anchorParameters['showType'] ){
    case 1:
        tabDatas = classList;
        startJsId = 21;
        break;
    case 2:
        tabDatas = difficultyList;
        startJsId = 31;
        break;
    case 3:
        tabDatas = dayList;
        startJsId = 36;
        break;
    case 4:
        tabDatas = inlandList;
        break;
    case 5:
        tabDatas = international;
        break;
    default:
        anchorParameters['showType'] = 1; //设置默认值为花样撒野
        tabDatas = classList;
        break;
}

function setBaseHtml(){
    var tabsHtml = '';
    var contentsHtml = '';
    $.each(tabDatas, function(index, tabData) {
        tabsHtml += '<div class="class-tab" onclick="changeListTab('+ index +');" '+ ( anchorParameters['showType'] != 4 && anchorParameters['showType'] == 5 ? 'data-js-id="'+ startJsId +'"' : '' ) +' data-search="'+ tabData['search'] +'" data-share-title="'+ tabData['share_title'] +'" data-id="'+ tabData['id'] +'" data-share-desc="'+ tabData['share_desc'] +'" data-share-img-url="'+ tabData['img'] +'">'+ tabData['title'] +'</div>';
        contentsHtml += '<div class="class-content"><div class="class-content-main"><div class="class-content-body"></div></div></div>';
        startJsId++;
    });
    $("#classTabsMain").html( tabsHtml );
    $("#classContents").html( contentsHtml );
}
setBaseHtml();

var classContentMainHeight = 0;
function updateListHeight(){
    var windowHeight = $(window).height();
    var topHeight = $(".topBar").height();
    var listHeight = windowHeight - topHeight;
    $(".class-list").css('height',listHeight+"px");
    $(".class-tabs-main").css('height',listHeight+"px");
    classContentMainHeight = listHeight - 10;
    $(".class-content-main").css('height',classContentMainHeight+"px");
    $("#classList").show();
}
updateListHeight();

var showListTab = 0; //当前显示的tab
//分类首页跳转
if( parseInt( anchorParameters['showClass'] ) >= 0 ){
    showListTab = anchorParameters['showClass'];
}
// var tabPages = {}; //添加每个tab的分页数
// var pageEndTabs = []; //每个tab的分页结束判断
var isGetDataTabs = []; //已经获取数据的tab
$("#classList .class-tab").each(function(index, el) {
    // tabPages[index] = 0;
    // pageEndTabs[index] = false;
    isGetDataTabs[index] = false;
});
//tab切换
function changeListTab( tabNum ){
    showListTab = tabNum;
    $("#classList .class-tab").removeClass("active");
    $("#classList .class-tab").eq( tabNum ).addClass("active");
    $("#classList .class-content").removeClass("active");
    $("#classList .class-content").eq( tabNum ).addClass("active");
    getPage( tabNum );
    //重置分享分案
    // var linkArr = thisUrl.split("#");
    var thisShareLink = "#"+tabNum;
    page.setShare( 1, $("#classList .class-tab").eq( tabNum ).data("shareTitle"), $("#classList .class-tab").eq( tabNum ).data("shareDesc"), $("#classList .class-tab").eq( tabNum ).data("shareImgUrl"), thisShareLink );
}
changeListTab( showListTab ); //初始tab显示
//滚动TAB到显示的那个
$("#classTabsMain").scrollTop( $(".class-tab.active").offset().top );

//获取分页数据
// var pageLimit = 5;
// var pageGeting = false;
function getPage( tabNum ){
    // if( pageGeting ){
    //     return false;
    // }
    // pageGeting = true;
    // var page = tabPages[tabNum];
    // var pageEnd = pageEndTabs[tabNum];
    // if( pageEnd ){
    //     pageGeting = false;
    //     return false;
    // }
    if( isGetDataTabs[tabNum] ){
        return false;
    }
    isGetDataTabs[tabNum] = true;
    var data = {};
    data['id'] = $("#classList .class-tab").eq( tabNum ).data('id');
    //ajax获取数据
    $(".page-loading img").show();
    $(".page-loading span").html("loading");
    $(".page-loading").show();
    $.ajax({
        type: 'POST',
        url: '/phone/linecate/ajax_line_by_city',
        data: data,
        dataType: 'json',
        success: function(getdata){
            //console.log(getdata);
            // if( getdata.status == 1 ){
            if( getdata.list.length <= 0 && getdata.old_list.length <= 0 ){
                $(".page-loading img").hide();
                $(".page-loading span").html("活动规划中");
                $(".page-loading span").css("color","red");
            }else{
                $(".page-loading").hide();
                // if( activitys.length < pageLimit ){
                //     pageEndTabs[tabNum] = true;
                // }
                var addHtml = '';
                $.each(getdata.list, function(index, activity) {
                    addHtml += getEachHtml( activity, 1 );
                });
                if( getdata.old_list.length > 0 ){
                    addHtml += '<div class="no-notice-border"></div><div class="no-notice"><div>以下线路正在规划中</div></div>';
                }
                $.each(getdata.old_list, function(index, oldActivity) {
                    addHtml += getEachHtml( oldActivity, 2 );
                });
                $("#classList .class-content-main").eq( tabNum ).find(".class-content-body").html( addHtml );
                // tabPages[tabNum]++;
            }
            // }else{
            //     $(".page-loading img").hide();
            //     $(".page-loading span").html("没有数据");
            // }
            // pageGeting = false;
        },
        error: function(xhr, type){
            $(".page-loading img").hide();
            $(".page-loading span").html("请求失败，请刷新");
            // pageGeting = false;
        }
    })
}

//获取每块数据
function getEachHtml( data, type ){
    var addHtml = '';
    addHtml +=     '<div class="class-activity" style="width:100%;">';
    addHtml +=         '<a href="'+ data['url'] +'">';
    addHtml +=             '<div>';
    addHtml +=                 '<img class="class-activity-img" src="'+ data['imageurl_s'] +'">';
    if( type == 1 ){
        addHtml +=             '<div class="class-activity-money">'+ data['money_f']+'</div>';
    }
    addHtml +=             '</div>';
    addHtml +=             '<div class="activit-name">'+ data['activity_name'] +'</div>';
    addHtml +=             '<div class="activity-info">';
    if( type == 1 ){
        var dataStr = '';
        $.each(data['times'], function(index, time) {
            var dateArr = time.toString().initDate();
            dataStr += ', ' + parseInt( dateArr['M'] ) + '月' + parseInt( dateArr['D'] ) + '日';
        });
        addHtml +=                 '共'+ dataStr.length+'期, ';
        addHtml +=                 '出发日期:'+ dataStr.substring(2);
    }else{
        addHtml +=                 '查看往期';
    }
    addHtml +=             '</div>';
    addHtml +=         '</a>';
    addHtml +=     '</div>';
    return addHtml;
}

</script>

</div>
</script>
<script type="text/html" id="tpl_more"> <!-- 必须，指定模板ID，以tpl_开头 -->
    <div class="page"> <!-- 必须DIV，指定page -->

    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list_more.css?v=9">

    <div class="page-loading">
    <img src="/phone/public/images/wechat/loading2.gif" style="height:14px;">
    <span>loading</span>
    </div>

    <div class="page-body">
    <!-- <div class="list-content">
    <div class="item-title">
    <div>周边热门</div>
    <div class="title-line"><div></div></div>
</div>
<div class="item-list" id="hotList"></div>
    </div> -->
    <div class="list-content">
    <div class="item-title">
    <div>周边全部</div>
    <div class="title-line"><div></div></div>
</div>
<div class="item-list" id="list"></div>
    </div>
    <div class="list-content" style="padding-bottom:47px;">
    <div class="item-title">
    <div>以下线路暂无活动</div>
    <div class="title-line"><div></div></div>
</div>
<div class="item-list" id="oldList"></div>
    </div>
    <div class="bottom-btn">
    <a onclick="showMoreSearch();">
    筛选
    <img src="/phone/public/images/wechat/v4/shaixuan2.png" style="height:16px; margin-bottom:2px;">
    </a>
    </div>
    <div class="search-bg" onclick="hideMoreSearch();"></div>
    <div class="more-search-list search-list">
    <div class="search-content">
    <div class="search-sub-title" style="border:0;">类型</div>
    <div class="search-main">
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="1" data-search="美食">
    <span>美食</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="1" data-search="休闲">
    <span>休闲</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="1" data-search="徒步">
    <span>徒步</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="1" data-search="登山">
    <span>登山</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="1" data-search="亲子">
    <span>亲子</span>
    </a>
    <div class="clear"></div>
    </div>
    <div class="search-sub-title">难度</div>
    <div class="search-main">
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="2" data-search="1" style="width:33.33%;">
    <span>休闲深度</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="2" data-search="1.5" style="width:33.33%;">
    <span>轻松徒步</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="2" data-search="2" style="width:33.33%;">
    <span>稍有难度</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="2" data-search="3" style="width:33.33%;">
    <span>中等难度</span>
    </a>
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="2" data-search="4" style="width:33.33%;">
    <span>较高难度</span>
    </a>
    <div class="clear"></div>
    </div>
    <div class="search-sub-title">天数</div>
    <div class="search-main">
    <a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="3" data-search="1">
    <span>1天</span>
</a>
<a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="3" data-search="2">
    <span>2天</span>
</a>
<a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="3" data-search="3">
    <span>3天</span>
</a>
<a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="3" data-search="4">
    <span>4~6天</span>
</a>
<a class="search-item more-search-item" onclick="addMoreSearchItem(this);" data-type="3" data-search="7">
    <span>7天以上</span>
</a>
<div class="clear"></div>
    </div>
    <div class="search-btns">
    <a class="search-btn" onclick="removeMoreSearch();">重置</a>
    <a class="search-btn" href="#search" onclick="hideMoreSearch();" id="moreSearchBtn">确定</a>
    <div class="clear"></div>
    </div>
    </div>
    </div>
    </div>

    <script type="text/javascript">


    page.setTitle(1,"更多目的地");

function updateMoreImgHeight(){
    //计算目的地图片高度
    var destinationImgWidth = ( $(window).width() - 60 ) / 3;
    var destinationImgHeight = destinationImgWidth / 190 * 200;
    $(".destination-img").css("height", destinationImgHeight+"px");
}

//屏幕宽度改变时再调整
$(document).ready(function() {
    window.onresize=function(){
        updateMoreImgHeight();
    };
});

function showMoreSearch(){
    //绑定页面不允许滚动
    $('body').bind('touchmove', function (event) {
        event.preventDefault();
    });
    $(".more-search-list").addClass("search-show");
    $(".more-search-list").addClass("slideIn");
    $(".more-search-list").on('animationend webkitAnimationEnd', function(){
        $(".search-bg").show();
        $(".more-search-list").removeClass("slideIn").addClass("search-show");
    });
}

var moreClass = "";
var moreDifficulty = "";
var moreDay = "";
function addMoreSearchItem( obj ){
    var search = $(obj).data("search");
    var type = $(obj).data("type");
    var isChecked = false;
    switch( type ){
        case 1:
            if( search == moreClass ){
                isChecked = true;
                moreClass = "";
            }else{
                moreClass = search;
            }
            break;
        case 2:
            if( search == moreDifficulty ){
                isChecked = true;
                moreDifficulty = "";
            }else{
                moreDifficulty = search;
            }
            break;
        case 3:
            if( search == moreDay ){
                isChecked = true;
                moreDay = "";
            }else{
                moreDay = search;
            }
            break;
    }
    if( isChecked ){
        $(obj).removeClass("active");
        $(obj).find("img").remove();
    }else{
        $(obj).parent().find(".more-search-item").removeClass("active");
        $(obj).parent().find(".more-search-item img").remove();
        $(obj).addClass("active");
        $(obj).append('<img src="/phone/public/images/wechat/v4/checked.png">');
    }
    $("#moreSearchBtn").attr("href","#search/"+moreClass+"/"+moreDifficulty+"/"+moreDay);
}

function removeMoreSearch(){
    $(".more-search-item").removeClass("active");
    $(".more-search-item img").remove();
    moreClass = "";
    moreDifficulty = "";
    moreDay = "";
}

function hideMoreSearch(){
    $(".more-search-list").addClass("slideOut");
    $(".more-search-list").on('animationend webkitAnimationEnd', function(){
        $(".search-bg").hide();
        $(".more-search-list").removeClass("slideOut").removeClass("search-show");
        //解除绑定页面不允许滚动
        $('body').unbind('touchmove');
    });
}

function getMoreItemHtml( data ){
    var addHtml = '';
    addHtml += '<div class="destination pull-left">';
    addHtml +=     '<a href="'+ data['url'] +'">';
    addHtml +=         '<div style="padding:0 5px;">';
    addHtml +=            '<div class="destination-img" style="background-image:url('+ data['small_imageurl_s'] +');">';
    addHtml +=                '<div class="destination-name">'+ data['name'] +'</div>';
    addHtml +=            '</div>';
    addHtml +=         '</div>';
    addHtml +=     '</a>';
    addHtml += '</div>';
    // addHtml += '<div class="item pull-left">';
    // addHtml +=     '<a href="'+ data['url'] +'">';
    // addHtml +=         '<div style="padding:0 5px;">';
    // addHtml +=             '<div class="item-img" style="background-image:url('+ data['small_imageurl_s'] +');">';

    // if( data['canFanpai'] == 1 ){
    //     addHtml +=             '<div class="item-num">可自选</div>';
    // }else if( data['times'].length > 0 ){
    //     addHtml +=             '<div class="item-num">'+ data['times'].length +'个活动</div>';
    // }
    // addHtml +=             '</div>';
    // addHtml +=             '<div class="item-name">'+ data['name'] +'</div>';
    // addHtml +=             '<div class="item-desc">'+ data['sub_title_s'] +'</div>';
    // addHtml +=         '</div>';
    // addHtml +=     '</a>';
    // addHtml += '</div>';
    return addHtml;
}

function setHotHtml(){
    var addHtml = '';
    return;
    if( nearsList.length > 0 ){
        $("#hotList").parent().show();
        $(".page-loading").hide();
        $.each(nearsList, function(index, item) {
            addHtml += getMoreItemHtml( item );
        });
        addHtml += '<div class="clear"></div>';
        $("#hotList").html( addHtml );
        updateMoreImgHeight();
    }
}
// setHotHtml();

function getAll(){
    $.ajax({
        type: 'POST',
        url: '/wechat/v4/list/near',
        data: {
        },
        dataType: 'json',
        success: function(getdata){
            if( getdata.status == 1 ){
                $(".page-loading").hide();
                if( getdata.list.length > 0 ){
                    var addHtml = '';
                    $("#list").parent().show();
                    $.each(getdata.list, function(index, item) {
                        addHtml += getMoreItemHtml( item );
                    });
                    addHtml += '<div class="clear"></div>';
                    $("#list").html( addHtml );
                }else{
                    $("#hotList").parent().css('padding-bottom', '47px');
                }
                if( getdata.old_list.length > 0 ){
                    var oldAddHtml = '';
                    $("#oldList").parent().show();
                    $.each(getdata.old_list, function(index, item) {
                        oldAddHtml += getMoreItemHtml( item );
                    });
                    oldAddHtml += '<div class="clear"></div>';
                    $("#oldList").html( oldAddHtml );
                }else{
                    $("#list").parent().css('padding-bottom', '47px');
                }
                updateMoreImgHeight();
            }else{
                if( nearsList.length <= 0 ){
                    $(".page-loading img").hide();
                    $(".page-loading span").html("没有数据");
                }
            }
        },
        error: function(xhr, type){
            console.log("error");
            if( nearsList.length <= 0 ){
                $(".page-loading img").hide();
                $(".page-loading span").html("没有数据");
            }
        }
    })
}
getAll();
</script>

</div>
</script>
<script type="text/html" id="tpl_city"> <!-- 必须，指定模板ID，以tpl_开头 -->
    <div class="page"> <!-- 必须DIV，指定page -->

    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list_city.css?v=1">

    <div class="page-loading">
    <img src="/phone/public/images/wechat/loading2.gif" style="height:14px;">
    <span>loading</span>
    </div>

    <div class="page-body">
    <div class="list" id="list"></div>
    </div>

    <script type="text/javascript">

//全局变量
var cityId = '';
var cityName = '';

//拆分地址，去#及之后的，再通过/分组，第一个参数为锚点，后面为参数
var thisUrl = window.location.href;
var anchorStr = thisUrl.substring( thisUrl.indexOf("#") );
var anchorArr = anchorStr.split('/');
var anchorParameters = {};
$.each(anchorArr, function(index, val) {
    switch( index ){
        case 1:
            cityId = val;
            break;
        case 2:
            cityName = decodeURIComponent( val );
            break;
    }
});

//设置title
page.setTitle(1,cityName);

var swipers = [];

function getList(){
    $.ajax({
        type: 'POST',
        url: '/wechat/list/query',
        data: {
            city: cityId
        },
        dataType: 'json',
        success: function(getdata){
            // console.log(getdata);
            if( getdata.status == 1 ){
                $(".page-loading").hide();
                var addHtml = '';
                $.each(getdata.list, function(index, item) {
                    addHtml += getSwiperHtml( item );
                });
                $.each(getdata.old_list, function(index, item) {
                    addHtml += getSwiperHtml( item );
                });
                $("#list").html( addHtml );

                $(".item-times-swiper").each(function(index, el) {
                    var thisSwiper = new Swiper(this, {
                        width : 130,
                        spaceBetween: 0,
                        initialSlide : 0,
                        onInit: function(swiper){
                        },
                    });
                    swipers.push( thisSwiper );
                });

            }else{
                $(".page-loading img").hide();
                $(".page-loading span").html("没有数据");
            }
        },
        error: function(xhr, type){
            console.log("error");
            $(".page-loading img").hide();
            $(".page-loading span").html("没有数据");
        }
    })
}
getList();

function getSwiperHtml( data ){
    var addHtml = '';
    addHtml += '<div class="item">';
    addHtml +=     '<div class="item-img">';
    addHtml +=         '<a href="'+ data['url'] +'">';
    addHtml +=             '<img src="'+ data['imageurl_s'] +'">';
    addHtml +=         '</a>';
    addHtml +=     '</div>';
    addHtml +=     '<div class="item-name">'+ data['activity_name'] +'</div>';
    addHtml +=     '<div class="item-times">';
    addHtml +=         '<div class="item-times-title">可选出发时间（<span>'+ data['times'].length +'</span>个活动）：</div>';
    addHtml +=         '<div class="item-times-content">';
    addHtml +=             '<div class="item-times-swiper swiper-containe">';
    addHtml +=                 '<div class="swiper-wrapper">';
    if( data['times'].length <= 0 ){
        addHtml += getSwiperSlideHtml( 'special', 2 );
        addHtml += getSwiperSlideHtml( 'special', 3 );
    }else{
        var isShowDates = [];
        $.each(data['times'], function(index, time) {
            var startTimeArr = time['startTime'].toString().initDate();
            var startTime = startTimeArr['M'] + "/" + startTimeArr['D'];
            var endTimeArr = time['endTime'].toString().initDate();
            var endTime = endTimeArr['M'] + "/" + endTimeArr['D'];
            time['time'] = startTime + " - " + endTime;
            if( $.inArray(time['time'], isShowDates) == -1 ){
                addHtml += getSwiperSlideHtml( time, 0 );
                isShowDates.push( time['time'] );
            }else{
                addHtml += getSwiperSlideHtml( time, 1 );
            }
        });
    }
    addHtml +=                 '</div>';
    addHtml +=             '</div>';
    addHtml +=         '</div>';
    addHtml +=     '</div>';
    addHtml += '</div>';
    return addHtml;
}

function getSwiperSlideHtml( data, type ){
    var addHtml = '';
    addHtml += '<div class="swiper-slide">';
    addHtml +=     '<a href="'+ data['url'] +'">';
    addHtml +=         '<div class="activity">';
    addHtml +=             '<div class="activity-main checked">';
    addHtml +=                 '<div class="activity-content">';
    switch( type ){
        case 0:
        case 1:
            addHtml +=                 '<div class="activity-time">'+ data['time'] +'</div>';
            addHtml +=                 '<div class="activity-status">';
            addHtml +=                     '<span class="'+ data['status']['style'] +'">'+ data['status']['name'] +'</span>';
            addHtml +=                 '</div>';
            break;
        case 2:
            addHtml +=                 '<div class="activity-time">自选</div>';
            addHtml +=                 '<div class="activity-status">';
            addHtml +=                     '<span class="ss">发起一期活动</span>';
            addHtml +=                 '</div>';
            break;
        case 3:
            addHtml +=                 '<div class="activity-time">小闹钟</div>';
            addHtml +=                 '<div class="activity-status">';
            addHtml +=                     '<span class="ss">开启线路提醒</span>';
            addHtml +=                 '</div>';
            break;
    }
    addHtml +=                 '</div>';
    if( type == 1 ){
        addHtml +=             '<div class="jia-tui">';
        addHtml +=                 '加推';
        addHtml +=                 '<div class="jia-tui-bottom">';
        addHtml +=                     '<img src="/phone/public/images/wechat/v4/triangle.png" style="height:6px;">';
        addHtml +=                 '</div>';
        addHtml +=             '</div>';
    }
    addHtml +=             '</div>';
    addHtml +=             '<div class="right-lian">';
    addHtml +=                 '<div class="left-circle checked"></div>';
    addHtml +=                 '<div class="right-circle checked"></div>';
    addHtml +=                 '<div class="left-center-bg"></div>';
    addHtml +=                 '<div class="right-center-bg"></div>';
    addHtml +=                 '<div class="small-left-circle"></div>';
    addHtml +=                 '<div class="small-right-circle"></div>';
    addHtml +=                 '<div class="left-center-line"></div>';
    addHtml +=                 '<div class="right-center-line"></div>';
    addHtml +=             '</div>';
    addHtml +=         '</div>';
    addHtml +=         '<div class="clear"></div>';
    addHtml +=     '</a>';
    addHtml += '</div>';
    return addHtml;
}
</script>

</div>
</script>
<script type="text/html" id="tpl_search"> <!-- 必须，指定模板ID，以tpl_开头 -->
    <div class="page"> <!-- 必须DIV，指定page -->

    <link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/list_more.css?v=9">

    <div class="page-body">
    <div class="list-content" style="display:inherit;">
    <div class="item-title">
    <div>搜索结果</div>
    <div class="title-line"><div></div></div>
</div>
<div class="item-list">
    <div class="page-loading">
    <img src="/phone/public/images/wechat/loading2.gif" style="height:14px;">
    <span>数据搜索中</span>
    </div>
    <div id="itemList"></div>
    </div>
    </div>
    <div class="bottom-btn">
    <a onclick="showSearch();">
    筛选
    <img src="/phone/public/images/wechat/v4/shaixuan2.png" style="height:16px; margin-bottom:2px;">
    </a>
    </div>
    <div class="search-bg" onclick="hideSearch();"></div>
    <div class="search-list">
    <div class="search-content">
    <div class="search-sub-title">类型</div>
    <div class="search-main" id="classList">
    <a id="classItem美食" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="1" data-search="美食">
    <span>美食</span>
    </a>
    <a id="classItem休闲" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="1" data-search="休闲">
    <span>休闲</span>
    </a>
    <a id="classItem徒步" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="1" data-search="徒步">
    <span>徒步</span>
    </a>
    <a id="classItem登山" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="1" data-search="登山">
    <span>登山</span>
    </a>
    <a id="classItem亲子" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="1" data-search="亲子">
    <span>亲子</span>
    </a>
    <div class="clear"></div>
    </div>
    <div class="search-sub-title">难度</div>
    <div class="search-main" id="difficultyList">
    <a id="difficultyItem1" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="2" data-search="1" style="width:33.3%;">
    <span>休闲深度</span>
    </a>
    <a id="difficultyItem1.5" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="2" data-search="1.5" style="width:33.3%;">
    <span>轻松徒步</span>
    </a>
    <a id="difficultyItem2" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="2" data-search="2" style="width:33.3%;">
    <span>稍有难度</span>
    </a>
    <a id="difficultyItem3" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="2" data-search="3" style="width:33.3%;">
    <span>中等难度</span>
    </a>
    <a id="difficultyItem4" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="2" data-search="4" style="width:33.3%;">
    <span>较高难度</span>
    </a>
    <div class="clear"></div>
    </div>
    <div class="search-sub-title">天数</div>
    <div class="search-main" id="dayList">
    <a id="dayItem1" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="3" data-search="1">
    <span>1天</span>
</a>
<a id="dayItem2" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="3" data-search="2">
    <span>2天</span>
</a>
<a id="dayItem3" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="3" data-search="3">
    <span>3天</span>
</a>
<a id="dayItem4" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="3" data-search="4">
    <span>4~6天</span>
</a>
<a id="dayItem7" class="search-item search-item-s" onclick="addSearchItem(this);" data-type="3" data-search="7">
    <span>7天以上</span>
</a>
<div class="clear"></div>
    </div>
    <div class="search-btns">
    <a class="search-btn" onclick="removeSearch();">重置</a>
    <a class="search-btn" onclick="hideSearch();" id="searchBtn">确定</a>
    <div class="clear"></div>
    </div>
    </div>
    </div>
    </div>

    <script type="text/javascript">


    page.setTitle(2,"更多目的地");

//搜索全局
var searchClass = "";
var searchDifficulty = "";
var searchDay = "";

//拆分地址，去#及之后的，再通过/分组，第一个参数为锚点，后面为参数
var thisUrl = window.location.href;
var anchorStr = thisUrl.substring( thisUrl.indexOf("#") );
var anchorArr = anchorStr.split('/');
$(".search-item-s").removeClass("active");
$(".search-item-s img").remove();
$.each(anchorArr, function(index, val) {
    switch( index ){
        case 1:
            searchClass = decodeURIComponent( val );
            $("#classItem"+searchClass).addClass("active");
            $("#classItem"+searchClass).append('<img src="/phone/public/images/wechat/v4/checked.png">');
            break;
        case 2:
            searchDifficulty = val;
            $("#difficultyItem"+searchDifficulty).addClass("active");
            $("#difficultyItem"+searchDifficulty).append('<img src="/phone/public/images/wechat/v4/checked.png">');
            break;
        case 3:
            searchDay = val;
            $("#dayItem"+searchDay).addClass("active");
            $("#dayItem"+searchDay).append('<img src="/phone/public/images/wechat/v4/checked.png">');
            break;
    }
});
submitSearch(1); //提交第一次搜索

function updateSearchImgHeight(){
    //计算目的地图片高度
    var destinationImgWidth = ( $(window).width() - 60 ) / 3;
    var destinationImgHeight = destinationImgWidth / 190 * 200;
    $(".destination-img").css("height", destinationImgHeight+"px");
}

//屏幕宽度改变时再调整
$(document).ready(function() {
    window.onresize=function(){
        updateSearchImgHeight();
    };
});

function showSearch(){
    //绑定页面不允许滚动
    $('body').bind('touchmove', function (event) {
        event.preventDefault();
    });
    $(".search-list").addClass("search-show");
    $(".search-list").addClass("slideIn");
    $(".search-list").on('animationend webkitAnimationEnd', function(){
        $(".search-bg").show();
        $(".search-list").removeClass("slideIn").addClass("search-show");
    });
}

function addSearchItem( obj ){
    var search = $(obj).data("search");
    var type = $(obj).data("type");
    var isChecked = false;
    switch( type ){
        case 1:
            if( search == searchClass ){
                isChecked = true;
                searchClass = "";
            }else{
                searchClass = search;
            }
            break;
        case 2:
            if( search == searchDifficulty ){
                isChecked = true;
                searchDifficulty = "";
            }else{
                searchDifficulty = search;
            }
            break;
        case 3:
            if( search == searchDay ){
                isChecked = true;
                searchDay = "";
            }else{
                searchDay = search;
            }
            break;
    }
    if( isChecked ){
        $(obj).removeClass("active");
        $(obj).find("img").remove();
    }else{
        $(obj).parent().find(".search-item-s").removeClass("active");
        $(obj).parent().find(".search-item-s img").remove();
        $(obj).addClass("active");
        $(obj).append('<img src="/phone/public/images/wechat/v4/checked.png">');
    }
    submitSearch();
}

function removeSearch(){
    $(".search-item-s").removeClass("active");
    $(".search-item-s img").remove();
    searchClass = "";
    searchDifficulty = "";
    searchDay = "";
}

function submitSearch( isFirst ){
    // if( searchClass == "" && searchDifficulty == "" && searchDay == "" ){
    //     hideSearch();
    //     return false;
    // }
    var data = {};
    data['name'] = searchClass;
    data['difficult'] = searchDifficulty;
    data['day'] = searchDay;
    $("#searchBtn").Btnloading(); //显示按钮加载
    $.ajax({
        type: 'POST',
        url: '/wechat/list/query',
        data: data,
        dataType: 'json',
        success: function(getdata){
            // console.log(getdata);
            $("#searchBtn").Btnloading("reset"); //还原按钮加载
            var count = getdata.list.length + getdata.old_list.length;
            $("#searchBtn").html("确定(共"+ count +"个结果)");
            if( getdata.list.length <= 0 && getdata.old_list.length <= 0 ){
                $(".page-loading img").hide();
                $(".page-loading span").html("没有结果");
                $(".page-loading").show();
                $("#itemList").html("");
            }else{
                $(".page-loading").hide();
                var addHtml = '';
                $.each(getdata.list, function(index, item) {
                    addHtml += getItemHtml( item );
                });
                addHtml += '<div class="clear"></div>';
                if( getdata.old_list.length > 0 ){
                    addHtml += '<div class="no-notice-border"></div><div class="no-notice"><div>以下线路暂无活动</div></div>';
                    $.each(getdata.old_list, function(index, item) {
                        addHtml += getItemHtml( item );
                    });
                    addHtml += '<div class="clear"></div>';
                }
                $("#itemList").html( addHtml );
                updateSearchImgHeight();
            }
            // if( isFirst != 1 ){
            //     hideSearch();
            // }
        },
        error: function(xhr, type){
            $("#searchBtn").Btnloading("reset"); //还原按钮加载
            $(".page-loading img").hide();
            $(".page-loading span").html("没有结果");
            // if( isFirst != 1 ){
            //     hideSearch();
            // }
        }
    })
}

function getItemHtml( data ){
    var addHtml = '';
    addHtml += '<div class="destination pull-left">';
    addHtml +=     '<a href="'+ data['url'] +'">';
    addHtml +=         '<div style="padding:0 5px;">';
    addHtml +=            '<div class="destination-img" style="background-image:url('+ data['small_imageurl_s'] +');">';
    addHtml +=                '<div class="destination-name">'+ data['name'] +'</div>';
    addHtml +=            '</div>';
    addHtml +=         '</div>';
    addHtml +=     '</a>';
    addHtml += '</div>';
    // addHtml += '<div class="item pull-left">';
    // addHtml +=     '<a href="'+ data['url'] +'">';
    // addHtml +=         '<div style="padding:0 5px;">';
    // addHtml +=             '<div class="item-img" style="background-image:url('+ data['small_imageurl_s'] +');">';
    // if( data['canFanpai'] == 1 ){
    //     addHtml +=             '<div class="item-num">可自选</div>';
    // }else if( data['times'].length > 0 ){
    //     addHtml +=             '<div class="item-num">'+ data['times'].length +'个活动</div>';
    // }
    // addHtml +=             '</div>';
    // addHtml +=             '<div class="item-name">'+ data['name'] +'</div>';
    // addHtml +=             '<div class="item-desc">'+ data['sub_title_s'] +'</div>';
    // addHtml +=         '</div>';
    // addHtml +=     '</a>';
    // addHtml += '</div>';
    return addHtml;
}

function hideSearch(){
    $(".search-list").addClass("slideOut");
    $(".search-list").on('animationend webkitAnimationEnd', function(){
        $(".search-bg").hide();
        $(".search-list").removeClass("slideOut").removeClass("search-show");
        //解除绑定页面不允许滚动
        $('body').unbind('touchmove');
    });
}
</script>

</div>
</script>


<script type="text/javascript" src="/phone/public/plugins/zepto/zepto.min.js"></script>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>
<script type="text/javascript" src="/phone/public/js/wechat/v4/plugins.js?v=5"></script> <!-- 插件库尽量往前放，但必须在zepto之后 -->
<script type="text/javascript">
    var page = new Page(); //实例化page对象，必须在full_content.js之前
</script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=110" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/v4/full_content.js?v=17"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".tab-notice").addClass("show-tab-notice");
    });
</script>

<script type="text/javascript">

    //单页超链的点击全局设置
    $(document).on("click", ".page-a", function(event) {
        page.setShare( 1, $(this).data("shareTitle"), $(this).data("shareDesc"), $(this).data("shareImgUrl"), $(this).data("shareUrl") );
    });

</script>

</body>
</html>