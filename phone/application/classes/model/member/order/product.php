<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order_Product extends ORM
{


    public static function add_product($ordersn,$product_list)
    {
        if ($product_list && $ordersn){
            foreach ($product_list as $arr){
                $m = ORM::factory('member_order_product');
                $m->ordersn=$ordersn;
                $m->product_id=$arr['product_id'];
                $m->suit_id=$arr['suit_id'];
                $m->product_name=$arr['product_name'];
                $m->product_price=$arr['product_price'];
                $m->product_num=$arr['product_num'];
                $m->product_image=$arr['product_image'];
                $m->prodcut_pay_price=$arr['prodcut_pay_price'];
                $m->save();
                $m->clear();
                Model_Mall_Sku::updateStock($arr['suit_id'],$arr['product_num']);//更新库存
            }
        }


    }

    public static function geListByOrdersn($ordersn){
        if ($ordersn){
            return ORM::factory('member_order_product')->where("ordersn={$ordersn}")->find_all()->as_array();
        }
    }


        /**
     * @param int $id
     * @param $typeid
     * @param null $row
     * @return int
     * @description
     */
    public static function getSellNum($id)
    {
        $m = ORM::factory('member_order_product')
            ->where("product_id='$id'")
            ->get_all();
        $num = count($m);
        return $num ? $num : 0;

    }


            /**
     * @param int $id
     * @param $typeid
     * @param null $row
     * @return int
     * @description
     */
    public static function getShowSellNum($id,$bookcount)
    {
        return self::getSellNum($id)+$bookcount;;

    }


    


}
