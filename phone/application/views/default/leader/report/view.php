<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>总结</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}"/>
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}"/>
    {/if}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::css('amazeui.css,style.css,../js/layer/need/layer.css')}
    {Common::css('../js/mobiscroll/css/mobiscroll.frame.css,../js/mobiscroll/css/mobiscroll.frame.android.css')}
    {Common::css('../js/mobiscroll/css/mobiscroll.scroller.css,../js/mobiscroll/css/mobiscroll.scroller.android.css')}
    {Common::js('jquery.min.js,amazeui.js,template.js,layer/layer.m.js,common.js,jquery.validate.min.js')}
    {Common::js('mobiscroll/js/mobiscroll.core.js,mobiscroll/js/mobiscroll.frame.js,mobiscroll/js/mobiscroll.scroller.js')}
    {Common::js('mobiscroll/js/mobiscroll.util.datetime.js,mobiscroll/js/mobiscroll.datetimebase.js,mobiscroll/js/mobiscroll.datetime.js')}
    {Common::js('mobiscroll/js/mobiscroll.frame.android.js,mobiscroll/js/i18n/mobiscroll.i18n.zh.js')}
</head>

<body style="padding: 10px">
<article class="am-article">
    <div class="am-article-hd">
        <h1 class="am-article-title">{$info['title']}</h1>
        <p class="am-article-meta">作者：{$info['leader']['nickname']}
            <br>发布时间：{date('Y-m-d H:i:s',$info['add_time'])}
            {if $info['up_time']}
            <br>更新时间：{date('Y-m-d H:i:s',$info['up_time'])}
            {/if}
        </p>
    </div>

    <div class="am-article-bd">
        <p class="am-article-lead">{$info['content']}</p>
    </div>
</article>

{request 'pub/code'}

<script>

</script>
</body>
</html>
