<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Account extends Stourweb_Controller
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
        $me=Model_Member::get_member_byid($this->member['mid']);
        $this->assign('me',$me);
        $this->display('member/account/index');
    }


    public function action_collection(){
        $this->display('member/collection');
    }

    //帐户编辑
    public function action_edit()
    {
        $token = md5(time());
        Common::session('crsf_code',$token);
        $user_info = Model_Member::get_member_byid($this->member['mid']);
        $this->assign('info',$user_info);
        $this->assign('token',$token);
        $this->display('member/account/edit');

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

    /**
     * 上传评论图片
     */
    public function action_uploadfile()
    {
        echo json_encode($this->upload_file('bg_pic'));
        exit;
    }


}