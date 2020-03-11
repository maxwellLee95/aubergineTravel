<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Theme extends ORM {
     
	 public function deleteClear()
	 {
		 $this->delete();
	 }


	 public function get_arr(){
		$arr=array();
        $list = ORM::factory('theme')->where('isopen=1')->get_all();
        if ($list){
            foreach ($list as $item){
                $arr[$item['id']]=$item['ztname'];
            }
        }
        return $arr;
	 }


}