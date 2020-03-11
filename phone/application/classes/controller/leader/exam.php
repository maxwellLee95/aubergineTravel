<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Exam extends Stourweb_Controller
{
    public $leader=null;
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


    public function action_list()
    {
        $list=DB::select()->from('leader_exam')->order_by("id","desc")->execute()->as_array();
        if ($list){
            foreach ($list as &$item){
                $certification=DB::select()->from('leader_exam_result')
                    ->where("leader_id","=",$this->leader['id'])
                    ->where("exam_id","=",$item['id'])
                    ->execute()->current();
                $item['result']=$certification;
            }
        }
        $this->assign('list',$list);
        $this->display('leader/exam/list');
    }



    public function action_index(){
        $id=Arr::get($_GET,'id',null);
        $exam=Model_Leader_Exam::getItem($id);

        if (empty($exam)){
            Common::head404();
        }
        $exam['end_time']=Common::convertToHoursMins($exam['time']);
        $info=Model_Leader_Exam_Result::getItemByUser($id,$this->leader['id']);
        if ($info['is_passed']){
            Common::message(array('message' => '您已经考试合格啦，无需再次参加', 'jumpUrl' => '/phone/leader/exam/list'));
            exit();
        }
        $questions=Model_Exam_Questions::getQuestions($exam['questions_count']);
        $info['status_name']=Model_Leader_Exam_Result::getStatusName($info['status']);
        $this->assign('questions',$questions);
        $this->assign('info',$info);
        $this->assign('exam',$exam);
        $this->assign('leader',$this->leader);
        $this->display('leader/exam/index');
    }

    public function action_submit()
    {
        $id=Arr::get($_POST,'id',array());
        $exam=Model_Leader_Exam::getItem($id);
        if ($exam){
            $questions=Arr::get($_POST,'questions',array());
            $answers=Arr::get($_POST,'answers',array());
            $pass_count=0;
            if ($questions && $answers){
                foreach ($questions as $qid){
                    $question=Model_Exam_Questions::getItem($qid);
                    if ($question && !empty($answers[$qid]) && strtolower($question['answers'])==strtolower($answers[$qid][0])){
                        $pass_count++;
                    }else{
                        break;
                    }
                }
                $info=Model_Leader_Exam_Result::getItemByUser($id,$this->leader['id']);
                if ($info){
                    $model=ORM::factory('leader_exam_result',$info['id']);
                    $model->uptime=time();
                }else{
                    $model=ORM::factory('leader_exam_result');
                    $model->addtime=time();
                }
                $model->leader_id=$this->leader['id'];
                $model->exam_id=$id;
                if ($pass_count==count($questions)){
                    $model->is_passed=true;
                    $model->save();
                    Common::message(array('message' => '您考试合格啦', 'jumpUrl' => '/phone/leader/exam/list'));
                }else{
                    $model->is_passed=false;
                    $model->save();
                    Common::message(array('message' => '您考试本次不合格，请重新再来', 'jumpUrl' => "/phone/leader/exam/index?id={$id}"));
                }
            }else{
                Common::message(array('message' => '请答题', 'jumpUrl' =>"/phone/leader/exam/index?id={$id}"));
            }
        }else{
            Common::message(array('message' => '本次考试不存在', 'jumpUrl' => '/phone/leader/exam/list'));
        }


    }


}