<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>总结</title>
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
        .apply-from{
            padding: 20px;
        }
        .made_con ul li strong {
            color: #666;
            display: inline-block;
            width: 80px;
            font-size: 1.5rem;
            font-weight: normal;
        }
        .sr_btn input {
            display: inline-block;
            width: 50%;
            padding: 1rem 0;
            text-align: center;
            font-size: 1.8rem;
            border: 0;
            -moz-border-radius: 20px;
        }

        .step ul{
            text-decoration: none;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .step ul li{
            font-size: 14px;
            /* color: #ccc; */
            line-height: 25px;
        }
        .step i {
            color: #fff;
            display: inline-block;
            width: 7px;
            height: 7px;
            text-align: center;
            border-radius: 50%;
            background: #e5e5e5;
            margin-right: 30px;
        }
        .title{
            color: #9B8CE5;
            font-size: 18px;
            font-weight: 500;
        }
        .made_con ul li dl dd textarea {
            padding: 5px;
            display: block;
            width: 100%;
            min-height: 100px;
            border: 0;
            margin-top: 0.5rem;
            font-size: 1.4rem;
            background: #ffffff;
        }
    </style>
</head>

<body>

<section class="apply-from">
    <div class="step">
        <ul>
            <li>活动：{$line['title']}</li>
            <li>时间：{date('Y-m-d',$suit['day'])}</li>
        </ul>
    </div>
    <div>
        <form id="st_form" method="post" enctype="application/x-www-form-urlencoded">
            <div class="made_con">
                <input type="hidden" name="id" value="{$info['id']}">
                {if !$info['id']}
                <input type="hidden" name="lineid" value="{$line['id']}">
                <input type="hidden" name="suit_id" value="{$suit['suitid']}">
                <input type="hidden" name="day" value="{$suit['day']}">
                {/if}
                <ul>
                    <li>
                        <strong class="bt">标题</strong>
                        <input type="text" class="mdd" name="title" value="{$info['title']}" id="title" placeholder="必填"/>
                    </li>
                    <li>
                        <dl>
                            <dt>内容</dt>
                            <dd>
                                <textarea  name="content" id="content" cols="" rows="18" placeholder="必填">{$info['content']}</textarea>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!--第二步-->
            <div class="error_txt"></div>
            <div class="sr_btn" style="width: 100%;text-align: center;">
                <input  style="border-radius:20px;background: #9B8CE5;" type="submit" class="btn_submit" value="提交"/>
                <div style="clear: none"></div>
            </div>
            <div style="clear: none"></div>
        </form>

    </div>

</section>
{request 'pub/code'}

<script>
    $(function(){
        //提交
        $("body").delegate(".btn_submit", 'click', function () {
            var url='/phone/leader/report/ajax_save';
            s_submit(url);
        });

        function s_submit(url){
            //验证
            $('#st_form').validate({
                rules: {
                    title: 'required',
                    content: 'required'
                },
                messages: {
                    title: '标题不能为空',
                    content: '内容不能为空',
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
                    $.post(url,params, function (data) {
                        if (data.status == 1) {
                            layer.open({
                                content: data.msg,
                                time: 2,
                                end:function(){
                                    location.href=data.url;
                                }
                            });
                        }else{
                            layer.open({
                                content: data.msg,
                                time: 2
                            });
                        }
                    }, 'json')
                }
            });
        }

    })
</script>
</body>
</html>
