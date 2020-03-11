<!DOCTYPE html>
<html>
<head>
    <title>我的账户</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">


    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>

</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<div id="getLoading">
    <div class="get-loading-main">
        <img src="/phone/public/images/wechat/loading2.gif" width="20" height="20">
        <div class="getloading"></div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/v4/flex_box.css">
<style type="text/css">
    body,html {
        background-color: #ffffff;
    }
    .loading {
        height: auto;
        line-height: 1.1;
        padding-left: 5px;
        padding-right: 5px;
        background-position: center 15px;
        background-size: 35px;
        padding-top: 60px;
        padding-bottom: 15px;
        left: 50%;
        width: auto;
        max-width: 80%;
        min-width: 122px;
    }
    .content {
        padding-bottom: 0;
    }
    .tipBox ,
    .cardsBox {
        width: 100%;
        padding: 15px;
    }
    .tipBox {
        padding-top: 0;
        font-size: 12px;
    }
    .cardsBox>a {
        display: block;
        margin-bottom: 15px;
    }
    .cardsBox>a:hover .cardBox ,
    .cardsBox>a:focus .cardBox {
        top: 2px;
        left: 2px;
        -webkit-box-shadow: 2px 2px 2px rgba(204, 204, 204, 0.4);
        box-shadow: 2px 2px 2px rgba(204, 204, 204, 0.4);
        -webkit-transition-property: top,left,box-shadow,-webkit-box-shadow;
        -o-transition-property: top,left,box-shadow,-webkit-box-shadow;
        transition-property: top,left,box-shadow,-webkit-box-shadow;
        -webkit-transition-duration: .1s;
        -o-transition-duration: .1s;
        transition-duration: .1s;
    }
    .cardBox {
        position: relative;
        width: 100%;
        padding: 30px 15px;
        -webkit-box-shadow: 5px 5px 5px rgba(204, 204, 204, 0.4);
        box-shadow: 5px 5px 5px rgba(204, 204, 204, 0.4);
        background-color: #fff;
        border-radius: 5px;
        font-size: 16px;
        top: 0;
        left: 0;
        /*font-weight: 700;*/
        -webkit-transition-property: top,left,box-shadow,-webkit-box-shadow;
        -o-transition-property: top,left,box-shadow,-webkit-box-shadow;
        transition-property: top,left,box-shadow,-webkit-box-shadow;
        -webkit-transition-duration: .1s;
        -o-transition-duration: .1s;
        transition-duration: .1s;
    }
    .iconBox {
        margin-right: 10px;
        width: 50px;
        height: 30px;
        background-repeat: no-repeat;
        background-size: auto 100%;
        background-position: center center;
    }
    .hasTriangle {
        position: relative;
        margin-right: 15px;
        z-index: 3;
        line-height: 30px;
        height: 30px;
    }
    .hasTriangle:after {
        content: ' ';
        position: absolute;
        z-index: -2;
        height: 10px;
        width: 10px;
        margin: 0 auto;
        top: 10px;
        right: -12px;
        border-radius: 2px;
        background-color: #999;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .hasTriangle:before {
        content: ' ';
        position: absolute;
        z-index: -1;
        height: 10px;
        width: 10px;
        margin: 0 auto;
        top: 10px;
        right: -10px;
        border-radius: 2px;
        background-color: #fff;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .tipTitle {
        /*font-size: 16px;*/
        /*padding: 5px 0;*/
    }
    .tipDetails {

    }
    .tipDetails>li:nth-child(odd) {
        /*font-size: 16px;*/
        padding-top: 10px;
        color: #9B8CE5;
        font-weight: 700;
    }
    .tipDetails>li:nth-child(even) {
        padding-top: 5px;
        padding-left: 20px;
    }
</style>
<div class="content">
    <div class="cardsBox">
        <a href="/phone/member/integral/list">
            <div class="cardBox flex-base justify-between items-center">
                <div>
                    <div class="flex-base justify-between items-center">
                        <div class="iconBox" style="background-image: url('/phone/public/images/wechat/account/score.png')" title="可用学分"></div>
                        <div>可用学分</div>
                    </div>
                </div>
                <div class="hasTriangle">{$me['jifen']}学分</div>
            </div>
        </a>
        <a href="/phone/member/commission/list">
            <div class="cardBox flex-base justify-between items-center">
                <div>
                    <div class="flex-base justify-between items-center">
                        <div class="iconBox" style="background-image: url('/phone/public/images/wechat/account/distribution.png')" title="可用分销佣金"></div>
                        <div>分销佣金提现</div>
                    </div>
                </div>
                <div class="hasTriangle">
                    &#165;{$me['commission']}</div>
            </div>
        </a>
    </div>
    <div class="tipBox">
        <div class="tipTitle">
            常见问题
        </div>
        <ul class="tipDetails">
            <li>1、什么是学分？</li>
            <li>学分分为可用学分和累计学分两种。每次活动结束后，会获得对应学分。累计的学分决定你的账号等级。可用学分可以用于物品兑换和报名时候抵扣报名费。使用学分兑换或抵扣后，账号等级不会降低。</li>
        </ul>
    </div>
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
</html>