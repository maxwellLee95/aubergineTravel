<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Certificate extends ORM
{


    //对应数据库
    protected $_table_name = 'leader_certificate';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('leader_certificate')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }

    public static function getItem($id){
        if ($id){
            $sql="select * from sline_leader_certificate where id={$id}";
            return DB::query(1,$sql)->execute()->current();
        }

    }





}
