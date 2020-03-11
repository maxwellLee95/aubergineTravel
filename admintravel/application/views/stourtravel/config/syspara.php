<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>系统参数</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,jqtransform.css'); }
    {php echo Common::getScript('config.js,jquery.jqtransform.js,jquery.colorpicker.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>

<body>
	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td">


        <form id="configfrm">
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>系统参数</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">
              <div class="water-mark ml-10" style="padding-top:20px">
                  <div class="rowElem" style="display: none">
                      <label>网站开关：</label>
                      <input type="radio" name="cfg_web_open" value="1" {if $config['cfg_web_open']==1}checked{/if}>
                      <label>开启</label>
                      <input type="radio" name="cfg_web_open" value="0" {if $config['cfg_web_open']==0}checked{/if}>
                      <label>关闭</label>
                  </div>
                  <div class="rowElem">
                      <label>活动详情页百度地图：</label>
                      <input type="radio" name="cfg_open_baidumap" value="1" {if $config['cfg_open_baidumap']==1}checked{/if}>
                      <label>开启</label>
                      <input type="radio" name="cfg_open_baidumap" value="0" {if $config['cfg_open_baidumap']==0}checked{/if}>
                      <label>关闭</label>
                  </div>

                  <div class="writing" style="margin-top: 10px;">
                      <p><span class="fl">分销比例(百分比)：</span><input type="text" name="cfg_commission_rate" id="cfg_commission_rate" class="set-text-xh" value="{$config['cfg_commission_rate']}" />%</p>
                  </div>
                  <div class="writing" style="margin-top: 10px;">
                      <div style="float: left">
                          <span class="fl">定制咨询二维码：</span>
                      </div>
                      <div style="float: left">
                          <div>
                              <div id="customize_qrcode_btn" class="uploadify" style="text-indent: -9999px; height: 25px; line-height: 25px; width: 85px; cursor: pointer; background-image: url('/admintravel/public/images/upload-ico.png');">
                                  上传图片
                              </div>
                              <div style="margin-top: 30px;">
                                  {if !empty($config['cfg_customize_qrcode'])}
                                  <img id="customize_qrcode_img" src="{$config['cfg_customize_qrcode']}"   />
                                  {else}
                                  <img id="customize_qrcode_img" src="#" />
                                  {/if}
                              </div>
                          </div>
                          <input  type="hidden" class="set-text-xh text_700 mt-2" id="customize_qrcode" name="cfg_customize_qrcode" value="{$config['cfg_customize_qrcode']}"/>
                      </div>

                  </div>
                  <div class="rowElem" style="margin-top: 20px;display: none">
                      <label>前台出发地：</label>

                      <input type="radio"  name="cfg_startcity_open" value="1" {if $config['cfg_startcity_open']=='1'}checked{/if}>
                      <label>开启</label>


                      <input type="radio"  name="cfg_startcity_open" value="0" {if $config['cfg_startcity_open']=='0'}checked{/if}>
                      <label>关闭</label>

                  </div>
                  <div class="rowElem" style="margin-top: 20px;display: none">
                      <label>自定义导航：</label>

                      <input type="radio"  name="cfg_usernav_open" value="1" {if $config['cfg_usernav_open']=='1'}checked{/if}>
                      <label>开启</label>


                      <input type="radio"  name="cfg_usernav_open" value="0" {if $config['cfg_usernav_open']=='0'}checked{/if}>
                      <label>关闭</label>

                  </div>

                  <div class="rowElem" style="margin-top: 20px;display: none">
                      <label>模板皮肤：</label>

                      <input type="radio"  name="cfg_df_style" value="smore" {if $config['cfg_df_style']=='smore'}checked{/if}>
                      <label>标准</label>
                      {loop $templetlist $templet}
                      <input type="radio"  name="cfg_df_style" value="{$templet['tempname']}" {if $config['cfg_df_style']==$templet['tempname']}checked{/if}>
                       <label>{$templet['tempname']}</label>
                      {/loop}


                  </div>
                  <div class="rowElem" style="margin-top: 20px;display: none">
                      <label>默认首页效果：</label>

                      <input type="radio"  name="cfg_index_templet" value="index_1.htm" {if $config['cfg_index_templet']=='index_1.htm'}checked{/if}>
                      <label>效果一</label>
                      <input type="radio"  name="cfg_index_templet" value="index_2.htm" {if $config['cfg_index_templet']=='index_2.htm'}checked{/if}>
                      <label>效果二</label>
                      <input type="radio"  name="cfg_index_templet" value="index_3.htm" {if $config['cfg_index_templet']=='index_3.htm'}checked{/if}>
                      <label>效果三</label>



                  </div>



                  <div class="writing" style="margin-top: 10px;display: none">
                      <p><span class="fl">自动更新时间：</span><input type="text" name="cfg_auto_time" id="cfg_auto_time" class="set-text-xh set-text-bz1" value="{$config['cfg_auto_time']}" /></p>

                  </div>




              </div>

            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">


            </div>


          </div>
        </div>
        </form>
  </td>
  </tr>
  </table>

  
  
	<script>

	$(document).ready(function(){



        //配置信息保存
        $("#btn_save").click(function(){

            //var webid= $("#webid").val();
            Config.saveConfig(0);


        });

        $('#customize_qrcode_btn').click(function () {
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
                                $("#customize_qrcode_img").attr('src',img);
                                $("#customize_qrcode").val(img);
                            }
                        })
                    }
                    else {
                        $("#customize_qrcode_img").attr('src',img);
                        $("#customize_qrcode").val(img);
                    }
                }
            }
        });



    })












    </script>

</body>
</html>
