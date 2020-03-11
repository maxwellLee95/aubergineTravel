<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Third extends ORM
{
    /**
     * 所支持的第三方登陆
     * @return array
     */
    private function _supplyThird()
    {
        return array(
            'qq' => array(
                'alias' => 'qq',
                'name' => '腾讯QQ'
            ),
            'weixin' => array(
                'alias' => 'wx',
                'name' => '微信'
            ),
            'weibo' => array(
                'alias' => 'wb',
                'name' => '新浪微博'
            )
        );
    }

    /**
     * 封装第三登陆
     * @param $third
     * @return array
     */
    public static function thirdData($third)
    {
        $supply = self::_supplyThird();
        $supplyKey = array_keys($supply);
        foreach ($third as $v)
        {
            if (array_search($v['from'], $supplyKey) !== false)
            {
                $supply[$v['from']]['id'] = $v['id'];
                $supply[$v['from']]['nickname'] = $v['nickname'];
            }
        }
        return $supply;
    }

    /**
     * 解除绑定
     * @param $id
     * @return bool
     */
    public static function unbind($id)
    {
        $bool = false;
        $rows = DB::delete('member_third')->where("id={$id}")->execute();
        if ($rows > 0)
        {
            $bool = true;
        }
        return $bool;
    }
}