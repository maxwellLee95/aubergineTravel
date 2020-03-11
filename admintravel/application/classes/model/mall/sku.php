<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Mall_Sku extends ORM {
 
     public function deleteClear()
	 {
		/* $piclist=explode(',',$this->piclist);
		 foreach($piclist as $k=>$v)
		 {
			  $img_arr=explode('||',$v);
			  Common::deleteRelativeImage($img_arr[0]);
		 }*/
         DB::delete('mall_sku_price')->where("suitid={$this->id}")->execute();
		 $this->delete();  
	 }
}