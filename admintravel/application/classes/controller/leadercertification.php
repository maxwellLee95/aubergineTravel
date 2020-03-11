<?php defined('SYSPATH') or die('No direct script access.');
class Controller_leadercertification  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('templetlist',Common::getUserTemplteList('leader_show'));//获取上传的用户模板

    }
    public function action_list()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示线路列表页
        {
            $this->display('stourtravel/leadercertification/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $w='1';
            $sql="select * from sline_leader_certification  where $w  ORDER by addtime desc limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_leader_certification where $w")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            foreach ($list as &$item){
                $item['leader']=Model_Leader::get_leader($item['leader_id']);
                $item['certificate']=Model_Leader_Certificate::getItem($item['certificate_id']);
                $item['status_name']=Model_Leader_Certification::getStatusName($item['status']);
                $item['addtime']=date("Y-m-d H:i:s",$item['addtime']);
                $item['uptime']=$item['uptime']?date("Y-m-d H:i:s",$item['uptime']):'';
            }
            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$list;
            $result['success']=true;
            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {

        }
        else if($action=='create')
        {

        }
        else if($action=='delete') //删除某个记录
        {

            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            if(is_numeric($id))
            {
                $model=ORM::factory('leader_certification',$id);
                $model->deleteClear();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('leader_certification',$id);
            $model->$field=$val;
            $model->save();
            if($model->saved())
                echo 'ok';
            else
                echo 'no';
        }
    }
    /*
     *修改专题
    */
    public function action_edit()
    {
        $id = $this->params['id'];
        $this->assign('action','edit');
        $sql="select * from sline_leader_certification WHERE id={$id}";
        $info=DB::query(Database::SELECT,$sql)->execute()->current();
        $info['leader']=Model_Leader::get_leader($info['leader_id']);
        $info['certificate']=Model_Leader_Certificate::getItem($info['certificate_id']);
        $status_list=Model_Leader_Certification::statusName();
        $this->assign('status_list',$status_list);
        $this->assign('info',$info);
        $this->assign('position','修改');
        $this->display('stourtravel/leadercertification/edit');
    }

    /*
    *
    */
    public function action_add()
    {
        $this->assign('action','add');
        $this->assign('position','添加');
        $this->display('stourtravel/leadercertification/edit');
    }

    public function action_ajax_save()
    {
        $id=Arr::get($_POST,'id');

        $data_arr=array();
        $data_arr['status']=Arr::get($_POST,'status');
        if($id)
        {
            $model=ORM::factory('leader_certification',$id);
            if ($model->id){
                $model->uptime=time();
                $old_status=$model->status;
                foreach($data_arr as $k=>$v)
                {
                    $model->$k=$v;
                }
                $model->save();
                if($model->saved())
                {
                    if ($data_arr['status']==Model_Leader_Certification::STATUS_SUCCESS
                        && $old_status!=Model_Leader_Certification::STATUS_SUCCESS
                    ){
                        $certificate=ORM::factory('leader_certificate',$model->certificate_id);
                        $content="领队证书【{$certificate->title}】认证成功,添加积分：{$certificate->integral}";
                        Common::leaderOperateIntegral($model->leader_id
                            ,$certificate->integral
                            ,$content
                            ,Model_Leader_Integral_Log::TYPE_INCREASE
                            ,Model_Leader_Integral_Log::ACTION_CERTIFICATE);
                    }
                    $id=$model->id;
                    echo $id;
                }else{
                    echo 'no';
                }
            }
        }


    }


}