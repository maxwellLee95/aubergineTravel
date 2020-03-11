<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order extends ORM {



    const STATUS_UNTREATED=0;
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
    /*
     * 返学分操作
     * */
    public static function refundJifen($orderid)
    {
        if ($orderid){
            $row = ORM::factory('member_order')->where("id={$orderid}")->find()->as_array();

            if(isset($row)) {

                $memberid = $row['memberid'];
                $jifenbook = intval($row['jifenbook']);
                if (!Model_Member_Jifen_Log::isOrderRecord($orderid,$memberid)){
                    $tMsg="预订{$row['productname']}获得{$jifenbook}学分";
                    Common::operateIntegral($memberid,$jifenbook,$tMsg,Model_Member_Jifen_Log::TYPE_INCREASE,Model_Member_Jifen_Log::ACTION_ORDER,array('orderid'=>$orderid));
                }

            }
        }

    }

    public static function addJifenLog($memberid,$content,$jifen,$type,$orderid=0)
    {
        $model=ORM::factory('member_jifen_log');
        $model->memberid=$memberid;
        $model->content=$content;
        $model->jifen=$jifen;
        $model->type=$type;
        $model->orderid=$orderid;
        $model->addtime=time();
        $model->create();

    }


    /*
     * 返库存操作
     * */
    public static function refundStorage($orderid,$op)
    {
        $row = ORM::factory('member_order')->where('id='.$orderid)->find()->as_array();
        if(isset($row))
        {
            $dingnum = intval($row['dingnum'])+intval($row['childnum']);
            $suitid = $row['suitid'];
            $productid = $row['productautoid'];
            $typeid = $row['typeid'];
            $usedate = strtotime($row['usedate']);


            $storage_table=array(
                    '1'=>'sline_line_suit_price',
                    '2'=>'sline_hotel_room_price',
                    '3'=>'sline_car_suit_price',
                    '5'=>'sline_spot_ticket',
                    '8'=>'sline_visa',
                    '13'=>'sline_tuan'
            );
            $table = $storage_table[$typeid];
            if(empty($table))
                return;
            //加库存
            if($op=='plus')
            {
                if($typeid==1||$typeid==2||$typeid==3)
                 $sql = "update {$table} set number=number+$dingnum where day='$usedate' and suitid='$suitid'";
                elseif($typeid==13)
                 $sql = "update {$table} set totalnum=CAST(totalnum AS SIGNED)+$dingnum where id=$productid";
                elseif($typeid==5)
                    $sql = "update {$table} set number=number+$dingnum where id='$suitid'";
                else
                 $sql = "update {$table} set number=number+$dingnum where id=$productid";
            }
            else if($op=='minus')
            {
                if($typeid==1||$typeid==2||$typeid==3)
                    $sql = "update {$table} set number=number-$dingnum where day='$usedate' and suitid='$suitid'";
                elseif($typeid==13)
                    $sql = "update {$table} set totalnum=CAST(totalnum AS SIGNED)-$dingnum where id=$productid";
                elseif($typeid==5)
                    $sql = "update {$table} set number=number-$dingnum where id='$suitid'";
                else
                    $sql = "update {$table} set number=number-$dingnum where id=$productid";
            }
            DB::query(2,$sql)->execute();
        }

    }
    public static function getStatusName($key)
    {
        return self::$statusNames[$key];
    }
    public static function getStatusNamesJs()
    {
        $jsonArr=array();
        foreach(self::$statusNames as $k=>$v)
        {
            $jsonArr[]=array('status'=>$k,'name'=>$v);
        }
        return $jsonArr;
    }
    public static function getPaySources()
    {
        $sql="select paysource from sline_member_order where paysource is not null group by paysource";
        $result=DB::query(Database::SELECT,$sql)->execute()->as_array();
        $arr=array();
        foreach($result as $k=>$v)
        {
            $arr[]=$v['paysource'];
        }
        return $arr;
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
        return $rs;
    }

    public static function orderFinish($id){
        Model_Member_Order::refundJifen($id);
    }

    public static function getItem($id){
        $sql = "select * from sline_member_order where id='{$id}'";
        return DB::query(Database::SELECT, $sql)->execute()->current();
    }

}