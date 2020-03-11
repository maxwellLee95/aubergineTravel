<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Leader_list extends Stourweb_Controller
{


    public function action_index(){
        $leaders_data=Model_Leader::get_all_leaders(Model_Leader::STATS_NORMAL,100);
        $leaders=array();
        $ranking_leaders=array();
        if ($leaders_data){
            foreach ($leaders_data as $leader){
                $activitys=Model_Leader::getActivitys($leader['id'],0,300);
                if ($activitys){
                    $t=$leader;
                    $t['order_count']=count($activitys);
                    $t['activitys']=$activitys;
                    $t['litpic']=Common::member_pic($leader['litpic']);
                    $leaders[]=$t;
                }
            }
            $ranking_leaders=Common::u_array_sort($leaders,'order_count',SORT_DESC);
            if (is_array($ranking_leaders)){
                array_splice($ranking_leaders,3);
            }
        }
        $ranking_name=array(
            0=>'冠军',
            1=>'亚军',
            2=>'季军'
        );
        $this->assign('ranking_name',$ranking_name);
        $this->assign('ranking_leaders',$ranking_leaders);
        $this->assign('leaders',$leaders);
        $this->display('leader/list');
    }



}