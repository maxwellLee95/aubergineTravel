<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>会员修改密码-{$webname}</title>
    {include "pub/varname"}
    {Common::css('user.css,base.css,extend.css')}
    {Common::js('jquery.min.js,base.js,common.js,jquery.validate.js')}
</head>

<body>
  {request "pub/header"}
  <div class="big">
  	<div class="wm-1200">
    
    	<div class="st-guide">
      	 <a href="{$GLOBALS['cfg_basehost']}">{$GLOBALS['cfg_indexname']}</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;修改密码
        </div><!--面包屑-->
      <div class="st-main-page">
        {include "member/left_menu"}
          <div class="user-cont-box">
              <form id="changefrm" method="post" action="{$cmsurl}member/index/do_changepwd">
                <div class="revise-ps-word">
                  <h3 class="xg-tit">{if empty($info['pwd'])}设置密码{else}修改密码{/if}</h3>
                  <div class="password-xg">
                      {if !empty($info['pwd'])}
                      <dl>
                          <dt>当前密码：</dt>
                          <dd>
                              <input type="password" name="oldpwd" id="oldpwd" class="msg-text"/>
                              <span class="msg_contain"></span>
                          </dd>
                      </dl>
                      {/if}
                      <dl>
                          <dt>新密码：</dt>
                          <dd>
                              <input type="password" name="newpwd1" id="newpwd1" class="msg-text"/>
                              <span class="msg_contain"></span>
                          </dd>
                      </dl>
                      <dl>
                          <dt>确认密码：</dt>
                          <dd>
                              <input type="password" name="newpwd2" id="newpwd2" class="msg-text"/>
                              <span class="msg_contain"></span>
                          </dd>
                      </dl>
                      <div class="confirm-btn"><a href="javascript:;">保存修改</a></div>
                  </div>
              </div><!--修改密码-->
                  <input type="hidden" id="mid" name="mid" value="{$mid}">
                  <input type="hidden" name="frmcode" value="{$frmcode}"/>
                  <input type="hidden" name="setpwd" value="{if empty($info['pwd'])}1{else}0{/if}">
              </form>
          </div>
      </div>
    </div>
  </div>

 {request "pub/footer"}
 <script>
     $(function(){
         //导航选中
         $("#nav_safecenter").addClass('on');

         //提交修改
         $('.confirm-btn a').click(function(){
             $('#changefrm').submit();
         })

         //表单验证

         $('#changefrm').validate({
             rules:{
                 {if !empty($info['pwd'])}
                    oldpwd:{
                        required:true,
                        minlength:6,
                        remote: {
                            url: SITEURL+'member/index/ajax_check_oldpwd',
                            type: 'post'
                        }
                    },
                {/if}
                    newpwd1:{
                        required:true,
                        minlength:6
                    },
                    newpwd2:{
                        required:true,
                        equalTo: '#newpwd1'

                    }
                },
             messages: {
                 {if !empty($info['pwd'])}
                 oldpwd:{
                     required:'密码不能为空',
                     minlength:'密码不得小于6位',
                     remote: '旧密码错误'

                 },
                {/if}
                 newpwd1:{
                     required:'请输入新密码',
                     minlength:'密码不得小于6位'
                 },
                 newpwd2:{
                     required:'密码前后不一致',
                     equalTo:'密码前后不一致'
                 }

             },
             errorPlacement: function (error, element) {

                 $(element).parent().find('.msg_contain').html(error);
                 $(element).parent().find('.msg_contain').addClass('st-ts-text').removeClass('st-ts-ico');

             },
             success: function (msg, element) {

                 $(element).parent().find('.msg_contain').html('');
                 $(element).parent().find('.msg_contain').addClass('st-ts-ico').removeClass('st-ts-text');


             }/*,
             submitHandler: function (form) {



             }*/


         })

     })
 </script>
</body>
</html>
