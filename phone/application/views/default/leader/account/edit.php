<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>会员中心</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    {Common::css('style-new.css,swiper.min.css,certification.css')}
    {Common::js('lib-flexible.js')}
    <script type="text/javascript" src="/phone/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/swiper.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/phone/public/js/jquery.layer.js"></script>
    <script type="text/javascript" src="/phone/public/js/template.js"></script>
    <script type="text/javascript" src="/phone/public/js/layer/layer.m.js"></script>

    <script type="text/javascript" src="/phone/public/js/jquery.validate.addcheck.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/phone/public/js/webuploader/webuploader.css">
    <!--引入JS-->
    <script type="text/javascript" src="/phone/public/js/webuploader/webuploader.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/phone/public/mui/css/mui.picker.css" />
    <link type="text/css" rel="stylesheet" href="/phone/public/mui/css/mui.poppicker.css" />
    <script src="/phone/public/mui/js/mui.min.js"></script>
    <script src="/phone/public/mui/js/mui.picker.js"></script>
    <script src="/phone/public/mui/js/mui.poppicker.js"></script>
    <script src="/phone/public/mui/js/city.data-3.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var SITEURL = "{$cmsurl}";
        window.callback_page = function(pageInto, pageOut, response) {

            var contain_id = $(pageInto).attr('id');
            var url = $(pageInto).attr('data-url');
            $("#"+contain_id).load(url);
        };
        window.is_login = function(object){
            var login_status = parseInt($('#islogin').val());
            if(!login_status){
                window.location.href = "{$cmsurl}member/login"
                return true;
            }else{
                return false;
            }


        }
        $('.back-center').click(function(){
            window.location.href = SITEURL;
        })
        window.do_reload = function(){
            console.log($('#linkman-list').find('li').length);
        }
    </script>
</head>
<body>
<div class="header_top bar-nav">
    <h1 class="page-title-bar">资料编辑</h1>
