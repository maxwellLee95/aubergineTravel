<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Mall_Delivery extends ORM {


    public static function getList()
    {
        $sql = "SELECT * FROM sline_mall_delivery ";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
    }


    public static function getItem($id)
    {
        $sql = "SELECT * FROM sline_mall_delivery  where id={$id}";
        $arr = DB::query(1, $sql)->execute()->current();
        return $arr;
    }

}