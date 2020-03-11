<?php defined('SYSPATH') or die('No direct access allowed.');


class Model_Line_Suit_Price extends ORM
{

    public static function get_price_by_day($suitid,$useday)
    {
        $sql = "SELECT * FROM `sline_line_suit_price` WHERE suitid='$suitid' AND day='$useday' limit 1";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $ar=self::_price($ar);
        return !empty($ar)?$ar[0]:array();
    }

    /**
     * @param $lineid
     * @param int $limit
     * @return array
     */
    public static function get_all_suit_day($lineid,$limit=100)
    {
        return self::get_suit_day($lineid,$limit);
    }

    /**
     * @param $lineid
     * @param int $limit
     * @return array
     */
    public static function get_available_suit_day($lineid,$limit=100)
    {
        return self::get_suit_day($lineid,$limit,1);
    }

    /**
     * @param $lineid
     * @param int $limit
     * @return array
     */
    public static function get_no_leader_suit_day($lineid,$limit=100)
    {
        return self::get_suit_day($lineid,$limit,2);
    }

    /**
     * @param $lineid
     * @param int $limit
     * @param null $type
     * @return array
     */
    public static function get_suit_day($lineid,$limit=100,$type=null,$is_stock=true)
    {
        if ($lineid){
            $time=Common::day_time();
            $sql = "select lsp.*,ls.*,l.person_count,l.min_person_count,l.qrcode,l.qrcode_text from sline_line AS l "
                ." LEFT JOIN sline_line_suit AS ls on ls.lineid=l.id  "
                ." LEFT JOIN sline_line_suit_price AS lsp  "
                ." ON ls.lineid=lsp.lineid  "
                ." where ls.lineid={$lineid} and lsp.`day`>={$time} ";
            $sql.=$is_stock?' AND lsp.number!=0 ':'';
            switch ($type){
                case 1:
                    $sql.=' AND lsp.leader_id >0 ';
                    break;
                case 2:
                    $sql.=' AND (lsp.leader_id is null or lsp.leader_id=0) ';
                    break;
            }
            $sql .= " order by lsp.`day` limit {$limit}";
            $row = DB::query(1, $sql)->execute()->as_array();
            if ($row){
                $row=self::_price($row);
                foreach($row as &$v)
                {
                    $v['status']=Common::line_status($v['person_count'],$v['min_person_count'],$v['lineid'],$v['suitid'],$v['day']);
                }
                return $row;
            }

        }
        return array();
    }



    public static function filter_line_suit($lineid,$suit_id,$day,$linelist){
        if ($linelist && $lineid && $suit_id && $day ){
            foreach ($linelist as $item){
                if ($item['lineid']==$lineid && $item['suitid']==$suit_id  && $item['day']==$day){
                    return $item;
                    break;
                }
            }
        }
    }


    public static function _price($data){
        foreach($data as &$v)
        {
            $v['qrcode']=Common::img($v['qrcode']);
            $v['url']=Common::_detail_url($v['lineid'],$v['suitid'],$v['day']);
            $v['childprofit'] = Currency_Tool::price($v['childprofit']);
            $v['childbasicprice'] = Currency_Tool::price($v['childbasicprice']);
            $v['childprice'] = Currency_Tool::price($v['childprice']);
            $v['oldprofit'] = Currency_Tool::price($v['oldprofit']);
            $v['oldbasicprice'] = Currency_Tool::price($v['oldbasicprice']);
            $v['oldprice'] = Currency_Tool::price($v['oldprice']);
            $v['adultprofit'] = Currency_Tool::price($v['adultprofit']);
            $v['adultbasicprice'] = Currency_Tool::price($v['adultbasicprice']);
            $v['adultprice'] = Currency_Tool::price($v['adultprice']);
        }
        return $data;
    }


    public static function get_after_day(){
        $time=strtotime(date('Y-m-d'));
        $sql = "select DISTINCT `day`  from sline_line_suit_price "
            ." where day>={$time}  AND  leader_id >0 order by day limit 100";
        $res = DB::query(1, $sql)->execute()->as_array();
        return $res;
    }

    public static function get_before_day(){
        $time=strtotime(date('Y-m-d'));
        $sql = "select  DISTINCT `day` from sline_line_suit_price "
            ." where day<{$time} AND  leader_id >0 order by day limit 31";
        $res = DB::query(1, $sql)->execute()->as_array();
        return $res;
    }


    public static function get_price_by_suitid($suitid,$limit=30)
    {
        $sql = "SELECT * FROM `sline_line_suit_price` WHERE suitid='$suitid'  AND number!=0 AND  leader_id >0 limit {$limit}";
        $ar = DB::query(1,$sql)->execute()->as_array();
        return self::_price($ar);
    }

    public static function get_no_leader_suit_by_suitid($suitid,$limit=30)
    {
        $sql = "SELECT * FROM `sline_line_suit_price` WHERE suitid='$suitid'  AND number!=0 AND  (leader_id is  NULL or leader_id=0) limit {$limit}";
        $ar = DB::query(1,$sql)->execute()->as_array();
        return self::_price($ar);
    }

    /**
     * @param $suitid
     * @param $useday
     * @return mixed
     * 产品套餐按天获取报价
     */

    public static function get_price_by_suit_day($suitid,$useday)
    {
        $sql = "SELECT * FROM sline_line_suit AS ls left join `sline_line_suit_price` AS lsp on ls.id=lsp.suitid WHERE lsp.suitid='$suitid' AND lsp.day='$useday' limit 1";
        $v = DB::query(1,$sql)->execute()->current();
        if ($v){
            $group_arr = explode(',', $v['propgroup']);
            $v['haschild']=in_array(1, $group_arr)?1:0;
            $v['hasadult']=in_array(2, $group_arr)?1:0;
            $v['hasold']=in_array(3, $group_arr)?1:0;
            $v['url']=Common::_detail_url($v['lineid'],$v['suitid'],$v['day']);
            $v['jifentprice'] = Currency_Tool::price($v['jifentprice']);
            $v['childprofit'] = Currency_Tool::price($v['childprofit']);
            $v['childbasicprice'] = Currency_Tool::price($v['childbasicprice']);
            $v['childprice'] = Currency_Tool::price($v['childprice']);
            $v['oldprofit'] = Currency_Tool::price($v['oldprofit']);
            $v['oldbasicprice'] = Currency_Tool::price($v['oldbasicprice']);
            $v['oldprice'] = Currency_Tool::price($v['oldprice']);
            $v['adultprofit'] = Currency_Tool::price($v['adultprofit']);
            $v['adultbasicprice'] = Currency_Tool::price($v['adultbasicprice']);
            $v['adultprice'] = Currency_Tool::price($v['adultprice']);
        }
        return $v;
    }


    public static function update_leaders($suitid,$useday,$leader_ids=array()){
        $t=array();
        $i=2;
        $leader_id=!empty($leader_ids[0])?$leader_ids[0]:'';
        if ($suitid && $useday && $leader_id){
            unset($leader_ids[0]);
            foreach ($leader_ids as $id){
                if (!empty($id)){
                    $t[]='leader_id'.$i=$id;
                }
                $i++;
            }
            $q=!empty($t)?implode(",",$t):'';
            $sql = "update sline_line_suit_price set leader_id={$leader_id} {$q} WHERE suitid='$suitid' AND `day`='$useday' AND number!=0 limit 1";
            DB::query(1,$sql)->execute()->as_array();
        }

    }






}