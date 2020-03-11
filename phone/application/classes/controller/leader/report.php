<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Leader_Report extends Stourweb_Controller
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

    #TODO 性能
    public function action_list(){
        $type=Arr::get($_GET,'type','me');
        $list=array();
        switch ($type){
            case 'me':
                $sql="select * from sline_leader_report WHERE leader_id={$this->leader['id']}  ORDER BY add_time DESC limit 50";
                $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
                break;
            case 'all':
                $sql="select * from sline_leader_report WHERE  leader_id!={$this->leader['id']} ORDER BY add_time DESC limit 50";
                $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
                break;
            default:
                Common::head404();
        }
        if (!empty($list)){
            foreach ($list as &$item){
                $item['suit']=Model_Line_Suit_Price::get_price_by_day($item['suit_id'],$item['day']);
                $item['leader']=Model_Leader::get_leader( $item['suit']['leader_id']);
                $item['line']=Model_Line::detail($item['lineid']);
            }
        }

        $this->assign('type',$type);
        $this->assign('list',$list);
        $this->display('leader/report/list');

    }



    public function action_add(){
        $line_id=Arr::get($_GET,'line_id');
        $suit_id=Arr::get($_GET,'suit_id');
        $day=Arr::get($_GET,'day');
        $suit=Model_Line_Suit_Price::get_price_by_day($suit_id,$day);
        $leader_ids=Model_Leader::format_ids($suit);


        if ($leader_ids){
            $info=Model_Leader_Report::getItemByLine($line_id,$suit_id,$day);
            if ($info){
                Common::head302("/phone/leader/report/edit?id={$info['id']}");
            }
            if (in_array($this->leader['id'],$leader_ids)){
                $line=Model_Line::detail($line_id);
                $this->assign('suit',$suit);
                $this->assign('line',$line);
                $this->display('leader/report/edit');
            }else{
                Common::message(array('message' => '仅限带队领队进入', 'jumpUrl' => $this->cmsurl));
            }
        }else{
            Common::message(array('message' => '该活动没有领队', 'jumpUrl' => $this->cmsurl));
        }
    }

    public function action_edit(){
        $id=Arr::get($_GET,'id');
        $info=ORM::factory('leader_report',$id)->as_array();
        if ($info){
            $line=Model_Line::detail($info['lineid']);
            $suit=Model_Line_Suit_Price::get_price_by_day($info['suit_id'],$info['day']);
            $this->assign('info',$info);
            $this->assign('suit',$suit);
            $this->assign('line',$line);
            $this->display('leader/report/edit');
        }else{
            Common::head404();
        }

    }

    public function action_ajax_save(){
        $arr=array(
            "status"=>1,
            'msg'=>'操作成功',
            'url'=>'/phone/leader/report/list'
        );
        $data=$_POST;
        if ($data['id']){
            $model=ORM::factory('leader_report',$data['id']);
            unset($data['id']);
            foreach ($data as $k => $v)
            {
                $model->$k = $v;
            }
            $model->up_time=time();
            $model->update();
        }else{
            $data['leader_id']=$this->leader['id'];
            $model=ORM::factory('leader_report');
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
        $info=ORM::factory('leader_report',$id)->as_array();
        if ($info){
            $info['leader']=Model_Leader::get_leader($info['leader_id']);
            $this->assign('info',$info);
            $this->display('leader/report/view');
        }else{
            Common::head404();
        }

    }



}