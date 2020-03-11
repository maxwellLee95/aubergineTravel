<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Destinations extends ORM
{
   
    public static function  home_display()
    {
        $sql = 'select * from (select kindid,displayorder from sline_line_kindlist where isnav=1) as a left join (select id,kindname,pinyin,opentypeids from sline_destinations) as b on a.kindid=b.id where find_in_set(b.opentypeids,1) order by a.displayorder asc';
        return DB::query(Database::SELECT, $sql)->execute()->as_array();
    }

    /**
     * 生成子站列表
     */
    public static function gen_web_list()
    {
        $webfile = APPPATH.'/cache/weblist.php';
        if (!file_exists($webfile))
        {
            $out = array();
            $arr = ORM::factory('destinations')
                ->where("iswebsite=1")
                ->get_all();
            foreach($arr as $row)
            {
                $out[$row['webprefix']]=array(
                    'webprefix'=>$row['webprefix'],
                    'weburl'=>$row['weburl'],
                    'kindname'=>$row['kindname'],
                    'webid'=>$row['id']
                );
            }
            if(!empty($out))
            {

                $weblist = "<?php defined('SYSPATH') or die('No direct script access.');". PHP_EOL . "\$weblist= ".var_export($out,true).";";
                $fp = fopen($webfile,'wb');
                flock($fp,3);
                fwrite($fp,$weblist);
                fclose($fp);
            }

        }

    }


    /**
     * 按栏目读取热门目的地
     * @param $typeid
     */
    public static function get_hot_dest($typeid=0,$offset=0,$row=30,$destid)
    {
        if($typeid==0)
        {
            $where = $destid ? "isopen=1 AND ishot=1 AND pid=$destid" : "isopen=1 AND ishot=1";
            $arr = ORM::factory('destinations')
                ->where($where)
                ->order_by("displayorder","ASC")
                ->offset($offset)
                ->limit($row)
                ->get_all();
        }
        else
        {
            $pinyin = ORM::factory('model',$typeid)->get('pinyin');
            if(!empty($pinyin))
            {
                //对应目的地表
                $table = 'sline_' . $pinyin . '_kindlist';
                $destwhere = $destid ? " AND a.pid=$destid " : "";
                $sql = "SELECT a.id,a.kindname,a.pinyin FROM `sline_destinations` a LEFT JOIN ";
                $sql .= "`$table` b ON (a.id=b.kindid AND IFNULL(b.ishot,0)=1) ";
                $sql .= "WHERE FIND_IN_SET($typeid,a.opentypeids) AND IFNULL(b.ishot,0)=1 $destwhere";
                $sql .= "ORDER BY IFNULL(b.displayorder,9999) ASC ";
                $sql .= "LIMIT $offset,$row";
                $arr = DB::query(1,$sql)->execute()->as_array();

            }

        }
        return $arr;

    }

    /**
     * @param $offset
     * @param $row
     * @return mixed 顶级目的地列表
     */
    public static function get_top($offset, $row)
    {
        $arr = ORM::factory('destinations')
            ->where("pid=0 AND isopen=1")
            ->order_by('displayorder', 'ASC')
            ->offset($offset)
            ->limit($row)
            ->get_all();
        return $arr;

    }

    /**
     * @param $offset 偏移量
     * @param $row  条数
     * @param $pid  父级目的地id
     * @return mixed 下级目的地列表
     */
    public static function get_next($offset, $row, $pid,$typeid)
    {
        $typeid = $typeid ? $typeid : 0;
        $typewhere =$typeid ? " AND FIND_IN_SET($typeid,opentypeids) " : "";
        $sql = "SELECT * FROM `sline_destinations` ";
        $sql.= "WHERE pid=$pid AND isopen=1 {$typewhere}";
        $sql.= "ORDER BY displayorder ASC ";
        $sql.= "LIMIT {$offset},{$row}";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return $arr;
    }

    /**
     * @param $offset
     * @param $row
     * @return mixed 首页导航目的地
     */
    public static function get_index_nav($offset, $row)
    {
        $arr = ORM::factory('destinations')
            ->where("isnav=1 AND isopen=1")
            ->order_by('displayorder', 'ASC')
            ->offset($offset)
            ->limit($row)
            ->get_all();
        return $arr;
    }

    /**
     * @param $offset
     * @param $row
     * @param $typeid
     * @return array 栏目首页导航目的地
     */

    public static function get_channel_nav($offset, $row, $typeid)
    {
        $pinyin = ORM::factory('model', $typeid)->get('pinyin');
        $arr = array();
        if ($pinyin)
        {
            //对应目的地表
            $table = 'sline_' . $pinyin . '_kindlist';
            $sql = "SELECT a.id,a.kindname,a.pinyin FROM `sline_destinations` a LEFT JOIN ";
            $sql .= "`$table` b ON (a.id=b.kindid) ";
            $sql .= "WHERE FIND_IN_SET($typeid,a.opentypeids) AND b.isnav=1 ";
            $sql .= "ORDER BY IFNULL(b.displayorder,9999) ASC ";
            $sql .= "LIMIT $offset,$row";
            $arr = DB::query(Database::SELECT, $sql)->execute()->as_array();
        }
        return $arr;
    }

   /*
    * 获取目的地最后一级信息
    * */

    public static function  get_last_dest($kindlist)
    {
        $kindlistArr = explode(',', $kindlist);
        $maxdest = max($kindlistArr);
        if(empty($maxdest))
            return array();

        $sql = "SELECT	* FROM	sline_destinations WHERE id ={$maxdest}";
        $rows = DB::query(Database::SELECT, $sql)->execute()->as_array();
        if(count($rows) > 0)
            return $rows[0];
        else
            return array();
    }

    /*
    * 获取目的地通过拼音
    * */
    public static function get_dest_bypinyin($destpy)
    {
        if (!empty($destpy) && $destpy != 'all')
        {
            $rows = ORM::factory('destinations')->where("pinyin='$destpy' AND isopen=1")->get_all();
            if (count($rows) > 0)
                return $rows[0];
            else
                return array();
        } else
        {
            return array();
        }
    }

    /*
    * 获取目的地优化标题
    * */
    public static function search_seo($destpy, $typeid)
    {
        $file = SLINEDATA . "/autotitle.cache.inc.php"; //载入智能title配置
        if (file_exists($file))
        {
            require_once($file);
        }
        $result = array(
            'seotitle' => "",
            'keyword' => "",
            'description' => ""
        );

        if (!empty($destpy) && $destpy != 'all')
        {
            $dest = Model_Destinations::get_dest_bypinyin($destpy);
            $destId = $dest["id"];
            if (!empty($destId))
            {
                $seotitle = "";
                $model = ORM::factory("model", $typeid)->as_array();
                if (!empty($model['pinyin']))
                {
                    $kindlist_tablename = "sline_{$model['pinyin']}_kindlist";
                    $sql = "select a.kindname,b.seotitle,b.keyword,b.description FROM sline_destinations a LEFT JOIN $kindlist_tablename b ON a.id=b.kindid where b.kindid='$destId'";
                    $info = DB::query(1,$sql)->execute()->current();
                    //$info = ORM::factory($kindlist_tablename)->where("kindid", "=", $destId)->find()->as_array();
                    $seotitle = $info['seotitle'] ? $info['seotitle'] : $info['kindname'];
                    $result["seotitle"] = $seotitle;
                    $result["keyword"] = $info["keyword"];
                    $result["description"] = $info["description"];
                }
                if (empty($seotitle))
                {
                    $info = ORM::factory('destinations', $destId)->as_array();
                    //读取自动优化标题
                    if(empty($info['seotitle']) && !empty($cfg_dest_title))
                    {
                        $autotitle = str_replace('XXX', $info['kindname'], $cfg_dest_title);
                    }
                    //读取自动描述
                    if(empty($info['description']) && !empty($cfg_dest_desc))
                    {
                        $autodesc = str_replace('XXX', $info['kindname'], $cfg_dest_desc);
                    }


                    $result['seotitle'] = $info['seotitle'] ? $info['seotitle'] : $autotitle;
                    $result['seotitle'] = !empty($result['seotitle']) ? $result['seotitle'] : $info['kindname'];
                    $result['keyword'] = $info["keyword"];
                    $result['description'] = $info['description'] ? $info['description'] : $autodesc;

                }


            }
        }
        else
        {
            $info = Model_Nav::get_channel_info($typeid);
            $result["seotitle"] = $info['seotitle'] ;
            $result["keyword"] = $info["keyword"];
            $result["description"] = $info["description"];
        }

        return $result;
    }

    /**
     * @param $destid
     * @return array
     * @desc 返回上级所有目的地
     */

    public static function get_prev_dest($destid)
    {

        $loopid=$destid;
        $result=array();
        $looptime = 1;
        while(1)
        {
            $pid = ORM::factory('destinations',$loopid)->get('pid');
            if($pid!=0)
            {
                $pinfo = ORM::factory('destinations',$pid)->as_array();
                $result[]=$pinfo;
                $loopid=$pinfo['id'];
            }
            else
            {
                break;
            }
            //增加一个循环跳出机制,避免因数据库问题造成死循环
            $looptime++;
            if($looptime > 5)
            {
                break;
            }


        }
        $count=count($result);
        for($i=$count-1;$i>=0;$i--)
        {
            $newresult[]=$result[$i];
        }
        $destinfo=ORM::factory('destinations',$destid)->as_array();
        $newresult[]=$destinfo;
        return $newresult;

    }


    /**
     * @param $py
     * @desc 根据拼音首字母返回目的地
     */
    public static function get_dest_by_pinyin($py,$typeid,$offset,$row)
    {
        $ar = explode(',',$py);
        $whereArr = array();
        foreach($ar as $a)
        {
            $whereArr[]="a.pinyin LIKE '$a%' ";
        }
        $where = implode(" OR ",$whereArr);
        if($typeid==0)
        {
            $where = "isopen=1 AND ishot=1";
            $arr = ORM::factory('destinations')
                ->where($where)
                ->order_by("displayorder","ASC")
                ->offset($offset)
                ->limit($row)
                ->get_all();
        }
        else
        {
            $pinyin = ORM::factory('model',$typeid)->get('pinyin');
            if(!empty($pinyin))
            {
                //对应目的地表
                $table = 'sline_' . $pinyin . '_kindlist';
                $sql = "SELECT a.id,a.kindname,a.pinyin FROM `sline_destinations` a LEFT JOIN ";
                $sql .= "`$table` b ON (a.id=b.kindid) ";
                $sql .= "WHERE FIND_IN_SET($typeid,a.opentypeids) AND ($where) ";
                $sql .= "ORDER BY IFNULL(b.displayorder,9999) ASC ";
                $sql .= "LIMIT {$offset},{$row}";
                $arr = DB::query(1,$sql)->execute()->as_array();

            }

        }
        return $arr;



    }

    /**
     * @param $keyword
     * @return string
     * @desc 匹配拼音
     */

    public static  function match_pinyin($keyword,$typeid)
    {
        if(empty($typeid))
        {
            $sql = "SELECT kindname AS matchname FROM `sline_destinations` WHERE isopen=1";
        }
        else
        {
            $modelInfo = ORM::factory('model',$typeid)->as_array();
            $joinTable = 'sline_'.$modelInfo['pinyin'].'_kindlist';
            $sql = "SELECT a.kindname FROM `sline_destinations` a ";
            $sql.= "LEFT JOIN $joinTable as b ON(a.id=b.kindid)  ";
            $sql.= "WHERE a.isopen=1 AND FIND_IN_SET($typeid,a.opentypeids)";

        }


        $res = DB::query(1,$sql)->execute()->as_array();
        $str = '';


        foreach($res AS $row) // 获取全部name
        {
            if(strlen($keyword) == 1)
            {
                $pinyin = Common::get_pinyin($row['kindname']); // 获取拼音
                if(strpos($pinyin, $keyword) !== false)
                {
                    if(substr($pinyin, 0, 1) == $keyword)
                    {
                        $str .= $row['kindname'] . ",";
                    }
                }
            }
            else
            {
                $pinyin = Common::get_pinyin($row['kindname'], 1); // 获取拼音
                if(strpos($pinyin, $keyword) !== false)
                {
                    $str .= $row['kindname'] . ",";
                }
            }
        }

        $str = substr($str, 0, strlen($str)-1);
        return $str;
    }







}
