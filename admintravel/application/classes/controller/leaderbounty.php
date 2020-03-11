<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Leaderbounty  extends Stourweb_Controller{
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
            $this->display('stourtravel/leaderbounty/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $w='1';
            $sql="select * from sline_leader_bounty  where $w  limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) AS num from sline_leader_bounty where $w")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            if ($list){
                foreach ($list as &$item){

                    $item['member']=Model_Leader::get_leader( $item['leaderid']);
                    $item['addtime']=date('Y-m-d H:i:s',$item['addtime']);
                    $item['status_name']=Model_Leader_Bounty::getStatusName($item['status']);
                }
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
                $model=ORM::factory('leader_bounty',$id);
                $model->deleteClear();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('leader_bounty',$id);
            $model->$field=$val;
            $model->save();
            if($model->saved())
                echo 'ok';
            else
                echo 'no';
        }
    }

    public function action_edit()
    {
        $id = $this->params['id'];
        $this->assign('action','edit');
        $sql="select * from sline_leader_bounty WHERE id={$id}";
        $info=DB::query(Database::SELECT,$sql)->execute()->current();
        $info['member']=Model_Leader::get_leader($info['leaderid']);
        $info['addtime']=date('Y-m-d H:i:s',$info['addtime']);
        $info['status_name']=Model_Leader_Bounty::getStatusName($info['status']);
        $status_list=Model_Leader_Bounty::statusName();
        $this->assign('status_list',$status_list);
        $this->assign('info',$info);
        $this->assign('position','修改');
        $this->display('stourtravel/leaderbounty/edit');
    }


    public function action_ajax_save()
    {
        $id=Arr::get($_POST,'id');

        $data_arr=array();
        $data_arr['status']=Arr::get($_POST,'status');
        if($id)
        {
            $model=ORM::factory('leader_bounty',$id);
            $model->uptime=time();
            if ($model->status!=Model_Leader_Bounty::STATUS_SUCCESS &&  $data_arr['status']==Model_Leader_Bounty::STATUS_SUCCESS){
                Model_Leader::cutAmount($model->leaderid,$model->amount);
            }
            foreach($data_arr as $k=>$v)
            {
                $model->$k=$v;
            }
            $model->update();
            Model_Msg::msgWithdrawSuccess($id);
            echo $id;exit;
        }
        echo 'no';

    }


}