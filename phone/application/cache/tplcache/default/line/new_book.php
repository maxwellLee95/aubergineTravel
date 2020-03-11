<!DOCTYPE html>
<html>
<head>
    <title>
        填写报名信息
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=2"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=18"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <script>
        var _hmt = _hmt || [];
    </script>
    <style>
        .line-step.fixed {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1001;
            width: 100%;
        }
        .line-step.fixed img {
            opacity: 1;
        }
        .line-step{
            padding: 10px;
            background: #ffffff;
        }
        .line-tab {
            width: 25%;
        }
    </style>
</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
    <?php if(($info['line_type']==2)) { ?>
        <div class="topBar">
            <div class="line-step">
                <img src="/phone/public/images/wx/wechat/line_step3_3.png" style="width:100%;height: 100%;">
                <div class="line-step-jump">
                    <a class="line-step-a" href="/phone/flop/time?aid=<?php echo $info['id'];?>"></a>
                </div>
            </div>
            <div class="line-step fixed">
                <img src="/phone/public/images/wx/wechat/line_step3_3.png" style="width:100%;height: 100%;">
                <div class="line-step-jump">
                    <a class="line-step-a" href="/phone/flop/time?aid=<?php echo $info['id'];?>"></a>
                </div>
            </div>
        </div>
    <?php } else { ?>
<!--    <div class="topBar">-->
<!--        <a class="back" href="javascript:history.go(-1);">-->
<!--            <img src="/phone/public/images/wechat/back.png">-->
<!--        </a>-->
<!--        <a class="home" href="#">-->
<!--            <img src="/phone/public/images/wechat/home.png">-->
<!--        </a>-->
<!--        <p class="text-overflow" >-->
<!--            填写报名信息-->
<!--        </p>-->
<!--    </div>-->
    <?php } ?>
<div id="default-modal" class="modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                        <span class="closeBtn">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </span>
                <span class="modal-title" id="default-modal-title"></span>
            </div>
            <div class="modal-body" id="default-modal-body" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="default-cancel">取消</button>
                <button type="button" class="btn btn-primary" id="default-check" >确定</button>
            </div>
        </div>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css?v=131">
<link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/datetime.css?v=131" />
<link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/join_new.css?v=131" />
<link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/pop-layer.css?v=131">
<link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=131">
<style type="text/css">
    /*新的常用人编辑框样式*/
    #my_member{
        margin: 0;
        border-radius: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        margin-bottom: 20px;
    }
    .member-title{
        border-bottom: 1px solid #ddd;
    }
    .member-content{
        height: 90%;
    }
    .member-li{
        border-bottom: 1px solid #ddd;
    }
    .member-info{
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    .member-li .member-info:last-of-type{
        border-bottom: 0;
    }
    .mm_check{
        float: right;
    }
    .edit-contact-btn{
        display: none;
    }
    .craditLi2,
    .craditLi {
        display:none;
    }
    .r60p ,
    .r70p{
        float: right;
        height: 100%;
        padding-right: 5px;
        text-align: right;
    }
    .r60p{
        width: 60%;
    }
    .r70p{
        width: 70%;
    }
    .l30p ,
    .l40p {
        float: left;
        padding: 0 5px;
    }
    .l30p {
        width: 30%;
    }
    .l40p {
        width: 40%;
    }
    #craditNoTip {
        color: #3ec77d;
        /*width: 100%;*/
        padding: 5px;
        line-height: 30px;
    }
    #craditBinTip {
        color: #3ec77d;
        /*width: 100%;*/
        padding: 5px;
        line-height: 30px;
    }
    #showStageRate {
        color: #3ec77d;
        text-decoration: underline;
    }
    #activity-fee-list > li > div.service-typs{
        display: -webkit-box; /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
        display: -moz-box; /* 老版本语法: Firefox (buggy) */
        display: -ms-flexbox; /* 混合版本语法: IE 10 */
        display: -webkit-flex; /* 新版本语法: Chrome 21+ */
        display: flex; /* 新版本语法: Opera 12.1, Firefox 22+ */
        -webkit-box-direction: normal;
        -webkit-box-orient: horizontal;
        -moz-flex-direction: row;
        -webkit-flex-direction: row;
        flex-direction: row;
        -moz-box-lines: multiple; /*Firefox*/
        -webkit-box-lines: multiple; /*Safari,Opera,Chrome*/
        box-lines: multiple;
        -moz-flex-wrap: wrap; /*Firefox*/
        -webkit-flex-wrap: wrap; /*Safari,Opera,Chrome*/
        flex-wrap: wrap;
        width: 100%;
    }
    .div-flex{
        display: -webkit-box; /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
        display: -moz-box; /* 老版本语法: Firefox (buggy) */
        display: -ms-flexbox; /* 混合版本语法: IE 10 */
        display: -webkit-flex; /* 新版本语法: Chrome 21+ */
        display: flex; /* 新版本语法: Opera 12.1, Firefox 22+ */
        -webkit-box-direction: normal;
        -webkit-box-orient: horizontal;
        -moz-flex-direction: row;
        -webkit-flex-direction: row;
        flex-direction: row;
        -moz-box-lines: multiple; /*Firefox*/
        -webkit-box-lines: multiple; /*Safari,Opera,Chrome*/
        box-lines: multiple;
        -moz-flex-wrap: wrap; /*Firefox*/
        -webkit-flex-wrap: wrap; /*Safari,Opera,Chrome*/
        flex-wrap: wrap;
        justify-content: center;
    }
    .custom-type-money{
        position: absolute;
        right: 5px;
        bottom: 0;
        background-color: #3bbb75;
        color: #fff;
        height: 18px;
        line-height: 18px;
        font-size: 11px;
        padding: 0 5px;
    }
    .custom-type-money span{
        font-size: 11px;
    }
    .custom-type-name{
        font-size: 11px;
        height: 18px;
        line-height: 18px;
        margin: 0 5px;
        color: #888;
    }
    /*防止被swiper覆盖 by xsl 20170630*/
    #join-activity {
        z-index: 1040;
    }
    .swiper-pagination.swiper-pagination-bullets {
        bottom: 0;
        line-height: 1.5;
    }
    .swiper-pagination-bullet.swiper-pagination-bullet-active {
        line-height: 1.5;
    }
    .swiper-pagination-bullet-active {
        background-color: #3bbb75;
    }
    .fee-items.swiper-slide {
        width: 25% !important;
    }
    .lh-16 {
        line-height: 16px;
    }
    .flex-base.justify-between.items-center > .fee-count {
        padding: 0;
    }
    .free-item-shadow{
        position: absolute;
        left: 0;
        top: 0;
        z-index: 2;
        width: 100%;
        height: 100%;
    }
    .free-desc{
        display: none;
    }
    .free-custom-modal{
        position: fixed;
        left: 0;
        top: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
    }
    .free-custom-bg{
        position: fixed;
        left: 0;
        top: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }
    .free-custom-main{
        position: relative;
        z-index: 101;
        background-color: #fff;
        max-height: 80%;
        width: 85%;
        border-radius: 6px;
    }
    .free-custom-title{
        padding: 20px 0 15px 0;
        text-align: center;
        font-size: 18px;
        color: #000;
    }
    .free-custom-desc{
        margin: 15px;
        max-height: 60vh;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch; /*使IOS滚动更流畅，可能会影响性能*/
        color: #666;
    }
    .free-custom-btns{
        border-top: 1px solid #e0e0e0;
        padding: 20px;
    }
    .free-custom-btn{
        width: 50%;
    }
    .free-custom-btn span{
        width: 88%;
        display: inline-block;
        background-color: #35c87b;
        color: #fff;
        font-size: 16px;
        line-height: 36px;
        text-align: center;
        border-radius: 3px;
        border: 1px solid #35c87b;
    }
    .free-custom-btn span.faild{
        background-color: #fff;
        color: #999;
        border: 1px solid #999;
    }
    .bank-pay-tip{
        font-size: 12px;
        color: #999;
        padding: 0 5px;
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
    }
