<?php

/**
 * 公共静态类模块
 * User: Netman
 * Date: 15-09-12
 * Time: 下午14:06
 */
class Common
{


    /**
     *  获取编辑器
     *
     * @access    public
     * @param     string $fname 表单名称
     * @param     string $fvalue 表单值
     * @param     string $nheight 内容高度
     * @param     string $etype 编辑器类型
     * @param     string $gtype 获取值类型
     * @param     string $isfullpage 是否全屏
     * @return    string
     */
    public static function get_editor($fname, $fvalue, $nwidth = "700", $nheight = "350", $etype = "Sline", $ptype = '', $gtype = "print", $jsEditor = false)
    {

        require(APPPATH . '/vendor/slineeditor/ueditor.php');

        $UEditor = new UEditor();
        $UEditor->basePath = $GLOBALS['cfg_cmspath'] . '/application/vendor/slineeditor/';
        $nheight = $nheight == 400 ? 300 : $nheight;
        $config = $events = array();
        $GLOBALS['tools'] = empty($toolbar[$etype]) ? $GLOBALS['tools'] : $toolbar[$etype];
        $config['toolbars'] = $GLOBALS['tools'];
        $config['minFrameHeight'] = $nheight;
        $config['initialFrameHeight'] = $nheight;
        $config['initialFrameWidth'] = $nwidth;
        $config['autoHeightEnabled'] = false;
        if (!$jsEditor)
        {
            $code = $UEditor->editor($fname, $fvalue, $config, $events);
        } else
        {
            $code = $UEditor->jseditor($fname, $fvalue, $config, $events);
        }

        if ($gtype == "print")
        {
            echo $code;
        } else
        {
            return $code;
        }

    }

    /**
     * @param $filelist 要加载的js文件列表
     * @param bool $minjs 是否合并js文件
     * @param bool $default 是否从默认目录加载
     * @return string
     * @desc,加载js文件
     */
    public static function js($filelist, $minjs = false, $default = true)
    {
        $filearr = explode(',', $filelist);
        $jsArr = array();
        $out = $v = '';
        foreach ($filearr as $file)
        {
            if ($default == true)
            {
                if (strpos($GLOBALS['cfg_default_templet'], 'default') === false)
                {
                    $tfile = DOCROOT . '/public/' . trim($GLOBALS['cfg_default_templet'], '\../') . '/js/' . $file;
                    if (file_exists($tfile))
                    {
                        $file = "/public/" . trim($GLOBALS['cfg_default_templet'], '\../') . "/js/{$file}";
                    } else
                    {
                        $tfile = DOCROOT . "/public/js/" . $file;
                        $file = "/public/js/{$file}";
                    }
                } else
                {
                    $tfile = DOCROOT . "/public/js/" . $file;
                    $file = '/public/js/' . $file;
                }

            } else
            {
                $tfile = DOCROOT . $file;

            }

//            if (file_exists($tfile))
//            {
                $jsArr[] = $file;
//            }


        }
        if ($jsArr)
        {
            //如果开启自动合并js
            if ($minjs)
            {
                $f = implode(',', $jsArr);
                $jsUrl = URL::site('pub/js?file=' . $f);
                $out = '<script type="text/javascript"src="' . $jsUrl . '"></script>' . "\r\n";
            } else
            {
                foreach ($jsArr as $js)
                {
                    $out .= HTML::script($js) . "\r\n";
                }
            }

        }
        return $out;

    }


    /**
     * @param $filelist  加载的css文件列表
     * @param bool $mincss 是否合并生成.
     * @param bool $default 是否从默认css目录加载,如果值为false,则直接从根目录加载相应文件,即DOCROOT+文件名
     * @return
     * @desc 加载css文件.
     */
    public static function css($filelist, $mincss = false, $default = true)
    {
        $filearr = explode(',', $filelist);
        $filelist = array();
        $out = '';

        foreach ($filearr as $file)
        {
            if ($default == true)
            {

                if (strpos($GLOBALS['cfg_default_templet'], 'default') === false)
                {
                    $tfile = DOCROOT . "/public/" . trim($GLOBALS['cfg_default_templet'], '\../') . "/css/" . $file;
                    if (file_exists($tfile))
                    {
                        $file = "/public/" . trim($GLOBALS['cfg_default_templet'], '\../') . "/css/{$file}";
                    } else
                    {
                        $tfile = DOCROOT . "/public/css/" . $file;
                        $file = "/public/css/{$file}";
                    }
                } else
                {
                    $tfile = DOCROOT . "/public/css/" . $file;
                    $file = "/public/css/{$file}";
                }
            } else
            {
                $tfile = DOCROOT . $file;
            }
//            if (file_exists($tfile))
//            {
                $filelist[] = $file;
//            }
        }
        if (!empty($filelist))
        {
            //如果开启css合并,此项是默认开启的.
            if ($mincss)
            {
                $f = implode(',', $filelist);
                $cssUrl = URL::site('pub/css?file=' . $f);
                $out = '<link type="text/css" href="' . $cssUrl . '" rel="stylesheet"  />' . "\r\n";
            } else
            {
                foreach ($filelist as $css)
                {
                    $out .= HTML::style($css) . "\r\n";
                }
            }

        }
        return $out;
    }

