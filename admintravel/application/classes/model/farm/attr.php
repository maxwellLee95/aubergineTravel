<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Farm_Attr extends ORM {

    protected  $_table_name = 'farm_attr';
	
	
	public static function getAttrnameList($attrid_str,$separator=',')
	{
		$attrid_arr=explode(',',$attrid_str);
		foreach($attrid_arr as $k=>$v)
		{
			$attr=ORM::factory('farm_attr',$v);
			
			if($attr->attrname)
			$attr_str.=$attr->attrname.$separator;
		}
		$attr_str=trim($attr_str,$separator);
	    return $attr_str;
		
	}
    public function deleteClear()
    {
        Common::deleteRelativeImage($this->litpic);
        $children=ORM::factory('farm_attr')->where("pid={$this->id}")->find_all()->as_array();
        foreach($children as $child)
        {
            $child->deleteClear();
        }
        $this->delete();
    }

}