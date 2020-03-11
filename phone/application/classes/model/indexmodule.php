<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Indexmodule extends ORM
{

    const I_INDEX_RECOMMEND=10;
    const I_DAY_TRIP=4;
    const I_LOOK=9;


    public static function get_module($id){
        if ($id){
            $sql = "SELECT * FROM `sline_index_module` WHERE id={$id} limit 1";
            $data=DB::query(1,$sql)->execute()->as_array();
            return !empty($data)?$data[0]:array();
        }
    }

    public static function get_module_by_ids($ids){
        if ($ids){
            $sql = "SELECT * FROM `sline_index_module` WHERE id in(".implode(",",$ids).")";
            $data=DB::query(1,$sql)->execute()->as_array();
            return $data;
        }
    }

    public static function get_module_by_group($group){
        if ($group){
            $sql = "SELECT * FROM `sline_index_module` WHERE `group` ={$group}";
            $data=DB::query(1,$sql)->execute()->as_array();
            return $data;
        }
    }

    public static function getRecommend($type,$offset, $limit){
        $id=self::I_INDEX_RECOMMEND;
        if ($id){
            $where='';
            switch ($type){
                case 1:
                    $where=" AND YEARWEEK(FROM_UNIXTIME(lsp.`day`,'%Y-%m-%d'),1) = YEARWEEK(now(),1)";
                    break;
                case 2:
                    $where=" AND YEARWEEK(FROM_UNIXTIME(lsp.`day`,'%Y-%m-%d'),1) > YEARWEEK(now(),1) AND YEARWEEK(FROM_UNIXTIME(lsp.`day`,'%Y-%m-%d'),1) <= YEARWEEK(now(),1)+1";//因为有排序day，所有可以这么操作
                    break;
                case 3:
                    $where=" AND YEARWEEK(FROM_UNIXTIME(lsp.`day`,'%Y-%m-%d'),1) > YEARWEEK(now(),1)+1";//因为有排序day，所有可以这么操作
                    break;
            }
            $sql = "SELECT l.*,lsp.suitid,lsp.*  "
                ." FROM sline_line AS l LEFT JOIN sline_line_suit AS ls ON ls.lineid = l.id "
                ." LEFT JOIN sline_line_suit_price AS lsp ON lsp.suitid = ls.id "
                ." WHERE l.ishidden = 0 AND l.webid = 0 AND FIND_IN_SET({$id}, l.index_module_ids) AND lsp.leader_id IS NOT NULL "
                ." AND lsp.day>=".Common::day_time()
                . $where
                ." ORDER BY lsp.`day` ASC, l.addtime DESC "
                ." LIMIT {$offset},{$limit};";
            $data = DB::query(1,$sql)->execute()->as_array();
            return self::_line($data);
        }

    }

    public static function getDayTrip($offset, $limit){
        return self::getLine(self::I_DAY_TRIP,$offset,$limit);
    }

    //获得每条路线最小的活动日期
    public static function getLine($id,$offset, $limit){
        if ($id){
            //必须使用order lsp.day asc ，确保我们要的同一个lineid的活动日期在第一条，group by 会合并第一个结果
            $sql = "SELECT l.*,lsp.suitid,lsp.* "
                ." FROM sline_line AS l LEFT JOIN sline_line_suit AS ls ON ls.lineid = l.id "
                ." LEFT JOIN sline_line_suit_price AS lsp ON lsp.suitid = ls.id "
                ." WHERE l.ishidden = 0 AND l.webid = 0 AND FIND_IN_SET({$id}, l.index_module_ids) AND lsp.leader_id IS NOT NULL "
                ." AND lsp.day>=".Common::day_time()
                ." GROUP By l.id"
                ." ORDER BY lsp.`day` ASC"
                ." LIMIT {$offset},{$limit};";
            $data = DB::query(1,$sql)->execute()->as_array();
            return self::_line($data);
        }
    }

    public static function _line($data){
        if ($data){
            foreach($data as $k=>&$v)
            {
                $v['status']=Common::line_status($v['person_count'],$v['min_person_count'],$v['lineid'],$v['suitid'],$v['day']);
                $v['startcity_id'] = $v['startcity'];
                $v['startcity'] = Model_Startplace::start_city($v['startcity']);
                $v['commentnum'] = Model_Comment::get_comment_num($v['id'],1); //评论次数
                $v['stars'] = Model_Comment::get_stars($v['id'], 1);//满意度
                $v['sellnum'] = Model_Member_Order::get_sell_num($v['id'],1)+intval($v['bookcount']); //销售数量
                $v['url'] = Common::get_web_url($v['webid']) . "/lines/show_{$v['aid']}.html?suitid={$v['suitid']}&day={$v['day']}";
                $v['index_litpic'] = Common::img($v['index_litpic']);
                $v['litpic'] = Common::img($v['litpic']);
                $v['title'] = Common::cutstr_html($v['title'], 40);
            }
        }
        return $data;
    }








}