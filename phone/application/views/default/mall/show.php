<!DOCTYPE html>
<html>
<head>
    <title>商品详情</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=1"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=14"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/v4/flex_box.css?v=6">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/pop-layer.css?v=17">

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

<link rel="stylesheet" type="text/css" href="/phone/public/plugins/swiper3.3.1/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=17">
<link rel="stylesheet" type="text/css" href="/phone/public/css/mall/detail.css?v=13">
<style type="text/css">
    /*慢慢消失的提示弹窗样式*/
    .error-input{
        z-index:1003;
        font-size: 1.37em;
        position: fixed;
        bottom:15%;
        width: 100%;
        opacity:0;
        height: 24px;
        display: none;
        transition: opacity 1s ease-out;
    }
    .notice-div{
        color:#fff;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 2px;
        padding: 5px 10px;
        text-align: center;
        width: 70%;
        margin: 0 auto;
        font-size: 16px;
    }
    /*慢慢消失的提示弹窗样式结束*/
    .home{
        position: absolute;
        right: 10px;
        top: 10px;
        z-index: 100;
    }
    .back{
        position: absolute;
        left: 10px;
        top: 10px;
        z-index: 100;
    }
    .back i{
        font-size: 24px;
        color: #fff;
        background-color: rgba(0,0,0,0.5);
        height: 30px;
        width: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 2px 2px 0;
    }
</style>
<div class="content">

    <div id="small-loading" class="small-loading">
        <img src="/phone/public/images/wechat/loading2.gif" width="20" height="20">
    </div>

    <!-- 头部商品轮播 -->
    <div class="goods-banners swiper-container" id="banners">
        <div class="back"  style="display: none">
            <a href="javascript:history.go(-1);">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
        </div>
        <div class="home" style="display: none">
            <a href="">
                <div class="icon_css icon_home"></div>
            </a>
        </div>
        <div class="swiper-wrapper">
            {loop $info['piclist'] $pic}
            <div class="swiper-slide">
                <img src="{Common::img($pic[0],640,300)}" style="width: 100%;" />
            </div>
            {/loop}
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- 头部商品信息 -->
    <div class="goods-top">
        <div class="goods-info">
            <div class="goods-name">{$info['title']}</div>
            <div class="goods-desc">{$info['title']}</div>
            <div style="padding-top: 10px;">
                <div class="pull-left goods-money" money="68">
                    <i class="fa fa-cny" style="color:rgba(252, 146, 22, 0.9);"></i>
                    <span>{$info['price']}</span>
                </div>
                <div class="pull-right sold-num">已售：<span>{$info['sellnum']}</span>件</div>
                <div class="clear"></div>
            </div>
            <div class="goods-postage">
                邮费：包邮
            </div>
        </div>
    </div>
    <!-- 商品相关选项 -->
    <form id="form" autocomplete="off">
        <div class="goods-form">
            <div class="goods-choice">
                <div  class="goods-choice-name">规格</div>
                <div class="goods-choice-options">
                    {loop $goods_sku $k $row}
                    <div class="goods-choice-option-div">
                        <div optionId="{$row['id']}"  sizeGroupId="{$row['id']}" noInventory="0" class="goods-choice-option " onclick="selectedOption(this,{$row['id']},{$row['id']});">
                            {$row['name']}
                            <input type="radio" name="option[{$row['id']}]" groupId="{$row['id']}" value="{$row['id']}" style="display:none;">
                        </div>
                    </div>
                    {/loop}
                    <div class="clear"></div>
                </div>
            </div>
            <div class="goods-choice">
                <div class="goods-choice-name">选择数量</div>
                <div class="goods-choice-input">
                    <div class="pull-left">
                        <button class="goods-num-btn no-operation" type="button" onclick="changeNum( 0 );">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <div class="pull-left">
                        <input class="goods-small-input" type="text" id="payNum" name="payNum" value="1">
                    </div>
                    <div class="pull-left">
                        <button class="goods-num-btn " type="button" onclick="changeNum( 1 );">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="pull-left goods-inventory">
                        (库存：<span id="goodsInventory"><span class="red">请选择规格</span> </span>件)
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="good-content">
            <div id="event-tab" style="height:auto;" >
                <div class="tab-title show-tab-title flex-div justify-around">
                    <span class="border-right tab-t isThisTab" tabType="0">
                        <button type="button" class="btnA">商品详情</button>
                        <div class="unline-show"></div>
                    </span>
                    <span class="border-right tab-t" tabType="1">
                        <button type="button" class="btnA">售后政策</button>
                        <div class="unline-show hide-line"></div>
                    </span>
                </div>
                <!-- 滑到下面定位在顶部的菜单 -->
                <div style="display: none" class="tab-title fixed-tab-title flex-div justify-around">
                    <span class="border-right tab-t isThisTab" tabType="0">
                        <button type="button" class="btnA">商品详情</button>
                    </span>
                    <span class="border-right tab-t" tabType="1">
                        <button type="button" class="btnA">售后政策</button>
                    </span>
                </div>
                <!-- 滑到下面定位在顶部的菜单结束 -->
                <div class="tab-content active">
                    {$info['content']}
                </div>
                <div class="tab-content">
                    {$info['notice']}
                </div>
            </div>
        </div>
        <!-- 底部按钮 -->
        <div class="bottom-btns">
            <div class="move-add">+1</div>
            <div class="bottom-btn" style="width:20%;">
                <a href="/phone/mall/cart" id="showCarNum">
                    <img src="/phone/public/images/mall/shopping_cart.png">
                    {if $cartNum}
                    <div class="cart-num" id="cartNum">{$cartNum}</div>
                    {/if}
                </a>
            </div>
            <div class="bottom-btn" style="width:40%; background-color: #7db1eb; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                <a onclick="addShoppingCart();">加入购物车</a>
            </div>
            <div class="bottom-btn" style="width:40%; background-color: #9B8CE5;border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                <a onclick="buyNow();">立即购买</a>
            </div>
        </div>
    </form>
    <form id="hiddenForm" method="post" action="/phone/mall/confirm_order">
    </form>

    <!-- 输入提示和错误隐藏框 -->
    <div id="error-input-div" class="error-input" style="display: none; opacity: 0;"></div>