</style>
<!-- 新的常用联系人框样式 -->
<div id="my_member" style="display:none;">
    <div class="member-title">
        <div class="fl"><p id="mt" class="grey" style="padding: 6px 0;">勾选插入常用人信息</p></div>
        <div class="fr" style="padding-left: 5px;" >
            <button id="hideMemberBtn" class="btn btn-warning" onclick="hideMember();">确定</button>
            <button id="hideAddMemberBtn" class="btn btn-warning" onclick="hideAddMember();" style="display:none;">取消</button>
        </div>
        <div class="fr"><button data-ise="0" id="mte" type="button" class="btn btn-success">编辑</button></div>
        <div class="clr"></div>
    </div>
    <ul class="member-content">
        <?php $n=1; if(is_array($linkman)) { foreach($linkman as $row) { ?>
        <li class="member-li contact-li" id="li_<?php echo $row['contactId'];?>">
            <div class="fl" style="width:80%;">
                <div class="member-info member-name">
                    姓名：
                    <span id="n"><?php echo $row['realName'];?></span>
                    <?php if(!empty($row['isdefault']) ) { ?>
                    <span id="sdf_c_<?php echo $row['contactId'];?>" data-val="<?php echo $row['contactId'];?>" class="df">默认</span>
                    <?php } else { ?>
                    <span id="sdf_c_<?php echo $row['contactId'];?>" data-val="<?php echo $row['contactId'];?>" class="sf purple" onclick="setDefault(<?php echo $row['contactId'];?>)">设为默认</span>
                    <?php } ?>
                    <div class="pull-right green edit-contact-btn" onclick="editContact( <?php echo $row['contactId'];?> );">
                        编辑
                    </div>
                </div>
                <div class="member-info member-idcard">
                    身份证：
                    <span id="i"><?php echo $row['identity'];?></span>
                </div>
                <div style="display: none" class="member-info member-sex">
                    性别：
                    <span id="x"><?php echo $row['sexName'];?></span>
                </div>
                <div class="member-info member-phone">
                    电话号码：
                    <span id="t"><?php echo $row['telephone'];?></span>
                </div>
            </div>
            <div class="fr mm_check" style="width:20%;" pass-num="<?php echo $row['passNum'];?>" pass-addr="<?php echo $row['passAddr'];?>" pass-type="<?php echo $row['passType'];?>" data-val="<?php echo $row['contactId'];?>" identity-type="1" birthday="<?php echo $row['birthday_str'];?>" sex="1" onclick="selectMember($(this));">
                <span id="c_<?php echo $row['contactId'];?>" class="mem-unselect"></span>
            </div>
            <div class="clear"></div>
        </li>
        <?php $n++;}unset($n); } ?>
        <li id="newContact" style="display:none;">
            <form method="post">
                <input type="hidden" id="newContactId" name="newContactId" value="0">
                <div class="mm_info">
                    <div style="border-bottom: 1px solid #e9e9e9; padding:0;">
                        <div class="pull-left">姓名：</div>
                        <div class="pull-right" style="width:68%; padding:0;">
                            <input type="text" id="newContactName" name="newContactName" class="required new-contact-input" value="" placeholder="" style="padding-right:10px; width:100%;">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom: 1px solid #e9e9e9; padding:0;">
                        <div class="pull-left" style="position:relative;">
                            <div id="showContactIdentityType" style="padding:0;">
                                身份证 <img src="/phone/public/images/wechat/select_arrow.png" width="10">
                            </div>
                            <select id="newContactIdentityType" name="newContactIdentityType" style="position:absolute; left:0; top:0; opacity:0; width:100%; height:100%;">
                                <option value="1">身份证</option>
<!--                                <option value="3">港澳通行证</option>-->
<!--                                <option value="4">中国护照</option>-->
<!--                                <option value="7">香港护照</option>-->
<!--                                <option value="8">澳门护照</option>-->
<!--                                <option value="9">外国护照</option>-->
<!--                                <option value="10">回乡证</option>-->
<!--                                <option value="11">台胞证</option>-->
<!--                                <option value="6">其他</option>-->
                            </select>
                        </div>
                        <div class="pull-right" style="width:68%; padding:0;">
                            <input type="text" id="newContactIdentity" name="newContactIdentity" class="required isIdCardNo new-contact-input" value="" placeholder="" style="padding-left:10px; width:100%;">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom: 1px solid #e9e9e9; padding:0; display:none;">
                        <div class="pull-left">出生日期：</div>
                        <div class="pull-right" style="width:68%; padding:0;">
                            <input type="text" class="new-contact-input" id="newContactBirthday" name="newContactBirthday" value="" placeholder="" style="padding-right:10px; width:100%;">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom: 1px solid #e9e9e9; padding:0; display:none;">
                        <div class="pull-left">性别：</div>
                        <div class="pull-left" style="width:64%; padding:0;">
                            <label class="newContactSexRadio">
                                男 <input type="radio" value="1" name="newContactSex" class="newContactSex radio pd-l-5" id="newContactM">
                            </label>
                            <label class="newContactSexRadio">
                                女 <input type="radio" value="2" name="newContactSex" class="newContactSex radio pd-l-5" id="newContactW">
                            </label>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom: 1px solid #e9e9e9; padding:0;">
                        <div class="pull-left">电话号码：</div>
                        <div class="pull-right" style="width:68%; padding:0;">
                            <input type="text" id="newContactTel" name="newContactTel" oninput="this.value = (this.value.replace(/\s+/g, ''));" onafterpaste="this.value = (this.value.replace(/\s+/g, ''));" class="required isMobile new-contact-input" value="" placeholder="" style="padding-right:10px; width:100%;">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div id="addNewContactBtn">
                    <span style="float: left; line-height: 120px; text-align: center; width: 20%; color:#5cb85c;">保存</span>
                </div>
                <div class="clear"></div>
            </form>
        </li>
        <li id="addContact" class="text-center" style="padding: 10px 0; height:auto; border-bottom: 0; ">
            <button type="button" class="btn btn-success">+ 添加常用联系人</button>
        </li>
    </ul>
</div>
<div id="gl_model" class="modal in" style="display: none;background: #fff; margin: 20px;" aria-hidden="true" >
    <div class="modal-header" >
        <div class="fl" style=" margin-top: 3px;">
            <strong style="font-size: 16px;">港澳签证帮助</strong>
        </div>
        <button class="btn btn-warning fr" data-dismiss="modal">
            关闭
        </button>
        <div class="clr"></div>
    </div>
    <div class="modal-body" aria-hidden="true">
        <div class="row">
            <div class="col-xs-12">
                <img onclick="previewImages('/phone/public/images/wechat/gangao.gif')" src="/phone/public/images/wechat/gangao.gif" class="img-responsive" />
            </div>
            <div class="col-xs-4 col-xs-offset-4">
                <button class="btn btn-warning" data-dismiss="modal">我知道了</button>
            </div>
        </div>
    </div>
</div>
<div id="visa_model" class="modal in" style="display: none; margin: 20px;" aria-hidden="true">
    <div class="modal-header" style="background: #fff;">
        <div class="fl" style=" margin-top: 3px;">
            <strong style="font-size: 16px;">护照首页照片示例</strong>
        </div>
        <button class="btn btn-warning fr" data-dismiss="modal">
            关闭
        </button>
        <div class="clr"></div>
    </div>
    <div class="modal-body" aria-hidden="true" style="background: #fff;">
        <div class="row">
            <div class="col-xs-12">
                <img onclick="previewImages('#')" src="/phone/public/images/wx/passport.jpg" class="img-responsive" />
            </div>
            <div class="col-xs-4 col-xs-offset-4" style="padding-top: 10px;">
                <button class="btn btn-warning" data-dismiss="modal">我知道了</button>
            </div>
        </div>
    </div>
