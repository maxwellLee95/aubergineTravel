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

    public static function getQuestions($limit){
        if ($limit){
            $tl=array(
                'a','b','c','d','e','f'
            );
            $sql="select * from sline_exam_questions  order by rand() limit {$limit};";
            $list=DB::query(1,$sql)->execute()->as_array();
            if ($list){
                foreach ($list as &$item){
                    $t=array();
                    foreach ($tl as $v){
                        if (!empty($item['option_'.$v])){
                            $t[$v]=$item['option_'.$v];
                        }
                    }
                    $item['option']=$t;
                }
            }
            return $list;
        }
    }








}
