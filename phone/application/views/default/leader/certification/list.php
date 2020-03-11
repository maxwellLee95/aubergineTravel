<!DOCTYPE html>
<html>
<head >
    <meta charset="UTF-8">
    <title>领队认证</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::js('lib-flexible.js')}
    {Common::js('jquery.min.js,swiper.min.js,jquery.validate.min.js,jquery.layer.js,template.js,layer/layer.m.js')}
    <style>
        .score-list>ul {
            list-style: none;
            background: #fff;
            padding: 0 0.24rem;
        }
        .score-list>ul>li {
            height: 50px;
            border-bottom: 1px solid #e5e5e5;
            position: relative;
            padding: 7px 0;
        }
        .score-list>ul>li>.txt {
            width: 200px;
        }
        .score-list>ul>li>.txt>.name {
            color: #666666;
            font-size: 14px;
            display: block;
            line-height: 30px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .score-list>ul>li>.txt>.date {
            color: #d9a367;
        }
        .score-list>ul>li>.num {
            position: absolute;
            top: 7px;
            right: 0;
            overflow: hidden;
            max-height: 50px;
            max-width: 80px;
        }
        .score-list>ul>li>.num img {
            height: 50px;
            max-width: 80px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
<div>
    {if $list}
    <div class="score-list" id="has_content" style="display: block;">
        <ul id="score_content">
            {loop $list $row}
            <li>
                <div class="txt">
                    <span class="name">{$row['title']}</span>
                    <span class="date">积分：+{$row['integral']}</span></div>
                <div class="num"> <a href="/phone/leader/certification/edit?id={$row['id']}"><img src="{if $row['certification']['image']}{$row['certification']['image']}{else}/phone/public/images/nopicture.png{/if}"></a></div>
            </li>
            {/loop}
        </ul>
    </div>
    {else}
    <div class="no-info-bar" style="">没有更多内容了！</div>
    {/if}

</div>
</body>
</html>