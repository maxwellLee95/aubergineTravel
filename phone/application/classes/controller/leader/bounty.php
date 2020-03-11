<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Bounty extends Stourweb_Controller
{
    public $leader=null;
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


    public function action_list()
    {
        $this->display('leader/bounty/list');
    }

    public function action_order_list()
    {
        $this->display('leader/bounty/order_list');
    }



    public function action_ajax_list()
    {
        $page = intval($_GET['current']);
        $type = intval($_GET['type']);
        $limit=30;
        $offset=($page - 1) * $limit;
        $obj = DB::select()->from('leader_bounty')->where('leaderid', '=', $this->leader['id']);
        switch ($type){
            case 0:
                $obj->where('status', '=', Model_Leader_Bounty::STATUS_UNPROCESSED);
                break;
            case 1:
                $obj->where('status', '=', Model_Leader_Bounty::STATUS_FAIL);
                break;
            case 2:
                $obj->where('status', '=', Model_Leader_Bounty::STATUS_SUCCESS);
                break;

        }
        $list=$obj->limit($limit)->offset($offset)
            ->order_by('addtime', 'desc')->execute()->as_array();

        foreach ($list as &$v)
        {
            $v['addtime'] = date('Y-m-d H:i', $v['addtime']);
            $v['uptime'] = date('Y-m-d H:i', $v['uptime']);
        }
        echo json_encode(array('status' => $list ? true : false, 'list' => $list, 'page' => $list ? ++$page : $page));
    }

    public function action_withdraw(){
        $this->assign('leader',$this->leader);
        $this->display('leader/bounty/edit');
    }

    /**
     * @return string
     * @throws Kohana_Exception
     */
    public function action_ajax_edit()
    {
        if(!$this->request->is_ajax())return '';

        $amount = Common::remove_xss(floatval(Arr::get($_POST, 'amount')));
        $member=Model_Leader::get_leader($this->leader['id']);

        if ($amount<10){
            echo json_encode(array('status'=>0, 'message'=>'金额必须为10以上'));
            exit;
        }
        if ($member['bounty']<$amount){
            echo json_encode(array('status'=>0, 'message'=>'当前账号可提现金额不足'));
            exit;
        }

        $list = DB::select()->from('leader_bounty')
            ->where('leaderid', '=', $this->leader['id'])
            ->where('status', '=', Model_Leader_Bounty::STATUS_UNPROCESSED)
            ->execute()->as_array();
        if ($list){
            echo json_encode(array('status'=>0, 'message'=>'已有提现申请，每次只能申请一次'));
            exit;
        }
        $model=ORM::factory('leader_bounty');
        $model->leaderid=$this->leader['id'];
        $model->addtime=time();
        $model->amount=$amount;
        $model->status=Model_Leader_Bounty::STATUS_UNPROCESSED;
        $model->create();
        echo json_encode(array('status'=>1, 'message'=>'申请成功，请等待审核'));

    }

    public function action_ajax_order_list()
    {
        $page = intval($_GET['current']);
        $limit=30;
        $offset=($page - 1) * $limit;
        $sql="select * from sline_member_order where productaid={$this->leader['id']} and typeid=303 "
            ." AND (status=".Model_Member_Order::STATUS_FINISH." OR status=".Model_Member_Order::STATUS_PAY.")"
            ." ORDER By addtime desc  "
            ." Limit {$offset},$limit";
        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();

        foreach ($list as &$v)
        {
            $v['member']=Model_Member::get_member_byid($v['memberid']);
            $v['addtime'] = date('Y-m-d H:i', $v['addtime']);
        }
        echo json_encode(array('status' => $list ? true : false, 'list' => $list, 'page' => $list ? ++$page : $page));
    }



}