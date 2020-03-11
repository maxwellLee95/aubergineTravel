<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Model_Attr extends ORM
{
    /**
     * @param $attrid
     * @return mixed
     * @desc 根据属性id返回属性数组.
     */
    public static function get_attr_list($attrid,$typeid)
    {
       if(empty($attrid))return array();
       $sql = "SELECT id,attrname FROM `sline_model_attr` WHERE id IN($attrid) AND isopen=1 AND pid!=0 AND typeid=$typeid ORDER BY displayorder ASC";
       $arr = DB::query(1,$sql)->execute()->as_array();
       return $arr;
    }
    public static function get_attrname_list($attrid_str,$separator=',',$typeid)
    {
        $attrid_arr=explode('_',$attrid_str);
        foreach($attrid_arr as $k=>$v)
        {
            $attr=ORM::factory('model_attr')->where("typeid=$typeid")->find();
            if($attr->attrname)
                $attr_str.=$attr->attrname.$separator;
        }
        $attr_str=trim($attr_str,$separator);
        return $attr_str;

    }

}
