<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * 独立模块
 * Class Model_Wechatmsg
 */
class Model_Msg extends ORM
{


    public static function loadWeChatTemplate(){
        if(!class_exists('TemplateMessage'))
        {
            include Kohana::find_file('vendor',"wechat/TemplateMessage");
        }
    }

    /**
     * 订单消息
     * @param $orderId
     */
    public static function msgOrderPay($orderId){
        self::loadWeChatTemplate();
        $templateMessage=new TemplateMessage();
        if ($orderId){
            $order=self::getOrder($orderId);
            if ($order && $order['status']==2){
                $marshal_point=self::getMarshalPoint($order['marshal_point_id']);
                $member=self::getMember($order['memberid']);
                $day=strtotime($order['usedate']);
                $url=self::phoneUrl("lines/show_".$order['productaid'].".html?suitid={$order['suitid']}&day={$day}");
                if ($member){
                    $templateMessage->msgSignUpSuccess(
                        $member['connectid'],
                        $order['productname'],
                        $order['usedate'],
                        $marshal_point['name'],
                        $order['dingnum'],
                        $order['price']*$order['dingnum'],
                        $url
                    );
                }
                if ($order['productautoid'] && $order['suitid']  && $day){
                    $suit =self::getSuitPrice($order['productautoid'],$order['suitid'],$day);
                    $leader_ids=self::leaderFormatIds($suit);
                    if ($leader_ids){
                        $leader_user=self::getLeaderMember($leader_ids);
                        if ($leader_user){
                            foreach ($leader_user as $user){
                                $templateMessage->msgSignUpSuccess(
                                    $user['connectid'],
                                    $order['productname'],
                                    $order['usedate'],
                                    $marshal_point['name'],
                                    $order['dingnum'],
                                    $order['price']*$order['dingnum'],
                                    $url,
                                    '有新学员加入！'
                                );
                            }
                        }
                    }
                }

            }

        }
    }

    /**
     * 订单取消
     * @param $orderId
     * @param null $msg
     */
    public static function msgOrderCancel($orderId,$msg=null){
        if ($orderId){
            $order=self::getOrder($orderId);
            if ($order && $order['status']==3){
                $member=self::getMember($order['memberid']);
                $day=strtotime($order['usedate']);
                if ($member){
                    self::loadWeChatTemplate();
                    $templateMessage=new TemplateMessage();
                    $templateMessage->msgOrderCancel(
                        $member['connectid'],
                        $order['productname'],
                        $member['nickname'],
                        $msg,
                        $order['price']*$order['dingnum'],
                        $order['ordersn']
                    );
                }
                if ($order['productautoid'] && $order['suitid']  && $day){
                    $suit =self::getSuitPrice($order['productautoid'],$order['suitid'],$day);
                    $leader_ids=self::leaderFormatIds($suit);
                    if ($leader_ids){
                        $leader_user=self::getLeaderMember($leader_ids);
                        if ($leader_user){
                            foreach ($leader_user as $user){
                                $templateMessage->msgOrderCancel(
                                    $user['connectid'],
                                    $order['productname'],
                                    $user['nickname'],
                                    '有学员退出活动了',
                                    $order['price']*$order['dingnum'],
                                    $order['ordersn']
                                );
                            }
                        }
                    }
                }

            }
        }
    }


    /**
     * 订单退款
     * @param $orderSn
     * @param null $msg
     */
    public static function msgOrderRefund($orderSn,$msg=null){
        if ($orderSn){
            $order=self::getOrderByOrderSn($orderSn);
            $orderRefund=self::getOrderRefundByOrderSn($orderSn);
            if ($order && $orderRefund && $orderRefund['status']==1){
                $member=self::getMember($order['memberid']);
                if ($member){
                    self::loadWeChatTemplate();
                    $templateMessage=new TemplateMessage();
                    $templateMessage->msgOrderRefund(
                        $member['connectid'],
                        $msg,
                        $orderRefund['refund_fee']
                    );
                }

            }

        }

    }


    /**
     * 订单完成
     * @param $orderId
     */
    public static function msgOrderFinish($orderId){
        if ($orderId){
            $order=self::getOrder($orderId);
            if ($order && $order['status']==5){
                $member=self::getMember($order['memberid']);
                if ($member){
                    self::loadWeChatTemplate();
                    $templateMessage=new TemplateMessage();
                    $templateMessage->msgOrderFinish(
                        $member['connectid'],
                        $order['productname'],
                        date('Y-m-d H:i:s')
                    );
                }

            }

        }

    }


