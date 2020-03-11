<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>领队考试</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::css('amazeui.css,exam.css,../js/layer/need/layer.css')}
    {Common::css('../js/mobiscroll/css/mobiscroll.frame.css,../js/mobiscroll/css/mobiscroll.frame.android.css')}
    {Common::css('../js/mobiscroll/css/mobiscroll.scroller.css,../js/mobiscroll/css/mobiscroll.scroller.android.css')}
    {Common::js('jquery.min.js,amazeui.js,template.js,layer/layer.m.js,common.js,jquery.validate.min.js')}
    {Common::js('mobiscroll/js/mobiscroll.core.js,mobiscroll/js/mobiscroll.frame.js,mobiscroll/js/mobiscroll.scroller.js')}
    {Common::js('mobiscroll/js/mobiscroll.util.datetime.js,mobiscroll/js/mobiscroll.datetimebase.js,mobiscroll/js/mobiscroll.datetime.js')}
    {Common::js('mobiscroll/js/mobiscroll.frame.android.js,mobiscroll/js/i18n/mobiscroll.i18n.zh.js,jquery.countdown.js')}

</head>

<body>

{request "pub/header/typeid/$typeid"}


<section>

    <div class="mid_content">
        <form id="st_form" method="post" action="{$cmsurl}leader/exam/submit" enctype="application/x-www-form-urlencoded">
            <div class="customMade_con">
                <h3 class="made_tit">剩余答题时间:<b class="alt-1">{$exam['end_time']}</b></h3>
                <input type="hidden" name="id" value="{$exam['id']}">
                <div class="made_con">
                    <ul>
                        {loop $questions $i $row}
                        <li>
                            <dl>
                                <dt>Q{$i+1} {$row['question']}</dt>
                                <input type="hidden" name="questions[]" value="{$row['id']}">
                                <dd class="planerank">
                                    {if $row['option']}
                                        {loop  $row['option'] $k $v}
                                        <div class="am-radio">

                                            <label>
                                                <input type="radio" name="answers[{$row['id']}][]" value="{$k}" >
                                                {$v}
                                            </label>
                                        </div>
                                        {/loop}
                                    {/if}
                                </dd>
                            </dl>
                        </li>
                        {/loop}
                    </ul>
                </div>
            </div>
            <!--第二步-->
            <div class="error_txt"></div>

            <div class="sr_submit"><input type="submit" class="btn_save" value="提交"/></div>
        </form>

    </div>

</section>

{request 'pub/code'}

<script>
    $(function(){

        $('time').countDown({
            with_separators: false
        });
        $('.alt-1').countDown({
        });
        $('time').on('time.elapsed', function () {
            layer.open({
                content: '答题时间已到，系统将自动提交',
                time: 3,
                end:function(){
                    $("#st_form").submit();
                }
            });
        });
    })
</script>
</body>
</html>
