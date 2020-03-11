<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Message extends Stourweb_Controller
{
    public $member=null;
    /**
     * 前置操作
     */
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }


    public function action_list()
    {
        $list=Model_Member_Message::get_list_by_mid($this->member['mid']);
        $this->assign('list',$list);
        $this->display('member/message/list');
    }

    public function action_show()
    {
        $id=Arr::get($_GET,'id',0);
        $info=Model_Member_Message::get_item($id);
        $this->assign('info',$info);
        $this->display('member/message/detail');
    }

}