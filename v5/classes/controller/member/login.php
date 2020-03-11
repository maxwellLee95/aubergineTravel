<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Member_Login
 * 会员登陆
 */
class Controller_Member_Login extends Stourweb_Controller
{

    private  $_mid;
    public function before()
    {
        parent::before();
        $this->_mid = Cookie::get('st_userid') ?  Cookie::get('st_userid') :  0;

    }

    //登录首页
    public function action_index()
    {
        //判断是否是登陆状态
        if(!empty($this->_mid))
        {
            $this->request->redirect('member');
        }
        $redirect_url = Arr::get($_GET,'redirecturl');

        if(empty($redirect_url))
        {
            $fromurl = $_SERVER['HTTP_REFERER'];//来源地址
            $fromurl = strpos($fromurl,'register') || strpos($fromurl,'login')||strpos($fromurl,'findpwd')? $GLOBALS['cfg_basehost'] : $fromurl;
            $fromurl = $fromurl ? $fromurl : $GLOBALS['cfg_basehost'];
        }
        else
        {
            $fromurl = $redirect_url;
        }

        Common::session('login_referer',$fromurl);

        //token
        $token = md5(time());
        Common::session('crsf_code',$token);
        $this->assign('frmcode',$token);
        $this->assign('fromurl',$fromurl);
        $this->display('member/login');
    }

    //退出登陆
    public function action_loginout()
    {
        $referer = $_SERVER['HTTP_REFERER'];//来源地址
        Model_Member::login_out();
        $this->request->redirect($referer);

    }

    //ajax登陆
    public function action_ajax_login()
    {
        $ucsynlogin = '';
        $loginName = Arr::get($_POST,'loginname');
        $loginPwd = Arr::get($_POST,'loginpwd');
        $frmCode = Arr::get($_POST,'frmcode');
        //安全校验码验证
        $orgCode = Common::session('crsf_code');
       if($orgCode!=$frmCode)
        {
            $out['status'] = 0;
            $out['msg'] = '校验码错误';
            echo json_encode($out);
            exit;
        }
        $user = Model_Member::login($loginName,$loginPwd,1);
        $status = !empty($user) ? 1 : 0;

        #api{{
        if(defined('UC_API') && include_once BASEPATH.'/uc_client/client.php')
        {

            //检查帐号
            list($uid, $loginname, $password, $email) = uc_user_login($loginName, $loginPwd);

            if($uid > 0)
            {

                //同步登录的代码
                $ucsynlogin = uc_user_synlogin($uid);
            }
            else if($uid == -1)
            {
                $uid = uc_user_register($loginname, md5($password),'');
                if($uid > 0)
                {
                    $ucsynlogin = uc_user_synlogin($uid);
                }
            }
        }
        #/aip}}

        $out = array();
        $out['status'] = $status;
        $out['js'] = $ucsynlogin;
        echo json_encode($out);

    }


    /**
     * ajax判断是否登陆
     */
    public function action_ajax_is_login()
    {
        //检测用户是否存在
        $mid = Cookie::get('st_userid');
        if (!isset($mid))
        {

            exit(json_encode(array('status' => 0)));
        }
        else
        {
            $member = Model_Member::get_member_byid($mid);
            $minfo = array(
                'mid'=>$member['mid'],
                'nickname'=>$member['nickname'],
                'litpic'=>$member['litpic'],
                'last_logintime'=>$member['last_logintime']
            );
            exit(json_encode(array('status' => 1,'user'=>$minfo)));
        }
    }

