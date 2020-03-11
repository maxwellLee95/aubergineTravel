<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Certification extends ORM
{

    const STATUS_UNPROCESSED=0;
    const STATUS_SUCCESS=1;
    const STATUS_FAIL=2;

    //对应数据库
    protected $_table_name = 'leader_certification';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('leader_certification')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }

    public static function statusName(){
        return array(
            self::STATUS_UNPROCESSED=>'处理中',
            self::STATUS_SUCCESS=>'同意',
            self::STATUS_FAIL=>'拒绝',
        );
    }

    public static function getStatusName($key){
        $list=self::statusName();
        return isset($list[$key])?$list[$key]:'';
    }

    public static function getItem($id){
        $sql="select * from sline_leader_certification where id={$id}";
        return DB::query(1,$sql)->execute()->current();
    }

    public static function getUserItem($id,$leader_id){
        if ($id && $leader_id){
            $sql="select * from sline_leader_certification where certificate_id={$id} and leader_id={$leader_id}";
            return DB::query(1,$sql)->execute()->current();
        }

    }












}
