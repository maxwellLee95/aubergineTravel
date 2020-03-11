<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order extends ORM
{

    const STATUS_UNTREATED=0;//
    const STATUS_ACCEPTANCE=1;
    const STATUS_PAY=2;
    const STATUS_CANCEL=3;
    const STATUS_REFUNDED=4;
    const STATUS_FINISH=5;

    public static $statusNames=array(
        self::STATUS_UNTREATED=>'未处理',
        self::STATUS_ACCEPTANCE=>'处理中',
        self::STATUS_PAY=>'付款成功',
        self::STATUS_CANCEL=>'取消订单',
        self::STATUS_REFUNDED=>'已退款',
        self::STATUS_FINISH=>'交易完成'
    );
    /**
     * 订单是否存在
     * @param $ordersn
     * @return bool
     */
    public static function not_exists($ordersn)
    {
        $sql = "select * from sline_member_order where ordersn={$ordersn} order by id DESC limit 1";
        $rs = DB::query(Database::SELECT, $sql)->execute()->as_array();
        return empty($rs) ? true : false;
    }

    /**
     * 订单是否支付
     * @param $ordersn
     * @return bool
     */
    public static function payed($ordersn)
    {
        $sql = "select * from sline_member_order where ordersn={$ordersn}  and status=2 order by id DESC limit 1";
        $rs = DB::query(Database::SELECT, $sql)->execute()->as_array();
        return empty($rs) ? false : true;
    }

    /**
     * 订单信息并计算总价
     * @param $ordersn
     * @return array
     */
    public static function info($ordersn)
    {
        if (!preg_match('~^\d+$~', $ordersn))
        {
            return;
        }
        $sql = "select * from sline_member_order where ordersn='{$ordersn}' order by id DESC limit 1 ";

        $rs = DB::query(Database::SELECT, $sql)->execute()->current();
        $num = $rs['dingnum'] + $rs['childnum'] + $rs['oldnum'];
        if (($dingjin = $rs['dingjin']) > 0&&$rs['paytype']==2)
        {
            //定金支付
            $total = $dingjin * $num;
        }
        else
        {
            //全额支付
            $total = $rs['dingnum'] * $rs['price'] + $rs['childnum'] * $rs['childprice'] + $rs['oldnum'] * $rs['oldprice'];
        }
        //保险
        if ($rs['typeid'] == 1)
        {
            $sql = "select bookordersn,insurednum,payprice from sline_insurance_booking where bookordersn='{$ordersn}'";
            $insurance = DB::query(Database::SELECT, $sql)->execute()->as_array();
            //叠加保险金额
            foreach ($insurance as $v)
            {
                if (!empty($v['insurednum']))
                {
                    $total += $v['payprice'];
                }
            }

            if($rs['roombalance_paytype']==1)
            {
                $balanceTotal=doubleval($rs['roombalance']*intval($rs['roombalancenum']));
                $total+=$balanceTotal;
            }

        }
        //总价
        $rs['total_fee'] = $total;
        //学分抵现
        if (intval($rs['usejifen']) === 1)
        {
            $total = $total - $rs['jifentprice'];
        }
        //实际支付写入数组
        $rs['total'] = $total;
        //产品详情页
        $rs['show_url'] = Common::show_url($rs['typeid'], $rs['productaid']);
        return $rs;
    }

    /**
     * 线上支付修改订单状态
     * @param $ordersn
     * @param string $payMethod
     */
    public static function change_order($ordersn, $payMethod)
    {
        //更改订单状态
        $rows = DB::update('member_order')->where('ordersn', '=', "{$ordersn}")->set(array('status' => 2, 'paysource' => $payMethod))->execute();
        if ($rows == 1)
        {
            // 添加电子票
            self::add_eticketno($ordersn);
            //订单详情
            $result = self::info($ordersn);
            //短信通知
//            Common::send_sms_message($result);
            if ($result['typeid']==303){
                //赏金
                Model_Leader::addAmount($result['productautoid'],$result['price']);
            }

            if ($result['typeid']==1){
                //通知
                Model_Msg::msgOrderPay($result['id']);
                Model_Msg::msgDistributionOrderSuccess($result['id']);
            }

            //邮件通知
//            Common::send_email_message($result);
//            //送学分
//            if (isset($result['jifenbook']) && $result['jifenbook'] > 0)
//            {
//                $rows = DB::update('member')->where('mid', '=', $result['memberid'])->set(array('jifen' => DB::expr("jifen + {$result['jifenbook']}")))->execute();
//                //学分写入日志
//                if ($rows == 1)
//                {
//                    DB::insert('member_jifen_log', array('memberid', 'content', 'jifen', 'type', 'addtime'))->values(array($result['memberid'], "预订{$result['productname']}获得学分{$result['jifenbook']}", $result['jifenbook'], 2, time()))->execute();
//                }
//            }

        }
        else
        {
            new Pay_Exception("订单({$ordersn})线上支付状态更新失败");
        }
    }

    /**
     * 线下支付修改订单状态
     * @param $ordersn
     * @param $payMethod
     */
    public static function chang_order_by_line($ordersn, $payMethod)
    {
        //更改订单状态
        $rows = DB::update('member_order')->where('ordersn', '=', "{$ordersn}")->set(array('paysource' => $payMethod))->execute();
        if ($rows != 1)
        {
            new Pay_Exception("订单({$ordersn})线下支付状态更新失败");
        }
    }
    //add eticketno
    public static function add_eticketno($ordersn)
    {
        $eticketno = self::get_eticketno();
        DB::update('member_order')->where('ordersn', '=', "{$ordersn}")->set(array('eticketno' => $eticketno))->execute();

    }
    //获取消费码.
    public static function get_eticketno()
    {

        $eticketno = "";

        while (true)
        {
            $eticketno = substr(self::get_random_number(9), 1, 8);

            $check_sql = "SELECT id FROM `sline_member_order` WHERE eticketno='{$eticketno}'";
            $row = DB::query(1,$check_sql)->execute()->as_array();

            if (count($row) <= 0)
                break;
            sleep(1);
        }
        return $eticketno;
    }

    public static function get_random_number($length = 4)
    {
        $min = pow(10, ($length - 1));
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }


    /**
     * @param $ordersn
     * @return mixed
     * 根据ordersn获取订单信息.
     */

    public static function get_order_by_ordersn($ordersn)
    {
        $row = ORM::factory('member_order')
            ->where("ordersn='$ordersn'")
            ->find()
            ->as_array();
        return $row;
    }

}