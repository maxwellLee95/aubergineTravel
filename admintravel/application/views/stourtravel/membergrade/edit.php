<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }


</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
       <div class="out-box-con">
           <dl class="list_dl">
               <dt class="wid_90">名称：</dt>
               <dd>
                   <input name="name" type="text" value="{$info['name']}" />
               </dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">起始学分：</dt>
               <dd>
                   <input name="begin" type="text" value="{$info['begin']}" />
               </dd>
           </dl>
           <dl class="list_dl">
               <dt class="wid_90">终止学分：</dt>
               <dd>
                   <input name="end" type="text" value="{$info['end']}" />
               </dd>
           </dl>

           <dl class="list_dl">
               <dt class="wid_90">&nbsp;</dt>
               <dd>
                   <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                   <input type="hidden" id="id" name="id" value="{$info['id']}">
               </dd>
           </dl>
       </div>
   </form>

<script language="JavaScript">



    $(function(){
        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"membergrade/ajax_save",
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