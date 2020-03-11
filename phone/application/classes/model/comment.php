<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Comment extends ORM
{
    //对应数据库
    protected $_table_name = 'comment';

    /**
     * @param $id 产品id
     * @param $typeid 栏目id
     * @return int 评论数量
     */
    public static function get_comment_num($id, $typeid)
    {
        $m = ORM::factory('comment')
            ->where("articleid='$id' and typeid='$typeid' AND isshow=1")
            ->get_all();
        $num = count($m);
        return $num ? $num : 0;
    }

    /**
     * @param $id
     * @param $typeid
     * @param $satisfyscore 后台设置满意度
     * @param $commentnum 评论条数
     * @return int|string
     * @desc 获取满意度
     */
    public static function get_score($id, $typeid, $satisfyscore=5,$commentnum=0)
    {
        //后台设置满意度处理
        $satisfyscore = floatval($satisfyscore);
        $satisfyscore = ($satisfyscore > 0 && $satisfyscore <= 5) ? $satisfyscore : 1;

        if($commentnum > 0)
        {
            $arr = ORM::factory('comment')
                ->where("articleid='$id' and typeid='$typeid'")
                ->get_all();
            $i = 0;
            $score = 0;
            foreach ($arr as $row)
            {
                $score += $row['score1'];
                $i++;
            }
            if ($i != 0)
            {
                $avg = $score / $i;
                $satisfyscore = sprintf("%.2f", $avg);
            }
        }
        $satisfyscore = ($satisfyscore > 0 && $satisfyscore <= 5) ? $satisfyscore : 1;

        return $satisfyscore;
    }

    /**
     * 获取指定评论
     * @param $orderid
     * @return mixed
     */
    public static function get_comment($orderid,$type=Model_Line::TYPE_ID)
    {
        $sql = "SELECT * FROM sline_comment ";
        $sql .= "WHERE orderid={$orderid} AND typeid=$type ";
        $sql .= "ORDER BY id DESC";
        $arr = DB::query(1, $sql)->execute()->current();
        return $arr;
    }

    /**
     * 获取指定评论
     * @param $orderid
     * @return mixed
     */
    public static function get_comments($orderid,$type=Model_Line::TYPE_ID)
    {
        $sql = "SELECT * FROM sline_comment ";
        $sql .= "WHERE orderid={$orderid} AND typeid=$type ";
        $sql .= "ORDER BY id DESC";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
    }

    public static function get_comment_by_aid($id){
        $sql = "SELECT * FROM sline_comment ";
        $sql .= "WHERE articleid={$id} ";
        $sql .= "ORDER BY addtime DESC";
        $arr = DB::query(1, $sql)->execute()->as_array();
        if ($arr){
            foreach ($arr as $key => $v)
            {
                $score = $arr[$key]['score1'] * 20;
                $memberinfo = Model_Member::get_member_byid($v['memberid']);
                $arr[$key]['litpic'] = $memberinfo['litpic'] ? $memberinfo['litpic'] : Common::member_nopic();
                $arr[$key]['nickname'] = $memberinfo['nickname'];
                $arr[$key]['score'] = $score . '%';
                $arr[$key]['content'] = $v['content'];
            }
        }

        return $arr;

    }

    /**
     * 获取指定评论
     * @param $notesid
     * @param int $limit
     * @return mixed
     */
    public static function get_comment_by_notesid($notesid,$limit=100)
    {
        $sql = "SELECT c.*,m.nickname,m.litpic AS avatar FROM sline_comment AS c LEFT JOIN  sline_member AS m ON m.mid=`c`.memberid";
        $sql .= " WHERE c.articleid={$notesid} and isshow=1 ";
        $sql .= " ORDER BY c.id DESC  limit {$limit} ";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
    }


    public static function get_stars($id, $typeid)
    {
        $start=5;
        if ($id && $typeid){
            $level_total__sql="select SUM(`level`) AS total FROM  sline_comment where articleid={$id} and typeid={$typeid}";
            $level_total = DB::query(1, $level_total__sql)->execute()->current();
            $level_count_sql="select count(*) as total FROM  sline_comment where articleid={$id} and typeid={$typeid}";
            $level_count = DB::query(1, $level_count_sql)->execute()->current();
            if ($level_count['total']){
                $start=intval($level_total['total']/$level_count['total']);
            }
        }
        return $start;



    }

    /**
     * @param $orderids
     * @return mixed
     */
    public static function getStatByOrderids($orderids)
    {
        if ($orderids){
            $orderidStr=implode(",",$orderids);
            $sql="select sum(score1) as score_total,count(id) as total from sline_comment where orderid in ({$orderidStr})";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }

    }


}