</div>
<div id="payNoticeModel" class="modal in" style="display:none;background: #fff; margin:20px; font-size:12px;" aria-hidden="true" >
    <div class="modal-header">
        <h5 class="text-center"><strong>【支付时出现额度限制的解决方法】</strong></h5>
    </div>
    <div class="modal-body" aria-hidden="true" >
        <div class="row">
            <div class="col-xs-12">
                <div class="method-title">方法一（推荐）</div>
                <div class="method-content">先打开微信支付或者支付宝支付，把钱充入微信零钱或者支付宝余额，然后支付时选择微信零钱（限额1万）或支付宝余额支付（一类账户1000元/终身、二类账户10万/年、三类账户20万/年）。</div>
            </div>
            <div class="col-xs-12">
                <div class="method-title">方法二</div>
                <div class="method-content">更换一张银行卡进行支付，各银行的限额如下表：</div>
                <div class="modal-table">
                    <div class="modal-table-titel">微信支付</div>
                    <div class="modal-table-content">
                        <table>
                            <thead>
                            <tr>
                                <th>银行名称</th>
                                <th>储蓄卡</th>
                                <th>信用卡</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>工商银行</td>
                                <td>1万/笔</td>
                                <td>1万/笔</td>
                            </tr>
                            <tr>
                                <td>建设银行</td>
                                <td>1万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>农业银行</td>
                                <td>5000/笔</td>
                                <td>5000/笔</td>
                            </tr>
                            <tr>
                                <td>中国银行</td>
                                <td>1万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>光大银行</td>
                                <td>5万/笔</td>
                                <td>4万/笔</td>
                            </tr>
                            <tr>
                                <td>招商银行</td>
                                <td>3万/笔</td>
                                <td>3万/笔</td>
                            </tr>
                            <tr>
                                <td>交通银行</td>
                                <td>5万/笔</td>
                                <td>/</td>
                            </tr>
                            <tr>
                                <td>邮政储蓄</td>
                                <td>5000/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>中信银行</td>
                                <td>5万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>民生银行</td>
                                <td>3万/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>兴业银行</td>
                                <td>2万/笔</td>
                                <td>3万/笔</td>
                            </tr>
                            <tr>
                                <td>平安银行</td>
                                <td>5万/笔</td>
                                <td>3万/笔</td>
                            </tr>
                            <tr>
                                <td>浦发银行</td>
                                <td>5万/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>华夏银行</td>
                                <td>1万/笔</td>
                                <td>1万/笔</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="table-notice">以上信息由微信提供，仅供参考</div>
                    </div>
                </div>
                <div class="modal-table">
                    <div class="modal-table-titel">支付宝</div>
                    <div style="padding-bottom:10px;"><strong>注：部分支付宝用户的限额部分银行卡固定为：单笔2000元、单日2000元、单月1万元。</strong></div>
                    <div class="modal-table-content">
                        <table>
                            <thead>
                            <tr>
                                <th>银行名称</th>
                                <th>储蓄卡</th>
                                <th>信用卡</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>工商银行</td>
                                <td>1万/笔</td>
                                <td>1万/笔</td>
                            </tr>
                            <tr>
                                <td>农业银行</td>
                                <td>1万/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>建设银行</td>
                                <td>1万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>中国银行</td>
                                <td>1万/笔</td>
                                <td>卡额度</td>
                            </tr>
                            <tr>
                                <td>平安银行</td>
                                <td>5万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>交通银行</td>
                                <td>1万/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>招商银行</td>
                                <td>5万/笔</td>
                                <td>3万/笔</td>
                            </tr>
                            <tr>
                                <td>浦发银行</td>
                                <td>30万/笔</td>
                                <td>10万/笔</td>
                            </tr>
                            <tr>
                                <td>邮储银行</td>
                                <td>5000/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>兴业银行</td>
                                <td>1万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>广发银行</td>
                                <td>3万/笔</td>
                                <td>3万/笔</td>
                            </tr>
                            <tr>
                                <td>华夏银行</td>
                                <td>50万/笔</td>
                                <td>2万/笔</td>
                            </tr>
                            <tr>
                                <td>民生银行</td>
                                <td>5万/笔</td>
                                <td>卡额度</td>
                            </tr>
                            <tr>
                                <td>光大银行</td>
                                <td>5万/笔</td>
                                <td>5万/笔</td>
                            </tr>
                            <tr>
                                <td>中信银行</td>
                                <td>5万/笔</td>
                                <td>卡额度</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="table-notice">以上信息由支付宝提供，仅供参考</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-center">
                <a id="confirmTermsBtn" class="btn btn-default btn-success center-block" data-dismiss="modal" role="button">确认</a>
            </div>
        </div>
    </div>
</div>
<div id="stageRateModel" class="modal in" style="display: none;background: #fff; margin: 20px;" aria-hidden="true" >
    <div class="modal-header" >
        <div class="fl" style=" margin-top: 3px;">
            <strong style="font-size: 16px;">查看费率</strong>
        </div>
        <button class="btn btn-success fr" data-dismiss="modal">
            关闭
        </button>
        <div class="clr"></div>
    </div>
    <div class="modal-body" aria-hidden="true">
        <div class="row">
            <div class="col-xs-12" id="stageRateDiv">
            </div>
            <div class="col-xs-4 col-xs-offset-4">
                <button class="btn btn-success" data-dismiss="modal">我知道了</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #guardianModal .modal-dialog{
        width: 100%;
        height: 100vh;
        margin: 0;
        padding: 10px;
    }
    #guardianModal .modal-content{
        margin-bottom: 10vh;
    }
    #guardianModal .modal-title{
        font-size: 16px;
        color: #333;
    }
    .guardian-tip{
        color: #999;
        font-size: 12px;
    }
    .guardian-tip span{
        color: #3ec77d;
        font-size: 14px;
    }
    .guardian{
        padding-top: 10px;
    }
    .guardian label{
        padding-left: 5px;
    }
    .guardian label.radio{
        margin: 0;
    }
    .new-guardian{
        border: 1px solid #ddd;
        border-bottom: 0;
        margin: 10px 0 5px 0;
    }
    .guardian-select{
        width: 20px;
        height: 20px;
        border-radius: 2px;
        border: 1px solid #ddd;
        box-shadow: 0 0 2px #ddd;
    }
    .guardian-select.selected{
        border-color: #9B8CE5;
        background-image: url('/phone/public/images/wechat/v4/correct.png');
        background-size: 80%;
        background-repeat: no-repeat;
        background-position: center;
    }
    .guardian-info, .guardian-option{
        padding: 0 10px;
        height: 40px;
        line-height: 40px;
        border-bottom: 1px solid #e9e9e9;
    }
    .guardian-input{
        width: 100%;
        text-align: right;
    }
    .new-guardian .guardian_select{
        position: relative;
    }
    .identitytype-select {
        text-align: left;
        width: 55px;
    }
    .new-guardian .select-show {
        width: 100%;
        height: 30px;
        text-align: right;
        background: url("/images/wechat/select_arrow.png") no-repeat;
        background-size: 12px;
        background-position: right 15px;
        padding-right: 16px;
        z-index: 0;
        position: relative;
    }
    .new-guardian .select-show img {
        position: absolute;
        right: 4px;
        top: 15px;
    }
    .new-guardian .guardian_select > select {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 30px;
        margin-top: 5px;
        z-index: 1000;
        opacity: 0;
    }
    .new-guardian label{
        padding: 0 5px;
        margin: 0;
    }
    .new-guardian .radio {
        margin: 0;
        height: 18px;
        width: 18px;
        position: relative;
        padding: 0;
        background-color: #cfcfcf;
        border-radius: 100%;
        vertical-align: top;
        box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .new-guardian .radio > span.pip {
        width: 10px;
        height: 10px;
        position: absolute;
        border-radius: 100%;
        background: #fff;
        top: 4px;
        left: 4px;
        box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.3), 0 0 1px rgba(255, 255, 255, 0.4) inset;
        background-image: linear-gradient(#ffffff 0, #e7e7e7 100%);
        transform: scale(0, 0);
        transition: all 0.2s ease;
    }
    .new-guardian .radio.on {
        background-color: #3ec77d;
    }
    .new-guardian .radio.on > span.pip {
        transform: scale(1, 1);
    }
    .set-guardian-btn{
        width: 40%;
        background-color: #9B8CE5;
        color: #fff;
        height: 34px;
        line-height: 34px;
        text-align: center;
        border-radius: 4px;
        margin-top: 10px;
    }
    .edit-guardian-btn{
        color: #9B8CE5;
    }
    #guardianModal .radio{
        min-height: 18px;
    }
    #guardianModal .modal-header, #guardianModal .modal-body{
        padding: 15px;
    }
    #guardianModal .error{
        border: 1px solid red;
    }
    #dateshadow{
        z-index: 9999;
    }
    #dateshadow, #datePage {
        position: fixed;
    }
