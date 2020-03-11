<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Notes extends Stourweb_Controller{

    private  $_typeid = 101;
    private  $_cache_key = '';
    public function before()
    {
        parent::before();
        //检查缓存
        $this->_cache_key = Common::get_current_url();
        $html = Common::cache('get',$this->_cache_key);
        $genpage = Common::remove_xss(Arr::get($_GET,'genpage'));
        if(!empty($html) && empty($genpage))
        {
            echo $html;
            exit;
        }
        $this->assign('typeid',$this->_typeid);

    }
    //首页
    public function action_index()
    {

        $seoinfo = Model_Nav::get_channel_seo($this->_typeid);
        $this->assign('seoinfo', $seoinfo);

        //游记数量
        $total = Model_Notes::get_total_notes();
        $this->assign('total_notes',$total);
        //首页模板
        $templet = Product::get_use_templet('notes_index');
        $templet = $templet ? $templet : 'notes/index';
        $this->display($templet);
        //缓存内容
        $content = $this->response->body();
        Common::cache('set',$this->_cache_key,$content);

    }

    //显示游记
    public function action_show()
    {
        $noteid = intval(Common::remove_xss($this->request->param('id')));
        if(!empty($noteid))
        {
            $info = ORM::factory('notes',$noteid)->as_array();
            //未通过审核的游记
            if($info['status']!=1)
            {
                $msg = array(
                    'status'=>0,
                    'msg'=>'游记未通过审核,暂时不能浏览',
                    'jumpUrl'=>$this->request->referrer()
                );
                Common::message($msg);
                exit;
            }
            $member = ORM::factory('member',$info['memberid'])->as_array();
            $this->assign('info',$info);
            $this->assign('member',$member);
            $templet = Product::get_use_templet('notes_show');
            $templet = $templet ? $templet : 'notes/show';
            $this->display($templet);

        }

    }
    //写游记
    public function action_write()
    {
        $noteid = intval(Common::remove_xss(Arr::get($_GET,'noteid')));
        $memberid = intval(Common::remove_xss(Arr::get($_GET,'memberid')));
        //会员信息
        $userInfo = Product::get_login_user_info();
        //要求写游记必须登陆
        if(empty($userInfo['mid']))
        {
            $this->request->redirect('/member/login/?redirecturl='.urlencode(Common::get_current_url()));
        }
        //用于会员信息修改
        if(!empty($noteid) && !empty($memberid))
        {
            $info = ORM::factory('notes')
                ->where("id=$noteid and memberid=$memberid")
                ->find()
                ->as_array();
            if(!empty($info))
            {
                $this->assign('info',$info);
            }
        }
        //frmcode
        $code = time();
        Common::session('code',$code);
        $this->assign('frmcode',$code);
        $this->display('notes/write');
    }

    /**
     * 游记保存
     */
    public function action_ajax_save()
    {
        //会员信息
        $userInfo = Product::get_login_user_info();
        //要求写游记必须登陆
        if(empty($userInfo['mid']))
        {
            $this->request->redirect('/member/login/?redirecturl='.urlencode(Common::get_current_url()));
        }
        $frmCode = Common::remove_xss(Arr::get($_POST,'frmcode'));
        $title = Common::remove_xss(Arr::get($_POST,'title'));
        $description = Common::remove_xss(Arr::get($_POST,'description'));
        $content = Common::remove_xss(Arr::get($_POST,'content'));
        $banner = Common::remove_xss(Arr::get($_POST,'banner'));
        $cover = Common::remove_xss(Arr::get($_POST,'cover'));
        $noteid = intval(Arr::get($_POST,'noteid'));

        //安全校验码验证
        $orgCode = Common::session('code');
        if($orgCode!=$frmCode)
        {
            exit('frmcode error');
        }
        if(!empty($noteid))
        {
            $m = ORM::factory('notes',$noteid);
        }
        else
        {
            $m = ORM::factory('notes');
        }
        $m->title = $title;
        $m->memberid = $userInfo['mid'];
        $m->bannerpic = $banner;
        $m->litpic = $cover;
        $m->description = $description;
        $m->content = $content;
        $m->modtime = time();
        $status = 0;
        $m->save();
        if($m->saved())
        {
            $status = 1;
            if(empty($noteid))
            {
                $m->reload();
                $noteid = $m->id;
            }
        }
        echo json_encode(array('status'=>$status,'noteid'=>$noteid));
        exit();


    }

    public function action_ajax_get_new_notes()
    {
        $currentpage = intval(Arr::get($_GET,'curr'));//当前页
        $pagesize = 6;//每次显示条数需要与js端设置一至
        $offset = ($currentpage-1) * $pagesize;
        $list = Model_Notes::get_new_notes($offset,$pagesize);
        foreach($list as &$row)
        {
            $row['pubdate'] = Common::mydate('Y-m-d H:i',$row['modtime']);
        }
        echo json_encode(array('list'=>$list));
        exit;

    }

    /**
     * 上传图片
     */
    public function action_ajax_upload_picture()
    {
        //if(!$this->request->is_ajax())exit;
        $filedata = Arr::get($_FILES,'filedata');
        $storepath = UPLOADPATH.'/notes/';
        if(!file_exists($storepath))
        {
            mkdir($storepath);
        }
        $filename = uniqid();
        $out = array();
        if(move_uploaded_file($filedata['tmp_name'], $storepath.$filename.$filedata['name']))
        {
            $out['status'] = 1;
            $out['litpic'] = '/uploads/notes/'.$filename.$filedata['name'];
        }
        echo json_encode($out);
    }








}