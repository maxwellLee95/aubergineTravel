<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Line
 * 线路控制器
 */
class Controller_Test extends Stourweb_Controller
{

    /**
     * 线路首页
     */
    public function action_index()
    {

        $s=Common::videoScreenshot(
            "/www/qiezi/uploads/notes/videos/5c73dded02c5803927066-DDFB-4016-92AA-14FD5A09DAA8.MP4",
            "/www/qiezi/uploads/notes/videos_image/5c73dded02c5803927066-DDFB-4016-92AA-14FD5A09DAA8.jpg");
//        Model_Msg::msgOrderRefund('0103023115','用户申请退款，后台审核通过');
    }



}