    //第三方登录
    public function action_third()
    {
        $forwardurl = Arr::get($_GET, 'forwardurl');
        //QQ
        $cfg_qq_appid = $GLOBALS['cfg_qq_appid'];
        $cfg_qq_appkey = $GLOBALS['cfg_qq_appkey'];
        //sina
        $cfg_sina_appkey = $GLOBALS['cfg_sina_appsecret'];
        $cfg_sina_appsecret = $GLOBALS['cfg_sina_appsecret'];
        //weixin
        $cfg_weixi_appkey = $GLOBALS['cfg_weixi_appkey'];
        $cfg_weixi_appsecret = $GLOBALS['cfg_weixi_appsecret'];
        //
        $qqlogin = $cfg_qq_appid && $cfg_qq_appkey ? 1 : 0;
        $sinalogin = $cfg_sina_appkey && $cfg_sina_appsecret ? 1 : 0;
        $weixinlogin = $cfg_weixi_appkey && $cfg_weixi_appsecret ? 1 : 0;
        if (!empty($GLOBALS['cfg_qq_appid']) && !empty($GLOBALS['cfg_qq_appkey']))
        {
            $this->assign('forwardurl', $forwardurl);
        }
        $this->assign('qqlogin', $qqlogin);
        $this->assign('sinalogin', $sinalogin);
        $this->assign('weixinlogin', $weixinlogin);
        $this->display('member/third');
    }

    //sina
    public function action_sina()
    {
        session_start();
        $code = $_REQUEST["code"];
        include(VENDORPATH . '/sina.class.php');
        $appkey = $GLOBALS['cfg_sina_appkey'];
        $appsecret = $GLOBALS['cfg_sina_appsecret'];
        $callback_url = $this->cmsurl . "member/login/sina";
        $sina = new sinaPHP($appkey, $appsecret, $callback_url);
        if (empty($code))
        {
            $url = $sina->login_url();
            header("location:{$url}");
            exit;
        }
        else
        {
            $ar = $sina->access_token($code);//获取access-toking
            $sina->access_token = $ar['access_token']; //
            $me = $sina->get_uid();
            $uid = $me['uid'];
            $me = $sina->show_user_by_id($uid);
            if (!empty($me['id']))
            {
                $sql = "select * from sline_member where `connectid`='{$me['id']}' and `from`='sina'";
                $row = DB::query(1, $sql)->execute()->as_array();
                $r = $row[0];
                if (!empty($r)) ////帐号已存在于数据库，则直接转向登陆操作
                {
                    $user = !empty($r['mobile']) ? $r['mobile'] : $r['email'];
                    //Model_Member::write_session($r, $user);
                    Model_Member::write_cookie('st_username',$r['nickname']);
                    Model_Member::write_cookie('st_userid',$r['mid']);

                    $url = Cookie::get('referer', $this->cmsurl . 'phone/');
                    header("Location:{$url}");
                }
                else
                {
                    //未存在于数据库中，跳转到注册绑定页面绑定用户.
                    $_SESSION['connectid'] = $me['id'];
                    $_SESSION['from'] = 'sina';
                    $url = $this->cmsurl . "member/login/savebind?uname=" . urlencode($me['screen_name']);
                    $url .= "&pwd=123456789&connectid=" . $me['id'] . '&from=sina';
                    header("Location:{$url}");
                }
            }
        }
    }

    //QQ登录
    public function action_qq()
    {
        session_start();
        $code = $_REQUEST["code"];
        include(VENDORPATH . '/qq.class.php');
        $appid = $GLOBALS['cfg_qq_appid'];
        $appkey = $GLOBALS['cfg_qq_appkey'];
        $callback_url = $this->cmsurl . "member/login/qq";
        $qq = new qqPHP($appid, $appkey, $callback_url);
        if (empty($code))
        {
            $url = $qq->login_url($_SESSION['state']);
            header("location:$url");
            exit;
        }
        else
        {
            $token = $qq->access_token($code);//获取access-toking
            $openid = $qq->get_openid($token); //获取openid
            if (!empty($openid))
            {
                $sql = "select * from sline_member where `connectid`='$openid' and `from`='qq'";
                $row = DB::query(1, $sql)->execute()->as_array();
                $r = $row[0];
                if (!empty($r))
                {
                    $user = !empty($r['mobile']) ? $r['mobile'] : $r['email'];
                    Model_Member::write_cookie('st_username',$r['nickname']);
                    Model_Member::write_cookie('st_userid',$r['mid']);
                    $url = Cookie::get('referer', $this->cmsurl . '');
                    header("Location:{$url}");
                }
                else
                {
                    //未存在于数据库中，跳转到注册绑定页面绑定用户.介于腾讯的霸王条款,绑定注册页面禁用.
                    $user = $qq->get_user_info($openid, $token);
                    $_SESSION['connectid'] = $openid;
                    $_SESSION['from'] = 'qq';
                    $url = $this->cmsurl . "member/login/savebind?uname=" . urlencode($user['nickname']);
                    $url .= "&pwd=123456789&connectid=" . $openid . '&from=qq';
                    header("Location:{$url}");
                }
            }
        }
    }

