<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Indexmodule extends ORM {


    protected $_table_name = 'index_module';



    public static function get_index_module_arr(){
        $index_module_arr=array();
        $index_module = ORM::factory('indexmodule')->where('status=1')->get_all();
        if ($index_module){
            foreach ($index_module as $item){
                $index_module_arr[$item['id']]=$item['name'];
            }
        }
        return $index_module_arr;
    }




} 