</style>
<div class="modal" id="guardianModal">
    <div class="modal-dialog flex-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">监护人设置</h4>
            </div>
            <div class="modal-body">
                <div class="guardian-tip">* 由于政策规定，未成年人购买保险需要绑定监护人信息，请为“<span>XXX</span>”设置监护人：</div>
                <div class="guardian-list flex-div"></div>
                <div class="guardian flex-start">
                    <input type="radio" class="guardian-radio" id="guardian-1" name="guardian" value="-1" style="display:none;">
                    <label for="guardian-1">新增监护人信息</label>
                </div>
                <div class="new-guardian">
                    <input type="hidden" id="signup_index_guardian" value="0">
                    <input type="hidden" id="signup_index_guardian_id" value="0">
                    <div class="guardian-info guardian-realname flex-single justify-between">
                        <div>真实姓名</div>
                        <div style="width:70%;">
                            <input type="text" class="guardian-input required" id="guardian_realname" name="guardian_realname" value="" placeholder="（与证件名字一致）">
                        </div>
                    </div>
                    <div class="guardian-hide-show" style="display:none;">
                        <div class="guardian-info flex-single justify-between">
                            <div>证件号码</div>
                            <div class="text-right" style="width:70%;">**** ****</div>
                        </div>
                        <div class="guardian-info flex-center">
                            <input type="hidden" id="need_edit_guardian" value="0">
                            <div class="edit-guardian-btn" onclick="editGuardian(this);">点击修改</div>
                        </div>
                    </div>
                    <div class="guardian-base-info">
                        <div class="guardian-info guardian-identity flex-single justify-between">
                            <div class="guardian_select" data-type="idcardtype">
                                <div class="select-show identitytype-select">身份证</div>
                                <select id="guardian_identity_type" name="guardian_identity_type" class="guardian-identity-type">
                                    <option class="type1" value="1" selected="selected">身份证</option>
<!--                                    <option class="type4" value="4">护照</option>-->
<!--                                    <option class="type6" value="6">其他</option>-->
                                </select>
                            </div>
                            <div style="width:70%;">
                                <input type="text" class="guardian-input required" id="guardian_identity" name="guardian_identity" value="" placeholder="（与证件号码一致）">
                            </div>
                        </div>
                        <div class="guardian-info guardian-birthday flex-single justify-between" style="display:none;">
                            <div class="">出生日期</div>
                            <div style="width:70%;">
                                <input type="text" class="guardian-input" id="guardian_birthday" name="guardian_birthday" value="" placeholder="（例如：2016-01-01）">
                            </div>
                        </div>
                        <div class="guardian-info guardian-sex flex-single justify-between" style="display:none;">
                            <div class="">性别</div>
                            <div class="flex-div">
                                <div class="flex-center" style="width:50px;">
                                    <label for="guardian_sex1">男</label>
                                    <input type="radio" class="guardian_radio guardian_sex" id="guardian_sex1" name="guardian_sex" value="1" style="display:none;">
                                </div>
                                <div class="flex-center" style="width:50px;">
                                    <label for="guardian_sex2">女</label>
                                    <input type="radio" class="guardian_radio guardian_sex" id="guardian_sex2" name="guardian_sex" value="2" style="display:none;">
                                </div>
                            </div>
                        </div>
                        <div class="guardian-info guardian-telephone flex-single justify-between">
                            <div>电话号码</div>
                            <div style="width:70%;">
                                <input type="text" class="guardian-input required" id="guardian_telephone" name="guardian_telephone" value="" placeholder="（必填）">
                            </div>
                        </div>
                        <div class="guardian-info guardian-guardian_relationship flex-single justify-between">
                            <div class="">监护关系</div>
                            <div class="flex-div">
                                <div class="flex-center" style="width:60px;">
                                    <label for="guardian_relationship6">父亲</label>
                                    <input type="radio" class="radio guardian_relationship" id="guardian_relationship6" name="guardian_relationship" value="6" style="display:none;">
                                </div>
                                <div class="flex-center" style="width:60px;">
                                    <label for="guardian_relationship7">母亲</label>
                                    <input type="radio" class="radio guardian_relationship" id="guardian_relationship7" name="guardian_relationship" value="7" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-center">
                    <div class="set-guardian-btn" onclick="setGuardian();">确定</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="join-content" class="content">
    <div class="join">
        <form id="form" >
            <input type="hidden" name="aid" value="<?php echo $info['id'];?>" />
            <input type="hidden" name="wxoid" value="olC_OvnqtWCnecppaTktQHxZl65w">
            <input type="hidden" name="ft" value="0">
            <input type="hidden" name="people_num" value="0">
            <input type="hidden" name="suitid" id="suitid" value="<?php echo $suit['suitid'];?>"/>
            <input type="hidden" name="productid" id="productid" value="<?php echo $info['id'];?>"/>
            <input type="hidden" name="typeid"  value="<?php echo $typeid;?>"/>
            <input type="hidden" name="deposite" id="deposit" value="">
            <input type="hidden" name="storage" id="storage" value="<?php echo $suit['number'];?>"/>
            <input type="hidden" name="usejifen" id="usejifen" value="0"/>
            <input type="hidden" name="startdate" id="startdate" value="<?php echo $suit['day'];?>"/>
            <input type="hidden" name="distribution_id" id="distribution_id" value="<?php echo $distribution_id;?>"/>
            <div class="default-people">
                <div style="float: left; padding-left: 5px;" class="" >
                    请填写报名信息
                </div>
                <div id="changyong">
                    常用联系人
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="default-people">
                <p class="fz12 grey" style="float: left; padding-left: 5px;">
                <?php echo $info['insurance_tips'];?></p>
                <div style="clear: both;"></div>
            </div>
            <div id="member">
                <ul  class="signups" data-index="0">
                    <li>
                        <div class="left">真实姓名</div>
                        <div class="right">
                            <input id="realname0" type="text" name="realname0" value="<?php echo $default_linkman['realName'];?>" placeholder="（与证件名字一致）" class="required realname"
                            />
                        </div>
                        <div style="clear: both;"></div>
                    </li>
                    <li>
                        <div class="left">
                            <div class="select">
                                <div class="select-show idcardSelect">
                                    身份证
                                    <img src="/phone/public/images/wechat/select_arrow.png" width="10">
                                </div>
                                <select id="idcardtype0" name="idcardtype0" class="idcardtype" signupNum="0" selectType="idcardtype">
                                    <option class="type1" value="1" >身份证</option>
