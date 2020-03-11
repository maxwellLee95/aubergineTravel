<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Theme extends ORM
{


    public static function list_new($page=1,$limit=10)
    {
        $page=intval($page);
        $page=!empty($page)?$page:1;
        $offset=($page-1)*$limit;
        $sql = "SELECT * FROM sline_theme WHERE isopen=1 AND  issystem=0 order by modtime DESC limit {$offset},{$limit}";
        return DB::query(1, $sql)->execute()->as_array();
    }


    public static function get_detail($id){
        if ($id){
            $sql = "SELECT * FROM sline_theme WHERE isopen=1 AND  issystem=0 AND id={$id}";
            return DB::query(1, $sql)->execute()->current();
        }

    }


}