<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pub extends Stourweb_Controller
{
    /*
     * 公共请求控制器,此控制器不能删除.
     *
     * */

    public function before()
    {
        parent::before();

    }

    //请求CSS资源,合并输出
    public function action_css()
    {

        $this->response->headers('Content-Type', 'text/css');
        $this->response->headers('charset', 'utf-8');

        if (isset($_GET['file']))
        {
            $files = explode(",", $_GET['file']);
            $fc = '';
            foreach ($files as $val)
            {
                $fc .= file_get_contents(DOCROOT . $val);
            }
            //$fc = self::replace_note($fc);
            $fc = str_replace("\/t", "", $fc);
            $fc = str_replace("\/n", "", $fc);
            $fc = str_replace("\/r\/n", "", $fc);
            echo $fc;
        }
    }

    //请求js资源,合并输出
    public function action_js()
    {
        //输出JS

        $this->response->headers('Content-Type', 'application/x-javascript');
        $this->response->headers('charset', 'utf-8');
        if (isset($_GET['file']))
        {
            $files = explode(",", $_GET['file']);
            $str = '';
            foreach ($files as $val)
            {
                $str .= file_get_contents(DOCROOT . $val);
            }
            //$str = self::replace_note($str);
            $str = str_replace("\/t", "", $str);
            $str = str_replace("\/n", "", $str);
            //$str = preg_replace('#\/\/[^\n]*#','',$str);//行注释
            echo $str;
        }
    }

    /*
     * 网站头部
     * */
    public function action_header()
    {
        $uid = Cookie::get('st_userid');
        $loginname = Cookie::get('st_username');
        $searchModel = Model_Model::get_search_model();
        $this->assign('loginname',$loginname);
        $this->assign('searchmodel',$searchModel);
        $this->assign('uid',$uid);
        $templet = Product::get_use_templet('header');
        $templet = $templet ? $templet : 'pub/header';
        $this->display($templet);
    }

    /*
     * 网站底部
     * */
    public function action_footer()
    {
        $templet = Product::get_use_templet('footer');
        $templet = $templet ? $templet : 'pub/footer';
        $this->display($templet);

    }

    public function action_flink()
    {
        $templet = Product::get_use_templet('flink');
        $templet = $templet ? $templet : 'pub/flink';
        $this->display($templet);
    }

    /*
     * 帮助
     * */
    public function action_help()
    {
        $templet = Product::get_use_templet('help');
        $templet = $templet ? $templet : 'pub/help';
        $this->display($templet);
    }

    public function action_pay()
    {
        $this->display('pub/pay');
    }

    /**
     * 添加浏览次数
     */
    public function action_ajax_add_shownum()
    {
        $typeid = intval(Arr::get($_GET,'typeid'));
        $aid = Common::remove_xss(Arr::get($_GET,'productid'));
        if($typeid)
        {
            Product::update_click_rate($aid,$typeid);
        }
    }

    /**
     * 添加提问
     */
    public function action_ajax_add_question()
    {
        if(!$this->request->is_ajax())exit();
        $checkcode = Arr::get($_POST,'checkcode');
        $productid = Arr::get($_POST,'productid');
        $nickname = Arr::get($_POST,'nickname');
        $content = Arr::get($_POST,'content');
        $typeid = Arr::get($_POST,'typeid');
        $questype = Arr::get($_POST,'questype');
        //验证码
        $checkcode=strtolower($checkcode);
        if(!Captcha::valid($checkcode))
        {
            echo 1; //验证码错误
            exit;
        }
       /* if(empty($this->userinfo))
        {
            echo 2; //未登陆
            exit;
        }*/

        $ip = Common::get_ip();
        $nickname = $nickname ? $nickname : '匿名';

        $m = ORM::factory('question');
        $m->productid = $productid;
        $m->content = $content;
        $m->typeid = $typeid;
        $m->content = $content;
        $m->nickname = $nickname;
        $m->ip = $ip;
        $m->addtime = time();
        $m->memberid = '';
        $m->kindlist = '';
        $m->questype = $questype;
        $m->save();
        if($m->saved())
        {
            echo 3;
            exit;
        }



    }

    /**
     * 添加评论
     */
    public function action_ajax_add_comment()
    {
        if(!$this->request->is_ajax())exit();
        $checkcode = Common::remove_xss(Arr::get($_POST,'checkcode'));
        $productid = Common::remove_xss(Arr::get($_POST,'productid'));

        $content = Common::remove_xss(Arr::get($_POST,'content'));
        $typeid = Common::remove_xss(Arr::get($_POST,'typeid'));
        //验证码
        $checkcode=strtolower($checkcode);
        if(!Captcha::valid($checkcode))
        {
            echo 1; //验证码错误
            exit;
        }
        $memberId = Cookie::get('st_userid') ?  Cookie::get('st_userid') :  '0';
        $m = ORM::factory('comment');
        $m->articleid = $productid;
        $m->content = $content;
        $m->typeid = $typeid;
        $m->memberid = $memberId;
        $m->addtime = time();
        $m->save();
        if($m->saved())
        {
            echo 3;
            exit;
        }



    }

    /*
     * 验证验证码是否正确
     * */
    public function action_ajax_check_code()
    {
        $flag = 'false';
        $checkcode = strtolower(Arr::get($_POST,'checkcode'));
        if(Captcha::valid($checkcode))
        {
            $flag = 'true';
        }
        echo $flag;
    }









}