<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Integral_Log extends ORM {


    const ACTION_OTHER=0;
    const ACTION_CERTIFICATE=1;

    const TYPE_INCREASE=2;
    const TYPE_USE=1;


    public static function  addLog($leader_id, $content, $integral, $type,$action=self::ACTION_OTHER,$param=array()){
        $model = ORM::factory('leader_integral_log');
        $model->leader_id = $leader_id;
        $model->content = $content;
        $model->integral = $integral;
        $model->action = $action;
        $model->type = $type;
        $model->action = $type;
        $model->addtime = time();
        $model->save();
    }


}