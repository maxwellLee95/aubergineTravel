<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Notes extends ORM
{

    /**
     * 会员发布的游记列表
     * @param $mid
     * @param $page
     * @param $pagesize
     * @return mixed
     */
    public static function member_notes_list($mid,$currentpage,$pagesize)
    {
        $page = $currentpage ? $currentpage : 1;
        $offset = (intval($page)-1)*$pagesize;


        $sql = "SELECT a.* FROM `sline_notes` a ";
        $sql.= "WHERE a.memberid=$mid ";
        $sql.= "ORDER BY modtime desc ";

        //计算总数
        $totalSql = "SELECT count(*) as dd ".strchr($sql," FROM");
        $totalSql = str_replace(strchr($totalSql,"ORDER BY"),'', $totalSql);//去掉order by

        $totalN = DB::query(1,$totalSql)->execute()->get('dd');
        $totalNum = $totalN ? $totalN : 0;
        $sql.= "LIMIT {$offset},{$pagesize}";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as &$row)
        {
            $row['url'] = $GLOBALS['cfg_basehost'].'/notes/show_'.$row['id'].'.html';
        }
        $out = array(
            'total' => $totalNum,
            'list' => $arr
        );
        return $out;

    }

    /**
     * 获取总的游记数量
     * @return int
     */
    public static function get_total_notes()
    {
        $sql = "SELECT COUNT(*) as dd FROM `sline_notes` WHERE status=1";
        $num = DB::query(1,$sql)->execute()->get('dd');
        return $num ? $num : 0;
    }

    /**
     * 获取最新游记
     * @param $offset
     * @param $pagesize
     * @return mixed
     */
    public static function get_new_notes($offset,$pagesize)
    {
        $sql = "SELECT * FROM `sline_notes` AS a  LEFT JOIN (SELECT mid,nickname,litpic as memberpic,remarks FROM sline_member) AS m ON m.mid=a.memberid WHERE a.status=1";
        $sql.= " ORDER BY modtime DESC LIMIT $offset,$pagesize";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as &$row)
        {
            $row['url'] = $GLOBALS['cfg_basehost'].'/notes/show_'.$row['id'].'.html';

        }
        return $arr;


    }
}