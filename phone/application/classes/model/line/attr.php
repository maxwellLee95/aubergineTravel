<?php defined('SYSPATH') or die('No direct access allowed.');


class Model_Line_Attr extends ORM
{

    static function get_parent(){
        $sql = "SELECT * FROM sline_line_attr where isopen =1 and pid=0 order by displayorder";
        return DB::query(1, $sql)->execute()->as_array();
    }

    static function get_sub_by_pid($pid){
        $sql = "SELECT * FROM sline_line_attr where isopen =1 and pid={$pid} order by displayorder";
        return DB::query(1, $sql)->execute()->as_array();
    }


    static function get_attr_list(){
        $category=array();
        $parents=self::get_parent();
        if ($parents){
            foreach ($parents as $parent){
                $parent['sub']=self::get_sub_by_pid($parent['id']);
                $category[]=$parent;
            }
        }
        return $category;
    }

    public static function get_attrid_by_name($name)
    {
        $sql = "SELECT id  FROM `sline_line_attr` WHERE  attrname='{$name}'";
        $data = DB::query(1,$sql)->execute()->current();;
        if ($data){
            return $data['id'];
        }
        return null;
    }


}