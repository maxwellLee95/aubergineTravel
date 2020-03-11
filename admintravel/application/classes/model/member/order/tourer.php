<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order_Tourer extends ORM
{


    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('member_order_tourer')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }


}
