<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Leader  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();
        if($action == 'list')
        {
            $param = $this->params['action'];
            $right = array(
                'read'=>'slook',
                'save'=>'smodify',
                'delete'=>'sdelete',
                'update'=>'smodify'
            );
            $user_action = $right[$param];
            if(!empty($user_action))
                Common::getUserRight('leader',$user_action);


        }
        if($action == 'add')
        {
            Common::getUserRight('leader','sadd');
        }
        if($action == 'edit')
        {
            Common::getUserRight('leader','smodify');
        }
        if($action == 'ajax_save')
        {
            Common::getUserRight('leader','smodify');
        }
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
            $this->display('stourtravel/leader/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');
            $sort=json_decode(Arr::get($_GET,'sort'));
            if($sort[0]->property)
            {
                if($sort[0]->property=='addtime')
                {
                    $order='order by addtime '.$sort[0]->direction;
                }
            }
            $w='1';
            $sql="select l.*,m.nickname from sline_leader AS l left join sline_member AS m on m.mid=l.mid where $w $order limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_leader AS l left join sline_member AS m on m.mid=l.mid  where $w")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
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
                $model=ORM::factory('leader',$id);
                $model->deleteClear();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('leader',$id);
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
        $member_sql="select * from sline_member";
        $member=DB::query(Database::SELECT,$member_sql)->execute()->as_array();
        $member_list=array();
        if ($member){
            foreach ($member as $item){
                $member_list[$item['mid']]=$item['nickname'];
            }
        }
        $sql="select l.*,m.nickname from sline_leader AS l left join sline_member AS m on m.mid=l.mid where id={$id}";
        $info=DB::query(Database::SELECT,$sql)->execute()->current();
        $this->assign('member_list',$member_list);
        $this->assign('info',$info);
        $this->assign('position','修改');
        $this->display('stourtravel/leader/edit');
    }

    /*
    *
    */
    public function action_add()
    {
        $member_sql="select * from sline_member";
        $member=DB::query(Database::SELECT,$member_sql)->execute()->as_array();
        $member_list=array();
        if ($member){
            foreach ($member as $item){
                $member_list[$item['mid']]=$item['nickname'];
            }
        }
        $this->assign('member_list',$member_list);
        $this->assign('action','add');
        $this->assign('position','添加');
        $this->display('stourtravel/leader/edit');
    }

    public function action_ajax_save()
    {
        $id=Arr::get($_POST,'id');

        $data_arr=array();
        $data_arr['mid']=Arr::get($_POST,'mid');
        $data_arr['work_time']=Arr::get($_POST,'work_time');
        $data_arr['card_number']=Arr::get($_POST,'card_number');
        $data_arr['card_pic']=Arr::get($_POST,'card_pic');
        $data_arr['good_language']=Arr::get($_POST,'good_language');
        $data_arr['profile']=Arr::get($_POST,'profile');
        $data_arr['jieshao']=Arr::get($_POST,'jieshao');
        $data_arr['service_city']=Arr::get($_POST,'service_city');
        $data_arr['status']=Arr::get($_POST,'status');
        $data_arr['reason']=Arr::get($_POST,'reason');
        if($id)
        {
            $model=ORM::factory('leader',$id);
            $model->modtime=time();
        }
        else
        {
            $model=ORM::factory('leader');
            $model->addtime=time();
            $model->modtime=time();
        }
        foreach($data_arr as $k=>$v)
        {
            $model->$k=$v;
        }
        $model->save();
        if($model->saved())
        {
            $model->reload();
            $id=$model->id;
            echo $id;
        }
        else
            echo 'no';

    }
}