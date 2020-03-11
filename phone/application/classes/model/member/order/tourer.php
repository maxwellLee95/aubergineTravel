<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order_Tourer extends ORM
{

    public static function get_order_tourer($order_id){
        $sql="select * from sline_member_order_tourer where orderid={$order_id} ";
        return DB::query(Database::SELECT,$sql)->execute()->as_array();
    }


}
