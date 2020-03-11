<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Mall_Sku extends ORM
{


    public static function get_sku_list($productid)
    {
        $suit = ORM::factory('mall_sku')
            ->where("mallid=:productid")
            ->param(':productid',$productid)
            ->get_all();
        foreach($suit as &$r)
        {
            $r['title'] = $r['name'];
            $r['price'] = Currency_Tool::price($r['price']);
            $r['piclist'] = Product::pic_list($r['piclist']);
        }
        return $suit;

    }

    public static function get_sku($productid,$suitid)
    {
        return ORM::factory('mall_sku')
            ->where("id={$suitid} AND mallid='{$productid}'")
            ->find()
            ->as_array();

    }

    public static function get_sku_by_id($suitid)
    {
        return ORM::factory('mall_sku')
            ->where("id={$suitid}")
            ->find()
            ->as_array();

    }

    /**
     * #TODO 并发会导致一些问题，需要添加mysql锁或者其他方式处理
     *
     * @param [type] $suitId
     * @param [type] $member
     * @return void
     */
    public static function updateStock($suitId,$member){
        if($suitId && $member){
            $sql = "update sline_mall_sku set number=number-{$member} WHERE id='$suitId' limit 1";
            DB::query(1,$sql)->execute()->as_array();
        }

    }

}
