<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Indexmoduleline extends ORM {


    protected $_table_name = 'index_module_line';


    public static function getModuleByLine($lineid){
        $sql = "select * from sline_index_module_line WHERE line_id={$lineid}  limit 1";
        return DB::query(Database::SELECT, $sql)->execute()->current();
    }


    public static function getModule($id){
        $sql = "select * from sline_index_module_line WHERE id={$id}  limit 1";
        return DB::query(Database::SELECT, $sql)->execute()->current();
    }



    public  static function deleteClearByline($lineid)
    {
        if($lineid)
        {
            $sql = "DELETE FROM sline_index_module_line WHERE line_id=$lineid;";
            return DB::query(Database::DELETE, $sql)->execute();

        }

    }



} 