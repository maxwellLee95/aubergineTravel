<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Lineapply  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('templetlist',null);

    }
    public function action_list()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示线路列表页
        {
            $this->display('stourtravel/lineapply/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $w='status>0';
            $sql="select * from sline_line_apply  where $w  limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_line_apply where $w")->execute()->as_array();

            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            if ($list){
                foreach ($list as &$item){
                    $item['status_name']=Model_Line_Apply::getStateName($item['status']);
                    $item['up_time']=$item['up_time']?date('Y-m-d H:i:s',$item['up_time']):'';
                    $item['add_time']=$item['up_time']?date('Y-m-d H:i:s',$item['add_time']):'';
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
                $model=ORM::factory('line_apply',$id);
                $model->delete();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('line_apply',$id);
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
        $sql="select * from sline_line_apply WHERE id={$id}";
        $info=DB::query(Database::SELECT,$sql)->execute()->current();
        if ($info){
            $status_list=Model_Line_Apply::stateName();
            $member=ORM::factory('member', $info['mid'])->as_array();
            $this->assign('member',$member);
            $this->assign('status_list',$status_list);
            $this->assign('info',$info);
            $this->assign('position','修改');
            $this->display('stourtravel/lineapply/edit');
        }

    }

    /*
    *
    */
    public function action_add()
    {
        $this->assign('action','add');
        $this->assign('position','添加');
        $this->display('stourtravel/lineapply/edit');
    }

    public function action_ajax_save()
    {
        $id=Arr::get($_POST,'id');

        $data_arr=array();
        $data_arr['status']=Arr::get($_POST,'status');
        $data_arr['review_instructions']=Arr::get($_POST,'review_instructions');
        if($id)
        {
            $model=ORM::factory('line_apply',$id);
        }
        else
        {
            $model=ORM::factory('line_apply');
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