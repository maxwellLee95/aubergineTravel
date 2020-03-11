<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Car extends ORM
{



    /*
     * 获取目的地优化标题
     * */
    public static function search_seo($destpy)
    {
        if(!empty($destpy) && $destpy!='all')
        {
            $destId = ORM::factory('destinations')->where("pinyin='$destpy' AND isopen=1")->find()->get('id');
            $info = ORM::factory('destinations',$destId)->as_array();
            $seotitle = $info['seotitle'] ? $info['seotitle'] : $info['kindname'];
        }
        else
        {
            $info = Model_Nav::get_channel_info(3);
            $seotitle = $info['seotitle'] ? $info['seotitle'] : $info['m_title'];
        }

        return array('seotitle'=>$seotitle);
    }

    /**
     * 结伴排序
     * @param $offset
     * @param $row
     * @return mixed
     */
    public static function get_car_list($whereStr='',$offset, $row)
    {
        $sql = "SELECT a.id,a.webid,a.sellpoint,a.aid,a.kindlist,a.title,a.litpic,a.shownum,a.price,a.satisfyscore,a.bookcount,a.attrid,a.iconlist,a.carkindid";
        $sql .= " FROM `sline_car` AS a LEFT JOIN `sline_allorderlist` b ON (a.id=b.aid and b.typeid=3)";
        $sql .= " WHERE a.id>0 ".$whereStr;
        $sql .= " ORDER BY IFNULL(b.displayorder,9999) ASC,a.addtime DESC";
        $sql .= " LIMIT {$offset},{$row}";
        $arr = DB::query(1,$sql)->execute()->as_array();

        foreach ($arr as &$v)
        {
            //如果没有图片
            if(empty($v['litpic']))
            {
                $v['litpic'] = Common::nopic();
            }
            $v['url'] = Common::get_web_url($v['webid']).'/cars/show_'.$v['aid'].'.html';
            //价格
            $v['price']= Model_Car::get_car_suit_price($v['aid'], $v['webid'] , $v['id']);
            //车辆属性
            //车辆属性
            $v['attrlist'] = Model_Car_attr::get_attr_list($v['attrid']);
            //车型
            $v['kindname'] = Model_Car_Kind::get_carkindname($v['carkindid']);

        }
        return $arr;
    }
    /**
     * 获取车子新版最低报价
     * @param $aid
     * @param $webid
     * @param int $carid
     * @param int $suitid
     * @return int
     */
    public static function get_car_suit_price($aid,$webid,$carid=0,$suitid=0)
    {
        if(empty($carid))
        {
            $sql = "SELECT * FROM sline_car WHERE aid={$aid} AND webid={$webid}";
            $dataArr = NULL;
            $dataArr = DB::query(1, $sql)->execute()->as_array();
            $carid = $dataArr[0]['id'];
        }
        $w = $suitid ? " AND suitid ='{$suitid}' " : ''; //是否按套餐读取
        $time = time();
        if($suitid) //如果指定了套餐id
        {
            $sql = "SELECT MIN(adultprice) AS price FROM sline_car_suit_price WHERE carid='{$carid}' AND day > '{$time}' {$w} LIMIT 60";
        }
        else
        {
            $suitidlist = implode(',',self::get_car_suitId_list($carid));
            $w =empty($suitidlist)?'':" AND suitid IN ($suitidlist)";
            $sql = "SELECT MIN(adultprice) AS price FROM sline_car_suit_price WHERE carid='{$carid}' AND day > '{$time}' {$w} LIMIT 60";
        }

        $dataArr = NULL;
        $dataArr = DB::query(1, $sql)->execute()->as_array();
        $dataArr[0]['price'] = Currency_Tool::price($dataArr[0]['price']);
        return $dataArr[0]['price'] ? $dataArr[0]['price'] : 0;
    }

    /**
     * 获取车子套餐id列表
     * @param $carid
     * @return array
     */
    function get_car_suitId_list($carid)
    {
        $sql = "SELECT * FROM sline_car_suit WHERE carid={$carid}";
        $data = NULL;
        $dataArr = DB::query(1, $sql)->execute()->as_array();
        foreach($dataArr as $row)
        {
            array_push($out,$row['id']);
        }
        return $out;
    }
    /*
     *获取套餐日期范围内价格总和.
     * */
    public static function suit_range_price($suitid,$sdate,$edate,$dingnum)
    {
        $sdate = strtotime($sdate);
        $edate = strtotime($edate);
        $sql = "SELECT adultprice FROM`sline_car_suit_price` ";
        $sql.= "WHERE suitid='$suitid' AND day>=$sdate AND day<$edate";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $price = 0;
        foreach($ar as $row)
        {
            $row['adultprice'] = Currency_Tool::price($row['adultprice']);
            $price+=$row['adultprice']*$dingnum;
        }
        return $price;
    }

    /**
     * @param $suitid
     * @return mixed
     * 获取套餐最小可预订日期
     */

    public static function suit_mindate_book($suitid)
    {
        $time = time();
        $sql = "SELECT day FROM`sline_car_suit_price` ";
        $sql.= "WHERE suitid='$suitid' AND day>=$time AND price>0 AND number!=0 LIMIT 1";
        $ar = DB::query(1,$sql)->execute()->as_array();
        return $ar[0]['day'];
    }

    /**
     * @param $aid
     * @return mixed
     * 租车详情
     */
    public static function detail($aid)
    {
        $sql = "SELECT * FROM `sline_car` WHERE aid={$aid} and webid={$GLOBALS['sys_webid']}";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr[0];
    }

    /**
     * 租车属性
     * @param $attrid
     * @return array
     */
    public static function car_attr($attrid)
    {
        if (empty($attrid))
        {
            return;
        }
        $attrid = trim($attrid,',');
        $arr = DB::select('attrname')->from('car_attr')->where("id in({$attrid}) and pid!=0")->execute()->as_array();
        return $arr;
    }

    /**
     * @param $id
     * @param int $sutid
     * @return mixed
     * @desc 获取产品最低价格
     */
    public static function get_minprice($carid,$suitid=0)
    {
        $where = !empty($suitid) ? " AND suitid=$suitid" : '';
        $sql = "SELECT MIN(adultprice) AS price FROM `sline_car_suit_price` WHERE carid='$carid' AND adultprice!=0 AND day>=UNIX_TIMESTAMP() {$where}";
        $row = DB::query(1,$sql)->execute()->as_array();
        $row[0]['price']=Currency_Tool::price($row[0]['price']);
        return $row[0]['price'];

    }

    /**
     * 参数解析
     * @param $params
     */
    public static function search_result($params,$keyword,$currentpage,$pagesize='10')
    {
        $destPy = Common::remove_xss($params['destpy']);
        $carkindId = Common::remove_xss($params['carkindid']);
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
        //车型
        if($carkindId)
        {
            $where.= " AND a.carkindid='$carkindId'";
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
            $sql = "SELECT a.* FROM `sline_car` a ";
            $sql.= "LEFT JOIN `sline_kindorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=2 AND a.webid=b.webid AND b.classid=$destId)";
            $sql.= $where;
            $sql.= "ORDER BY IFNULL(b.displayorder,9999) ASC,{$orderBy}a.modtime DESC,a.addtime DESC ";
            //$sql.= "LIMIT {$offset},{$pagesize}";

        }
        else
        {
            $sql = "SELECT a.* FROM `sline_car` a ";
            $sql.= "LEFT JOIN `sline_allorderlist` b ";
            $sql.= "ON (a.id=b.aid AND b.typeid=2 AND a.webid=b.webid)";
            $sql.= $where;
            $sql.= "ORDER BY IFNULL(b.displayorder,9999) ASC,{$orderBy}a.modtime DESC,a.addtime DESC ";
            //$sql.= "LIMIT {$offset},{$pagesize}";


        }
        //计算总数
        $totalSql = "SELECT count(*) as dd ".strchr($sql," FROM");
        $totalSql = str_replace(strchr($totalSql,"ORDER BY"),'', $totalSql);//去掉order by


        $totalN = DB::query(1,$totalSql)->execute()->as_array();
        $totalNum = $totalN[0]['dd'] ? $totalN[0]['dd'] : 0;

        $sql.= "LIMIT {$offset},{$pagesize}";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as &$v)
        {
            $v['sellnum'] = Model_Member_Order::get_sell_num($v['id'],3)+intval($v['bookcount']); //销售数量
            $v['price'] = Model_Car::get_minprice($v['id']);//最低价
            $v['price'] = Currency_Tool::price($v['price']);
            $v['attrlist'] = Model_Car_Attr::get_attr_list($v['attrid']);//属性列表.
            $v['url'] = Common::get_web_url($v['webid']) . "/cars/show_{$v['aid']}.html";
            //车型
            $v['kindname'] = Model_Car_Kind::get_carkindname($v['carkindid']);
            $v['iconlist'] = Product::get_ico_list($v['iconlist']);
        }
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

        $url = $GLOBALS['cfg_basehost'].'/cars/';
        switch($paramname)
        {
            case "destpy":
                $url.=$v.'-'.$p['carkindid'].'-'.$p['sorttype'].'-';
                $url.=$p['attrid'].'-'.$currentpage;
                break;

            case "carkindid":
                $url.=$p['destpy'].'-'.$v.'-'.$p['sorttype'].'-';
                $url.=$p['attrid'].'-'.$currentpage;
                break;
            case "sorttype":
                $url.=$p['destpy'].'-'.$p['carkindid'].'-'.$v.'-';
                $url.=$p['attrid'].'-'.$currentpage;
                break;


            case "attrid":

                $orignalArr = Product::get_attr_parent($p['attrid'],3);
                $nowArr = Product::get_attr_parent($v,3);
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
                $url.=$p['destpy'].'-'.$p['carkindid'].'-'.$p['sorttype'].'-';
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
        if($p['carkindid']!=0)
        {
            $temp = array();
            $url = self::get_search_url('0','carkindid',$p);
            $temp['url'] = $url;
            $temp['itemname'] = Model_Car_Kind::get_carkindname($p['carkindid']);
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
                $temp['itemname'] = ORM::factory('car_attr',$ar)->get('attrname');
                unset($orgArr[array_search($ar,$orgArr)]);
                if(!empty($attrid))
                {
                    $attrid = implode('_',$orgArr);
                }
                else
                {
                    $attrid = 0;
                }

                $url = $GLOBALS['cfg_basehost'].'/cars/';
                $url.=$p['destpy'].'-'.$p['carkindid'].'-'.$p['sorttype'].'-'.$attrid.'-1';
                $temp['url'] = $url;
                $out[] = $temp;
            }

        }
        return $out;

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
            $destInfo = Model_Destinations::search_seo($param['destpy'],1);
            $arr[] = $destInfo['seotitle'];
        }
        if(!empty($param['carkindid']))
        {

            $arr[] = Model_Car_Kind::get_carkindname($param['carkindid']);
        }



        if(!empty($param['attrid']))
        {
            $arr[] = Model_Car_Attr::get_attrname_list($param['attrid'],'_');

        }
        return implode('_',$arr);


    }




}