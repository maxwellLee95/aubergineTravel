<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Exam_Questions extends ORM
{


    //对应数据库
    protected $_table_name = 'exam_questions';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('exam_questions')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }

    public static function getItem($id){
        if ($id){
            $sql="select * from sline_exam_questions where id={$id}";
            return DB::query(1,$sql)->execute()->current();
        }
    }





}