<!--                                    <option class="type3" value="3" >港澳通行证</option>-->
<!--                                    <option class="type4" value="4" >中国护照</option>-->
<!--                                    <option class="type7" value="7" >香港护照</option>-->
<!--                                    <option class="type8" value="8" >澳门护照</option>-->
<!--                                    <option class="type9" value="9" >外国护照</option>-->
<!--                                    <option class="type10" value="10" >回乡证</option>-->
<!--                                    <option class="type11" value="11" >台胞证</option>-->
<!--                                    <option class="type6" value="6" >其他</option>-->
                                </select>
                            </div>
                        </div>
                        <div class="right">
                            <input id="idcard0" type="text" value="<?php echo $default_linkman['identity'];?>" idType="" name="idcard0" placeholder="（与证件号码一致）" onblur="checkIdCardInput( this );" class="idCardInput required"
                            />
                        </div>
                        <div style="clear: both;"></div>
                    </li>
                    <li class="birthday-li" style="display:none;">
                        <div class="left">出生日期</div>
                        <div class="right">
                            <input id="birthday0" class="birthday" type="text" name="birthday0" placeholder="（例如：2016-01-01）" value="" />
                        </div>
                        <div style="clear: both;"></div>
                    </li>
                    <li class="sex-li" style="display:none;">
                        <div class="left">性别</div>
                        <div class="right sex">
                            <label>
                                男 <input id="sexM0" <?php if($default_linkman['sex']==1) { ?> checked="checked"  <?php } ?>
 class="sexRadio radio pd-l-5" type="radio" name="sex0" value="1"  />
                            </label>
                            <label>
                                女 <input id="sexW0" <?php if($default_linkman['sex']==0) { ?> checked="checked"  <?php } ?>
 class="sexRadio radio pd-l-5" type="radio" name="sex0" value="2"  />
                            </label>
                        </div>
                        <div style="clear: both;"></div>
                    </li>
                    <li>
                        <div class="left">电话号码</div>
                        <div class="right">
                            <input id="tel0" type="text" name="tel0" value="<?php echo $default_linkman['telephone'];?>" placeholder="（必填）" oninput="this.value = (this.value.replace(/\s+/g, ''));" onafterpaste="this.value = (this.value.replace(/\s+/g, ''));" class="mobileInput required"
                            />
                        </div>
                        <div style="clear: both;"></div>
                    </li>
                </ul>
                <div id="add-btn" class="add-btn purple" onclick="addmember()" >
                    + 增加报名人
                </div>
                <div style="clear: both;"></div>
            </div>
            <div id="activity-fee">
                <div style="float: left; padding-left: 5px;" class="" >
                    当前选择
                </div>
                <div style="clear: both;"></div>
            </div>
            <ul>
                <li>
                    <div class="pull-left" style="padding-right:10px; width:30%;"><?php echo date('m月d日',$suit['day']);?></div>
                    <div class="pull-left" style="text-align:right;padding-left:5px; width:70%;"><?php echo $info['startcity'];?>出发</div>
                    <div style="clear: both;"></div>
                </li>
            </ul>
            <div id="activity-fee">
                <div style="float: left; padding-left: 5px;" class="" >
                    集合地点
                </div>
                <div style="clear: both;"></div>
            </div>
            <ul id="marshal-point-ui">
                <li>
                    <div class="pull-left" style="padding-right:10px; width:33.33%;">当前地点</div>
                    <div class="pull-right" style="text-align:right;padding-left:5px; width:50%;">
                        <select id="marshal-point" name="marshal_point" class="form-control" style="box-shadow: none;border: none;background: #f5f5f5; color: #c1c1cc;">
                            <option style="text-align: right" value="0">请选择集合地点</option>
                            <?php $n=1; if(is_array($info['marshal_point_list'])) { foreach($info['marshal_point_list'] as $row) { ?>
                            <option style="text-align: right" value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php $n++;}unset($n); } ?>
                        </select>
                    </div>
                    <div style="clear: both;"></div>
                </li>
            </ul>
            <div id="activity-fee">
                <div style="float: left; padding-left: 5px;" class="" >
                    费用详情
                </div>
                <div style="clear: both;"></div>
            </div>
            <ul id="activity-fee-list">
                <li>
                    <div class="pull-left">
                        基础价格
                    </div>
                    <div class="pull-left">
                        <span id="baseMoney" class=""><?php echo $info['price'];?></span>元/人
                    </div>
                    <div class="pull-left" style="text-align:right; padding-right:10px;">
                        <!--  -->
                        <span id="join-num"></span>人
                    </div>
                    <div style="clear: both;"></div>
                </li>
            </ul>
            <div id="activity-fee" style="display: none">
                <div style="float: left; padding-left: 5px;" class="" >
                    商品服务
                </div>
                <div style="clear: both;"></div>
            </div>
            <ul id="activity-fee-list" style="display: none">
                <li class="fee-items-more" style="height:auto; line-height:auto;">
                    <div style="width:100%;" onclick="showServiceTypes(this);" is-show="1">
                        <div class="pull-left" style="width:80%;">
                            茄子户外运动原创设计<span style="font-size:11px; color:#888;">(点击图片查看大图)</span>
                        </div>
                        <div class="pull-left" style="text-align:right; padding-right:10px; width:20%;">
                            <img class="" src="/phone/public/images/wechat/select_arrow.png" width="10">
                        </div>
                    </div>
                    <div class="service-typs"  style="padding:0 5px;display: none ">
                        <div class="swiper-container" id="productSwiperBox" style="padding-bottom:10px; ">
                            <div class="swiper-wrapper">
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">百搭帆布包</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('#');">
                                        <div class="custom-type-money fee-money">￥<span>58</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_16" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">冷感毛巾</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('#');">
                                        <div class="custom-type-money fee-money">￥<span>48</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_15" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">橙色头巾</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('#');">
                                        <div class="custom-type-money fee-money">￥<span>18</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_19" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">蓝色头巾</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('#');">
                                        <div class="custom-type-money fee-money">￥<span>18</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_18" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">粉色头巾</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('#');">
                                        <div class="custom-type-money fee-money">￥<span>18</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_17" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">粉色登山杖</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('#');">
                                        <div class="custom-type-money fee-money">￥<span>60</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_14" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                                <div class="text-center fee-items swiper-slide" style="width:25%; padding-bottom:10px;">
                                    <div class="custom-type-name">绿色登山杖</div>
                                    <div style="padding:0 5px; position:relative;">
                                        <img src="#" style="width:100%;" onclick="previewImages('');">
                                        <div class="custom-type-money fee-money">￥<span>60</span></div>
                                    </div>
                                    <div class="div-flex fee-count" style="padding:10px 5px 0 5px;">
                                        <div class="fee-del-btn" style="width:33.33%;">-</div>
                                        <div class="fee-num" style="width:33.33%;">
                                            <input type="text" name="product_13" class="no-style-input" value="0" style="display:none;">
                                            <label>0</label>
                                        </div>
                                        <div class="fee-add-btn" style="width:33.33%;">+</div>
                                    </div>
                                </div>
                                <!-- <div class=""> -->
                                <!-- </div> -->
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
            </ul>
            <div class="default-people">
                <div style="float: left; width:100%;" class="" >
                    支付方式
                </div>
            </div>
            <ul id="paytype-ul">
                <li for="paytype0" class="flex-base align-center justify-between items-center">
                    <div class="left" style="width: 80%;">
                        微信支付<span class=" fz12" >（推荐）</span>                            </div>
                    <div class="right rr" style="width: 25px;">
                        <input id="paytype0" class="radio" type="radio" name="paytype" value="0" />
                    </div>
                </li>
