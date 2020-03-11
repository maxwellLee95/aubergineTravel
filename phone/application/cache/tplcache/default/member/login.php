<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户登录--<?php echo $webname;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php echo Common::css('style.css,amazeui.css,extend.css');?>
    <script type="text/javascript">
        var SITEURL = "<?php echo URL::site();?>";
    </script>
</head>
<body>
<header>
    <div class="header_top" style="display: none">
        <div class="st_back"><a href="<?php echo $url;?>"></a></div>
        <h1 class="tit">登录</h1>
        <a  class="top_user_reg" href="<?php echo $cmsurl;?>member/register">注册</a>
    </div>
</header>
<section >
    <div class="mid_content" style="display: none">
        <div class="st_user_box">
            <form id="form-submit" style="display: none">
                <div class="st_login">
                    <div class="number_password" id="login-content">
                        <p><strong>账号：</strong><input type="text" id="type" class="" name="user" placeholder="手机/邮箱" /></p>
                        <p><strong>密码：</strong><input type="password" name="pwd" class="" placeholder="请输入密码" /><a style="display: none" href="<?php echo $cmsurl;?>member/find">忘记密码</a></p>
                        <?php if(!$one) { ?>
                        <p><strong>验证码：</strong><input type="text" name="code" class="" placeholder="请填写验证码" /><img class="yzm_pic cursor captcha" id="captcha" src="" height="30" /></p>
                        <?php } ?>
                    </div>
                    <div class="error_txt" id="error_txt"></div>
                    <div class="submit_btn" id="submit_btn"><input type="button" value="登陆" /></div>
                </div>
            </form>
            <?php echo Request::factory('member/login/third')->execute()->body(); ?>
        </div>
    </div>
</section>
</body>
<?php echo Common::js('jquery.min.js,common.js,jquery.validate.min.js,layer/layer.m.js');?>
<script type="text/javascript">
    $(document).ready(function(){
        var rUrl=$(".ico_wx").attr('href');
        if (rUrl){
            window.location.href=rUrl;
        }
        $('.captcha').attr('src',ST.captcha(SITEURL+'captcha'));
        $('.captcha').click(function(){
            $(this).attr('src',ST.captcha($(this).attr('src')));
        });
        // $(".ico_wx").click();
        //验证
        $('#form-submit').validate({
            rules:{
                email:{
                   required:true,
                   email: true
                },
                mobile: {
                    required:true,
                    mobile:true
                },
                code:'required',
                pwd: {
                    required: true,
                    minlength: 6
                }
            },
            messages:{
                mobile: {
                    required: '<?php echo __("error_user_not_empty");?>',
                    mobile: '<?php echo __("error_user_phone");?>'
                },
                email: {
                    required: '<?php echo __("error_user_not_empty");?>',
                    email: '<?php echo __("error_user_email");?>'
                },
                code:'<?php echo __("error_code_not_empty");?>',
                pwd: {
                    required: '<?php echo __("error_pwd_not_empty");?>',
                    minlength: '<?php echo __("error_pwd_min_length");?>'
                }
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                var content=$('#error_txt').html();
                if(content==''){
                    $('#error_txt').html('<i></i>');
                    error.appendTo($('#error_txt'));
                }
            },
            showErrors:function(errorMap,errorList){
                if(errorList.length<1){
                    $('#error_txt').html('');
                }else{
                    this.defaultShowErrors();
                }
            }
        });
        $('#type').keyup(function(){
            var reg=/^[0-9]+$/;
            if(!reg.test($(this).val())){
                $(this).attr({class:'email',name:'email'});
                }else{
                $(this).attr({class:'mobile',name:'mobile'});
             }
        });
        //提交数据
        $('#submit_btn').click(function(){
            if($("#form-submit").valid()){
                var data={};
                $("#form-submit").find('input').each(function(){
                    if($(this).attr('type')!='button'){
                        var name=$(this).attr('name');
                        if(name=='email' || name=='mobile'){
                            data['user']=$(this).val();
                        }else{
                           data[name]=$(this).val(); 
                        }
                    }
                });
               $.post(SITEURL+'member/login/ajax_check',data,function(rs){
                   if(parseInt(rs.status)<1){
                       $('#error_txt').html('<i></i>'+rs.msg);
                       if($('#captcha').length>0){
                           $('#captcha').attr('src',ST.captcha(SITEURL+'captcha'));
                       }else{
                         $('#login-content').append('<p><strong>验证码：</strong><input type="text" name="code" class="" placeholder="请填写验证码" /><img class="yzm_pic cursor captcha" id="captcha" src="'+SITEURL+'captcha" height="30" /></p>');
                       }
                   }else{
                       layer.open({
                            content: '<?php echo __("success_login");?>',
                            time: 2,
                            end:function(){
                               window.location.href=rs.url;
                            }
                        });
                   }
                },'json');
            }
        });
    });
</script>
</html>
