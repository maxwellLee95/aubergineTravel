<!DOCTYPE html>
<html>
<head >
    <meta charset="UTF-8">
    <title>领队考试</title>
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
            top: 15px;
            right: 10px;
            overflow: hidden;
            font-size: 16px;
        }
        .score-list>ul>li>.num a {
            text-decoration: none;
            color: #666666;
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
                    <span class="date">时间：{$row['time']}分钟</span></div>
                <div class="num">
                    {if $row['result']}
                        {if $row['result']['is_passed']}
                            <a href="javascript::void(0)" >合格</a>
                        {else}
                            <a href="/phone/leader/exam/index?id={$row['id']}">
                                不合格,重考
                            </a>
                        {/if}
                    {else}
                        <a href="/phone/leader/exam/index?id={$row['id']}">
                            我要考试
                        </a>
                    {/if}

                </div>
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