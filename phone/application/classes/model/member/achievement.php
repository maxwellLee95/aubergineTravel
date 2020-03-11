<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Achievement extends ORM
{


    public static function get_list_by_mid($mid){
        if ($mid){
            $sql="select * from sline_member_achievement WHERE mid={$mid}";
            return DB::query(1, $sql)->execute()->as_array();
        }
    }

    public static function get_item($id){
        if ($id){
            $sql="select * from sline_member_achievement WHERE id={$id}";
            return DB::query(1, $sql)->execute()->current();
        }
    }


    public static function add_item($mid,$content,$finish_time){
        if ($mid){
            $model=ORM::factory('member_achievement');
            $model->mid=$mid;
            $model->content=$content;
            $model->finish_time=$finish_time;
            $model->addtime=time();
            $model->save();
        }
    }

    public static function mod_item($id,$mid,$content,$finish_time){
        if ($mid && $id){
            $model=ORM::factory('member_achievement',$id);
            $model->mid=$mid;
            $model->content=$content;
            $model->finish_time=$finish_time;
            $model->modtime=time();
            $model->save();
        }
    }

    public static function deleteClear($id)
    {
        if ($id){
            $model=ORM::factory('member_achievement',$id);
            $model->delete();
        }

    }

}