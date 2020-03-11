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
                                <dt>路线名称：</dt>
                                <dd>
                                    <span>{$info['line_name']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>活动天数：</dt>
                                <dd>
                                    <span>{$info['line_day']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>发布时间：</dt>
                                <dd>
                                    <span>{$info['release_time']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>踩点时间：</dt>
                                <dd>
                                    <span>{$info['lnspection_time']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>成本估算：</dt>
                                <dd>
                                    <span>{$info['cost_report']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>自主踩点时间：</dt>
                                <dd>
                                    <span>{$info['team_lnspection_time']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>踩点支出明细：</dt>
                                <dd>
                                    <span>{$info['registery_fee_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>目的地介绍：</dt>
                                <dd>
                                    <span>{$info['destination_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>景点描述：</dt>
                                <dd>
                                    <span>{$info['attraction_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>难度说明：</dt>
                                <dd>
                                    <span>{$info['difficult_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>游玩时长：</dt>
                                <dd>
                                    <span>{$info['pay_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>季节性说明：</dt>
                                <dd>
                                    <span>{$info['seasonal_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>亮点：</dt>
                                <dd>
                                    <span>{$info['highlight']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>建议：</dt>
                                <dd>
                                    <span>{$info['suggest']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>行程安排：</dt>
                                <dd>
                                    <span>{$info['schedule']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>出行方式：</dt>
                                <dd>
                                    <span>{$info['travel_mode']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>住宿类型：</dt>
                                <dd>
                                    <span>{$info['accommodation_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>餐饮安排：</dt>
                                <dd>
                                    <span>{$info['food_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>门票情况：</dt>
                                <dd>
                                    <span>{$info['ticket_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>装备安排：</dt>
                                <dd>
                                    <span>{$info['equipment_desc']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>备注：</dt>
                                <dd>
                                    <span>{$info['remarks']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>申请人：</dt>
                                <dd>
                                    <span>{$member['nickname']}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>申请人类型：</dt>
                                <dd>
                                    <span><?php echo $info['applicant_type']==2?'领队':'会员';?></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>状态：</dt>
                                <dd>
                                    <select name="status">
                                        <option value="0" >请选择</option>
                                        {loop $status_list $id $v}
                                        <option value="{$id}" {if $info['status']==$id}selected="selected"{/if}>{$v}</option>
                                        {/loop}
                                    </select>
                                </dd>
                            </dl>
                            <dl>
                                <dt>审核说明：</dt>
                                <dd>
                                    <input type="text" name="review_instructions" value="{$info['review_instructions']}" class="set-text-xh mt-2"/>
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
                url   :  SITEURL+"lineapply/ajax_save",
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
