<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Startplace extends ORM
{

    public static function start_city($cityId)
    {
        $cityId=intval($cityId);
        if (empty($cityId))
        {
            return;
        }
        $city = DB::select('cityname')->from('startplace')->where("id ={$cityId}")->execute()->current();
        return $city['cityname'];
    }


    public static function get_city_list()
    {
        $sql = "select * from sline_startplace where isopen=1 and pid!=0 order by displayorder desc ";
        return DB::query(Database::SELECT, $sql)->execute()->as_array();
    }

}