<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=2"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=18"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">


    <script>
        var _hmt = _hmt || [];
    </script>
    <style>
        .ranking {
            height: 100px;
            border-bottom: 10px #efefef solid;
        }
        .ranking ul{
            width: 200px;
            margin: 0 auto;
        }
        .ranking ul li{
            float: left;
            padding: 10px;
        }
        .ranking-name {
            padding: 20px;
            color: #000000;
        }
    </style>

</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<link href="/phone/public/css/wechat/index_new.css?v=1" type="text/css" rel="stylesheet" />
<div class="content">
    <div class="ranking-content">
        <div class="ranking-name">排行榜</div>
        <div class="ranking">
            <ul>
                {loop $ranking_leaders $k $row}
                <li>
                    <a href="javascript::void(0)">
                        <div>
                            <img class="img-circle" src="{$row['litpic']}" width="40" height="40" alt="领队头像">
                        </div>
                        <div>{$ranking_name[$k]}</div>
                    </a>
                </li>
                {/loop}
                <div class="clear"></div>
            </ul>
        </div>

    </div>
    <div class="leader-dynamic">
        <div class="leader-dynamic-content">
            {loop $leaders $row}
            <div class="leader-dynamic-list">
                <div class="leader-msg pull-left">
                    <a href="javascript::void(0)">
                        <div>
                            <img class="img-circle" src="{$row['litpic']}" width="40" height="40" alt="领队头像">
                        </div>
                        <div>{$row['nickname']}</div>
                    </a>
                </div>
                <div class="leader-dynamic-main pull-right">
                    {loop $row['activitys'] $activity}
                    <div class="leader-activity-dynamic">
                        <a href="javascript::void(0)">
                            <div class="leader-activity-name">{$activity['title']}</div>
                            <div class="leader-activity-status">
                                <div class="pull-left leader-activity-department-time">{date('m月d日',$activity['day'])}出发</div>
                                <div style="display: none"  class="leader-activity-msg pull-right">
                                    <div class="triangle2 ss"></div>
                                    <span class="{$activity['status']['style']}" >{$activity['status']['name']}</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </div>
                    {/loop}
                </div>
                <div class="clear"></div>
            </div>
            {/loop}
        </div>
    </div>
</div>

</body>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<!-- <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.3/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<script type="text/javascript">
    function adapt(e){
        var divWidth = $(e).parent().width(); //div宽度
        var divHeight = $(e).parent().height(); //div高度

        var img = new Image();
        img.src =$(e).attr("src");
        var imgWidth = img.width; //图片实际宽度
        var imgHeight = img.height;

        var d = 0;
        if ( (imgWidth < imgHeight) || (imgWidth > divWidth) ) {
            d = 0;
            var style = "width: 100%; height: auto;";
        } else {
            d = 1;
            var style = "height: 100%; width: auto;";
        }

        /* if ( imgWidth > divWidth ) {
                var l = parseInt(imgWidth-divWidth)/8;
                if (d) {
                    style += "left: -50%; margin-left: " + l + "px;";
                }
            }

            if ( imgHeight > divHeight ) {
                var t = parseInt(imgHeight-divHeight)/8;
                if (d == 0) {
                    style += "top: -50%; margin-top: -" + t + "px;";
                }
            } */

        $(e).attr("style", style);
    }
</script>

<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
</script>
</html>