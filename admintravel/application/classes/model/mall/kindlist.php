<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Mall_Kindlist extends ORM {

    protected  $_table_name = 'mall_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}