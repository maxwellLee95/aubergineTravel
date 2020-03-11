<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的物资</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="/phone/public/js/jquery.min.js"></script>
    <script src="/phone/public/bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

</head>

<body>

<section style="padding: 5px;" >
    {if $list}
    <table class="table table-striped">
        <caption>
            我的物资列表
        </caption>
        <thead>
        <tr>
            <th>名称</th>
            <th>数量</th>
            <th>备注</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        {loop $list $row}
        <tr>
            <td>{$row['name']}</td>
            <td>{$row['qty']}</td>
            <td>{$row['remake']}</td>
            <td><a href="/phone/leader/material/edit?id={$row['id']}">编辑</a></td>
        </tr>
        {/loop}
        </tbody>
    </table>
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
