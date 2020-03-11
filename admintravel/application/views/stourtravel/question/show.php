<!doctype html>
<html>
<head>

    <meta charset="utf-8">
<title>问答查看</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }

</head>

<body style="background-color: #fff">
      <div class="content-nr mt-0">
          <form method="post" name="product_frm" id="product_frm">
          <div class="manage-nr" style="padding-top: 0">

                  <div class="product-add-div">
                      <div class="add-class">

                          <dl>
                              <dt>产品/标题：</dt>
                              <dd style="width: 300px">
                                  <span class="fl w160">{$info['productname']}</span>
                              </dd>
                          </dl>
                          <dl>
                              <dt>提问人：</dt>
                              <dd style="width: 300px">
                                {$info['nickname']}
                              </dd>
                          </dl>

                          <dl>
                              <dt>提问时间：</dt>
                              <dd style="width: 300px">
                                  {$info['addtime']}
                              </dd>
                          </dl>
                          <dl style="display: none">
                              <dt>电话：</dt>
                              <dd style="width:650px;">
                                 {$info['phone']}
                              </dd>
                          </dl>
                          <dl style="display: none">
                              <dt>邮箱：</dt>
                              <dd style="width:650px;">
                                  {$info['email']}
                              </dd>
                          </dl>
                          <dl style="display: none">
                              <dt>QQ：</dt>
                              <dd style="width:650px;">
                                 {$info['qq']}
                              </dd>
                          </dl>
                          <dl style="display: none">
                              <dt>微信：</dt>
                              <dd style="width:650px;">
                                 {$info['weixin']}
                              </dd>
                          </dl>
                          <dl>
                              <dt>内容：</dt>
                              <dd style="width:650px;">
                                  <div style="color: red;">{$info['content']}</div>
                              </dd>
                          </dl>
                          <dl>
                              <dt class="w160">回复内容</dt>
                              <dd>
                                  <div><textarea style="width: 600px;height: 100px;margin-left: 40px;" id="replycontent">{$info['replycontent']}</textarea></div>
                              </dd>
                          </dl>
                      </div>

                  </div>


                  <div class="opn-btn">
                      <input type="hidden" name="questionid" id="questionid" value="{$info['id']}"/>

                      <a class="normal-btn ml5" id="btn_save" href="javascript:;">保存</a>

                  </div>

          </div>
        </form>

    </div>

	<script>
    var id="{$info['id']}";
	$(document).ready(function(){




        //保存
        $("#btn_save").click(function(){
                   $.post(SITEURL+"question/ajax_save",{
                       "questionid":$("#questionid").val(),
                       "replycontent":$("#replycontent").val()},
                       function(data) {
                           var data = eval('(' + data + ')');
                           if(data.status)
                           {

                               ST.Util.showMsg('保存成功!','4',2000);
                               setTimeout(function(){ST.Util.responseDialog({id:id},true)},1000);

                           }
                           else{
                               ST.Util.showMsg("{__('norightmsg')}",5,1000);
                           }
                   });
               });


    });


    </script>

</body>
</html>
