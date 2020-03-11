<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的物资-编辑</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="/phone/public/js/jquery.min.js"></script>
    <script src="/phone/public/bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

</head>

<body>

<section style="padding: 5px;" >
    <form action="/phone/leader/material/save" method="post">
        <input type="hidden" value="{$data['id']}" name="id">
        <div class="form-group">
            <label for="exampleInputEmail1">物资</label>
            <input readonly="readonly" value="{$data['name']}" type="text" class="form-control" id="name" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">数量</label>
            <input type="number" class="form-control" name="qty" value="{$data['qty']}" id="qty" placeholder="物资数量">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">备注</label>
            <textarea class="form-control" name="remake" id="remake" rows="3">{$data['remake']}</textarea>
        </div>
        <button type="submit" class="btn btn-default">编辑</button>
    </form>
</section>

{request 'pub/code'}


</body>
</html>
