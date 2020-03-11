<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,imageup.js,jquery.colorpicker.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>
<body>
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td"  valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td ">

            <div class="manage-nr">
                <div class="w-set-tit bom-arrow" id="nav">
                    <div class="w-set-tit bom-arrow">
                        <span class="on" id="column_basic" onclick="Product.switchTab(this,'basic')"><s></s>基础信息</span>
                        <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                    </div>
                </div>

                <form id="product_fm">
                    <div class="product-add-div" id="content_basic">
                        <div class="add-class">
                            <input type="hidden" name="id" value="{$info['id']}">
                            <dl>
                                <dt>证书名称：</dt>
                                <dd>
                                    {$info['certificate']['title']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>领队：</dt>
                                <dd>
                                    {$info['leader']['nickname']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>积分：</dt>
                                <dd>
                                    {$info['certificate']['integral']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>证书：</dt>
                                <dd>
                                    <img style="max-width: 500px" src="{$info['image']}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>状态：</dt>
                                <dd>
                                    <select name="status">
                                        {loop $status_list $key $name}
                                        <option value="{$key}" <?php if($info['status']==$key) { ?>selected="selected"<?php } ?>
                                        >{$name}</option>
                                        {/loop}
                                    </select>
                                </dd>
                            </dl>
                            <dl>
                                <dt>申请时间：</dt>
                                <dd>
                                    {if $info['addtime']}
                                    {date("Y-m-d H:i:s",$info['addtime'])}
                                    {/if}
                                </dd>
                            </dl>
                            <dl>
                                <dt>审核时间：</dt>
                                <dd>
                                    {if $info['uptime']}
                                    {date("Y-m-d H:i:s",$info['uptime'])}
                                    {/if}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </form>


                <div class="opn-btn">
                    <a class="normal-btn ml5" id="btn_save" href="javascript:;">保存</a>
                </div>

            </div>
        </td>
    </tr>
</table>

<script>
    $(document).ready(function(){
        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"leadercertification/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "product_fm",
                datatype  :  "JSON",
                success  :  function(response, opts)
                {
                    var id= response.responseText;
                    if(id>0)
                    {
                        $("#id").val(id);
                        ST.Util.showMsg('保存成功!','4',2000);
                    }
                    else{
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }

                }});

        })

        $(".bg-color").colorpicker({
            ishex:true,
            success:function(o,color){
                $(o).val(color)
            },
            reset:function(o){

            }
        });


    });
</script>

</body>
</html>
