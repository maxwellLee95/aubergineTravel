<link href="/payment/public/css/pay.css" rel="stylesheet" media="screen" type="text/css" />
<div class="big">
    <div class="wm-1200">

        <div class="st-guide">
            <a href="/">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;在线支付
        </div><!--面包屑-->

        <div class="st-main-page">
            <div class="st-payment-way">
                <div class="payment-msg">
                    <div class="msg-tit">
                        <strong class="gfk">立即付款</strong>
                        <span>订单总额：<b><?php  echo Currency_Tool::symbol();  ?><?php echo $info['total'];?></b></span>
                    </div>
                    <div class="msg-list">
                        <ul>
                            <li><em>订单号：</em><a><?php echo $info['ordersn'];?></a></li>
                            <li><em>产品名称：</em><a target="_blank"><?php echo $info['productname'];?></a></li>
                            <li><em>产品编号：</em><?php echo $number;?></li>
                            <li><em>购买时间：</em><?php echo date('Y年m月d日 H:i:s')?></li>
                        </ul>
                    </div>
                </div><!-- 订单信息 -->
                <?php if(!empty($pay_method['online'])||!empty($pay_method['line'])):?>
                <div class="payment-con">
                    <h3>选择以下支付方式付款</h3>
                    <?php if(!empty($pay_method['online'])):?>
                    <div class="payment-line">
                        <dl>
                            <dt>线上支付</dt>
                            <dd>
                                <ul>
                                    <?php $i=1; foreach($pay_method['online'] as $k=>$v):?>
                                        <li data="<?php echo $v['id']; ?>" class="<?php if(isset($v['selected'])){ echo 'active';}?><?php if($i%5==0):?> mr_0<?php endif;?>">
                                            <span><img src="<?php echo $v['img'];?>" /></span>
                                            <?php if(isset($v['ext'])):?>
                                            <div class="txt"><?php echo $v['ext'];?></div>
                                            <?php endif;?>
                                        </li>
                                        <?php $i++;?>
                                    <?php endforeach;?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                        <?php  endif; ?>
                        <?php if(!empty($pay_method['line'])):?>
                    <div class="payment-line">
                        <dl>
                            <dt>线下支付</dt>
                            <dd>
                                <ul>
                                    <?php foreach($pay_method['line'] as $v):?>
                                    <li data="<?php echo $v['id']; ?>" class="<?php if(isset($v['selected'])){ echo 'active';}?>"><span><img src="<?php echo $v['img'];?>" /></span></li>
                                    <?php endforeach;?>
                                </ul>
                            </dd>
                        </dl>
                    <div class="offline-sm">
                        <?php echo Common::C('cfg_pay_xianxia');?>
                    </div>
                    </div>
                    <?php  endif; ?>
                    <div class="payment-now-btn"><a href="javascript:" class="error" id="st-payment-submit">立即付款</a></div>
                </div>
                <?php  endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="st-payment-back-box" id="st-payment-back-box" style="display: none">
    <div class="st-back-con">
        <h3>支付反馈</h3>
        <div class="payment-ts-con">
            <div class="payment-opp">
                <dl class="cg">
                    <dt></dt>
                    <dd><a href="/member/order/view?ordersn=<?php echo $info['ordersn'];?>">查看订单详情</a></dd>
                </dl>
                <dl class="sb">
                    <dt></dt>
                    <dd><a href="javascript:" id="st-payment-back-error">选择其他支付方式</a></dd>
                </dl>
            </div>
            <p class="ts">温馨提示：请您在新打开的网上银行页面进行支付，支付完成前请不要关闭该窗口。</p>
        </div>
    </div>
</div><!-- 支付返回框 -->
<script>
    var param={
        ordersn:'<?php echo $info['ordersn'];?>',
        <?php
          if($__token__){
          echo Common::C('token_name').':'."'{Common::C('token_name')}'";
          }
        ?>
    };
</script>
<script src="public/js/index.js"></script>