<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order_Product extends ORM
{

    public static function geListByOrdersn($ordersn){
        if ($ordersn){
            return ORM::factory('member_order_product')->where("ordersn={$ordersn}")->find_all()->as_array();
        }
    }

}
