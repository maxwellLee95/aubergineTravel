<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>会员中心-{$webname}</title>
    {include "pub/varname"}
    {Common::css('user.css,base.css,extend.css')}
    {Common::js('jquery.min.js,base.js,common.js')}
</head>
<body>
{request "pub/header"}
<div class="big">
<div class="wm-1200">

<div class="st-guide">
    <a href="{$cmsurl}">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;会员中心
</div><!--面包屑-->
<div class="st-main-page">
{include "member/left_menu"}
<div class="user-order-box">
    <div class="user-home-box">
        {if (empty($info['email']) || empty($info['mobile'])||empty($info['nickname'])||empty($info['truename'])||empty($info['cardid'])||empty($info['address']))}
        <div class="hint-msg-box">
            <span class="close-btn">关闭</span>
            <p class="hint-txt">
                {if empty($info['email']) || empty($info['mobile'])}
                  温馨提示：请完善手机/邮箱信息，避免错过产品预定联系等重要通知!
                {elseif (empty($info['nickname'])||empty($info['truename'])||empty($info['cardid'])||empty($info['address']))}
                  温馨提醒：请完善个人资料信息，体验更便捷的产品预定流程！
                {/if}
            </p>
        </div>
        <script>
            $(function(){
                $('.close-btn').click(function(){
                    $('.hint-msg-box').hide(500);
                })
            })
        </script>
        {/if}
        <div class="user-home-msg">
            <div class="user-msg-con">
                <div class="user-pic"><a href="/member/index/userinfo"><img src="{$info['litpic']}" width="90" height="90" /></a></div>
                <div class="user-txt">
                    <p class="name">{$info['nickname']}</p>
                    <p class="mail-box">登录邮箱：
                        {if $info['email']}{$info['email']}{else}未绑定<a href="{$cmsurl}member/index/modify_email?change=0">立即绑定</a>{/if}</p>
                    <p class="phone-num">手机号码：
                        {if $info['mobile']}{$info['mobile']}{else}未绑定<a href="{$cmsurl}member/index/modify_phone?change=0">立即绑定</a>{/if}</p>
                </div>
            </div><!-- 账号信息 -->
            <div class="user-msg-tj">
                <ul>
                    <li class="my-jf" data-url="/member/index/jifen">
                        <em></em>
                        <span>我的积分</span>
                        <strong>{$info['jifen']}</strong>
                    </li>
                    <li class="un-fk" data-url="/member/order/all-unpay">
                        <em></em>
                        <span>未付款</span>
                        <strong>{$info['unpay']}</strong>
                    </li>
                    <li class="un-dp" data-url="/member/order/all-uncomment">
                        <em></em>
                        <span>未点评</span>
                        <strong>{$info['uncomment']}</strong>
                    </li>
                    <li class="my-zx" data-url="/member/index/myquestion">
                        <em></em>
                        <span>我的咨询</span>
                        <strong>{$info['question']}</strong>
                    </li>
                </ul>
            </div><!-- 订单信息 -->
        </div>
        <div class="user-home-order">
            <div class="order-tit">最新订单</div>
            {if !empty($neworder)}
            <div class="order-list">
                <table width="100%" border="0">
                    <tr>
                        <th width="55%" height="38" scope="col">订单信息</th>
                        <th width="15%" height="38" scope="col">订单金额</th>
                        <th width="15%" height="38" scope="col">订单状态</th>
                        <th width="15%" height="38" scope="col">订单操作</th>
                    </tr>
                    {loop $neworder $order}
                    <tr>
                        <td height="114">
                            <div class="con">
                                <dl>
                                    <dt><a href="{$order['producturl']}" target="_blank"><img src="{$order['litpic']}" alt="{$order['title']}" /></a></dt>
                                    <dd>
                                        <a class="tit" href="{$order['producturl']}" target="_blank">{$order['productname']}</a>
                                        <p>订单编号：{$order['ordersn']}</p>
                                        <p>下单时间：{Common::mydate('Y-m-d H:i:s',$order['addtime'])}</p>
                                    </dd>
                                </dl>
                            </div>
                        </td>
                        <td align="center"><span class="price"><i class="currency_sy">{Currency_Tool::symbol()}</i>{$order['price']}</span></td>

                        <td align="center"><span class="dfk">{$order['status']}</span></td>
                        <td align="center">


                            {if $order['status']=='等待付款'}
                            <a class="now-fk" href="{$cmsurl}member/index/pay?ordersn={$order['ordersn']}">立即付款</a>
                            <a class="cancel_order now-dp" style="background:#ccc" href="javascript:;" data-orderid="{$order['id']}">取消</a>
                            {elseif $order['status']=='交易完成' && $order['ispinlun']!=1}
                             <a class="now-dp" href="{$cmsurl}member/order/pinlun?ordersn={$order['ordersn']}">立即点评</a>
                            {/if}

                            <a class="order-ck" href="{$cmsurl}member/order/view?ordersn={$order['ordersn']}">查看订单</a>


                        </td>
                    </tr>
                    {/loop}

                </table>
            </div>
            {else}
                <div class="order-no-have"><span></span><p>您的订单空空如也，<a href="/">去逛逛</a>去哪儿玩吧！</p></div>
            {/if}
        </div><!-- 我的订单 -->
        <div class="guess-you-like">
            <div class="like-tit">猜你喜欢的</div>
            <div class="like-list">
                <ul>

                     {st:line action="query" flag="order" row="4" return="recline"}
                        {loop $recline $line}
                        <li {if $n%4==0}class="mr_0"{/if}>
                            <div class="pic"><a href="{$line['url']}" target="_blank"><img src="{Common::img($line['litpic'])}" alt="{$line['title']}" /></a></div>
                            <div class="con">
                                <a href="{$line['url']}" target="_blank">{$line['title']}</a>
                                <p>
                                    {if !empty($line['sellprice'])}
                                    <del>市场价：<i class="currency_sy">{Currency_Tool::symbol()}</i>{$line['sellprice']}</del>
                                    {/if}
                                    {if !empty($line['price'])}
                                        <span><i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$line['price']}</b>元起</span>
                                    {else}
                                        <span>电询</span>
                                    {/if}
                                </p>
                            </div>
                        </li>
                       {/loop}
                </ul>
            </div>
        </div><!-- 猜你喜欢的 -->
    </div>
</div><!--会员首页-->

</div>

</div>
</div>
{Common::js('layer/layer.js')}
{request "pub/footer"}
<script>
    $(function(){
        $("#nav_index").addClass('on');

        $(".user-msg-tj li").click(function(){
            var url = $(this).attr('data-url');
            if(url!=''){
                location.href = url;
            }
        })


    })
</script>
{include "member/order/jsevent"}
</body>
</html>
