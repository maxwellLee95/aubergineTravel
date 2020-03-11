<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Question extends ORM
{
    /*
        * 获取酒店
        * @param 参数
        * @return array

      */
    private static $basefield ='a.id,
                            a.content,
                            a.replycontent,
                            a.replytime,
                            a.nickname,
                            a.ip,
                            a.status,
                            a.memberid,
                            a.addtime,
                            a.qq,
                            a.webid,
                            a.phone,
                            a.weixin,
                            a.email,
                            a.title,
                            a.questype';

    /*
    * 搜索
    * */
    public static function search_question($status, $webid, $keyword, $offset, $row)
    {
        $sql = "SELECT ".self::$basefield." FROM `sline_question` a ";
        $sql.= "WHERE 1=1 ";
        if(!empty($webid))
            $sql.= "AND a.webid={$webid} ";
        if(!empty($status))
            $sql.= "AND a.status={$status} ";
        if(!empty($keyword))
            $sql.= "AND a.content like '%{$keyword}%' ";

        $sql.= "ORDER BY replytime desc ";
        $sql.= "LIMIT {$offset},{$row}";
        $arr = self::execute($sql);
        return $arr;
    }
    /*
    * 搜索
    * */
    public static function search_question_count($status, $webid, $keyword, $offset, $row)
    {
        $sql = "SELECT count(0) as num FROM `sline_question` a ";
        $sql.= "WHERE 1=1 ";
        if(!empty($webid))
            $sql.= "AND a.webid={$webid} ";
        if(!empty($status))
            $sql.= "AND a.status={$status} ";
        if(!empty($keyword))
            $sql.= "AND a.content like '%{$keyword}%' ";

        $sql.= "ORDER BY replytime desc ";
        $sql.= "LIMIT {$offset},{$row}";
        $arr = self::execute($sql);
        return $arr;
    }

    /*
    * 执行sql语句
    * */
    private static function execute($sql)
    {
        $arr = DB::query(1,$sql)->execute()->as_array();
        return $arr;
    }

    /**
     * @function 搜索我的问答
     * @param $mid
     * @param $currentpage
     * @param int $pagesize
     * @return array
     */
    public static function question_list($mid,$questype,$currentpage,$pagesize=10)
    {

        $page = $currentpage ? $currentpage : 1;
        $offset = (intval($page)-1)*$pagesize;
        $questype = $questype ? $questype : 0;

        $sql = "SELECT a.* FROM `sline_question` a ";
        $sql.= "WHERE a.memberid=$mid ";

        $sql.= "ORDER BY addtime desc ";

        //计算总数
        $totalSql = "SELECT count(*) as dd ".strchr($sql," FROM");
        $totalSql = str_replace(strchr($totalSql,"ORDER BY"),'', $totalSql);//去掉order by

        $totalN = DB::query(1,$totalSql)->execute()->get('dd');
        $totalNum = $totalN ? $totalN : 0;
        $sql.= "LIMIT {$offset},{$pagesize}";
        $arr = self::execute($sql);
        foreach($arr as &$row)
        {
            $product_info = self::get_product_info($row['typeid'],$row['productid']);
            $row['productname'] = $product_info['title'];
            $row['producturl'] = $product_info['url'];
        }

        $out = array(
            'total' => $totalNum,
            'list' => $arr
        );
        return $out;
    }

    /**
     * @function 获取产品信息
     * @param $typeid
     * @param $productid
     * @return array
     */
    private  static function get_product_info($typeid,$productid)
    {
        $out = array();
        if($typeid)
        {
            $model = ORM::factory('model',$typeid);

            $table = $model->maintable;
            $pinyin = !empty($model->correct) ? $model->correct : $model->pinyin;

            if($table)
            {
                $info = ORM::factory($table,$productid)->as_array();
                $url = Common::get_web_url($info['webid'])."/{$pinyin}/show_{$info['aid']}.html";
                $out['title'] = $info['title'];
                $out['url'] = $url;
            }

        }
        return $out;


    }

}