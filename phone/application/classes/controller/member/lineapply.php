<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Member_Lineapply extends Stourweb_Controller
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
    }

    public function action_list(){
        $sql="select * from sline_line_apply where mid={$this->member['mid']}";
        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
        $this->assign('list',$list);
        $this->display('member/lineapply/list');
    }



    public function action_add(){
        $this->display('member/lineapply/edit');
    }

    public function action_edit(){
        $id=Arr::get($_GET,'id');
        $info=ORM::factory('line_apply',$id)->as_array();
        $this->assign('info',$info);
        $this->display('member/lineapply/edit');
    }

    public function action_ajax_save(){
        $arr=array(
            "status"=>1,
            'msg'=>'操作成功',
            'url'=>'/phone/member/lineapply/list'
        );
        $data=$_POST;
        $type=Arr::get($_GET,'type');
        if ($type==1){
            $data['status']=0;
        }else{
            $data['status']=2;
        }

        if ($data['id']){
            $model=ORM::factory('line_apply',$data['id']);
            unset($data['id']);
            foreach ($data as $k => $v)
            {
                $model->$k = $v;
            }
            $model->up_time=time();
            $model->update();
        }else{
            if (Model_Leader::get_leader_by_mid($this->member['mid'])){
                $data['applicant_type']=Model_Line_Apply::LEADER;
            }else{
                $data['applicant_type']=Model_Line_Apply::MEMBER;
            }
            $data['mid']=$this->member['mid'];
            $model=ORM::factory('line_apply');
            foreach ($data as $k => $v)
            {
                $model->$k = $v;
            }
            $model->add_time=time();
            $model->create();
        }
        echo  json_encode($arr);
    }

    public function action_view(){
        $id=Arr::get($_GET,'id');
        $info=ORM::factory('line_apply',$id)->as_array();
        $this->assign('info',$info);
        $this->display('member/lineapply/view');
    }



}