<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Marshalpoint extends ORM
{

    public static function get_list($ids)
    {
        if (empty($ids))
        {
            return;
        }
        $arr = DB::select("*")->from('marshal_point')->where("id in({$ids})")->execute()->as_array();
        return $arr;
    }

    public static function getItem($id)
    {
        if (!empty($id))
        {
            return DB::select("*")->from('marshal_point')->where("id ={$id}")->execute()->current();
        }
    }

}