<div class="other_login">
    <h3 style="display: none"><span>其他登录方式</span></h3>
    <p>
        <?php if($sinalogin) { ?>
        <a class="ico_wb" href="<?php echo $cmsurl;?>member/login/sina"><em></em><span>微博</span></a>
        <?php } ?>
        <?php if($qqlogin) { ?>
        <a class="ico_qq" href="<?php echo $cmsurl;?>member/login/qq"><em></em><span>QQ</span></a>
        <?php } ?>
        <?php if($weixinlogin) { ?>
        <a class="ico_wx" href="<?php echo $cmsurl;?>member/login/weixin"><em></em><span>微信</span></a>
        <?php } ?>
    </p>
</div>