<!--                <li for="paytype1" class="flex-base align-center justify-between items-center">-->
<!--                    <div class="left" style="width: 80%;">-->
<!--                        支付宝                            </div>-->
<!--                    <div class="right rr" style="width: 25px;">-->
<!--                        <input id="paytype1" class="radio" type="radio" name="paytype" value="1" />-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li id="bankPay" for="paytype2" class="flex-base align-center justify-between items-center" style="display:none; position:relative; padding-bottom:20px; height:60px;" data-needbankpay="0">-->
<!--                    <div class="left" style="width: 80%;">-->
<!--                        <div>银行汇款</div>-->
<!--                    </div>-->
<!--                    <div class="right rr" style="width: 25px;">-->
<!--                        <input id="paytype2" class="radio" type="radio" name="paytype" value="2" />-->
<!--                    </div>-->
<!--                    <div class="bank-pay-tip">建议选择微信支付宝付款，如有退款发生，处理速度更快！</div>-->
<!--                </li>-->
            </ul>
            <div class="default-people" style="display: none">
                <div style="float: left; width:100%;" class="" >
                    优惠抵扣
                </div>
                <div style="clear: both;"></div>
            </div>
            <ul class="">
                <li for="isUseScore" onclick="showUseScore(this,1);">
                    <input type="hidden" id="formUseScore" name="useScore" value="">
                    <input type="hidden" id="formUseBalance" name="useBalance" value="">
                    <input type="hidden" id="formUseExperience" name="useExperience" value="">
                    <div class="pull-left" style="padding-left:5px;">
                        使用学分余额抵扣
                    </div>
                    <div class="pull-right" style="padding-right:15px; position:relative;">
                        <div class="cannot-click"></div>
                        <input id="isUseScore" type="checkbox" name="isUseScore" value="1" />
                        <label class="chkbox comChk" for="isUseScore"></label>
                    </div>
                    <div style="clear: both;"></div>
                </li>
                <li onclick="showCardList(this);" style="display: none" >
                    <!-- <li onclick="useCard();" > -->
                    <div class="left"  style="display: none">代金券</div>
                    <div id="cardselect" class="right ">
                        <span class="fz12" > (支付后不退还)</span>
                        <img class="go" style="margin-top: -3px;" src="/phone/public/images/wechat/in.png">
                    </div>
                    <div style="clear: both;"></div>
                </li>
            </ul>
            <div style="margin: 12px 5px 20px;"  >
                <input type="checkbox" name="mianze" id="mianze" value="1" />
                <label class="chkbox" for="mianze">
                    我已阅读并同意<a id="service-desc" href="javascript::void(0)" style="color:#9B8CE5; text-decoration:underline;">《旅游服务协议》</a>
                </label>
            </div>
            <div class="clear"></div>
            <div id="join-activity">
                <!-- 显示限名额减免剩余名额 -->
<!--                <div id="count-activity-fee">-->
<!--                    <span><span id="all-join-money">0</span>元</span>-->
<!--                </div>-->
                <div id="submit-btn">
                    <input id='payBtn' data-value="0" type="button" value="￥0 支付" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="serviceDescModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">旅游服务协议</h4>
            </div>
            <div class="modal-body">
                加载中...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div id="datePlugin"></div> <!-- 日期选择弹出层 -->
</body>
<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript">
    function adapt(e){
        var divWidth = $(e).parent().width(); //div宽度
        var divHeight = $(e).parent().height(); //div高度
        var img = new Image();
        img.src =$(e).attr("src");
        var imgWidth = img.width; //图片实际宽度
        var imgHeight = img.height;
        var d = 0;
        if ( (imgWidth < imgHeight) || (imgWidth > divWidth) ) {
            d = 0;
            var style = "width: 100%; height: auto;";
        } else {
            d = 1;
            var style = "height: 100%; width: auto;";
        }
        $(e).attr("style", style);
    }
    $("#service-desc").click(function(){
        $('#serviceDescModal').modal();
        $('#serviceDescModal').modal('show').find('.modal-body').load('http://www.168hike.com/phone/pub/disclaimer');
    });
</script>
<!-- 依赖 /css/wechat/v4/flex_box.css -->
<!-- 依赖 /css/font-awesome/css/font-awesome.min.css -->
<!-- 依赖 JQ -->
<style type="text/css">
    a {
        cursor: pointer;
    }
    .card_list_box a:hover,
    .card_list_box a:focus {
        color: #3a3a3a;
    }
    .card_list_box ,
    .card_list_backdrop {
        width: 100%;
        width: 100vw;
        position: fixed;
        background-color: #f0f0f0;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        transform: translateX(110%);
        -ms-transform: translateX(110%);
        -moz-transform: translateX(110%);
        -webkit-transform: translateX(110%);
        -o-transform: translateX(110%);
        transition: transform 200ms;
        -ms-transition: -ms-transform  200ms;
        -moz-transition: -moz-transform  200ms;
        -webkit-transition: -webkit-transform 200ms;
        -o-transition: -o-transform 200ms;
        overflow-x: hidden;
        overflow-y: auto;
    }
    .card_list_backdrop {
        height: 100%;
        height: 100vh;
        z-index: 99;
    }
    div.card_list_in {
        transform: translateX(0);
        -ms-transform: translateX(0);
        -moz-transform: translateX(0);
        -webkit-transform: translateX(0);
        -o-transform: translateX(0);
    }
    #card_list_nav {
        height: 40px;
        background-color: #fafafa;
        position:fixed;
        left: 0;
        top: 0;
        width: 100%;
    }
    #card_list_hide {
        line-height: 40px;
        padding: 0px 10px;
        width: 65px;
    }
    #card_list_hide img{
        width: 16px;
        vertical-align: middle;
    }
    #card_list_finish {
        height: 40px;
        padding-right: 10px;
        width: 65px;
        text-align: right;
    }
    #card_list_finish_text {
        display: inline-block;
        padding: 2px 5px;
        border-radius: 4px;
        color: #fff;
        background-color: #9B8CE5;
    }
    #card_list_title {
        font-size: 18px;
    }
    #card_list_content_box {
        padding: 10px 10px;
        width: 100%;
        background-color: #f0f0f0;
        overflow-x: hidden;
        overflow-y: auto;
    }
    .card_list_detail {
        padding: 20px 15px;
        background-color: #fff;
        width: 100%;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #fff;
        border-bottom-color: #f0f0f0;
        position: relative;
        transition: border-color 200ms;
        -ms-transition: border-color  200ms;
        -moz-transition: border-color  200ms;
        -webkit-transition: border-color 200ms;
        -o-transition: border-color 200ms;
    }
    .list_active.card_list_detail {
        border-color: #9B8CE5;
    }
    .card_list_deisble {
        background-color: #fbfbfb;
        border-color:#fff;
    }
    .card_list_deisble .card_list_name  {
        color:#888;
    }
    .card_list_no_use {
        padding: 12px 15px;
    }
    .card_list_icon {
        min-width: 50px;
        width: 50px;
        min-height: 50px;
        height: 50px;
        margin-right: 10px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 50%;
    }
    .card_list_info_box {
        max-width: 90vw;
    }
    .card_list_name {
        font-size: 20px;
        /*font-weight: 700;*/
    }
    .indent_11 {
        margin-left: -11px;
    }
    .card_list_tip ,
    .card_list_time ,
    .card_list_desc {
        color:#888;
    }
    .card_list_checked {
        position: absolute;
        top: 0px;
        right: 0px;
        width: 0;
        height: 0;
        border-top: 25px solid #9B8CE5;
        border-left: 25px solid transparent;
        opacity: 0;
        transition: opacity 200ms;
        -ms-transition: opacity  200ms;
        -moz-transition: opacity  200ms;
        -webkit-transition: opacity 200ms;
        -o-transition: opacity 200ms;
        font: normal normal normal 14px/1 FontAwesome;
    }
    .card_list_checked:before {
        position: absolute;
        top: -25px;
        right: 0px;
        content: "\f00c";
        color: #fff;
        width: 14px;
        height: 14px;
    }
    .list_active .card_list_checked {
        opacity: 1;
    }
    .card-tab{
        width: 50%;
        text-align: center;
        background-color: #fff;
        font-size: 16px;
        line-height: 40px;
    }
    .card-tab.active span{
        color: #9B8CE5;
        border-bottom: 3px solid #9B8CE5;
        padding-bottom: 5px;
    }
    .cards-content{
        display: none;
    }
    .cards-content.active{
        display: inherit;
    }
    .new-hiker-cards-btn{
        background-color: #9B8CE5;
        color: #fff;
        font-size: 18px;
        line-height: 40px;
        padding: 0 10px;
        border-radius: 4px;
    }
