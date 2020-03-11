<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Leader_Activity extends Stourweb_Controller
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



    public function action_sign(){
        $line_id=Arr::get($_GET,'line_id');
        $suit_id=Arr::get($_GET,'suit_id');
        $day=Arr::get($_GET,'day');
        $suit=Model_Line_Suit_Price::get_price_by_day($suit_id,$day);
        $leader_ids=Model_Leader::format_ids($suit);
        if ($leader_ids){
            if (in_array($this->leader['id'],$leader_ids)){
                $info=Model_Line::detail($line_id);
                $list=Model_Leader::getActivityTourer($line_id,$suit_id,$day);
                $this->assign('suit',$suit);
                $this->assign('info',$info);
                $this->assign('list',$list);
                $this->display('leader/activity/sign');
            }else{
                Common::message(array('message' => '仅限带队领队进入', 'jumpUrl' => $this->cmsurl));
            }
        }else{
            Common::message(array('message' => '该活动没有领队', 'jumpUrl' => $this->cmsurl));
        }
    }

    public function action_qrcode(){
        $line_id=Arr::get($_GET,'line_id');
        $info=Model_Line::detail($line_id);
        $this->assign('info',$info);
        $this->display('leader/activity/qrcode');
    }

    public function action_qrcode_save(){
        $id=Arr::get($_POST,'id');
        $qrcode=Arr::get($_POST,'qrcode');
        if ($id){
            $model=ORM::factory('line',$id);
            $model->qrcode_up_time=time();
            $model->qrcode=$qrcode;
            $model->update();
            Common::message(array('message' => '更新成功', 'jumpUrl' => $this->cmsurl.'leader/activity/qrcode?line_id='.$id));
        }
    }

    public function action_ajax_sign(){
        $id=Arr::get($_POST,'id');
        $sign=Arr::get($_POST,'sign');
        if ($id){
            $model=ORM::factory('member_order_tourer',$id);
            $model->is_sign=$sign;
            $model->update();
            echo json_encode(array('status'=>1));
        }
    }



}