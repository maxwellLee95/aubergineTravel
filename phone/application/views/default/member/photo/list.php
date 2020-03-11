<!DOCTYPE html>
<html>
<head>
    <title>茄子旅游</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">

    <style>
        .no-content {
            text-align: center;
            padding: 10px;
            color: #c4c4c4;
            padding-top: 10%;
        }
        .modal-header{
            border-bottom: none;
        }
        .modal-footer{
            border-top: none;
        }
    </style>

    <script type="text/javascript">
        var _hmt = _hmt || [];
    </script>

</head>
<body >
<div id="loading">
    <div class="loading-bg"></div>
    <div class="loading"></div>
</div>
<div id="getLoading">
    <div class="get-loading-main">
        <img src="/phone/public/images/wechat/loading2.gif" width="20" height="20">
        <div class="getloading"></div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=11">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/activity_album.css?v=18">

<div class="topBar">
    <a class="tip__btn">
        <div class="text-center" style="padding: 1px 10px;">
            <img src="/phone/public/images/wechat/v4/question.png" style="height:25px; width:auto;">
        </div>
    </a>
    <p class="text-overflow menu" style="padding: 0;" >
    <ul class="menu__ul">
        <li class="menu__li menu__li--active">
            <a href="#">活动共享相册</a>
        </li>
        <li style="display: none" class="menu__li">
            <a href="#">个人相册</a>
        </li>
    </ul>
    </p>
</div>
<div class="content">
    <!-- <div class="clearfix"></div> -->
    <!-- <div class="tip text-right"><a class="tip__btn">使用说明 <i class="fa fa-angle-right" style="font-size:18px;"></i></a></div> -->
    <div class="clearfix"></div>
    <div class="albumbox">
        {loop $photo $row}
        <div class="albumbox__imgbox" id="albumbox__{$row['id']}">
            <a href="{$row['url']}" title="{$row['title']}-活动相册">
                <div class="albumbox__imgframe">
                    <div class="albumbox__img" style="background-image: url({$row['litpic']});"></div>
                </div>
                <div class="albumbox__activityMsg">
                    <div class="albumbox__imgnum" style="display: none">{count($row['imgs'])}张</div>
                    <div class="albumbox__activityName">{$row['title']}</div>
                    <div class="albumbox__activityTime">{$row['date']}</div>
                </div>
            </a>
        </div>
        {/loop}
    </div>
    <div class="clearfix"></div>
    {if empty($photo)}
    <div class="no-content">
        <div>
            <img src="/phone/public/images/wx/v4/list/me-norrecorder.png" width="32%">
        </div>
        <div>
            暂没有更多了
        </div>
    </div>
    {/if}
</div>

<div id="activityAlbumTipModal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="modal-title">相册使用说明</div>
            </div>
            <div class="modal-body">
                <p>茄子旅游活动共享相册是一个方便各位队友分享活动照片的功能，使用前请同意以下规定：</p>
                <p>1、未经拍摄人同意，请勿上传非本人所拍摄照片；</p>
                <p>2、未经他人同意，请勿上传涉及他人隐私的照片；</p>
                <p>3、请勿上传涉及色情、政治、或与当次活动无关的图片；</p>
                <p>4、不符合上述规定或有损他人合法权利或违反法律法规的，茄子旅游有权对其进行删除；</p>
                <p style="color:red;">5、上传照片即同意茄子旅游对照片有使用权。茄子旅游会选择其中优秀照片设为精品，设为精品的照片将在该路线详情页中展示</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">我知道了</button>
            </div>
        </div>
    </div>
</div>



</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/tool.js"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js" ></script>
<script type="text/javascript">


    $('.tip__btn').click(function(){
        $('#activityAlbumTipModal').modal();
    });
    $('.getMoveAlbumbtn').click(function(){
        var page = $(this).data('page');
        $(this).hide();
        $('.moveLoading').show();
        var self = $(this);
        $.ajax({
            url: 'getMoveActivityAlbum',
            type: 'POST',
            dataType: 'json',
            data: {
                'wxoid': '',
                'page': page,
            },
        })
            .done(function(retData) {
                if (retData.errcode == 0) {
                    var data = retData.errmsg;
                    $('.moveLoading').hide();
                    if (data.nowLimit < data.count) {
                        self.data('nowlimit', data.nowLimit);
                        self.data('page', parseInt(data.page) + 1);
                        self.show();
                    } else {
                        $('.noMove').show();
                    }
                    var activitys = data.activitys;
                    var h = '';
                    var activity = {};
                    for (var i = activitys.length - 1; i >= 0; i--) {
                        activity = activitys[i];
                        h += '<div class="albumbox__imgbox" id="albumbox__' + activity['activityId'] + '">';
                        h += '    <a href="' + activity['url'] + '" title="' + ( ( activity['sub_title'] == '' || activity['sub_title'] == null ) ? activity['name']:activity['sub_title'] ) + '活动相册">';
                        h += '        <div class="albumbox__imgframe">';
                        h += '            <div class="albumbox__img" style="background-image: url(' + ( ( activity['smallImageUrl'] == '' || activity['smallImageUrl'] == null ) ? activity['imageUrl']:activity['smallImageUrl'] ) + ');"></div>';
                        h += '        </div>';
                        h += '        <div class="albumbox__activityMsg">';
                        h += '            <div class="albumbox__imgnum">' + activity['imgNum'] + '张</div>';
                        h += '            <div class="albumbox__activityName">' + ( ( activity['sub_title'] == '' || activity['sub_title'] == null ) ? activity['name']:activity['sub_title'] ) + '</div>';
                        h += '            <div class="albumbox__activityTime">' + activity['startTimeStr'] + '</div>';
                        h += '        </div>';
                        h += '    </a>';
                        h += '</div>';
                    };
                    $('.albumbox').append(h);
                } else {
                    popLayer({
                        title: '获取失败！',
                        btnsName: '确定',
                        btnsCallback: 'closePopLayer()',
                        content: '<p>' + retData.errmsg + '</p>',
                    });
                    self.show();
                    $('.moveLoading').hide();
                }
            })
            .fail(function() {
                popLayer({
                    title: '请求失败！',
                    btnsName: '确定',
                    btnsCallback: 'closePopLayer()',
                    content: '<p>抱歉！服务器请求失败，请稍候重试！</p>',
                });
                self.show();
                $('.moveLoading').hide();
            });
    });
</script>


</html>