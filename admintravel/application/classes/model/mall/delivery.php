<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Mall_Delivery extends ORM {
 
     public function deleteClear()
	 {
         DB::delete('mall_delivery')->where("id={$this->id}")->execute();
		 $this->delete();  
	 }
}