<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Leaderexamresult  extends Stourweb_Controller{
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
            $this->display('stourtravel/leaderexamresult/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $id=Arr::get($_GET,'id');
            $w=$id?" a.id='{$id}'" :"1";
            $sql="select a.title,a.date,a.questions_count,b.* from sline_leader_exam As a  left join sline_leader_exam_result As b on a.id=b.exam_id  where $w ORDER By a.id DESC limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(a.id) as num from sline_leader_exam As a left join sline_leader_exam_result As b on a.id=b.exam_id where $w")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            foreach ($list as &$item){
                $item['leader']=Model_Leader::get_leader($item['leader_id']);
                $item['status']=Model_Leader_Exam_REsult::getStatusName($item['is_passed']);
                $item['addtime']=date("Y-m-d H:i:s");
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
                $model=ORM::factory('leader_exam_result',$id);
                $model->deleteClear();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('leader_exam_result',$id);
            $model->$field=$val;
            $model->save();
            if($model->saved())
                echo 'ok';
            else
                echo 'no';
        }
    }


}