<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line extends ORM
{


    const LINE_TYPE_LINE=1;
    const LINE_TYPE_FLOP=2;
    const LINE_TYPE_CUSTOMIZE=3;

    const TYPE_ID=1;
    /**
     * 线路最低价
     * @param $lineid
     * @return int
     */
    public static function get_minprice($lineid)
    {
        $time = time();
        $sql = "select min(adultprice) as price from sline_line_suit_price where lineid='$lineid' and day > '$time' and adultprice!=0 limit 60";
        $row = DB::query(1, $sql)->execute()->as_array();
        $row[0]['price'] = Currency_Tool::price($row[0]['price']);
        return $row[0]['price'];
    }

    /**
     * 线路属性
     * @param $attrid
     * @return array
     */
    public static function line_attr($attrid)
    {
        if (empty($attrid))
        {
            return;
        }
        $arr = DB::select('*')->from('line_attr')->where("id in({$attrid}) and pid!=0")->execute()->as_array();
        return $arr;
    }

    /**
     * 线路详情
     * @param $id
     * @return array
     */
    public static function detail($id)
    {
        if ($id){
            $sql = "SELECT * FROM sline_line WHERE aid={$id} and webid={$GLOBALS['sys_webid']}";
            $arr = DB::query(1, $sql)->execute()->current();//as_array();
            $arr['price'] = Currency_Tool::price($arr['price']);
            $arr['storeprice'] = Currency_Tool::price($arr['storeprice']);
            return $arr;
        }
    }

    /**
     * 参数解析
     * @param $params
     */
    public static function search_result($params,$keyword,$pagesize='10')
    {
        //参数处理
        $urlParam = $params;
        $destPy = 'all';
        $priceId=$sortType=$aa=$attrId=$startcityId=0;
        $params = explode('-', str_replace('/', '-', $urlParam));
        $count = count($params);

        switch ($count)
        {
            //目的地
            case 1:
                list($destPy) = $params;
                break;
            //关键字、属性
            case 8:
                //$aa  原来用于搜索关键字处理，现在停用
                list($destPy, $dayId, $priceId, $sortType, $aa, $startcityId,$attrId,$page) = $params;
                break;
        }
        $destPy = Common::remove_xss($destPy);
        $dayId = Common::remove_xss($dayId);
        $sortType = Common::remove_xss($sortType);
        $startcityId = Common::remove_xss($startcityId);
        $attrId = Common::remove_xss($attrId);
        $page = Common::remove_xss($page);

        $where = ' WHERE a.ishidden=0 ';
        //按目的地搜索
        if($destPy && $destPy!='all')
        {
            $destId = ORM::factory('destinations')->where("pinyin='$destPy'")->find()->get('id');
            $where.= " AND FIND_IN_SET('$destId',a.kindlist) ";
        }
        //星级
        if($dayId)
        {
            $where.= " AND a.lineday='$dayId'";
        }
        //价格区间
        if($priceId)
        {
            $priceArr = ORM::factory('line_pricelist',$priceId)->as_array();
            $where.= " AND a.price BETWEEN {$priceArr['lowerprice']} AND {$priceArr['highprice']} ";
        }
        //排序
        $orderBy = "";
        if(!empty($sortType))
        {
            if($sortType==0)//默认排序
            {
                $orderBy = " IFNULL(b.displayorder,9999) ASC,";
            }
            elseif($sortType==1)//特价排序
            {
                $orderBy = " a.price asc,";
            }
            else if($sortType==2) //价格
            {
                $orderBy = " a.price desc,";
            }
            else if($sortType==3) //人气
            {
                $orderBy = " a.shownum desc,";
            }
            else if($sortType==4) //销量
            {
                $orderBy = " a.bookcount desc,";
            }
            else if($sortType==5) //满意度
            {
                $orderBy = " a.shownum desc,";
            }
        }

        //关键词
        if(!empty($keyword))
        {
            $where.= " AND a.title like '%$keyword%' ";
        }
        //按属性
        if(!empty($attrId))
        {
            $where.= Product::get_attr_where($attrId);
        }

        $offset = (intval($page)-1)*$pagesize;

        //如果选择了目的地
        if(!empty($destId))
        {
            $sql = "SELECT a.* FROM `sline_line` a ";
            $sql.= "LEFT JOIN `sline_kindorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=1 AND a.webid=b.webid AND b.classid=$destId)";
            $sql.= $where;
            $sql.= "ORDER BY {$orderBy}a.modtime DESC,a.addtime DESC ";
            $sql.= "LIMIT {$offset},{$pagesize}";

        }
        else
        {
            $sql = "SELECT a.* FROM `sline_line` a ";
            $sql.= "LEFT JOIN `sline_allorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=1 AND a.webid=b.webid)";
            $sql.= $where;
            $sql.= "ORDER BY {$orderBy}a.modtime DESC,a.addtime DESC ";
            $sql.= "LIMIT {$offset},{$pagesize}";


        }
        $data = DB::query(1,$sql)->execute()->as_array();
        foreach($data as &$v)
        {
            $v['price'] = Model_Line::get_minprice($v['id']);
            $v['price'] = Currency_Tool::price($v['price']);
            $v['attrlist'] = Model_Line::line_attr($v['attrid']);
            $v['startcity'] = Model_Startplace::start_city($v['startcity']);
            $v['commentnum'] = Model_Comment::get_comment_num($v['id'],1); //评论次数
            $v['satisfyscore'] = Model_Comment::get_score($v['id'], 1, $v['satisfyscore'], $v['commentnum']);//满意度
            $v['stars']=Model_Comment::get_stars($v['id'], 1);
            $v['sellnum'] = Model_Member_Order::get_sell_num($v['id'],1)+intval($v['bookcount']); //销售数量
            $v['url'] = Common::get_web_url($v['webid']) . "/lines/show_{$v['aid']}.html";
            $v['litpic'] = Common::img($v['litpic'],185,120);
            $v['title'] = Common::cutstr_html($v['title'], 40);
        }
        return Product::list_search_format($data, $page);
    }


    /**
     * 线路属性
     * @param $attrid
     * @return array
     */
    public static function line_suit($id)
    {
        if (empty($attrid))
        {
            return;
        }
        $arr = DB::select('attrname')->from('line_attr')->where("id in({$attrid}) and pid!=0")->execute()->as_array();
        return $arr;
    }

    public static function get_line_by_attr($attrId,$offset, $row,$line_type=self::LINE_TYPE_LINE)
    {
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND c.number!=0 AND a.line_type={$line_type}"
            . Product::get_attr_where($attrId)
            ." AND c.leader_id IS NOT NULL "
            ." AND c.day>=".Common::day_time()
            ." GROUP By a.id"
            ." ORDER BY c.`day` ASC"
            ." LIMIT {$offset},{$row};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }


    public static function get_line_by_city($id,$offset, $row,$line_type=self::LINE_TYPE_LINE)
    {
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND c.number!=0 AND a.line_type={$line_type}"
            . " AND  FIND_IN_SET($id,a.kindlist)"
            ." AND c.leader_id IS NOT NULL "
            ." AND c.day>=".Common::day_time()
            ." GROUP By a.id"
            ." ORDER BY c.`day` ASC"
            ." LIMIT {$offset},{$row};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }


    /**
     * 线路最热门
     * @param $offset
     * @param $row
     * @return mixed
     */
    #TODO
    public static function get_line_hot_by_theme_id($offset, $row,$theme_id=0)
    {
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND c.number!=0 AND a.line_type=".self::LINE_TYPE_LINE
            . Product::get_theme_where($theme_id)
            ." AND c.leader_id IS NOT NULL "
            ." AND c.day>=".Common::day_time()
            ." GROUP By a.id"
            ." ORDER BY a.shownum desc,c.`day` ASC"
            ." LIMIT {$offset},{$row};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }

    public static function get_line_by_themeid($offset,$row,$theme_id,$line_type=self::LINE_TYPE_LINE,$is_leader=true,$ishidden=false)
    {
        $_s=$is_leader?" AND c.leader_id IS NOT NULL ":'';
        $_ss=!$ishidden?" AND a.ishidden = 0 ":'';
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.webid = 0 AND c.number!=0 AND a.line_type=".$line_type
            . Product::get_theme_where($theme_id)
            . $_s
            . $_ss
            ." AND c.day>=".Common::day_time()
            ." GROUP By a.id"
            ." ORDER BY c.`day` ASC"
            ." LIMIT {$offset},{$row};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }

    public static function get_line_by_themeid_attr($theme_id,$attrId,$offset=0,$row=10)
    {
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND c.number!=0 AND a.line_type=".self::LINE_TYPE_LINE
            . Product::get_theme_where($theme_id)
            . Product::get_attr_where($attrId)
            ." AND c.leader_id IS NOT NULL "
            ." AND c.day>=".Common::day_time()
            ." GROUP By a.id"
            ." ORDER BY c.`day` ASC"
            ." LIMIT {$offset},{$row};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }

    public static function get_line_by_month($time,$offset, $row)
    {
        $day=strtotime(date('Y-m-d'));
        $sql = "SELECT a.*,c.*  FROM `sline_line` AS a  ";
        $sql .= " LEFT JOIN sline_line_suit AS b";
        $sql .= " ON a.id=b.lineid";
        $sql .= " LEFT JOIN sline_line_suit_price AS c";
        $sql .= " ON b.id=c.suitid";
        $sql .= " WHERE a.ishidden=0 AND webid=0 AND  a.line_type=".self::LINE_TYPE_LINE;
        $sql .= " AND c.`day`>={$day} AND date_format(FROM_UNIXTIME(c.`day`),'%Y-%m')='".date('Y-m',strtotime($time))."' "
            ." AND c.number!=0 AND c.leader_id>0";
        $sql .= "  order by a.modtime desc LIMIT {$offset},{$row}";
        $data = DB::query(1,$sql)->execute()->as_array();
        if ($data){
            foreach($data as $k=>&$v)
            {
                $v['price'] = Model_Line::get_minprice($v['id']);
                $v['price'] = Currency_Tool::price($v['price']);
                $v['startcity_id'] = $v['startcity'];
                $v['attrlist'] = Model_Line::line_attr($v['attrid']);
                $v['startcity'] = Model_Startplace::start_city($v['startcity']);
                $v['commentnum'] = Model_Comment::get_comment_num($v['id'],1); //评论次数
                $v['satisfyscore'] = Model_Comment::get_score($v['id'], 1, $v['satisfyscore'], $v['commentnum']);//满意度
                $v['stars'] = Model_Comment::get_stars($v['id'], 1);//满意度
                $v['sellnum'] = Model_Member_Order::get_sell_num($v['id'],1)+intval($v['bookcount']); //销售数量
                $v['url'] = Common::_detail_url($v['aid'],$v['suitid'],$v['day']);
                $v['litpic'] = Common::img($v['litpic'],185,120);
                $v['title'] = Common::cutstr_html($v['title'], 40);
            }
        }
        return $data;
    }


    public static function get_line_by_day($day,$offset, $row)
    {
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND c.number!=0 AND a.line_type=".self::LINE_TYPE_LINE
            ." AND c.leader_id IS NOT NULL "
            ." AND c.day=".strtotime($day)
            ." GROUP By a.id"
            ." ORDER BY c.`day` ASC"
            ." LIMIT {$offset},{$row};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }

    public static function get_comment($lineid,$page=1,$pagesize=10){
        if ($lineid){
            $offset=Common::get_offset($page,$pagesize);
            $sql = "SELECT * FROM `sline_comment` WHERE articleid='{$lineid}' AND pid=0 AND typeid=".self::TYPE_ID." ORDER BY addtime DESC LIMIT {$offset},{$pagesize}";
            $data = DB::query(1, $sql)->execute()->as_array();
            return $data;
        }
    }

    public static function get_line_by_keyword($keyword,$offset=0,$limit=30,$line_type=self::LINE_TYPE_LINE){
        $sql = "SELECT a.*,c.* "
            ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
            ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
            ." WHERE a.ishidden = 0 AND a.webid = 0 AND c.number!=0 AND a.line_type={$line_type}"
            ." AND c.leader_id IS NOT NULL "
            . " AND a.`title` like '"."%{$keyword}%'"
            ." GROUP By a.id"
            ." ORDER BY c.`day` ASC"
            ." LIMIT {$offset},{$limit};";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return Common::formatActivitys($arr);
    }

    public static function get_activity($lineid,$suitid, $day,$line_type=self::LINE_TYPE_LINE,$is_stock)
    {
        if ($lineid && $suitid  && $day){
            $sql = "SELECT a.*,c.* "
                ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
                ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
                ." WHERE a.ishidden = 0 AND a.webid = 0 AND a.line_type={$line_type}"
                ." AND c.leader_id IS NOT NULL "
                ." AND c.day={$day} AND  c.suitid={$suitid} AND c.lineid=$lineid";
            $arr = DB::query(1,$sql)->execute()->current();
            return Common::formatActivity($arr);
        }

    }


    public static function getItem($lineid,$suitid, $day)
    {
        if ($lineid && $suitid  && $day){
            $sql = "SELECT a.*,c.* "
                ." FROM sline_line AS a LEFT JOIN sline_line_suit AS b ON b.lineid = a.id "
                ." LEFT JOIN sline_line_suit_price AS c ON c.suitid = b.id "
                ." WHERE "
                ." c.day={$day} AND  c.suitid={$suitid} AND c.lineid=$lineid";
            $arr = DB::query(1,$sql)->execute()->current();
            return Common::formatActivity($arr);
        }

    }










}