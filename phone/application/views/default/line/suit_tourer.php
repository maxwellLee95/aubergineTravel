<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$GLOBALS['cfg_webname']}</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}" />
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}" />
    {/if}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    {php echo Common::css('wechat/bootstrap.min.css,font-awesome/css/font-awesome.min.css,wechat/style.css,wechat/global.min.css,wechat/icon.css');}

    <script>
        var _hmt = _hmt || [];
    </script>

</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<div class="topBar" style="display: none">
    <a class="back" href="javascript:history.go(-1);">
        <img src="/phone/public/images/wechat/back.png">
    </a>
    <a class="home" href="#">
        <img src="/phone/public/images/wechat/home.png">
    </a>
    <p class="text-overflow" >已参加的人</p>
</div>
<div id="default-modal" class="modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                        <span class="closeBtn">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </span>
                <span class="modal-title" id="default-modal-title"></span>
            </div>
            <div class="modal-body" id="default-modal-body" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="default-cancel">取消</button>
                <button type="button" class="btn btn-primary" id="default-check" >确定</button>
            </div>
        </div>
    </div>
</div>
{php echo Common::css('wechat/event.css');}

<style type="text/css">
    .event-title {
        padding: 10px 5px 5px ;
        border-bottom: 1px solid #e8e8e8;
    }
    .member-title {
        padding: 5px 5px 0;
    }
    .event-member {
        padding-bottom: 10px;
    }
</style>
<div class="content">
    <div id="event-join" class="event-intro-box">
        <div class="event-title grey">
            活动领队
        </div>
        <div id="event-member" style="height:auto;">
            <div>
                <ul>
                    {loop $info['leaders'] $row}
                    <li>
                        <div class="li-box">
                            <div class="leader-logo">
                                <a onclick="_hmt.push(['_trackEvent', 'activity', 'click', '详情页参加用户头像']);" href="#">
                                    <div class="img-circle logo-box" >
                                        <img src="{Common::member_pic($row['litpic'])}" class="img-circle images-event-info-img"  />
                                    </div>
                                    <div class="leader-tag">
                                        <img src="/phone/public/images/wx/v4/list/leader_star_{$row['star']}.png" class="leader-level">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="lead-name" style="color: red;" >
                            {$row['nickname']}</div>
                    </li>
                    {/loop}
                </ul>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div id="event-join" class="event-intro-box">
        <div class="event-title grey">
            已报名        </div>
        <div id="event-member" class="event-member" style="height:auto;">
            <div>
                <ul>
                    {if !empty($info['suit_tourer'])}
                    {loop $info['suit_tourer'] $row}
                    <li>
                        <div class="li-box">
                            <div class="leader-logo">
                                <a onclick="_hmt.push(['_trackEvent', 'activity', 'click', '详情页参加用户头像']);" href="#">
                                    <div class="img-circle logo-box" >
                                        <img src="<?php echo $row['litpic'] ? $row['litpic'] : Common::member_nopic() ?>" class="img-circle images-event-info-img"  />
                                        {if $row['dingnum']>1}
                                        <div class="logo-num">
                                            {$row['dingnum']}人
                                        </div>
                                        {/if}
                                    </div>
                                    <span style="position: absolute;right: 0px;top: 0;width: 16px;" class="icon_css {if $row['sex']=='男'}icon_man{/if}{if $row['sex']=='女'}icon_woman{/if}"></span>
                                </a>
                            </div>
                        </div>
                        <div class="lead-name"  >{$row['nickname']}</div>
                    </li>
                    {/loop}
                    {/if}
                </ul>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>


</div>

</body>
{php echo Common::js('public/plugins/jQuery/jQuery-2.1.3.min.js',false,false);}
{php echo Common::js('bootstrap.min.js');}
<script type="text/javascript">
    function adapt(e){
        var divWidth = $(e).parent().width(); //div宽度
        var divHeight = $(e).parent().height(); //div高度

        var img = new Image();
        img.src =$(e).attr("src");
        var imgWidth = img.width; //图片实际宽度
        var imgHeight = img.height;

        var d = 0;
        if ( (imgWidth < imgHeight) || (imgWidth > divWidth) ) {
            d = 0;
            var style = "width: 100%; height: auto;";
        } else {
            d = 1;
            var style = "height: 100%; width: auto;";
        }

        /* if ( imgWidth > divWidth ) {
            var l = parseInt(imgWidth-divWidth)/8;
            if (d) {
                style += "left: -50%; margin-left: " + l + "px;";
            }
        }

        if ( imgHeight > divHeight ) {
            var t = parseInt(imgHeight-divHeight)/8;
            if (d == 0) {
                style += "top: -50%; margin-top: -" + t + "px;";
            }
        } */

        $(e).attr("style", style);
    }
</script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
</script>
</html>