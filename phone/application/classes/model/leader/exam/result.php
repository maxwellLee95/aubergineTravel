<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Exam_Result extends ORM
{

    const STATUS_FAILED=0;
    const STATUS_PASS=1;

    //对应数据库
    protected $_table_name = 'leader_exam_result';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('leader_exam_result')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }

    public static function statusName(){
        return array(
            self::STATUS_FAILED=>'不合格',
            self::STATUS_PASS=>'合格',
        );
    }

    public static function getStatusName($key){
        $list=self::statusName();
        return isset($list[$key])?$list[$key]:'';
    }


    public static function getItemByUser($id,$leader_id){
        if ($id && $leader_id){
            $sql="select * from sline_leader_exam_result where exam_id={$id} and leader_id={$leader_id}";
            return DB::query(1,$sql)->execute()->current();
        }

    }









}
