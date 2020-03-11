<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Bounty extends Stourweb_Controller
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

    public function action_leader()
    {
        $id=Arr::get($_GET,'id',0);
        $leader=Model_Leader::get_leader($id);
        $this->assign('leader',$leader);
        $this->display('member/bounty/leader');
    }


    /**
     * @return string
     * @throws Kohana_Exception
     */
    public function action_ajax_edit()
    {
        if(!$this->request->is_ajax())return '';

        $amount = Common::remove_xss(floatval(Arr::get($_POST, 'amount')));
        $leaderid = Common::remove_xss(Arr::get($_POST, 'leaderid'));
        if ($amount<1){
            echo json_encode(array('status'=>0, 'message'=>'金额必须为10以上'));
            exit;
        }
        $leader=Model_Leader::get_leader($leaderid);
        if (empty($leader)){
            echo json_encode(array('status'=>0, 'message'=>'领队不存在'));
            exit;
        }
        $ordersn = Product::get_ordersn(Model_Leader::TYPE_ID);
        $user=Model_Member::get_member_byid($this->member['mid']);
        $arr = array(
            'ordersn' => $ordersn,
            'webid' => 0,
            'typeid' => Model_Leader::TYPE_ID,
            'productautoid' => $leaderid,
            'productaid' => $leaderid,
            'productname' => "《".$user['nickname'].'》给《'.$leader['nickname'].'》支付赏金',
            'litpic' => $leader['litpic'],
            'price' => $amount,
            'childprice' => 0,
            'jifentprice' => 0,
            'jifenbook' => 0,
            'jifencomment' => 0,
            'paytype' => 1,
            'dingjin' => 0,
            'usedate' => date('Y-m-d H:i:s'),
            'departdate' => date('Y-m-d H:i:s'),
            'addtime' => time(),
            'memberid' => null,
            'dingnum' => 1,
            'childnum' => 0,
            'oldprice' => 0,
            'oldnum' => 0,
            'linkman' => $user['nickname'],
            'linktel' => $user['mobile'],
            'linkidcard' => $user['cardid'],
            'suitid' => 0,
            'remark' => null,
            'status' => 0,
            'usejifen' => 0,
            'marshal_point_id'=>0,
        );

        if (Product::add_order($arr))
        {
            $res['status']=1;
            $res['message']='订单创建成功，待付款';
            $res['redirecturl'] = Common::get_main_host() . "/payment/?ordersn={$ordersn}";
            echo json_encode($res);
            exit;
        }else{
            echo json_encode(array('status'=>0, 'message'=>'出了一点点问题'));
            exit;
        }


    }



}