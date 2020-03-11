<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 站点管理类
 * */

class Model_Web {

    /**
     *  新建站点初始化数据
     *
     * @access    public
     * @return
     */
    public static function initData($webid)
    {



        $file=APPPATH.'data/init/childsiteinit.txt';
        $file_handle = fopen($file, "r");
        $query = '';
        while (!feof($file_handle))
        {
            $line = fgets($file_handle,4096);

            if(preg_match("#;#", $line))
            {
                $query .= $line;
                $query = str_replace('{webid}',$webid,$query);
                $query = str_replace('{fenhao}',';',$query);

                DB::query(2,$query)->execute();
                $query='';
            }
            else
            {
                $query .= $line;
            }


        }
        fclose($file_handle);

    }
    /*
     * 清除导航
     * */
    public static function delNav($siteid)
    {
        $sql = "delete from sline_nav where webid='$siteid'";
        DB::query(Database::DELETE,$sql)->execute();
    }
    /*
     * 清除右侧模块
     * */
    public static function delRightModule($siteid)
    {
        $sql = "delete from sline_module_config where webid='$siteid'";
        DB::query(Database::DELETE,$sql)->execute();
    }

    /*
   * 生成站点列表(前台使用)
   * */
    public static function genWeblist()
    {
        $out = array();
        $sql = "select webprefix,id,weburl,kindname from sline_destinations where iswebsite=1 ";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as $row)
        {
            $out[$row['webprefix']]=array(
                'webprefix'=>$row['webprefix'],
                'weburl'=>$row['weburl'],
                'kindname'=>$row['kindname'],
                'webid'=>$row['id']
            );
        }
        $weblist = "<?php \$weblist= ".var_export($out,true).";";
        $webfile = BASEPATH.'/data/weblist.php';
        $fp = fopen($webfile,'wb');
        flock($fp,3);
        fwrite($fp,$weblist);
        fclose($fp);

    }
    /*
     * 生成配置文件
     * */
    public static function createDefaultConfig($siteid)
    {
        $m = new Model_Sysconfig();
        $m->writeConfig($siteid);
    }


    //初始化版本htaccess

    public static function init_version_param()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);

        //4.X版本
        if($configinfo['cfg_pc_version']==0)
        {
            $file=APPPATH.'data/init/htaccess4.1.txt';
            $indexfile = APPPATH.'data/init/index4.1.txt';
            //检测4.x版本是否存在,如果不存在,则退出.
            if(!file_exists(BASEPATH.'/include'))
            {
                return;
            }
        }
        //5.X版本
        elseif($configinfo['cfg_pc_version'] == 5)
        {
            $file = APPPATH.'data/init/htaccess5.1.txt';
            $indexfile = APPPATH.'data/init/index5.1.txt';
            //检测5.x版本是否存在,如果不存在,则退出.
            if(!file_exists(BASEPATH.'/v5'))
            {
                return;
            }
        }

        //读取htaccess配置文件
        $file_handle = fopen($file, "r");
        $content = "";
        while(!feof($file_handle))
        {
            $content.=fgets($file_handle,1024);
        }
        //写htaccess内容
        $path = BASEPATH.'/.htaccess';

        if(!empty($content))
        {
            Common::saveToFile($path,$content);
        }


        //重写伪静态开始
        //写入mobile 配置
        $file = BASEPATH . '/data/mobile.php';
        $config = require($file);
        $config['domain']['mobile'] = $configinfo['cfg_m_main_url'];
        $config['domain']['main'] = 'http://' . $_SERVER['HTTP_HOST'];
        //重写伪静态
        $htFile = BASEPATH . '/.htaccess';
        $content = file_get_contents($htFile);
        if ($configinfo['cfg_mobile_version'] < 1 || $config['domain']['mobile'] == $config['domain']['main'])
        {
            $config['domain']['mobile'] = $config['domain']['main'];
            $content = preg_replace("`({$config['delimiterLeft']}).*({$config['delimiterRight']})`is", '$1' . "\r\n" . '$2', $content);
        }
        else
        {
            $replace = $config['delimiterLeft'];
            $replace .= str_replace(array('{PHP_EOL}', '{host}', '{path}'), array("\r\n", parse_url($config['domain']['mobile'], PHP_URL_HOST), rtrim($config['version'][$configinfo['cfg_mobile_version']]['path'], '/')), $config['rules']);
            $replace .= $config['delimiterRight'];
            if (preg_match("~" . $config['delimiterLeft'] . '.*' . $config['delimiterRight'] . '~is', $content))
            {
                $content = preg_replace("~" . $config['delimiterLeft'] . '.*' . $config['delimiterRight'] . '~is',str_replace('$1', '\$1',$replace), $content);
            }
            else
            {
                $replace='RewriteBase /'."\r\n".$replace."\r\n";
                $content = str_replace('RewriteBase /', $replace, $content);
            }
        }
        file_put_contents($htFile, $content);
        file_put_contents($file, '<?php ' . "\r\n" . 'return ' . var_export($config, true) . ';');
        //重写伪静态结束

        //读取版本首页内容
        $file_index_handle = fopen($indexfile, "r");
        $index = "";
        while(!feof($file_index_handle))
        {
            $index.=fgets($file_index_handle,1024);
        }
        //写index.php内容
        $indexpath = BASEPATH.'/index.php';

        if(!empty($index))
        {
            Common::saveToFile($indexpath,$index);
        }






    }





}