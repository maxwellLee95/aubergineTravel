<!DOCTYPE html>
<html>
<head>
    <title>茄子户外运动自选</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11">
<style type="text/css">
    .search{
        padding: 10px;
        background-color: #1C1B20;
    }
    .search-main{
        background-color: #fff;
        position: relative;
        border-radius: 4px;
        box-shadow: 0 3px 5px rgba(0,0,0,0.1);
    }
    #search_text{
        height: 42px;
        line-height: 42px;
        border-radius: 4px;
        text-align: center;
        display: none;
    }
    .search-placeholder{
        height: 42px;
        line-height: 42px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        color: #b2b2b2;
    }
    .search-placeholder span span{
        color: #333;
    }
    .search-loading{
        height: 36px;
        padding: 10px 0;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    .search-list{
        padding: 10px 10px 0 10px;
        background-color: #fff;
        display: none;
    }
    .search-line{
        padding-bottom: 10px;
        /*padding: 5px 10px 5px 5px;*/
        position: relative;
    }
    .line-img{
        border-radius: 4px;
        overflow: hidden;
    }
    .line-info{
        padding-top: 5px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .line-name{
        width: 100%;
        /*padding-top: 5px;*/
    }
    .line-days{
        width: 20%;
        display: flex;
        justify-content: flex-end;
    }
    .line-days span{
        color: #63d496;
        border: 1px solid #63d496;
        border-radius: 3px;
        font-size: 11px;
        height: 16px;
        line-height: 14px;
        padding: 0 5px;
        margin-top: 2px;
    }
    .line-desc{
        font-size: 12px;
        color: #999;
        padding-left: 8px;
    }
    .apply-modal{
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        width: 100%;
        height: 100%;
    }
    .apply-modal.active{
        display: flex;
        justify-content: center;
        /*align-items: center;*/
    }
    .apply-bg{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    .apply-content-bg{
        width: 80%;
        height: 70%;
        background-image: url('/phone/public/images/wx/wechat/apply_bg.png');
        background-size: 100%;
        background-repeat: no-repeat;
        position: relative;
        z-index: 1001;
        margin-top: 15%;
    }
    .apply-content{
        position: absolute;
        left: 0;
        top: 31%;
        z-index: 1001;
        width: 100%;
        height: 100%;
        padding: 0 10px;
    }
    .apply-title{
        text-align: center;
        font-size: 16px;
        color: #000;
    }
    .apply-close{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
        height: 22px;
    }
    .apply-input textarea{
        width: 100%;
        height: 20%;
        border: 0;
        margin: 0;
        padding: 10px;
    }
    .apply-same{
        padding-top: 10px;
        display: none;
    }
    .apply-same.active{
        display: inherit;
    }
    .apply-same-title{
        font-size: 12px;
        color: #999;
    }
    #applySameList{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding-top: 5px;
        display: none;
        height: 62px;
        overflow: hidden;
    }
    #applySameList a{
        font-size: 12px;
        border: 1px solid rgba(51,51,51,0.2);
        border-radius: 3px;
        padding: 2px 5px;
        margin-right: 10px;
        margin-bottom: 5px;
    }
    .apply-btns{
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: 1001;
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 2%;
    }
    .apply-btn{
        width: 50%;
        text-align: center;
        border-top: 1px solid #9B8CE5;
        height: 34px;
        line-height: 34px;
        padding: 2px 0;
    }
    .apply-btn div{
        height: 30px;
        line-height: 30px;
        border-right: 1px solid #9B8CE5;
    }
    .apply-btn:last-of-type div{
        border-right: 0;
    }
    .no-data{
        text-align: center;
        font-size: 12px;
        color: #888;
        padding-bottom: 10px;
    }
    .apply-text{
        border: 1px solid #e4e4e4;
        border-radius: 4px;
    }
    .apply-text textarea{
        width: 100%;
        padding: 5px 10px;
        border: 0;
        margin: 0;
        height: 58px;
        line-height: 16px;
        border-radius: 4px;
    }
</style>
<div class="content">

    <!-- 搜索框 -->
    <form id="searchForm" method="get" action="" onsubmit="return search()">
        <div class="search" style="background-color:#373B3E;">
            <div class="search-main">
                <input class="search-text" type="text" id="search_text" name="keyword" value="{$keyword}">
                <div class="search-placeholder" onclick="showSearchInput(1);">
                    <img src="/phone/public/images/wechat/v4/search.png" style="height:14px;">
                    <span>&nbsp;&nbsp;关于 <span>“{$keyword}”</span> 的搜索结果</span>
                </div>
            </div>
        </div>
    </form>

    <!-- 搜索内容 -->
    <div class="search-loading">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">&nbsp;&nbsp;<span>搜索中</span>
    </div>
    <div class="search-list" id="searchList"></div>

</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=12"></script>
<script type="text/javascript">

    function showSearchInput( ishide ){
        if( ishide == 1 ){
            $(".search-placeholder").hide();
            $("#search_text").show();
            $("#search_text").focus();
        }else{
            $(".search-placeholder").show();
            $("#search_text").hide();
        }
    }

    $(document).on('blur', '#search_text', function(event) {
        $(".search-placeholder span span").html( "“"+ $("#search_text").val() +"”" );
        showSearchInput(0);
    });

    //ajax请求搜索
    function search(){
        var search_text = $("#search_text").val();
        if( search_text == '' ){
            return false;
        }
        $("#searchList").hide();
        $("#searchList").html("");
        $(".search-loading").show();
        $.ajax({
            url: '/phone/flop/ajax_dosearch',
            type: 'POST',
            dataType: 'json',
            data: {
                keyword: search_text,
                wxoid: ""
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $(".search-loading").hide();
                $("#searchList").show();
                if( getdata.status == 1 ){
                    updateSearch( getdata.data );
                }
                return false;
            })
            .fail(function() {
                return false;
            });
        return false;
    }
    search(); //页面第一次直接搜索

    function updateSearch( datas ){
        var addHtml = '';
        if( datas.length > 0 ){
            $.each(datas, function(index, data) {
                addHtml += '<div class="search-line">';
                addHtml +=     '<a href="'+ data['url'] +'">';
                addHtml +=         '<div class="line-img">';
                addHtml +=             '<img src="'+ data['imageUrl'] +'" style="width:100%;">';
                addHtml +=         '</div>';
                addHtml +=         '<div class="line-info">';
                addHtml +=             '<div class="line-name">'+ data['title'] +'</div>';
                // addHtml +=             '<div class="line-days"><span>'+ data['days'] +'天</span></div>';
                addHtml +=         '</div>';
                addHtml +=         '<div class="line-desc">'+ data['days'] +'天&nbsp;&nbsp;难度：'+ data['difficultyDesc'] +'</div>';
                addHtml +=     '</a>';
                addHtml += '</div>';
            });
        }else{
            addHtml += '<div class="no-data"><img src="/phone/public/images/wx/v4/no_data.jpg" style="width:70%;"></div>';
        }
        $("#searchList").html( addHtml );
    }

    //预加载弹窗背景图
    // var img = new Image();

    function hideApplyModal(){
        closePopLayer();
        $("#applyModal").removeClass('active');
    }

    function submitApply(){
        var applyText = $("#applyText").val();
        closePopLayer();
        if( applyText == "" ){
            popLayer(
                //基本属性配置,closePopLayer为默认关闭按钮的方法
                {
                    title: '', //头部标题
                    btnsName: '确认', //按钮的名称组字符串
                    btnsCallback: 'closePopLayer();', //按钮的回调方法名(按照按钮名称的顺序)
                    content: '<div class="text-center">申请内容不能为空！</div>', //内容HTML
                }
            );
        }
        $(".loading").html("正在申请");
        $("#loading").show();
        $.ajax({
            url: '/wechat/v4/fanpai/saveapply',
            type: 'POST',
            dataType: 'json',
            data: {
                applyText: applyText,
                wxoid: ""
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $("#loading").hide();
                if( getdata.status == 1 ){
                    popLayer(
                        //基本属性配置,closePopLayer为默认关闭按钮的方法
                        {
                            title: '', //头部标题
                            btnsName: '确认', //按钮的名称组字符串
                            btnsCallback: 'hideApplyModal();', //按钮的回调方法名(按照按钮名称的顺序)
                            content: '<div class="text-center">申请成功！</div>', //内容HTML
                        }
                    );
                }else{
                    popLayer(
                        //基本属性配置,closePopLayer为默认关闭按钮的方法
                        {
                            title: '', //头部标题
                            btnsName: '确认', //按钮的名称组字符串
                            btnsCallback: 'closePopLayer();', //按钮的回调方法名(按照按钮名称的顺序)
                            content: '<div class="text-center">申请失败，请稍候再试！</div>', //内容HTML
                        }
                    );
                }
            })
            .fail(function() {
                $("#loading").hide();
                popLayer(
                    //基本属性配置,closePopLayer为默认关闭按钮的方法
                    {
                        title: '', //头部标题
                        btnsName: '确认', //按钮的名称组字符串
                        btnsCallback: 'closePopLayer();', //按钮的回调方法名(按照按钮名称的顺序)
                        content: '<div class="text-center">请求失败，请稍候再试！</div>', //内容HTML
                    }
                );
            });
    }

</script>


</html>