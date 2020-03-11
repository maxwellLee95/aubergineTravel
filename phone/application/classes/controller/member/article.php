<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Article extends Stourweb_Controller
{
    /**
     * 前置操作
     */
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }

    /**
     * 评论视图
     */
    public function action_index()
    {
        $notes=Model_Notes::get_my_notes($this->member['mid']);
//        Common::dd($notes);
        $this->assign('notes',$notes);
        $this->display('member/article');
    }

}