<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {template 'stourtravel/public/public_js'}
    <style>
        *{
            padding:0px;
            margin:0}
        html,body{
            width:100%;
            height:100%;
            font-size:12px;
            font-family:Arial, Helvetica, sans-serif;
        }
        h1,h2,h3,h4,h5{
            font-size:14px}
        a{
            color:#464646;
            text-decoration:none}
        a:hover{
            color:#f60;
            text-decoration:underline}
        a,input,textarea{
            outline:none;
            resize:none;}
        s,i{
            text-decoration:none; font-style:normal}
        .color_f60{
            color:#f60}
        li{
            list-style:none}
        img{
            border:none}
        .fl{
            float:left}
        .fr{
            float:right}
        .clear{
            clear:both}
        table {
            border-collapse: collapse;
            border-spacing: 0;
            float:left;

        }
        table .num {
            float: left;
            width: 100%;
            height: 20px;
            line-height: 20px;
            text-align: center;
        }
        .tab{
            height:600px;
            padding-left:10px;
            float:left;
        }
        table td {
            border: 1px solid #dcdcdc;
            width:54px;
            max-height:67px;

        }
        .top_title{border: 1px solid #fff;line-height: 25px;}
        table .yes_yd {
            color: #f60;
            float: left;
            width: 100%;
            height: 25px;
            line-height: 25px;
            text-align: center;
        }
        .tab table .line_yes_yd{
            color: #f60;
            float: left;
            width: 100%;
            line-height: 16px;
            text-align: center;
            height: 16px;
        }
        .tab table .roombalance_b{
            color: #f60;
            font-weight: 300;
            font-size:11px;
            display: none;
        }
        .kucun{
            float: left;
            color: #ccc;
            width: 100%;
            height: 20px;
            line-height: 20px;
            text-align: center;
            font-weight: 400;
        }
        #tabl tr td{
            height: 50px;
        }
    </style>
</head>
<body style="background-color: #fff">

{$calendar}
<input type="hidden" id="typeid" value="{$typeid}">
<script language="javascript">

    var typeid="{$typeid}";
    var all_leaders=<?php echo json_encode($all_leaders)?>;
    //修改单独报价
    function  modPrice(obj)
    {
        var price = $(obj).attr('data-price');//
        var profit = $(obj).attr('data-profit');
        var basicprice = $(obj).attr('data-basicprice');
        var suitid = $(obj).attr('data-suitid');
        var day = $(obj).attr('data-day');
        var daydate =$(obj).attr('data-date');
        var typeid = $("#typeid").val();
        var group = $(obj).attr('data-group');//人群
        var productid=$(obj).attr('data-productid');

        //小孩
        var child_price = $(obj).attr('data-child-price');//
        var child_profit = $(obj).attr('data-child-profit');
        var child_basicprice = $(obj).attr('data-child-basicprice');

        //老人
        var old_price = $(obj).attr('data-old-price');//
        var old_profit = $(obj).attr('data-old-profit');
        var old_basicprice = $(obj).attr('data-old-basicprice');

        //库存
        var number = $(obj).attr('data-number');

        var roombalance=$(obj).attr('data-roombalance');

        var leader_id=$(obj).attr('data-leader_id');
        var leader_id2=$(obj).attr('data-leader_id2');
        var leader_id3=$(obj).attr('data-leader_id3');
        var leader_id4=$(obj).attr('data-leader_id4');
        var leader_id5=$(obj).attr('data-leader_id5');
        console.log(leader_id);


        var groupArr = group.split(',');


       // var title = typeid==1 ? '成人价格' : '价格';
        var html = '<table id="tabl">';
        var title='产品';
        if(typeid==1){
            title='成人';
        }
        //成人
           if($.inArray('2',groupArr)!=-1){
               html+= '<tr>' +
                    '<td>'+title+'报价:</td>' +
                    '<td>成本<input type="text" size="5" onkeyup="calPrice(this)" class="txt" id="basicprice" name="adultbasicprice"  value="'+basicprice+'"/></td>' +
                    '<td>&nbsp;利润<input type="text" size="5"  onkeyup="calPrice(this)" class="txt" id="profit" name="adultprofit" value="'+profit+'"/></td>' +
                    '<td class="tprice"><font color="#FF9900">'+price+'</font>元</td>' +
                    '</tr>'


            }
        //小孩
        if($.inArray('1',groupArr)!=-1){
            html+= '<tr>' +
                '<td>小孩价格:</td>' +
                '<td>成本<input type="text" size="5" onkeyup="calPrice(this)" class="txt" id="child_basicprice" name="child-basicprice"  value="'+child_basicprice+'"/></td>' +
                '<td>&nbsp;利润<input type="text" size="5"  onkeyup="calPrice(this)" class="txt" id="child_profit" name="child-profit" value="'+child_profit+'"/></td>' +
                '<td class="tprice"><font color="#FF9900">'+child_price+'</font>元</td>' +
                '</tr>'


        }
        //老人
        if($.inArray('3',groupArr)!=-1){
            html+= '<tr>' +
                '<td>老人价格:</td>' +
                '<td>成本<input type="text" size="5" onkeyup="calPrice(this)" class="txt" id="old_basicprice" name="old-basicprice"  value="'+old_basicprice+'"/></td>' +
                '<td>&nbsp;利润<input type="text" size="5"  onkeyup="calPrice(this)" class="txt" id="old_profit" name="old-profit" value="'+old_profit+'"/></td>' +
                '<td class="tprice"><font color="#FF9900">'+old_price+'</font>元</td>' +
                '</tr>'


        }
        if(typeid==1)
        {
            html+='<tr style="display: none">'+
                '<td>单房差:</td>'+
                '<td colspan="3"><input type="text" size="5" class="txt" id="roombalance" value="'+roombalance+'"/></td>'
                '</tr>';
            html+='<tr>'+
                '<td>主领队:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id',leader_id) +
                '</td>'
            '</tr>';

            html+='<tr>'+
                '<td>副领队1:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id2',leader_id2) +
                '</td>'
            '</tr>';
            html+='<tr>'+
                '<td>副领队2:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id3',leader_id3) +
                '</td>'
            '</tr>';
            html+='<tr>'+
                '<td>副领队3:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id4',leader_id4) +
                '</td>'
            '</tr>';
            html+='<tr>'+
                '<td>副领队4:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id5',leader_id5) +
                '</td>'
            '</tr>';
        }
        //库存
        html+= '<tr>' +
            '<td>产品库存:</td>' +
            '<td colspan="3"><input type="text" size="5" class="txt" id="number" name="number"  value="'+number+'"/></td>' +

            '</tr>'



            html+=  '</table>';
            html+= "<style>" +
                "#tabl tr td{height:50px;font-size:12px;}"+
                "</style>";

        parent.window.dialog({
            title: daydate+'价格修改',
            okValue:'确定',
            content:html,
            ok: function () {

                //成人
                var basicprice = $("#basicprice",parent.document).val();
                var profit = $("#profit",parent.document).val();
                //小孩
                var child_basicprice = $("#child_basicprice",parent.document).length>0 ? $("#child_basicprice",parent.document).val() : 0;
                var child_profit = $("#child_profit",parent.document).length>0 ? $("#child_profit",parent.document).val() : 0;
                //老人
                var old_basicprice = $("#old_basicprice",parent.document).length>0 ? $("#old_basicprice",parent.document).val() : 0;
                var old_profit = $("#old_profit",parent.document).length>0 ? $("#old_profit",parent.document).val() : 0;

                //库存
                var number = $("#number",parent.document).val();
                var roombalance=0;
                var leader_id=0;
                var leader_id2=0;
                var leader_id3=0;
                var leader_id4=0;
                var leader_id5=0;
                if(typeid==1)
                {
                    roombalance=$("#roombalance",parent.document).val();
                    leader_id=$("#leader_id",parent.document).val();
                    leader_id2=$("#leader_id2",parent.document).val();
                    leader_id3=$("#leader_id3",parent.document).val();
                    leader_id4=$("#leader_id4",parent.document).val();
                    leader_id5=$("#leader_id5",parent.document).val();

                }

                var params={
                    basicprice:basicprice,
                    profit:profit,
                    child_basicprice:child_basicprice,
                    child_profit:child_profit,
                    old_basicprice:old_basicprice,
                    old_profit:old_profit,
                    number:number,
                    roombalance:roombalance,
                    productid:productid,
                    leader_id:leader_id,
                    leader_id2:leader_id2,
                    leader_id3:leader_id3,
                    leader_id4:leader_id4,
                    leader_id5:leader_id5
                }
                params.suitid = suitid;
                params.day = day;
                params.typeid = typeid;

                 $.ajax({
                 type:"POST",
                 url: SITEURL+'calendar/ajax_modprice',
                 data: params,
                 dataType: 'json',
                 success: function(data)
                 {

                 if(data.status==true){

                     ST.Util.showMsg('保存成功',4,1000)
                     $(obj).find('.yes_yd').html('¥'+data.price);
                     $(obj).find('.kucun').html('库存:'+data.number);
                     $(obj).attr('data-number',data.number);
                     //成人
                     $(obj).attr('data-price',data.price);//
                     $(obj).attr('data-profit',data.profit);
                      $(obj).attr('data-basicprice',data.basicprice);

                     //小孩
                      $(obj).attr('data-child-price',data.child_price);//
                      $(obj).attr('data-child-profit',data.child_profit);
                      $(obj).attr('data-child-basicprice',data.child_basicprice);

                     //老人
                      $(obj).attr('data-old-price',data.old_price);//
                      $(obj).attr('data-old-profit',data.old_profit);
                      $(obj).attr('data-old-basicprice',data.old_basicprice);
                      if(typeid==1) {
                          $(obj).attr('data-roombalance', data.roombalance);
                          $(obj).find('.roombalance_b').html('单房差:'+data.roombalance);

                          $(obj).attr('data-leader_id',data.leader_id);
                          $(obj).attr('data-leader_id2',data.leader_id2);
                          $(obj).attr('data-leader_id3',data.leader_id3);
                          $(obj).attr('data-leader_id4',data.leader_id4);
                          $(obj).attr('data-leader_id5',data.leader_id5);

                      }
                 };

                 }
                 })

            }
        }).show();

        //$.jBox(html, {title: daydate+'价格修改', width:340,top:'30%',submit:submit});
    }


    function leader_list(name,id){

        var html='';
        html+='<select  id="'+name+'" name="'+name+'">';
        html+='<option value="0" >请选择领队</option>';
        $.each(all_leaders,function(k,v){
            var s='';
            if (k==id){
                s='selected';
            }
            html+='<option '+s+'  value="'+k+'">'+v['nickname']+'</option>';
        });
        html+='</select>';
        return html;
    }

    //添加单独报价
    function addPrice(obj)
    {


        var suitid = $(obj).attr('data-suitid');
        var productid=$(obj).attr('data-productid');
        var day =$(obj).attr('data-day');
        var daydate =$(obj).attr('data-date');
        var typeid = $("#typeid").val();
        var group = $(obj).attr('data-group');//人群



       // var html = '<table><tr><td>成人价格:</td><td>成本<input type="text" class="txt" size="5" onkeyup="calPrice(this)" name="adultbasicprice" id="basicprice"/></td><td>利润<input type="text" onkeyup="calPrice(this)" class="txt" size="5" name="adultprofit" id="profit"/></td><td class="tprice"><font color="#FF9900"></font>元</td></tr></table>';
        var groupArr = group.split(',');


        //var title = typeid==1 ? '成人价格' : '价格';
        var html = '<table id="tabl">';

        //成人
        if($.inArray('2',groupArr)!=-1){
            html+= '<tr>' +
                '<td>成人报价:</td>' +
                '<td>成本<input type="text" size="5" onkeyup="calPrice(this)" class="txt" id="basicprice" name="adultbasicprice"  value=""/></td>' +
                '<td>&nbsp;利润<input type="text" size="5"  onkeyup="calPrice(this)" class="txt" id="profit" name="adultprofit" value=""/></td>' +
                '<td class="tprice"><font color="#FF9900"></font>元</td>' +
                '</tr>'


        }
        //小孩
        if($.inArray('1',groupArr)!=-1){
            html+= '<tr>' +
                '<td>小孩价格:</td>' +
                '<td>成本<input type="text" size="5" onkeyup="calPrice(this)" class="txt" id="child_basicprice" name="child-basicprice"  value=""/></td>' +
                '<td>&nbsp;利润<input type="text" size="5"  onkeyup="calPrice(this)" class="txt" id="child_profit" name="child-profit" value=""/></td>' +
                '<td class="tprice"><font color="#FF9900"></font>元</td>' +
                '</tr>'


        }
        //老人
        if($.inArray('3',groupArr)!=-1){
            html+= '<tr>' +
                '<td>老人价格:</td>' +
                '<td>成本<input type="text" size="5" onkeyup="calPrice(this)" class="txt" id="old_basicprice" name="old-basicprice"  value=""/></td>' +
                '<td>&nbsp;利润<input type="text" size="5"  onkeyup="calPrice(this)" class="txt" id="old_profit" name="old-profit" value=""/></td>' +
                '<td class="tprice"><font color="#FF9900"></font>元</td>' +
                '</tr>'


        }

        if(typeid==1)
        {
            html+='<tr style="display: none">'+
            '<td>单房差:</td>'+
            '<td colspan="3"><input type="text" size="5" class="txt" id="roombalance" value=""/></td>'
            '</tr>';

            html+='<tr>'+
                '<td>主领队:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id','') +
                '</td>'
            '</tr>';

            html+='<tr>'+
                '<td>副领队1:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id2','') +
                '</td>'
            '</tr>';
            html+='<tr>'+
                '<td>副领队2:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id3','') +
                '</td>'
            '</tr>';
            html+='<tr>'+
                '<td>副领队3:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id4','') +
                '</td>'
            '</tr>';
            html+='<tr>'+
                '<td>副领队4:</td>'+
                '<td colspan="3">' +
                leader_list('leader_id5','') +
                '</td>'
            '</tr>';




        }
        //库存
        html+= '<tr>' +
            '<td>产品库存:</td>' +
            '<td colspan="3"><input type="text" size="5" class="txt" id="number" name="number"  value=""/></td>' +

            '</tr>'



        html+=  '</table>';
        html+= "<style>" +
            "#tabl tr td{height:50px;font-size:12px;}"+
            "</style>";



        parent.window.dialog({
            title: daydate+'价格添加',
            okValue:'确定',
            content:html,
            ok: function () {


                //成人
                var basicprice = $("#basicprice",parent.document).val();
                var profit = $("#profit",parent.document).val();
                //小孩
                var child_basicprice = $("#child_basicprice",parent.document).length>0 ? $("#child_basicprice",parent.document).val() : 0;
                var child_profit = $("#child_profit",parent.document).length>0 ? $("#child_profit",parent.document).val() : 0;
                //老人
                var old_basicprice = $("#old_basicprice",parent.document).length>0 ? $("#old_basicprice",parent.document).val() : 0;
                var old_profit = $("#old_profit",parent.document).length>0 ? $("#old_profit",parent.document).val() : 0;

                //库存
                var number = $("#number",parent.document).val();
                var roombalance=0;

                var leader_id=0;
                var leader_id2=0;
                var leader_id3=0;
                var leader_id4=0;
                var leader_id5=0;

                if(typeid==1)
                {
                    roombalance=$("#roombalance",parent.document).val();

                    leader_id=$("#leader_id",parent.document).val();
                    leader_id2=$("#leader_id2",parent.document).val();
                    leader_id3=$("#leader_id3",parent.document).val();
                    leader_id4=$("#leader_id4",parent.document).val();
                    leader_id5=$("#leader_id5",parent.document).val();

                }


                var params={
                    basicprice:basicprice,
                    profit:profit,
                    child_basicprice:child_basicprice,
                    child_profit:child_profit,
                    old_basicprice:old_basicprice,
                    old_profit:old_profit,
                    roombalance:roombalance,
                    number:number,
                    leader_id:leader_id,
                    leader_id2:leader_id2,
                    leader_id3:leader_id3,
                    leader_id4:leader_id4,
                    leader_id5:leader_id5
                }
                params.suitid = suitid;
                params.day = day;
                params.typeid = typeid;
                params.productid = productid;

                $.ajax({
                    type:"POST",
                    url: SITEURL+'calendar/ajax_addprice',
                    data: params,
                    dataType: 'json',
                    success: function(data)
                    {

                        if(data.status==true){

                            ST.Util.showMsg('保存成功',4,1000)
                            $(obj).find('.no_yd').html('¥'+data.price);
                            $(obj).find('.no_yd').removeClass('no_yd').addClass('yes_yd');
                            $(obj).find('.kucun').html('库存:'+data.number);


                            $(obj).attr('data-number',data.number);
                            //成人
                            $(obj).attr('data-price',data.price);//
                            $(obj).attr('data-profit',data.profit);
                            $(obj).attr('data-basicprice',data.basicprice);

                            //小孩
                            $(obj).attr('data-child-price',data.child_price);//
                            $(obj).attr('data-child-profit',data.child_profit);
                            $(obj).attr('data-child-basicprice',data.child_basicprice);

                            //老人
                            $(obj).attr('data-old-price',data.old_price);//
                            $(obj).attr('data-old-profit',data.old_profit);
                            $(obj).attr('data-old-basicprice',data.old_basicprice);

                            if(typeid==1) {
                                $(obj).attr('data-roombalance', data.roombalance);
                                $(obj).find('.roombalance_b').text('单房差:'+data.roombalance);

                                $(obj).attr('data-leader_id',data.leader_id);
                                $(obj).attr('data-leader_id2',data.leader_id2);
                                $(obj).attr('data-leader_id3',data.leader_id3);
                                $(obj).attr('data-leader_id4',data.leader_id4);
                                $(obj).attr('data-leader_id5',data.leader_id5);
                            }

                            $(obj).removeAttr('onclick');
                            $(obj).click(function(){
                                modPrice(obj);
                            })

                        };

                    }
                })

            }
        }).show();


    }
    function calPrice(obj)
    {
        var trs=$(obj).parents('tr:first');
        var tprice=0;
        trs.find('input:text').each(function(index, element) {
            var price=parseInt($(element).val());
            if(!isNaN(price))
                tprice+=price;
        });
        trs.find(".tprice").html("<font color='#FF9900'>"+tprice+"</font>元");
    }
</script>

</body>
</html>