<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Exam extends ORM
{


    //对应数据库
    protected $_table_name = 'leader_exam';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('leader_exam')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }

    public static function getItem($id){
        $sql="select * from sline_leader_exam where id={$id}";
        return DB::query(1,$sql)->execute()->current();
    }





}
