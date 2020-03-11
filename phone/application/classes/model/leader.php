<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader extends ORM
{
    //对应数据库
    protected $_table_name = 'leader';
    Const TYPE_ID=303;

    const STATS_NORMAL=1;
    const STATS_UNAVAILABLE=0;


    public static function get_leader($id){
        $sql="select l.*,m.nickname,m.litpic,m.connectid from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
            ." WHERE  l.id={$id} AND  l.status=".self::STATS_NORMAL;
        return DB::query(1,$sql)->execute()->current();
    }


    public static function get_leaders($ids){
        if ($ids){
            $ids_str=implode(",",$ids);
            $sql="select l.*,m.nickname,m.litpic,m.truename from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
                ." WHERE  l.id in({$ids_str}) AND  l.status=".self::STATS_NORMAL
                ." ORDER BY FIELD('id',{$ids_str}) ";
            return DB::query(1,$sql)->execute()->as_array();
        }
    }

    public static function get_leader_by_mid($mid){
        if ($mid){
            $sql="select l.*,m.nickname,m.litpic from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
                ." WHERE  l.mid={$mid} AND  l.status=".self::STATS_NORMAL;
            return DB::query(1,$sql)->execute()->current();
        }
    }



    public static function format_ids($info){
        $res=array();
        if (!empty($info['leader_id'])){
            $res[]=$info['leader_id'];
        }
        if (!empty($info['leader_id2'])){
            $res[]=$info['leader_id2'];
        }
        if (!empty($info['leader_id3'])){
            $res[]=$info['leader_id3'];
        }
        if (!empty($info['leader_id4'])){
            $res[]=$info['leader_id4'];
        }
        if (!empty($info['leader_id5'])){
            $res[]=$info['leader_id5'];
        }
        return $res;
    }


    public static function get_all_leaders($status=self::STATS_NORMAL,$limit){
        $sql="select l.*,m.nickname,m.litpic from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
            ." WHERE   l.status={$status}";
        $sql.=!empty($limit)?" LIMIT {$limit} ":'';
        return DB::query(1,$sql)->execute()->as_array();
    }


    public static function getStarName($star){
        $arr=array(
            1=>'一星领队',
            2=>'二星领队',
            3=>'三星领队',
            4=>'四星领队',
            5=>'五星领队',
        );
        return Arr::get($arr,$star,'');

    }

    public static function getStarNameByIntegral($integral){
        if ($integral){

            if ($integral<=200){
                $star=1;
            }else if ($integral>200 && $integral<=500){
                $star=2;
            }else if ($integral>500 && $integral<=1000){
                $star=3;
            }else if ($integral>1000 && $integral<=2000){
                $star=4;
            }else if ($integral>2000){
                $star=5;
            }else{
                $star=1;
            }
            return self::getStarName($star);
        }


    }

    public static function getManageActivity($id,$limit,$page){
        if ($id){
            $sql="select a.suitid,a.`day`,b.title,b.title,b.lineday,b.litpic,b.id from "
                ." sline_line_suit_price AS a left join sline_line AS b "
                ." ON a.lineid=b.id where a.leader_id={$id} and b.ishidden=0 ORDER BY `day` DESC LIMIT {$limit},{$page}";
            return DB::query(Database::SELECT,$sql)->execute()->as_array();
        }

    }

    public static function getAssistActivity($id,$limit,$page){
        if ($id){
            $sql="select a.suitid,a.`day`,b.title,b.title,b.lineday,b.litpic,b.id from "
                ." sline_line_suit_price AS a left join sline_line AS b "
                ." ON a.lineid=b.id where  b.ishidden=0 "
                ." AND (a.leader_id2={$id} or a.leader_id3={$id} or a.leader_id4={$id} or a.leader_id5={$id} )"
                ." ORDER BY `day` DESC LIMIT {$limit},{$page}";
            return DB::query(Database::SELECT,$sql)->execute()->as_array();
        }
    }

    public static function getActivitys($id,$limit,$page){
        if ($id){
            $sql="select a.suitid,a.`day`,b.title,b.title,b.lineday,b.litpic,b.id from "
                ." sline_line_suit_price AS a left join sline_line AS b "
                ." ON a.lineid=b.id where  b.ishidden=0 "
                ." AND (a.leader_id={$id} or a.leader_id2={$id} or a.leader_id3={$id} or a.leader_id4={$id} or a.leader_id5={$id} )"
                ." ORDER BY `day` DESC LIMIT {$limit},{$page}";
            return DB::query(Database::SELECT,$sql)->execute()->as_array();
        }
    }

    public static function getActivityTourer($id,$suitid,$day){
        if ($id && $suitid && $day ){
            $usedate=date('Y-m-d',$day);
            $sql="SELECT b.* FROM sline_member_order AS a "
            ." LEFT JOIN sline_member_order_tourer AS b ON a.id = b.orderid "
            ." WHERE a.productaid ={$id} AND a.suitid = {$suitid} AND a.usedate = '{$usedate}' and (`status`=2 or `status`=5) ";
            return DB::query(Database::SELECT,$sql)->execute()->as_array();
        }
    }





}
