<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Distribution extends Stourweb_Controller
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
        $this->display('member/distribution/list');
    }


    public function action_ajax_list()
    {
        $page = intval($_GET['current']);
        $type = intval($_GET['type']);
        $limit=30;
        $offset=($page - 1) * $limit;
        $list=array();
        $obj = DB::select()->from('distribution_record')->where('form_memberid', '=', $this->member['mid']);
        switch ($type){
            case 0:
                $obj->where('status', '=', Model_Distributionrecord::STATUS_UNUSED);
                break;
            case 1:
                $obj->where('status', '=', Model_Distributionrecord::STATUS_CANCEL);
                break;
            case 2:
                $obj->where('status', '=', Model_Distributionrecord::STATUS_USED);
                break;
        }
        $list=$obj->limit($limit)->offset($offset)
            ->order_by('add_time', 'desc')->execute()->as_array();

        foreach ($list as &$v)
        {
            $v['to_member'] = ORM::factory('member', $v['to_memberid'])->as_array();
            $v['add_time'] = date('Y-m-d H:i', $v['add_time']);
            $v['up_time'] = date('Y-m-d H:i', $v['up_time']);
        }
        echo json_encode(array('status' => $list ? true : false, 'list' => $list, 'page' => $list ? ++$page : $page));
    }



}