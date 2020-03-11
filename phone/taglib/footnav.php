<?php
/**
 * Created by Phpstorm.
 * User: netman
 * Date: 15-9-23
 * Time: 上午10:43
 * Desc: 底部导航获取标签
 */

class Taglib_Footnav {

    /*
     * 获取广告
     * @param 参数
     * @return array

   */
    public static function query($params)
    {
        $default=array('name'=>'');
        $params=array_merge($default,$params);
        extract($params);
        $sql="SELECT * FROM `sline_serverlist` WHERE mobileshow=1 and isdisplay=1 ORDER BY displayorder ASC";
        $ar = DB::query(1,$sql)->execute()->as_array();
        foreach($ar as &$row)
        {
            $row['title'] = $row['servername'];
            $row['url'] = Common::get_web_url(0)."/servers/index_{$row['aid']}.html";
        }

        return $ar;
    }

    public static function pc($params)
    {
        $default=array(
            'row'=>5,
            'offset'=>0
        );
        $params=array_merge($default,$params);
        extract($params);
        $sql="SELECT * FROM `sline_serverlist` WHERE isdisplay=1 ORDER BY displayorder ASC LIMIT {$offset},{$row}";
        $ar = DB::query(1,$sql)->execute()->as_array();
        foreach($ar as &$row)
        {
            $row['title'] = $row['servername'];
            $row['url'] = Common::get_web_url(0)."/servers/index_{$row['aid']}.html";
        }

        return $ar;
    }


    public static function nav($params)
    {
        $default=array('curnav'=>'index');
        $params=array_merge($default,$params);
        extract($params);
        $ar=array(
            'index'=>array(
                "title"=>'首页',
                "img"=>"/phone/public/images/wechat/v5/home_g.png",
                "check_img"=>"/phone/public/images/wechat/v5/home.png",
                "url"=>"/phone",
                'checked'=>$curnav=='index'?true:false,
            ),
            'cate'=>array(
                "title"=>'分类',
                "check_img"=>"/phone/public/images/wechat/v5/class.png",
                "img"=>"/phone/public/images/wechat/v5/class_g.png",
                "url"=>"/phone/linecate/index",
                'checked'=>$curnav=='cate'?true:false,
            ),
            'notes'=>array(
                "title"=>'游记',
                "check_img"=>"/phone/public/images/wechat/v5/icon_write_click.png",
                "img"=>"/phone/public/images/wechat/v5/article_g3.png",
                "url"=>"/phone/notes/index",
                'checked'=>$curnav=='notes'?true:false,
            ),
            'flop'=>array(
                "title"=>'自选',
                "img"=>"/phone/public/images/wechat/v5/fanpai_g.png",
                "check_img"=>"/phone/public/images/wechat/v5/fanpai.png",
                "url"=>"/phone/flop/index",
                'checked'=>$curnav=='flop'?true:false,
            ),
            'my'=>array(
                "title"=>'我的',
                "check_img"=>"/phone/public/images/wechat/v5/my.png",
                "img"=>"/phone/public/images/wechat/v5/my_g.png",
                "url"=>"/phone/member/order/list",
                'checked'=>$curnav=='my'?true:false,
            )
        );
        return $ar;
    }

} 