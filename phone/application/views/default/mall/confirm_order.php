<!DOCTYPE html>
<html>
<head>
    <title>确认订单</title>
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

<link rel="stylesheet" type="text/css" href="/phone/public/css/wechat/pop-layer.css?v=17">
<link rel="stylesheet" type="text/css" href="/phone/public/css/mall/pay.css?v=8">
<style type="text/css" media="screen">
    #distpicker{
        padding: 5px 0;
    }
    #province, #city, #district{
        width: 100%;
        height: 34px;
    }
</style>
<div class="content">
    <!-- 有联系方式 -->
    <!-- 内容主页 -->
    <form id="mainForm">
        <input type="hidden" id="formUseScore" name="useScore" value="0">
        <div id="mainContent">
            <!-- 商品信息 -->
            <div class="div-title">商品信息</div>
            <div class="goods-list">
                {loop $shop_list $row}
                <div class="goods">
                    <input type="text" name="products[{$row['sku_id']}][sku_id]" value="{$row['sku_id']}" style="display:none;">
                    <input type="text" name="products[{$row['sku_id']}][product_id]" value="{$row['product_id']}" style="display:none;">
                    <input type="text" name="products[{$row['sku_id']}][count]" value="{$row['num']}" style="display:none;">
                    <a href="{$row['detail_url']}">
                        <div class="pull-left" style="width: 20%;">
                            <div class="goods-img">
                                <img src="{Common::img($row['product_pic'],60,60)}" alt="商品图">
                            </div>
                        </div>
                        <div class="pull-right" style="width: 80%;">
                            <div class="goods-info">
                                <div class="goods-name">{$row['product_name']}</div>
                                <div class="goods-size">
                                    规格:&nbsp;&nbsp;
                                    {$row['sku_name']}&nbsp;&nbsp;
                                    <div class="pull-right"><span>￥{$row['total_price']}</span> × {$row['num']}</div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </a>
                </div>
                {/loop}
            </div>
            <!-- 取货方式 -->
            <div class="div-title">取货方式</div>
            <div class="pick-up">
                <div class="input-radios">
                    {loop $delivery $key $row}
                    <div class="input-radio pick-up-type" showAddress="1" onclick="checkedRadio(this,1);">
                        <div class="pull-left">{$row['name']}</div>
                        <div class="pull-right">
                            <div money={$row['price']} class="radio-show {if $key==0}checked{/if}">
                                <div class="circle-i"></div>
                            </div>
                            <input type="radio" id="express_id{$row['id']}"  class="express_id" name="express_id" value="{$row['id']}" style="display:none;" checked="checked">
                        </div>
                        <div class="clear"></div>
                    </div>
                    {/loop}
                </div>
                <div class="address" onclick="showAddressList();">
                    <input type="text" id="takeContactId" name="takeContactIdtakeContactId" value="0" style="display:none;">
                    <div class="address-icon" style="margin-top: 6px;">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="address-edit" style="margin-top: 6px;">
                        <i class="fa fa-angle-right"></i>
                    </div>
                    <div class="address-title" style="color: #888;">
                        <div class="pull-left">没有您的联系信息，点击设置！</div>
                        <div class="pull-right"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="address-content"></div>
                </div>
            </div>
            <div style="font-size:12px; color:#888; padding:10px 10px 0 10px;">* 仅支持上门自取或快递；</div>
            <!-- 支付方式 -->
            <div class="div-title">支付方式</div>
            <div class="pay">
                <div class="input-radios">
                    <div class="input-radio pay-type" onclick="checkedRadio(this,0);">
                        <div class="pull-left">微信支付(推荐)</div>
                        <div class="pull-right">
                            <div class="radio-show checked">
                                <div class="circle-i"></div>
                            </div>
                            <input type="radio" id="pay_type1" name="pay_type" value="1" style="display:none;" checked="checked">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="display: none" class="input-radio pay-type" onclick="checkedRadio(this,0);">
                        <div class="pull-left">支付宝支付</div>
                        <div class="pull-right">
                            <div class="radio-show"></div>
                            <input type="radio" id="pay_type2" name="pay_type" value="2" style="display:none;">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <!-- 底部按钮 -->
            <div class="bottom-btns">
                <div class="bottom-btn" style="width: 60%; margin: 0 auto;">
                    <a onclick="pay();">￥<span id="moneyCount">{$total_price}</span>支付</a>
                </div>
            </div>
        </div>
    </form>
    <!-- 收货地址编辑列表 -->
    <div id="addressList" style="display:none;">
        <div class="hidden-title">
            <div class="pull-left">选择收货地址</div>
            <div class="pull-right">
                <button type="button" onclick="hideAddressEdit();">返回</button>
            </div>
            <div class="clear"></div>
        </div>
        <div id="mainAddressList">
            {loop $linkman  $row}
            <div class="address-list" id="addressList{$row['contactId']}">
                <div class="address-main" onclick="choiceAddress(this,{$row['contactId']});">
                    <div class="address-list-icon">
                        <i class="fa fa-angle-right"></i>
                    </div>
                    <div>
                        <div class="pull-left contactName">{$row['realName']}</div>
                        <div class="pull-right contactTel">{$row['telephone']}</div>
                        <div class="clear"></div>
                    </div>

                    <div class="contactAddress">
                    {if $row['address']}
                        收货地址：{$row['address']}
                    {else}
                        <div class="noAddress">没有地址相关信息</div>
                    {/if}
                    </div>
                </div>
                <div class="address-edit-btn">
                    <div class="pull-left default-address" contactId="{$row['contactId']}">
                        {if $row['isdefault']}
                        <button class="isDefault" type="button">默认地址</button>
                        {/if}
                    </div>
                    <div class="pull-right">
                        <button type="button" onclick="showAddressForm(1,{$row['contactId']})">编辑</button> |
                        <button type="button" onclick="delContact({$row['contactId']});">删除</button>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            {/loop}
        </div>
        <!-- 底部新增地址 -->
        <div class="bottom-btns">
            <div class="bottom-btn" style="width:100%;">
                <a onclick="showAddressForm(0,0);">新增地址</a>
            </div>
        </div>
    </div>
    <!-- 收货地址编辑表单 -->
    <form id="addressForm">
        <div id="addressFormDiv" style="display:none;">
            <input type="text" id="contactId" class="form-input" name="contactId" value="0" style="display:none;">
            <div class="hidden-title">
                <div class="pull-left">新增收货地址</div>
                <div class="pull-right">
                    <button type="button" onclick="showAddressList();">返回</button>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-div">
                <div class="pull-left">收货人</div>
                <div class="pull-right" style="width:80%;">
                    <input type="text" id="realname" class="form-input required" name="realname" value="" placeholder="(必填)">
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-div">
                <div class="pull-left">联系电话</div>
                <div class="pull-right" style="width:80%;">
                    <input type="text" id="telephone" class="form-input mobileInput required" name="telephone" value="" placeholder="(必填)">
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-div" style="height:auto;">
                <div class="pull-left">所在地区</div>
                <div class="pull-right" style="width:80%; position:relative;">
                    <div id="distpicker" data-toggle="distpicker">
                        <select id="province" name="province" data-province="广东省"></select>
                        <select id="city" name="city" data-city="广州市"></select>
                        <select id="district" name="district" data-district="天河区"></select>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-div">
                <div class="pull-left">详细地址</div>
                <div class="pull-right" style="width:80%;">
                    <input type="text" id="address" class="form-input required" name="address" value="" placeholder="(必填，如道路，门牌号，小区等)">
                </div>
                <div class="clear"></div>
            </div>
            <!-- 底部新增地址 -->
            <div class="bottom-btns">
                <div class="bottom-btn" style="width:100%;">
                    <a onclick="submitContact();">保存</a>
                </div>
            </div>
        </div>
    </form>
