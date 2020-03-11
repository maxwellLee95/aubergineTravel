<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Member_Register
 * 会员注册
 */
class Controller_Member_Register extends Stourweb_Controller
{

    //注册首页
    public function action_index()
    {
        $this->referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->cmsurl;
        if (!stripos($this->referer, '/message/') && !stripos($this->referer, '/member/'))
        {
            Cookie::set('referer', $this->referer);
        }
        $this->assign('referer', Cookie::get('referer', $this->cmsurl));
        $sms = DB::select()->from('sms_msg')->where('msgtype="reg_msgcode"')->execute()->current();
        $this->assign('isopen', $sms['isopen']);
        $this->display('member/register');
    }

    //注册执行
    public function action_ajax_reg()
    {
        $user = Arr::get($_POST, 'user');
        $pwd = Arr::get($_POST, 'pwd');
        //验证码检测
        if (isset($_POST['code']))
        {
            $code = Arr::get($_POST, 'code');
            if (!Captcha::valid($code))
            {
                $message = array('msg' => __("error_code"), 'status' => 0);
                exit(json_encode($message));
            }
            Common::session('captcha_response', null);
        }
        else
        {
            $code = Arr::get($_POST, 'msg');
            if (Common::session('msg_code') != $code)
            {
                $message = array('msg' => __("error_code"), 'status' => 0);
                exit(json_encode($message));
            }
            Common::session('msg_code', null);
        }
        $userType = isset($_POST['is_email']) ? 'email' : 'phone';
        $validataion = Validation::factory($this->request->post());
        $validataion->rule('pwd', 'not_empty');
        $validataion->rule('pwd', 'min_length', array(':value', '6'));
        $validataion->rule('user', 'not_empty');
        $validataion->rule('user', $userType);
        if (!$validataion->check())
        {
            $error = $validataion->errors();
            $keys = array_keys($validataion->errors());
            $message = array('msg' => __("error_{$keys[0]}_{$error[$keys[0]][0]}"), 'status' => 0);
            exit(json_encode($message));
        }
        //用户不存在则添加
        $member = Model_Member::member_find($user);
        if (!empty($member))
        {
            $message = array('msg' => __("error_user_exists"), 'status' => 0);
            exit(json_encode($message));
        }
        $isPhone = false;
        if ($userType == 'phone')
        {
            $isPhone = true;
            $userType = 'mobile';
        }
        $addtime = time();
        list($insertId, $rows) = DB::insert('member', array('nickname', $userType, 'jointime', 'logintime', 'pwd'))->values(array($user, $user, $addtime, $addtime, md5($pwd)))->execute();
        if ($rows > 0)
        {
            //发送注册成功信息
            if ($isPhone)
            {
                $message = product::get_define_msg('reg');
                if ($message['isopen'])
                {
                    $content = str_replace(array('{#WEBNAME#}', '{#PHONE#}', '{#LOGINNAME#}', '{#PASSWORD#}'), array($GLOBALS['cfg_webname'], $user, $user, $pwd), $message['msg']);
                    Product::send_msg($user, $GLOBALS['cfg_webname'], $content);
                }

            }
            else
            {
                $message = product::get_email_msg('reg');
                if ($message['isopen'])
                {
                    $content = str_replace(array('{#WEBNAME#}', '{#EMAIL#}', '{#PASSWORD#}'), array($GLOBALS['cfg_webname'], $user, $pwd), $message['msg']);
                    Common::send_email($user, "邮箱注册", $content);
                }
            }
            //登录状态
            Model_Member::write_session(Model_Member::get_member_byid($insertId));

            $tMsg="注册赠送学分：{$GLOBALS['cfg_reg_jifen']}分";
            Product::operateIntegral($insertId,$GLOBALS['cfg_reg_jifen'],$tMsg,Model_Member_Jifen_Log::TYPE_INCREASE,Model_Member_Jifen_Log::ACTION_REGISTER);
            $message = array('url' => Cookie::get('referer', $this->cmsurl), 'status' => 1);
            $ucsynlogin = '';
            if (defined('UC_API') && @include_once BASEPATH . '/uc_client/client.php')
            {
                $uid = uc_user_register($user, $pwd, $user);
                if ($uid > 0)
                {
                    $ucsynlogin = uc_user_synlogin($uid);
                }
            }
            $message['js'] = $ucsynlogin;
            exit(json_encode($message));
        }
        else
        {
            $message = array('msg' => __("error_member_insert"), 'status' => 0);
            exit(json_encode($message));
        }
    }

    /**
     * ajax 发送验证码
     */
    public function action_ajax_send_message()
    {
        $validataion = Validation::factory($this->request->post());
        $validataion->rule('phone', 'not_empty');
        $validataion->rule('phone', 'phone');
        if (!$validataion->check())
        {
            exit(__('error_user_phone'));
        }
        //检测用户是否存在
        $phone = Arr::get($_POST, 'phone');
        $member = Model_Member::member_find($phone);
        if (!empty($member))
        {
            exit(__('error_user_exists'));
        }
        $code = rand(1000, 9999);
        $model = ORM::factory('sms_msg');
        $content = $model->message_template('reg_msgcode');
        $content = str_replace(array('{#CODE#}', '{#WEBNAME#}', '{#PHONE#}'), array($code, $GLOBALS['cfg_webname'], $GLOBALS['cfg_phone']), $content);
        $status = $model->send_message($phone, $code, $content);
        echo intval($status);
    }

}