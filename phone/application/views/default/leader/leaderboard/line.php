<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>龙虎榜-月榜</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    {Common::css('leaderboard/common.css,leaderboard/line.css')}
    {Common::js('jquery.min.js')}
</head>
<body>
<section class="aui-flexView">
    <section class="aui-scrollView">
        <?php echo View::factory('default/leader/leaderboard/header') ?>
        <div class="aui-tab" data-ydui-tab>
            <?php echo View::factory('default/leader/leaderboard/header_nav',array('active'=>1)) ?>
            <div class="tab-panel">
                <div class="tab-panel-item tab-active">
                    {loop $list $item}
                    <div class="tab-con ">
                        <a href="javascript:;">
                            <div class="aui-flex-box">
                                <h3>{$item['productname']}</h3>
                                <div class="aui-flex-tag">
                                    <span>路线评分:{if $item['score']}$item['score']{else}暂无{/if}</span>
                                    <span>成行次数:{$item['line_total']}</span>
                                    <span>累计人数:{$item['people_total']}</span>
                                </div>
                                <div class="aui-flex-tags">
                                </div>

                            </div>
                        </a>
                        {if $item['leaders']}
                        <div class="join-hikers" style="height: 85px;overflow: hidden;">
                            {loop $item['leaders'] $leader}
                            <div class="join-hiker">
                                <a href="javascript::void(0)">
                                    <div class="hiker-img">
                                        <div style="position:relative; display:inline-block;">
                                            <div style="position:relative; display:inline-block; overflow:hidden; border-radius:50%;">
                                                <img class="img-circle" src="{$leader['litpic']}" style="width:45px; height:45px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hiker-name" style="font-size: 14px;">{$leader['nickname']}</div>
                                </a>
                            </div>
                            {/loop}
                            <div class="clear"></div>
                        </div>
                        {/if}
                    </div>
                    {/loop}
                </div>
                <div class="tab-panel-item">

                </div>
                <div class="tab-panel-item">

                </div>
            </div>
        </div>

    </section>
</section>

</body>
</html>
