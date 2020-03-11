<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>打赏</title>
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
        .sr_submit {
            padding: 0 8rem;
            margin-bottom: 10px;
        }
        .user-avatar {
            bottom: 100px;
            padding: 5px;
            text-align: center;
            width: 100%;
        }
        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 1px solid transparent;
        }
        .photo{
            width: 60px;
            height: 70px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

<div class="from-content">
    <!--顶部图片-->
    <form id="st_form" method="post" action="/phone/member/bounty/ajax_edit" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="leaderid" value="{$leader['id']}">
        <div class="customMade_con">
            <h3 style="text-align: center;color: #9b8ce5;"><span>给您喜欢的领队打赏</span></h3>
            <div class="user-avatar">
                <div class="photo">
                    <img  src="{$leader['litpic']}" alt="头像" class="avatar">
                    <span>{$leader['nickname']}</span>
                </div>
            </div>
            <div class="made_con">
                <ul>
                    <li>
                        <input style="text-align: center;" type="text" value="1" class="mdd" name="amount" id="amount" placeholder="请输入打赏金额"/>
                    </li>
                </ul>
            </div>
        </div>
        <div class="error_txt"></div>
        <div class="sr_submit"><input type="submit" class="btn_save" value="打赏"/></div>
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
                        min: 1
                    }
                },
                messages: {
                    amount: {
                        required: '金额必填',
                        min: '金额必需大于1元（包括）'
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
                    $.post('/phone/member/bounty/ajax_edit',params, function (data) {
                        if (data.status == 1) {
                            location.href=data.redirecturl;
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