</div>


</body>
<script type="text/javascript" src="/phone/public/js/jweixin-1.0.0.min.js"></script>

<script type="text/javascript" src="/phone/public/plugins/jQuery/jQuery-2.1.3.min.js?v=2"></script>
<script type="text/javascript" src="/phone/public/bootstrap/js/bootstrap.min.js?v=2"></script>

<script type="text/javascript" src="/phone/public/js/leader/deal_data.js?v=2"></script>
<script type="text/javascript" src="/phone/public/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/phone/public/js/messages_zh.js"></script>
<script type="text/javascript" src="/phone/public/js/jquery-validate-methods.js?v=15"></script>
<script type="text/javascript" src="/phone/public/js/wechat/pop-layer.js?v=17" ></script>
<script type="text/javascript" src="/phone/public/js/distpicker/dist/distpicker.js"></script>
<script type="text/javascript">

    var contactsJson = <?php echo json_encode($linkman) ?>;
    var payData = '';
    var hid = 690587;

    var allMoney = "<?php echo $total_price?>"; //初始全局总价

    var haveContact = false; //是否有选择收货地址

    //监听快递方式的选择
    var isChoiceSelfDoor = false;
    $(".pick-up-type").click(function(event) {
        var check = $(this).find("input[type='radio']").is(":checked");
        var showAddress = $(this).attr('showAddress');
        $(".address").slideDown();
        $(".our-address").slideUp();
        isChoiceSelfDoor = false;
        // if( check && showAddress == 1 ){
        //     $(".address").slideDown();
        //     $(".our-address").slideUp();
        //     isChoiceSelfDoor = false;
        // }else{
        //     isChoiceSelfDoor = true;
        //     $(".address").slideUp();
        //     $(".our-address").slideDown();
        // }
    });

    //显示使用学分
    var canUseScore = 0;
    function showUseScore( obj, type ){
        //ajax请求可用学分
        $.ajax({
            url: '/wechat/pay/getcanusescore',
            type: 'POST',
            dataType: 'json',
            data: {
                wxoid: ""
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                if( getdata.status == 1 ){
                    canUseScore = getdata.canUseScore;
                    if( type == 1 ){
                        popLayer(
                            {
                                title: '<div class="canUseScore">当前可用学分：'+ getdata.canUseScore +'</div>',
                                btnsName: '取消;使用',
                                btnsCallback: 'closePopLayer();sureToUse('+ type +')',
                                content: '<div class="useScore"><div class="score-input"><input type="text" placeholder="请输入使用学分" id="useScore"></div></div><div id="show-error"></div>',
                            }
                        );
                    }else{
                        checkedCheckbox( type );
                    }
                }else{

                }
            })
            .fail(function() {
                console.log("error");
            });
    }

    //使用学分
    function sureToUse( type ){
        var useScore = $("#useScore").val();
        var check = new RegExp(/^[1-9]\d*$/);
        if( !check.test(useScore) ){
            $("#show-error").html("输入的学分数必须为正整数！");
            $("#show-error").animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100).animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100).animate({ left: "0px" }, 100);
            return;
        }
        if( useScore == "" || useScore <= 0 || useScore == NaN ){
            $("#show-error").html("输入的学分数必须大于0！");
            $("#show-error").animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100).animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100).animate({ left: "0px" }, 100);
            return;
        }
        if( useScore > canUseScore ){
            $("#show-error").html("已超过您的可用学分！");
            $("#show-error").animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100).animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100).animate({ left: "0px" }, 100);
            return;
        }

        $("#show-error").html("");
        $("#formUseScore").val( useScore );
        //统计总价
        countMoney();
        //计算减免金额
        if( $(".pick-up-type .radio-show.checked").attr("money") == undefined ){
            var money = 0;
        }else{
            var money = parseFloat( $(".pick-up-type .radio-show.checked").attr("money") );
        }
        var newAllMoney = allMoney + money;
        var discountMoney = parseInt( useScore ) * 3 / 100;
        if( discountMoney > newAllMoney ){
            discountMoney = newAllMoney;
        }
        $(".isUseScore .pull-left").html( '已使用 <span style="color:#9B8CE5;">'+ useScore +'</span> 学分（<span style="color:#9B8CE5;">-'+ discountMoney +'</span>元）' );
        checkedCheckbox( type );
        closePopLayer();
    }

    //学分选择控制
    function checkedCheckbox( type ){
        if( type == 1 ){
            $(".isUseScore").find(".checkbox-show").addClass("checked");
            $(".isUseScore").find(".checkbox-show").html('<i aria-hidden="true" class="fa fa-check"></i>');
            $(".isUseScore").attr("onclick","showUseScore(this,0)");
        }else{
            $(".isUseScore").find(".checkbox-show").removeClass("checked");
            $(".isUseScore").find(".checkbox-show").html('');
            $(".isUseScore").attr("onclick","showUseScore(this,1)");
            $("#formUseScore").val(0);
            $(".isUseScore .pull-left").html("使用学分");
            //统计总价
            countMoney();
        }
    }

    //单选控制
    function checkedRadio( obj, isDoCount ){
        var parentObj = $(obj).parent();
        parentObj.find("input[type='radio']").prop("checked",false);
        parentObj.find(".radio-show").removeClass("checked");
        parentObj.find(".radio-show").html("");
        $(obj).find("input[type='radio']").prop("checked","checked");
        $(obj).find(".radio-show").addClass("checked");
        $(obj).find(".radio-show").html('<div class="circle-i"></div>');
        if( isDoCount == 1 ){
            //统计总价
            countMoney();
        }
    }

    //统计总价
    function countMoney(){
        if( $(".pick-up-type .radio-show.checked").attr("money") == undefined ){
            var money = 0;
        }else{
            var money = parseFloat( $(".pick-up-type .radio-show.checked").attr("money") );
        }
        var newAllMoney = parseFloat(allMoney) + money;
        newAllMoney = ( newAllMoney * 100 - parseInt( $("#formUseScore").val() ) * 3 ) / 100;
        if( newAllMoney <= 0 ){
            newAllMoney = 0;
        }
        $("#moneyCount").html( newAllMoney )
    }

    //显示收货地址编辑列表
    function showAddressList(){
        window.history.pushState("list",null,"");
        changeContent();
    }

    //显示收货地址编辑表单
    function showAddressForm( isEdit, contactId ){
        if( isEdit == 1 ){
            var contact = contactsJson[contactId];
            console.log(contact);
            $("#contactId").val( contact.contactId );
            $("#realname").val( contact.realName );
            $("#telephone").val( contact.telephone );
            // $("#address").val( contact.address );
            $("#address").val("");
            $('#distpicker').distpicker('reset', true);
        }else{
            $('#distpicker').distpicker('reset');
        }
        window.history.pushState("form",null,"");
        changeContent();
    }

    //返回内容主页
    function hideAddressEdit(){
        window.history.pushState("content",null,"");
        changeContent();
    }

    //监听返回
    $(window).on('popstate', function () {
        changeContent();
    });

    //判断当前URL下对应的状态信息，展现对应的内容
    function changeContent(){
        var state = window.history.state;
        console.log(state);
        if( state == "list" ){
            //编辑列表
            $("#mainContent").hide();
            $("#addressList").show();
            $("#addressFormDiv").hide();
        }else if( state == "form" ){
            //编辑表单
            $("#mainContent").hide();
            $("#addressList").hide();
            $("#addressFormDiv").show();
        }else if( state == "content" || state == null ){
            //内容主页
            $("#mainContent").show();
            $("#addressList").hide();
            $("#addressFormDiv").hide();
        }
    }

    //选择地址
    function choiceAddress( obj, contactId ){
        var contact = contactsJson[contactId];
        console.log(contactsJson);
        console.log(contact);
        if( contact != undefined ){
            if( contact.address == null || contact.address == '' ){
                popLayer(
                    {
                        title: '温馨提示',
                        btnsName: '确认',
                        btnsCallback: 'closePopLayer();',
                        content: '<div class="text-center">请先设置您联系方式的收货地址！</div>',
                    }
                );
                return;
            }
            //设置收货地址
            $("#takeContactId").val( contact.contactId );
            $(".address-title").removeAttr("style");
            $(".address-title").prev().removeAttr("style");
            $(".address-title").prev().prev().removeAttr("style");
            $(".address-title .pull-left").html( contact.realName );
            $(".address-title .pull-right").html( contact.telephone );
            $(".address-content").html( contact.address );
            haveContact = true;
            window.history.go(-1);
        }
    }

    //保存收货地址
    function submitContact(){
        $("#addressForm").submit();
    }
    $().ready(function() {
        $("#addressForm").validate({
            ignore: "",
            submitHandler: function(form) {
                $(".loading").html("正在提交");
                $("#loading").show();
                var data = $(form).serialize();
                data += '&wxoid=';
                //ajax提交收货地址相关信息
                $.ajax({
                    url: '/phone/member/linkman/ajax_mall_contact_save?action=save',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                })
                    .done(function(getdata) {
                        console.log(getdata);
                        $("#loading").hide();
                        if( getdata.status == 1 ){
                            contactsJson = getdata.contacts;
                            //判断是新增还是编辑
                            var contactId = $("#contactId").val();
                            if( contactId == 0 ){
                                $(".no-contact").remove();
                                var addHtml = getContactHtml( getdata.contact['contactId'], getdata.contact['realName'], getdata.contact['telephone'], getdata.contact['address'] );
                                $("#mainAddressList").append( addHtml );
                            }else{
                                var listObj = $("#addressList"+getdata.contact['contactId']);
                                listObj.find('.contactName').html( getdata.contact['realName'] );
                                listObj.find('.contactTel').html( getdata.contact['telephone'] );
                                listObj.find('.contactAddress').html( getdata.contact['address'] );
                            }
                            window.history.go(-1);
                        }else{
                            popLayer(
                                {
                                    title: '温馨提示',
                                    btnsName: '确认',
                                    btnsCallback: 'closePopLayer();',
                                    content: '<div class="text-center">保存失败，请稍候再试！</div>',
                                }
                            );
                        }
                    })
                    .fail(function() {
                        $("#loading").hide();
                        popLayer(
                            {
                                title: '温馨提示',
                                btnsName: '确认',
                                btnsCallback: 'closePopLayer();',
                                content: '<div class="text-center">请求失败，请稍候再试！</div>',
                            }
                        );
                    });
                return false;
            },
            errorPlacement: function(error, element) {

            }
        });
    });

    //获取收货地址HTML
    function getContactHtml( contactId, realName, telephone, address ){
        var addHtml = '';
        addHtml += '<div class="address-list" id="addressList'+ contactId +'">';
        addHtml +=     '<div class="address-main" onclick="choiceAddress(this,'+ contactId +');">';
        addHtml +=         '<div class="address-list-icon">';
        addHtml +=             '<i class="fa fa-angle-right"></i>';
        addHtml +=         '</div>';
        addHtml +=         '<div>';
        addHtml +=             '<div class="pull-left">'+ realName +'</div>';
        addHtml +=             '<div class="pull-right">'+ telephone +'</div>';
        addHtml +=             '<div class="clear"></div>';
        addHtml +=         '</div>';
        addHtml +=         '<div>'+ address +'</div>';
        addHtml +=     '</div>';
        addHtml +=     '<div class="address-edit-btn">';
        addHtml +=         '<div class="pull-left default-address" contactId="'+ contactId +'">';
        addHtml +=             '<button type="button" onclick="setDefaultContact('+ contactId +', this)">设为默认</button>';
        addHtml +=         '</div>';
        addHtml +=         '<div class="pull-right">';
        addHtml +=             '<button type="button" onclick="showAddressForm(1,'+ contactId +')">编辑</button> |';
        addHtml +=             '<button type="button" onclick="">删除</button>';
        addHtml +=         '</div>';
        addHtml +=         '<div class="clear"></div>';
        addHtml +=     '</div>';
        addHtml += '</div>';
        return addHtml;
    }

    //设置默认收货地址
    function setDefaultContact( contactId, obj ){
        $(".loading").html("正在处理");
        $("#loading").show();
        $.ajax({
            url: '/mall/detail/setdefaultcontact',
            type: 'POST',
            dataType: 'json',
            data: {
                contactId: contactId,
                wxoid: ""
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $("#loading").hide();
                if( getdata.status == 1 ){
                    $(".default-address .isDefault").html("设为默认");
                    var oldDefaultId = $(".default-address .isDefault").parent().attr('contactId');
                    $(".default-address .isDefault").attr("onclick","setDefaultContact("+ oldDefaultId +", this)");
                    $(".default-address .isDefault").removeClass('isDefault');
                    $(obj).addClass("isDefault");
                    $(obj).html("默认地址");
                    $(obj).removeAttr("onclick");
                }else{
                    popLayer(
                        {
                            title: '温馨提示',
                            btnsName: '确认',
                            btnsCallback: 'closePopLayer();',
                            content: '<div class="text-center">设置失败，请稍候再试！</div>',
                        }
                    );
                }
            })
            .fail(function() {
                $("#loading").hide();
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

    //删除收货地址
    var delContactId = "";
    function delContact( contactId ){
        delContactId = contactId;
        popLayer(
            {
                title: '温馨提示',
                btnsName: '取消;确认',
                btnsCallback: 'closePopLayer();doDelContact()',
                content: '<div class="text-center">您确定要删除该收货地址么？</div>',
            }
        );
    }
    //确认删除收货地址
    function doDelContact(){
        closePopLayer();
        $(".loading").html("正在处理");
        $("#loading").show();
        $.ajax({
            url: '/mall/detail/delcontact',
            type: 'POST',
            dataType: 'json',
            data: {
                contactId: delContactId,
            },
        })
            .done(function(getdata) {
                console.log(getdata);
                $("#loading").hide();
                if( getdata.status == 1 ){
                    $("#addressList"+delContactId).remove();
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
                $("#loading").hide();
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

    //支付操作
    function pay(){
        //收货方式检查
        var express_id = "";
        $(".express_id").each(function(index, el) {
            if( $(this).is(":checked") ){
                express_id = $(this).val();
            }
        });
        if( express_id == "" ){
            popLayer(
                {
                    title: '温馨提示',
                    btnsName: '确认',
                    btnsCallback: 'closePopLayer();',
                    content: '<div class="text-center">请选择您的取货方式！</div>',
                }
            );
            return;
        }
        //快递地址检查
        if( !haveContact && !isChoiceSelfDoor ){
            popLayer(
                {
                    title: '温馨提示',
                    btnsName: '确认',
                    btnsCallback: 'closePopLayer();',
                    content: '<div class="text-center">请选择填写您的收货地址！</div>',
                }
            );
            return;
        }
        //支付方式检查
        var pay_type = "";
        $(".pay-type").each(function(index, el) {
            if( $(this).find("input[type='radio']").is(":checked") ){
                pay_type = $(this).find("input[type='radio']").val();
            }
        });
        if( pay_type == "" ){
            popLayer(
                {
                    title: '温馨提示',
                    btnsName: '确认',
                    btnsCallback: 'closePopLayer();',
                    content: '<div class="text-center">请选择您的支付类型！</div>',
                }
            );
            return;
        }
        //ajax开始进入支付流程
        var data = $("#mainForm").serialize();
        data += '&express_id=' + express_id;
        data += '&contactId=' + $("#takeContactId").val();
        data += '&pay_type=' + pay_type;
        // data += '&remark=' + $("#remark").val();
        data += '&wxoid=';
        $.ajax({
            url: '/phone/mall/ajax_create',
            type: 'POST',
            dataType: 'json',
            data: data,
        })
            .done(function(getdata) {
                if ( getdata.status == 1 ) {
                    window.location.href=getdata.payurl;
                } else {
                    popLayer(
                        {
                            title: '温馨提示',
                            btnsName: '确认',
                            btnsCallback: 'closePopLayer();',
                            content: '<div class="text-center">'+getdata.msg+'</div>',
                        }
                    );
                }
            })
            .fail(function() {
                console.log("error");
            });
    }

    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }

    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            wxparams,
            function(res){
                $(".loading").html("");
                $('#loading').hide();
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                    queryStatus();
                    // window.name = "needRefreshActivityIndex";
                    // window.history.go(-1);
                } else if(res.err_msg != "get_brand_wcpay_request:cancel"){
                    alert("err_code="+res.err_code+", err_desc="+res.err_desc+", err_msg="+res.err_msg);
                    $('#payBtn').removeAttr("disabled");
                } else {
                    $('#payBtn').removeAttr("disabled");
                }
            }
        );
    }

    function queryStatus() {
        $.ajax({
            type: "POST",
            data: {wxoid: '', pc: payData},
            url: "/mall/detail/querystatus",
            dataType: "json",
            success: function(response){
                if (response.error == 0) {
                    top.location.href = response.url;
                }
            }
        })
            .fail(function() {
                alert('error')
            });;
    }

    $("#distpicker").distpicker({
        autoSelect: false
    });

    $(".pick-up-type").eq(0).click();

</script>


</html>