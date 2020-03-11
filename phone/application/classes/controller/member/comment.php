<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Member_Comment
 * 用户评论
 */
class Controller_Member_Comment extends Stourweb_Controller
{
    /**
     * 前置操作
     */
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }

    /**
     * 评论视图
     */
    public function action_index()
    {
        $id = Common::remove_xss($_GET['id']);
        $order = Model_Member_Order::get_order_detail($id);
        if (empty($order)){
            Common::head404();
        }
        $activity=Model_Line_Suit_Price::get_price_by_suit_day($order['suitid'],strtotime($order['usedate']));
        $leaders=Model_Leader::get_leaders(Model_Leader::format_ids($activity));
        $this->assign('leaders', $leaders);
        $this->assign('activity', $activity);
        $this->assign('order', $order);
        $this->display('member/comment/index');
    }

    /**
     * 写入评论
     */
    public function action_save()
    {

        $id = Common::remove_xss($_GET['id']);
        $_POST = Common::remove_xss($_POST);
        //通过订单号码检测是否id是否合法
        $row = DB::select()->from('member_order')->where("id={$id}")->execute()->current();
        if ($row['ispinlun']){
            Common::message(array('message' => "您已评论", 'jumpUrl' =>  $this->cmsurl . 'member/order/list'));
        }
        //var_dump($row);
        if (empty($row) || $row['ordersn'] != $_POST['ordersn'])
        {
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->cmsurl . 'member/order/list';
            Common::message(array('message' => __('noallow'), 'jumpUrl' => $referer));
        }
        $time=time();
        $comment_list=array();
        //活动评论
        $comment_list[]=array(
            "typeid"=>Model_Line::TYPE_ID,
            'level'=>Common::array_get($_POST,'activity_score',1),
            'score1'=>Common::array_get($_POST,'activity_score',1),
            'orderid'=>Common::array_get($_POST,'ordersn',null),
            'articleid'=>$row['productaid'],
            'content'=>Common::array_get($_POST,'activity_content',null),
            'addtime'=>$time,
            'memberid'=>$this->member['mid'],
            'isshow'=>1
        );
        for ($i=0;$i<5;$i++){
            if (!empty($_POST['leader_id_'.$i]) && Common::array_get($_POST,'leader_content_'.$i,null)){
                $comment_list[]=array(
                    "typeid"=>Model_Leader::TYPE_ID,
                    'level'=>Common::array_get($_POST,'leader_score_'.$i,1),
                    'score1'=>Common::array_get($_POST,'leader_score_'.$i,1),
                    'orderid'=>Common::array_get($_POST,'ordersn',null),
                    'articleid'=>Common::array_get($_POST,'leader_id_'.$i,0),
                    'content'=>Common::array_get($_POST,'leader_content_'.$i,null),
                    'addtime'=>$time,
                    'memberid'=>$this->member['mid'],
                    'isshow'=>1
                );
            }
        }
        if ($comment_list){
            foreach ($comment_list as $item){
                DB::insert('comment', array_keys($item))->values(array_values($item))->execute();
            }
            $tMsg="评论赠送学分{$row['jifencomment']}分";
            $flag=Product::operateIntegral($this->member['mid'], $row['jifencomment'],$tMsg,Model_Member_Jifen_Log::TYPE_INCREASE);
            if ($flag){
                //更改订单状态
                DB::update('member_order')->set(array('ispinlun' => 1))->where("id={$id}")->execute();
            }
            Common::message(array('message' => __('success_comment'), 'jumpUrl' => $this->cmsurl . 'member/order/list'));
        }else{
            Common::message(array('message' => __('error_comment'), 'jumpUrl' => $_SERVER['HTTP_REFERER']));
        }
    }


    /**
     * 上传评论图片
     */
    public function action_uploadfile()
    {
        echo json_encode($this->upload_file('Filedata'));
        exit;


    }


    /**
     * 写入评论
     */
    public function action_ajax_notes()
    {
        $article_id = Common::remove_xss(Arr::get($_POST,'article_id',0));
        $content = Common::remove_xss(Arr::get($_POST,'content',0));
        $info=Model_Notes::get_detail($article_id);
        $res=array('status'=>0,'msg'=>'操作异常');
        if (empty($info)){
            $res=array('status'=>0,'msg'=>'游记不存在');
            Common::echoJson($res);
        }

        if (empty($content)){
            $res=array('status'=>0,'msg'=>'评论不能为空');
            Common::echoJson($res);
        }
        //活动评论
        $comment=array(
            "typeid"=>Model_Notes::TYPE_ID,
            'level'=>0,
            'score1'=>0,
            'orderid'=>null,
            'articleid'=>$article_id,
            'content'=>$content,
            'addtime'=>time(),
            'memberid'=>$this->member['mid'],
            'isshow'=>1
        );
        if ($comment){
            DB::insert('comment', array_keys($comment))->values(array_values($comment))->execute();
            $res=array('status'=>1,'msg'=>'评论成功，审核后显示');
            Common::echoJson($res);
        }
        Common::echoJson($res);
    }


}