<?php defined('SYSPATH') or die('No direct script access.');

/**
 * PC支付类
 * Class Pay_Pc
 */
class Pay_Pc extends Pay_Platform
{
    //平台配置
    private $_conf;
    //模板文件
    public $template;
    //通用部分(头、底部)
    public $content;

    /**
     * 初始化模板
     */
    public function __construct()
    {
        $this->_conf = Common::C('pc');
        if (empty($this->template))
        {
            $this->template = Common::C('template_dir') . $this->_conf['template'];
        }
        if (empty($this->content))
        {
            $file = APPPATH . 'cache/common/pc.php';
            if (file_exists($file))
            {
                $this->content = file_get_contents($file);
            }
            else
            {
                if (!file_exists(dirname($file)))
                {
                    mkdir(dirname($file), 0777, true);
                }
                $this->content = file_get_contents(Common::get_main_host() . '/pub/pay');
                file_put_contents($file, $this->content);
            }
        }
    }

    /**
     * 支付方式
     * @return mixed
     */
    public function pay_method()
    {
        $online = array();
        $line = array();
        $order = array();
        $support = explode(',', Common::C('cfg_pay_type'));
        foreach ($this->_conf['method'] as $k => $v)
        {
            if (in_array($k, $support) || isset($v['extend']))
            {
                $v['id'] = $k;
                if ($k != 6)
                {
                    $online["{$k}"] = $v;
                    $order[] = isset($v['order']) ? $v['order'] : 0;
                }
                else
                {
                    $line["{$k}"] = $v;
                }
            }
        }
        //未开启任何支付
        if (empty($online) && empty($line))
        {
            return;
        }
        //线下支付
        $rs['line'] = $line;
        //线上支付
        if (!empty($online))
        {
            array_multisort($order, SORT_ASC, $online);
        }
        $rs['online'] = $online;
        empty($rs['online']) ? ($rs['line']['6']['selected'] = true) : ($rs['online'][0]['selected'] = true);
        return $rs;
    }

    /**
     * 模板解析后的html
     * @param $info
     * @return string
     */
    public function html($info)
    {
        $info['cfg_webname'] = Common::C('cfg_webname');
        return str_replace(array('<stourweb_title/>', '<stourweb_pay_content/>'), array($info['title'], $this->status($info)), $this->content);
    }
}