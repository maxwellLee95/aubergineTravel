<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seoinfo['seotitle'];?>-<?php echo $GLOBALS['cfg_webname'];?></title>
    <?php if($seoinfo['keyword']) { ?>
    <meta name="keywords" content="<?php echo $seoinfo['keyword'];?>"/>
    <?php } ?>
    <?php if($seoinfo['description']) { ?>
    <meta name="description" content="<?php echo $seoinfo['description'];?>"/>
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php echo Common::css('amazeui.css,style.css,../js/layer/need/layer.css');?>
    <?php echo Common::css('../js/mobiscroll/css/mobiscroll.frame.css,../js/mobiscroll/css/mobiscroll.frame.android.css');?>
    <?php echo Common::css('../js/mobiscroll/css/mobiscroll.scroller.css,../js/mobiscroll/css/mobiscroll.scroller.android.css');?>
    <?php echo Common::js('jquery.min.js,amazeui.js,template.js,layer/layer.m.js,common.js,jquery.validate.min.js');?>
    <?php echo Common::js('mobiscroll/js/mobiscroll.core.js,mobiscroll/js/mobiscroll.frame.js,mobiscroll/js/mobiscroll.scroller.js');?>
    <?php echo Common::js('mobiscroll/js/mobiscroll.util.datetime.js,mobiscroll/js/mobiscroll.datetimebase.js,mobiscroll/js/mobiscroll.datetime.js');?>
    <?php echo Common::js('mobiscroll/js/mobiscroll.frame.android.js,mobiscroll/js/i18n/mobiscroll.i18n.zh.js');?>
    <style>
        .apply-from{
            padding: 30px;
            background: #9aacff;
        }
        .from-content{
            max-width: 640px;
            margin: 50px auto 0 auto;
            /* padding: 5px; */
            color: #c2c2cc;
            background: #ffffff;
            border-radius: 10px;
        }
        .from-content:after{
            content:'.';
            clear:both;
            display:block;
            height:0;
            visibility:hidden
        }
        .made_con ul li strong {
            color: #c2c2cc;
            display: inline-block;
            width: 80px;
            font-size: 1.5rem;
            font-weight: normal;
        }
        .sr_submit input {
            display: block;
            width: 100%;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            font-size: 1.8rem;
            border: 0;
            background: #9B8CE5;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }
        .customMade_con {
            margin-bottom: 10px;
            box-shadow: 0 1px 3px #e5e5e5;
            background: #fff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .step ul{
            text-decoration: none;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .step ul li{
            float: left;
            font-size: 12px;
            color: #FFFFFF;
            padding-left: 8px;
        }
        .step i {
            color: #fff;
            display: inline-block;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            border-radius: 50%;
            background: #ccd2ff
        }
        .list-title{
            color: #9B8CE5;
            margin: 0;
            padding: 1rem 0;
            font-weight: 500;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .activity-name {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            font-size: 16px;
            height: 34px;
            line-height: 34px;
            padding: 0 10px;
            background: -webkit-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.9));
            background: -o-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.9));
            background: -moz-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.9));
            background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.9));
        }
        .activity-name span{
            color: #FFFFFF;
        }
        .line{
            padding-bottom: 10px;
        }
        .line-img{
            position: relative;
        }
        .line-name,.line-desc{
            padding: 1px 20px;
        }
        .line-desc{
            font-size: 12px;
            color: #999;
            max-height: 40px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<section class="apply-from">
    <div class="step">
        <ul>
            <li style="padding-left: 0px"><i>1</i>填写信息</li>
            <li><i>2</i>设计行程</li>
            <li><i>3</i>签约付款</li>
            <li><i>4</i>快乐出游</li>
        </ul>
    </div>
    <div class="from-content">
        <!--顶部图片-->
        <form id="st_form" method="post" action="/phone/customize/ajax_do_add" enctype="application/x-www-form-urlencoded">
            <div class="customMade_con">
                <h3 class="made_tit"><span>团队定制</span></h3>
                <div class="made_con">
                    <ul>
                        <li>
                            <input type="text" class="mdd" name="startplace" id="startplace" placeholder="出发地点"/>
                            <input type="text" class="mdd" name="dest" id="dest" placeholder="目的地"/>
                        </li>
                        <li>
                            <input data-am-datepicker readonly required type="text" class="date" name="starttime" id="starttime" placeholder="游玩时间"/>
                            <span class="before">
                                <a class="sub" href="javascript:;">-</a>
                                <input type="text" name="days" id="days" readonly="readonly" value="1"/>
                                <a class="add" href="javascript:;">+</a>
                                <em>天</em>
                            </span>
                        </li>
                        <li>
                            <strong class="bt">成人数</strong>
                            <span class="before">
                                <a class="sub" href="javascript:;">-</a>
                                <input type="text" name="adultnum" id="adultnum" readonly="readonly" value="1"/>
                                <a class="add" href="javascript:;">+</a>
                                <em>人</em>
                            </span>
                        </li>
                        <li style="display: none">
                            <strong class="bt">儿童数</strong>
                            <span class="before">
                                <a class="sub" href="javascript:;">-</a>
                                <input type="text" name="childnum" id="childnum" readonly="readonly" value="0"/>
                                <a class="add" href="javascript:;">+</a>
                                <em>人</em>
                            </span>
                        </li>
                        <li style="display: none">
                            <dl>
                                <dt>交通方式</dt>
                                <dd class="planerank">
                                    <input type="hidden" name="planerank" id="planerank" value="飞机">
                                    <a class="on" href="javascript:;"><span>飞机</span></a>
                                    <a href="javascript:;"><span>火车</span></a>
                                    <a href="javascript:;"><span>自驾</span></a>
                                    <a href="javascript:;"><span>游轮</span></a>
                                </dd>
                            </dl>
                        </li>
                        <li style="display: none">
                            <dl>
                                <dt>酒店星级</dt>
                                <dd class="hotelrank">
                                    <input type="hidden" name="hotelrank" id="hotelrank" value="三星级">
                                    <a class="on" href="javascript:;"><span>三星级</span></a>
                                    <a href="javascript:;"><span>四星级</span></a>
                                    <a href="javascript:;"><span>五星级</span></a>
                                    <a href="javascript:;"><span>五星级以上</span></a>
                                    <a href="javascript:;"><span>快捷经济型</span></a>
                                    <a href="javascript:;"><span>其它</span></a>
                                </dd>
                            </dl>
                        </li>
                        <li style="display: none">
                            <dl>
                                <dt>需要房型</dt>
                                <dd class="room">
                                    <input type="hidden" name="room" id="room" value="单人">
                                    <a class="on" href="javascript:;"><span>单人</span></a>
                                    <a href="javascript:;"><span>双人大床房</span></a>
                                    <a href="javascript:;"><span>双人分床房</span></a>
                                    <a href="javascript:;"><span>套间</span></a>
                                    <a href="javascript:;"><span>海景房</span></a>
                                    <a href="javascript:;"><span>其它</span></a>
                                </dd>
                            </dl>
                        </li>
                        <li style="display: none">
                            <dl>
                                <dt>用餐形式</dt>
                                <dd class="food">
                                    <input type="hidden" name="food" id="food" value="自理">
                                    <a class="on" href="javascript:;"><span>自理</span></a>
                                    <a href="javascript:;"><span>部分自理</span></a>
                                    <a href="javascript:;"><span>全包用餐</span></a>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <input type="text" class="mdd" name="contactname" id="contactname" placeholder="您的称呼"/>
                        </li>
                        <li style="display: none">
                            <strong class="bt">性别</strong>
                            <span class="sex">
                                <input type="hidden" name="sex" id="sex" value="先生">
                                <a class="on" href="javascript:;">先生</a>
                                <a href="javascript:;">女士</a>
                            </span>
                        </li>
                        <li style="display: none">
                            <strong class="bt">所在地点</strong>
                            <input type="text" class="mdd" name="address" id="address" placeholder="必填,方便客服与您联系"/>
                        </li>
                        <li>
                            <input type="text" class="mdd" name="phone" id="phone" placeholder="手机号码"/>
                        </li>
                        <li>
                            <input type="text" class="mdd" name="email" id="email" placeholder="电子邮箱"/>
                        </li>
                        <li style="display: none">
                            <dl>
                                <dt>合适的联系时间</dt>
                                <dd class="contacttime">
                                    <input type="hidden" name="contacttime" id="contacttime" value="9:00-12:00">
                                    <a class="on" href="javascript:;"><span>9:00-12:00</span></a>
                                    <a href="javascript:;"><span>14:00-18:00</span></a>
                                    <a href="javascript:;"><span>19:00-22:00</span></a>
                                </dd>
                            </dl>
                        </li>
                        <li style="display: none">
                            <dl>
                                <dt>其他要求</dt>
                                <dd>
                                    <textarea name="content" id="content" cols="" rows="" placeholder="您还有其他的要求吗？"></textarea>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <input type="text" class="mdd" name="code" id="code" placeholder="验证码"/><img
                                    class="captcha yzm_pic cursor" src="" height="30"/>
                        </li>
                    </ul>
                </div>
            </div>
            <!--第二步-->
            <div class="error_txt"></div>
            <div class="sr_submit"><input type="submit" class="btn_save" value="提交订制"/></div>
        </form>
    </div>
</section>
<section>
    <div class="list-title" >成功案例</div>
    <div class="list">
        <?php $n=1; if(is_array($list)) { foreach($list as $row) { ?>
        <div class="line">
            <div class="line-img relative">
                <a href="<?php echo $row['custom_promotion_link'];?>">
                    <img class="lazy-img-loading" src="http://www.168hike.com/uploads/2018/1029/e82868b4d646bb659e50d1cfdce3f62f.jpg" style="width:100%;">
                    <div class="activity-name"><span style="float: left;"><?php echo $row['startcity'];?></span><span style="float: right">￥<?php echo $row['storeprice'];?></span></div>
                </a>
            </div>
            <div class="line-name flex-center">
                <div class="flex-center"><?php echo $row['title'];?></div>
            </div>
            <div class="line-desc">
                <div class="flex-center">
                    <?php echo $row['reserved2'];?>
                </div>
            </div>
        </div>
        <?php $n++;}unset($n); } ?>
    </div>
</section>
<?php echo Request::factory('pub/code')->execute()->body(); ?>
<script>
    $(function(){
        function goto(){
            location.href = SITEURL;
        }
        //时间选择器
        var stdate = new Date();
        // $('#starttime').mobiscroll().date({
        //     theme: 'android',
        //     mode: 'scroller',
        //     display: 'modal',
        //     lang: 'zh',
        //     dateFormat: 'yy-mm-dd',
        //     minDate: new Date(stdate.getFullYear(), stdate.getMonth(), stdate.getDate())
        // });
        //验证码切换
        $('.captcha').attr('src', ST.captcha(SITEURL+'captcha'));
        $('.captcha').click(function () {
            $(this).attr('src', ST.captcha($(this).attr('src')));
        });
        $(".sub").click(function () {
            var obj = $(this).parent().children('input');
            if (parseInt($(obj).val()) > 0) {
                $(obj).val(parseInt($(obj).val()) - 1);
            }
        });
        $(".add").click(function () {
            var obj = $(this).parent().children('input');
            $(obj).val(parseInt($(obj).val()) + 1);
        });
        //交通方式
        $("body").delegate(".planerank a", 'click', function () {
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            $("#planerank").val($(this).children('span').html());
        });
        //酒店星级
        $("body").delegate(".hotelrank a", 'click', function () {
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            $("#hotelrank").val($(this).children('span').html());
        });
        //需要房型
        $("body").delegate(".room a", 'click', function () {
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            $("#room").val($(this).children('span').html());
        });
        //用餐形式
        $("body").delegate(".food a", 'click', function () {
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            $("#food").val($(this).children('span').html());
        });
        //性别
        $("body").delegate(".sex a", 'click', function () {
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            $("#sex").val($(this).html());
        });
        //合适的联系时间
        $("body").delegate(".contacttime a", 'click', function () {
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            $("#contacttime").val($(this).children('span').html());
        });
        //提交定制
        $("body").delegate(".btn_save", 'click', function () {
            //验证
            $('#st_form').validate({
                rules: {
                    dest: 'required',
                    startplace: 'required',
                    starttime: {
                        required: true,
                        dateISO: true
                    },
                    days: {
                        required: true,
                        min: 1
                    },
                    adultnum: {
                        required: true,
                        min: 1
                    },
                    childnum: {
                        required: true,
                        min: 0
                    },
                    planerank: 'required',
                    hotelrank: 'required',
                    room: 'required',
                    food: 'required',
                    contactname: 'required',
                    sex: 'required',
                    // address: 'required',
                    phone: {
                        required: true,
                        mobile: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contacttime: 'required',
                    code: 'required'
                },
                messages: {
                    dest: '<?php echo __("error_customize_dest_not_empty");?>',
                    startplace: '<?php echo __("error_customize_startplace_not_empty");?>',
                    starttime: {
                        required: '<?php echo __("error_customize_starttime_not_empty");?>',
                        dateISO: '<?php echo __("error_date");?>'
                    },
                    days: {
                        required: '<?php echo __("error_customize_days_digit");?>',
                        min: '<?php echo __("error_customize_days_digit");?>'
                    },
                    adultnum:{
                        required: '<?php echo __("error_adultnum_digit");?>',
                        min: '<?php echo __("error_adultnum_digit");?>'
                    },
                    childnum:{
                        required: '<?php echo __("error_childnum_digit");?>',
                        min: '<?php echo __("error_childnum_digit");?>'
                    },
                    planerank: '<?php echo __("error_customize_planerank_not_empty");?>',
                    hotelrank: '<?php echo __("error_customize_hotelrank_not_empty");?>',
                    room: '<?php echo __("error_customize_room_not_empty");?>',
                    food: '<?php echo __("error_customize_food_not_empty");?>',
                    contactname: '<?php echo __("error_customize_contactname_not_empty");?>',
                    sex: '<?php echo __("error_customize_sex_not_empty");?>',
                    address: '<?php echo __("error_customize_address_not_empty");?>',
                    phone: {
                        required: '<?php echo __("error_user_phone");?>',
                        mobile: '<?php echo __("error_user_phone");?>'
                    },
                    email:  {
                        required: '<?php echo __("error_user_email");?>',
                        email: '<?php echo __("error_user_email");?>'
                    },
                    contacttime: '<?php echo __("error_customize_contacttime_not_empty");?>',
                    code: '<?php echo __("error_code");?>'
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    var content = $('#st_form').find('.error_txt:eq(0)').html();
                    console.log(element)
                    if (content == '') {
                        $('#st_form').find('.error_txt:eq(0)').html('<i></i>');
                        error.appendTo($('#st_form').find('.error_txt:eq(0)'));
                    }
                },
                showErrors: function (errorMap, errorList) {
                    if (errorList.length < 1) {
                        $('#st_form').find('.error_txt:eq(0)').html('');
                    } else {
                        this.defaultShowErrors();
                    }
                }, submitHandler: function (form) {
                    //表单提交句柄,为一回调函数，带一个参数：form
                    $.post('/phone/customize/ajax_check_code', {
                        'code': $.trim($("#code").val())
                    }, function (data) {
                        if(data ==  true){
                            var params = $("#st_form").serialize();
                            $.post('/phone/customize/ajax_do_add',params, function (data) {
                                if (data.status == 1) {
                                    layer.open({
                                        content: '<?php echo __("success_customize_add_insert");?>',
                                        time: 2,
                                        end:function(){
                                            goto();
                                        }
                                    });
                                }else{
                                    layer.open({
                                        content: data.message,
                                        time: 2
                                    });
                                }
                            }, 'json')
                        }else{
                            layer.open({
                                content: '<?php echo __("error_code");?>',
                                time: 2
                            });
                        }
                    }, 'json');
                }
            });
        });
    })
</script>
</body>
</html>