</div>
<!-- 公用顶部 -->
<div>
    <form id="accountfrm" method="post">
    <div class="user-item-list">
        <ul class="list-group">
            <li class="hd-pic-box">
                <a href="javascript:;">
                    <strong class="avatar-name fl">头像</strong>
                    <span class="hd-pic-block">
                        <img src="{$info['litpic']}" />
                        <input type="hidden" value="{$info['litpic']}" name="litpic">
                    </span>
                    <span class="arrow-icon fr">
                    </span>
                </a>
            </li>
            <li class="hd-pic-box">
                <a href="javascript:;">
                    <strong class="avatar-name fl">背景</strong>
                    <span class="hd-bg-pic-block">
                        <img width="55px" height="55px" src="{$info['bg_pic']}" />
                        <input type="hidden" value="{$info['bg_pic']}" name="bg_pic">
                    </span>
                    <span class="arrow-icon fr">
                    </span>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">昵称</strong>
                    <input type="text" class="data-text fr" value="{$info['nickname']}" name="nickname" id="nickname"  placeholder="请填写昵称" />
                </a>
            </li>
        </ul>
    </div>
    <div class="user-item-list">
        <ul class="list-group">
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">真实姓名</strong>
                    <input type="text" {if $info['verifystatus']==2}disabled="disabled"{/if} class="data-text fr" name="truename" id="truename" value="{$info['truename']}" placeholder="请填写真实姓名" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">性别</strong>
                    <span class="sex-choose fr">
                                <em class="men {if $info['sex']=='男'}on{/if}" data-value="男"><i class="ico"></i>男</em>
                                <em class="women {if $info['sex']=='女'}on{/if}" data-value="女"><i class="ico"></i>女</em>
                    </span>
                </a>
            </li>

            <li>
                <a href="javascript:;">
                    <strong class="hd-name">出生年月</strong>
                    <input type="text" {if $info['verifystatus']==2}disabled="disabled"{/if} class="data-text fr" id="birth_date"  name="birth_date" value="{$info['birth_date']}" placeholder="1970/01/01" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">籍贯</strong>
                    <input type="text" class="data-text fr" id="addrssPlace" value="{$info['native_place']}" name="native_place" placeholder="请填写证件所在籍贯" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">身份证号码</strong>
                    <input size="50" type="text" {if $info['verifystatus']==2}disabled="disabled"{/if} class="data-text fr" name="cardid" id="cardid" value="{$info['cardid']}" placeholder="请填写身份证号" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">常住地址</strong>
                    <input size="50" type="text" class="data-text fr" name="address" id="address" value="{$info['address']}" placeholder="请填写真实地址" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">手机号码</strong>
                    <input size="50" type="text" class="data-text fr" name="mobile" id="mobile" value="{$info['mobile']}" placeholder="请填写常用手机号" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">紧急联系人</strong>
                    <input size="50" type="text" class="data-text fr" name="emergency_contact" id="emergency_contact" value="{$info['emergency_contact']}" placeholder="请填写家人或者好友" />
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <strong class="hd-name">紧急联系人手机号</strong>
                    <input size="50" type="text" class="data-text fr" name="emergency_contact_phone" id="emergency_contact_phone" value="{$info['emergency_contact_phone']}" placeholder="请填写家人或者好友的手机号码" />
                </a>
            </li>

        </ul>
    </div>

        <div class="user-item-list">
            <ul class="list-group">
                <li>
                    <a href="javascript:;">
                        <strong class="hd-name">QQ</strong>
                        <input size="50" type="text" class="data-text fr" name="qq" value="{$info['qq']}" placeholder="请填写常用QQ" />
                    </a>
                </li>
                <li style="display: none">
                    <a href="javascript:;">
                        <strong class="hd-name">微信号</strong>
                        <input type="text" class="data-text fr" name="wechat" value="{$info['wechat']}" placeholder="请填写微信" />
                    </a>
                </li>
                <li style="display: none">
                    <a href="javascript:;">
                        <strong class="hd-name">星座</strong>
                        <input type="text" {if $info['verifystatus']==2}disabled="disabled"{/if} class="data-text fr" id="showUserPicker" name="constellation" value="{$info['constellation']}" placeholder="请填写星座" />
                    </a>
                </li>
                <li class="specha-box" style="display: none">
                    <a href="javascript:;">
                        <strong class="hd-name">个性签名</strong>
                        <textarea class="specha-area fr" name="signature"  placeholder="个性签名">{$info['signature']}</textarea>
                    </a>
                </li>
            </ul>
        </div>
        <input type="hidden" name="token" value="{$token}"/>
        <input type="hidden" name="sex" id="sex" value="{$info['sex']}">
        <input type="hidden" name="memberid" id="memberid" value="{$info['mid']}">
    </form>
    <div class="bottom-fix-bar">
        <a class="save-fix-btn fix-btn account-save" href="javascript:;">保存</a>
    </div>
    <div style="display: none" id="addfile"></div>
    <div style="display: none" id="addbgpic"></div>
    <script>
        //获取字符长度
        function get_str_length(str){
            var realLength = 0, len = str.length, charCode = -1;
            for (var i = 0; i < len; i++) {
                charCode = str.charCodeAt(i);
                if (charCode >= 0 && charCode <= 128) realLength += 1;
                else realLength += 2;
            }
            return realLength;
        }
        $(function(){
            //选择性别
            $('.sex-choose em').click(function(){
                var verifystatus = '{$info['verifystatus']}';
                if(verifystatus==2)
                {
                    return false;
                }
                $(this).addClass('on').siblings().removeClass('on');
                $('#sex').val($(this).attr('data-value'));
            })

            $(".check-label-item").on("click",function(){
                var $this = $(this);
                if( !$this.hasClass("checked") ){
                    $this.addClass("checked").parents("li").siblings().find(".check-label-item").removeClass("checked")
                }
            });
                //多级联选择
            (function($, doc) {
                $.init();

                $.ready(function() {
                    //出生年月
                    var userPicker = new $.PopPicker();
                    userPicker.setData(["白羊座","金牛座","双子座","巨蟹座","狮子座","处女座","天平座","天蝎做","射手座","摩羯座","水瓶座","双鱼座"]);
                    var showUserPickerButton = doc.getElementById('showUserPicker');
                    showUserPickerButton.addEventListener('tap', function(event) {
                        userPicker.show(function(items) {
                            var str = JSON.stringify(items[0]);
                            str = str.replace(/\"/g, "");
                            showUserPickerButton.value = str;
                        });
                    }, false);

                    //星座
                    var userPicker = new $.PopPicker();
                    userPicker.setData(["白羊座","金牛座","双子座","巨蟹座","狮子座","处女座","天平座","天蝎做","射手座","摩羯座","水瓶座","双鱼座"]);
                    var showUserPickerButton = doc.getElementById('showUserPicker');
                    showUserPickerButton.addEventListener('tap', function(event) {
                        userPicker.show(function(items) {
                            var str = JSON.stringify(items[0]);
                            str = str.replace(/\"/g, "");
                            showUserPickerButton.value = str;
                        });
                    }, false);

                    //籍贯
                    var cityPicker2 = new $.PopPicker({
                        layer: 3
                    });
                    cityPicker2.setData(cityData3);
                    var showAddrssPlace = doc.getElementById('addrssPlace');
                    showAddrssPlace.addEventListener('tap', function(event) {
                        cityPicker2.show(function(items) {
                            showAddrssPlace.value = (items[0] || {}).text + " " + (items[1] || {}).text + " " + (items[2] || {}).text;
                        });
                    }, false);

                });
            })(mui, document);

            $('.account-save').click(function(){
                    var memberid = $('#memberid').val();
                    var frmdata = $("#accountfrm").serialize();
                    var nickname = $('#nickname').val();
                    var truename = $('#truename').val();
                    if(nickname == ''){

                        $.layer({
                            type:2,
                            text:'昵称不能为空',
                            time:1000
                        })
                        return false;
                    }

                    if(get_str_length(nickname)>16){

                        $.layer({
                            type:2,
                            text:'昵称太长了',
                            time:500
                        })
                        return false;
                    }

                if(get_str_length(truename)>16){

                    $.layer({
                        type:2,
                        text:'真实姓名最多8个字符',
                        time:500
                    })
                    return false;
                }
                var mobile = $("#mobile").val(); //获取手机号
                var reg = /^((1[3-8][0-9])+\d{8})$/;

                var emergency_contact_phone = $("#emergency_contact_phone").val(); //获取手机号
                if(mobile && !reg.test(mobile)){
                    $.layer({
                        type:2,
                        text:'手机格式不正确',
                        time:500
                    })
                    return false;
                }
                if(emergency_contact_phone && !reg.test(emergency_contact_phone)){
                    $.layer({
                        type:2,
                        text:'紧急联系人手机号格式不正确',
                        time:500
                    })
                    return false;
                }
                if (mobile && emergency_contact_phone && emergency_contact_phone==mobile){
                    $.layer({
                        type:2,
                        text:'紧急联系人手机号和本人手机不能一致',
                        time:500
                    })
                    return false;
                }

                $.ajax({
                    type:'POST',
                    url:SITEURL+'/member/account/ajax_account_save',
                    data:frmdata,
                    dataType:'json',
                    success:function(data){
                        if(data.status){

                            $.layer({
                                type:1,
                                icon:1,
                                text:'保存成功',
                                time:1000
                            });
                            setTimeout(function(){
                                history.go(-1);
                            },1000)

                        }else{
                            $.layer({
                                type:1,
                                icon:2,
                                text:'保存失败',
                                time:1000
                            })
                        }
                    }

                })


            })
        })
    </script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,

            // 文件接收服务端。
            server: SITEURL+'/member/comment/uploadfile',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#addfile',

            fileVal: 'Filedata',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        uploader.on('uploadProgress',function(){
            $.layer({
                type:4
            })
        })
        uploader.on('uploadComplete',function(){
            $.layer.close();
        })

        uploader.on( 'uploadSuccess', function( file,response ) {
            if(response.success=='true') {
                var html = '<img src="'+response.litpic+'" /> <input type="hidden" value="'+response.litpic+'" name="litpic">';
                $('.hd-pic-block').html(html);
            }else{
                alert(response.msg);
            }

        });
        //上传图片
        $('.hd-pic-block').click(function(){
            $('#addfile input[type="file"]').trigger('click');
        })

        //显示图片
        $('body').delegate('.show-pic','click',function(){
            var pic = [];
            var html = '';
            var total = 0;
            $("input[name^='pic']").each(function(i,obj){
                var imgid = $(obj).attr('data-id');
                html+='<div class="swiper-slide" data-imgid="'+imgid+'"><img src="'+$(obj).val()+'"  /></div>';
                total++;
            })
            $('#temp_image_list').html(html);
            $('#total_image_num').html(total);

            $('.original-show-page').show();

        })

        // 初始化Web Uploader
        var uploaderbgpic = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,

            // 文件接收服务端。
            server: SITEURL+'/member/account/uploadfile',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#addbgpic',
            fileVal: 'bg_pic',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        uploaderbgpic.on('uploadProgress',function(){
            $.layer({
                type:4
            })
        })
        uploaderbgpic.on('uploadComplete',function(){
            $.layer.close();
        })

        uploaderbgpic.on( 'uploadSuccess', function( file,response ) {
            if(response.success=='true') {
                var html = '<img src="'+response.litpic+'" /> <input type="hidden" value="'+response.litpic+'" name="bg_pic">';
                $('.hd-bg-pic-block').html(html);
            }else{
                alert(response.msg);
            }

        });
        //上传图片
        $('.hd-bg-pic-block').click(function(){
            console.log(123123);
            $('#addbgpic input[type="file"]').trigger('click');
        })

        var mySwiper = new Swiper ('.swiper-container',{
            loop: true,
            onSlideChangeEnd: function(swiper){

                $('#current_image_index').html(parseInt(swiper.activeIndex)+1);
            }
        });

        //关闭图库浏览
        $('.goback').click(function(){
            $('.original-show-page').hide();
        })

        //删除图片
        $('.delete-icon').click(function(){
            if(confirm('确定删除图片?')){
                if($('.swiper-slide-active').length>0){
                    var imgid = $('.swiper-slide-active').attr('data-imgid');
                    $('.swiper-slide-active').remove();
                }else{
                    var imgid = $('.swiper-slide').first().attr('data-imgid');
                    $('.swiper-slide').first().remove();
                }
                $('#img_'+imgid).remove();
            }


        })
    </script>
</div>

<input type="hidden" id="islogin" value="{$islogin}"/>
<input type="hidden" id="memberid" value="{$member['mid']}"/>

</body>

</html>