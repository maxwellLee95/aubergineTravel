<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>点评-{$GLOBALS['cfg_webname']}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {php echo Common::css('amazeui.css,style.css,extend.css');}
    {php echo Common::js('jquery.min.js,amazeui.js,jquery.validate.min.js');}
    <script>
        $(function () {
            $('#my-st-slide').offCanvas('close');
        })
    </script>
    <style>
        .am-comment-avatar {
            width: 45px;
            height: 45px;
        }
    </style>
</head>

<body>

<header>
    <div class="header_top">
        <h1 class="tit">活动评论</h1>
    </div>
</header>
<section>

    <div class="mid_content">

        <div class="confirm_order_msg">
            <dl>
                <dt><img src="{Common::img($order['litpic'],150,90)}"/></dt>
                <dd>
                    <span>{$order['productname']}</span>
                    <strong><i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$order['price']}</b>起</strong>
                </dd>
            </dl>
            <div class="dp_cp_show">

                <form action="{$cmsurl}member/comment/save?id={$order['id']}" method="post" id="form">
                    <input type="hidden" name="activity_score" id="activity_score" value="1">
                    <input type="hidden" name="ordersn" value="{$order['ordersn']}">
                    <input type="hidden" name="articleid" value="{$order['productautoid']}">
                    <input type="hidden" name="typeid" value="{$order['typeid']}">
                    <div class="am-form-group">
                        <em class="tit">整体满意度：</em>
                        <span class="p_rate" id="activity_rate">
                            <i title="1星" style="width: 32px; z-index: 5;" class="select">
                            </i><i title="2星"></i><i title="3星"></i><i title="4星"></i><i title="5星"></i>
                        </span>
                        <strong class="snum" id="activity_num">1星</strong>
                        <textarea name="activity_content" cols="" rows="" placeholder="请输入评价，必填"></textarea>
                    </div>
                    {if $leaders}
                    {loop $leaders $key $leader}
                    <div class="am-form-group">
                        <input type="hidden" name="leader_id_{$key}" value="{$leader['id']}">
                        <input type="hidden" name="leader_score_{$key}" id="leader_score_{$key}" value="1">
                        <div>
                            <div style="position: relative;">
                                <img class="am-comment-avatar" src="{$leader['litpic']}">
                                <span style="position: absolute;top: 22px;left: 0;font-size: 12px;text-align: center;width: 45px;" class="tit">{$leader['nickname']}</span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div style="padding-left: 60px">
                            <div>
                                <span class="p_rate" id="leader_rate_{$key}">
                                    <i title="1星" style="width: 32px; z-index: 5;" class="select">
                                    </i><i title="2星"></i><i title="3星"></i><i title="4星"></i><i title="5星"></i>
                                </span>
                                <strong class="snum" id="leader_num_{$key}">1星</strong>
                            </div>
                        </div>
                        <textarea name="leader_content_{$key}" cols="" rows="" placeholder="请输入评价，必填"></textarea>
                    </div>
                    {/loop}
                    {/if}
                </form>
            </div>
            <div class="pl-btn">
                <a id="submit" class="cursor">确认</a>
            </div>
        </div>

    </div>

</section>
<script type="text/javascript">
    $(document).ready(function () {
        var pRate = function (box, s,input) {
            this.Index = null;
            var B = $(box),
                rate = B.children("i"),
                w = rate.width(),
                n = rate.length,
                me = this;
            for (var i = 0; i < n; i++) {
                rate.eq(i).css({
                    'width': w * (i + 1),
                    'z-index': n - i
                });
            }
            rate.hover(function () {
                var S = B.children("i.select");
                $(this).addClass("hover").siblings().removeClass("hover");
                if ($(this).index() > S.index()) {
                    S.addClass("hover");
                }
            }, function () {
                rate.removeClass("hover");
            })
            rate.click(function () {
                rate.removeClass("select hover");
                $(this).addClass("select");
                me.Index = $(this).index() + 1;
                $(s).html(me.Index + '星');
                $(input).val(me.Index);
            })
        };
        var activityRate = new pRate("#activity_rate","#activity_num","#activity_score");
        var RateList=new Array();
        for(var i=0;i<5;i++){
            RateList[i] = new pRate("#leader_rate_"+i,'#leader_num_'+i,'#leader_score_'+i);
        }

        $('#submit').click(function () {
            $('#form').submit();
        });
        $('#form').validate({
            rules:{
                content:{
                    required:true,
                    minlength:15
                }
            },
            messages:{
                content:{
                    required:'* 评论内容不得低于15个字！',
                    minlength:'* 评论内容不得低于15个字！'
                }
            }
        });
    })
</script>
</body>
</html>
