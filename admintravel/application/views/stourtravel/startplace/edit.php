<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("jquery.validate.js"); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,listimageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
   <style>
        .error{
            color:red;
            padding-left:5px;
        }

    </style>

</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">图标名称：</dt>
            <dd>

                 <input type="text" class="set-text-xh mt-4" name="cityname" id="cityname" value="{$info['cityname']}" >

            </dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90" style="height: 90px">图片标识：</dt>
            <dd id="dd_logo">
                <div class="up-file-div lh30 mt5 fl">
                    <div id="banner_btn" class="btn-file mt-4">
                        上传图片
                    </div>
                    <div id="img" style="margin-top: 30px;">
                        {if !empty($info['icon'])}
                        <img id="litimg" src="{$info['icon']}"   />
                        {else}
                        <img id="litimg" src="#" />
                        {/if}
                    </div>
                    <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                </div>
            </dd>
        </dl>
        <dl class="list_dl" style="margin-top: 70px">
            <dt class="wid_90">&nbsp;</dt>
            <dd>

                <input type="hidden" id="id" name="id" value="{$info['id']}">
                <input type="hidden" name="action" value="{$action}">
                <input type="hidden" name="icon" id="icon" value="{$info['icon']}">
            </dd>
        </dl>
    </div>
   </form>

<script language="JavaScript">

    var action='{$action}';
    //表单验证
    $("#frm").validate({

        focusInvalid:false,
        rules: {
            cityname:
            {
                required: true

            }




        },
        messages: {

            cityname:{
                required:"请输入图标名称"

            }
        },
        errUserFunc:function(element){


        },
        submitHandler:function(form){

            Ext.Ajax.request({
                url   :  SITEURL+"startplace/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {

                        $("#id").val(data.productid);
                        ST.Util.showMsg('保存成功!','4',2000);


                    }


                }});
            return false;//阻止常规提交


       }




    });

    $(function(){
        //保存
        $("#btn_save").click(function(){


            $("#frm").submit();

            return false;

        });
        $('#banner_btn').click(function () {
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
                                $("#litimg").attr('src',img);
                                $("#icon").val(img);
                            }
                        })
                    }
                    else {
                        $("#litimg").attr('src',img);
                        $("#icon").val(img);
                    }
                }
            }
        });

    })

</script>

</body>
</html>