    //weixin
    public function action_weixin()
    {
        session_start();
        $code = $_REQUEST["code"];
        include(VENDORPATH . '/weixin.class.php');
        $appid = $GLOBALS['cfg_weixi_appkey'];
        $appkey = $GLOBALS['cfg_weixi_appsecret'];
        $callback_url = $this->cmsurl . "member/login/weixin";
        $state = time();
        $weixin = new weixinPHP($appid, $appkey, $callback_url, $state);
        if (empty($code))
        {
            $url = $weixin->login_url();
            header("location:{$url}");
            exit;
        }
        else
        {
            $tokenarr = $weixin->access_token($code);//获取token及openid是一个数组
            $token = $tokenarr['access_token'];
            $openid = $tokenarr['openid']; //获取openid
            $user = $weixin->get_user_info($openid, $token);
            if (!empty($user))
            {
                $sql = "select * from sline_member where `connectid`='$openid' and `from`='weixin'";
                $row = DB::query(1, $sql)->execute()->as_array();
                $r = $row[0];
                if (!empty($r))
                {
                    $user = !empty($r['mobile']) ? $r['mobile'] : $r['email'];
                    Model_Member::write_cookie('st_username',$r['nickname']);
                    Model_Member::write_cookie('st_userid',$r['mid']);
                    $url = Cookie::get('referer', $this->cmsurl . 'phone/');
                    header("Location:{$url}");
                    exit;
                }
                else
                {
                    //未存在于数据库中，跳转到注册绑定页面绑定用户.介于腾讯的霸王条款,绑定注册页面禁用.
                    $user = $weixin->get_user_info($openid, $token);
                    $_SESSION['connectid'] = $openid;
                    $_SESSION['from'] = 'weixin';
                    $url = $this->cmsurl . "member/login/savebind?uname=" . urlencode($user['nickname']);
                    $url .= "&pwd=123456789&connectid=" . $openid . '&from=weixin';
                    header("Location:{$url}");
                    exit;
                }
            }
        }
    }

    //绑定账号
    public function action_savebind()
    {
        @session_start();
        $member = array(
            'pwd' => md5(Arr::get($_GET, 'pwd')),
            'nickname' => Arr::get($_GET, 'uname'),
            'connectid' => Arr::get($_GET, 'connectid'),
            'jointime' => time(),
            'logintime' => time(),
            'jifen' => empty($GLOBALS['cfg_reg_jifen']) ? 0 : $GLOBALS['cfg_reg_jifen'],
        );
        $member['from'] = empty($_GET['from']) ? $_SESSION['from'] : $_GET['from'];
        list($member['mid'], $row) = DB::insert('member', array_keys($member))->values(array_values($member))->execute();
        if ($row)
        {
            $user = !empty($r['mobile']) ? $r['mobile'] : $r['email'];
            Model_Member::write_session($r, $user);
            $url = Cookie::get('referer', $this->cmsurl . 'phone/');
            header("Location:{$url}");
            exit;
        }
    }

    //注销登录
    public function action_ajax_out()
    {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->cmsurl;
        $fromurl = strpos($referer,'member') || strpos($referer,'login')||strpos($fromurl,'register')? $GLOBALS['cfg_basehost'] : $referer;
        Common::session('member', NULL);
        Cookie::delete('st_userid');
        header("Location:{$fromurl}");
    }
}