<!DOCTYPE html>
<html>
<head>
    <title>专栏列表</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=14"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/pop-layer.css?v=17">


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

<style type="text/css">
    .page-loading{
        padding: 10px 0;
        color: #999;
    }
    .page-loading span{
        padding: 0 10px;
    }
    .column{
        background-color: #fff;
        margin-bottom: 10px;
    }
    .column-info{
        color: #999;
        padding: 10px;
    }
    .column-title{
        font-size: 16px;
        color: #333;
    }
</style>
<div class="content">

    <div id="list" class="list">

    </div>

    <div class="flex-center page-loading">
        <img src="/phone/public/images/wechat/loading2.gif" style="height:16px;">
        <span>正在获取列表</span>
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
</script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js"></script>

<script type="text/javascript">

    var page = 0;
    var pageLoading = false;
    var pageEnd = false;
    function getList(){
        if( pageLoading || pageEnd ){
            return;
        }
        pageLoading = true;
        $(".page-loading").removeAttr("onclick");
        page++;
        $.ajax({
            url: '/phone/notes/ajax_getlist',
            type: 'POST',
            dataType: 'json',
            data: {
                page: page,
                wxoid: ''
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                pageLoading = false;
                if( getdata.errcode == 0 ){
                    var items = getdata.data.items;
                    var addHtml = '';
                    $.each(items, function(index, item) {
                        addHtml += getColumnHtml( item );
                    });
                    $("#list").append( addHtml );
                    if( page >= getdata.data.total_pages ){
                        pageEnd = true;
                        $(".page-loading").html("没有更多啦");
                    }
                }else{
                    page--;
                    $(".page-loading").html( getdata.errmsg + '，点击重新获取' );
                    $(".page-loading").attr("onclick", "getList();");
                }
            })
            .fail(function() {
                pageLoading = false;
                page--;
                $(".page-loading").html("点击重新获取");
                $(".page-loading").attr("onclick", "getList();");
            });
    }

    function getColumnHtml( data ){
        var addHtml = '';
        addHtml += '<div class="column">';
        addHtml +=     '<a href="'+ data['url'] +'">';
        addHtml +=         '<img src="'+ data['img'] +'" style="width:100%;">';
        addHtml +=         '<div class="column-info">';
        addHtml +=             '<div class="column-title">'+ data['title'] +'</div>';
        addHtml +=             '<div class="flex-div justify-between">';
        addHtml +=                 '<div><img src="/phone/public/images/wechat/article/time.png" style="height:12px;"> '+ data['date'] +'</div>';
        addHtml +=                 '<div><img src="/phone/public/images/wechat/article/read_h2.png" style="height:12px;"> '+ data['read'] +'阅读</div>';
        addHtml +=             '</div>';
        addHtml +=         '</div>';
        addHtml +=     '</a>';
        addHtml += '</div>';
        return addHtml;
    }
    getList(); //初次获取

    $(document).ready(function() {
        $(window).scroll(function(){
            var scrollTop = $(this).scrollTop();
            if( scrollTop + $(window).height() >= $(".content").height() - $(window).height() ){
                getList();
            }
        });
    });

</script>

</html>