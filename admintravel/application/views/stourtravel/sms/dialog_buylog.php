<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>茄子户外运动</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("DatePicker/WdatePicker.js"); }
    {php echo Common::getCss('base.css,sms_dialog.css'); }

</head>
<body >
   <div class="s-main">
        <div class="search-con">
            <input type="text" class="time-txt" name="querydate" id="querydate" onclick="WdatePicker({maxDate:'%y-%M-%d'})"/><span>至今天</span><a href="javascript:;" id="search_btn" class="normal-btn">查询</a>
        </div>
        <div class="s-list">
            <table class="tb-list" id="buy_list" border="1px" bordercolor="#dcdcdc" cellspacing="0px" style="border-collapse:collapse">
                <tr>
                    <th width="20%">时间</th>
                    <th width="60%" align="left">订单号</th>
                    <th width="10%">短信条数</th>
                    <th width="10%">价格</th>
                </tr>
            </table>

        </div>
   </div>

<script>
    $(document).ready(function(){
        $("#search_btn").click(function(){
              var date=$("#querydate").val();
              var url=SITEURL+'sms/ajax_query/querytype/buylog/querydate/'+date;
            $.ajax({
                type: 'GET',
                url: url ,
                dataType:'json',
                success: function(data)
                {
                    $("#buy_list .item").remove();
                    var html='';
                    for(var i in data)
                    {
                       var row=data[i];
                       html+='<tr class="item"> <td align="center">'+row['ConsumeTime']+'</td>'+
                            '<td class="msg-con">'+row['StourwebOrderNo']+'</td>'+
                            '<td align="center">'+row['BuySMSNum']+'</td>'+
                            '<td align="center">'+row['OrderMoney']+'</td></tr>';
                    }
                    $("#buy_list").append(html);
                }
            });



        });


    });
</script>
</body>
</html>
