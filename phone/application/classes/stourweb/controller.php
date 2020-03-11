<?php
/**
 * User: Netman
 * Date: 14-3-27
 * Time: 下午9:53
 */

class Stourweb_Controller extends Controller {

  // 用户数据赋值
   public $_data = array();
   public $params = array();
   protected $cmsurl;
   public $member=null;
    /*
     * before
     */
   public function before()
   {
        $this->cmsurl=Common::get_main_host().'/phone/';
       //常用变量赋值
       $this->assign('cmsurl',$this->cmsurl);
       $this->assign('webname',$GLOBALS['cfg_webname']);
       $params = $this->request->param('params');
       $this->params = $this->analyze_param($params);
       $controller = $this->request->controller();
       $action = $this->request->action();

     //  $_POST = Common::remove_xss($_POST);
     //  $_GET = Common::remove_xss($_GET);
     //  $_COOKIE = Common::remove_xss($_COOKIE);
      // $_REQUEST = Common::remove_xss($_REQUEST);

//
       if ($_COOKIE['local']){
//           Common::session('member',null);
           $member = Common::session('member');
//           Common::dd($member);
           if (empty($member)){
               //模拟登陆
               $user = 'lance@126.com';
               $pwd = '123456';

               $member = Model_Member::member_find($user, $pwd);
               if ($member){
                   Model_Member::write_session($member, $user);
               }
           }
       }








   }
   /*
    * 显示模板
    * @param string $tpl,模板名
    * */
   public function display($tpl)
   {
       

	    $file = $GLOBALS['cfg_default_templet'].$tpl;

       if(!file_exists(APPPATH.'/views/'.$GLOBALS['cfg_default_templet'].'/'.$tpl.'.php'))
       {
           $file = 'default/'.$tpl;
       }
       //$tpl = !empty($GLOBALS['cfg_templet']) ? $GLOBALS['cfg_templet'].'/'.$tpl : $tpl;//是否定义默认模板判断.

       $view = Stourweb_View::factory($file);

       foreach($this->_data as $key=>$value)
       {
           $view->set($key,$value);
           $view->set_global($key,$value);
       }

       $this->response->body($view->render());


   }

  /*
   * 模板赋值,控制器赋值
   * @param string $key
   * @param string $value
   * */
   public function assign($key,$value)
   {

       $this->_data[$key] = $value;

   }
    /*
  * 变量值分析器
  * @param string $param
  * */
    public function analyze_param($param)
    {

        $arr = explode('/',$param);

        $out = array();
        for($i = 0;isset($arr[$i]) ;$i=$i+1)
        {
           if($i % 2 ==0)
           {
               $key = $arr[$i];
               $value= isset($arr[$i+1]) ? $arr[$i+1] : 0;
               $out[$key] = Common::remove_xss($value);
           }

        }
        return $out;

    }


    public function upload_file($input_name){
        $pinyin =  'main';

        $file = $_FILES[$input_name];

        $storepath = BASEPATH . '/uploads/' . $pinyin;

        $dir = BASEPATH . "/uploads/" . $pinyin . "/allimg/" . date('Ymd'); //原图存储路径.

        if (!file_exists($dir))
        {
            mkdir($dir,0777,true);
        }
        $path_info = pathinfo($_FILES[$input_name]['name']);

        $filename = date('YmdHis');
        $i = 0;

        while (file_exists($dir . '/' . $filename . '.' . $path_info['extension']))
        {

            $i = $i + 50;
            $filename = date('YmdHis') . $i;

        }

        $filename = $filename . '.' . $path_info['extension'];

        Upload::$default_directory = $dir;//默认保存文件夹
        Upload::$remove_spaces = true;//上传文件删除空格

        if (Upload::valid($file))
        {
            if (Upload::size($file, "2M"))
            {
                if (Upload::type($file, array('jpg', 'png', 'gif','jpeg')))
                {

                    if (Upload::save($file, $filename))
                    {
                        $srcfile = $dir . '/' . $filename; //原图

                        $arr['success'] = 'true';
                        $arr['litpic'] = $GLOBALS['$cfg_basehost'] . substr(substr($srcfile, strpos($dir, '/uploads') - 1), 1);


                    }
                    else
                    {
                        //echo "error_no";
                        $arr['success'] = 'false';
                        $arr['msg'] = '未知错误,上传失败';
                    }
                }
                else
                {
                    $arr['success'] = 'false';
                    $arr['msg'] = '类型不支持';
                }
            }
            else
            {
                $arr['success'] = 'false';
                $arr['msg'] = '图片大小超过限制';
            }
        }
        else
        {
            $arr['success'] = 'false';
            $arr['msg'] = '未知错误,上传失败';
        }
        return $arr;
    }


} 