<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$seoinfo['seotitle']}-{$GLOBALS['cfg_webname']}</title>
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
            font-size: 12px;
            color: #ccc;
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
    <h3 style="text-align: center"><span class="title">—发布全新活动路线—</span></h3>
    <div class="step">
        <ul>
            <li><i></i>第一步，在本页面提交发布意向</li>
            <li><i></i>第二步，管理员审核过后会联系您</li>
            <li><i></i>第三步，沟通提交更详细的行程图片和图片资料</li>
            <li><i></i>第四步，沟通提交更详细的形成和图片资料</li>
            <li><i></i>第五步，编辑完成，上线发布</li>
        </ul>
    </div>
    <div>
        <form id="st_form" method="post"  enctype="application/x-www-form-urlencoded">
            <div class="made_con">
                <input type="hidden" name="id" value="{$info['id']}">
                <ul>
                    <li>
                        <strong class="bt">路线名称</strong>
                        <input type="text" class="mdd" name="line_name" value="{$info['line_name']}" id="line_name" placeholder="必填"/>
                    </li>
                    <li>
                        <strong class="bt">活动天数</strong>
                        <input type="text" class="mdd" name="line_day" value="{$info['line_day']}" id="line_day" placeholder="必填"/>
                    </li>
                    <li>
                        <strong class="bt">发布时间</strong>
                        <input type="text" class="mdd" name="release_time" value="<?php echo $info['release_time']?$info['release_time']:date('Y-m-d') ?>" data-am-datepicker readonly required id="release_time" placeholder="必填"/>
                    </li>
                    <li>
                        <strong class="bt">踩点时间</strong>
                        <input type="text" class="mdd" name="lnspection_time" value="<?php echo $info['lnspection_time']?$info['lnspection_time']:date('Y-m-d') ?>" data-am-datepicker readonly required id="lnspection_time" placeholder="必填"/>
                    </li>
                    <li>
                        <dl>
                            <dt>请对全新路线的成本进行估算</dt>
                            <dd>
                                <textarea name="cost_report" id="cost_report" cols="" rows="" placeholder="必填">{$info['cost_report']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <strong class="bt">跟团/自主踩点时间</strong>
                        <input type="text" class="mdd" value="<?php echo $info['team_lnspection_time']?$info['team_lnspection_time']:date('Y-m-d') ?>" name="team_lnspection_time" data-am-datepicker readonly required id="team_lnspection_time" placeholder=""/>
                    </li>
                    <li>
                        <dl>
                            <dt>跟团报名费/自主踩点支出明细</dt>
                            <dd>
                                <textarea name="registery_fee_desc" id="registery_fee_desc" cols="" rows="" placeholder="">{$info['registery_fee_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>请简单介绍一下目的地</dt>
                            <dd>
                                <textarea name="destination_desc" id="destination_desc" cols="" rows="" placeholder="">{$info['destination_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>徒步长度，登山高度</dt>
                            <dd>
                                <textarea name="attraction_desc" id="attraction_desc" cols="" rows="" placeholder="">{$info['attraction_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>几星难度</dt>
                            <dd>
                                <textarea name="difficult_desc" id="difficult_desc" cols="" rows="" placeholder="">{$info['difficult_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>徒步或登山或游玩时长多长</dt>
                            <dd>
                                <textarea name="pay_desc" id="pay_desc" cols="" rows="" placeholder="">{$info['pay_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>景色或行程有无季节性，具体如何</dt>
                            <dd>
                                <textarea name="seasonal_desc" id="seasonal_desc" cols="" rows="" placeholder="">{$info['seasonal_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>行程中较好的方面，景色亮点或者住宿，吃饭或其他体验好的亮点</dt>
                            <dd>
                                <textarea name="highlight" id="highlight" cols="" rows="" placeholder="">{$info['highlight']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>对我们发布这条路线有何建议</dt>
                            <dd>
                                <textarea name="suggest" id="suggest" cols="" rows="" placeholder="">{$info['suggest']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>详细行程安排</dt>
                            <dd>
                                <textarea name="schedule" id="schedule" cols="" rows="" placeholder="">{$info['schedule']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>出行方式</dt>
                            <dd>
                                <textarea name="travel_mode" id="travel_mode" cols="" rows="" placeholder="">{$info['travel_mode']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>有无住宿，怎么安排露营还是住什么</dt>
                            <dd>
                                <textarea name="accommodation_desc" id="accommodation_desc" cols="" rows="" placeholder="">{$info['accommodation_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>有无餐饮，路餐还是围餐，AA还是包含</dt>
                            <dd>
                                <textarea name="food_desc" id="food_desc" cols="" rows="" placeholder="">{$info['food_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>是否需要门票，如何</dt>
                            <dd>
                                <textarea name="ticket_desc" id="ticket_desc" cols="" rows="" placeholder="">{$info['ticket_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>有无需要特殊提醒的装备</dt>
                            <dd>
                                <textarea name="equipment_desc" id="equipment_desc" cols="" rows="" placeholder="">{$info['equipment_desc']}</textarea>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>若有其他说明，请输入</dt>
                            <dd>
                                <textarea name="remarks" id="remarks" cols="" rows="" placeholder="">{$info['remarks']}</textarea>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!--第二步-->
            <div class="error_txt"></div>
            <div class="sr_btn" style="width: 250px;margin: 0 auto">
                <input style="border-top-left-radius: 20px;border-bottom-left-radius: 20px;background: #ccc;float: left;" type="submit" class="btn_save" value="保存"/>
                <input  style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;background: #9B8CE5;float: left;" type="submit" class="btn_submit" value="提交"/>
                <div style="clear: none"></div>
            </div>
            <div style="clear: none"></div>
        </form>

    </div>

</section>
{request 'pub/code'}

<script>
    $(function(){
        //保存
        $("body").delegate(".btn_save", 'click', function () {
            var url='/phone/member/lineapply/ajax_save?type=1';
            s_submit(url);
        });
        //提交
        $("body").delegate(".btn_submit", 'click', function () {
            var url='/phone/member/lineapply/ajax_save';
            s_submit(url);
        });

        function s_submit(url){
            //验证
            $('#st_form').validate({
                rules: {
                    line_name: 'required',
                    release_time: {
                        required: true,
                    },
                    lnspection_time: {
                        required: true,
                    },
                    line_day: {
                        required: true,
                        min: 1
                    },
                    cost_report: 'required'
                },
                messages: {
                    line_name: '线路不能为空',
                    release_time: {
                        required: '踩点时间',
                    },
                    lnspection_time: {
                        required: '踩点时间',
                    },
                    line_day: {
                        required: '活动天数不能为空',
                        min: '活动天数至少1天'
                    },
                    cost_report: '成本报告不能为空',
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