</div>

</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/bootstrap.min.js?v=2"></script>
<script type="text/javascript">
    function tabbarBack() {
        wx.closeWindow();
    }
    var openId = "";
</script>
<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js"></script>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/timeInterval.js" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=17" ></script>
<!-- 提示信息弹窗，慢慢消失 -->
<script type="text/javascript">
    function $S(s){return document.getElementById(s);}
    function $html(s,html){$S(s).innerHTML=html;}
    var showTime=null;
    var displayTime=null;
    function setToast3(html){
        if(showTime!=null){
            clearTimeout(showTime);
            clearTimeout(displayTime);
        }
        $S('error-input-div').style.display='block';
        $S('error-input-div').style.opacity=1;
        $html('error-input-div',html);
        showTime=setTimeout(function(){
            $S('error-input-div').style.opacity=0;
            displayTime=setTimeout(function(){$S('error-input-div').style.display='none';},1500);
        },1500);
    }
    function showNoticeMsg(type,noticeMsg){
        if(type==1){
            setToast3('<div class="notice-div">'+ noticeMsg +'</div>');
        }
        //通过else if可以添加其他提示信息样式
    }
</script>
<script type="text/javascript">

    // tab的切换控制
    $(document).on('click', '.tab-t', function(event) {
        $(".tab-t").removeClass('isThisTab');
        $(".tab-content").css('display', 'none');
        var thisTab = $(this).attr('tabType');
        $(".tab-t .unline-show").addClass('hide-line');
        $(this).children('.unline-show').removeClass('hide-line');
        // console.log(thisTab);
        $(".show-tab-title .tab-t").eq(thisTab).addClass('isThisTab');
        $(".fixed-tab-title .tab-t").eq(thisTab).addClass('isThisTab');
        $(".tab-content").eq(thisTab).css('display', 'inherit');
        if( $(document).scrollTop() > $("#event-tab").offset().top ){
            $(document).scrollTop( $(".show-tab-title").offset().top );
        }
    });

    //监测滚动条事件
    $(window).bind('scroll touchmove touchend', function () {
        if( $(document).scrollTop() > $("#event-tab").offset().top ){
            $(".fixed-tab-title").css('display', '');
        }else{
            $(".fixed-tab-title").css('display', 'none');
        }
    });

    var goodsInventory = 0; //总的库存，数量加减判断用

    //开始倒计时

    $(document).ready(function () {
        //实现图片慢慢浮现出来的效果
        $(".week-fest img").load(function () {
            //图片默认隐藏
            $(this).hide();
            //使用fadeIn特效
            $(this).fadeIn("5000");
            // $(this).show();
        });
        $(".content img").addClass("scrollLoading");
        // 异步加载图片，实现逐屏加载图片
        $(".scrollLoading").scrollLoading();
    });

    //滑块绑定
    var myswiper = new Swiper('#banners', {
        pagination : '.swiper-pagination',
        paginationClickable: true,
        autoHeight: true, //enable auto height
        autoplay: 6000,
        loop: true,
    });

    //单选控制
    var productSkus = "";
    function selectedOption( obj, sizeId, groupId ){
        $("#small-loading").show();
        //获取已选中的所有规格，不包含当前类型
        var isChoiceOptions = new Array();
        $(".goods-choice-options").each(function(index, el) {
            $(this).find("input[type='radio']").each(function(index, el) {
                if( $(this).is(":checked") && $(this).attr("groupId") != groupId ){
                    isChoiceOptions.push( $(this).val() );
                }
            });
        });
        isChoiceOptions.push( sizeId );
        //ajax请求获取该规格的库存信息
        $.ajax({
            url: '/phone/mall/ajax_productinventory',
            type: 'POST',
            dataType: 'json',
            data: {
                productId: {$info['id']},
                optionIds: isChoiceOptions
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                $("#small-loading").hide();
                if( getdata.errcode == 0 ){

                    //确认当前规格组已被选择
                    $(obj).parent().parent().parent().attr('isChecked', '1');

                    if( getdata.count > 1 ){
                        $(".goods-choice-input .goods-num-btn:last").removeClass("no-operation");
                    }else{
                        $(".goods-choice-input .goods-num-btn:last").addClass("no-operation");
                    }
                    //更新库存
                    $("#goodsInventory").html( getdata.count );
                    goodsInventory = getdata.count;
                    productSkus = getdata.productSkus;
                    //更新价格
                    $(".goods-money").attr('money', getdata.min_price);
                    var addHtml = '<i class="fa fa-cny" style="color:rgba(252, 146, 22, 0.9);"></i><span>' + getdata.min_price + '</span>';
                    if( getdata.min_price != getdata.max_price ){
                        addHtml += '&nbsp;&nbsp;-&nbsp;&nbsp;<i class="fa fa-cny" style="color:rgba(252, 146, 22, 0.9);"></i><span>' + getdata.max_price + '</span>';
                    }
                    $(".goods-money span").html( getdata.min_price );
                    $(".goods-money").html( addHtml );
                    //更新规格选项
                    //当前规格库存为0，则该规格变灰，且无法再操作
                    //除已选择和当前选择规格组的剩余规格若不存在于有库存的规格数组，则也变灰
                    if( getdata.count == 0 ){
                        $(obj).addClass("no-inventory");
                        $(obj).removeAttr("onclick");
                    }
                    $(".goods-choice-option").each(function(index, el) {
                        var optionId = $(this).attr("optionId");
                        var sizeGroupId = $(this).attr("sizeGroupId");
                        if( sizeGroupId != groupId ){
                            if( $(this).parent().parent().parent().attr('isChecked') != 1 ){
                                if( $.inArray(optionId, getdata.haveInventorySizeIds) < 0 ){
                                    $(this).addClass("no-inventory");
                                    $(this).removeAttr("onclick");
                                }else{
                                    $(this).removeClass("no-inventory");
                                    $(this).attr('onclick', 'selectedOption(this,' + optionId + ',' + sizeGroupId + ')');
                                }
                            }else{
                                //已选择的规格组改成可选库存
                                $(this).removeClass("no-inventory");
                                $(this).attr('onclick', 'selectedOption(this,' + optionId + ',' + sizeGroupId + ')');
                            }
                        }
                    });

                    //若当前显示的购买数量为0，且已有库存，则显示1数量
                    var payNum = $("#payNum").val();
                    if( payNum == 0 && getdata.count > 0 ){
                        $("#payNum").val(1);
                    }
                    //若购买数量大于当前剩余最大库存，则购买数量重置为最大库存数
                    if( payNum > goodsInventory ){
                        payNum = goodsInventory;
                        $("#payNum").val( payNum );
                        $(".goods-num-btn:last").addClass("no-operation");
                    }
                    if( getdata.count > 0 ){
                        var parentObj = $(obj).parent().parent();
                        parentObj.find('.choice-selected').remove();
                        parentObj.find('.choice-selected-i').remove();
                        parentObj.find('.goods-choice-option').removeClass("selected");
                        parentObj.find('.goods-choice-option input[type="radio"]').prop('checked', false);
                        var addHtml = '<div class="choice-selected"></div>';
                        addHtml    += '<div class="choice-selected-i"><i class="fa fa-check"></i></div>';
                        $(obj).append( addHtml );
                        $(obj).addClass("selected");
                        $(obj).find('input[type="radio"]').prop("checked","checked");
                    }else{
                        //取消该组的选择
                        $(obj).parent().parent().find('.goods-choice-option').each(function(index, el) {
                            $(this).removeClass('selected');
                            $(this).find('.choice-selected').remove();
                            $(this).find('.choice-selected-i').remove();
                            $(this).find("input[type='radio']").prop("checked",false);
                        });
                    }
                }else{
                    console.log(getdata.errmsg);
                }
            })
            .fail(function() {
                console.log("error");
                $("#small-loading").hide();
            });
    }

    //数量加减
    function changeNum( type ){
        //获取已选中的所有规格
        var isChoiceOptions = new Array();
        $(".goods-choice-options").each(function(index, el) {
            $(this).find("input[type='radio']").each(function(index, el) {
                if( $(this).is(":checked") ){
                    isChoiceOptions.push( $(this).val() );
                }
            });
        });
        //ajax请求获取该规格最新的库存信息
        $("#small-loading").show();
        $.ajax({
            url: '/phone/mall/ajax_productinventory',
            type: 'POST',
            dataType: 'json',
            data: {
                productId: {$info['id']},
                optionIds: isChoiceOptions
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                $("#small-loading").hide();
                if( getdata.errcode == 0 ){
                    //更新库存
                    $("#goodsInventory").html( getdata.count );
                    goodsInventory = parseInt(getdata.count);
                    //若购买数量大于当前剩余最大库存，则购买数量重置为最大库存数
                    var payNum = ($("#payNum").val());
                    if( payNum > goodsInventory ){
                        payNum = goodsInventory;
                        $("#payNum").val( payNum );
                    }
                    if( type == 0 && payNum > 1 ){
                        payNum--;
                    }else if( type == 1 ){
                        payNum++;
                    }
                    if( payNum > goodsInventory ){
                        //若大于最大库存，则无法再增加了
                        return;
                    }else if( payNum == goodsInventory ){
                        $(".goods-num-btn:last").addClass("no-operation");
                    }else{
                        $(".goods-num-btn:last").removeClass("no-operation");
                    }
                    if( payNum > 1 ){
                        $(".goods-num-btn:first").removeClass("no-operation");
                    }else{
                        $(".goods-num-btn:first").addClass("no-operation");
                    }
                    $("#payNum").val( payNum );
                }
            })
            .fail(function() {
                console.log("error");
            });
    }

    function checkChecked(){
        //验证所有单选都有选择
        var haveNoChoice = false;
        var isChoiceOptions = new Array();
        var errorIndex = 0; //错误的规格组
        $(".goods-choice-options").each(function(index, el) {
            var haveChoice = false;
            $(this).find("input[type='radio']").each(function(rindex, el) {
                if( $(this).is(":checked") ){
                    haveChoice = true;
                    isChoiceOptions.push( $(this).val() );
                }
            });
            if( !haveChoice ){
                errorIndex = index;
                haveNoChoice = true;
                return false;
            }
        });
        if( haveNoChoice ){
            showNoticeMsg( 1, "请先选择商品规格！" );
            $(window).scrollTop( $(".goods-choice-options").eq(errorIndex).offset().top );
            return false;
        }
        //数量必须大于0
        var payNum = $("#payNum").val();
        if( payNum <= 0 ){
            showNoticeMsg( 1, "请先选择购买数量！" );
            return false;
        }
        return isChoiceOptions;
    }

    //加入购物车
    function addShoppingCart(){
        var isChoiceOptions = checkChecked();
        if( isChoiceOptions ){
            var payNum = parseInt( $("#payNum").val() );
            $(".move-add").html("+"+payNum);
            $(".move-add").show();
            $(".move-add").animate({"top":"30px","font-size":"0"},"slow",function(){
                //ajax加入购物车
                $.ajax({
                    url: '/phone/mall/ajax_addcart',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        productId: {$info['id']},
                        optionIds: isChoiceOptions,
                        count: payNum,
                    },
                })
                    .done(function(getdata) {
                        // console.log(getdata);
                        if( getdata.status == 1 ){
                            $(".move-add").hide();
                            $(".move-add").css({"top": '-40px',"font-size": '24px',});
                            if( $("#cartNum").html() == undefined ){
                                $("#showCarNum").append('<div class="cart-num" id="cartNum">0</div>');
                            }
                            var cartNum = parseInt( $("#cartNum").html() );
                            cartNum+=payNum;
                            $("#cartNum").html( cartNum );
                        }else{
                            popLayer(
                                {
                                    title: '温馨提示',
                                    btnsName: '确认',
                                    btnsCallback: 'closePopLayer();',
                                    content: '<div class="text-center">'+ getdata.msg +'</div>',
                                }
                            );
                        }
                    })
                    .fail(function() {
                        popLayer(
                            {
                                title: '温馨提示',
                                btnsName: '确认',
                                btnsCallback: 'closePopLayer();',
                                content: '<div class="text-center">请求失败，请稍候再试！</div>',
                            }
                        );
                    });
            });
        }
    }

    //立即购买操作
    function buyNow(){
        var isChoiceOptions = checkChecked();
        if( isChoiceOptions ){
            //创建隐藏表单并提交
            var addHtml = '<input type="hidden" name="wxoid" value="">';
            $.each(productSkus, function(index, val) {
                addHtml += '<input type="checkbox" name="cart['+ productSkus[index]['product_id'] +'][sku_id]" value="'+ productSkus[index]['id'] +'" checked="checked" style="display:none;">';
                addHtml += '<input type="checkbox" name="cart['+ productSkus[index]['product_id'] +'][payNum]" value="'+ $("#payNum").val() +'" checked="checked" style="display:none;">';
            });
            $("#hiddenForm").html( addHtml );
            $("#hiddenForm").submit();
        }
    }

    //购买数量输入检测
    $("#payNum").blur(function(event) {
        changeNum( 3 );
    });

    //默认下发第一页的数据信息
    var productIdData = {$info['id']};
    var nowPage       = 1;
    var allPage;
    // getCommentData( productIdData, nowPage, 1 );
    //获取该商品所有评论的请求
    function getCommentData( pid, page, type ){
        $.ajax({
            url: '/api/mall/Detail/getComments',
            type: 'GET',
            dataType: 'json',
            data: {
                pid: pid,
                p: page,
                //是否后获取所有评论
                t: type,
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                if( getdata.errcode == 0 ){
                    //获取当前的页数和总的页数
                    allPage = getdata.data.total_pages;
                    //动态插入评论的信息
                    var itemData  = getdata.data.items;
                    var itemTable = getdata.data.tabs;
                    var addTab = '';
                    //初始化评论有多少条
                    if( page == 1 && type == 1 ){
                        $('.hiker-info-num').html(getdata.data.allCountComment);
                        //if( getdata.data.allCountComment>99 ){
                        //    $('.hiker-info-num').html("(99+)");
                        //}
                        //初始化评分的星星和满意度
                        var coutCommentInfo = addProductStartHtml( getdata.data );
                        //如果评论数为0，则不现实任何内容
                        $('.comment-content').html(coutCommentInfo);
                        if( getdata.data.items.length == 0 ){
                            $('.comment-content').remove();
                        }
                    }
                    //初始化评论的导航栏目
                    //console.log(itemTable)
                    if( itemTable != undefined ){
                        $.each(itemTable,function(index,item){
                            if( index == 1 ){
                                return;
                            }
                            if( item.active == 1 ){
                                addTab += '<div onclick="onTableComment(this)" class="comment-btn comment-select" data-cout-typt="'+item.type+'">'+item.name+'</div>';
                            }else{
                                if( item.count == 0 ){
                                    addTab += '<div class="comment-btn" style="color:#e5e5e5;">'+item.name+'</div>'
                                }else{
                                    addTab += '<div onclick="onTableComment(this)" class="comment-btn" data-cout-typt="'+item.type+'">'+item.name+'</div>';
                                }
                            }
                        });
                        $('.comment-count').html(addTab);
                    }
                    //初始化评论的内容
                    var commentHtml = addCommentData( itemData );
                    // console.log(commentHtml)
                    $('.hiker-info-all').html(commentHtml);
                    //初始化更多评论的功能
                    //增加查看更多的显示
                    $('.more-than').remove();
                    if( nowPage < allPage ){
                        var strhtml = '<div onclick="getMoreComment();" class="more-than flex-center">查看更多<div class="more-than-div"><img class="more-than-img" src="/phone/public/images/wechat/more-than.png"/></div></div>'
                    }
                    $('.hiker-info-one:last').after(strhtml);
                }else{
                    console.log(222);
                }
            })
            .fail(function() {
                $("#loading").hide();
                console.log("请求失败");
            });
    };

    var priviewImgs = [];
    function addCommentData( data ){
        //console.log(data)
        var addhtml = '';
        $.each(data,function( index, item ){
            addhtml += '<div class="comment-hiker-content">';
            addhtml += '    <div class="comment-hiker-comtainer flex-start">';
            if( item.anonymous == 0 ){
                addhtml += '        <div class="hiker-img" style="background-image:url('+item.hiker.headImgUrl+'");></div>';
                addhtml += '        <div class="hiker-name">'+item.hiker.nickname+'</div>';
            }else{
                addhtml += '        <div class="hiker-img" style="background-image:url("")";></div>';
                addhtml += '        <div class="hiker-name">匿名</div>';
            }
            // addhtml += '        <div class="comment-time-start">';
            // for (var i = 0; i < item.star; i++) {
            //     addhtml += '    <img class="comment-time-start-img" src="/phone/public/images/wechat/comment-start.png">';
            // }
            // for (var j = 0; j < (5-item.star); j++) {
            //     addhtml += '    <img class="comment-time-start-img" src="/phone/public/images/wechat/coment_start_gray.png">';
            // }
            // addhtml += '        </div>';
            addhtml += '    </div>';
            addhtml += '    <div class="comment-time flex-start">';
            addhtml += '        <div class="comment-time-info">'+item.show_time+'</div>';
            addhtml += '            <div class="comment-time-info product-text">';
            $.each(item.sizes_name,function(sizeIndex,sizeItem){
                addhtml += sizeItem;
            });
            addhtml += '    </div>';
            addhtml += '    </div>';
            addhtml += '    <div class="comment-hike-write">'+item.comment+'</div>';
            addhtml += '    <div class="hiker-upload-img-container flex-div">';
            if( item.imgs != undefined ){
                $.each(item.imgs,function(imgIndex,imgIten){
                    priviewImgs.push( imgIten );
                    addhtml += '    <div onclick="priviewImg(this);" data-img="'+ imgIten +'" class="hiker-upload-img" style="background-image:url('+imgIten+');"></div>';
                });
            }
            addhtml += '    </div>';
            //商家回复的评论
            if( item.reply_comment != null ){
                addhtml += '<div class="mall-comment flex-start"><div><span class="mall-text">'+item.reply_name+'回复: </span>'+item.reply_comment+'</div></div>';
            }
            addhtml += '</div>';
        });
        return addhtml;
    };

    function addProductStartHtml( data ){
        var addHtml = "";
        addHtml += '<div class="comment-score flex-start">';
        addHtml += '    <div class="comment-text flex-div">评星:</div>';
        addHtml += '    <div class="comment-div flex-div">';
        // for (var i = 0; i < startNum; i++) {
        //     addHtml += '<img class="comment-start-img" src="/phone/public/images/wechat/comment-start.png">';
        // }
        // for (var j = 0; j < (5-startNum); j++) {
        //     addHtml += '<img class="comment-start-img" src="/phone/public/images/wechat/coment_start_gray.png">';
        // }
        //判断是否出现半星
        if( data.allStartNum != parseInt( data.allStartNum ) ){
            var halfstart = true;
        }else{
            var halfstart = false;
        }
        var startNum = parseInt( data.allStartNum );
        if( halfstart ){
            for (var i = 0; i < startNum-1; i++) {
                addHtml += '<div class="comment-start-img-div" style="background-image:url(/phone/public/images/wechat/start-man.png);"></div>';
            }
            addHtml += '<div class="comment-start-img-div" style="background-image:url(/phone/public/images/wechat/start-ban.png);"></div>';
        }else{
            for (var i = 0; i < startNum; i++) {
                addHtml += '<div class="comment-start-img-div" style="background-image:url(/phone/public/images/wechat/start-man.png);"></div>';
            }
        }
        for (var j = 0; j < (5-startNum); j++) {
            addHtml += '<div class="comment-start-img-div" style="background-image:url(/phone/public/images/wechat/start-kong.png);"></div>';
        }
        addHtml += '    </div>';
        addHtml += '</div>';
        addHtml += '<div class="comment-percent flex-center">'+data.like_persont+'%满意</div>';
        return addHtml;
    }

    //切换不同tab的数据请求
    function onTableComment( event ){
        var tab = $(event).attr('data-cout-typt');
        //切换重置当前的页数
        nowPage = 1;
        // if( tab == 1 ){
        //     getCommentData( productIdData, nowPage, 1 );
        // }else if( tab == 3 ){
        //     getCommentData( productIdData, nowPage, 3 );
        // }
    };

    //获取更多的评论数据
    var isClick = true;
    function getMoreComment(){
        if( nowPage >= allPage ){
            return false;
        }
        if( isClick ){
            // console.log(1111);
            isClick = false;
            var nowTab = $('.comment-btn.comment-select').attr('data-cout-typt');
            nowPage ++;
            getCommentNextData(productIdData,nowPage,nowTab);
        }
    };

    //获取下一页的操作
    function getCommentNextData ( pid, page, type ){
        $.ajax({
            url: '/api/mall/Detail/getComments',
            type: 'GET',
            dataType: 'json',
            data: {
                pid: pid,
                p: page,
                //是否后获取所有评论
                t: type,
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                if( getdata.errcode == 0 ){
                    //获取原本的评论
                    var itemData  = getdata.data.items;
                    var commentHtml = addCommentData( itemData );
                    isClick = true;
                    $('.hiker-info-all').append(commentHtml);
                    //判断是否达到更多的操作
                    if( nowPage >= allPage ){
                        $('.more-than').remove();
                    }
                }else{
                    console.log(222);
                }
            })
            .fail(function() {
                $("#loading").hide();
                console.log("请求失败");
            });
    };

    //点击图片的大图显示
    function priviewImg( e ){
        var img = $(e).attr("data-img");
        wx.previewImage({
            current: img, // 当前显示图片的http链接
            urls: priviewImgs // 需要预览的图片http链接列表
        });
    }

    //默认只有一个选择时，选中
    var productLength = $('.goods-choice-option-div .goods-choice-option').length;
    if( productLength == 1 ){
        $('.goods-choice-option-div .goods-choice-option').click();
    }

</script>

</html>