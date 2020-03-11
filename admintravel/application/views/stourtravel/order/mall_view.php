<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>订单查看--茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }


</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt colspan="2"><h3>订单信息</h3></dt>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单名称：</dt>
            <dd>
                 {$info['productname']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单日期：</dt>
            <dd>{$info['usedate']}</dd>
        </dl>
		 <dl class="list_dl">
            <dt class="wid_90">学分抵现：</dt>
            <dd>{$info['jifentprice']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">总价：</dt>
            <dd>{$info['price']}</dd>
        </dl>
        <dl class="list_dl">
            <dt colspan="2"><h3>商品信息</h3></dt>
        </dl>
        <?php foreach ($info['order_product'] as $item){ ?>
            <dl class="list_dl">
                <dt class="wid_90">商品名称：</dt>
                <dd><?php echo $item->product_name?></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">商品单价：</dt>
                <dd><?php echo $item->product_price?></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">商品数量：</dt>
                <dd><?php echo $item->product_num?></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">商品实付：</dt>
                <dd><?php echo $item->prodcut_pay_price?></dd>
            </dl>
            <hr>
        <?php }?>

        <dl class="list_dl">
            <dt colspan="2"><h3>配送信息</h3></dt>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">客户姓名：</dt>
            <dd>{$info['linkman']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd>{$info['linktel']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">联系邮箱：</dt>
            <dd>{$info['linkemail']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">身份证号码：</dt>
            <dd>{$info['linkidcard']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">配送地址：</dt>
            <dd>{$info['linkaddress']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd>
                {loop $statusnames $v}
                   <input name="status" type="radio" class="checkbox" value="{$v['status']}" {if $info['status']==$v['status']}checked="checked"{/if}  />{$v['name']}
                {/loop}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="id" name="id" value="{$info['id']}">
                <input type="hidden" id="typeid" name="typeid" value="{$typeid}">
            </dd>
        </dl>
        {if $info['status']!=5 && $info['status']==2}
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd><a href="/admintravel/orderrefund/add?ordersn={$info['ordersn']}" class="normal-btn">申请退款</a></dd>
        </dl>
        {/if}
    </div>
   </form>

<script language="JavaScript">



    $(function(){
        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"order/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {
                    try{
                        var data = $.parseJSON(response.responseText);
                    }
                    catch(e){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                        return false;
                    }

                    if(data.status)
                    {
                        ST.Util.showMsg('保存成功!','4',2000);
                    }


                }});

        })


    })

</script>

</body>
</html>