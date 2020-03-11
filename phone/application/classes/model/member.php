<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member extends ORM
{
    //对应数据库
    protected $_table_name = 'member';
    protected $_primary_key = 'mid';

    /*
     * 新增用户
     * @param array $data
     * return mixed
     */
    public static function register($data)
    {
        //数据验证
        //检查账号
        $user = isset($data['mobile']) ? $data['mobile'] : $data['email'];
        $user = self::member_find($user);
        if (!empty($user))
        {
            return __('error_member_exists');
        }
        //添加
        $result = DB::insert('member', array_keys($data))->values(array_values($data))->execute();
        return $result[1] > 0 ? $result : __('error_member_insert');
    }

    /**
     * @param $loginname
     * @param $loginpwd
     * @param $hasencode 密码是否已加密
     */
    public static function login($loginname, $loginpwd, $hasencode)
    {

        $user = self::member_find($loginname, $loginpwd, $hasencode);
        if ($user)
        {
            //写登陆信息
            self::write_cookie('st_username', $user['nickname']);
            self::write_cookie('st_userid', $user['mid']);
            self::save_login_time($user['mid']);

        }
        return $user;
    }

    /*
     * 退出登陆
     * */
    public static function login_out()
    {

        Cookie::delete('st_username');
        Cookie::delete('st_userid');
    }

    /*
     * 保存登陆时间
     * */
    public static function save_login_time($mid)
    {
        $m = ORM::factory('member', $mid);
        $m->logintime = time();
        $m->save();

    }


    /*
     * 查找用户
     * @param string $user 用户账号
     * return array
     */
    public static function member_find($user, $pwd = null, $hasencode)
    {
        if (strpos($user, '@'))
        {
            $where = "email='{$user}'";
        }
        else
        {
            $where = "mobile='{$user}'";
        }
        if (!is_null($pwd))
        {
            $pwd = $hasencode ? $pwd : md5($pwd);
            $where .= " and pwd='" . $pwd . "'";
        }
        $result = DB::select()->from('member')->where($where)->execute()->as_array();
        if (!empty($result))
        {
            $result = $result[0];
        }
        return $result;
    }

    /**
     * 根据会员id获取用户信息
     * @param $mid
     * @return array
     */
    public static function get_member_byid($mid)
    {
        if ($mid)
        {
            $memberinfo = ORM::factory('member', $mid)->as_array();
            $memberinfo['last_logintime'] = Common::mydate('Y-m-d', $memberinfo['logintime']);
            $memberinfo['litpic'] = !empty($memberinfo['litpic']) ? $memberinfo['litpic'] : Common::member_nopic();
            $memberinfo['bg_pic'] = !empty($memberinfo['bg_pic']) ? $memberinfo['bg_pic'] : '/phone/public/images/wechat/hkr_bg_0.jpg';
            //第三方登陆
            $third = DB::select()->from('member_third')->where("mid={$mid}")->execute()->as_array();
            $memberinfo['third'] = Model_Member_Third::thirdData($third);
            return $memberinfo;
        }

    }

    /**
     * 学分处理
     * @param $mid
     * @param $jifen 学分
     * @param int $type 1：使用 2：获取
     * @return object
     */
    public static function operate_jifen($mid, $jifen, $type = 1)
    {
        if ($mid && $jifen){
            $jifen = $type == 1 ? -$jifen : $jifen;
            $sql = "UPDATE sline_member SET jifen=jifen+({$jifen}) ";
            $sql .= "WHERE mid={$mid}";
            $row = DB::query(Database::UPDATE, $sql)->execute();
            return $row;
        }
    }

    /**
     * 写入session
     * @param $member 会员详细信息
     * @param $user 登录账号手机或邮箱
     */
    public static function write_session($member, $user = null)
    {
        if ($member){
            //登录送学分
            if (!Model_Member_Jifen_Log::isLoginRecord($member['mid'],Model_Member_Jifen_Log::TYPE_INCREASE)){
                $tMsg="登录赠送学分：{$GLOBALS['cfg_login_jifen']}分";
                Product::operateIntegral($member['mid'],$GLOBALS['cfg_login_jifen'],$tMsg,Model_Member_Jifen_Log::TYPE_INCREASE,Model_Member_Jifen_Log::ACTION_LOGIN);
            }
            if (is_null($user))
            {
                $user = empty($member['email']) ? $member['mobile'] : $member['email'];
            }
            //昵称
            if (empty($member['nickname']) && !empty($user))
            {
                $member['nickname'] = substr_replace($user, '****', floor(strlen($user) / 2) - 2, 4);
            }
            //没有会员图片
            if (empty($member['litpic']))
            {
                $member['litpic'] = Common::member_nopic();
            }

            //没有分销id
            if (empty($member['distribution_id']))
            {
                self::addDistributionID($member['mid']);
            }

            //登录信息写入seesion
            Common::session('member', array(
                'mid' => $member['mid'],
                'nickname' => $member['nickname'],
                'litpic' => $member['litpic'],
                'distribution_id'=>$member['distribution_id'],
                'connectid'=>$member['connectid']
                )
            );

        }
    }

    /*
     * 登陆cookie信息设置
     * */
    public static function write_cookie($key, $value)
    {
        Cookie::set($key, $value, 7600);
    }

    /**
     * @param $loginname user email or phone
     * @return bool
     */
    public static function check_member_exist($loginname)
    {
        if (strpos($loginname, '@'))
        {
            $where = "email='{$loginname}'";
        }
        else
        {
            $where = "mobile='{$loginname}'";
        }
        $result = DB::select()->from('member')->where($where)->execute()->as_array();
        $flag = false;
        if (!empty($result))
        {
            $flag = true;
        }
        return $flag;
    }


    public static function distributionID(){
        return uniqid();
    }

    public static function addDistributionID($mid){
        if ($mid){
            $model=ORM::factory('member',$mid);
            $model->distribution_id=self::distributionID();
            $model->update();
        }
    }

    public static function getMemberByDistributionID($distributionID){
        return DB::select()->from('member')->where("distribution_id='{$distributionID}'")->execute()->current();
    }


}
