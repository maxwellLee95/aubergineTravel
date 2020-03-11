<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 支付回调类
 * Class Controller_Callback
 */
class Controller_Callback extends Controller
{
    public function before()
    {
        parent::before();

    }

    /**
     * 根据URL参数实列对象
     * URL:/payment/callback/index/类名-方法名/
     */
    public function action_index()
    {
        $param = $this->request->param('param');
        $uri = explode('-', $param);
        //参数个数错误
        if (count($uri) != 2)
        {
            return;
        }
        list($class, $method) = $uri;
        //检测类与方式是否存在
        if (method_exists($class, $method))
        {
            $obj = new $class();
            echo $obj->$method();
        }
    }
}