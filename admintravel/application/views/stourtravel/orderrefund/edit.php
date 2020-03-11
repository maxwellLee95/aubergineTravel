<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>订单查看--茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }


</head>
<body style="background-color: #fff">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt colspan="2"><h3>订单信息</h3></dt>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">产品名称：</dt>
            <dd>
                 {$info['productname']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">出发日期：</dt>
            <dd>{$info['usedate']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">人数{if $typeid==1}(成人){/if}：</dt>
            <dd>{$info['dingnum']}</dd>
        </dl>
        {if $info['insurance']}
        <dl class="list_dl" style="display:none;">
            <dt class="wid_90">保险：</dt>
            <dd>{$info['insurance']['payprice']}</dd>
        </dl>

        {/if}
		 <dl class="list_dl">
            <dt class="wid_90">学分抵现：</dt>
            <dd>{$info['jifentprice']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">价格{if $typeid==1}(成人){/if}：</dt>
            <dd>{$info['price']}</dd>
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
        {if isset($tourer)}
         {loop $tourer $r}
        <dl class="list_dl">
            <dt class="wid_90">游客{$n}：</dt>
            <dd style="height: auto">
                <ul>
                    <li>姓名:{$r['tourername']}</li>
                    <li>性别:{$r['sex']}</li>
                    <li>手机:{$r['mobile']}</li>
                    <li>证件:{$r['cardtype']}</li>
                    <li>证件号码:{$r['cardnumber']}</li>
                </ul>

            </dd>
        </dl>
        {/loop}
        {/if}
        <dl class="list_dl">
            <dt class="wid_90">预订说明：</dt>
            <dd style="height: auto">{$info['remark']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd>{$info['statusname']}</dd>
        </dl>
    </div>
    <hr>
   <form id="frm" name="frm">
       <dl class="list_dl">
           <dt colspan="2"><h3>退款信息</h3></dt>
       </dl>
       <div class="out-box-con">
           <dl class="list_dl">
               <dt class="wid_90">订单号：</dt>
               <dd>{$order_refund['ordersn']}</dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">申请时间：</dt>
               <dd>{$order_refund['addtime']}</dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">审批时间：</dt>
               <dd>{$order_refund['modtime']}</dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">支付平台：</dt>
               <dd>{$order_refund['platformname']}</dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">订单状态：</dt>
               <dd>
                   {loop $statusnames $k $v}
                   <input name="status" type="radio" class="checkbox" value="{$k}" {if $order_refund['status']==$k}checked="checked"{/if}  />{$v}
                   {/loop}
               </dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">退款金额：</dt>
               <dd style="color: red">{$order_refund['price']}</dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">退款操作说明：</dt>
               <dd style="color: red">若同意退款，将会直接退到消费账号，无法撤消，请注意！（并且只能执行一次同意退款操作）</dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">&nbsp;</dt>
               <dd>
                   {if $order_refund['status']==1}
                   已执行退款成功

                   {else}
                       <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                       <input type="hidden" id="id" name="id" value="{$order_refund['id']}">
                   {/if}
               </dd>
           </dl>
       </div>
   </form>

<script language="JavaScript">



    $(function(){
        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"orderrefund/ajax_save",
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
                    window.location.reload();


                }});

        })


    })

</script>

</body>
</html>