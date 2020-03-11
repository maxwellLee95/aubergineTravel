<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Jifen_Log extends ORM {


    const ACTION_LOGIN=2;
    const ACTION_ORDER=1;
    const ACTION_OTHER=0;
    const ACTION_REGISTER=3;

    const TYPE_INCREASE=2;
    const TYPE_USE=1;


    public static function  addLog($memberid, $content, $jifen, $type,$action=self::ACTION_OTHER,$param=array()){
        $model = ORM::factory('member_jifen_log');
        $model->memberid = $memberid;
        $model->content = $content;
        $model->jifen = $jifen;
        $model->action = $action;
        switch ($action){
            case self::ACTION_LOGIN:
                break;
            case self::ACTION_ORDER:
                $model->orderid=!empty($param['orderid'])?$param['orderid']:0;
                break;
        }
        $model->type = $type;
        $model->action = $type;
        $model->addtime = time();
        $model->save();
    }

    public static function isOrderRecord($memberid,$orderid,$type=self::TYPE_INCREASE){
        $where="memberid={$memberid} AND action='".self::ACTION_ORDER."' AND orderid={$orderid} AND type={$type}";
        $model = ORM::factory('member_jifen_log')->where($where)->find();
        if ($model->id){
            return true;
        }else{
            return false;
        }
    }

    public static function isLoginRecord($memberid,$type){
        $where="memberid={$memberid} AND action='".self::ACTION_LOGIN."' AND type={$type} AND date_format(FROM_UNIXTIME(addtime),'%Y-%m-%d')='".date('Y-m-d')."'";
        $model = ORM::factory('member_jifen_log')->where($where)->find();
        if ($model->id){
            return true;
        }else{
            return false;
        }
    }


}