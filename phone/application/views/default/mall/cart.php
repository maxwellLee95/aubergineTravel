<!DOCTYPE html>
<html>
<head>
    <title>购物车</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/font-awesome/css/font-awesome.min.css?v=5"/>

    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/style.css?v=565"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/global.min.css?v=16"/>
    <link type="text/css" rel="stylesheet" href="/phone/public/css/wechat/icon.css?v=10">


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
<link href="/phone/public/css/wechat/index_3v.css?v=6" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=17">
<link rel="stylesheet" type="text/css" href="/phone/public/css/mall/cart.css?v=6">
<div class="content">

    <div id="small-loading" class="small-loading">
        <img src="/phone/public/images/wechat/loading2.gif" width="20" height="20">
    </div>

    <!-- 购物车列表 -->
    <form id="form" method="post" action="/phone/mall/confirm_order">
        <input type="hidden" name="wxoid" value="" />
        <div class="shopping-list">
            {loop $list $row}
            <div class="goods" money="{$row['total_price']}">
                <div class="pull-left goods-img">
                    <div class="cart-checkbox" onclick="checkedGoods(this,0);">
                        <div class="cart-show"></div>
                        <input type="checkbox" id="cartSkuId{$row['sku_id']}" name="cart[{$row['sku_id']}][sku_id]" value="{$row['sku_id']}" style="display:none;">
                    </div>
                    <a href="{$row['detail_url']}">
                        <img src="{Common::img($row['product_pic'],60,60)}" alt="商品图">
                    </a>
                </div>
                <div class="pull-right" style="width:80%;">
                    <a href="{$row['detail_url']}">
                        <div class="goods-info">
                            <div class="goods-name">{$row['product_name']}</div>
                            <div class="goods-size">
                                规格:{$row['sku_name']}
                                <div class="pull-right">￥{$row['total_price']}</div>
                            </div>
                        </div>
                    </a>
                    <div class="goods-num">
                        <div class="pull-left">
                            <button class="goods-num-btn " type="button" onclick="changeNum( 0, this, {$row['sku_id']} );">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="pull-left">
                            <input class="goods-small-input goods-num-input" cartId="{$row['sku_id']}" skuId="{$row['sku_id']}" type="text" id="payNum{$row['sku_id']}" value="{$row['num']}">
                        </div>
                        <div class="pull-left">
                            <button class="goods-num-btn " type="button" onclick="changeNum( 1, this, {$row['sku_id']} );">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="pull-right">
                            <div class="goods-del" cartId="{$row['sku_id']}" onclick="delCart(this,{$row['sku_id']});">
                                <i class="fa fa-trash-o fa-lg"></i>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="goods-count">(库存：<span class="sku-count">{$row['stock']}</span>)</div>
                </div>
                <div class="clear"></div>
            </div>
            {/loop}
        </div>
    </form>
    <!-- 底部按钮 -->
    <div class="bottom-btns">
        <div class="all-choice" style="width:60%;">
            <div class="all-checkbox pull-left" onclick="checkedAll();">
                <div class="cart-show"></div>
                <input type="checkbox" id="checkedAll" value="1" style="display:none;">
            </div>
            <label class="all-checkbox-label" onclick="checkedAll();">全选</label>
            <div class="money-count">
                <div>合计：￥<span id="moneyCount">0</span></div>
                <div>(不含邮费)</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bottom-btn" style="width:40%;">
            <a class="can-not-pay">买买买</a>
        </div>
    </div>
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>


