<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Fans extends Stourweb_Controller
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


    public function action_ajax_attention()
    {
        $to_mid=Arr::get($_POST,'to_hiker_id',0);
        $data=Model_Member::get_member_byid($to_mid);
        $res=array('status'=>0,'msg'=>'操作异常');
        if ($data){
            $item=Model_Member_Fans::getFansItem($to_mid,$this->member['mid']);
            //如果存在，则删除，否则创建
            if ($item['id']){
                $model=ORM::factory('member_fans',$item['id']);
                $model->delete();
                $res=array('status'=>2,'msg'=>'取消关注成功');
            }else{
                $model=ORM::factory('member_fans');
                $model->to_mid=$to_mid;
                $model->form_mid=$this->member['mid'];
                $model->create();
                $res=array('status'=>1,'msg'=>'关注成功');
            }
        }
        echo  json_encode($res);exit;
    }




}