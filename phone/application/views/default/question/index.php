<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$seoinfo['seotitle']}-{$GLOBALS['cfg_webname']}</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}"/>
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}"/>
    {/if}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::css('amazeui.css,style.css,extend.css')}
    {Common::js('jquery.min.js,amazeui.js,template.js,delayLoading.min.js')}
    <script>
        $(function () {
            $('#my-st-slide').offCanvas('close');
            $('.st-slider').flexslider({pauseOnAction: false});
        })
    </script>
</head>
<body>

{request "pub/header/typeid/$typeid"}

<section>

    <div class="mid_content">

        <div class="st_search_box">
            <input type="text" name="keyword" id="keyword" class="st_home_txt" placeholder="搜索您的问题" />
            <input type="button" class="st_home_btn" value="搜索" />
        </div><!--搜索-->

        <div class="search-box-ts" style="display: none">给您找到<span id="count"></span>条相关问答</div>

        <div class="faq_list" id="list-content">
            <div id="question_list">

            </div>
            <div class="tuan_more" id="btn_getmore"><a class="cursor">加载更多</a></div>
        </div>
        <!--没有相关信息-->
        <div class="no-content" id="no-content" style="display: none">
            <img src="/phone/public/images/no-content-page.png"/>
            <p>啊哦，暂时没有相关信息</p>
        </div>
        <!--问答列表-->
    </div>
    <input type="hidden" id="page" value="{$page}"/>

</section>

<div class="bom_link_box">
    <div class="bom_fixed">
        <a class="on" href="{$cmsurl}questions/add">我要提问</a>
    </div>
</div>


<script type="text/html" id="tpl_question_list">
    {{each list as value i}}
    <ul>
        <li>
            <p class="name">
                <span class="wm"><i class="yh"></i>{{value.nickname}}</span>
                <span class="date">{{value.addtime}}</span>
            </p>

            <p class="bt">{{value.title}}</p>

            <p class="txt">{{#value.content}}</p>
        </li>
        <li>
            <p class="name">
                <span class="wm"><i class="kf"></i>客服回答</span>
                <span class="date">{{value.replytime}}</span>
            </p>

            <p class="txt">{{#value.replycontent}}</p>
        </li>
    </ul>
    {{/each}}
</script>

{Common::js('layer/layer.m.js')}

<script>
    //初始页码
    var initpage = '{$page}';
    $(function () {
        if(initpage !=  $("#page").val()){
            $("#page").val(initpage);
        }
        $("#btn_getmore").click(function () {
            get_question_list();
        })
        get_question_list();
    })

    function get_question_list() {
        layer.open({
            type: 2,
            content: '正在加载数据...',
            time: 20

        });
        var url = SITEURL + 'question/ajax_question_search';
        $.getJSON(url, {page:$("#page").val(),keyword:$("#keyword").val()}, function (data) {
            if (data.list.length > 0) {
                var html = template("tpl_question_list", data);
                $("#question_list").append(html);
            }
            var count = data.count;
            $("#count").html(count);
            //设置分页
            if (data.page != -1) {
                $("#page").val(data.page);
            } else {
                $("#btn_getmore").hide();
            }
            if($("#keyword").val() == ''){
                $('.search-box-ts').hide();
            }else{
                $('.search-box-ts').show();
            }
            //设置内内容显示
            if (count == 0) {
                $('#list-content').hide();
                $('.search-box-ts').hide();
                $("#no-content").show();
            }else{
                $('#list-content').show();
                $("#no-content").hide();
            }
            layer.closeAll();
        })
    }
    //搜索页面
    $(".st_home_btn").click(function () {
        $("#page").val(1);
        $("#question_list").html("");
        get_question_list();
    })

</script>

</body>
</html>
