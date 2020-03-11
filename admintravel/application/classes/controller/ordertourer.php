<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Ordertourer  extends Stourweb_Controller{
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
            $this->display('stourtravel/ordertourer/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $orderid=Arr::get($_GET,'orderid');
            $w=$orderid?" a.ordersn='{$orderid}'" :"1";
            $sql="select a.ordersn,a.productname,b.* from sline_member_order As a  left join sline_member_order_tourer As b on a.id=b.orderid  where $w ORDER By a.id DESC limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(a.id) as num from sline_member_order As a left join sline_member_order_tourer As b on a.id=b.orderid where $w")->execute()->as_array();
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
                $model=ORM::factory('member_order_tourer',$id);
                $model->deleteClear();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('member_order_tourer',$id);
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
        $sql="select * from sline_member_order_tourer WHERE id={$id}";
        $info=DB::query(Database::SELECT,$sql)->execute()->current();
        $this->assign('info',$info);
        $this->assign('position','修改');
        $this->display('stourtravel/ordertourer/edit');
    }

    /*
    *
    */
    public function action_add()
    {
        $this->assign('action','add');
        $this->assign('position','添加');
        $this->display('stourtravel/ordertourer/edit');
    }

    public function action_ajax_save()
    {
        $id=Arr::get($_POST,'id');

        $data_arr=array();
        $data_arr['name']=Arr::get($_POST,'name');
        if($id)
        {
            $model=ORM::factory('member_order_tourer',$id);
        }
        else
        {
            $model=ORM::factory('member_order_tourer');
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