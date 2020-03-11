<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 */
class Model_Notes extends ORM
{

    const TYPE_ID=101;
    const TYPE_TXT=1;//文字
    const TYPE_VIDEOS=2;//视频
    const STATUS_REVIEW=0;//审核中
    const STATUS_FAIL=-1;//审核失败
    const STATUS_SUCCESS=1;//审核通过
    const STATUS_EDIT=-2;//编辑


    public static function statueName(){
        return array(
            self::STATUS_REVIEW=> '审核中',
            self::STATUS_FAIL=> '审核失败',
            self::STATUS_SUCCESS=> '审核通过',
            self::STATUS_EDIT=> '编辑中',
        );
    }

    public static function getStatusName($key){
        return Arr::get(self::statueName(),$key,'');
    }


    public static function notes_new($type=self::TYPE_TXT,$page=1,$limit=10)
    {
        $page=intval($page);
        $page=!empty($page)?$page:1;
        $offset=($page-1)*$limit;
        $sql = 'SELECT n.*,sm.nickname,sm.litpic AS avatar FROM sline_notes AS n ';
        $sql .= " left join sline_member As sm on n.memberid=sm.mid WHERE n.status=1 AND n.type={$type}";
        $sql .= " order by modtime DESC limit {$offset},{$limit} ";
        return DB::query(1, $sql)->execute()->as_array();
    }

    public static function notes_hot($type=self::TYPE_TXT,$page=1,$limit=10)
    {
        $page=intval($page);
        $page=!empty($page)?$page:1;
        $offset=($page-1)*$limit;
        $sql = 'SELECT n.*,sm.nickname,sm.litpic AS avatar FROM sline_notes AS n ';
        $sql .= " left join sline_member As sm on n.memberid=sm.mid WHERE n.status=1 AND n.type={$type}";
        $sql .= " order by displayorder DESC limit {$offset},{$limit} ";
        return DB::query(1, $sql)->execute()->as_array();
    }


    public static function get_detail($id)
    {
        if ($id){
            $sql = 'SELECT n.*,sm.nickname,sm.litpic AS avatar FROM sline_notes AS n ';
            $sql .= " left join sline_member As sm on n.memberid=sm.mid WHERE  n.id={$id}";
            return DB::query(1, $sql)->execute()->current();
        }
    }

    public static function get_my_notes($id)
    {
        $sql = "SELECT * FROM `sline_notes` AS a  LEFT JOIN (SELECT mid,nickname,litpic as memberpic,remarks FROM sline_member) AS m ON m.mid=a.memberid WHERE a.memberid={$id}";
        $sql.= " ORDER BY modtime DESC";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as &$row)
        {
            $row['url'] = $GLOBALS['cfg_basehost'].'/notes/show?id='.$row['id'];
            $row['status_name']=Model_Notes::getStatusName($row['status']);

        }
        return $arr;
    }

}