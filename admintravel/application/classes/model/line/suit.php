<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line_Suit extends ORM {
    protected  $_table_name = 'line_suit';
	
	public function deleteClear()
	{
	   if($this->id)
       {
           DB::delete('line_suit_price')->where("suitid={$this->id}")->execute();
           $this->delete();

       }

	}

    /**
     * @param $suitid
     * @return array
     * @desc 获取套餐详情
     */
    public static function suit_info($suitId)
    {
        $suit = ORM::factory('line_suit',$suitId)->as_array();
        $suit['title'] = $suit['suitname'];
        $suit['dingjin']=  Currency_Tool::price($suit['dingjin']);
        return $suit;
    }
}