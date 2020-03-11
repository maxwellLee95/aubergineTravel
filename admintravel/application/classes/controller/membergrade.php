<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Membergrade extends Stourweb_Controller{


    /*
     * 订单总控制器
     *
     */
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);


    }

    /*
     * 订单列表
     * */
    public function action_index()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->assign('position','会员等级');
            $this->assign('channelname','会员等级');
            $this->display('stourtravel/membergrade/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $order='order by a.addtime desc';
            $w = "where 1 ";
            $sql="select a.*  from sline_member_grade as a $w $order limit $start,$limit";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_member_grade a $w ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
                $v['addtime'] = Common::myDate('Y-m-d H:i:s',$v['addtime']);
                $v['modtime'] = $v['modtime']?Common::myDate('Y-m-d H:i:s',$v['modtime']):null;
                $new_list[] = $v;
            }
            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$new_list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {

        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id)) //
            {
                $model=ORM::factory('member_grade',$id);
                $model->delete();
            }
        }
        else if($action=='update')//更新某个字段
        {

        }
    }


    public function action_edit()
    {
        $id = $this->params['id'];
        $info =  ORM::factory('member_grade')->where('id','=',$id)->find()->as_array();
        $this->assign('info',$info);
        $this->display('stourtravel/membergrade/edit');
    }


    public function action_add()
    {
        $this->display('stourtravel/membergrade/edit');
    }

    /*
     * 保存
     * */
    public function action_ajax_save()
    {
        $status=false;
        $id = Arr::get($_POST,'id');
        if ($id) {
            $model = ORM::factory('member_grade', $id);
            $model->modtime = time();
        }else{
            $model = ORM::factory('member_grade');
            $model->addtime = time();
        }
        $model->name = $_POST['name'];
        $model->begin = $_POST['begin'];
        $model->end = $_POST['end'];
        $model->save();
        echo json_encode(array('status'=>true));

    }


}