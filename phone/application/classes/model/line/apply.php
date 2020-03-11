<?php defined('SYSPATH') or die('No direct access allowed.');


class Model_Line_Apply extends ORM
{
    const STATE_EDIT=0;
    const STATE_FAIL=1;
    const STATE_PROCESSING=2;
    const STATE_PASS=3;

    const MEMBER=1;
    const LEADER=2;


    static function getStateName($key){
        return Arr::get(self::stateName(),$key,'');
    }

    static function stateName(){
        return array(
            self::STATE_FAIL=>'不通过',
            self::STATE_EDIT=>'编辑中',
            self::STATE_PROCESSING=>'审核中',
            self::STATE_PASS=>'通过',
        );
    }


}