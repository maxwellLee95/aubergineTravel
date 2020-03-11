<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Marshalpoint extends ORM
{
    //对应数据库
    protected $_table_name = 'marshal_point';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('marshal_point')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }




}
