<?php

/**
 * 产品操作公共静态类
 * User: Netman
 * Date: 15-9-23
 * Time: 下午1:48
 */
class Product
{
    /**
     * 产品详情页中提取seo
     * @param $arr
     * @return array
     */
    public static function seo($arr)
    {
        $seoArr = array(
            'seotitle' => empty($arr['seotitle']) ? $arr['title'] : $arr['seotitle'],
            'keyword' => $arr['keyword'],
            'description' => $arr['description']
        );
        foreach ($seoArr as &$v)
        {
            $v = trim($v);
        }
        return $seoArr;
    }

    /**
     * 产品图片
     * @param $picStr
     * @return array
     */
    public static function pic_list($picStr)
    {
        if (empty($picStr))
        {
            return;
        }
        $arr = explode(',', $picStr);
        foreach ($arr as &$v)
        {
            $v = explode('||', $v);
        }
        return $arr;
    }

    /**
     * 产品编号 共6位,不足6位前面被0
     * @param $id
     * @param $prefixId
     * @return string
     */
    public static function product_number($id, $prefixId)
    {
        $arr = array(
            'A' => '01',
            'B' => '02',
            'C' => '05',
            'D' => '03',
            'E' => '08',
            'G' => '13',
            'H' => '14',
            'I' => '15',
            'J' => '16',
            'K' => '17',
            'L' => '18',
            'M' => '19',
            'N' => '20',
            'O' => '21',
            'P' => '22',
            'Q' => '23',
            'R' => '24',
            'S' => '25',
            'T' => '26'
        );
        return array_search($prefixId, $arr) . str_pad($id, 5, "0", STR_PAD_LEFT);
    }

    /**
     * 产品内容页去除style 图片如为相对路径加上图片域名
     * @param $str
     * @return mixed
     */
    public static function strip_style($str)
    {
        $str = preg_replace('~\s?style=".*?"~', '', $str);
        $str = preg_replace('~<([^>]*)>(?:\s|&nbsp;)*</\1>~', '', $str);
        $str = preg_replace('~src="[^http](.*?)\.(jpg|gif|png|jpeg)"~', "src=\"{$GLOBALS['cfg_m_img_url']}/\\1_616x0.\\2\"", $str);
        $str = preg_replace('~src="(.*?\.(?:jpg|gif|png|jpeg))"~', "src=\"/public/images/grey.gif\" st-src=\"\\1\"", $str);
        $str = preg_replace(array('~width\s*=\s*([\'"]).*?\1~', '~height\s*=\s*([\'"]).*?\1~'), '', $str);
        return $str;
    }

    /*
     * 属性生成where条件,用于多条件属性搜索.
     * */
    public static function get_attr_where($attrid)
    {
        $str='';
        $arr = Common::remove_arr_empty(explode('_', $attrid));
        foreach ($arr as $value)
        {
            if ($value != 0)
            {
                $str .= " and FIND_IN_SET($value,a.attrid) ";
            }
        }
        return $str;
    }

    public static function get_theme_where($themeid){
        return !empty($themeid)?" AND FIND_IN_SET($themeid,a.themelist) ":'';
    }

