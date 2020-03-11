<?php
defined('SYSPATH') or die('No direct access allowed.');

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
     * @param int $id
     * @param $typeid
     * @param null $row
     * @return int
     * @description
     */
    public static function get_sell_num($id = 0, $typeid)
    {


        $id = $row != null ? $row['id'] : $id;
        $where = empty($id) ? "typeid='$typeid'" : "productautoid='$id' and typeid='$typeid'";
        $m = ORM::factory('member_order')
            ->where($where)
            ->get_all();
        $num = count($m);
        return $num ? $num : 0;

    }


    public static function get_suit_sell_num($id, $typeid,$suitid,$day,$status=self::STATUS_PAY)
    {
        if ($id && $typeid && $suitid && $day){
            $sql="select sum(dingnum) AS total from sline_member_order "
                ." where typeid={$typeid} AND productautoid={$id} "
                ." AND status= ".$status." AND suitid={$suitid} AND usedate='".date('Y-m-d',$day)."'";
            $arr = DB::query(1, $sql)->execute()->current();
        }
        return !empty($arr['total'])?$arr['total']:0;
    }

    /**
     * @param $orderid
     * @return array
     * 获取订单详情.
     */

    public static function get_order_detail($orderid)
    {
        $row = ORM::factory('member_order', $orderid)->as_array();
        return $row;
    }

    /**
     * 订单列表
     * @param $mid
     * @param $page
     * @return mixed
     */
    public static function order_list($mid, $page = 1,$pagesize=10,$typeid=null,$status=array())
    {
        $offset = ($page - 1) * 10;
        $sql = "SELECT * FROM sline_member_order ";
        $sql .= " WHERE pid=0  AND memberid={$mid} ";
        if(!empty($typeid))
        {
            $sql.= " AND typeid=$typeid";
        }
        if(!empty($status))
        {
            $sql.= " AND status in (".implode(',',$status).")";
        }

        $sql .= " ORDER BY id DESC ";
        $sql .= " LIMIT {$offset},{$pagesize}";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
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

    /**
     * @param $orderid
     * @param $arr
     * 添加游客信息
     */
    public static function add_tourer($orderid, $arr)
    {

        $tourname = $arr['tourname'];
        $toursex = $arr['toursex'];
        $tourmobile = $arr['tourmobile'];
        $tourcard = $arr['touridcard'];

        for ($i = 0; isset($tourname[$i]); $i++)
        {

            $ar = array(
                'orderid' => $orderid,
                'tourername' => $tourname[$i],
                'sex' => Common::get_sex_by_car($tourcard[$i])?'男':'女',
                'cardtype' => '身份证',
                'cardnumber' => $tourcard[$i],
                'mobile' => $tourmobile[$i]

            );
            $m = ORM::factory('member_order_tourer');
            foreach ($ar as $k => $v)
            {
                $m->$k = $v;
            }
            $m->save();
            $m->clear();
        }

    }

    /**
     * 查询未支付的订单
     * @param $memberid
     */
    public static function unpay($memberid)
    {
        $sql = "SELECT * FROM sline_member_order ";
        $sql .= "WHERE memberid={$memberid} AND paytype<3 AND ispay=0";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
    }

    public static function get_order($typeid,$status,$row=10)
    {
        $sql = "SELECT nickname, mo.productname "
            ." FROM sline_member_order AS mo "
            ." LEFT JOIN sline_member AS m ON m.mid = mo.memberid "
            ." WHERE typeid = {$typeid} AND mo.`status` = {$status} limit {$row}";
        $ar = DB::query(1,$sql)->execute()->as_array();
        return $ar;
    }


    public static function get_line_suit_tourer($lineid, $suitid,$day,$limit=null,$status=self::STATUS_PAY)
    {
        if ($lineid && $suitid & $day){
            $sql = "SELECT m.*,mo.dingnum "
                ." FROM sline_member_order AS mo "
                ." LEFT JOIN sline_member AS m ON m.mid = mo.memberid "
                ." WHERE  mo.status= ".$status." AND mo.typeid = ".Model_Line::TYPE_ID." AND productaid=$lineid AND usedate='".date("Y-m-d",$day)."' AND mo.suitid={$suitid}";
            $sql.=!empty($limit)?" LIMIT {$limit}":'';
            $ar = DB::query(1,$sql)->execute()->as_array();
            return $ar;
        }else{
            return array();
        }

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

}
