<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Material extends ORM
{
    //对应数据库
    protected $_table_name = 'material';

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('material')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }




}
