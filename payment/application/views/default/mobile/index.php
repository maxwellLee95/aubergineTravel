<link href="/payment/public/css/mpay.css" rel="stylesheet" media="screen" type="text/css" />
<style>
    .new-index-nav{
        display: none;
    }
</style>
<section>
    <div class="mid_content">
        <div class="payment_page_pic"><img src="/payment/public/images/mobile/st-order-zhifu.gif" /></div>

        <div class="confirm_order_msg">
            <ul>
                <li><span>订单号：</span><?php echo $info['ordersn'];?></li>
                <li><span>产品名称：</span><?php echo $info['productname'];?></li>
                <li><span>产品编号：</span><?php echo $number;?></li>
                <li><span>购买时间：</span><?php echo date('Y年m月d日 H:i:s')?></li>
            </ul>
        </div>

        <div class="payway">
            <ul>
                <li class="l1"><strong>支付方式</strong><?php if($info['dingjin']>0&& $info['paytype']=2):?><span>定金支付</span><?php endif;?></li>
                <li class="l2">
                    <p><strong>总金额</strong><em><?php  echo Currency_Tool::symbol();  ?><?php echo $info['total_fee'];?></em></p>
                    <?php if($info['usejifen']==1):?>
                    <p><strong>学分抵现</strong><em><?php  echo Currency_Tool::symbol();  ?>-<?php echo $info['jifentprice'];?></em></p>
                    <?php endif;?>
                    <p><strong>实际支付</strong><span><?php  echo Currency_Tool::symbol();  ?><?php echo $info['total'];?></span></p>
                </li>
                <li class="l3" id="mobile_common_pay">
                    <?php foreach($pay_method as $v):?>
                    <a id="m_<?php echo $v['id'];?>" href="javascript:" <?php if(isset($v['selected']) && $v['selected']):?>class="on"<?php endif;?> data="<?php echo "ordersn={$info['ordersn']}&method={$v['id']}";?>"><img src="<?php echo $v['img'];?>" /></a>
                    <?php endforeach;?>
                </li>
            </ul>
        </div>
    </div>

</section>
<script>
    $(document).ready(function(){
        if($('#mobile_common_pay').find('a.on').length>0){
          $('.bom_link_box').removeClass('hide');
        }
        $('#mobile_common_pay').find('a').click(function(){
            $(this).addClass('on').siblings('a').removeClass('on');
        });
    });
</script>