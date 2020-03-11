<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader extends ORM
{
    //对应数据库
    protected $_table_name = 'leader';

    const STATS_NORMAL=1;
    const STATS_UNAVAILABLE=0;

    Const TYPE_ID=303;


    public static function get_leader($id){
        if ($id){
            $sql="select l.*,m.nickname,m.litpic,m.connectid from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
                ." WHERE  l.id={$id} AND  l.status=".self::STATS_NORMAL;
            return DB::query(1,$sql)->execute()->current();
        }
    }

    public static function get_all_leaders($status=self::STATS_NORMAL){
        $sql="select l.*,m.nickname,m.litpic from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
            ." WHERE   l.status={$status}";
        return DB::query(1,$sql)->execute()->as_array();
    }


    public static function get_leaders($ids,$status=self::STATS_NORMAL){
        if ($ids){
            $ids_str=implode(",",$ids);
            $sql="select l.*,m.nickname,m.litpic,m.truename from sline_leader AS l LEFT JOIN sline_member AS m ON  l.mid=m.mid "
                ." WHERE  l.id in({$ids_str}) AND  l.status={$status}"
                ." ORDER BY FIELD('id',{$ids_str}) ";
            return DB::query(1,$sql)->execute()->as_array();
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


    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('leader')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }


    public static function addAmount($lid,$amount){
        if ($lid && $amount){
            $model=ORM::factory('leader',$lid);
            if ($model){
                $model->bounty=floatval($amount)+floatval($model->bounty);
                $model->update();
                return true;
            }
        }
        return false;
    }

    public static function cutAmount($lid,$amount){
        if ($lid && $amount){
            $model=ORM::factory('leader',$lid);
            if ($model){
                $bounty=floatval($model->bounty)-floatval($amount);
                if ($bounty>=0){
                    $model->bounty=$bounty;
                    $model->update();
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * @param $id
     * @param $integral
     * @param int $type
     * @return object
     */
    public static function operateIntegral($id, $integral, $type = Model_Leader_Integral_Log::TYPE_INCREASE)
    {
        if ($id && $integral){
            $integral = $type == 1 ? -$integral : $integral;
            $sql = "UPDATE sline_leader SET integral=integral+({$integral}) ";
            $sql .= "WHERE id={$id}";
            $row = DB::query(Database::UPDATE, $sql)->execute();
            return $row;
        }
    }







}
