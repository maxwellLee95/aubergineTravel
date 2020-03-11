<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Integral extends Stourweb_Controller
{
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);

    }

    /**
     * 首页
     */
    public function action_list()
    {
        $this->display('member/integral/list');
    }


    public function action_ajax_jifen_logs()
    {
        $page = intval($_GET['current']);
        $type = intval($_GET['type']);
        $obj = DB::select()->from('member_jifen_log')->where('memberid', '=', $this->member['mid']);
        if ($type > 0)
        {
            $obj->where('type', '=', $type);
        }

        $list = $obj->limit(30)->offset(($page - 1) * 30)->order_by('addtime', 'desc')->execute()->as_array();
        foreach ($list as &$v)
        {
            $v['addtime'] = date('Y-m-d H:i', $v['addtime']);
        }
        echo json_encode(array('status' => $list ? true : false, 'list' => $list, 'page' => $list ? ++$page : $page));
    }



}