<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Guide extends ORM
{
    //对应数据库
    protected $_table_name = 'guide';



    public static function getGuide(){
        $sql="select * from sline_guide as a left join sline_member As b on  a.mid=b.mid where a.status=1";
        return DB::query(1,$sql)->execute()->as_array();
    }


    public static function getGuideByDay($day){
        $sql="select * from sline_guide_time as gt "
            ." left join sline_guide As g on g.id=gt.guide_id  "
            ." left join sline_member As m on  g.mid=m.mid where g.status=1 AND gt.day={$day}";
        return DB::query(1,$sql)->execute()->as_array();
    }

    public static function getGuideByMonth($day){
        $sql="select * from sline_guide_time as gt "
            ." left join sline_guide As g on g.id=gt.guide_id  "
            ." left join sline_member As m on  g.mid=m.mid where g.status=1 "
            ." AND date_format(FROM_UNIXTIME(`gt.day`),'%Y-%m')='".date('Y-m',$day)."'";
        return DB::query(1,$sql)->execute()->as_array();
    }

}
