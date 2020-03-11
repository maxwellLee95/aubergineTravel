<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>消息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

</head>

<body>

<section >
    {if $list}
    <ul class="list-group">
        {loop $list $row}
        <li class="list-group-item"><a href="/phone/member/message/show?id={$row['id']}">{$row['title']}</li>
        {/loop}
    </ul>
    {else}
    <!--没有相关信息-->
    <div class="no-content" id="no-content">
        <img src="/phone/public/images/no-content-page.png"/>
        <p>啊哦，暂时没有相关信息</p>
    </div>
    {/if}
</section>

{request 'pub/code'}


</body>
</html>
