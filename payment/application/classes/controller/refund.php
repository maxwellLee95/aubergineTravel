<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 支付类
 * Class Controller_Index
 */
class Controller_Refund extends Stourweb_Controller
{
    //支付平台对象
    private $_platFrom;
    //模板目录
    private $_templte;
    //错误信息
    private $_error;
    //错误提示
    const ORDERSN_ERROR = '订单错误';
    const ORDERSN_FORMAT_ERROR = '格式错误';
    const ORDERSN_NOT_EXISTS = '订单不存在';
    const ORDERSN_PAYED = '订单已支付';
    const TOKEN_ERROR = '口令错误';
    const POST_ERROR = '提交异常数据';

    /**
     * 初始化支付对象
     */
    public function before()
    {
        parent::before();
        Common::C('base_url', $GLOBALS['base_url'] . Common::C('base_url'));
        $platFromClass = 'Pay_' . ucfirst(Common::C('platform'));
        $this->_platFrom = new $platFromClass();
        $this->_templte = Common::C('template_dir');
    }


    public function action_wxpay_confirm()
    {

        $ordersn = $_REQUEST['ordersn'];
        $orderRefund = ORM::factory('member_order_refund')->where("ordersn='{$ordersn}'")->find();
        $order = ORM::factory('member_order')->where("ordersn='{$ordersn}'")->find();
        if ($orderRefund->id){
            if ($orderRefund->platform==Model_Member_Order_Refund::PLATFORM_WXPAY
                && $orderRefund->status!=Model_Member_Order_Refund::STATUS_SUCCESS){

                if ($orderRefund->refund_fee>0){
                    $obj = new Pay_Mobile_WxPay();
                    $refundRes=$obj->refund($orderRefund);
                    if ($refundRes['return_code']=='SUCCESS'){
                        //更新退款状态
                        $orderRefund->status = Model_Member_Order_Refund::STATUS_SUCCESS;
                        $orderRefund->modtime = time();
                        $orderRefund->api_results=json_encode($refundRes);
                        $orderRefund->refund_no=$refundRes['refund_id'];
                        $orderRefund->update();

                        //订单状态更新
                        $order->status=Model_Member_Order::STATUS_REFUNDED;
                        $order->update();
                        $res['status']=1;
                        $res['msg']='退款成功';
                        $res['data']=$refundRes;
                    }else{
                        $res['status']=0;
                        $res['msg']=$refundRes['return_msg'];
                    }
                }else{
                    //更新退款状态
                    $orderRefund->status = Model_Member_Order_Refund::STATUS_SUCCESS;
                    $orderRefund->modtime = time();
                    $orderRefund->update();
                    if ($orderRefund->saved()){
                        $order->status=Model_Member_Order::STATUS_REFUNDED;
                        $order->update();
                    }
                }
                Model_Distributionrecord::cancelDistributionByOrder($order->id);

            }else{
                $res=array(
                    'status'=>0,
                    'msg'=>'订单不属于微信支付或者已经退款订单状态不合法'
                );
            }
        }else{
            $res=array(
                'status'=>0,
                'msg'=>'订单不存在'
            );
        }
        echo json_encode($res);exit;



    }

    /**
     * 支付确认
     */
    public function action_confirm()
    {
        //支付宝微信客户端
        if (Common::C('platform') == 'mobile' && $_GET['method'] == 1 && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
        {
            $view = View::factory($this->_templte . "mobile/alipay_wxclient");
            $view = str_replace(array('<stourweb_pay_content/>', '确认订单', '产品支付'), array($view->render(), '订单支付', '订单支付'), $this->_platFrom->content);
            exit($view);
        }
        //根据支付方式选择
        $this->_ordersn_checked($_GET['ordersn']);
        //支付数据格式化
        $info = Model_Member_Order::info($_GET['ordersn']);
        $platFrom = Common::C('platform');
        $conf = Common::C($platFrom);
        $className = 'Pay_' . ucfirst($platFrom) . '_' . $conf['method'][$_GET['method']]['en'];
        //实列化对象
        $obj = new $className();
        $isWx = $_GET['method'] == '8' ? 1 : 0;
        switch ($isWx)
        {
            //微信支付
            case 1:
                if ($platFrom == 'pc')
                {
                    //PC微信扫码支付
                    $html = $obj->submit($info);
                    if ($html != false)
                    {
                        $view = str_replace(array('<stourweb_pay_content/>','<stourweb_title/>'), array($html,'微信扫码支付'), $this->_platFrom->content);
                        $this->response->body($view);
                    }
                }
                else
                {
                    //mobile 微信公众号
                    $arr = $obj->submit($info);
                    $view = View::factory($arr['template']);
                    $view->parameter = $arr['parameter'];
                    $view->productname = $arr['productname'];
                    $view->total_fee = $arr['total_fee'];
                    $this->response->body($view);
                }
                break;
            case 0:
                $obj->submit($info);
                break;
        }
    }

    /**
     * 检测订单号是否正确
     * @param $ordersn
     * @return bool
     */
    private function _ordersn_checked($ordersn)
    {
        $bool = false;
        $info['ordersn'] = $ordersn;
        if (!preg_match('~^\d+$~', $ordersn))
        {
            //订单号格式错误
            $info['sign'] = 25;
            new Pay_Exception("订单{$ordersn}" . self::ORDERSN_FORMAT_ERROR);
        }
        else if (Model_Member_Order::not_exists($ordersn))
        {
            //订单不存在
            $info['sign'] = 26;
            new Pay_Exception("订单{$ordersn} " . self::ORDERSN_NOT_EXISTS);
        }
        else if (Model_Member_Order::payed($ordersn))
        {
            //订单已支付
            $info['sign'] = 24;
            new Pay_Exception("订单{$ordersn} " . self::ORDERSN_PAYED);
        }
        else
        {
            $bool = true;
        }
        //订单号错误提示
        if (!$bool)
        {
            Common::pay_status($info);
        }
    }

    /**
     * AJAX 检测是否支付
     */
    public function action_ajax_ispay()
    {
        $result = array(
            'result' => false
        );
        if (preg_match('~^\d+$~', $_POST['ordersn']) && Model_Member_Order::payed($_POST['ordersn']))
        {
            $result['result'] = true;
        }
        echo json_encode($result);
    }
}