    /**
     * 分销下单
     * @param $orderId
     */
    public static function msgDistributionOrderSuccess($orderId){
        if ($orderId){
            $order=self::getOrder($orderId);
            $distributionRecord=self::getDistributionRecord($orderId);
            $form_member=self::getMember($distributionRecord['form_memberid']);
            $to_memberid=self::getMember($distributionRecord['to_memberid']);
            if ($order && $distributionRecord && $form_member && $to_memberid){
                self::loadWeChatTemplate();
                $templateMessage=new TemplateMessage();
                $templateMessage->msgDistributionOrderSuccess(
                    $form_member['connectid'],
                    $order['ordersn'],
                    $order['productname'],
                    $to_memberid['nickname'],
                    $distributionRecord['commission'],
                    date("Y-m-d H:i:s",$distributionRecord['add_time'])
                );
            }

        }

    }

    /**
     * 分销结算
     * @param $orderId
     * @param null $msg
     */
    public static function msgDistributionSettlement($orderId,$msg=null){
        if ($orderId){
            $order=self::getOrder($orderId);
            $distributionRecord=self::getDistributionRecord($orderId);
            $form_member=self::getMember($distributionRecord['form_memberid']);
            if ($order && $distributionRecord['status']==2 && $form_member){
                self::loadWeChatTemplate();
                $templateMessage=new TemplateMessage();
                $templateMessage->msgDistributionSettlement(
                    $form_member['connectid'],
                    $order['ordersn'],
                    $msg,
                    $distributionRecord['order_price'],
                    $distributionRecord['commission']
                );
            }

        }

    }

    /**
     * 提现申请
     * @param $id
     */
    public static function msgWithdrawApplySuccess($id){
        $commission=self::getCommission($id);
        if ($commission){
            $member=self::getMember($commission['memberid']);
            if ($member){
                self::loadWeChatTemplate();
                $templateMessage=new TemplateMessage();
                $templateMessage->msgWithdrawApplySuccess(
                    $member['connectid'],
                    $member['nickname'],
                    $commission['amount'],
                    date('Y-m-d H:i:s')
                );
            }
        }
    }


    /**
     * 提现成功
     * @param $id
     */
    public static function msgWithdrawSuccess($id){
        $commission=self::getCommission($id);
        if ($commission && $commission['status']==1){
            $member=self::getMember($commission['memberid']);
            if ($member){
                self::loadWeChatTemplate();
                $templateMessage=new TemplateMessage();
                $templateMessage->msgWithdrawSuccess(
                    $member['connectid'],
                    $member['amount'],
                    date('Y-m-d H:i:s')
                );
            }
        }
    }



    public static function getCommission($id){
        if ($id){
            $sql= "select * from sline_commission where id='{$id}'";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }


    public static function getMemberByDistributionId($distributionId){
        if ($distributionId){
            $sql= "select * from sline_member where distribution_id='{$distributionId}'";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }


    public static function getDistributionRecord($orderId){
        if ($orderId){
            $sql= "select * from sline_distribution_record where order_id='{$orderId}'";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }


    public static function getLeaderMember($ids){
        $leader_ids=implode(",",$ids);
        if ($leader_ids){
            $leader_sql="select m.* from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
                ." WHERE  l.id in(".$leader_ids.") AND  l.status=1 "
                ." ORDER BY FIELD('id',".$leader_ids.") ";
            return DB::query(Database::SELECT,$leader_sql)->execute()->as_array();
        }

    }


    public static function getOrderRefundByOrderSn($orderSn){
        if ($orderSn){
            $sql= "select * from sline_member_order_refund where ordersn='{$orderSn}'";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }


    public static function getMember($id){
        if ($id){
            $sql= "select * from sline_member where mid='{$id}'";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }

    public static function getOrder($id){
        if ($id){
            $sql="select * from sline_member_order where id='{$id}'";
            return DB::query(Database::SELECT, $sql)->execute()->current();
        }
    }

    public static function getOrderByOrderSn($orderSn){
        if ($orderSn){
            $sql="select * from sline_member_order where ordersn='{$orderSn}'";
            return DB::query(Database::SELECT, $sql)->execute()->current();
        }
    }


    public static function getMarshalPoint($marshalPointId){
        if ($marshalPointId){
            $sql="select * from sline_marshal_point where id='{$marshalPointId}'";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }

    public static function getSuitPrice($lineId,$suitId,$day){
        if ($lineId  && $suitId && $day){
            $sql = "SELECT *  FROM  sline_line_suit_price Where  day={$day} AND  suitid={$suitId} AND lineid={$lineId}";
            return DB::query(1,$sql)->execute()->current();
        }

    }

    public static function phoneUrl($uri){
        return 'http://www.168hike.com/phone/'.$uri;
    }

    public static function leaderFormatIds($info){
        $res=array();
        if (!empty($info['leader_id'])){
            $res[]=$info['leader_id'];
        }
        if (!empty($info['leader_id2'])){
            $res[]=$info['leader_id2'];
        }
        if (!empty($info['leader_id3'])){
            $res[]=$info['leader_id3'];
        }
        if (!empty($info['leader_id4'])){
            $res[]=$info['leader_id4'];
        }
        if (!empty($info['leader_id5'])){
            $res[]=$info['leader_id5'];
        }
        return $res;
    }




}