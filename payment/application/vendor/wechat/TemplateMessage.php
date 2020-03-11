<?php
/**
 * Created by PhpStorm.
 * User: Lance
 * Date: 2018/12/23
 * Time: 15:46
 */

class TemplateMessage
{
    public function __construct()
    {
        include Kohana::find_file('vendor',"wechat/WeChatCommon");
    }


    public function send($opendid,$template_id,$data=array(),$url=null,$topcolor="#FF0000"){
        $access_token=WeChatCommon::getAccessToken();
        $api_url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
        $post_data=array(
            "touser"=>$opendid,
            "template_id"=>$template_id,
            "url"=>$url,
            "topcolor"=>$topcolor,
            "data"=>$data,
        );
        $data=WeChatCommon::api($api_url,json_encode($post_data),'POST');
        WeChatCommon::log($post_data);
        WeChatCommon::log($data);
        return $data;
    }

    //报名成功通知
    public function msgSignUpSuccess($opendid,$product_name,$date_time,$location,$count,$amount,$url,$first="恭喜你报名成功",$remark=null){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$product_name,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$date_time,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$location,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$count,
                "color"=>"#173177"
            ),
            "keyword5"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"Tu8JLKxUX5c_LFo3cVu4fvWucCVQ3nOhETNtpUYmOU8",$data,$url);
    }

    //分销订单下单成功通知
    public function msgDistributionOrderSuccess($opendid,$order,$product_name,$name,$amount,$datetime,$first="你好，已有客人下单",$remark=null){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$order,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$product_name,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$name,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "keyword5"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"8irGvuk5_E0h4hIefEfP-iZ6biB9phPeWg_wzb1sw_M",$data);
    }


    //退款通知
    public function msgOrderRefund($opendid,$reason,$amount,$first="你好，您的订单已退款",$remark=null){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$reason,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"BhnVyMrbUxk9mStI9c89vwAwo1TlarZHchrK3Ap_ge0",$data);
    }

    //活动行前通知
    public function msgActivityBegins($opendid,$datetime,$meeting_place,$material,$leader_info,$other_remind,$first="你好，您的参加的活动即将出发",$remark=null){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$meeting_place,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$material,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$leader_info,
                "color"=>"#173177"
            ),
            "keyword5"=>array(
                "value"=>$other_remind,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"G0SaeCkoCoIQcSEsodpAJIePzMTkfbJ5mScuzJ8mXgU",$data);
    }

    //活动已成行通知
    public function msgActivityLineUp($opendid,$order,$activity,$datetime,$material,$safety,$first="您好，您报名的活动已经成行，请阅读以下活动安全须知",$remark="感谢您的使用，祝户外旅途中安全、开心。"){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$order,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$activity,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$material,
                "color"=>"#173177"
            ),
            "keyword5"=>array(
                "value"=>$safety,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"_oR7ydPSPAcqdyEvBjkznZbwN1rkZpblly9IcPYbJmQ",$data);
    }


    //申请提现成功通知
    public function msgWithdrawSuccess($opendid,$amount,$datetime,$withdrawal_method="微信",$first="您好，提现成功",$remark="感谢你的使用"){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$withdrawal_method,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"adqFuUE-D6wfCblO84eo50XwJgMiFJXIML1ulplROd8",$data);
    }

    //提现申请成功通知
    public function msgWithdrawApplySuccess($opendid,$name,$amount,$datetime,$first="用户发起了提现申请",$remark="我们将尽快安排工作人员处理。"){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$name,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"JYzE1551CLb7CC5YlzqxIsrskpFg20ixi2Dk1PzgXU0",$data);
    }


    //订单取消通知
    public function msgOrderCancel($opendid,$product_name,$tourist,$reason,$amount,$order,$first="您好，您的订单已取消",$remark="如有退款金额，将原路返还您的支付账户中，请注意查收"){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$product_name,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$tourist,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$reason,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "keyword5"=>array(
                "value"=>$order,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"e_rawxXolynqgjwHoCUbHnnbq4UgtA2HlP-sR6_zmmk",$data);
    }

    //保险订单保单状态通知
    public function msgInsuranceOrder($opendid,$order,$product_name,$datetime,$status,$first="您的旅游保险订单，已为您投保完毕。请安心出游。",$remark=null){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$order,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$product_name,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$status,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"fIFGCIyGjUl7k2TPc2oz-7NIQY8LzcngdSf_LRyxvTQ",$data);
    }


    //行程结束通知
    public function msgOrderFinish($opendid,$product_name,$datetime,$first="尊敬的用户，您的行程已结束，谢谢",$remark="欢迎下次光临"){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$product_name,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$datetime,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"liQpol4ZicCS1xMnQp7Jh6YT51yboDT6c3az4UYhMMc",$data);
    }

    //分销佣金结算通知
    public function msgDistributionSettlement($opendid,$order,$order_status,$price,$amount,$order_type="户外游",$first="恭喜你有新的分销佣金入账",$remark=null){
        $data=array(
            "first"=>array(
                "value"=>$first,
                "color"=>"#173177",
            ),
            "keyword1"=>array(
                "value"=>$order,
                "color"=>"#173177"
            ),
            "keyword2"=>array(
                "value"=>$order_type,
                "color"=>"#173177"
            ),
            "keyword3"=>array(
                "value"=>$order_status,
                "color"=>"#173177"
            ),
            "keyword4"=>array(
                "value"=>$price,
                "color"=>"#173177"
            ),
            "keyword5"=>array(
                "value"=>$amount,
                "color"=>"#173177"
            ),
            "remark"=>array(
                "value"=>$remark,
                "color"=>"#173177"
            ),
        );
        return self::send($opendid,"uV8Qfm-wDtTVqp1DQoLZekXF7F0tc4HigcmH7-IAgbQ",$data);
    }






}