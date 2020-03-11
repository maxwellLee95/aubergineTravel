<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line extends ORM
{
    /**
     * 线路最低价
     * @param $lineid
     * @return int
     */
    public static function get_minprice($lineid)
    {
        $time = time();

        $sql = "select min(adultprice) as price,min(childprice) as cprice,min(oldprice) as oprice from sline_line_suit_price where lineid='$lineid' and day > '$time'  limit 60";
        $row = DB::query(1, $sql)->execute()->as_array();
        //获取小孩 或者老人价格
        $row['cprice'] = !empty($row[0]['cprice']) ? $row[0]['cprice'] :$row[0]['oprice'];
        // 没有成人报价
        $row[0]['price'] = !empty($row[0]['price']) ? Currency_Tool::price($row[0]['price']) : Currency_Tool::price($row[0]['cprice']);

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
        $attrid = trim($attrid,',');

        $arr = DB::select('attrname')->from('line_attr')->where("id in({$attrid}) and pid!=0")->execute()->as_array();
        return $arr;
    }

    /**
     * 线路详情
     * @param $id
     * @return array
     */
    public static function detail($id)
    {
        $sql = "SELECT * FROM sline_line WHERE aid={$id} and webid={$GLOBALS['sys_webid']}";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr[0];
    }

    /**
     * @param $destid
     * @param $row
     * @param $offset
     * @desc 按目的地获取线路
     */

    public static function get_line_bymdd($destid,$row,$offset)
    {
        $sql = "SELECT a.* FROM `sline_line` AS a LEFT JOIN `sline_kindorderlist` b ON (a.id=b.aid and b.typeid=1 and b.classid='$destid') ";
        $sql .= "WHERE a.ishidden=0 AND FIND_IN_SET('{$destid}',a.kindlist)";
        $sql .= "ORDER BY IFNULL(b.displayorder,9999) ASC,a.modtime DESC,a.addtime DESC ";
        $sql .= "LIMIT {$offset},{$row}";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return self::format_line_row($arr);
    }

    /**
     * @param $list
     * @return mixed
     * @desc 格式化线路列
     */
    public static function format_line_row($list)
    {
        foreach ($list as &$v)
        {

            $v['price'] = Model_Line::get_minprice($v['id']);

            $v['attrlist'] = Model_Line::line_attr($v['attrid']);

            $v['url'] = Common::get_web_url($v['webid']) . "/lines/show_{$v['aid']}.html";

            $v['startcity'] = Model_Startplace::start_city($v['startcity']);

            $v['iconlist'] = Product::get_ico_list($v['icolist']);
        }
        return $list;
    }



    /**
     * 参数解析
     * @param $params
     */
    public static function search_result($params,$keyword,$currentpage,$pagesize='10')
    {

        $destPy = Common::remove_xss($params['destpy']);
        $dayId = Common::remove_xss($params['dayid']);
        $priceId = Common::remove_xss($params['priceid']);
        $sortType = Common::remove_xss($params['sorttype']);
        $startcityId = Common::remove_xss($params['startcityid']);
        $attrId = Common::remove_xss($params['attrid']);
        $keyword = Common::remove_xss($keyword);
        $page = $currentpage;
        $page = $page ? $page : 1;





        $where = ' WHERE a.ishidden=0 ';
        //按目的地搜索
        if($destPy && $destPy!='all')
        {
            $destId = ORM::factory('destinations')->where("pinyin='$destPy'")->find()->get('id');
            $where.= " AND FIND_IN_SET('$destId',a.kindlist) ";
        }
        //天数
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
          /*  else if($sortType==5) //满意度
            {
                $orderBy = " a.shownum desc,";
            }*/
        }

        //关键词
        if(!empty($startcityId))
        {
            $where.= " AND a.startcity=$startcityId ";
        }
        //按属性
        if(!empty($attrId))
        {
            $where.= Product::get_attr_where($attrId);
        }
        //按关键词
        if(!empty($keyword))
        {
            $where.=" AND a.title like '%$keyword%' ";
        }

        $offset = (intval($page)-1)*$pagesize;



        //如果选择了目的地
        if(!empty($destId))
        {
            $sql = "SELECT a.* FROM `sline_line` a ";
            $sql.= "LEFT JOIN `sline_kindorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=1 AND a.webid=b.webid AND b.classid=$destId)";
            $sql.= $where;
            $sql.= "ORDER BY IFNULL(b.displayorder,9999) ASC,{$orderBy}a.modtime DESC,a.addtime DESC ";
            //$sql.= "LIMIT {$offset},{$pagesize}";

        }
        else
        {
            $sql = "SELECT a.* FROM `sline_line` a ";
            $sql.= "LEFT JOIN `sline_allorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=1 AND a.webid=b.webid)";
            $sql.= $where;
            $sql.= "ORDER BY IFNULL(b.displayorder,9999) ASC,{$orderBy}a.modtime DESC,a.addtime DESC ";
            //$sql.= "LIMIT {$offset},{$pagesize}";


        }

        //计算总数
        $totalSql = "SELECT count(*) as dd ".strchr($sql," FROM");
        $totalSql = str_replace(strchr($totalSql,"ORDER BY"),'', $totalSql);//去掉order by


        $totalN = DB::query(1,$totalSql)->execute()->as_array();
        $totalNum = $totalN[0]['dd'] ? $totalN[0]['dd'] : 0;

        //数据量大时的优化方法,数据量小时不推荐使用此方法
        //$idWhere = "SELECT id FROM `sline_line` ORDER BY id limit $offset, 1";
        //$sql = str_replace("WHERE","WHERE a.id>($idWhere) AND",$sql);
        //$sql.= "LIMIT {$pagesize}";

        $sql.= "LIMIT {$offset},{$pagesize}";

        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as &$v)
        {
            $v['price'] = Model_Line::get_minprice($v['id']);
            $v['attrlist'] = Model_Line::line_attr($v['attrid']);
            $v['startcity'] = Model_Startplace::start_city($v['startcity']);
            $v['commentnum'] = Model_Comment::get_comment_num($v['id'],1); //评论次数
            $v['sellnum'] = Model_Member_Order::get_sell_num($v['id'],1)+intval($v['bookcount']); //销售数量
            $v['url'] = Common::get_web_url($v['webid']) . "/lines/show_{$v['aid']}.html";
            $v['litpic'] = Common::img($v['litpic']);
            $v['iconlist'] = Product::get_ico_list($v['iconlist']);
            $v['startdate'] = Model_Line::get_startdate($v);
        }
        $out = array(
            'total' => $totalNum,
            'list' => $arr
        );
        return $out;

    }

    /**
     * @param $lineid
     * @return bool
     * 线路提前天数是否开启.
     */
    public static function is_line_before($lineid)
    {
            if(empty($lineid))
                return false;
            $islinebefore = ORM::factory('line',$lineid)->get('islinebefore');
            if($islinebefore==1)
                return true;
            return false;
    }

    /**
     * @return mixed
     * @desc:获取套餐报价
     */
    public static function get_suit_price($suitid)
    {
        $time = time();
        $sql="SELECT * FROM `sline_line_suit_price` WHERE suitid='$suitid' and day >='$time' and (adultprice>0 or childprice>0 or oldprice>0) and `number`!=0 ";
        $arr=DB::query(1,$sql)->execute()->as_array();

        foreach($arr as &$v)
        {
            $v['childprofit'] = Currency_Tool::price($v['childprofit']);
            $v['childbasicprice'] = Currency_Tool::price($v['childbasicprice']);
            $v['childprice'] = Currency_Tool::price($v['childprice']);
            $v['oldprofit'] = Currency_Tool::price($v['oldprofit']);
            $v['oldbasicprice'] = Currency_Tool::price($v['oldbasicprice']);
            $v['oldprice'] = Currency_Tool::price($v['oldprice']);
            $v['adultprofit'] = Currency_Tool::price($v['adultprofit']);
            $v['adultbasicprice'] = Currency_Tool::price($v['adultbasicprice']);
            $v['adultprice'] = Currency_Tool::price($v['adultprice']);
            $v['roombalance'] = Currency_Tool::price($v['roombalance']);

        }
        return $arr;
    }

    //新增线路处理函数

    //处理出发日期列表和出发日期下拉选择

    public static function get_startdate($row)
    {
        $today = time();
        $montharr = self::get_month_price_list($row['id']);
        $monthstr = '';
        $curday = (int)date('d', $today);
        if(empty($montharr))
        {

            $monthstr = empty($row['linedate']) ? '电询' : $row['linedate'];
        }
        else
        {
            foreach($montharr as $key => $value)
            {
                $monthstr .= $key . '、';
                //$weekday = date('w', strtotime(date('Y', $today) . '-' . $key));
            }
            if(!empty($monthstr))
            {
                $monthstr = trim($monthstr, '、');
                $monthstr .= '日,';
            }

        }
        return $monthstr;
    }

    //获取最近报价

    public static function get_month_price_list($lineid)
    {
        $time = time();
        $sql = "SELECT * FROM `sline_line_suit_price` WHERE lineid='$lineid' AND day>{$time} ORDER BY day ASC limit 0,6";
        $arr = DB::query(1,$sql)->execute()->as_array();
        $monthprice = array();
        foreach($arr as $row)
        {
            $key = date('m-d', $row['day']);
            $row['adultprice'] = Currency_Tool::price($row['adultprice']);
            $monthprice[$key] = $row['adultprice'];

        }
        return $monthprice;
    }

    /*
     * 生成searh页地址
     * */
    public static function get_search_url($v,$paramname,$p,$currentpage=1)
    {

        $url = $GLOBALS['cfg_basehost'].'/lines/';
        switch($paramname)
        {
            case "destpy":
                $url.=$v.'-'.$p['dayid'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$p['displaytype'].'-'.$p['startcityid'].'-'.$p['attrid'].'-'.$currentpage;
                break;
            case "dayid":
                $url.=$p['destpy'].'-'.$v.'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$p['displaytype'].'-'.$p['startcityid'].'-'.$p['attrid'].'-'.$currentpage;
                break;
            case "priceid":
                $url.=$p['destpy'].'-'.$p['dayid'].'-'.$v.'-'.$p['sorttype'].'-';
                $url.=$p['displaytype'].'-'.$p['startcityid'].'-'.$p['attrid'].'-'.$currentpage;
                break;
            case "sorttype":
                $url.=$p['destpy'].'-'.$p['dayid'].'-'.$p['priceid'].'-'.$v.'-';
                $url.=$p['displaytype'].'-'.$p['startcityid'].'-'.$p['attrid'].'-'.$currentpage;
                break;
            case "displaytype":
                $url.=$p['destpy'].'-'.$p['dayid'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$v.'-'.$p['startcityid'].'-'.$p['attrid'].'-'.$currentpage;
                break;
            case "startcityid":
                $url.=$p['destpy'].'-'.$p['dayid'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$p['displaytype'].'-'.$v.'-'.$p['attrid'].'-'.$currentpage;
                break;
            case "attrid":

                $orignalArr = Product::get_attr_parent($p['attrid'],1);
                $nowArr = Product::get_attr_parent($v,1);
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


                $url.=$p['destpy'].'-'.$p['dayid'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$p['displaytype'].'-'.$p['startcityid'].'-'.$attr_list.'-'.$currentpage;
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
        //天数
        if($p['dayid']!=0)
        {
            $temp = array();
            $url = self::get_search_url('0','dayid',$p);
            $temp['url'] = $url;
            $temp['itemname'] = Product::to_upper($p['dayid']);
            $out[] = $temp;

        }
        //价格
        if($p['priceid']!=0)
        {
            $temp = array();
            $url = self::get_search_url('0','priceid',$p);
            $temp['url'] = $url;
            $ar = ORM::factory('line_pricelist',$p['priceid'])->as_array();
            $lowerprice = $ar['lowerprice'];
            $highprice = $ar['highprice'];
            $temp['itemname'] = self::get_price_list_title($lowerprice,$highprice);
            $out[] = $temp;

        }
        //startcityid
        if($p['startcityid']!=0)
        {
            $temp = array();
            $url = self::get_search_url('0','startcityid',$p);
            $temp['url'] = $url;
            $temp['itemname'] = ORM::factory('startplace',$p['startcityid'])->get('cityname');
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
                $temp['itemname'] = ORM::factory('line_attr',$ar)->get('attrname');
                unset($orgArr[array_search($ar,$orgArr)]);
                if(!empty($attrid))
                {
                    $attrid = implode('_',$orgArr);
                }
                else
                {
                    $attrid = 0;
                }

                $url = $GLOBALS['cfg_basehost'].'/lines/';
                $url.=$p['destpy'].'-'.$p['dayid'].'-'.$p['priceid'].'-'.$p['sorttype'].'-';
                $url.=$p['displaytype'].'-'.$p['startcityid'].'-'.$attrid.'-1';

                $temp['url'] = $url;
                $out[] = $temp;
            }

        }
        return $out;

    }

    /*
     * 价格格式化
     * */
    public static function get_price_list_title($lowerprice,$highprice)
    {
        if($lowerprice!=''&& $highprice!='')
        {
            $title = '&yen;'.$lowerprice.'元-'.'&yen;'.$highprice.'元';
        }
        else if($lowerprice=='')
        {
            $title='&yen;'.$highprice.'元以下';
        }
        else if($highprice=='')
        {
            $title='&yen;'.$lowerprice.'元以上';
        }
        return $title;
    }

    /*
    * 生成优化标题
    */
    public static function gen_seotitle($param)
    {
        $arr = array();
        if(!empty($param['destpy']))
        {
            $destInfo = Model_Destinations::search_seo($param['destpy'],1);
            $arr[] = $destInfo['seotitle'];
        }
        if(!empty($param['dayid']))
        {
            $arr[] = $param['dayid']."日游";
        }

        if(!empty($param['priceid']))
        {
            $priceArr= ORM::factory('line_pricelist',$param['priceid'])->as_array();

            $arr[] = "价格区间{$priceArr[0]['lowerprice']}-{$priceArr[0]['highprice']}";
        }

        if(!empty($param['attrid']))
        {
            $arr[] = Model_Line_Attr::get_attrname_list($param['attrid'],'_');

        }
        if(!empty($param['startcityid']))
        {
            $arr[] = Model_Startplace::start_city($param['startcityid'])."出发";

        }
        return implode('_',$arr);


    }


    /**
     * @param $ids
     * @param $day
     * @return mixed
     * @desc 获取线路保险
     */
    public static function get_insurances($ids,$day)
    {

        $sql = "SELECT * FROM `sline_insurance` WHERE FIND_IN_SET(id,'$ids')";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as &$v)
        {
            $productArr=unserialize($v['content']);
            $desc = $productArr['ProductDetailsResponse']['ProductDetails']['Product']['ShortDescription']
.$productArr['ProductDetailsResponse']['ProductDetails']['Product']['FullDescription'][0];
            $v['description'] = $desc;
            $v['day'] = $day;


        }
        return $arr;
    }



}