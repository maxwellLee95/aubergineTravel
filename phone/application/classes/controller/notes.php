<?php defined('SYSPATH') or die('No direct script access.');

/**
 */
class Controller_notes extends Stourweb_Controller
{

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
         $list=Model_Notes::notes_new(Model_Notes::TYPE_TXT);
         $this->assign('list',$this->_notes($list));
         $this->assign('curnav','notes');
         $this->display('notes/index');
    }



    public function action_ajax_notes(){
        $page=Arr::get($_POST,'page',2);
        $list=Model_Notes::notes_new(Model_Notes::TYPE_TXT,$page);
        $res=array(
            'status'=>1,
            'articles'=>$this->_notes($list)
        );
        echo json_encode($res);
    }


    public function _notes($list,$note_type=Model_Notes::TYPE_TXT){
        $articles=array();
        if ($list){
            foreach ($list as $v){
                $view=$note_type==Model_Notes::TYPE_TXT?'show':'video_show';
                $articles[]=array(
                    'comment_count'=>Model_Comment::get_comment_num($v['id'],Model_Notes::TYPE_ID),
                    'title'=>$v['title'],
                    'id'=>$v['id'],
                    'img'=>$v['litpic'],
                    'date'=>date('Y-m-d',$v['modtime']),
                    'select_status'=>null,
                    'url'=>Common::get_web_url(0).'/notes/'.$view.'?id='.$v['id'],
                    'read'=>$v['shownum'],
                    'hiker'=>
                        array(
                            'hikerId'=>$v['memberid'],
                            'nickname'=>$v['nickname'],
                            'headImgUrl'=>$v['litpic'] ? $v['litpic'] : Common::member_nopic(),
                            "sex"=> $v['sex'],
                        ),
                    'first_enable_date'=>date('Y-m-d',$v['modtime']),
                );
            }
        }

        return $articles;
    }

    public function action_list(){
        $this->display('notes/list');
    }

    public function action_ajax_getlist(){
        $page=Arr::get($_POST,'page',1);
        $res=array(
            "errcode"=>0,
            "errmsg"=>"ok",
            "data"=>array(),
        );
        $res['data']['items']=$this->_notes(Model_Notes::notes_new(Model_Notes::TYPE_TXT,$page));
        $res['data']['total_pages']=count( $res['data']['items']);
        echo json_encode($res);
    }

    /**
     * 详细页
     */
    public function action_show()
    {
        $member = Common::session('member');
        Common::check_login($member);
        $id=Common::remove_xss(Arr::get($_GET,'id'));
        $info=Model_Notes::get_detail($id);
        if ($info['status']==Model_Notes::STATUS_SUCCESS){
            Product::update_click_rate($id, Model_Notes::TYPE_ID);
            $comment_num=Model_Comment::get_comment_num($id,Model_Notes::TYPE_ID);
            $comment_list=Model_Comment::get_comment_by_notesid($id);
            $info['is_like']=Model_Notes_Like::getItem($id,$member['mid'])?true:false;
            $info['is_attention']=Model_Member_Fans::getFansItem($info['memberid'],$member['mid'])?true:false;
            $info['like_total']=Model_Notes_Like::getCount($id);
            $comment=$this->_commnet($comment_list);
            $this->assign('comment_num',$comment_num);
            $this->assign('comment',$comment);
            $this->assign('curnav','notes');
            $this->assign('info',$info);
            $this->display('notes/show');
        }else{
            Common::head404();
        }

    }

    public function action_ajax_get_comment(){
        $article_id=Common::remove_xss(Arr::get($_POST,'article_id'));
        if ($article_id){
            $page=Common::remove_xss(Arr::get($_POST,'page'));
            $comment_list=Model_Comment::get_comment_by_notesid($article_id);
            $data=$this->_commnet($comment_list);
            echo json_encode($data);
        }


    }


    public function _commnet($comment_list){
        $comment=array();
        if ($comment_list){
            foreach ($comment_list as $k=>$item){
                $t=array();
                if (empty($item['pid'])){
                    $t=array(
                        'headImgUrl'=>Common::member_pic($item['avatar']),
                        'nickname'=>$item['nickname'],
                        'create_date'=>date('m月d日 H:i',$item['addtime']),
                        'id'=>$item['id'],
                        'hiker_id'=>$item['memberid'],
                        'content'=>$item['content'],
                        'url'=>"",
                        'my_count'=>0,
                        'marks'=>array(),
                        'lastComments'=>array()
                    );
                    foreach ($comment_list as $v){
                        if (!empty($v['pid']) && $v['pid']==$item['id']){
                            $t['lastComments'][]=array(
                                'id'=>$v['id'],
                                'hiker_id'=>$v['memberid'],
                                'article_id'=>$v['articleid'],
                                'parent_id'=>$v['pid'],
                                'parent_hiker_id'=>$item['memberid'],
                                'root_id'=>$v['pid'],
                                'content'=>$v['content'],
                                'parentHiker'=>array(
                                    'hikerId'=>$item['memberid'],
                                    'nickname'=>$item['nickname'],
                                    'headImgUrl'=>Common::member_pic($item['avatar'])
                                )                                );
                        }
                    }
                }
                if ($t){
                    $comment['articleComments'][]=$t;
                }
            }
        }
        return $comment;
    }


    public function action_edit(){
        $member = Common::session('member');
        Common::check_login($member);
        $noteid = intval(Common::remove_xss(Arr::get($_GET,'noteid')));
        //用于会员信息修改
        if(!empty($noteid) && !empty($member['mid']))
        {
            $info = ORM::factory('notes')
                ->where("id=$noteid and memberid=".$member['mid'])
                ->find()
                ->as_array();
//            Common::dd($info);
            if(!empty($info))
            {
                $this->assign('info',$info);
            }else{
                Common::head404();
            }
        }else{
            Common::head404();
        }
        $this->display('notes/edit');
    }

    public function action_add(){
        Common::check_login();
        $this->display('notes/edit');
    }


    public function action_ajax_upload_img(){
        $filedata = Arr::get($_FILES,'file');
        $storepath = UPLOADPATH.'/notes/';
        if(!file_exists($storepath))
        {
            mkdir($storepath);
        }
        $filename = uniqid();
        $out = array(
            'status'=>0,
            'msg'=>'上传失败'
        );
        if(move_uploaded_file($filedata['tmp_name'], $storepath.$filename.$filedata['name']))
        {
            $url='/uploads/notes/'.$filename.$filedata['name'];
            $out['status'] = 1;
            $out['litpic'] = $url;
            $out['cover']  = $url;
            $out['url']  = $url;
        }
        echo json_encode($out);
    }

    /**
     * 游记保存
     */
    public function action_ajax_save()
    {

        //会员信息
        $member = Common::session('member');
        //要求写游记必须登陆
        if(!empty($member['mid']))
        {
            $frmCode = Common::remove_xss(Arr::get($_POST,'frmcode'));
            $title = Common::remove_xss(Arr::get($_POST,'title'));
            $description = Common::remove_xss(Arr::get($_POST,'description'));
            $content = Arr::get($_POST,'content');
            $banner = Common::remove_xss(Arr::get($_POST,'banner'));
            $cover = Common::remove_xss(Arr::get($_POST,'cover'));
            $noteid = intval(Arr::get($_POST,'noteid'));
            $video = Common::remove_xss(Arr::get($_POST,'video'));
            $music = Common::remove_xss(Arr::get($_POST,'music'));
            $submit_type = Common::remove_xss(Arr::get($_POST,'submit_type',0));

            $notes_type =Common::remove_xss(Arr::get($_POST,'notes_type'));
            $notes_type=empty($notes_type)?Model_Notes::TYPE_TXT:$notes_type;
            //安全校验码验证
            $orgCode = Common::session('code');
            if($orgCode!=$frmCode)
            {
                exit('frmcode error');
            }
            if(!empty($noteid))
            {
                $m = ORM::factory('notes',$noteid);
                $m->modtime = time();
            }
            else
            {
                $m = ORM::factory('notes');
                $m->addtime = time();
                $m->modtime = time();
            }
            $m->title = $title;
            $m->memberid = $member['mid'];
            $m->bannerpic = $banner;
            $m->litpic = $cover;
            $m->description = $description;
            $m->content = $content;
            $m->video = $video;
            $m->music = $music;
            $m->type = $notes_type;
            $status = $submit_type==1?-2:0;
            $m->status=$status;
            $m->save();
            if($m->saved())
            {
                if(empty($noteid))
                {
                    $m->reload();
                    $noteid = $m->id;
                }
            }
            echo json_encode(array('status'=>1,'noteid'=>$noteid,'msg'=>$status==Model_Notes::STATUS_EDIT?'已保存':'发布成功，等待审核'));
            exit();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'请登录'));
            exit();
        }
    }

    public function action_ajax_upload_videos(){
        $filedata = Arr::get($_FILES,'video');
        $storepath = UPLOADPATH.'/notes/videos/';
        $isLitpic=Arr::get($_GET,'litpic',false);
        if(!file_exists($storepath))
        {
            mkdir($storepath);
        }
        $filename = uniqid();
        $out = array(
            'status'=>0,
            'msg'=>'上传失败'
        );
        if(move_uploaded_file($filedata['tmp_name'], $storepath.$filename.$filedata['name']))
        {
            $url='/uploads/notes/videos/'.$filename.$filedata['name'];
            if ($isLitpic){
                $path=UPLOADPATH.'/notes/videos/'.$filename.$filedata['name'];
                $jpg_path=UPLOADPATH.'/notes/videos_image/'.$filename.'.jpg';
                $videos_image='/uploads/notes/videos_image/'.$filename.'.jpg';
                $out['litpic']  = $videos_image;
                Common::videoScreenshot($path,$jpg_path);
            }
            $out['msg'] = '上传成功';
            $out['status'] = 1;
            $out['url']  = $url;

        }
        echo json_encode($out);
    }

    public function action_ajax_upload_audio(){
        $filedata = Arr::get($_FILES,'audio');
        $storepath = UPLOADPATH.'/notes/audio/';
        if(!file_exists($storepath))
        {
            mkdir($storepath);
        }
        $filename = uniqid();
        $out = array(
            'status'=>0,
            'msg'=>'上传失败'
        );
        if(move_uploaded_file($filedata['tmp_name'], $storepath.$filename.$filedata['name']))
        {
            $url='/uploads/notes/audio/'.$filename.$filedata['name'];
            $out['status'] = 1;
            $out['msg']='上传成功';
            $out['url']  = $url;
        }
        echo json_encode($out);
    }


    public function action_video_list(){
        $type=Model_Notes::TYPE_VIDEOS;
        $list=Model_Notes::notes_new($type,1);
        $articles=$this->_notes($list,$type);
        $this->assign('articles',$articles);
        $this->display('notes/video_list');
    }


    public function action_video_edit(){
        $member = Common::session('member');
        Common::check_login($member);
        $noteid = intval(Common::remove_xss(Arr::get($_GET,'noteid')));
        if(empty($member['mid']))
        {
            Common::message(array('message'=>'需要登陆','jumpUrl'=> $this->cmsurl));
        }
        //用于会员信息修改
        if(!empty($noteid) && !empty($member['mid']))
        {
            $info = ORM::factory('notes')
                ->where("id=$noteid and memberid=".$member['mid'])
                ->find()
                ->as_array();
            if(!empty($info))
            {
                $this->assign('info',$info);
            }
        }
        $this->display('notes/video_edit');
    }


    public function action_ajax_get_video_list(){
        $page=Arr::get($_POST,'page',2);
        $res=array(
            "status"=>1,
            "errmsg"=>"ok",
            "articles"=>array(),
        );
        $res['articles']=$this->_notes(Model_Notes::notes_new(Model_Notes::TYPE_VIDEOS,$page),Model_Notes::TYPE_VIDEOS);
        echo json_encode($res);
    }

    /**
     * 详细页
     */
    public function action_video_show()
    {
        $id=Common::remove_xss(Arr::get($_GET,'id'));
        $info=Model_Notes::get_detail($id);
        if ($info){
            Product::update_click_rate($id, Model_Notes::TYPE_ID);
            $comment_num=Model_Comment::get_comment_num($id,Model_Notes::TYPE_ID);
            $comment_list=Model_Comment::get_comment_by_notesid($id);
            $comment=$this->_commnet($comment_list);
            $this->assign('comment_num',$comment_num);
            $this->assign('comment',$comment);
            $this->assign('curnav','notes');
            $this->assign('info',$info);
            $this->display('notes/video_show');
        }

    }



    public function action_video_add(){
        Common::check_login();
        $this->display('notes/video_edit');
    }


    public function action_ajax_like(){
        $id=Arr::get($_POST,'article_id',0);
        $note=Model_Notes::get_detail($id);
        $res=array('status'=>0,'msg'=>'操作异常');
        $member = Common::session('member');
        if ($note){
            $note_like=Model_Notes_Like::getItem($note['id'],$member['mid']);
            //如果存在，则删除，否则创建
            if ($note_like['id']){
                $model=ORM::factory('notes_like',$note_like['id']);
                $model->delete();
                $res=array('status'=>2,'msg'=>'取消点赞成功');
            }else{
                $model=ORM::factory('notes_like');
                $model->note_id=$id;
                $model->member_id=$member['mid'];
                $model->create();
                $res=array('status'=>1,'msg'=>'点赞成功');
            }
        }
        echo  json_encode($res);exit;
    }




}