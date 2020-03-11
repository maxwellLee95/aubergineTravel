<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>线路排行榜</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    {Common::css('leaderboard/common.css,leaderboard/bounty.css')}
    {Common::js('jquery.min.js')}
</head>
<body>
<section class="aui-flexView">
    <section class="aui-scrollView">
        <?php echo View :: factory('default/leader/leaderboard/header') ?>
        <div class="aui-tab" data-ydui-tab>
            <?php echo View::factory('default/leader/leaderboard/header_nav',array('active'=>2)) ?>
            <div class="tab-panel">
                <div class="tab-panel-item tab-active">
                    {loop $list $key $item}
                    <a href="javascript:;" class="aui-flex">
                        <div class="aui-flex-img">
                            <img src="{$item['leader']['litpic']}" alt="">
                            <span class="aui-top-ran">{$key+1}</span>
                        </div>
                        <div class="aui-flex-box">
                            <h3>{$item['leader']['nickname']}</h3>
                            <div class="aui-flex-tag">
                            </div>
                            <div class="aui-flex-tags">
                                <span>{$item['total']}元</span>
                            </div>
                        </div>
                    </a>
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
