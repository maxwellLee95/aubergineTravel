<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Test extends Stourweb_Controller
{
    public function action_index(){
        $ordersn="0103120984";
        $order = ORM::factory('member_order')->where("ordersn='{$ordersn}'")->find();
        $order->status=Model_Member_Order::STATUS_REFUNDED;
        $order->update();
        Common::dd($order);
    }
}