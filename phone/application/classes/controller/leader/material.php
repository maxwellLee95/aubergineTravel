<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Material extends Stourweb_Controller
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

    public function action_list()
    {
        $list=Model_Leader_Material::getListByLeaderid($this->leader['id']);
        $this->assign('list', $list);
        $this->display('leader/material/list');
    }

    public function action_edit(){
        $id=Arr::get($_GET,'id');
        $data=Model_Leader_Material::getItem($id);
        $this->assign('data', $data);
        $this->display('leader/material/edit');
    }

    public function action_save(){
        if ($_POST){
            $id=Arr::get($_POST,'id');
            $model=ORM::factory('leader_material',$id);
            if ($model->id){
                $model->qty=Arr::get($_POST,'qty');
                $model->remake=Arr::get($_POST,'remake');
                $model->update();
                Common::message(array('message' => '编辑成功', 'jumpUrl' => $this->cmsurl.'/leader/material/list'));
            }
        }
    }



}