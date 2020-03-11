<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Commission extends Stourweb_Controller
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
        $this->display('member/commission/list');
    }



    public function action_ajax_list()
    {
        $page = intval($_GET['current']);
        $type = intval($_GET['type']);
        $limit=30;
        $offset=($page - 1) * $limit;
        $list=array();
        $obj = DB::select()->from('commission')->where('memberid', '=', $this->member['mid']);
        switch ($type){
            case 0:
                $obj->where('status', '=', Model_Commission::STATUS_UNPROCESSED);
                break;
            case 1:
                $obj->where('status', '=', Model_Commission::STATUS_FAIL);
                break;
            case 2:
                $obj->where('status', '=', Model_Commission::STATUS_SUCCESS);
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
        $this->assign('member',$this->member);
        $this->display('member/commission/edit');
    }

    /**
     * @return string
     * @throws Kohana_Exception
     */
    public function action_ajax_edit()
    {
        if(!$this->request->is_ajax())return '';

        $amount = Common::remove_xss(floatval(Arr::get($_POST, 'amount')));
        $member=Model_Member::get_member_byid($this->member['mid']);

        if ($amount<10){
            echo json_encode(array('status'=>0, 'message'=>'金额必须为10以上'));
            exit;
        }
        if ($member['commission']<$amount){
            echo json_encode(array('status'=>0, 'message'=>'当前账号佣金不足以提现'));
            exit;
        }

        $list = DB::select()->from('commission')
            ->where('memberid', '=', $this->member['mid'])
            ->where('status', '=', Model_Commission::STATUS_UNPROCESSED)
            ->execute()->as_array();
        if ($list){
            echo json_encode(array('status'=>0, 'message'=>'已有提现申请，每次只能申请一次'));
            exit;
        }
        $model=ORM::factory('commission');
        $model->memberid=$this->member['mid'];
        $model->addtime=time();
        $model->amount=$amount;
        $model->status=Model_Commission::STATUS_UNPROCESSED;
        $model->create();
        $model->reload();
        Model_Msg::msgWithdrawApplySuccess($model->id);
        echo json_encode(array('status'=>1, 'message'=>'申请成功，请等待审核'));

    }



}