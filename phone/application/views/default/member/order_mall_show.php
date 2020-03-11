<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$info['productname']}-{$GLOBALS['cfg_webname']}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {php echo Common::css('amazeui.css,style.css,extend.css');}
    {php echo Common::js('jquery.min.js,amazeui.js,template.js,layer/layer.m.js');}
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
            <span style="padding-left: 5px">商品详情</span>
                <ul>
                    <?php foreach ($order_product As $item) {?>
                        <li><span>商品名称：</span><?php echo $item->product_name?></li>
                        <li><span>商品单价：</span><?php echo $item->product_price?></li>
                        <li><span>商品数量：</span><?php echo $item->product_num?></li>
                        <li><span>商品实付：</span><?php echo $item->prodcut_pay_price?></li>
                    <?php } ?>
                </ul>
            <span style="padding-left: 5px">订单详情</span>
            <ul>
                <li><span>订单编号：</span>{$info['ordersn']}</li>
                <li><span>订单时间：</span>{date('Y-m-d',$info['addtime'])}</li>
                <li><span>订单状态：</span><em class="no">{if $info['status']==5}交易成功{elseif $info['status']==4}已退款{elseif $info['status']==3}取消订单{elseif $info['status']==2}付款成功{elseif $info['status']==1}待付款{else}等待处理{/if}</em></li>
            </ul>
            <span style="padding-left: 5px">配送信息</span>
            <ul>
                <li><span>客户姓名：</span>{$info['linkman']}</li>
                <li><span>联系电话：</span>{$info['linktel']}</li>
                <li><span>联系邮箱：</span>{$info['linkemail']}</li>
                <li><span>配送地址：</span>{$info['linkaddress']}</li>
            </ul>
            {if $order_refund}
            <span style="padding-left: 5px">退款详情</span>
            <ul>
                <li><span>申请时间：</span>{date('Y-m-d',$order_refund['addtime'])}</li>
                {if $order_refund['modtime']}
                <li><span>审核时间：</span>{date('Y-m-d',$order_refund['modtime'])}</li>
                {/if}
                <li><span>退款金额：</span>{$order_refund['refund_fee']}</li>
                <li><span>退款状态：</span><em class="no">{Model_Member_Order_Refund::getStatusName($order_refund['status'])}</em></li>
            </ul>
            {/if}

            <div class="total">总额：<span><i class="currency_sy">{Currency_Tool::symbol()}</i>{$info['total']}</span></div>


        </div>

        {if $info['ispinlun']}
        <div class="dp_con_box" style="display: none">
            <h3 class="tit">我的点评</h3>
            <ul class="dp_list">
                <li>
                    <dl>
                        <dt>
                            <span class="name"><img src="{$member['litpic']}">{$member['nickname']}</span>
                            <span class="myd">满意度：<b>{$comment['score']}</b></span>
                        </dt>
                        <dd>{$comment['content']}</dd>
                    </dl>
                </li>
            </ul>
        </div>
        {/if}
    </div>
</section>


<div class="bom_link_box">
    <div class="bom_fixed">
        {if $info['status']==1}
        <a class="on" href="{$info['payurl']}">付款</a>
        {/if}
        {if empty($info['ispinlun']) && $info['status']==5}
            <a class="dp" href="{$cmsurl}member/comment/index?id={$info['id']}">立即点评</a>
        {/if}
    </div>
</div>


</body>
</html>