</style>
<div class="card_list_box" style="display: none">
    <div class="card-tabs flex-center">
        <div class="card-tab active" onclick="changeCardTab(this);" data-tab="0">
            <span>代金券</span>
        </div>
        <div class="card-tab" onclick="changeCardTab(this);" data-tab="1">
            <span>新人大礼包</span>
        </div>
    </div>
    <div id="card_list_content_box">
        <div id="card_list_content">
            <div class="cards-content active" data-tab="0">
                <a class="card_list_detail flex-base justify-start items-center" href="javascript:void(0);" onclick="cardListDetailClick(this, 0);" data-code="0" data-id="" data-title="不使用卡券" data-leastcost="0" data-reducecost="0" data-type="" data-day="0" data-errcode="0" data-errmsg="" data-age=0 data-identity="">
                    <div class="card_list_info_box flex-base direction-column justify-between items-start">
                        <div class="card_list_name">不使用卡券</div>
                    </div>
                    <div class="card_list_checked"></div>
                </a>
            </div>
            <div class="cards-content" data-tab="1">
            </div>
        </div>
    </div>
</div>
<div class="card_list_backdrop"></div>
<script type="text/javascript">
    var newHikerCardList = false;
</script>
<script src="/phone/public/js/toast.js?v=19" type="text/javascript" charset="utf-8" async defer></script>
<script src="/phone/public/js/wechat/card_list.js?v=20" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js?v=131" ></script>
<script type="text/javascript" src="/phone/public/js/jquery.validate.min.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/messages_zh.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/jquery-validate-methods.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap-modal.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/tool.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/radio.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/datetime.js?v=131" ></script>
<script type="text/javascript" src="/phone/public/js/datetime_iscroll.js?v=131" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=131" ></script>
<script type="text/javascript">
    var termsUrl = "#";
    var aliDiscount = "100";
    aliDiscount = (isNaN(aliDiscount) || aliDiscount < 0 || aliDiscount > 100) ? 100 : aliDiscount;
    var isTest = 0;
    var stageCardNoStars = "";
    var hikerActivityServiceStageId = "";
    var stageBankName = "";
    var wxoid = "olC_OvnqtWCnecppaTktQHxZl65w";
    var contactCount = "0";
    var encript_code =  ''  ;
    var card_id = '';
    var curCardMoney =  0 ;
    var payendUrl = '#';
    var identityTypes = [{"type":1,"name":"身份证"}];
    //年龄段
    var max_age = 5 ;
    var max_age = 60 ;
    var activity_days = "<?php echo $info['lineday'] ?>";
    var contactCount = 0;
    var contactsById = <?php echo json_encode($linkman); ?>; //常用联系人数组
    var scoreExchangeRate = <?php echo $score_arr['exchange'];?>; //学分的折算比例
    var isUseScore = false; //是否使用学分
    var canUseScore = <?php echo $score_arr['userScore'];?>; //可使用的学分
    var useScore = <?php echo $score_arr['availableUseScore'];?>; //用户使用的学分
    var careMoney = 0;
    var careJob = "";
    var care = false;
    var isSingle = false;
    var isHK = false;
    var mySignInfo = false;
    var mySignInfoCount = 1;
    var aid = "<?php echo $info['id'] ?>";
    var oid = 'olC_OvnqtWCnecppaTktQHxZl65w';
    var hid = '690587';
    var hikerRole = parseInt('0');
    var create_order_url = "/phone/line/ajax_create";
    var money = "<?php echo $info['price'] ?>";
    var isaddservice = false;
    $("#all-join-money").html( money );
    $("#join-num").html( 1 );
    $("#join-discount").html( 0 );
    var job =  ''  ;
    //是否存在小孩子优惠项
    var haveChildDiscount =  false ;
    //是否存在新用户优惠
    var haveNewUserDiscount =  false ;
    //是否存在限名额优惠
    var haveQuotaLimit =  false ;
    var isHaveGroup = false;
    var selectOptions = '';
    var selectOptionsLength = 0;
    //遍历与报名人对应的优惠项和附加项
    function addSignUpsDiscountsLi( num ){
        var signUpsDiscountsLi = '';
        //判断是否存在L签类型的自定义优惠
        //判断是否存在签证费类型的自定义优惠
        return signUpsDiscountsLi;
    }
    $(".signups").append( addSignUpsDiscountsLi(0) );
    var careIsDefalt = false; //判断是否选择关爱日优惠的判断依据
    var visagClickSignUps = []; //有选择签证费的对应报名人编号数组
    var isAbroad = false; //是否为境外活动
    var guardianPageType = 1;
    var needCheckGuardian = 1; //需要检测未成年人
    var vip_info = false;
    var havCutDiscount = false;
