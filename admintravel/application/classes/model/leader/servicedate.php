<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Servicedate extends ORM
{
    //对应数据库
    protected $_table_name = 'leader_service_date';

    const STATS_AVAILABLE=1;
    const STATS_USING=2;


    public static function get_leader_ids($status=self::STATS_AVAILABLE){
        $sql="select DISTINCT leader_id from sline_leader_service_date"
            ." WHERE  status={$status}";
        $data= DB::query(1,$sql)->execute()->as_array();
        return self::_leader_ids($data);
    }

    public static function get_all_leader_ids(){
        $sql="select DISTINCT leader_id from sline_leader_service_date";
        $data= DB::query(1,$sql)->execute()->as_array();
        return self::_leader_ids($data);
    }


    public static function  get_leader_ids_by_date($date,$day=null,$sattus=self::STATS_AVAILABLE){
        $date_list=Model_Leader_Servicedate::_dates_lineday($date,$day);
        if ($date && $date_list){
            $sql="select DISTINCT leader_id from sline_leader_service_date"
                ." WHERE  status={$sattus} GROUP BY  leader_id  HAVING 1 ";
            foreach ($date_list as $date){
                $sql.=" AND FIND_IN_SET('{$date}',GROUP_CONCAT(service_date)) ";
            }
            $data= DB::query(1,$sql)->execute()->as_array();
            return self::_leader_ids($data);
        }

    }


    public static function _leader_ids($data){
        $res=array();
        foreach ($data as $v){
            $res[]=$v['leader_id'];
        }
        return $res;
    }

    public static function _dates_lineday($date,$day=1){
        $res=array();
        if ($date && $day){
            if ($day==1){
                $res[]=$date;
            }else{
                for ($i=0;$i<$day;$i++){
                    $res[]=date('Y-m-d',strtotime($date)+($i*86400));
                }
            }
        }
        return $res;
    }


    public static function set_leader_status($ids,$status=self::STATS_USING){
        foreach ($ids as $id){
            if ($id){
                $sql="UPDATE sline_leader_service_date set `status`={$status} where id={$id}";
                DB::query(1,$sql)->execute();
            }

        }
    }







}