    /*
     * 获取配置文件值
     * */
    public static function get_config($group)
    {
        return Kohana::$config->load($group);
    }

    /*
     * 清空数组里的空值
     * */

    public static function remove_arr_empty($arr)
    {

        $newarr = array_diff($arr, array(null, 'null', '', ' '));
        return $newarr;

    }

    /*
     * 生成缩略图
     *
     * */
    public static function thumb($srcfile, $savepath, $w, $h)
    {
        Image::factory($srcfile)->resize($w, $h, Image::WIDTH)->save($savepath);
        return $savepath;
    }

    /*
     * 时间转换函数
     * */
    public static function mydate($format, $timest)
    {
        $addtime = 8 * 3600;
        if (empty($format))
        {
            $format = 'Y-m-d H:i:s';
        }
        return gmdate($format, $timest + $addtime);
    }


    /*
    * 获取文件扩展名
    * */
    public static function get_extension($file)
    {
        return end(explode('.', $file));
    }

    /*
     * 级联删除文件夹
     */
    public static function rrmdir($dir)
    {
        if (is_dir($dir))
        {
            $objects = scandir($dir);
            foreach ($objects as $object)
            {
                if ($object != "." && $object != "..")
                {
                    if (filetype($dir . "/" . $object) == "dir")
                        self::rrmdir($dir . "/" . $object);
                    else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }

    }

    /*
     * 保存文件
     * */
    public static function save_file($file, $content)
    {

        $fp = fopen($file, "wb");
        flock($fp, 3);
        //@flock($this->open,3);
        $result = fwrite($fp, $content);
        fclose($fp);
        return $result;
    }

    //检查一个串是否存在在某个串中
    public static function check_instr($str, $substr)
    {

        $tmparray = explode($substr, $str);
        if (count($tmparray) > 1)
        {
            return true;
        } else
        {
            return false;
        }
    }

    /*
     * curl http访问
     * */
    public static function http($url, $method = 'get', $postfields = '')
    {

        $ci = curl_init();

        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);

        if ($method == 'POST')
        {
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if ($postfields != '')
                curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);
        curl_close($ci);
        return $response;

    }

    /*
     * 对象转数组
     * */

    public static function object_to_array($array)
    {
        if (is_object($array))
        {
            $array = (array)$array;
        }
        if (is_array($array))
        {
            foreach ($array as $key => $value)
            {
                $array[$key] = self::object_to_array($value);
            }
        }
        return $array;
    }

    /**
     *  获取拼音信息
     *
     * @access    public
     * @param     string $str 字符串
     * @param     int $ishead 是否为首字母
     * @param     int $isclose 解析后是否释放资源
     * @return    string
     */
    public static function get_pinyin($str, $ishead = 0, $isclose = 1)
    {
        $str = iconv('utf-8', 'gbk//ignore', $str);
        $restr = '';
        $str = trim($str);
        $slen = strlen($str);
        if ($slen < 2)
        {
            return $str;
        }

        if (count(self::$pinyin) == 0)
        {
            $fp = fopen(APPPATH . '/vendor/pinyin/pinyin.dat', 'r');
            while (!feof($fp))
            {
                $line = trim(fgets($fp));
                self::$pinyin[$line[0] . $line[1]] = substr($line, 3, strlen($line) - 3);
            }
            fclose($fp);
        }
        for ($i = 0; $i < $slen; $i++)
        {
            if (ord($str[$i]) > 0x80)
            {
                $c = $str[$i] . $str[$i + 1];
                $i++;
                if (isset(self::$pinyin[$c]))
                {
                    if ($ishead == 0)
                    {
                        $restr .= self::$pinyin[$c];
                    } else
                    {
                        $restr .= self::$pinyin[$c][0];
                    }
                } else
                {
                    $restr .= "_";
                }
            } else if (preg_match("/[a-z0-9]/i", $str[$i]))
            {
                $restr .= $str[$i];
            } else
            {
                $restr .= "_";
            }
        }
        if ($isclose == 0)
        {
            unset(self::$pinyin);
        }
        $sheng = "/.*sheng.*/";
        $shi = "/.*shi.*/";
        $qu = "/.*qu.*/";
        if (preg_match($sheng, $restr, $matches))
        {
            $restr = str_replace('sheng', '', $matches[0]);
        }
        if (preg_match($shi, $restr, $matches))
        {
            $restr = str_replace('shi', '', $matches[0]);
        }
        if (preg_match($qu, $restr, $matches))
        {
            $restr = str_replace('qu', '', $matches[0]);
        }
        return $restr;
    }

    /*
     * decode加密/解密算法
     * */

    public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;

        $key = md5($key ? $key : 'stourweb');
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++)
        {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++)
        {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++)
        {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE')
        {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16))
            {
                return substr($result, 26);
            } else
            {
                return '';
            }
        } else
        {
            return $keyc . str_replace('=', '', base64_encode($result));
        }

    }


    //表字段操作(添加)
    public static function add_field($table, $fieldname, $fieldtype, $isunique, $comment)
    {
        $fieldname = 'e_' . $fieldname;
        $sql = "ALTER TABLE `{$table}` ADD COLUMN `{$fieldname}` {$fieldtype} NULL DEFAULT NULL COMMENT '$comment'";
        $sql .= $isunique == 1 ? ",ADD unique('{$fieldname}');" : '';
        return DB::query(1, $sql)->execute();
    }

    /*
     * 表字段操作(删除)
     * */
    public static function del_field($table, $fieldname)
    {
        $sql = "ALTER TABLE `{$table}` DROP COLUMN `{$fieldname}`";
        DB::query(1, $sql)->execute();
    }

    //获取时间范围
    /*
     * 1:今日
     * 2:昨日
     * 3:本周
     * 4:上周
     * 5:本月
     * 6:上月
     * */
    public function get_timerange($type)
    {
        switch ($type)
        {
            case 1:
                $starttime = strtotime(date('Y-m-d 00:00:00'));
                $endtime = strtotime(date('Y-m-d 23:59:59'));
                break;
            case 2:
                $starttime = strtotime(date('Y-m-d 00:00:00', strtotime('-1 day')));
                $endtime = strtotime(date('Y-m-d 23:59:59', strtotime('-1 day')));
                break;
            case 3:
                $starttime = mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"));;
                $endtime = time();
                break;
            case 4:
                $starttime = strtotime(date('Y-m-d 00:00:00', strtotime('last Sunday')));
                $endtime = strtotime(date('Y-m-d H:i:s', strtotime('last Sunday') + 7 * 24 * 3600 - 1));
                break;
            case 5:
                $starttime = strtotime(date('Y-m-01 00:00:00', time()));
                $endtime = time();
                break;
            case 6:
                $starttime = strtotime(date('Y-m-01 00:00:00', strtotime('-1 month')));
                $endtime = strtotime(date('Y-m-31 23:59:00', strtotime('-1 month')));
                break;


        }
        $out = array($starttime, $endtime);
        return $out;

    }

    /*
     * xml转数组
     * */
    public static function xml_to_array($xml)
    {
        $array = (array)(simplexml_load_string($xml));
        foreach ($array as $key => $item)
        {
            $array[$key] = self::struct_to_array((array)$item);
        }
        return $array;
    }

    /*
     * 结构转数组
     * */
    public static function struct_to_array($item)
    {
        if (!is_string($item))
        {
            $item = (array)$item;
            foreach ($item as $key => $val)
            {
                $item[$key] = self::struct_to_array($val);
            }
        }
        return $item;
    }

    /*
     * 去除xss全局函数,所有输入参数都要调用这个参数.
     * */
    public static function remove_xss($param)
    {
        require_once Kohana::find_file('vendor', 'htmlpurifier/library/HTMLPurifier.auto');
        $purifier = new HTMLPurifier();
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8'); //字符编码（常设）
        //如果参数是数组
        if (is_array($param))
        {
            foreach ($param as &$value)
            {
                if (is_array($value))
                {
                    $value = $purifier->purifyArray($value);
                } else
                {
                    $value = $purifier->purify($value);
                }
            }
            $out = $param;

        } else
        {
            $out = $purifier->purify($param);
        }

        return $out;
    }

    // 写入系统缓存
    public static function cache_config()
    {
        $file = APPPATH . '/cache/config.php';
        //缓存文件不存在
        if (!file_exists($file))
        {
            $data = Model_Sysconfig::config();
            $config = array();
            foreach ($data as $v)
            {
                $config[$v['varname']] = trim($v['value']);
            }
            if (!isset($config['cfg_m_img_url']))
            {
                $config['cfg_m_img_url'] = $config['cfg_m_main_url'];
            }
            $config['cfg_m_logo'] = $config['cfg_m_img_url'] . $config['cfg_m_logo'];
            file_put_contents($file, '<?php defined(\'SYSPATH\') or die(\'No direct script access.\');' . PHP_EOL . 'return ' . var_export($config, true) . ';');
        }
        $data = require_once($file);
        return $data;
    }

    /*
     * 生成站点列表
     * */
    public static function cache_web_list()
    {
        Model_Destinations::gen_web_list();
    }

    // 发送邮件
    public static function send_email($maillto, $title, $content)
    {
        //如果没有自定义SMTP配置
        if ($GLOBALS['cfg_mail_smtp'] == '')
        {
            $GLOBALS['cfg_mail_smtp'] = "smtp.163.com";
        }
        if ($GLOBALS['cfg_mail_port'] == '')
        {
            $GLOBALS['cfg_mail_port'] = 25;
        }
        if ($GLOBALS['cfg_mail_user'] == '')
        {
            $GLOBALS['cfg_mail_user'] = "Stourweb@163.com";
            $GLOBALS['cfg_mail_pass'] = "kelly12345";
        }
        //SMTP服务器
        $smtpserver = $GLOBALS['cfg_mail_smtp'];
        //SMTP服务器端口
        $smtpserverport = $GLOBALS['cfg_mail_port'];
        //SMTP服务器的用户邮箱
        $smtpusermail = $GLOBALS['cfg_mail_user'];
        //发送给谁
        $smtpemailto = $maillto;
        //SMTP服务器的用户帐号
        $smtpuser = $GLOBALS['cfg_mail_user'];
        //SMTP服务器的用户密码
        $smtppass = $GLOBALS['cfg_mail_pass'];
        //邮件格式（HTML/TXT）,TXT为文本邮件
        $mailtype = "HTML";
        if ($smtpserverport == 25)
        {
            include_once(VENDORPATH . 'email.class.php');
            //邮件主题
            $mailsubject = iconv('UTF-8', 'GB2312//IGNORE', $title);
            //邮件内容
            $mailbody = iconv('UTF-8', 'GB2312//IGNORE', $content);
            //这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
            //是否显示发送的调试信息
            $smtp->debug = false;
            $status = $smtp->sendmail($smtpemailto, $smtpuser, $mailsubject, $mailbody, $mailtype);
        } else
        {
            include_once(VENDORPATH . 'mysendmail.class.php');
            $mail = new MySendMail();
            //设置smtp服务器，到服务器的SSL连接
            $mail->setServer($smtpserver, $smtpuser, $smtppass, 465, true);
            //设置发件人
            $mail->setFrom($smtpuser);
            //设置收件人，多个收件人，调用多次
            $mail->setReceiver($smtpemailto);
            //设置邮件主题、内容
            $mail->setMail($title, $content);
            //发送
            $status = $mail->sendMail();
        }
        return $status;
    }

    //session 管理
    public static function session($k, $v = '')
    {
        $session = Session::instance();
        if (empty($v))
        {
            $session = is_null($v) ? $session->delete($k) : $session->get($k);
        } else
        {
            $session->set($k, $v);
        }
        return $session;
    }

    //提示信息
    public static function message($msg)
    {
        if (empty($msg['jumpUrl']))
        {
            Request::current()->redirect('/');
        }
        if (empty($msg['message']) && !empty($msg['jumpUrl']))
        {
            header("Location: {$msg['jumpUrl']}");
            exit;
        }
        $javascript = Common::js('jquery.min.js,layer/layer.m.js');
        $html=<<<EOT
        <!DOCTYPE html>
        <html lang="en">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
        <head>
            <meta charset="UTF-8">
            <title>信息提示</title>
            {$javascript}
        </head>
        <body>  
        </body>
        <script type="text/javascript">
         layer.open({
                content: '{$msg["message"]}',
                time: 3,
                end:function(){
                   window.location.href='{$msg["jumpUrl"]}';
                }
            });
        </script>
        </html>
EOT;
        echo $html;
        exit();
    }

    /**
     * @return string
     * @return 无图设置
     */
    public static function nopic()
    {
        return '/phone/public/images/nopicture.png';
    }

    public static function member_nopic()
    {
        return '/phone/public/images/member_nopic.png';
    }

    public static function menu_nopic()
    {
        return '/phone/public/images/menu_no_ico.png';
    }

    /*
     * 缩略图url
     */
    public static function img($src, $width = '', $height = '')
    {
        if (empty($src)) return self::nopic();//无图返回

        if (!empty($width) && !empty($height) && !preg_match('/_\d+X\d+\.(jpg|jpeg|png|gif)$/is', $src))
        {
            $src = preg_replace('/(\.(?:jpg|jpeg|png|gif))$/', "_{$width}x{$height}$1", $src);
        }
        return strpos($src, 'http://') === false ? rtrim($GLOBALS['cfg_m_img_url'], '/') . $src : $src;
    }

    /*
    * 获取某个配置值
    * */

    public static function get_sys_conf($field, $varname, $webid = 0)
    {
        $result = DB::query(Database::SELECT, "select $field from sline_sysconfig where varname='$varname' and webid=$webid")->execute()->as_array();
        return $result[0][$field];
    }

    public static function get_sys_para($varname)
    {
        return self::get_sys_conf('value', $varname, 0);
    }


    //分析当前域名,返回主域名
    /**
     * @return string
     * @desc 如www.lvyou.com 返回 lvyou.com
     */
    private static function get_domain()
    {
        $url = $GLOBALS['cfg_basehost'];

        $uarr = explode('.', $url);
        $k = 0;
        $out = '';
        foreach ($uarr as $value)
        {
            $out .= $k != 0 ? $value : '';
            $out .= '.';
            $k++;
        }
        $out = substr($out, 0, strlen($out) - 1);
        return $out;

    }

    /*
    * 获取主站prefix
    * */
    public static function get_main_prefix()
    {

        $sql = "SELECT webprefix FROM `sline_weblist` WHERE webid=0";
        $row = DB::query(1, $sql)->execute()->as_array();
        return $row[0]['webprefix'] ? $row[0]['webprefix'] : 'www';
    }

    /**
     * @param $webid
     * @return string
     * @desc 根据webid获取产品的url绝对地址
     */
    public static function get_web_url($webid=0)
    {
        $domain = self::get_domain();//顶级域名
        //如果webid不为0,则读取站点的信息
        if ($webid != 0)
        {
            $prefix = ORM::factory('destinations', $webid)->get('webprefix');
        } else
        {
            $prefix = self::get_main_prefix();
        }
        $url = isset($GLOBALS['cfg_phone_cmspath']{1}) ? 'http://' . $prefix . $domain . $GLOBALS['cfg_phone_cmspath'] : $GLOBALS['cfg_basehost'];
        return $url;
    }

    public static function cutstr_html($string, $sublen)
    {
        $string = strip_tags($string);

        $string = preg_replace('/\n/is', '', $string);

        $string = preg_replace('/ |　/is', '', $string);

        $string = preg_replace('/&nbsp;/is', '', $string);

        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);

        if (count($t_string[0]) - 0 > $sublen) $string = join('', array_slice($t_string[0], 0, $sublen)) . "…";

        else $string = join('', array_slice($t_string[0], 0, $sublen));

        return $string;

    }

    public static function  GetIP()
    {
        static $realip = NULL;
        if ($realip !== NULL)
        {
            return $realip;
        }
        if (isset($_SERVER))
        {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第x个非unknown的有效IP字符? */
                foreach ($arr as $ip)
                {
                    $ip = trim($ip);
                    if ($ip != 'unknown')
                    {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else
            {
                if (isset($_SERVER['REMOTE_ADDR']))
                {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else
                {
                    $realip = '0.0.0.0';
                }
            }
        } else
        {
            if (getenv('HTTP_X_FORWARDED_FOR'))
            {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP'))
            {
                $realip = getenv('HTTP_CLIENT_IP');
            } else
            {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return $realip;
    }

    //跳转404页面
    public static function head404()
    {
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        //header("Location: ".$GLOBALS['cfg_basehost']."/404.php");
        echo "<script>window.location.href='/phone/pub/404'</script>";
        exit;

    }

//跳转301
    public static function head301($url)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
        exit();

    }

    //跳转302
    public static function head302($url)
    {
        header("Location: $url");
        exit();

    }

    /**
     * 主站域名
     * @return string
     */
    static function get_main_host()
    {
        $host = '';
        $sql = "select weburl from sline_weblist where webid=0";
        $arr = DB::query(Database::SELECT, $sql)->execute()->current();
        if (!empty($arr))
        {
            $host = $arr['weburl'];
        }
        return $host;
    }
    /**
     * COOKIE 域名
     * @return string
     */
    static function cookie_domain()
    {
        $host = $_SERVER['HTTP_HOST'];
        $sql = "select * from sline_weblist where webid=0";
        $arr = DB::query(Database::SELECT, $sql)->execute()->current();
        if(!empty($arr)){
            $host=str_replace($arr['webprefix']. '.', '', parse_url($arr['weburl'], PHP_URL_HOST));
        }
        return $host;
    }
    /**
     * 支付表单数据提交
     * @param $data
     * @return string
     */
    static function payment_from($data)
    {
        if (!is_array($data) && empty($data) && !isset($data['ordersn']))
        {
            return false;
        }
        $url = self::get_main_host() . '/payment/';
        $html = "<form action='{$url}' style='display:none;' method='post' id='payment'>";
        foreach ($data as $name => $v)
        {
            $html .= "<input type='text' name='{$name}' value='{$v}'>";
        }
        $html .= '</form>';
        $html .= "<script>document.forms['payment'].submit();</script>";
        return $html;
    }

    /**
     * @param $text
     * 生成二维码
     */
    public static function qrcode($text)
    {
        if(!class_exists('QRcode'))
        {
            include Kohana::find_file('vendor',"phpqrcode/phpqrcode");
        }
        $errorCorrectionLevel = "L";
        $matrixPointSize = 8;
        QRcode::png($text, false, $errorCorrectionLevel, $matrixPointSize);
    }


    public static function dd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit();
    }

    public static function debug(){
        ini_set("display_errors", "On");
        error_reporting(E_ALL ^ E_NOTICE);

    }

    public static function array_get($array, $key, $default = null){
        if (! is_array($array)) {
            return $default;
        }

        if (is_null($key)) {
            return $array;
        }

        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) &&  isset($array[$segment])) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }
        return $array;
    }

    public static function date_text_week($time){
        if ($time){
            $a=date('w',$time);
            switch ($a){
                case 0:
                    $text='周日';
                    break;
                case 1:
                    $text='周一';
                    break;
                case 2:
                    $text='周二';
                    break;
                case 3:
                    $text='周三';
                    break;
                case 4:
                    $text='周四';
                    break;
                case 5:
                    $text='周五';
                    break;
                case 6:
                    $text='周六';
                    break;
                default:
                    $text='';
            }
            return $text;
        }
    }

    public static function date_text_state($person_count,$mini_person_count,$sell_num){
        $status=self::_date_text_state($person_count,$mini_person_count,$sell_num);
        switch ($status){
            case 2:
                $s='已成行';
                break;
            case 3:
                $s='已满员';
                break;
            default:
                $s='报名中';
        }
        return $s;
    }

    /**
     * 1 报名中 2 已成行 3 已满员
     * @param $person_count
     * @param $mini_person_count
     * @param $sell_num
     * @return int
     */
    public static function _date_text_state($person_count,$mini_person_count,$sell_num){
        if ($sell_num && $sell_num>=$person_count){
            return 3;
        }else if ($sell_num && $sell_num>=$mini_person_count && $sell_num<$person_count){
            return 2;
        }else{
            return 1;
        }
    }

    public static function date_text_class($stock,$mini_person_count,$sell_num){
        $status=self::_date_text_state($stock,$mini_person_count,$sell_num);
        switch ($status){
            case 3:
                $s='sf';
                break;
            case 2:
                $s='sa';
                break;
            default:
                $s='sr';
        }
        return $s;
    }


    public static function _detail_url($aid,$suitid=0,$day=0,$webid=0){
        return self::get_web_url($webid) . "/lines/show_{$aid}.html?suitid={$suitid}&day={$day}";
    }

    public static function _flop_url($aid,$webid=0){
        return self::get_web_url($webid) . "/flop/show?aid={$aid}";
    }

    public static function _theme_short(){
        return 1;
    }

    public static function _attr_class(){
        return 45;
    }

    public static function _attr_difficulty(){
        return 84;
    }

    public static function _attr_day(){
        return 91;
    }


    /**
     * TODO 效率
     * @param $person_count
     * @param $mini_person_count
     * @param $lineid
     * @param $suitid
     * @param $day
     * @return array
     */
    public static function line_status($person_count,$mini_person_count,$lineid,$suitid,$day){
        $sell_num=Model_Member_Order::get_suit_sell_num($lineid,Model_Line::TYPE_ID,$suitid,$day);
        return array(
            "name"=>Common::date_text_state($person_count,$mini_person_count,$sell_num),
            "style"=>Common::date_text_class($person_count,$mini_person_count,$sell_num),
            'status'=> Common::_date_text_state($person_count,$mini_person_count,$sell_num)
        );
    }


    public static function line_hiker($member){
        return array(
            'hikerId'=>$member['mid'],
            'nickname'=>$member['nickname'],
            'headImgUrl'=>$member['litpic'] ? $member['litpic'] : Common::member_nopic(),
            "sex"=> $member['sex'],
        );
    }


    public static function difficulty_list(){
        return array(
            1=>'轻松徒步',
            2=>'休闲难度',
            3=>'中等难度',
            4=>'较高难度',
            5=>'稀有难度',
        );
    }

    public static function difficulty_text($level){
        return Arr::get(self::difficulty_list(),$level,'');
    }

    public static function difficulty_graphics($level){
        $str='';
        for ($i=1;$i<=$level;$i++)
        {
            $str.='★';
        }
        return $str;
    }

    public static function difficulty_desc($level){
        return self::difficulty_graphics($level).self::difficulty_text($level);
    }

    public static function member_pic($pic){
        return $pic?$pic:self::member_nopic();
    }

    public static function price($price){
        if ($price){
            return Currency_Tool::symbol().$price;
        }

    }


    public static function get_birth_by_car($cardno){
        if ($cardno){
            return strlen($cardno)==15 ? ('19' . substr($cardno, 6, 6)) : substr($cardno, 6, 8);
        }
    }

    /**
     * @param $cardno
     * @return int  1 男 0 女
     */
    public static function get_sex_by_car($cardno){
        if ($cardno){
            $sexint = (int)substr($cardno,16,1);
            return $sexint % 2 === 0 ? 0 :1;
        }
    }


    public static function get_offset($page,$pagesize){
        $page = $page ? $page : 1;
        return ($page - 1) * $pagesize;
    }

    public static function url($str){
        if ($str){
            return self::get_web_url(0) . "/{$str}";

        }
    }

    public static function init_mall_cart(){
        $member_cart=Common::session('member_cart');
        if (empty($member_cart)){
            Common::session('member_cart',new Cart());
            $member_cart=Common::session('member_cart');
        }
        return $member_cart;
    }

    public static function auto_wechat_login(){
//       Common::session('is_login_action',null);
//       Common::session('member',null);
//       Common::dd(123);
//       $member = Common::session('member');
//       if (empty($member)){
//           //模拟登陆
//           $user = 'lin20080369@126.com';
//           $pwd = '123456';
//
//           $member = Model_Member::member_find($user, $pwd);
//           if ($member){
//               Model_Member::write_session($member, $user);
//           }
//       }
//        $member = Common::session('member');
//        $is_login_action = Common::session('is_login_action');
//        if (empty($member) && empty($is_login_action)){
//            Common::session('is_login_action',true);
//            header("Location: /phone/member/login/weixin");
//            exit;
//        }
    }


    public static function day_time(){
        return strtotime(date('Y-m-d'));
    }


    public static  function check_login($member=array()){
        if (empty($member)){
            $member=Common::session('member');
        }
        if (empty($member))
        {
            $javascript = Common::js('jquery.min.js,layer/layer.m.js');
            $html=<<<EOT
        <!DOCTYPE html>
        <html lang="en">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
        <head>
            <meta charset="UTF-8">
            <title>登陆中...</title>
            {$javascript}
        </head>
        <body>  
        </body>
        <script type="text/javascript">
         window.location.href='/phone/member/login';
        </script>
        </html>
EOT;
            echo $html;
            exit();
        }
    }


    //二维数组排序
    public static function u_array_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
        if(is_array($arrays)){
            foreach ($arrays as $array){

                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key];
                }else if(is_object($array)){
                    $key_arrays[] = $array->$sort_key;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
        return $arrays;
    }


    /**
     * 会员等级
     * @param $memberId
     * @param array $param
     * @return array|int|string
     */
    static function member_rank($memberId, $param = array())
    {
        $data=null;
        $curRank=1;
        $rankName='';
        //$member = DB::select('jifen')->from('member')->where("mid={$memberId}")->execute()->current();
        $member=DB::query(1,'select sum(jifen) as jifen from sline_member_jifen_log where type=2 AND memberid='.$memberId)->execute()->current();
        $rank = self::member_grade();
        foreach ($rank as $k => $v)
        {
            $curRank = ++$k;
            $rankName = $v['name'];
            if (!$member['jifen'] or $member['jifen'] >= $v['begin'] && $member['jifen'] <= $v['end'])
            {
                break;
            }
        }
        //组合返回数据
        if (isset($param['return']))
        {
            switch ($param['return'])
            {
                case 'current':
                    $data = 'Lv.' . $curRank;
                    break;
                case 'name':
                    $data = $rankName;
                     break;
                default:
                    $data = $rankName;
            }
        }
        return $data;
    }

    /**
     * 将会员等级以升序保存
     * @return mixed
     */
    static function member_grade()
    {
        static $grade = null;
        if (is_null($grade))
        {
            $grade = DB::select()->from('member_grade')->order_by('begin', 'asc')->execute()->as_array();
        }
        return $grade;
    }

    //格式化线路按某一日期格式化
    public static function formatActivity($data){
        if ($data){
            $data['startcity_id'] = $data['startcity'];
            $data['startcity'] = Model_Startplace::start_city($data['startcity']);
            $data['commentnum'] = Model_Comment::get_comment_num($data['id'],1); //评论次数
            $data['stars'] = Model_Comment::get_stars($data['id'], 1);//满意度
            $data['sellnum'] = Model_Member_Order::get_sell_num($data['id'],1)+intval($data['bookcount']); //销售数量
            $data['url'] = Common::_detail_url($data['aid'],$data['suitid'],$data['day']);
            $data['index_litpic'] = Common::img($data['index_litpic']);
            $data['litpic'] = Common::img($data['litpic']);
            $data['title'] = Common::cutstr_html($data['title'], 40);
        }
        return $data;
    }

    //格式化线路按某一日期格式化
    public static function formatActivitys($data){
        if ($data){
            foreach($data as $k=>$v)
            {
                $data[$k]=Common::formatActivity($v);
            }
        }
        return $data;
    }


    public static function loadWeChatJSSDK(){
        if(!class_exists('JSSDK'))
        {
            include Kohana::find_file('vendor',"jssdk/jssdk");
        }
    }

    public static function loadWeChatTemplate(){
        if(!class_exists('TemplateMessage'))
        {
            include Kohana::find_file('vendor',"wechat/TemplateMessage");
        }
    }


    public static function getJSSDKParam(){
        $appid = $GLOBALS['cfg_wxpay_appid'];
        $appkey = $GLOBALS['cfg_wxpay_appsecret'];
        self::loadWeChatJSSDK();
        $jssdk = new JSSDK($appid, $appkey);
        $signPackage = $jssdk->GetSignPackage();
        return $signPackage;
    }

    public static function isWeChat(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }

    public static function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public static function echoJson($list){
        echo json_encode($list);exit();
    }

    public static function videoScreenshot($target_file,$target_img_file,$time="00:00:03"){
        if (file_exists($target_file)){
            $s="ffmpeg -y -i {$target_file}  -ss {$time}  -vframes 1 {$target_img_file} ";
            //ffmpeg -y -i  /www/qiezi/uploads/notes/videos/5d3bb9610cb6e1564195106643.mp4  -ss 00:00:03 -vframes 1 /www/qiezi/uploads/notes/videos_image/5d3bba5a302d9.jpg
            exec($s." 2>&1",$output, $return_val);
            return $output;
        }

    }

    public static function isDeadLine($day,$linebefore){
        $deadLine=self::getDeadLine($day,$linebefore);
        if($deadLine && time()>$deadLine){
            return true;
        }
        return false;
    }

    public static function getDeadLine($day,$linebefore){
        $deadLine=null;
        if($day && $linebefore){
            $deadLine=$day+$linebefore*24*60*60;
        }
        return $deadLine;
    }











}
