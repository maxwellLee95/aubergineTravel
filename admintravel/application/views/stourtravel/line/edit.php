<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,jqtransform.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    <script type="text/javascript" href="./public/js/product_add.js?time=sada"></script>
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,choose.js,st_validate.js,jquery.colorpicker.js,jquery.jqtransform.js,imageup.js,jquery.upload.js,insurance.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>



<body>
<!--顶部-->
{php Common::getEditor('jseditor','',700,300,'Sline','','print',true);}
<table class="content-tab">
<tr>
    <td width="119px" class="content-lt-td" valign="top">
        {template 'stourtravel/public/leftnav'}
        <!--右侧内容区-->
    </td>
    <td valign="top" class="content-rt-td" style="overflow:auto;">
            <div class="manage-nr">
                <div class="w-set-con">
                <div class="w-set-tit bom-arrow">
                    <span class="on" id="column_basic" onclick="Product.switchTab(this,'basic')"><s></s>基础信息</span>
                    <?php
                      foreach($columns as $col)
                      {
                         echo "<span id=\"column_".$col['columnname']."\" onclick=\"Product.switchTab(this,'".$col['columnname']."',switchBack)\"><s></s>".$col['chinesename']."</span>";
                      }
                    ?>
                    <span style="display: none" id="column_basic" onclick="Product.switchTab(this,'seo')"><s></s>优化</span>
                    <span style="display: none" id="column_basic" onclick="Product.switchTab(this,'extend')"><s></s>扩展设置</span>
                    <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                </div>
                </div>
                <form id="product_fm">
                <div id="content_basic" class="product-add-div content-show">
                    <div class="add-class">
                        <dl style="display: none">
                            <dt>站点：</dt>
                            <dd>
                                    <select name="webid">
                                        <option value="0" {if $info['webid']==0}selected="selected"{/if}>主站</option>
                                     <?php

                                       foreach($weblist as $web)
                                       {
                                           $is_selected=$web['webid']==$info['webid']?"selected='selected'":'';
                                           echo "<option ".$is_selected." value='".$web['webid']."'>".$web['webname']."</option>";
                                       }
                                       ?>
                                    </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路名称：</dt>
                            <dd>
                                <input type="text" name="title" data-required="true" class="set-text-xh text_700 mt-2" value="{$info['title']}"/>
                                <input type="hidden" name="lineid" id="line_id" value="<?php echo $info['id'];   ?>"/>
                                <div class="help-ico mt-9 ml-5">{php echo Common::getIco('help',11);}</div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路卖点：</dt>
                            <dd>
                                <input type="text" name="sellpoint" value="{$info['sellpoint']}"  class="set-text-xh text_700 mt-2"/>

                                <div class="help-ico mt-9 ml-5">{php echo Common::getIco('help',12);}</div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>出发地：</dt>
                            <dd>
                                <select name="startcity">
                                    <option value="0">请选择出发地</option>
                                {loop $startplacelist $place}
                                    <option value="{$place['id']}" {if $info['startcity']==$place['id']}selected="selected"{/if}>{$place['cityname']}</option>
                                {/loop}
                                </select>
                            </dd>
                        </dl>
                        <dl style="display: none">
                            <dt>供应商：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getSupplier(this,'.supplier-sel')" title="选择">选择</a>

                                <div class="save-value-div mt-2 ml-10 supplier-sel">
                                    {if !empty($info['supplier_arr']['suppliername'])}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$info['supplier_arr']['suppliername']}<input type="hidden" name="supplierlist[]" value="{$info['supplier_arr']['id']}"></span>
                                    {/if}

                                </div>
                            </dd>
                        </dl>
                    </div>

                    <div class="add-class">
                    <dl>
                            <dt>目的地选择：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getDest(this,'.dest-sel',1)" title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 dest-sel">
                                    {loop $info['kindlist_arr'] $k $v}

                                       <span class="{if $info['finaldestid']==$v['id']}finaldest{/if}" title="{if $info['finaldestid']==$v['id']}最终目的地{/if}" ><s onclick="$(this).parent('span').remove()"></s>{$v['kindname']}<input type="hidden" class="lk" name="kindlist[]" value="{$v['id']}"/>
                                           {if $info['finaldestid']==$v['id']}<input type="hidden" class="fk" name="finaldestid" value="{$info['finaldestid']}"/>{/if}</span>
                                    {/loop}
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路属性：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getAttrid(this,'.attr-sel',1)" title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 attr-sel wid_650">
                                    {loop $info['attrlist_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$v['attrname']}<input type="hidden" name="attrlist[]" value="{$v['id']}"></span>
                                    {/loop}

                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>集合点：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getMarshalPoint(this,'.marshal-point-sel')" title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 marshal-point-sel">
                                    {loop $info['marshal_point_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$v['name']}<input type="hidden" name="marshal_point[]" value="{$v['id']}"></span>
                                    {/loop}
                                </div></dd>
                        </dl>
                        <dl>
                            <dt>线路专题：</dt>
                            <dd>
                                {loop $theme_arr $id $v}
                                    <input <?php if(in_array($id,$info['themelist_arr'])){ echo 'checked';}?> type="checkbox"  name="themelist[]" value="{$id}" />{$v}
                                {/loop}
                            </dd>
                        </dl>
                    </div>

                    <div class="add-class">

                        
                        
                        <dl style="display: none">
                            <dt>保险：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Insurance.chooseDialog(this,'.insurance-sel',updateInsurance)" title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 wid_650 insurance-sel">
                                    {loop $info['insurance_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$v['productname']}<input type="hidden" name="insuranceids[]" value="{$v['id']}"></span>
                                    {/loop}
                                </div>
                            </dd>
                        </dl>
                        <dl>
                          <dt>上/下架：</dt>
                          <dd>
                              <label>
                                <input class="fl mt-8 mr-3" type="radio" name="ishidden"  {if $info['ishidden']==0}checked="checked"{/if} value="0">
                                <span class="fl mr-20">上架</span>
                              </label>
                              <label>
                                <input class="fl mt-8 mr-3" type="radio" name="ishidden"  {if $info['ishidden']==1}checked="checked"{/if} value="1">
                                <span>下架</span>
                              </label>
                          </dd>
                        </dl>
                        <dl>
                            <dt>旅游天数：</dt>
                            <dd>
                                <input type="text" value="{$info['lineday']}" data-regrex="number" data-required="true" data-msg="必须为数字" id="travel_days" class="set-text-xh text_60 mt-2" name="lineday"/>
                                <span class="fl ml-10">*天</span>
                                <input type="text" value="{$info['linenight']}" data-regrex="number" data-msg="必须为数字" class="set-text-xh text_60 mt-2 ml-10" name="linenight"/>
                                <span class="fl ml-10">晚</span>
                            </dd>
                            </dd>
                        </dl>
                        <dl>
                            <dt>提前天数：</dt>
                            <dd>
                                <span class="fl">建议提前</span>
                                <input type="text" name="linebefore" value="{$info['linebefore']}" data-regrex="number" data-msg="必须为数字" class="set-text-xh text_60 mt-2 ml-10"/>
                                <span class="fl ml-10">天报名</span>
                                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<input style="display:none" type="checkbox" name="islinebefore" value="1" {if $info['islinebefore']==1}checked="checked"{/if}/><span style="display:none" class="ml-5">报价显示限制提前天数</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>总成行人数：</dt>
                            <dd>
                                <input type="text" class="set-text-xh mt-2" name="person_count" value="{$info['person_count']}"/>
                            </dd>
                        </dl>
                        <dl>
                            <dt>最低成行人数：</dt>
                            <dd>
                                <input type="text" class="set-text-xh mt-2" name="min_person_count" value="{$info['min_person_count']}"/>
                            </dd>
                        </dl>
                        <dl>
                            <dt>市场价：</dt>
                            <dd>
                                <input type="text" value="{$info['storeprice']}" name="storeprice" class="set-text-xh text_60 mt-2"/><span class="fl ml-5">元</span>
                            </dd>
                        </dl>
                        <dl style="display: none">
                            <dt>往返交通:</dt>
                            <dd>
                                {loop $sysjiaotong $v}

                                 <input name="transport_pub[]" type="checkbox" class="checkbox" id="Transport{$n}" {if strpos($info['transport'],$v)!==false}checked="checked"{/if} value="{$v}">&nbsp;<label for="Transport{$n}">{$v}</label>
                                {/loop}

                                {loop $usertransport $user}
                                    {if !in_array($user,$sysjiaotong) && !empty($user)}
                                <input name="transport_pub[]" type="checkbox" class="checkbox" id="Transport_user_{$n}" checked="checked" value="{$user}">&nbsp;<label for="Transport_user_{$n}">{$user}</label>
                                    {/if}
                                {/loop}
                                <span id="addjt"></span>
                                <img style="line-height: 30px;vertical-align: middle;cursor: pointer" onclick="addJiaoTong()" src="{$GLOBALS['cfg_public_url']}images/tianjia.png">





                            </dd>
                        </dl>

                        <dl>
                            <dt>路线难度：</dt>
                            <dd>
                                <select name="difficultylevel">
                                    {loop $difficulty_list $id $v}
                                    <option value="{$id}" {if $info['difficultylevel']==$id}selected="selected"{/if}>{$v}</option>
                                    {/loop}
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路类型：</dt>
                            <dd>
                                <select name="line_type">
                                    <option value="1" {if $info['line_type']==1 || empty($info['line_type']) }selected="selected"{/if}>普通线路（默认）</option>
                                    <option value="2" {if $info['line_type']==2}selected="selected"{/if}>自选线路</option>
                                    <option value="3" {if $info['line_type']==3}selected="selected"{/if}>订制线路</option>
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>特别说明：</dt>
                            <dd>
                                <span style="color: red">设置路线后，需要到报价界面，设置对应的价格和领队，才能在用户页面上显示；如果只有价格，没有设置领队，只能在翻牌页面看到；否则该路线无效</span>
                            </dd>
                        </dl>
                        
 
                        <dl style="display: none">
                            <dt>儿童标准：</dt>
                            <dd>
                                <input type="text" class="set-text-xh mt-2" name="childrule" value="{$info['childrule']}"/>

                                <div class="help-ico mt-9 ml-5">{php echo Common::getIco('help',13);}</div>
                            </dd>
                        </dl>
                    </div>
                    <div class="add-class">
                        <dl>
                            <dt>保险说明：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_700 mt-2" name="insurance_tips" value="{$info['insurance_tips']}"/>
                            </dd>
                        </dl>
                        <dl>
                            <dt>推文链接：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_700 mt-2" name="custom_promotion_link" value="{$info['custom_promotion_link']}"/>
                            </dd>
                        </dl>
                        <dl>
                            <dt>微信分享描述：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_700 mt-2" name="share_desc" value="{$info['share_desc']}"/>
                            </dd>
                        </dl>
                    </div>
                    <div class="add-class">
                        <dl>
                            <dt>入群二维码：</dt>
                            <dd>
                                <div>
                                    <div id="qrcode_btn" class="uploadify" style="text-indent: -9999px; height: 25px; line-height: 25px; width: 85px; cursor: pointer; background-image: url('/admintravel/public/images/upload-ico.png');">
                                        上传图片
                                    </div>
                                    <div style="margin-top: 30px;">
                                        {if !empty($info['qrcode'])}
                                        <img style="max-width: 300px;" id="qrcode_img" src="{$info['qrcode']}"   />
                                        {else}
                                        <img style="max-width: 300px;" id="qrcode_img" src="#" />
                                        {/if}
                                    </div>
                                </div>
                                <input  type="hidden" class="set-text-xh text_700 mt-2" id="qrcode" name="qrcode" value="{$info['qrcode']}"/>
                            </dd>
                        </dl>
                        <dl>
                            <dt>二维码说明：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_700 mt-2" name="qrcode_text" value="{$info['qrcode_text']}"/>
                            </dd>
                        </dl>
                    </div>

                    <div style="display: none" class="add-class">
                        <dl>
                            <dt>显示模版：</dt>
                            <dd>
                                <div class="temp-chg" id="templet_list">
                                    <a {if $info['templet']=='line_show.htm'}class="on"{/if}  href="javascript:void(0)"  data-value="line_show.htm" onclick="setTemplet(this)">标准</a>
                                    <a {if $info['templet']=='line_new/line_show.htm'}class="on"{/if}  href="javascript:void(0)" data-value="line_new/line_show.htm" onclick="setTemplet(this)">模版1</a>
                                    {loop $templetlist $r}
                                    <a {if $info['templet']==$r['path']}class="on"{/if}  href="javascript:void(0)" data-value="{$r['path']}" onclick="setTemplet(this)">{$r['templetname']}</a>
                                    {/loop}
                                    <input type="hidden" name="templet" id="templet" value="{$info['templet']}"/>
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>标题颜色：</dt>
                            <dd><input type="text" name="color" value="{$info['color']}" class="set-text-xh text_100 mt-2 title-color"/></dd>
                        </dl>
                        <dl>
                            <dt>图标设置：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getIcon(this,'.icon-sel')" title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 icon-sel">
                                    {loop $info['iconlist_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s><img src="{$v['picurl']}"><input type="hidden" name="iconlist[]" value="{$v['id']}"></span>
                                    {/loop}
                                </div></dd>
                        </dl>
                        <dl>
                            <dt>显示数据：</dt>
                            <dd>
                                <span class="fl">推荐次数</span>
                                <input type="text" name="recommendnum" value="{$info['recommendnum']}" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10 mr-30"/>
                                <span class="fl">满意度</span>
                                <input type="text" name="satisfyscore" value="{$info['satisfyscore']}" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10 mr-30"/>
                                <span class="fl">销量</span>
                                <input type="text" name="bookcount" value="{$info['bookcount']}" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10"/>
                            </dd>
                        </dl>
                    </div>
                    <div  class="add-class">
                        <dl>
                            <dt>模块：</dt>
                            <dd>
                                {loop $index_module_arr $id $v}
                                    {$v} <input <?php if(in_array($id,$info['index_module_ids'])){ echo 'checked';}?> type="checkbox"  name="index_module_ids[]" value="{$id}" />
                                {/loop}
                            </dd>
                        </dl>
                        <dl>
                            <dt>首页标题：</dt>
                            <dd><input type="text" name="index_title" value="{$info['index_title']}" class="set-text-xh mt-2"/></dd>
                        </dl>
                        <dl>
                            <dt>首页小标题：</dt>
                            <dd><input type="text" name="index_sub_title" value="{$info['index_sub_title']}" class="set-text-xh mt-2"/></dd>
                        </dl>
                        <dl>
                            <dt>图标：</dt>
                            <dd id="dd_logo">
                                <div id="banner_btn" class="uploadify" style="height: 25px; width: 85px;"><div id="banner_btn-button" class="uploadify-button " style="text-indent: -9999px; height: 25px; line-height: 25px; width: 85px; cursor: pointer"><span class="uploadify-button-text">上传图片</span></div></div>
                                <?php
                                if($info['index_litpic'])
                                    echo "<div class='image-dv' id='image_logo'><div><img src=\"".$info['index_litpic']."\"/></div><div><a style='display: none' href='javascipt:;' onClick=\"delImage(this)\">删除</a><input type='hidden' name='index_litpic' value='".$info['index_litpic']."'/></div></div>";
                                ?>
                            </dd>
                        </dl>
                    </div>

                </div>
                
                <div id="content_jieshao" class="product-add-div content-hide">

                    <div class="ap-div-top">
                        <dl style="display: none">
                            <dt>排版方式：</dt>
                            <dd>
                                <div class="temp-chg">
                                    <a <?php if($info['isstyle']==2 ||empty($info['isstyle'])) echo 'class="on"';   ?> href="javascript:void(0)" onclick="togStyle(this,2)">标准版</a>
                                    <a <?php if($info['isstyle']==1) echo 'class="on"';   ?> href="javascript:void(0)" onclick="togStyle(this,1)">简洁版</a>

                                    <input type="hidden" name="isstyle" id="line_isstyle" value="{$info['isstyle']}"/>
                                </div>
                            </dd>
                        </dl>
                        <dl style="display: none">
                            <dt>用餐情况：</dt>
                            <dd>
                            <div class="on-off">
                              <input type="radio" id="" class="fl mt-8" onclick="togDiner(1)" name="showrepast" value="1" <?php if($info['showrepast']==1||!isset($info['showrepast'])) echo 'checked="checked"';   ?>>
                              <label class="fl mr-20 ml-5">显示</label>
                              <input type="radio" id="" class="fl mt-8" onclick="togDiner(0)" <?php if($info['showrepast']==0&&isset($info['showrepast'])) echo 'checked="checked"';   ?> name="showrepast" value="0">
                              <label class="fl mr-20 ml-5">隐藏</label>
                            </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="content-jieshao-simple" style="<?php  if(empty($info['isstyle'])||$info['isstyle']==2) echo 'display:none'   ?>">
                       <div><textarea name="jieshao" id="simple_jieshao">{$info['jieshao']}</textarea></div>
                    </div>
                    <div class="content-jieshao-detail" style="<?php  if($info['isstyle']==1) echo 'display:none'   ?>">
                        <?php


                           foreach($info['linejieshao_arr'] as $k=>$v)
                           {
                               $jiaotong = '';
                               $transport_arr=explode(',',$v['transport']);
                               foreach($sysjiaotong as $v1)
                               {
                                   $checkstatus = in_array($v1,$transport_arr) ? "checked='checked'" : '';
                                   $jiaotong.="<span class=\"fl\"><input class=\"fl mt-8\" type=\"checkbox\" ".$checkstatus."  name=\"transport[".$v['day']."][]\" value=\"".$v1."\"/></span>&nbsp;<label class=\"fl ml-5 mr-20\" style=\"cursor:pointer;\">".$v1."</label>";
                               }

                               foreach($transport_arr as $user)
                               {
                                    if(!in_array($user,$sysjiaotong) && !empty($user))
                                    {
                                       $jiaotong.="<span class=\"fl zdy\"><input checked='checked'  class=\"fl mt-8\" type=\"checkbox\"  name=\"transport[".$v['day']."][]\" value=\"".$user."\"/></span>&nbsp;<label class=\"fl ml-5 mr-20\" style=\"cursor:pointer;\">".$user."</label>";

                                    }

                               }
                               $jiaotong.=" <span id=\"addjt_".$v['day']."\"></span><img class='addimg' data-contain='addjt_".$v['day']."' data-day='".$v['day']."' style=\"line-height: 30px;vertical-align: middle;cursor: pointer\"  src=\"".$GLOBALS['cfg_public_url']."images/tianjia.png\">";


                               $breakfirst_check=$v['breakfirsthas']==1?'checked="checked"':'';
                               $lunch_check=$v['lunchhas']==1?'checked="checked"':'';
                               $supper_check=$v['supperhas']==1?'checked="checked"':'';
                               $transport_arr=explode(',',$v['transport']);
                               $car_check=in_array(2,$transport_arr)?'checked="checked"':'';
                               $train_check=in_array(3,$transport_arr)?'checked="checked"':'';
                               $plane_check=in_array(1,$transport_arr)?'checked="checked"':'';
                               $ship_check=in_array(4,$transport_arr)?'checked="checked"':'';
                               $food_style=$info['showrepast']==0?"display:none":'';
                               $dayspot= Model_Line::getDaySpotHtml($v['day'],$v['lineid']);
                               $jieshao='<div class="add-class">';
                               $jieshao.='<dl><dt>第'.$v['day'].'天：</dt>';
                               $jieshao.='<dd>';
                               $jieshao.='<input type="text" name="jieshaotitle['.$v['day'].']" value="'.$v['title'].'" class="set-text-xh text_700 mt-2"/></dd>';                                      $jieshao.='</dl>';
                               $jieshao.='<dl class="jieshao-diner" style="'.$food_style.'">';
                               $jieshao.='<dt>用餐情况：</dt>';
                               $jieshao.='<dd>';
                               $jieshao.='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="breakfirsthas['.$v['day'].']" '.$breakfirst_check.' value="1"></span>';
                               $jieshao.='<label style=" float:left; cursor: pointer;">早餐</label>';
                               $jieshao.='<span><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="breakfirst['.$v['day'].']" value="'.$v['breakfirst'].'"/></span>';
                               $jieshao.='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="lunchhas['.$v['day'].']" '.$lunch_check.' value="1"></span>';
                               $jieshao.='<label style=" float:left; cursor: pointer;">午餐</label>';
                               $jieshao.='<span><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="lunch['.$v['day'].']" value="'.$v['lunch'].'"/></span>';
                               $jieshao.='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="supperhas['.$v['day'].']" '.$supper_check.' value="1"></span>';
                               $jieshao.='<label style=" float:left; cursor: pointer;">晚餐</label>';
                               $jieshao.='<span><input class="set-text-xh text_177 ml-5 mr-10" type="text"name="supper['.$v['day'].']" value="'.$v['supper'].'"/></span>';
                               $jieshao.='</dd>';
                               $jieshao.='</dl>';
                               $jieshao.='<dl><dt>住宿情况：</dt>';
                               $jieshao.='<dd><input type="text"  class="set-text-xh text_222 mt-2" name="hotel['.$v['day'].']" value="'.$v['hotel'].'"></dd>';
                               $jieshao.='</dl>';
                               $jieshao.='<dl><dt>交通工具：</dt>';
                               $jieshao.='<dd>';
                               $jieshao.=$jiaotong;
                               $jieshao.='</dd>';
                               $jieshao.='</dl>';
                               $jieshao.='<div class="xc-con">';
                               $jieshao.='<h4>行程内容：</h4>';
                               $jieshao.='<div>';
                               $jieshao.='<textarea name="txtjieshao['.$v['day'].']" style=" float:left" id="line_content_'.$v['day'].'">'.$v['jieshao'].'</textarea>';
                               $jieshao.='</div>';
                               $jieshao.='<dl style="display: none">';
                               $jieshao.='<dt>相关景点：</dt>';
                               $jieshao.='<dd><input type="button" class="btn-sum-xz mt-4" value="提取" onclick="autoGetSpot('.$v['day'].')"><div class="save-value-div mt-2 ml-10" id="listspot_'.$v['day'].'">'.$dayspot.'</div></dd>';
                               $jieshao.='</dl>';
                               $jieshao.='</div></div>';
                               echo $jieshao;
                           }

                        ?>
                    </div>
                </div>
                <div id="content_biaozhun" class="product-add-div content-hide">
                     <div  class="editor-range">
                         <textarea id="biaozhun" name="biaozhun">{$info['biaozhun']}</textarea>
                     </div>
                </div>
                <div id="content_beizu" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="beizu" name="beizu">{$info['beizu']}</textarea>
                    </div>
                </div>
                <div id="content_payment" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="payment" name="payment">{$info['payment']}</textarea>
                    </div>
                </div>
                <div id="content_feeinclude" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="feeinclude" name="feeinclude">{$info['feeinclude']}</textarea>
                    </div>
                </div>
                <div id="content_features" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="features" name="features">{$info['features']}</textarea>
                    </div>
                </div>
                <div id="content_reserved1" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="reserved1" name="reserved1">{$info['reserved1']}</textarea>
                    </div>
                </div>
                <div id="content_reserved2" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="reserved2" name="reserved2">{$info['reserved2']}</textarea>
                    </div>
                </div>
                <div id="content_reserved3" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="reserved3" name="reserved3">{$info['reserved3']}</textarea>
                    </div>
                </div>
                <div id="content_tupian" class="product-add-div content-hide">

                    <div class="up-pic">
                        <dl>
                            <dt>图片：</dt>
                            <dd>
                                <div class="up-file-div">
                                    <div id="pic_btn" class="btn-file mt-4">上传图片</div>
                                </div>
                                <div class="up-list-div">

                                    <ul>
                                        <?php
                                        $pic_arr = explode(',', $info['piclist']);
                                        $litpic_arr = explode('||', $info['litpic']);

                                        $img_index = 1;
                                        $head_index = 0;
                                        foreach ($pic_arr as $k => $v) {
                                            if (empty($v))
                                                continue;
                                            $imginfo_arr = explode('||', $v);
                                            $headpic_style = $imginfo_arr[0] == $litpic_arr[0] ? 'style="display: block; background: green;"' : '';
                                            $head_index = $imginfo_arr[0] == $litpic_arr[0] ? $img_index : $head_index;
                                            $headpic_hint = $imginfo_arr[0] == $litpic_arr[0] ? '已设为封面' : '设为封面';
                                            $html = '<li class="img-li">';
                                            $html .= '<img class="fl" src="' . $imginfo_arr[0] . '" width="100" height="100">';
                                            $html .= '<p class="p1">';
                                            $html .= '<input type="text" class="img-name" name="imagestitle[' . $img_index . ']" value="' . $imginfo_arr[1] . '" style="width:90px">';
                                            $html .= '<input type="hidden" class="img-path" name="images[' . $img_index . ']" value="' . $imginfo_arr[0] . '">';
                                            $html.='</p>';
                                            $html.='<p class="p2">';
                                            $html.='<span class="btn-ste" onclick="Imageup.setHead(this,' . $img_index . ')" ' . $headpic_style . '>' . $headpic_hint . '</span><span class="btn-closed" onclick="Imageup.delImg(this,\'' . $imginfo_arr[0] . '\',' . $img_index . ')"></span>';
                                            $html.='</p></li>';
                                            echo $html;
                                            $img_index++;
                                        }
                                        echo '<script> window.image_index=' . $img_index . ';</script>';
                                        ?>

                                    </ul>
                                    <input type="hidden" class="headimgindex" name="imgheadindex" value="<?php  echo $head_index;  ?>">
                                </div>
                            </dd>
                        </dl>

                        <dl style="display: none">
                            <dt>行程附件：</dt>
                            <dd>
                                <div class="up-file-div">

                                    <div id="attach_btn" class="btn-file mt-4">上传附件</div>
                                    <input type="hidden" name="linedoc" id="linedoc" value="{$info['linedoc']}">
                                </div>
                                <div id="doclist" class="doclist">
                                   {if !empty($info['linedoc'])}
                                       <a href="{$cmsurl}{$info['linedoc']}">查看附件</a>
                                       <a href="javascript:;" onclick="delDoc()">删除</a>
                                   {/if}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div  id="content_seo" class="product-add-div content-hide">

                    <div class="add-class">
                        <dl>
                            <dt>优化标题：</dt>
                            <dd>
                                <input type="text" name="seotitle" value="{$info['seotitle']}" class="set-text-xh text_700 mt-2">
                            </dd>
                        </dl>
                        <dl>
                            <dt>Tag词：</dt>
                            <dd>
                                 <!-- <input type="button" class="btn-sum-xz mt-4" value="提取">-->
                                <input type="text" name="tagword" class="set-text-xh text_700 mt-2 " value="{$info['tagword']}">
                            </dd>
                        </dl>
                        <dl>
                            <dt>关键词：</dt>
                            <dd>
                                <input type="text" name="keyword" value="{$info['keyword']}" class="set-text-xh text_700 mt-2">
                            </dd>
                        </dl>
                        <dl>
                            <dt>页面描述：</dt>
                            <dd style="height:auto">
                                <textarea class="set-area wid_695" name="description" cols="" rows="">{$info['description']}</textarea>
                            </dd>
                        </dl>
                    </div>
                </div>
                {php $contentArr=Common::getExtendContent(1,$extendinfo);}
                {php echo $contentArr['contentHtml'];}
                <div id="content_extend" class="product-add-div content-hide">

                    {php echo $contentArr['extendHtml'];}
                </div>


                </form>
                <div class="opn-btn">

                    <a class="normal-btn" id="save_btn" href="javascript:;">保存</a>
                </div>
            </div>

    </td>
</tr>


<!--左侧导航区-->

<!--右侧内容区-->

<script>
 $(document).ready(function(e) {

     //编辑器
     window.biaozhun=window.JSEDITOR('biaozhun');
     window.simple_jieshao=window.JSEDITOR('simple_jieshao');
     window.beizu=window.JSEDITOR('beizu');
     window.payment=window.JSEDITOR('payment');
     window.feeinclude=window.JSEDITOR('feeinclude');
     window.features=window.JSEDITOR('features');
     window.reserved1=window.JSEDITOR('reserved1');
     window.reserved2=window.JSEDITOR('reserved2');
     window.reserved3=window.JSEDITOR('reserved3');

     //颜色选择器
	  $(".title-color").colorpicker({
            ishex:true,
            success:function(o,color){
                $(o).val(color)
            },
            reset:function(o){

            }
        });


	
	  var validate_action={}
	
	
       $("#product_fm input,#product_fm textarea").st_readyvalidate(validate_action);
	  
	   $("#save_btn").click(function(e) {
            var validate=$("#product_fm input,#product_fm textarea").st_govalidate({require:function(element,index){
				       $(element).css("border","1px solid red");
					   if(index==1)
					   {
					     var switchDiv=$(element).parents(".product-add-div").first();
					     if(switchDiv.is(":hidden")&&!switchId)
					     {
							var switchId=switchDiv.attr('id');
							var columnId=switchId.replace('content','column');
							$("#"+columnId).trigger('click');
					     }  
					   }
				 }});
			
			  if(validate==true)
			  {
                  ST.Util.showMsg('保存中',6,10000);
				Ext.Ajax.request({
				 url   :  SITEURL+"line/ajax_linesave",
				 method  :  "POST",
				 isUpload :  true,
				 form  : "product_fm",
				 waitMsg  :  "保存中...",
				 datatype  :  "JSON",
				 success  :  function(response, opts) 
				 {
                     var text = response.responseText;
                     if(window.isNaN(text))
                     {
                         ZENG.msgbox._hide();
                         ST.Util.showMsg('保存失败,请检查权限！',5);
                     }
                     else
                     {
                       // Ext.get('line_id').setValue(text);
                        $("#line_id").val(text);
                        ST.Util.showMsg('保存成功',4)
                     }


				 }});
		 
			  }
			  else
			  {
				  ST.Util.showMsg("请将信息填写完整",1,1200);
			  }
    });

     function delImage(dom)
     {

         var pdom=$(dom).parents(".image-dv").first();
         pdom.remove();
         var path=pdom.find('input:hidden').val();
         $.ajax({
             type: "post",
             url : SITEURL+"uploader/delpicture",
             dataType:'html',
             data:{picturepath:path},
             success: function(result){

             }})
     }

     $('.uploadify-button').css('backgroundImage','url("'+PUBLICURL+'images/upload-ico.png'+'")');
     $('#banner_btn').click(function(){
         ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
         function Insert(result,bool){
             if(result.data.length>0){
                 var len=result.data.length-1;
                 var temp =result.data[len].split('$$');
                 var img=temp[0];
                 var pdom=$("#image_logo");
                 if(pdom.length>0)
                 {

                     var path=pdom.find('input:hidden').val();
                     $.ajax({
                         type: "post",
                         url : SITEURL+"uploader/delpicture",
                         dataType:'html',
                         data:{picturepath:path},
                         success: function(result){
                             pdom.remove();
                             var content="<div class='image-dv' id='image_logo'><div><img src=\""+img+"\"/></div><div><a style='display: none' href='javascript:;' onclick='delImage(this)'>删除</a><input type='hidden' name='index_litpic' value='"+img+"'/></div></div>";
                             $("#dd_logo").append(content);
                         }})
                 }
                 else
                 {
                     var content="<div class='image-dv' id='image_logo'><div><img src=\""+img+"\"/></div><div><a style='display: none' href='javascript:;' onclick='delImage(this)'>删除</a><input type='hidden' name='index_litpic' value='"+img+"'/></div></div>";
                     $("#dd_logo").append(content);
                 }
             }
         }
     });

     $('#qrcode_btn').click(function () {
         ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430, 340, null, null, document, {
             loadWindow: window,
             loadCallback: Insert
         });

         function Insert(result, bool) {
             if (result.data.length > 0) {
                 var len = result.data.length - 1;
                 var temp = result.data[len].split('$$');
                 var img = temp[0];
                 var pdom = $("#image_logo");
                 if (pdom.length > 0) {
                     var path = pdom.find('input:hidden').val();
                     $.ajax({
                         type: "post",
                         url: SITEURL + "uploader/delpicture",
                         dataType: 'html',
                         data: {picturepath: path},
                         success: function (result) {
                             pdom.remove();
                             $("#qrcode_img").attr('src',img);
                             $("#qrcode").val(img);
                         }
                     })
                 }
                 else {
                     $("#qrcode_img").attr('src',img);
                     $("#qrcode").val(img);
                 }
             }
         }
     });





	  
});

//切换时的回调函数
function switchBack(columnname)
{
	if(columnname=='jieshao')
	{
		var days=$("#travel_days").val();
        if(days<=0)
        {
          ST.Util.showMsg("请先填写旅游天数",1,1500);
          $("#travel_days").css("border","1px solid red");
          $("#column_basic").trigger("click");
        }
        else
        {
            var html="";

            var jieshao_num=$(".content-jieshao-detail").find('.add-class').length;

            jieshao_num=!jieshao_num?0:jieshao_num;

            var jiaotong = '';
            jiaotong+='<span class="fl"><input class="fl mt-8" type="checkbox" name="transport[{day}][]" value="汽车"/></span>';
            jiaotong+='<label class="fl ml-5 mr-20" style="cursor:pointer;">汽车</label>';
            jiaotong+='<span class="fl"><input class="fl mt-8" type="checkbox" name="transport[{day}][]" value="火车"></span>';
            jiaotong+='<label class="fl ml-5 mr-20" style="cursor:pointer;">火车</label>';
            jiaotong+='<span class="fl"><input class="fl mt-8" type="checkbox"value="飞机" name="transport[{day}][]"></span>';
            jiaotong+='<label class="fl ml-5 mr-20" style="cursor:pointer;">飞机</label>';
            jiaotong+='<span class="fl"><input class="fl mt-8" type="checkbox" name="transport[{day}][]" value="轮船"></span>';
            jiaotong+='<label class="fl ml-5 mr-20" style="cursor:pointer;">轮船</label>';
            jiaotong+="<span id=\"addjt_{day}\"></span><img class='addimg' data-contain='addjt_{day}' data-day='{day}' style=\"line-height: 30px;vertical-align: middle;cursor: pointer\"  src=\"/admintravel/public/images/tianjia.png\">";



            var day_content='<div class="add-class">';
									day_content+='<dl>';
										day_content+='<dt>第{day}天：</dt>';
										day_content+='<dd><input type="text" name="jieshaotitle[{day}]" class="set-text-xh text_700 mt-2"/></dd>';
									day_content+='</dl>';
									day_content+='<dl class="jieshao-diner">';
										day_content+='<dt>用餐情况：</dt>';
										day_content+='<dd>';
											day_content+='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="breakfirsthas[{day}]" value="1"></span>';
											day_content+='<label style="float:left;cursor:pointer;">早餐</label><span class="fl"><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="breakfirst[{day}]"/></span>';
											day_content+='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="lunchhas[{day}]" value="1"></span>';
											day_content+='<label style="float:left;cursor:pointer;">午餐</label><span class="fl"><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="lunch[{day}]" value=""/></span>';
											day_content+='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="supperhas[{day}]" value="1"></span>';
											day_content+='<label style="float:left;cursor:pointer;">晚餐</label><span class="fl"><input class="set-text-xh text_177 ml-5 mr-10" type="text"name="supper[{day}]"/></span>';
										day_content+='</dd>';
									day_content+='</dl>';
									day_content+='<dl>';
										day_content+='<dt>住宿情况：</dt>';
										day_content+='<dd><input type="text" class="set-text-xh text_222 mt-2" name="hotel[{day}]"></dd>';
									day_content+='</dl>';
									day_content+='<dl>';
										day_content+='<dt>交通工具：</dt>';
										day_content+='<dd>';
											day_content+=jiaotong;
										day_content+='</dd>';
									day_content+='</dl>';
									day_content+='<div class="xc-con">';
										day_content+='<h4>行程内容：</h4>';
										day_content+='<div><textarea name="txtjieshao[{day}]" style=" float:left" id="line_content_{day}"></textarea></div>';
										day_content+='<dl>';
											day_content+='<dt>相关景点：</dt>';
											day_content+='<dd><input type="button" class="btn-sum-xz mt-4" value="提取" onclick="autoGetSpot({day})"><div class="save-value-div mt-2 ml-10" id="listspot_{day}"></div></dd>';
										day_content+='</dl>';
									day_content+='</div>';
								day_content+='</div>';

            if(jieshao_num<days)
            {
               for(var i=jieshao_num+1;i<=days;i++)
               {
                 html+=day_content.replace(/\{day\}/g,i);
               }
               $(".content-jieshao-detail").append(html);
            }
            else if(jieshao_num>days)
            {
               // $(".content-jieshao-detail").find('.add-class').gt(days).remove();
            }

            for(var i=1;i<=days;i++)
            {
                window['line_content_'+i]=window.JSEDITOR('line_content_'+i);
            }
            addJiaoTong2();
        }
	}
}
function togDiner(num)
{
   if(num==1)
   {
     $(".jieshao-diner").show();
   }
   else
     $(".jieshao-diner").hide();
}
function togStyle(dom,num)
{
    $("#line_isstyle").val(num);
    $(dom).addClass('on');
    $(dom).siblings().removeClass('on');

    if(num==1)
    {
      $(".content-jieshao-detail").hide();
      $(".content-jieshao-simple").show();
    }
    else
    {
        $(".content-jieshao-detail").show();
        $(".content-jieshao-simple").hide();
    }
}
function nextStep()
{
    $(".w-set-tit span.on").next().trigger('click');
}
//删除附件
function delDoc()
{
    var lineid = '{$info['id']}';
    $.ajax({
        type:'POST',
        url:SITEURL+'/line/ajax_del_doc',
        data:{lineid:lineid},
        dataType:'json',
        success:function(data){
            if(data.status){
                $("#doclist").html('');
                ST.Util.showMsg('删除成功',4,1000);

            };
        }
    })
}

 //一键提取景点
 function autoGetSpot(i)
 {

     //var totalday="{sline:var.fields.lineday/}";
     var lineid=$("#line_id").val();
     if(lineid==0)return;
     var icontent = window['line_content_'+i].getContent();

     $.ajax(
         {
             type: "post",
             data: {content:icontent,lineid:lineid,day:i},
             url: SITEURL+"line/ajax_getspot",
             dataType:'json',
             beforeSend:function(){
                 ST.Util.showMsg('正在提取...',6,5000);
             },
             success: function(data,textStatus)
             {

                 var html='';
                 $.each(data,function(i,row){
                     html+='<span><s onclick="delDaySpot(this,\''+row.autoid+'\')"></s>'+row.title+'</span>'

                 })
                 $("#listspot_"+i).append(html);//显示提取到的景点

                 ST.Util.showMsg('提取成功!',4,1000);

             },
             error: function()
             {
                 ST.Util.showMsg("请求出错",5,1000);
             }

         });

 }
//删除提取的景点
function delDaySpot(obj,autoid)
{
    $.ajax({
        type:'POST',
        data:{autoid:autoid},
        url:SITEURL+'line/ajax_del_dayspot',
        dataType:'json',
        success:function(data){
            if(data.status){
                $(obj).parent().remove();
            }
        }
    })
}

//设置模板
function setTemplet(obj)
{
    var templet = $(obj).attr('data-value');
    $(obj).addClass('on').siblings().removeClass('on');
    $("#templet").val(templet);

}

//添加交通
function addJiaoTong()
{
    var myDate = new Date();
    var mid = "jt_"+myDate.getMilliseconds();//毫秒数
    var html = "<input name=\"transport_pub[]\" type=\"checkbox\" class=\"checkbox\" id=\""+mid+"\" value=\"\">&nbsp;<label for=\"Transport\"><input type=\"text\" class=\"uservalue\" data-value=\""+mid+"\" style=\"width:70px;border-left:none;border-right:none;border-top:none\"  value=\"\"></label>";
    $("#addjt").append(html);

    $('.uservalue').unbind('input propertychange').bind('input propertychange', function() {
        var datacontain = $(this).attr('data-value');
        $('#'+datacontain).val($(this).val());
    });
}

$(function(){
    addJiaoTong2();
})

function addJiaoTong2()
{
    $(".addimg").unbind('click').click(function(){
        var day = $(this).attr('data-day');
        var datacontain = $(this).attr('data-contain');

        var myDate = new Date();
        var mid = "jt_" + myDate.getMilliseconds();//毫秒数
        var html = "<input  class=\"fl mt-8\" type=\"checkbox\"  name=\"transport["+day+"][]\" id=\""+mid+"\" value=\"\"/>&nbsp;<label class=\"fl ml-5 mr-20\" style=\"cursor:pointer;\"><input type=\"text\" class=\"day_uservalue\" data-value=\"" + mid + "\" style=\"width:70px;border-left:none;border-right:none;border-top:none\"  value=\"\"></label>";


        $("#"+datacontain).append(html);

        $('.day_uservalue').unbind('input propertychange').bind('input propertychange', function () {
            var datacontain = $(this).attr('data-value');
            $('#' + datacontain).val($(this).val());
        });

    })
}

</script>



<script>
    var action = '{$action}';
    $('#pic_btn').click(function(){
        ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
        function Insert(result,bool){
            var len=result.data.length;
            for(var i=0;i<len;i++){
                var temp =result.data[i].split('$$');
                Imageup.genePic(temp[0],".up-list-div ul",".cover-div");
            }
        }
    });
    setTimeout(function(){
        $('#attach_btn').uploadify({
            'swf': PUBLICURL + 'js/uploadify/uploadify.swf',
            'uploader': SITEURL + 'uploader/uploaddoc',
            'buttonImage' : PUBLICURL+'images/uploadfile.png',  //指定背景图
            'formData':{uploadcookie:"<?php echo Cookie::get('username')?>"},
            'fileTypeExts':'*.doc;*.docx;*.pdf',
            'auto': true,   //是否自动上传
            'removeTimeout':0.2,
            'height': 25,
            'width': 80,
            'onUploadSuccess': function (file, data, response) {


                var info=$.parseJSON(data);
                var html = '<a href="'+info.path+'">查看附件</a>&nbsp;';
                $("#linedoc").val(info.path);
                if(action=='edit')
                    html+= '<a href="javascript:;" onclick="delDoc()">删除</a>'
                $("#doclist").html(html);

            }
        });
    },10)

    function updateInsurance(result,bool)
    {
        var container= $('.insurance-sel');
        container.children().remove();
        var html='';
        var productsArr=result.data;
        for(var i in productsArr)
        {
           var product=productsArr[i];
           html+='<span><s onclick="$(this).parent(\'span\').remove()"></s>';
           html+=product['productname'];
           html+='<input type="hidden" name="insuranceids[]" value="'+product['id']+'">'
           html+='</span>'
        }
        container.append(html);

    }



</script>
</body>
</html>
