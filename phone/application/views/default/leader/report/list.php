<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的自主发布</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="/phone/public/js/jquery.min.js"></script>
    <script src="/phone/public/bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
    <style>
        .article {
            padding: 10px;
        }

        .article-img {
            width: 136.32px;
            height: 92.7733px;
            border-radius: 10px;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .article-title {
            font-size: 12px;
            height: 35px;
            overflow: hidden;
        }
        .article-time {
            color: #ccc;
            font-size: 12px;
        }
        .btn_container {
            position: absolute;
            bottom: 0;
        }
        .btn_container span{
            background: transparent;
            border: 1px solid #9B8CE5;
            color: #9B8CE5;
            padding: 5px 15px;
            margin-right: 5px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            font-size: 10px;
            display: inline-block;
        }
        .sm_btn_container {
            position: absolute;
            bottom: 0;
        }
        .sm_btn_container span{
            background: transparent;
            border: 1px solid #9B8CE5;
            color: #9B8CE5;
            padding: 3px 10px;
            margin-right: 5px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            font-size: 10px;
            display: inline-block;
        }
        .article-title {
            font-size: 12px;
            height: 35px;
            overflow: hidden;
        }
    </style>
    <style type="text/css">
        .tabs{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .tab{
            width: 50%;
            padding: 10px 20px;
            text-align: center;
        }
        .tab a{
            color: #000000;
            background-color: #f3f3f3;
            border-bottom: 1px solid #ddd;
            display: block;
            padding: 7px;
            border-radius: 5px;
        }
        .tab.active a{
            background: #9B8CE5;
            color: #ffffff;
        }
        .tab-content{
            display: none;
        }
        .tab-content.active{
            display: inherit;
        }
    </style>
</head>

<body>

<section style="padding: 5px;" >

    <div class="tabs">
        <div class="tab {if $type=='me'}active{/if} ">
            <a href="/phone/leader/report/list?type=me">我的总结</a>
        </div>
        <div class="tab {if $type=='all'}active{/if}">
            <a href="/phone/leader/report/list?type=all">所有总结</a>
        </div>
    </div>

    {if !empty($list)}
    {loop $list  $row}
    <div class="article">
        <a href="javascript::void(0)">
            <div class="flex-single">
                <div style="width:38.4%;">
                    <div class="article-img" style="background-image: url(<?php echo Common::img($row['line']['litpic'])?>); "></div>
                </div>
                <div style="padding-left:10px;width:61.6%; position:relative;">
                    <div class="article-title">
                        {$row['line']['title']}
                    </div>
                    {if $row['leader']['nickname']}
                    <div class="article-time">领队：{$row['leader']['nickname']}</div>
                    {/if}
                    {if $row['suit']['day']}
                    <div class="article-time">{date('Y/m/d',$row['suit']['day'])}</div>
                    {/if}
                    <div class="sm_btn_container" >
                        <a href="/phone/leader/report/view?id={$row['id']}"><span>查看总结</span></a>
                    </div>
                </div>
            </div>
        </a>
    </div>
    {/loop}
    {else}
    <div class="no-order">
        <div>
            您还没有写过总结哦
        </div>
    </div>
    {/if}
</section>

{request 'pub/code'}


</body>
</html>
