<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Account extends Stourweb_Controller
{
    public $leader=null;
    /**
     * 前置操作
     */
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

    public function action_index()
    {
        $user=Model_Member::get_member_byid($this->member['mid']);
        $manageList=Model_Leader::getManageActivity($this->leader['id'],0,100);
        $assistList=Model_Leader::getAssistActivity($this->leader['id'],0,100);
        $this->assign('manageList', $manageList);
        $this->assign('assistList', $assistList);
        $this->assign('leader', $this->leader);
        $this->assign('user', $user);
        $this->display('leader/account/index');
    }

    //帐户编辑
    public function action_edit()
    {
        $user_info = Model_Member::get_member_byid($this->member['mid']);
        $this->assign('info',$user_info);
        $this->display('leader/account/edit');
    }

    /**
     * 帐户资料保存
     */
    public function action_ajax_account_save()
    {
        $res=array(
            'status'=>0,
            'msg'=>'保存失败'
        );
        //安全校验码验证
        $token = Arr::get($_POST,'token');
        $org_code = Common::session('crsf_code');
        if($org_code != $token)
        {
            $res['msg']='安全检验码错误';
            echo json_encode($res);
            exit;
        }
        $mid = $this->member['mid'];
        $data = array();
        $verifystatus = DB::select('verifystatus')->from('member')->where('mid','=',$mid)->execute()->get('verifystatus');
        if($verifystatus!=2)
        {
            $data['sex'] =  Common::remove_xss(Arr::get($_POST,'sex'));
            $data['truename'] = Common::remove_xss( Arr::get($_POST,'truename'));
            $data['birth_date'] =  Common::remove_xss(Arr::get($_POST,'birth_date'));
            $data['cardid'] =  Common::remove_xss(Arr::get($_POST,'cardid'));
            $data['constellation'] =  Common::remove_xss(Arr::get($_POST,'constellation'));
        }
        $data['nickname'] = Common::remove_xss(Arr::get($_POST,'nickname'));
        $data['litpic'] = Common::remove_xss(Arr::get($_POST,'litpic'));
        $data['native_place'] =  Common::remove_xss(Arr::get($_POST,'native_place'));
        $data['address'] = Common::remove_xss( Arr::get($_POST,'address'));
        $data['qq'] = Common::remove_xss( Arr::get($_POST,'qq'));
        $data['wechat'] =  Common::remove_xss(Arr::get($_POST,'wechat'));
        $data['signature'] =  Common::remove_xss(Arr::get($_POST,'signature'));
        $data['bg_pic'] =  Common::remove_xss(Arr::get($_POST,'bg_pic'));
        $data['mobile'] =  Common::remove_xss(Arr::get($_POST,'mobile'));
        $data['emergency_contact'] =  Common::remove_xss(Arr::get($_POST,'emergency_contact'));
        $data['emergency_contact_phone'] =  Common::remove_xss(Arr::get($_POST,'emergency_contact_phone'));
        $flag = DB::update('member')->set($data)->where('mid','=',$mid)->execute();
        $res['status']=1;
        $res['msg']='保存成功';
        echo json_encode($res);

    }


    public function action_me()
    {
        $this->assign('leader', $this->leader);
        $this->display('leader/account/me');
    }

}