<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/bootstrap/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/jquery.scrollLoading.js" ></script>
<script type="text/javascript" src="/phone/public/plugins/swiper3.3.1/js/swiper.min.js" ></script>
<script type="text/javascript" src="/phone/public/js/timeInterval.js" ></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=17" ></script>
<script type="text/javascript">

    var checkedLength = 0; //勾中的商品数量
    var allLength = "1"; //购物车的总数

    function pay(){
        var haveChecked = false;
        $(".cart-checkbox").each(function(index, el) {
            if( $(this).find("input[type='checkbox']").is(":checked") ){
                haveChecked = true;
            }
        });
        if( !haveChecked ){
            popLayer(
                {
                    title: '温馨提示',
                    btnsName: '确认',
                    btnsCallback: 'closePopLayer();',
                    content: '<div class="text-center">请至少选择一个购物车里的商品！</div>',
                }
            );
            return;
        }
        $("#form").submit();
        // var data = $("#form").serialize();
        // console.log(data);
    }

    //二次确认删除购物车商品
    var delObj = ""; //删除商品时的全局变量
    function delCart( obj ){
        delObj = obj;
        popLayer(
            {
                title: '温馨提示',
                btnsName: '取消;确认',
                btnsCallback: 'closePopLayer();doDelCart();',
                content: '<div class="text-center">您确定要删除该商品么？</div>',
            }
        );
    }

    //确认删除购物车商品
    function doDelCart(){
        closePopLayer();
        if( delObj != "" ){
            var cartId = $(delObj).attr('cartId');
            console.log(cartId);
            $.ajax({
                url: '/phone/mall/ajax_delcart',
                type: 'POST',
                dataType: 'json',
                data: {
                    cartId: cartId
                },
            })
                .done(function(getdata) {
                    console.log(getdata);
                    if( getdata.status == 1 ){
                        $(delObj).parent().parent().parent().parent().remove();
                        var goodsNum = $(".goods").length;
                        if( goodsNum <= 0 ){
                            $(".shopping-list").html('<div class="no-cart text-center">您的购物车空空的，快去买买买！</div>');
                        }
                        delObj = "";
                        //统计总价
                        countMoney();
                    }else{
                        popLayer(
                            {
                                title: '温馨提示',
                                btnsName: '确认',
                                btnsCallback: 'closePopLayer();',
                                content: '<div class="text-center">删除失败，请稍候再试！</div>',
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
        }
    }

    //数量加减
    function changeNum( type, obj, skuId ){
        //ajax请求获取该规格最新的库存信息
        $("#small-loading").show();
        $.ajax({
            url: '/phone/mall/ajax_skucount',
            type: 'POST',
            dataType: 'json',
            data: {
                skuId: skuId
            },
        })
            .done(function(getdata) {
                // console.log(getdata);
                $("#small-loading").hide();
                if( getdata.status == 1 ){
                    var parentObj = $(obj).parent().parent();
                    if( getdata.count > 1 ){
                        parentObj.find(".goods-choice-input .goods-num-btn:last").removeClass("no-operation");
                    }else{
                        parentObj.find(".goods-choice-input .goods-num-btn:last").addClass("no-operation");
                    }
                    var payNum = parentObj.find(".goods-small-input").val();
                    var goodsInventory = getdata.count;
                    $(obj).parent().parent().parent().find('.sku-count').html( goodsInventory );
                    if( type == 0 && payNum > 1 ){
                        payNum--;
                    }else if( type == 1 ){
                        payNum++;
                    }
                    if( payNum > goodsInventory ){
                        parentObj.find(".goods-num-input").val( goodsInventory );
                        //若大于最大库存，则无法再增加了
                        return;
                    }else if( payNum == goodsInventory ){
                        parentObj.find(".goods-num-btn:last").addClass("no-operation");
                    }else{
                        parentObj.find(".goods-num-btn:last").removeClass("no-operation");
                    }
                    if( payNum > 1 ){
                        parentObj.find(".goods-num-btn:first").removeClass("no-operation");
                    }else{
                        parentObj.find(".goods-num-btn:first").addClass("no-operation");
                    }
                    parentObj.find(".goods-small-input").val( payNum );

                    countMoney();
                }else{
                    popLayer(
                        {
                            title: '温馨提示',
                            btnsName: '确认',
                            btnsCallback: 'closePopLayer();',
                            content: '<div class="text-center">库存获取失败，请稍候再试！</div>',
                        }
                    );
                }
            })
            .fail(function() {
                $("#small-loading").hide();
            });
    }

    //全选购物车商品
    function checkedAll(){
        var check = $("#checkedAll").is(":checked");
        if( check ){
            $("#checkedAll").prev().removeClass("select");
            $("#checkedAll").prev().html("");
            $("#checkedAll").prop("checked",false);
        }else{
            $("#checkedAll").prev().addClass("select");
            $("#checkedAll").prev().html('<i class="fa fa-check"></i>');
            $("#checkedAll").prop("checked","checked");
        }
        $(".cart-checkbox").each(function(index, el) {
            checkedGoods( this, 1 );
        });
        //统计总价
        countMoney();
    }

    //选中购物车商品
    function checkedGoods( obj, isAllChecked ){
        var check = $(obj).find('input[type="checkbox"]').is(":checked");
        if( check ){
            $(obj).find('.cart-show').removeClass("select");
            $(obj).find('.cart-show').html("");
            $(obj).find('input[type="checkbox"]').prop("checked",false);
            $(obj).parent().parent().find('.goods-small-input').removeAttr('name');
            checkedLength--;
        }else{
            $(obj).find('.cart-show').addClass("select");
            $(obj).find('.cart-show').html('<i class="fa fa-check"></i>');
            $(obj).find('input[type="checkbox"]').prop("checked","checked");
            $(obj).parent().parent().find('.goods-small-input').attr('name', 'cart['+ $(obj).parent().parent().find('.goods-small-input').attr("cartId") +'][payNum]');
            checkedLength++;
        }
        //若已选中全部商品，则勾中全选
        if( checkedLength == allLength ){
            $("#checkedAll").prev().addClass("select");
            $("#checkedAll").prev().html('<i class="fa fa-check"></i>');
            $("#checkedAll").prop("checked","checked");
        }else{
            $("#checkedAll").prev().removeClass("select");
            $("#checkedAll").prev().html("");
            $("#checkedAll").prop("checked",false);
        }
        //若有选中，则可以点击购买按钮
        if( checkedLength > 0 ){
            $(".bottom-btn a").attr('onclick', 'pay()');
            $(".bottom-btn a").removeClass("can-not-pay");
        }else{
            $(".bottom-btn a").removeAttr('onclick');
            $(".bottom-btn a").addClass("can-not-pay");
        }
        if( isAllChecked == 0 ){
            //统计总价
            countMoney();
        }
    }

    //统计总价
    function countMoney(){
        var allMoney = 0;
        $(".goods").each(function(index, el) {
            var check = $(this).find("input[type='checkbox']").is(":checked");
            if( check ){
                var money = parseFloat( $(this).attr("money") );
                var num = parseInt( $(this).find('.goods-small-input').val() );
                allMoney += money * num;
            }
        });
        $("#moneyCount").html( allMoney.toFixed(2) );
    }

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

    $(".goods-num-input").blur(function(event) {
        changeNum( 2, this, $(this).attr("skuId") );
    });
</script>


</html>