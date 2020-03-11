<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>消息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::css('amazeui.css,style.css,../js/layer/need/layer.css')}

</head>

<body>

<section style="padding: 10px;" >
    <article class="am-article">
        <div class="am-article-bd">
            <h2>{$info['title']}</h2>
            <p class="am-article-meta">系统（{date('Y-m-d H:i:s',$info['addtime'])}）</p>
            <p>{$info['msg']}</p>
        </div>
    </article>
</section>

{request 'pub/code'}


</body>
</html>
