<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>赏金提现</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}"/>
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}"/>
    {/if}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::css('amazeui.css,style.css,../js/layer/need/layer.css')}
    {Common::css('../js/mobiscroll/css/mobiscroll.frame.css,../js/mobiscroll/css/mobiscroll.frame.android.css')}
    {Common::css('../js/mobiscroll/css/mobiscroll.scroller.css,../js/mobiscroll/css/mobiscroll.scroller.android.css')}
    {Common::js('jquery.min.js,amazeui.js,template.js,layer/layer.m.js,common.js,jquery.validate.min.js')}
    {Common::js('mobiscroll/js/mobiscroll.core.js,mobiscroll/js/mobiscroll.frame.js,mobiscroll/js/mobiscroll.scroller.js')}
    {Common::js('mobiscroll/js/mobiscroll.util.datetime.js,mobiscroll/js/mobiscroll.datetimebase.js,mobiscroll/js/mobiscroll.datetime.js')}
    {Common::js('mobiscroll/js/mobiscroll.frame.android.js,mobiscroll/js/i18n/mobiscroll.i18n.zh.js')}
    <style>
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
        .sr_submit {
            padding: 0 8rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="from-content">
    <!--顶部图片-->
    <form id="st_form" method="post" action="/phone/leader/bounty/ajax_edit" enctype="application/x-www-form-urlencoded">
        <div class="customMade_con">
            <h3 class="made_tit"><span>提现申请</span></h3>
            <div class="made_con">
                <ul>
                    <li>
                        <strong class="bt">可提现金额</strong>
                        <input type="text" readonly class="mdd" value="￥<?php echo $leader['bounty']?$leader['bounty']:0?>" placeholder="可提现金额"/>
                    </li>
                    <li>
                        <strong class="bt">提现金额</strong>
                        <input type="text" class="mdd" name="amount" id="amount" placeholder="请输入提现金额，不可高于总金额"/>
                    </li>
                </ul>
            </div>
        </div>
        <div class="error_txt"></div>
        <div class="sr_submit"><input type="submit" class="btn_save" value="提现"/></div>
    </form>

</div>
{request 'pub/code'}

<script>
    $(function(){
        function goto(){
            location.href = SITEURL;
        }
        //提交
        $("body").delegate(".btn_save", 'click', function () {
            //验证
            $('#st_form').validate({
                rules: {
                    amount: {
                        required: true,
                        min: 10
                    }
                },
                messages: {
                    amount: {
                        required: '金额必填',
                        min: '金额必需大于10元'
                    }
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
                    var params = $("#st_form").serialize();
                    $.post('/phone/leader/bounty/ajax_edit',params, function (data) {
                        if (data.status == 1) {
                            layer.open({
                                content: data.message,
                                time: 2,
                                end:function(){
                                    location.href = '/phone/leader/bounty/list';
                                }
                            });
                        }else{
                            layer.open({
                                content: data.message,
                                time: 2
                            });
                        }
                    }, 'json')
                }
            });
        });

    })
</script>
</body>
</html>
