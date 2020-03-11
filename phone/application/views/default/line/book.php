<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$info['title']}报名-{$webname}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {Common::css('amazeui.css,style.css,extend.css')}
    {Common::js('jquery.min.js,common.js,amazeui.js,template.js,layer/layer.m.js')}

    <style>
        .layermbtn {
             border-top: none;
        }
    </style>
</head>

<body>

{request "pub/header/typeid/$typeid/isbookpage/1"}
<section>

    <div class="mid_content">

        <div style="display: none" class="confirm_order_msg">
            <dl>
                <dt><img src="{$info['litpic']}" /></dt>
                <dd>
                    <span>{$info['title']}</span>
                    <strong><i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$info['price']}</b>起</strong>
                </dd>
            </dl>
        </div><!--产品简介-->

        <div class="book_type" style="display: none">
            <h3 class="book_tit">产品类型</h3>
            <div class="book_con_box">
                <ul>
                    {st:line action="suit" productid="$info['id']"}
                    {loop $data $r}
                    <li data-suitid="{$r['id']}" data-jftp="{$r['jifentprice']}">{$r['title']}</li>
                    {/loop}
                    {/st}
                </ul>
            </div>
        </div><!--产品类型-->

        <form action="/phone/line/create" id="orderfrm" method="post">
            <div class="book_type">

                <div class="book_type">
                    <h3 class="book_tit">请填写报名信息<a href="javascript:;" id="chooseman">常用联系人</a></h3>
                    <div class="default-people">
                        茄子户外运动将为您投保“畅游华夏”境内旅行保险
                    </div>
                    <span style="margin-top: 10px;display: block;" class="book_tit">添加联系人</span>
                    <div class="people_num">
                        <p id="adult_div" style="<?php if(!$suit['hasadult']){?>display: none;<?php } ?>">
                            <strong>成人数量：</strong>
                            <span>
                            <a class="sub" href="javascript:;">-</a>
                            <input type="text" name="dingnum" id="adultnum" class="order-num" value="1" />
                            <a class="add" href="javascript:;">+</a>
                        </span>
                            成人价：<em><i class="currency_sy">{Currency_Tool::symbol()}</i><b class="adultprice">{$suit['adultprice']}</b></em>
                        </p>
                        <p id="old_div" style="<?php if(!$suit['hasold']){?>display: none;<?php } ?>">
                            <strong>老人数量：</strong>
                            <span>
                            <a class="sub" href="javascript:;">-</a>
                            <input type="text" name="oldnum" id="oldnum" class="order-num" value="0" />
                            <a class="add" href="javascript:;">+</a>
                        </span>
                            老人价：<em><i class="currency_sy">{Currency_Tool::symbol()}</i><b class="oldprice">{$suit['oldprice']}</b></em>
                        </p>
                        <p id="child_div" style="<?php if(!$suit['haschild']){?>display: none;<?php } ?>">
                            <strong>小孩数量：</strong>
                            <span>
                            <a class="sub" href="javascript:;">-</a>
                            <input type="text" name="childnum" class="order-num" id="childnum" value="0" />
                            <a class="add" href="javascript:;">+</a>
                        </span>
                            小孩价：<em><i class="currency_sy">{Currency_Tool::symbol()}</i><b class="childprice">{$suit['childprice']}</b></em>
                        </p>
                    </div>
                    <div class="linkman" id="tourer_list">
                    </div>
                    <div class="linkman" style="display: none">
                        <dl>
                            <dt>订单联系人</dt>
                            <dd><strong>姓名：</strong><input type="text" id="linkman" name="linkman" placeholder="预订联系人姓名" class="" value="{$member['truename']}" /><span>(必填)</span></dd>
                            <dd><strong>联系电话：</strong><input type="text" id="linktel" name="linktel" class="" placeholder="手机号或固定电话" value="{$member['mobile']}" /><span>(必填)</span></dd>
                            <dd><strong>身份证号：</strong><input type="text" id="linkidcard" name="linkidcard" class="" placeholder="输入18位身份证号码" value="{$member['cardid']}" /></dd>
                            <dd style="display: none"><strong>订单备注：</strong><textarea name="remark"></textarea></dd>
                        </dl>
                    </div>
                </div><!--预定人数-->
                <!--隐藏域-->
                <input type="hidden" name="suitid" id="suitid" value=""/>
                <input type="hidden" name="productid" id="productid" value="{$info['id']}"/>
                <input type="hidden" name="typeid"  value="{$typeid}"/>
                <input type="hidden" name="deposite" id="deposit" value="<?php echo  date('Y-m-d',$suit['dingjin']);?>">
                <input type="hidden" name="storage" id="storage" value="<?php echo  date('Y-m-d',$suit['number']);?>"/>
                <input type="hidden" name="usejifen" id="usejifen" value="0"/>
                <input type="hidden" name="startdate" id="startdate" value="<?php echo  date('Y-m-d',$suit['day']);?>"/>
                <div class="linkman">
                    <dl>
                        <dt>当前选择</dt>
                        <dd><strong>{date('m月d日',$suit['day'])}</strong><input readonly="readonly" type="text" class="" value="" /><span style="color: #c2c2c2">{$info['startcity']}出发</span></dd>
                    </dl>
                </div>
                <div class="linkman">
                    <dl>
                        <dt>集合地点</dt>
                        <dd>
                            <strong>当前地点</strong>
                            <input readonly="readonly" type="text" class="" value="" />
                            <span style="color: #c2c2c2">
                                <select name="marshal_point" id="doc-select-1" style="border: none;background: #f5f5f5;">
                                    {loop $info['marshal_point_list'] $row}
                                    <option value="{$row['id']}">{$row['name']}</option>
                                    {/loop}
                                </select>
                            </span>
                        </dd>
                    </dl>
                </div>
                <div class="linkman">
                    <dl>
                        <dt>当前费用</dt>
                        <dd><strong>基础价格</strong><input style="    text-align: center;" readonly="readonly" type="text" class="" value="{$info['price']}元/人" /><span id="total_num" style="color: #c2c2c2">1人</span></dd>
                    </dl>
                </div>
                <div class="linkman">
                    <dl>
                        <dt>支付方式</dt>
                        <dd><strong>微信支付</strong><input style="    text-align: center;" readonly="readonly" type="text" class="" value="" /><span style="color: #c2c2c2"><input style="    display: inherit;" type="radio" checked="checked"/></span></dd>
                    </dl>
                </div>
        </form>

    </div>
    <!--常用联系人-->
    <div id="linkman_list" style="display: none">
        <div class="linkman_page">
            <h3 class="tit">选择联系人</h3>
            <ul class="linkman_list">
                {st:member action="linkman" memberid="$member['mid']"}
                {loop $data $r}
                <li class="cursor">
                    <strong>{$r['linkman']}</strong>
                    <span>性别：{if $r['sex']==1}男{else}女{/if}</span>
                    <span>联系电话：{$r['mobile']}</span>
                    <span>身份证号：{$r['idcard']}</span>
                    <i class="lk_choose" data-linkman="{$r['linkman']}" data-sex="{$r['sex']}" data-mobile="{$r['mobile']}" data-idcard="{$r['idcard']}"></i>
                </li>
                {/loop}
                {/st}
            </ul>
        </div><!--选择联系人-->
    </div>

    {request "pub/integral"}
    </div><!--预定人数-->
    <div id="js_calendar" style="display: none">

    </div>
