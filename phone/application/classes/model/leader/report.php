<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Report extends ORM
{
    //对应数据库
    protected $_table_name = 'leader_report';



    public static function getItemByLine($lineid,$suitid,$day){
        if ($lineid && $suitid && $day ){
            $sql="select * from sline_leader_report where lineid={$lineid} AND  suit_id={$suitid} AND  `day`={$day}";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }

    }





}
