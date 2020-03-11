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
    <div class="made_con">
        <input type="hidden" name="id" value="{$info['id']}">
        <ul>
            <li>
                <strong class="bt">路线名称</strong>
                <span>{$info['line_name']}</span>
            </li>
            <li>
                <strong class="bt">活动天数</strong>
                <span>{$info['line_day']}</span>
            </li>
            <li>
                <strong class="bt">发布时间</strong>
                {$info['release_time']}
            </li>
            <li>
                <strong class="bt">踩点时间</strong>
                <span>{$info['lnspection_time']}</span>
            </li>
            <li>
                <dl>
                    <dt>请对全新路线的成本进行估算</dt>
                    <dd>
                        <span>{$info['cost_report']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <strong class="bt">跟团/自主踩点时间</strong>
                <span>{$info['team_lnspection_time']}</span>
            </li>
            <li>
                <dl>
                    <dt>跟团报名费/自主踩点支出明细</dt>
                    <dd>
                        <span>{$info['registery_fee_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>请简单介绍一下目的地</dt>
                    <dd>
                        <span>{$info['destination_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>徒步长度，登山高度</dt>
                    <dd>
                        <span>{$info['attraction_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>几星难度</dt>
                    <dd>
                        <span>{$info['difficult_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>徒步或登山或游玩时长多长</dt>
                    <dd>
                        <span>{$info['pay_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>景色或行程有无季节性，具体如何</dt>
                    <dd>
                        <span>{$info['seasonal_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>行程中较好的方面，景色亮点或者住宿，吃饭或其他体验好的亮点</dt>
                    <dd>
                        <span>{$info['highlight']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>对我们发布这条路线有何建议</dt>
                    <dd>
                        <span>{$info['suggest']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>详细行程安排</dt>
                    <dd>
                        <span>{$info['schedule']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>出行方式</dt>
                    <dd>
                        <span>{$info['travel_mode']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>有无住宿，怎么安排露营还是住什么</dt>
                    <dd>
                        <span>{$info['accommodation_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>有无餐饮，路餐还是围餐，AA还是包含</dt>
                    <dd>
                        <span>{$info['food_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>是否需要门票，如何</dt>
                    <dd>
                        <span>{$info['ticket_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>有无需要特殊提醒的装备</dt>
                    <dd>
                        <span>{$info['equipment_desc']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>若有其他说明，请输入</dt>
                    <dd>
                        <span>{$info['remarks']}</span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>审核状态</dt>
                    <dd>
                        <span><?php echo Model_Line_Apply::getStateName($info['status']) ?></span>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt>审核说明</dt>
                    <dd>
                        <span>{$info['review_instructions']}</span>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>

</section>
{request 'pub/code'}

<script>

</script>
</body>
</html>