</script>
<script type="text/javascript" src="/phone/public/js/wechat/guardian.js?v=131"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pay_join_new.min.js?v=131"></script>
<script type="text/javascript">
    //选中关爱日优惠
    //初始页面检查
    updateNeedGuardian();
    updateVipDiscount();
    $("#newContactBirthday").date(
        "", //配置默认项
        function(date,thisObj){
            //确定日期后调用
            $(thisObj).val( date );
            $("#my_member").css("z-index","1050");
        },
        function(date){
            //没有选择日期后调用
            $("#my_member").css("z-index","1050");
        }
    );
    $(".birthday").each(function(index, el) {
        $(this).date(
            "", //配置默认项
            function(date,thisObj){
                $(thisObj).val( date );
                //确定日期后调用
                checkNeedGuardian( date, thisObj );
            },
            function(date){
                //没有选择日期后调用
            }
        );
    });
    /**
     * [cardListCallBack 新的卡券列表回调]
     * @Author   XieShaoLi
     * @DateTime 2017-11-03
     */
    function cardListCallBack(params) {
        card = params;
        card_type = card.card_type;
        reduce_cost = 0;
        $('#cardselect').html('不使用卡券 <img class="go" style="margin-top: -3px;" src="/phone/public/images/wechat/in.png">');
        if (card.code != 0) {
            if (card_type == 'CASH') {
                least_cost = card.least_cost / 100;
                var fee = $("#all-join-money").html();
                if (fee + curCardMoney < least_cost) {
                    popLayer({
                        title: '温馨提示',
                        btnsName: '返回',
                        btnsCallback: 'closePopLayer()',
                        content: '十分抱歉！订单总价需要满' + least_cost + '元才可以使用该卡券。',
                    });
                } else {
                    reduce_cost = card.reduce_cost / 100;
                }
                if (card.age > 0) {
                    var idCardInputs = $('.idCardInput');
                    if (idCardInputs.length > 0) {
                        var date = new Date();
                        var year = parseInt(date.getFullYear());
                        var inYear = false;
                        for (var i = 0; i < idCardInputs.length; i++) {
                            var type = $(idCardInputs[i]).attr('idType');
                            if (type == 1 || type == 2) {
                                var idcard = $(idCardInputs[i]).val();
                                var y = parseInt(idcard.substr(6, 4));
                                if (year - y <= card.age) {
                                    inYear = true;
                                    break;
                                }
                            } else {
                                var birthday = $.trim($($('.birthday')[i]).val());
                                if (birthday) {
                                    var birthyear = birthday.split('-')[0];
                                    if (birthyear < year || birthyear > (year - 100)) {
                                        if (year - birthyear <= card.age) {
                                            inYear = true;
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                        if (inYear) {
                            reduce_cost = card.reduce_cost / 100;
                        } else {
                            reduce_cost = 0;
                            popLayer({
                                title: '温馨提示',
                                btnsName: '返回',
                                btnsCallback: 'closePopLayer()',
                                content: '十分抱歉！订单需要添加年龄小于' + card.age + '岁的用户才可以使用该卡券。',
                            });
                        }
                    } else {
                        reduce_cost = 0;
                        popLayer({
                            title: '温馨提示',
                            btnsName: '返回',
                            btnsCallback: 'closePopLayer()',
                            content: '十分抱歉！订单需要添加年龄小于' + card.age + '岁的用户才可以使用该卡券。',
                        });
                    }
                }
            } else if (card_type == 'GIFT') {
                var day = card.day;
                if (day < activity_days) {
                    popLayer({
                        title: '温馨提示',
                        btnsName: '返回',
                        btnsCallback: 'closePopLayer()',
                        content: '十分抱歉！该卡券仅限于' + day + '天以内活动使用。',
                    });
                } else if (day == 1 && money >= 200) {
                    popLayer({
                        title: '温馨提示',
                        btnsName: '返回',
                        btnsCallback: 'closePopLayer()',
                        content: '十分抱歉！该卡券仅限于活动基础费用为200元内的活动使用。',
                    });
                } else if (day == 2 && money >= 300) {
                    popLayer({
                        title: '温馨提示',
                        btnsName: '返回',
                        btnsCallback: 'closePopLayer()',
                        content: '十分抱歉！该卡券仅限于活动基础费用为300元内的活动使用。',
                    });
                } else {
                    reduce_cost = card.reduce_cost / 100;
                    // reduce_cost = money;
                }
            }
            // 身份证判定
            if (card.identity != undefined && card.identity != '') {
                var idCardInputs = $('.idCardInput');
                var noinsfz = true;
                if (idCardInputs.length > 0) {
                    for (var i = 0; i < idCardInputs.length; i++) {
                        var sfz = $.trim($(idCardInputs[i]).val());
                        if (sfz == card.identity) {
                            noinsfz = false;
                        }
                    }
                }
                if (noinsfz) {
                    popLayer({
                        title: '温馨提示',
                        btnsName: '返回',
                        btnsCallback: 'closePopLayer()',
                        content: '十分抱歉！该卡券仅限于证件号为' + card.identity + '的用户使用。',
                    });
                    reduce_cost = 0;
                }
            }
            if (reduce_cost > 0) {
                $('#cardselect').html('<span> ' + card.title + ' -' + reduce_cost + '元 </span> <img class="go" style="margin-top: -3px;" src="/phone/public/images/wechat/in.png">');
                encript_code = card.code;
                card_id = card.id;
            } else {
                card = {
                    "id": "",
                    "code": "0",
                    "title": "不使用卡券",
                    "least_cost": "0",
                    "reduce_cost": "0",
                    "card_type": "",
                    "day": "0",
                    "age": "0"
                };
                card_type = card.card_type;
                encript_code = card_id = '';
            }
            curCardMoney = reduce_cost;
        } else {
            curCardMoney = 0;
            encript_code = card_id = '';
        }
        countActivityMoney();
    }
    function useCard() {
        wx.chooseCard({
            shopId: '', // 门店Id
            cardType: '', // 卡券类型
            cardId: '', // 卡券Id
            timestamp: '1537202345', // 卡券签名时间戳
            nonceStr: 'qs6PdfytO3qQJTdK', // 卡券签名随机串
            signType: 'SHA1', // 签名方式，默认'SHA1'
            cardSign: 'a5c55eb79741a316f286de01c0bb865080729d58', // 卡券签名
            success: function (res) {
                var cardList= res.cardList; // 用户选中的卡券列表信息
                var cardListObj = eval(cardList)
                var len = cardListObj.length;
                if ( len == 1 ) {
                    $.ajax({
                        type: "post",
                        data: {
                            'card_id': cardListObj[0].card_id
                        },
                        url: "/wechat/pay/getCardDetail",
                        async: false,
                        cache: false,
                        dataType: "json",
                        success: function (response) {
                            if ( response.status ) {
                                card = response.card_info;
                                card_type = card.card_type;
                                reduce_cost = 0;
                                if (card_type == 'CASH') {
                                    least_cost = card.least_cost / 100 ;
                                    var fee = $("#all-join-money").html();
                                    if ( fee + curCardMoney < least_cost ) {
                                        popLayer(
                                            {
                                                title: '温馨提示',
                                                btnsName: '返回',
                                                btnsCallback: 'closePopLayer()',
                                                content: '十分抱歉！订单总价需要满' + least_cost + '元才可以使用该卡券。',
                                            }
                                        );
                                    } else {
                                        reduce_cost = card.reduce_cost / 100;
                                    }
                                } else if (card_type == 'GIFT') {
                                    var day = card.day;
                                    if (day < activity_days) {
                                        popLayer(
                                            {
                                                title: '温馨提示',
                                                btnsName: '返回',
                                                btnsCallback: 'closePopLayer()',
                                                content: '十分抱歉！该卡券仅限于'+day+'天以内活动使用。',
                                            }
                                        );
                                    } else if (day == 1 && money >= 200) {
                                        popLayer(
                                            {
                                                title: '温馨提示',
                                                btnsName: '返回',
                                                btnsCallback: 'closePopLayer()',
                                                content: '十分抱歉！该卡券仅限于活动基础费用为200元内的活动使用。',
                                            }
                                        );
                                    } else if (day == 2 && money >= 300) {
                                        popLayer(
                                            {
                                                title: '温馨提示',
                                                btnsName: '返回',
                                                btnsCallback: 'closePopLayer()',
                                                content: '十分抱歉！该卡券仅限于活动基础费用为300元内的活动使用。',
                                            }
                                        );
                                    } else {
                                        reduce_cost = money;
                                    }
                                }
                                if (reduce_cost > 0) {
                                    $('#cardselect').html('<span> '+card.title+' -'+reduce_cost+'元 </span> <img class="go" style="margin-top: -3px;" src="/phone/public/images/wechat/in.png">');
                                    //判断是否存在卡券，存在则加上卡券价格再减去重新选择的卡券价格
                                    var allJoinMoney = $("#all-join-money").html();
                                    curCardMoney = reduce_cost;
                                    encript_code = urlEncode(cardListObj[0].encrypt_code);
                                    card_id = cardListObj[0].card_id;
                                    countActivityMoney(); //统计总价
                                }
                            } else {
                                alert('拉取卡券信息失败，请重试');
                            }
                        }
                    });
                } else {
                    alert("亲，只能使用一张卡券哦");
                }
            },
            fail: function (res) {
                cancelCard();
            },
            cancel: function(res) {
                cancelCard();
            }
        });
    }
    function cancelCard() {
        $('#cardselect').html('<img class="go" style="margin-top: -3px;" src="/phone/public/images/wechat/in.png">');
        curCardMoney = 0;
        encript_code = card_id = '';
        countActivityMoney();
    }
    function showServiceTypes( obj ){
        var isshow = $(obj).attr("is-show");
        if( isshow == 0 ){
            $(obj).next().slideDown();
            $(obj).attr('is-show', '1');
            $(obj).find("img").addClass('transform-img');
        }else{
            $(obj).next().slideUp();
            $(obj).attr('is-show', '0');
            $(obj).find("img").removeClass('transform-img');
        }
    }
    $(function() {
        var productSwiper = $('#productSwiperBox').swiper({
            slidesPerView: 4,
            pagination: '.swiper-pagination',
        });
    });
</script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
</script>
</html>