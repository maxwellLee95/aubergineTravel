$('document').ready(function(){
    //初始化
    if($('.payment-line').find('li.active')){
        $('#st-payment-submit').removeClass('error');
    }
    //选择支付方式
    $('.payment-line').find('li').click(function(){
        $('.payment-line').find('li').removeClass('active');
        $(this).addClass('active');
        $('#st-payment-submit').removeClass('error');
    });
    $('#st-payment-submit').click(function(){
        var selectedLi=$('.payment-line').find('li.active');
        var len=selectedLi.length;
        if(len!=1){
            return;
        }
        param.method=selectedLi.attr('data');
        $url=new Array();
        for(key in param){
            $url.push(key+'='+param[key]);
        }
        $('#st-payment-back-box').css('display','block');
        window.open("/payment/index/confirm?"+$url.join('&'));
    });
    //支付失败
    $('#st-payment-back-error').click(function(){
        $('#st-payment-back-box').css('display','none');
    });
    //支付成功
    /*$('#st-payment-back-success').click(function(){
        $.post('/payment/index/ajax_ispay',param,function(url){
            if(url!=0){
                  window.location.href=url;
            }else{
                $('#st-payment-back-box').css('display','none');
            }
        })
    });*/

});

