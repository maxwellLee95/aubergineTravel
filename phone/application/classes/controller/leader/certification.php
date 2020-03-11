<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Certification extends Stourweb_Controller
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
        $list=DB::select()->from('leader_certificate')->execute()->as_array();
        if ($list){
            foreach ($list as &$item){
                $certification=DB::select()->from('leader_certification')
                    ->where("leader_id","=",$this->leader['id'])
                    ->where("certificate_id","=",$item['id'])
                    ->execute()->current();
                $item['certification']=$certification;
            }
        }
        $this->assign('list',$list);
        $this->display('leader/certification/list');
    }



    public function action_edit(){
        $id=Arr::get($_GET,'id',null);
        $certificate=Model_Leader_Certificate::getItem($id);
        $info=Model_Leader_Certification::getUserItem($id,$this->leader['id']);
        $info['status_name']=Model_Leader_Certification::getStatusName($info['status']);
        $this->assign('info',$info);
        $this->assign('certificate',$certificate);
        $this->assign('leader',$this->leader);
        $this->display('leader/certification/edit');
    }

    /**
     * @return string
     * @throws Kohana_Exception
     */
    public function action_ajax_save()
    {
        if(!$this->request->is_ajax())return '';

        $certificate_id = Common::remove_xss(Arr::get($_POST, 'certificate_id'));
        $image = Arr::get($_POST, 'image');
        $certificate=Model_Leader_Certificate::getItem($certificate_id);
        if (empty($certificate)){
            echo json_encode(array('status'=>0, 'msg'=>'证书不存在'));
            exit;
        }
        if (empty($image)){
            echo json_encode(array('status'=>0, 'msg'=>'证书图片不能为空'));
            exit;
        }
        $certification=Model_Leader_Certification::getUserItem($certificate_id,$this->leader['id']);
        if (!empty($certification)){
            $model=ORM::factory('leader_certification',$certification['id']);
            if ($model->id){
                $model->certificate_id=$certificate_id;
                $model->leader_id=$this->leader['id'];
                if ($model->status==Model_Leader_Certification::STATUS_SUCCESS){
                    echo json_encode(array('status'=>0, 'msg'=>'证书已经审核通过啦'));
                    exit;
                }
                $model->status=Model_Leader_Certification::STATUS_UNPROCESSED;
                $model->image=$image;
                $model->update();
                echo json_encode(array('status'=>1, 'message'=>'更新成功，请等待审核'));
                exit;
            }else{
                echo json_encode(array('status'=>0, 'msg'=>'数据异常'));
                exit;
            }
        }else{
            $model=ORM::factory('leader_certification');
            $model->certificate_id=$certificate_id;
            $model->leader_id=$this->leader['id'];
            $model->status=Model_Leader_Certification::STATUS_UNPROCESSED;
            $model->image=$image;
            $model->addtime=time();
            $model->create();
            echo json_encode(array('status'=>1, 'message'=>'上传成功，请等待审核'));
            exit;
        }

    }


}