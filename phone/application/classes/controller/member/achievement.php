<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Achievement extends Stourweb_Controller
{

    public $member=null;
    /**
     * 前置操作
     */
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }


    public function action_list()
    {
        $list=Model_Member_Achievement::get_list_by_mid($this->member['mid']);
        $this->assign('list',$list);
        $this->display('member/achievement/list');
    }

    public function action_edit(){
        $id=Arr::get($_GET,'id');
        $info=Model_Member_Achievement::get_item($id);
        if (empty($info)){
            Common::head404();
        }
        $this->assign('info',$info);
        $this->display('member/achievement/edit');
    }

    public function action_add(){
        $this->display('member/achievement/edit');
    }

    public function action_ajax_save(){
        $res=array(
            'status'=>0,
            'msg'=>'保存失败'
        );
        $finish_time=Common::remove_xss(Arr::get($_POST,'finishTime'));
        $finish_time=strtotime($finish_time);
        $content=Common::remove_xss(Arr::get($_POST,'description'));
        $id=Common::remove_xss(Arr::get($_POST,'id'));
        if ($id){
            Model_Member_Achievement::mod_item($id,$this->member['mid'],$content,$finish_time);
            $res['status']=1;
            $res['msg']='保存成功';
        }else{
            Model_Member_Achievement::add_item($this->member['mid'],$content,$finish_time);
            $res['status']=1;
            $res['msg']='添加成功';
        }
        echo json_encode($res);exit;
    }

    public function action_ajax_del(){
        $res=array(
            'status'=>0,
            'msg'=>'删除失败'
        );
        $id=Common::remove_xss(Arr::get($_POST,'id'));
        if ($id){
            Model_Member_Achievement::deleteClear($id);
            $res['status']=1;
            $res['msg']='删除成功';
        }
        echo json_encode($res);exit;
    }

}