</section>
{request "pub/code"}
<div class="bom_link_box">
    <div class="bom_fixed">
        <a class="price btn_book" href="javascript:;"><span><i class="currency_sy">{Currency_Tool::symbol()}</i><b class="totalprice"></b></span> 支付</a>
    </div>
</div>
<script>
    $(function(){
        //套餐选择
        $(".book_con_box").find('li').click(function(){
            var suitid = $(this).attr('data-suitid');
            $("#suitid").val(suitid);
            $(this).addClass('on').siblings().removeClass('on');
            get_total_price();
        })
        $(".book_con_box").find('li').first().trigger('click');
        //减少人数
        $('.sub').click(function(){
            var num=0;
            $('.people_num').find('.order-num').each(function(){
                num+=parseInt($(this).val());
            });
            if(num<2){
                return false;
            }
            var dingnum = $(this).parent().find('.order-num');
            var peopelnum = dingnum.val();
            if(peopelnum>=1){
                var a=parseInt(dingnum.val())-1;
                dingnum.val(a);
                $("#total_num").html(a+'人');
            }
            get_total_price();
        });

        //添加人数
        $('.add').click(function(){

            var dingnum = $(this).parent().find('.order-num');
            var a=parseInt(dingnum.val())+1;
            dingnum.val(a);
            $("#total_num").html(a+'人');
            get_total_price();

        });
        //输入人数
        $('.order-num').each(function(){
            $(this).change(function(){
                var val=$(this).val();
                if(val<1){
                    $(this).val(0);
                    return false;
                }
                get_total_price();
            });
        });

        //关闭日历
        $("body").delegate('.close_calendar','click',function(){
            hide_calendar();
        })
        //常用联系人选择事件
        $("body").delegate('.linkman_list li','click',function(){
            $(this).find('i').toggleClass('on');
        })

        //常用联系人选择
        $("#chooseman").click(function(){
            $.getJSON('{$cmsurl}member/login/ajax_is_login', {}, function (data) {
                if (data.status == 1) {
                    var content = $("#linkman_list").html();
                    layer.open({
                        type: 1,
                        content: content,
                        style: 'width:80%; border:none;',
                        btn: ['{__("OK")}'],
                        yes: function () {
                            $(".linkman_list").find('.on').each(function (i, obj) {
                                var lkman = $(obj).attr('data-linkman');
                                var sex = $(obj).attr('data-sex');
                                var lkmobile = $(obj).attr('data-mobile');
                                var idcard = $(obj).attr('data-idcard');
                                $("#tourer_list").find('dl').each(function (k, t) {
                                    if ($(t).find('input').val() == '') {
                                        $(t).find('.tourman').val(lkman);
                                        if(sex == 1){
                                            $(t).find('.toursex').val('男');
                                            $($(t).find('a').get(0)).addClass('on');
                                            $($(t).find('a').get(1)).removeClass('on');
                                        }else{
                                            $(t).find('.toursex').val('女');
                                            $($(t).find('a').get(1)).addClass('on');
                                            $($(t).find('a').get(0)).removeClass('on');
                                        }
                                        $(t).find('.tourmobile').val(lkmobile);
                                        $(t).find('.tourcard').val(idcard);
                                        return false;
                                    }
                                })
                            })
                            layer.closeAll();
                        }
                    });
                }else {
                    layer.open({
                        content: '{__("error_linktel_not_login")}',
                        btn: ['确认', '取消'],
                        shadeClose: false,
                        yes: function () {
                            window.location.href = "{$cmsurl}member/login";
                        }, no: function () {
                        }
                    });
                }
            });
        });

        //提交订单
        $(".btn_book").click(function(){
            //检测购买数量
            $num=0;
            $('.people_num').find('p[id]').each(function(){
                var isshow=$(this).css('display')!='none'?true:false;
                if(!isshow){
                    return true;
                }
                $num+=parseInt($(this).find('input').val());
            });
            if($num<1){
                layer.open({
                    content: '请选择预订数量！',
                    btn: ['{__("OK")}']
                });
                return false;
            }
            $validate = requireCheck();
            if($validate){
                // var lkman = $("#linkman").val();
                // var lkmobile = $("#linktel").val();
                // var linkidcard = $("#linkidcard").val();
                // //联系人信息验证
                // if(lkman==''){
                //     layer.open({
                //         content: '{__("error_linkman_not_empty")}',
                //         btn: ['{__("OK")}']
                //     });
                //     return false;
                // }
                // //联系人手机验证
                // re = /^1\d{10}$/
                // if (!re.test(lkmobile)) {
                //     layer.open({
                //         content: '{__("error_user_phone")}',
                //         btn: ['{__("OK")}']
                //     });
                //     return false;
                // }
                // //联系人身份证验证
                // re = /^(\d{18,18}|\d{15,15}|\d{17,17}x)$/
                // if(linkidcard != ''){
                //     if (!re.test(linkidcard)) {
                //         layer.open({
                //             content: '{__("身份证不合法")}',
                //             btn: ['{__("OK")}']
                //         });
                //         return false;
                //     }
                // }
                //订单金额验证
                var totalprice = Number($('.totalprice').first().text());
                // if(totalprice==0){
                //     layer.open({
                //         content: '{__("error_no_product")}',
                //         btn: ['{__("OK")}']
                //     });
                //     return false;
                // }
                //库存验证
                var storage = $("#storage").val();
                var manNum = parseInt($('#adultnum').val());
                var childNum = parseInt($('#childnum').val());
                var oldNum = parseInt($('#oldnum').val());
                var totalNum = manNum + childNum + oldNum;

                if(storage!=-1 && (storage<totalNum)){
                    layer.open({
                        content: '{__("error_no_storage")}',
                        btn: ['{__("OK")}']
                    });
                    return false;
                }
                $("#orderfrm").submit();
            }
        });
    });


    //require 检测
    function requireCheck()
    {
        $flag = true;
        $('.require').each(function(i,obj){

            if($(obj).val()==''){
                layer.open({
                    content: '请您填写联系人信息',
                    btn: ['{__("OK")}']
                })
                $flag = false;                }
        })
        return $flag;
    }

    //重新计算价格
    function get_total_price()
    {
        var money=0;
        var manNum = Number($('#adultnum').val());
        var childNum = Number($('#childnum').val());
        var oldNum = Number($('#oldnum').val());
        var manprice = Number($('.adultprice').html());
        var childprice = Number($('.childprice').html());
        var oldprice = Number($('.oldprice').html());
        var total =ST.Math.mul(manNum,manprice);
        total=ST.Math.add(total, ST.Math.mul(childNum,childprice));
        total=ST.Math.add(total, ST.Math.mul(oldNum,oldprice));

        //积分抵现
        if($('#usejifen').val()>0 && total>0){
            money=-(parseFloat($('#jifen-price').html()));
        }
        //计算总价格
        $('.totalprice').html(total+money);
        var totalnum = manNum+childNum+oldNum;
        gen_tourer(totalnum);


    }

    //生成游客信息
    function gen_tourer(num)
    {

        var list=$('#tourer_list').find('dl').length+1;
        if(list>num){
            $('#tourer_list').find('dl:gt('+(num-1)+')').remove();
        }else{
            var out = '';
            for(var i=list;i<=num;i++){
                out+=' <dl class="radio">';
                out+='   <dt></dt>';
                out+='    <dd><strong>姓名</strong><input type="text"  name="tourname[]" placeholder="（与证件名字一致）" class="tourman require" /><span></span></dd>';
                out+='    <dd style="display: none"><strong>性别</strong><input type="hidden" name="toursex[]" class="toursex require" value="男"><a data-value="男" href="javascript:;" class="on">男</a><a data-value="女" href="javascript:;">女</a><span></span></dd>';
                out+='    <dd><strong>联系电话</strong><input type="text"  name="tourmobile[]" class="tourmobile require" placeholder="（必填）" />';
                out+='    <span></span></dd>';
                out+='    <dd><strong>身份证号</strong><input type="text"  name="touridcard[]" class="tourcard require" placeholder="（与证件号码一致）" /><span></span></dd>';
                out+=' </dl>';
            }
            $("#tourer_list").append(out);
        }
    }
    $("body").delegate(".radio a", 'click', function () {
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
        $(this).parent().children('input').val($(this).attr('data-value'));
    });


    //显示日历
    function show_calendar()
    {
        $(".mid_content").hide();
        $("#js_calendar").show();
        $(".sys_header").hide();

    }
    //隐藏日历
    function hide_calendar()
    {
        $("#js_calendar").hide();
        $(".mid_content").show();
        $(".sys_header").show();
    }

    //选择天数
    function choose_day(day,containdiv)
    {
        $("#"+containdiv).val(day);
        hide_calendar();
        get_day_price();

    }
    //日期添加
    function add_date(date,days)
    {
        var d=new Date(date);
        d.setDate(d.getDate()+days);
        var m=d.getMonth()+1;
        return d.getFullYear()+'-'+m+'-'+d.getDate();
    }




    //按套餐获取人群
    function get_people_group(suitid)
    {
        var url = SITEURL+'line/ajax_suit_people';
        $.getJSON(url,{suitid:suitid},function(data){

            if(data.useday){
                $("#startdate").val(data.useday);
            }
            if(data.storage){
                $("#storage").val(data.storage);
            }
            if(data.haschild){
                $("#child_div").show();
                $('.childprice').html(data.childprice);

            }
            if(data.hasadult){
                $("#adult_div").show();
                $('.adultprice').html(data.adultprice);
            }
            if(data.hasold){
                $("#old_div").show();
                $('.oldprice').html(data.oldprice);
            }
            //订金
            if(data.dingjin){
                $("#deposit").val(data.dingjin);
            }
            get_total_price();


        })
    }

    //获取按天数获取价格
    function get_day_price()
    {
        var suitid = $("#suitid").val();
        var useday = $("#startdate").val();
        var url = SITEURL+'line/ajax_price_day';
        $.getJSON(url,{suitid:suitid,useday:useday},function(data){


            $('.childprice').html(data.childprice);
            $('.adultprice').html(data.adultprice);
            $('.oldprice').html(data.oldprice);
            $('#storage').html(data.number);



        })
        get_total_price();

    }



</script>

</body>
</html>
