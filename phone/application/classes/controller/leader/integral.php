<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Integral extends Stourweb_Controller
{

    public $leader=array();

    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
        $this->leader=Model_Leader::get_leader_by_mid($this->member['mid']);
        if (!$this->leader){
            Common::message(array('message' => '该页面仅限领队进入', 'jumpUrl' => $this->cmsurl));
        }
    }

    /**
     * 首页
     */
    public function action_list()
    {
        $this->display('leader/integral/list');
    }


    public function action_ajax_logs()
    {
        $page = intval($_GET['current']);
        $type = intval($_GET['type']);
        $obj = DB::select()->from('leader_integral_log')->where('leader_id', '=', $this->leader['id']);
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