    /*
    * 生成订单编号
    * */
    public static function get_ordersn($kind)
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);

        return $kind . date('md') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }


    //添加订单
    public static function add_order($arr)
    {
        $model = ORM::factory('member_order');
        $flag = 0;
        $member = Common::session('member');
        if (is_array($arr) && $member['mid'])
        {
//            //会员查询及自动增加
//            $member = Common::session('member');
//            if (!isset($member['mid']))
//            {
//                $member = Model_Member::member_find($arr['linktel']);
//                if (empty($member))
//                {
//                    $pwd = str_shuffle('abcdefthigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
//                    $pwd = substr($pwd, 0, 6);
//                    $member['mobile'] = $arr['linktel'];
//                    $member['pwd'] = md5($pwd);
//                    $member_result = Model_Member::register($member);
//                    if (!is_array($member_result))
//                    {
//                        return false;
//                    }
//                    $member['mid'] = $member_result[0];
//                    //发送短信
//                    $content = "尊敬的用户{$arr['linktel']}你好,你已经成功注册成为{$GLOBALS['cfg_webname']}会员,你的账号是:{$arr['linktel']},密码是:{$pwd},为了你的帐户安全,请尽快修改密码!";
//                    self::send_msg($arr['linktel'], $GLOBALS['cfg_webname'], $content);
//                }
//                //写入session
//                Model_Member::write_session($member);
//            }
            //订单会员ID
            $arr['memberid'] = $member['mid'];
            //二次确认
            if ($arr['paytype'] == '3')//这里补充一个当为二次确认时,修改订单为未处理状态.
            {
                $arr['status'] = 0;
            }
            //学分抵现
            if ($arr['usejifen'] == 1)
            {
                $needjifen = $GLOBALS['cfg_exchange_jifen'] * $arr['jifentprice'];
                $t_msg='预订产品' . $arr['productname'] . '学分抵现消费学分' . $needjifen;
                $flag=self::operateIntegral($arr['memberid'],$needjifen,$t_msg,Model_Member_Jifen_Log::TYPE_USE);
                   if (!$flag){
                       $arr['usejifen'] = 0;
                   }
            }

            $supplierlist = Model_Model::get_product_bymodel($arr['typeid'], $arr['productautoid'], 'supplierlist');
            if ($supplierlist != null)
            {
                $arr['supplierlist'] = $supplierlist[0]['supplierlist'];
            }

            foreach ($arr as $k => $v)
            {
                $model->$k = $v;
            }
            if ($arr['typeid'] == 2)
            {
                $arr['pid'] = 0;
            }
            $mainid = $model->save();
            /*if ($arr['typeid'] == 2)
            {
                $arr['ordersn'] = self::get_ordersn('02');
                $arr['pid'] = $mainid;
                $m = ORM::factory('member_order');
                foreach ($arr as $k => $v)
                {
                    $m->$k = $v;
                }
                $m->save();
            }*/
            $flag = $model->saved();

            if ($flag)
            {

                //减库存
                $dingnum = intval($arr['dingnum']) + intval($arr['childnum']) + intval($arr['oldnum']);
                if ($arr['typeid'] != 2)
                {
                    self::minus_storage($arr['usedate'], $arr['typeid'], $arr['suitid'], $arr['productid'], $dingnum);
                } else
                {
                    self::minus_storage($arr['usedate'], $arr['typeid'], $arr['suitid'], $arr['productid'], $dingnum, $arr['departdate']);
                }

                $memberinfo = Model_Member::get_member_byid($arr['memberid']);
                $mobile = $memberinfo['mobile'];
                $prefix = !empty($memberinfo['nickname']) ? $memberinfo['nickname'] : $memberinfo['mobile'];
                $orderAmount = self::calculate_price($model->as_array());
                if ($arr['paytype'] == '3') //二次确认支付
                {
                    /*
                    $msgInfo = self::get_define_msg($arr['typeid'], 1);
                    if ($msgInfo['isopen'] == 1) //等待客服处理短信
                    {
                        $content = $msgInfo['msg'];
                        $content = str_replace('{#MEMBERNAME#}', $memberinfo['nickname'], $content);
                        $content = str_replace('{#PRODUCTNAME#}', $arr['productname'], $content);
                        $content = str_replace('{#PRICE#}', $orderAmount['priceDescript'], $content);
                        $content = str_replace('{#NUMBER#}', $orderAmount['numberDescript'], $content);
                        $content = str_replace('{#TOTALPRICE#}', $orderAmount['totalPrice'], $content);
                        $content = str_replace('{#ORDERSN#}', $arr['ordersn'], $content);
                        self::send_msg($mobile, $prefix, $content);//发送短信.
                    }
                    $emailInfo = self::get_email_msg($arr['typeid'], 1);
                    if ($emailInfo['isopen'] == 1 && $memberinfo['email'])
                    {
                        $title = "预定" . $arr['productname'] . '[' . $GLOBALS['cfg_webname'] . ']';
                        $content = $emailInfo['msg'];
                        $content = str_replace('{#MEMBERNAME#}', $memberinfo['nickname'], $content);
                        $content = str_replace('{#PRODUCTNAME#}', $arr['productname'], $content);
                        $content = str_replace('{#PRICE#}', $orderAmount['priceDescript'], $content);
                        $content = str_replace('{#NUMBER#}', $orderAmount['numberDescript'], $content);
                        $content = str_replace('{#TOTALPRICE#}', $orderAmount['totalPrice'], $content);
                        $content = str_replace('{#EMAIL#}', $memberinfo['email'], $content);
                        $content = str_replace('{#WEBNAME#}', $GLOBALS['cfg_webname'], $content);
                        self::order_email($memberinfo['email'], $title, $content);
                    }
                     */

                } else //全款支付/订金支付
                {
                    /*
                    $msgInfo = self::get_define_msg($arr['typeid'], 2);
                    if ($msgInfo['isopen'] == 1)
                    {
                        $content = $msgInfo['msg'];
                        $content = str_replace('{#MEMBERNAME#}', $memberinfo['nickname'], $content);
                        $content = str_replace('{#PRODUCTNAME#}', $arr['productname'], $content);
                        $content = str_replace('{#PRICE#}', $orderAmount['priceDescript'], $content);
                        $content = str_replace('{#NUMBER#}', $orderAmount['numberDescript'], $content);
                        $content = str_replace('{#TOTALPRICE#}', $orderAmount['totalPrice'], $content);
                        $content = str_replace('{#ORDERSN#}', $arr['ordersn'], $content);
                        self::send_msg($mobile, $prefix, $content);//发送短信.
                    }
                    $emailInfo = self::get_email_msg($arr['typeid'], 2);
                    if ($emailInfo['isopen'] == 1 && $memberinfo['email'])
                    {
                        $title = "预定" . $arr['productname'] . '[' . $GLOBALS['cfg_webname'] . ']';
                        $content = $emailInfo['msg'];
                        $content = str_replace('{#MEMBERNAME#}', $memberinfo['nickname'], $content);
                        $content = str_replace('{#PRODUCTNAME#}', $arr['productname'], $content);
                        $content = str_replace('{#PRICE#}', $orderAmount['priceDescript'], $content);
                        $content = str_replace('{#NUMBER#}', $orderAmount['numberDescript'], $content);
                        $content = str_replace('{#TOTALPRICE#}', $orderAmount['totalPrice'], $content);
                        $content = str_replace('{#EMAIL#}', $memberinfo['email'], $content);
                        $content = str_replace('{#WEBNAME#}', $GLOBALS['cfg_webname'], $content);
                        self::order_email($memberinfo['email'], $title, $content);
                    }
                    */


                }
                /*
                $cfg_supplier_msg_open = $GLOBALS['cfg_supplier_msg_open'];
                $content = $GLOBALS['cfg_supplier_msg'];

                if ($cfg_supplier_msg_open == 1)
                {

                    $content = str_replace('{#LINKMAN#}', $arr['linkman'], $content);
                    $content = str_replace('{#LINKNAME#}', $arr['linkman'], $content);
                    $content = str_replace('{#PRODUCTNAME#}', $arr['productname'], $content);
                    $content = str_replace('{#PHONE#}', $arr['linktel'], $content);
                    $content = str_replace('{#PRICE#}', $orderAmount['priceDescript'], $content);
                    $content = str_replace('{#NUMBER#}', $orderAmount['numberDescript'], $content);
                    $content = str_replace('{#TOTALPRICE#}', $orderAmount['totalPrice'], $content);
                    $content = str_replace('{#ORDERSN#}', $arr['ordersn'], $content);

                    //本站管理员短信发送
                    $cfg_webmaster_phone = $GLOBALS['cfg_webmaster_phone'];
                    if (!empty($cfg_webmaster_phone))
                    {
                        self::send_msg($cfg_webmaster_phone, $prefix, $content);//发送短信.
                    }

                    if (!empty($cfg_supplier_msg_open))
                    {
                        $supplierphone = self::get_supplier_tel($arr['productautoid'], $arr['typeid']);

                        if (!empty($supplierphone))
                        {
                            self::send_msg($supplierphone, $prefix, $content);//发送短信.
                        }

                    }
                }
                */
                //定义平台
                Common::session('_platform', 'mobile');
            }


        }

        return $flag;


    }


    /*
    * 库存操作
    * */
    public static function minus_storage($dingdate, $typeid, $suitid, $productid, $dingnum, $departdate = '')
    {

        $day = strtotime($dingdate);
        $dingnum = $dingnum ? $dingnum : 1;
        switch ($typeid)
        {
            case '1':

                $sql = "UPDATE `sline_line_suit_price` SET number=number-$dingnum WHERE day='$day' AND suitid='$suitid' AND number!=0";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '2':
                $sdate = strtotime($dingdate);
                $edate = strtotime($departdate);
                $sql = "UPDATE `sline_hotel_room_price` ";
                $sql .= "SET number=number-$dingnum ";
                $sql .= "WHERE suitid='$suitid' AND day>=$sdate AND day<$edate AND number!=0 AND number!=-1";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '3':
                $sql = "UPDATE `sline_car_suit_price` SET number=number-$dingnum WHERE day='$day' AND suitid='$suitid' AND number!=0 and number!=-1";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '5':
                $sql = "UPDATE `sline_spot_ticket` SET number=number-1 WHERE spotid='$productid' AND id='$suitid' AND number!=0 AND number!=-1";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '8':
                $sql = "UPDATE `sline_visa` SET number=number-$dingnum WHERE id='$productid' AND number!=0 AND number!=-1";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '13':
                $sql = "UPDATE `sline_tuan` SET totalnum=totalnum-1 WHERE id='$productid' AND totalnum!=0 AND totalnum!=-1";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
        }

    }

    /**
     * 点击率加一
     * @param $aid
     * @param $typeid
     * @return mixed
     */
    public static function update_click_rate($aid, $typeid)
    {
        switch ($typeid)
        {
            case '1':
                $sql = "UPDATE `sline_line` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '2':
                $sql = "UPDATE `sline_hotel` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '3':
                $sql = "UPDATE `sline_car` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '4':
                $sql = "UPDATE `sline_article` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '5':
                $sql = "UPDATE `sline_spot` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '6':
                $sql = "UPDATE `sline_photo` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '8':
                $sql = "UPDATE `sline_visa` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '11':
                $sql = "UPDATE `sline_jieban` SET shownum=shownum+1 WHERE id='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case '13':
                $sql = "UPDATE `sline_tuan` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case Model_Notes::TYPE_ID:
                $sql = "UPDATE `sline_notes` SET shownum=shownum+1 WHERE id='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
            case Model_Mall::TYPE_ID:
                $sql = "UPDATE `sline_mall` SET shownum=shownum+1 WHERE aid='$aid'";
                DB::query(Database::UPDATE, $sql)->execute();
                break;
        }
    }

    /**
     * 获取消息msg定义
     * @param $msgtype
     * @param int $num
     * @param string $ext
     * @return mixed
     */
    public static function get_define_msg($msgtype, $num = 0, $ext = '')
    {
        if (is_numeric($msgtype))
        {
            $msgtype = self::get_msg_type($msgtype, $num);
        }
        if (!empty($ext))
        {
            $msgtype = $ext;
        }
        $sql = "SELECT * FROM `sline_sms_msg` WHERE msgtype='{$msgtype}'";
        $row = DB::query(1, $sql)->execute()->as_array();
        return $row[0];
    }

    /*
     * 根据typeid生成msgtype
     * @param int $typeid
     * @param int $num ,第几个状态.
     * @return string $msgtype
     * */
    public static function get_msg_type($typeid, $num)
    {
        switch ($typeid)
        {
            case 1:
                $msgtype = 'line_order_msg' . $num;
                break;
            case 2:
                $msgtype = 'hotel_order_msg' . $num;
                break;
            case 3:
                $msgtype = 'car_order_msg' . $num;
                break;
            case 5:
                $msgtype = 'spot_order_msg' . $num;
                break;
            case 8:
                $msgtype = 'visa_order_msg' . $num;
                break;
            case 13:
                $msgtype = 'tuan_order_msg' . $num;
                break;
            default:
                $msgtype = 'reg';
                break;
        }
        return $msgtype;

    }


    /**
     * @param $orderinfo
     * @return array
     */
    public static function calculate_price($orderinfo)
    {
        $result = array(
            'totalNumber' => 0,
            'totalPrice' => 0,
            'numberDescript' => '',
            'priceDescript' => ''
        );

        if (is_array($orderinfo))
        {
            //如果typeid为2,则要计算预订开始与结束日期的总价
            if ($orderinfo['typeid'] == 2)
            {
                $dingnum = $orderinfo['dingnum'];
                $suitid = $orderinfo['suitid'];
                $startdate = $orderinfo['usedate'];
                $leavedate = $orderinfo['departdate'];
                $totalprice = Model_Hotel::suit_range_price($suitid, $startdate, $leavedate, $dingnum);
                $totalprice = $totalprice * $dingnum;

                $result['numberDescript'] = $dingnum;
                $result['totalPrice'] = $totalprice;

            } else
            {

                $totalPrice = $orderinfo['price'] * $orderinfo['dingnum'] + $orderinfo['childnum'] * $orderinfo['childprice'] + $orderinfo['oldnum'] * $orderinfo['oldprice'];
                $result['totalPrice'] = $totalPrice;
                $totalNumber = $orderinfo['dingnum'] + $orderinfo['childnum'] + $orderinfo['oldnum'];
                $result['totalNumber'] = $totalNumber;

                $priceDescript = '';
                $numberDescript = '';
                if (!empty($orderinfo['dingnum']))
                {
                    $priceDescript = $priceDescript . $orderinfo['price'] . '(成)';
                    $numberDescript = $numberDescript . $orderinfo['dingnum'] . '(成)';
                }
                if (!empty($orderinfo['childnum']))
                {
                    $priceDescript = $priceDescript . $orderinfo['childprice'] . '(小)';
                    $numberDescript = $numberDescript . $orderinfo['childnum'] . '(小)';
                }
                if (!empty($orderinfo['oldnum']))
                {
                    $priceDescript = $priceDescript . $orderinfo['oldprice'] . '(老)';
                    $numberDescript = $numberDescript . $orderinfo['oldnum'] . '(老)';
                }
                $result['priceDescript'] = $priceDescript;
                $result['numberDescript'] = $numberDescript;


            }

        }
        return $result;
    }


    /**
     * @param $productid
     * @param $typeid
     * @return string
     * 获取供应商手机号码
     */
    public static function get_supplier_tel($productid, $typeid)
    {


        $channeltable = array(
            "1" => "sline_line",
            "2" => "sline_hotel",
            "3" => "sline_car",
            "4" => "sline_article",
            "5" => "sline_spot",
            "6" => "sline_photo",
            "8" => "sline_visa",
            "10" => "sline_leave",
            "13" => "sline_tuan"
        );
        $table = $channeltable[$typeid];
        $sql = "SELECT supplierlist FROM {$table} where id='$productid'";
        $row = DB::query(1, $sql)->execute()->as_array();
        $supplierid = $row[0]['supplierlist'];
        $sql = "SELECT mobile FROM `sline_supplier` WHERE id='$supplierid'";
        $row = DB::query(1, $sql)->execute()->as_array();
        return $row[0]['mobile'] ? $row[0]['mobile'] : '';


    }

    /*
    * 发送短信方法
    * @param int phone
    * @param string prefix
    * @param string content
    * */
    public static function send_msg($phone, $prefix, $content)
    {
//        include_once(VENDORPATH . '/msg.class.php');
//
//        $prefix = $GLOBALS['cfg_webname'];
//
//        $sms_username = $GLOBALS['cfg_sms_username'];
//        $sms_password = $GLOBALS['cfg_sms_password'];
//        $msg = new Msg($sms_username, $sms_password);
//        $status = $msg->sendMsg($phone, $prefix, $content);
//        $status = json_decode($status);
//        return $status;


    }

    /**
     * @param $msgtype
     * @param $num
     * @return array
     */
    public static function get_email_msg($msgtype, $num)
    {
        //参数为数字则为栏目ID
        if (is_numeric($msgtype))
        {
            $msgtype = self::get_msg_type($msgtype, $num);
        }
        $sql = "SELECT * FROM `sline_email_msg` WHERE msgtype='$msgtype'";
        $ar = DB::query(1, $sql)->execute()->as_array();
        $row = $ar[0] ? $ar[0] : array();
        return $row;
    }

    /**
     * @param $maillto
     * @param $title
     * @param $content
     * @return bool
     * 发送邮件
     */

    public static function order_email($maillto, $title, $content)
    {

        return false;
        //##########################################

        //如果没有自定义SMTP配置
        if ($GLOBALS['cfg_mail_smtp'] == '')
        {
            $GLOBALS['cfg_mail_smtp'] = "smtp.163.com";
        }
        if ($GLOBALS['cfg_mail_port'] == '')
        {
            $GLOBALS['cfg_mail_port'] = 25;
        }
        $smtpserver = $GLOBALS['cfg_mail_smtp'];//SMTP服务器
        $smtpserverport = $GLOBALS['cfg_mail_port'];//SMTP服务器端口
        $smtpusermail = $GLOBALS['cfg_mail_user'];//SMTP服务器的用户邮箱
        $smtpemailto = $maillto;//发送给谁
        $smtpuser = $GLOBALS['cfg_mail_user'];//SMTP服务器的用户帐号
        $smtppass = $GLOBALS['cfg_mail_pass'];//SMTP服务器的用户密码
        $mailtype = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件

        ##########################################

        if ($smtpserverport == 25)
        {
            include_once(VENDORPATH . '/email.class.php');
            $mailsubject = iconv('UTF-8', 'GB2312//IGNORE', $title);//邮件主题
            $mailbody = iconv('UTF-8', 'GB2312//IGNORE', $content);//邮件内容
            $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp->debug = false;//是否显示发送的调试信息
            $status = $smtp->sendmail($smtpemailto, $smtpuser, $mailsubject, $mailbody, $mailtype);
        } else
        {

            include_once(VENDORPATH . '/mysendmail.class.php');
            $mail = new MySendMail();
            $mail->setServer($smtpserver, $smtpuser, $smtppass, 465, true); //设置smtp服务器，到服务器的SSL连接
            $mail->setFrom($smtpuser); //设置发件人
            $mail->setReceiver($smtpemailto); //设置收件人，多个收件人，调用多次
            $mail->setMail($title, $content); //设置邮件主题、内容
            $status = $mail->sendMail(); //发送
        }
        return $status;
    }


    //在线支付公共接口
    /*-
	   $ordersn:订单编号
	   $subject:商品名称
	   $price:总价
	   $showurl:商品url
	-*/

    public static function pay_online($ordersn, $subject, $price, $paytype, $showurl = '', $extra_para = '', $widbody = '')
    {


        if ($paytype == 1) //支付宝
        {
            $showurl = empty($showurl) ? $GLOBALS['cfg_cmspath'] : $showurl;
            $payurl = $GLOBALS['cfg_phone_cmspath'] . '/thirdpay/alipay';

            $html = "<form method='post' action='{$payurl}' name='alipayfrm'>";
            $html .= '<input type="hidden" name="ordersn" value="' . $ordersn . '">';
            $html .= '<input type="hidden" name="subject" value="' . $subject . '">';
            $html .= '<input type="hidden" name="price" value="' . $price . '">';
            $html .= '<input type="hidden" name="widbody" value="' . $widbody . '">';
            $html .= '<input type="hidden" name="showurl" value="' . $showurl . '">';
            $html .= '<input type="hidden" name="extra_common_param" value="' . $extra_para . '">';

            $html .= '</form>';
            $html .= "<script>document.forms['alipayfrm'].submit();</script>";
            return $html;


        } else if ($paytype == 2)  //快钱支付
        {
            $payurl = $GLOBALS['cfg_phone_cmspath'] . '/thirdpay/bill';

            $html = "<form method='post' action='{$payurl}' name='billfrm'>";
            $html .= '<input type="hidden" name="ordersn" value="' . $ordersn . '">';
            $html .= '<input type="hidden" name="subject" value="' . $subject . '">';
            $html .= '<input type="hidden" name="price" value="' . $price . '">';
            $html .= '<input type="hidden" name="showurl" value="' . $showurl . '">';
            $html .= '</form>';
            $html .= "<script>document.forms['billfrm'].submit();</script>";
            return $html;
        } else if ($paytype == 3) //微信支付
        {
            $payurl = $GLOBALS['cfg_phone_cmspath'] . '/thirdpay/weixinpay';
            $html = "<form method='post' action='{$payurl}' name='alipayfrm'>";
            $html .= '<input type="hidden" name="ordersn" value="' . $ordersn . '">';
            $html .= '<input type="hidden" name="subject" value="' . $subject . '">';
            $html .= '<input type="hidden" name="price" value="' . $price . '">';
            $html .= '<input type="hidden" name="widbody" value="' . $widbody . '">';
            $html .= '<input type="hidden" name="showurl" value="' . $showurl . '">';
            $html .= '<input type="hidden" name="extra_common_param" value="' . $extra_para . '">';

            $html .= '</form>';
            $html .= "<script>document.forms['alipayfrm'].submit();</script>";
            return $html;
        }
    }

    /**
     * 列表搜索页格式化
     * @param $data
     * @return mixed|string
     */
    public static function list_search_format($data, $page, $pagesize = 10)
    {
        $result['list'] = $data;
        $result['page'] = count($data) < $pagesize ? -1 : $page + 1;
        return json_encode($result);
    }

    /**
     * @param $ico
     * @return array
     * @desc 获取图标数组
     */
    public static function get_ico_list($ico)
    {
        $arr = array();
        if (!empty($ico))
        {
            $sql = "SELECT picurl FROM `sline_icon` WHERE id IN($ico)";
            $arr = DB::query(1, $sql)->execute()->as_array();
            foreach ($arr as &$r)
            {
                $r['litpic'] = Common::img($r['picurl']);
            }
        }
        return $arr;
    }

    /**
     * 主站域名
     * @return mixed
     */
    public static function get_host_url()
    {
        $sql = "SELECT weburl FROM `sline_weblist` WHERE webid=0 ORDER BY id ASC LIMIT 1";
        $arr = DB::query(1, $sql)->execute()->current();
        return $arr['weburl'];
    }

    //积分操作，TODO 事务
    public static function operateIntegral($memberid,$integral,$content,$type,$action=Model_Member_Jifen_Log::ACTION_OTHER,$param=array()){
        $flag=Model_Member::operate_jifen($memberid, $integral, $type);
        if ($flag){
            Model_Member_Jifen_Log::addLog($memberid, $content, $integral, $type,$action,$param);
            return true;
        }
        return false;
    }

}
