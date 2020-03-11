<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Customizeline extends ORM
{

    const TYPE_ID=1;

    /**
     * 线路最热门
     * @param $offset
     * @param $row
     * @return mixed
     */
    public static function get_line_hot($offset, $row)
    {
        $sql = "SELECT a.*"
            ." FROM sline_line AS a"
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND a.line_type=".Model_Line::LINE_TYPE_CUSTOMIZE
            ." ORDER BY a.shownum desc"
            ." LIMIT {$offset},{$row};";
        $data = DB::query(1,$sql)->execute()->as_array();
        foreach($data as $k=>$v)
        {
            $data[$k]['startcity_id'] = $v['startcity'];
            $data[$k]['startcity'] = Model_Startplace::start_city($v['startcity']);
        }
        return $data;
    }









}