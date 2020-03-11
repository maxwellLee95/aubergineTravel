<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order_Refund extends ORM
{

    const STATUS_UNTREATED= 0;//
    const STATUS_SUCCESS=1;
    const STATUS_FAIL=2;

    const PLATFORM_ALIPAY='alipay';
    const PLATFORM_WXPAY='wxpay';
    const PLATFORM_OTHER_ALIPAY='other_alipay';
    const PLATFORM_BANK='bank';
    const PLATFORM_BACKSTAGE='backstage';

    public static $statusNames=array(
        self::STATUS_UNTREATED=>'未处理',
        self::STATUS_SUCCESS=>'同意',
        self::STATUS_FAIL=>'不同意',
    );

    public static $playFormNames=array(
        self::PLATFORM_ALIPAY=>'支付宝',
        self::PLATFORM_WXPAY=>'微信',
        self::PLATFORM_OTHER_ALIPAY=>'其他',
        self::PLATFORM_BANK=>'银行',
    );


    public static function getStatusName($key){
        if (isset(self::$statusNames[$key])){
            return self::$statusNames[$key];
        }
    }

    public static function getPlayFormName($key){
        if (isset(self::$playFormNames[$key])){
            return self::$playFormNames[$key];
        }
    }

    public static function get_item($ordersn){
        $sql="select * from sline_member_order_refund where ordersn={$ordersn} ";
        return DB::query(Database::SELECT,$sql)->execute()->current();
    }


}
