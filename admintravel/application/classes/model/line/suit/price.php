<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line_Suit_Price extends ORM {
    protected  $_table_name = 'line_suit_price';
	
	public static function getMinPrice($suitid,$field='')
	{
		$time=time();
        if(!empty($field))
        {
            //获取利润
            $result=DB::query(Database::SELECT,"select min($field) as minprice from sline_line_suit_price where  day>$time and suitid=$suitid")->execute()->as_array();
            if($result[0]['minprice'] =='0')
            {
                $field = 'childprofit';
                $result=DB::query(Database::SELECT,"select min($field) as minprice from sline_line_suit_price where  day>$time and suitid=$suitid")->execute()->as_array();
            }
        }else{
            //获取最低报价
            $field = 'adultprice';
            $result=DB::query(Database::SELECT,"select min($field) as minprice from sline_line_suit_price where  day>$time and suitid=$suitid")->execute()->as_array();
            if($result[0]['minprice'] =='0')
            {
                $field = 'childprice';
                $result=DB::query(Database::SELECT,"select min($field) as minprice from sline_line_suit_price where  day>$time and suitid=$suitid")->execute()->as_array();
            }
        }
		return $result[0]['minprice'];
	}

    public function deleteClear()
    {
        // Common::deleteRelativeImage($this->litpic);
        // Common::deleteContentImage($this->content);
        $this->delete();
    }

    public static function get_price_by_day($suitid,$useday)
    {
        $sql = "SELECT * FROM `sline_line_suit_price` WHERE suitid='$suitid' AND day='$useday' limit 1";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $ar=self::_price($ar);
        return !empty($ar)?$ar[0]:array();
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

}