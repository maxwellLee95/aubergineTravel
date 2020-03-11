<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>领队添加/修改</title>
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
                            <dl>
                                <dt>标题：</dt>
                                <dd>
                                    {$info['title']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>领队：</dt>
                                <dd>
                                    {$info['leader']['nickname']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>内容：</dt>
                                <dd>
                                {$info['content']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>添加时间：</dt>
                                <dd>
                                    {$info['add_time']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>线路：</dt>
                                <dd>
                                    {$info['line']['title']}
                                </dd>
                            </dl>
                            <dl>
                                <dt>活动时间：</dt>
                                <dd>
                                    {$info['day']}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </form>
            </div>
        </td>
    </tr>
</table>

<script>
    //设置模板
    function setTemplet(obj)
    {
        var templet = $(obj).attr('data-value');
        $(obj).addClass('on').siblings().removeClass('on');
        $("#templet").val(templet);

    }
    $(document).ready(function(){

        $('.uploadify-button').css('backgroundImage','url("'+PUBLICURL+'images/upload-ico.png'+'")');
        //上传图片
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
                                var content="<div class='image-dv' id='image_logo'><div><img src=\""+img+"\"/></div><div><a href='javascript:;' onclick='delImage(this)'>删除</a><input type='hidden' name='logo' value='"+img+"'/></div></div>";
                                $("#dd_logo").append(content);
                            }})
                    }
                    else
                    {
                        var content="<div class='image-dv' id='image_logo'><div><img src=\""+img+"\"/></div><div><a href='javascript:;' onclick='delImage(this)'>删除</a><input type='hidden' name='logo' value='"+img+"'/></div></div>";
                        $("#dd_logo").append(content);
                    }
                }
            }
        });
        $('#bg_btn').click(function(){
            ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
            function Insert(result,bool){
                if(result.data.length>0){
                    var len=result.data.length-1;
                    var temp =result.data[len].split('$$');
                    var img=temp[0];
                    var pdom=$("#image_bk");
                    if(pdom)
                    {
                        var path=pdom.find('input:hidden').val();
                        $.ajax({
                            type: "post",
                            url : SITEURL+"uploader/delpicture",
                            dataType:'html',
                            data:{picturepath:path},
                            success: function(result){
                                pdom.remove();
                                var content="<div class='image-dv' id='image_bk'><div><img src=\""+img+"\"/></div><div><a href='javascript:;' onclick='delImage(this)'>删除</a><input type='hidden' name='bgimage' value='"+img+"'/></div></div>";
                                $("#image_bg").append(content);
                            }})
                    }
                    else
                    {
                        var content="<div class='image-dv' id='image_bk'><div><img src=\""+img+"\"/></div><div><a href='javascript:;' onclick='delImage(this)'>删除</a><input type='hidden' name='bgimage' value='"+img+"'/></div></div>";
                        $("#image_bg").append(content);
                    }
                }
            }
        });

        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"leader/ajax_save",
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
</script>

</body>
</html>
