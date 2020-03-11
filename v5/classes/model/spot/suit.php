<?php defined('SYSPATH') or die('No direct access allowed.');


class Model_Spot_Suit extends ORM
{
    /**
     * @param $suitid
     * @return array
     * @desc 获取套餐详情
     */
    public static function suit_info($suitId)
    {
        $suit = ORM::factory('spot_ticket',$suitId)->as_array();

        $suit['sellprice']=Currency_Tool::price($suit['sellprice']);
        $suit['ourprice']=Currency_Tool::price($suit['ourprice']);
        $suit['dingjin'] = Currency_Tool::price($suit['dingjin']);

        return $suit;
    }



}