<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Spot extends ORM
{



    public static $typeid = 5;


    /**
     * @param $hotelid
     * @return mixed
     * 获取景点最低价
     */
    public static function get_minprice($spotid)
    {

        $sql = "SELECT MIN(ourprice) AS price,MIN(sellprice) AS sellprice FROM `sline_spot_ticket` ";
        $sql.= "WHERE spotid='$spotid' AND ourprice!=0";
        $row = DB::query(1,$sql)->execute()->as_array();
        $row[0]['price'] = Currency_Tool::price( $row[0]['price']);
        $row[0]['sellprice'] = Currency_Tool::price( $row[0]['sellprice']);
        return $row[0];
    }

    /**
     * @param $spotid
     * @return array
     * 获取扩展字段信息
     */
    public static function get_extend_info($spotid)
    {
        $row = ORM::factory('spot_extend_field')
            ->where("productid=".$spotid)
            ->find()
            ->as_array();
        return $row;
    }

    /**
     * @param $spotid
     * @return bool
     * 检测是否有门票
     */
    public static function has_ticket($spotid)
    {
        $arr = ORM::factory('spot_ticket')->where("spotid='$spotid'")->get_all();
        return count($arr) ? true : false;
    }

    /**
     * @param $destid
     * @param $row
     * @param $offset
     * @return mixed
     */

    public static function get_spot_bymdd($destid,$row,$offset)
    {
        $sql = "SELECT a.* FROM `sline_spot` AS a LEFT JOIN `sline_kindorderlist` b ON (a.id=b.aid and b.typeid=".self::$typeid." and b.classid='$destid') ";
        $sql .= "WHERE a.ishidden=0 AND FIND_IN_SET('{$destid}',a.kindlist)";
        $sql .= "ORDER BY IFNULL(b.displayorder,9999) ASC,a.modtime DESC,a.addtime DESC ";
        $sql .= "LIMIT {$offset},{$row}";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return self::format_spot_row($arr);
    }

    public static function format_spot_row($arr)
    {
        foreach($arr as &$v)
        {
            $priceArr = Model_Spot::get_minprice($v['id']);
            $v['commentnum'] = Model_Comment::get_comment_num($v['id'],self::$typeid); //评论次数
            $v['sellnum'] = Model_Member_Order::get_sell_num($v['id'],self::$typeid)+intval($v['bookcount']); //销售数量
            $v['sellprice'] = $priceArr['sellprice'];//挂牌价
            $v['price'] = $priceArr['price'];//最低价
            $v['attrlist'] = Model_Hotel_Attr::get_attr_list($v['attrid']);//属性列表.
            $v['url'] = Common::get_web_url($v['webid']) . "/spots/show_{$v['aid']}.html";
            $v['litpic'] = Common::img($v['litpic']);
            $v['iconlist'] = Product::get_ico_list($v['iconlist']);
            $v['hasticket'] = self::has_ticket($v['id']);

        }
        return $arr;
    }

    /**
     * 详情 BY aid
     * @param $aid
     * @return mixed
     */
    public static function spot_detail($aid)
    {
        $sql = "SELECT * FROM sline_spot ";
        $sql .= "WHERE webid={$GLOBALS['sys_webid']} AND ishidden=0 AND aid={$aid} ";
        $sql .= "limit 1";
        $arr = DB::query(1, $sql)->execute()->as_array();
        $arr['sellprice'] = Currency_Tool::price($arr['sellprice']);
        return $arr[0];
    }

    /**
     * 属性
     * @param $attrid
     * @return array
     */
    public static function spot_attr($attrid)
    {
        if (empty($attrid))
        {
            return;
        }
        $attrid = trim($attrid,',');
        $arr = DB::select('attrname')->from('spot_attr')->where("id in({$attrid}) and pid!=0")->execute()->as_array();
        return $arr;
    }

    //------------------------以下是搜索页新增加使用函数-----------------

    /**
     * 参数解析
     * @param $params
     */
    public static function search_result($params,$keyword,$currentpage,$pagesize='10')
    {
        $destPy = Common::remove_xss($params['destpy']);
        $priceId = Common::remove_xss($params['priceid']);
        $sortType = Common::remove_xss($params['sorttype']);
        $attrId = Common::remove_xss($params['attrid']);
        $page = $currentpage;
        $page = $page ? $page : 1;

        $where = ' WHERE a.ishidden=0 ';
        //按目的地搜索
        if($destPy && $destPy!='all')
        {
            $destId = ORM::factory('destinations')->where("pinyin='$destPy'")->find()->get('id');
            $where.= " AND FIND_IN_SET('$destId',a.kindlist) ";
        }

        //价格区间
        if($priceId)
        {
            $priceArr = ORM::factory('spot_pricelist',$priceId)->as_array();
            $where.= " AND a.price BETWEEN {$priceArr['min']} AND {$priceArr['max']} ";
        }
        //排序
        $orderBy = "";
        if(!empty($sortType))
        {
            if($sortType==1)//价格升序
            {
                $orderBy = "  a.price DESC,";
            }
            else if($sortType==2) //价格降序
            {
                $orderBy = "  a.price ASC,";
            }
            else if($sortType==3) //销量降序
            {
                $orderBy = " a.bookcount DESC,";
            }
            else if($sortType==4)//推荐
            {
                $orderBy = " a.shownum DESC,";
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
            $sql = "SELECT a.* FROM `sline_spot` a ";
            $sql.= "LEFT JOIN `sline_kindorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=".self::$typeid." AND a.webid=b.webid AND b.classid=$destId)";
            $sql.= $where;
            $sql.= "ORDER BY IFNULL(b.displayorder,9999) ASC,{$orderBy}a.modtime DESC,a.addtime DESC ";
            //$sql.= "LIMIT {$offset},{$pagesize}";

        }
        else
        {
            $sql = "SELECT a.* FROM `sline_spot` a ";
            $sql.= "LEFT JOIN `sline_allorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=".self::$typeid." AND a.webid=b.webid)";
            $sql.= $where;
            $sql.= "ORDER BY IFNULL(b.displayorder,9999) ASC,{$orderBy}a.modtime DESC,a.addtime DESC ";
            //$sql.= "LIMIT {$offset},{$pagesize}";


        }
        //计算总数
        $totalSql = "SELECT count(*) as dd ".strchr($sql," FROM");
        $totalSql = str_replace(strchr($totalSql,"ORDER BY"),'', $totalSql);//去掉order by


        $totalN = DB::query(1,$totalSql)->execute()->current();
        $totalNum = $totalN['dd'] ? $totalN['dd'] : 0;

        $sql.= "LIMIT {$offset},{$pagesize}";
        $arr = DB::query(1,$sql)->execute()->as_array();
        $arr = self::format_spot_row($arr);
        $out = array(
            'total' => $totalNum,
            'list' => $arr
        );
        return $out;


    }
    /*
    * 生成searh页地址
    * */
    public static function get_search_url($v,$paramname,$p,$currentpage=1)
    {

        $url = $GLOBALS['cfg_basehost'].'/spots/';
        switch($paramname)
        {
            case "destpy":
                $url.=$v.'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$p['attrid'].'-'.$currentpage;
                break;

            case "priceid":
                $url.=$p['destpy'].'-'.$v.'-'.$p['sorttype'].'-';
                $url.=$p['attrid'].'-'.$currentpage;
                break;
            case "sorttype":
                $url.=$p['destpy'].'-'.$p['priceid'].'-'.$v.'-';
                $url.=$p['attrid'].'-'.$currentpage;
                break;


            case "attrid":

                $orignalArr = Product::get_attr_parent($p['attrid'],self::$typeid);
                $nowArr = Product::get_attr_parent($v,self::$typeid);
                if(!empty($nowArr))
                {
                    $attrArr = $nowArr + $orignalArr;
                    sort($attrArr);
                    $attr_list = join('_',$attrArr);
                }
                else
                {
                    $attr_list = 0;
                }
                $url.=$p['destpy'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$attr_list.'-'.$currentpage;
                break;

        }
        return $url;


    }

    /**
     * @param $p
     * @return array
     * @desc 已选择项处理
     */
    public static function get_selected_item($p)
    {
        $p['displaytype'] = 0;
        $out = array();
        //目的地
        if($p['destpy']!='all')
        {
            $temp = array();
            $url = self::get_search_url('all','destpy',$p);
            $temp['url'] = $url;
            $temp['itemname'] = ORM::factory('destinations')->where("pinyin='".$p['destpy']."'")->find()->get('kindname');
            $out[]=$temp;
        }

        //价格
        if($p['priceid']!=0)
        {
            $temp = array();
            $url = self::get_search_url('0','priceid',$p);
            $temp['url'] = $url;
            $ar = ORM::factory('spot_pricelist',$p['priceid'])->as_array();
            $lowerprice = $ar[0]['min'];
            $highprice = $ar[0]['max'];
            $temp['itemname'] = self::get_price_list_title($lowerprice,$highprice);
            $out[] = $temp;

        }

        //属性
        if($p['attrid']!=0)
        {
            $attArr = $orgArr = explode('_',$p['attrid']);
            foreach($attArr as $ar)
            {

                $orgArr = $attArr;
                $temp = array();
                $temp['itemname'] = ORM::factory('spot_attr',$ar)->get('attrname');
                unset($orgArr[array_search($ar,$orgArr)]);
                if(!empty($attrid))
                {
                    $attrid = implode('_',$orgArr);
                }
                else
                {
                    $attrid = 0;
                }

                $url = $GLOBALS['cfg_basehost'].'/spots/';
                $url.=$p['destpy'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$attrid.'-1';

                $temp['url'] = $url;
                $out[] = $temp;
            }

        }
        return $out;

    }

    /**
     * @param $min
     * @param $max
     * @return string
     * @desc 根据价格大小生成价格优化标题.
     */
    public static function get_price_list_title($min,$max)
    {

        if($min!=''&& $max!='')
        {
            $title = '&yen;'.$min.'元-'.'&yen;'.$max.'元';
        }
        else if($min=='')
        {
            $title = '&yen;'.$max.'元以下';
        }
        else if($max =='')
        {
            $title ='&yen;'.$min.'元以上';
        }
        return $title;

    }

    /**
     * @param $param
     * @return string
     * @desc 生成优化标题
     */
    public static function gen_seotitle($param)
    {
        $arr = array();
        if(!empty($param['destpy']))
        {
            $destInfo = Model_Destinations::search_seo($param['destpy'],self::$typeid);
            $arr[] = $destInfo['seotitle'];
        }


        if(!empty($param['priceid']))
        {
            $priceArr= ORM::factory('spot_pricelist',$param['priceid'])->as_array();
            $price = self::get_price_list_title($priceArr['min'],$priceArr['max']);
            $arr[] = "价格区间$price";
        }

        if(!empty($param['attrid']))
        {
            $arr[] = Model_Spot_Attr::get_attrname_list($param['attrid'],'_');

        }
        return implode('_',$arr);


    }


}