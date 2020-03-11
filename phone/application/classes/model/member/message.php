<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Message extends ORM
{


    public static function get_list_by_mid($mid){
        if ($mid){
            $sql="select * from sline_member_message WHERE to_id={$mid} ORDER BY  addtime DESC ";
            return DB::query(1, $sql)->execute()->as_array();
        }
    }


    public static function get_item($id){
        if ($id){
            $sql="select * from sline_member_message WHERE id={$id}";
            return DB::query(1, $sql)->execute()->current();
        }
    }


    public static function add_message($mid,$title,$msg){
        if ($mid){
            $model=ORM::factory('member_message');
            $model->title=$title;
            $model->msg=$msg;
            $model->to_id=$mid;
            $model->addtime=time();
            $model->save();
        }


    }

}
