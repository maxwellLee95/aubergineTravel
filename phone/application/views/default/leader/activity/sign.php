<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>活动人员名单</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="/phone/public/js/jquery.min.js"></script>
    <script src="/phone/public/bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

</head>

<body style="padding: 10px;">
{if $list}
<div style="background: #eee;
    width: 90%;
    margin: 0 auto;
    border-radius: 10px;
    padding: 20px;">
    <div>
        活动名称:{$info['title']}
    </div>
    <div>
        活动时间:{date('Y-m-d',$suit['day'])}
    </div>
    <div>
        活动人数:{count($list)}
    </div>
</div>
<table class="table table-striped">
    <caption>
        用户名单
    </caption>
    <thead>
    <tr>
        <th>姓名</th>
        <th>性别</th>
        <th>手机</th>
        <th>到否</th>
    </tr>
    </thead>
    <tbody>
    {loop $list $k $row}
    <tr>
        <td>{$row['tourername']}</td>
        <td>{$row['sex']}</td>
        <td>{$row['mobile']}</td>
        <td><input type="checkbox"  class="update_sign" data-id="{$row['id']}"  {if $row['is_sign']} checked="" {/if}></td>
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
{request 'pub/code'}

<script type="text/javascript">
    $(function(){
        $(".update_sign").click(function(){
            var id=$(this).data('id');
            if ($(this).is(':checked')){
                var sign=1;
            }else{
                var sign=0;
            }
            $.ajax({
                type: 'POST',
                data: {id: id, sign: sign},
                url: SITEURL + 'leader/activity//ajax_sign',
                dataType: 'json',
                success: function (data) {
                    alert('更新成功')
                }
            });
            console.log(id);
            console.log(sign);
        })
    });
</script>
</body>
</html>
