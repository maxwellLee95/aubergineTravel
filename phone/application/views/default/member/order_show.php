<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$info['productname']}-{$GLOBALS['cfg_webname']}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {php echo Common::css('amazeui.css,style.css,extend.css');}
    {php echo Common::js('jquery.min.js,amazeui.js,template.js,layer/layer.m.js');}
    <style>
        .join-hiker {
            float: left;
            width: 20%;
            padding: 0 5px;
            text-align: center;
        }
        .join-hiker a {
            display: inline-block;
            width: 100%;
            padding-top: 10px;
            overflow: hidden;
            position: relative;
        }
        .hiker-img {
            text-align: center;
            position: relative;
        }
        .hiker-name {
            text-align: center;
            font-size: 12px;
            color: #727272;
            height: 20px;
        }
        .leader-level {
            position: absolute;
            right: -5px;
            top: 0;
            width: 16px;
        }
        .img-circle {
            border-radius: 50%;
        }

    </style>
</head>

<body>
{request "pub/header/typeid/$typeid/isorder/1"}

<section>

    <div class="mid_content">
        <div class="confirm_order_msg">
            <dl>
                <dt><img src="{Common::img($info['litpic'])}"></dt>
                <dd>
                    <span>{$info['productname']}</span>
                    <strong style="display: none">¥<b>{$info['price']}</b>起</strong>
                </dd>
            </dl>
            {if $order_linkman}
            <span style="padding-left: 5px;color: #333;">出游人详情</span>
                <ul>
                    {loop $order_linkman $row}
                        <li><span>姓名：</span>{$row['tourername']}</li>
                        <li><span>身份证：</span>{$row['cardtype']}</li>
                        <li><span>身份证：</span>{$row['cardnumber']}</li>
                        <li><span>手机：</span>{$row['mobile']}</li>
                    {/loop}
                </ul>
            {/if}
            <span style="padding-left: 5px;color: #333;">订单详情</span>
            <ul>
                <li><span>订单编号：</span>{$info['ordersn']}</li>
                <li><span>订单时间：</span>{date('Y-m-d',$info['addtime'])}</li>
                <li><span>订单状态：</span><em class="no">{if $info['status']==5}交易成功{elseif $info['status']==4}已退款{elseif $info['status']==3}取消订单{elseif $info['status']==2}付款成功{elseif $info['status']==1}待付款{else}等待处理{/if}</em></li>
            </ul>
            {if $order_refund}
            <span style="padding-left: 5px;color: #333;">退款详情</span>
            <ul>
                <li><span>申请时间：</span>{date('Y-m-d',$order_refund['addtime'])}</li>
                {if $order_refund['modtime']}
                <li><span>审核时间：</span>{date('Y-m-d',$order_refund['modtime'])}</li>
                {/if}
                <li><span>退款金额：</span>{$order_refund['refund_fee']}</li>
                <li><span>退款状态：</span><em class="no">{Model_Member_Order_Refund::getStatusName($order_refund['status'])}</em></li>
            </ul>
            {/if}

            {if $leaders}
            <div class="dp_con_box">
                <span class="tit">领队详情(点击头像即给对应领队打赏哦)</span>
                <div class="join-hikers" style="height: 85px;overflow: hidden;">
                    {loop $leaders $row}
                    <div class="join-hiker">
                        <a href="/phone/member/bounty/leader?id={$row['id']}">
                            <div class="hiker-img">
                                <div style="position:relative; display:inline-block;">
                                    <div style="position:relative; display:inline-block; overflow:hidden; border-radius:50%;">
                                        <img class="img-circle" src="{$row['litpic']}" style="width:45px; height:45px;">
                                    </div>
                                </div>
                            </div>
                            <div class="hiker-name" style="font-size: 14px;">{$row['nickname']}</div>
                        </a>
                    </div>
                    {/loop}
                    <div class="clear"></div>
                </div>
            </div>
            {/if}

            <div class="total">总额：<span><i class="currency_sy">{Currency_Tool::symbol()}</i>{$info['total']}</span></div>

        </div>

        {if $info['ispinlun']}
        <div class="dp_con_box">
            <span class="tit">总体点评</span>
            <ul class="dp_list">
                <li>
                    <dl>
                        <dt>
                            <span class="name"><img src="{$member['litpic']}">{$member['nickname']}</span>
                            <span class="myd">星评：<b>{$comment['level']}星</b></span>
                        </dt>
                        <dd>{$comment['content']}</dd>
                    </dl>
                </li>
            </ul>
            {if $leader_comment}
            <span class="tit">领队点评</span>
            <ul class="dp_list">
                {loop $leader_comment $row}
                <li>
                    <dl>
                        <dt>
                            <span class="name"><img src="{$row['leader']['litpic']}">{$row['leader']['nickname']}</span>
                            <span class="myd">星评：<b>{$row['level']}星</b></span>
                        </dt>
                        <dd>{$row['content']}</dd>
                    </dl>
                </li>
                {/loop}
            </ul>
            {/if}
        </div>
        {/if}
    </div>
</section>
<!---->
<!--{if $info['status']==1 || ( empty($info['ispinlun']) && $info['status']==5)}-->
<!--<div class="bom_link_box">-->
<!--    <div class="bom_fixed">-->
<!--        {if $info['status']==1}-->
<!--        <a class="on" href="{$info['payurl']}">付款</a>-->
<!--        {/if}-->
<!--        {if empty($info['ispinlun']) && $info['status']==5}-->
<!--            <a class="dp" href="{$cmsurl}member/comment/index?id={$info['id']}">立即点评</a>-->
<!--        {/if}-->
<!--    </div>-->
<!--</div>-->
<!--{/if}-->

</body>
</html>
