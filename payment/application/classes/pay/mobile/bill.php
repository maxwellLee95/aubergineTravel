<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 移动端快钱支付
 * Class Pay_Mobile_Bill
 */
class Pay_Mobile_Bill
{

    //异步通知
    const NOTIFY_URL = '/callback/index/Pay_Mobile_Bill-notify_url/';
    //同步通知
    const ERTURN_URL = '/callback/index/Pay_Mobile_Bill-return_url/';

    /**
     * 支付数据提交
     * @param $data
     */
    public function submit($data)
    {
        $parameter = $this->_data_format($data);
        //参数中加入秘钥生成签名
        $parameter['key'] = Common::C('cfg_bill_key');
        //过滤出非空值
        $parameter = array_filter($parameter);
        //封装签名
        $string = '';
        foreach ($parameter as $k => $v)
        {
            $string .= $this->_kq_ck_null($k, $v);
        }
        $string = substr($string, 0, strlen($string) - 1);
        $parameter['signMsg'] = strtoupper(md5($string));
        //提交数据
        echo $this->_buildRequestForm($parameter);
    }

    /**
     * 数据格式化
     * @param $data 订单详情
     * @return array
     */
    private function _data_format($data)
    {
        $parameter = array(
            "inputCharset" => '1',//编码方式 1代表 UTF-8; 2 代表 GBK; 3代表 GB2312
            "pageUrl" => Common::C('base_url') . self::ERTURN_URL,//接收支付结果的页面地址
            "bgUrl" => Common::C('base_url') . self::NOTIFY_URL,//服务器接收支付结果的后台地址
            "version" => 'v2.0',//网关版本，固定值：v2.0,
            "language" => '1',//语言种类，1代表中文显示，2代表英文显示
            "signType" => '1',//签名类型
            "signMsg" => '',//签名字符串，必须
            "merchantAcctId" => Common::C('cfg_bill_account') . '01',//人民币网关账号，该账号为11位人民币网关商户编号+01。
            "payerName" => '',//支付人姓名，可选
            "payerContactType" => '',//支付人联系类型，1 代表电子邮件方式；2 代表手机联系方式，可选
            "payerContact" => '',//支付人联系方式，可选
            "orderId" => $data['ordersn'],//商户订单号
            "orderAmount" => $data['total'] * 100,//订单金额，金额以“分”为单位
            "orderTime" => date("YmdHis"),//订单提交时间
            "productName" => $data['productname'],//商品名称，可选
            "productNum" => '1',//商品数量，可选
            "productId" => '',//商品代码，可选
            "productDesc" => '',//商品描述，可选
            "ext1" => '',//扩展字段1，商户可以传递自己需要的参数，支付完快钱会原值返回，可选
            "ext2" => '',//扩展自段2，可选
            "payType" => '00',//支付方式，一般为00，代表所有的支付方式。如果是银行直连商户，该值为10。
            "bankId" => '',//银行代码，如果payType为00，该值可以为空；如果payType为10，该值必须填写，具体请参考银行列表，可选
            "redoFlag" => '',//同一订单禁止重复提交标志，实物购物车填1，虚拟产品用0。1代表只能提交一次，0代表在支付不成功情况下可以再提交，可选
            "pid" => ''//快钱合作伙伴的帐户号，即商户编号，可选
        );
        return $parameter;
    }

    /**
     * 返回生成的表单
     * @param $paras
     * @return string
     */
    private function _buildRequestForm($paras)
    {
        $html = '<form name="kqPay" action="https://sandbox.99bill.com/gateway/recvMerchantInfoAction.htm" accept-charset="utf-8">';
        foreach ($paras as $k => $v)
        {
            $html .= '<input type="hidden" name="' . $k . '" value="' . $v . '">';
        }
        $html .= '</form>';
        $html .= "<script>document.forms['kqPay'].submit();</script>";
        return $html;
    }

    /**
     * 服务器异步通知页面路径
     */
    public function notify_url()
    {
        if ($this->_verify())
        {
            if ($_GET['payResult'] == '10')
            {
                if (Common::total_fee_confirm($_GET['orderId'], $_GET['fee'] / 100, '信息:快钱(异)交易,订单金额与实际支付不一致'))
                {
                    $method = Common::C('mobile');
                    Common::pay_success($_GET['orderId'], $method['method']['2']['name']);
                }
            }
            else
            {
                new Pay_Exception("状态:{$_GET['payResult']}");
            }
        }
        else
        {
            new Pay_Exception("信息:合法性验证失败");
        }
    }

    /**
     * 页面跳转同步通知页面路径
     */
    public function return_url()
    {
        if ($this->_verify())
        {
            if ($_GET['payResult'] == '10')
            {
                $tip = '信息:快钱(同)交易,订单金额与实际支付不一致';
                $info['sign'] = Common::total_fee_confirm($_GET['orderId'], $_GET['fee'] / 100, $tip) ? '11' : '23';
            }
            else
            {
                $info['sign'] = '00';
                new Pay_Exception("状态:{$_GET['payResult']}");
            }
        }
        else
        {
            $info['sign'] = '22';
        }
    }

    /**
     * 数字签名验证
     * @return bool
     */
    private function _verify()
    {
        $bool = false;
        $kq_check_all_para = _kq_ck_null($_GET['merchantAcctId'], 'merchantAcctId');
        $kq_check_all_para .= _kq_ck_null($_GET['version'], 'version');
        $kq_check_all_para .= _kq_ck_null($_GET['language'], 'language');
        $kq_check_all_para .= _kq_ck_null($_GET['signType'], 'signType');
        $kq_check_all_para .= _kq_ck_null($_GET['payType'], 'payType');
        $kq_check_all_para .= _kq_ck_null($_GET['bankId'], 'bankId');
        $kq_check_all_para .= _kq_ck_null($_GET['orderId'], 'orderId');
        $kq_check_all_para .= _kq_ck_null($_GET['orderTime'], 'orderTime');
        $kq_check_all_para .= _kq_ck_null($_GET['orderAmount'], 'orderAmount');
        $kq_check_all_para .= _kq_ck_null($_GET['dealId'], 'dealId');
        $kq_check_all_para .= _kq_ck_null($_GET['bankDealId'], 'bankDealId');
        $kq_check_all_para .= _kq_ck_null($_GET['dealTime'], 'dealTime');
        $kq_check_all_para .= _kq_ck_null($_GET['payAmount'], 'payAmount');
        $kq_check_all_para .= _kq_ck_null($_GET['fee'], 'fee');//费用，快钱收取商户的手续费，单位为分。
        $kq_check_all_para .= _kq_ck_null($_GET['ext1'], 'ext1');
        $kq_check_all_para .= _kq_ck_null($_GET['ext2'], 'ext2');
        $kq_check_all_para .= _kq_ck_null($_GET['payResult'], 'payResult');//处理结果
        $kq_check_all_para .= _kq_ck_null($_GET['errCode'], 'errCode');//错误代码
        $merchantSignMsg = strtoupper(md5($kq_check_all_para));
        $signMsg = trim($_GET['signMsg']);
        if ($merchantSignMsg == $signMsg)
        {//签名验证
            $bool = true;
        }
        return $bool;
    }

    /**
     * 块钱去除值为空的参数
     * @param $kq_va
     * @param $kq_na
     * @return string
     */
    private function  _kq_ck_null($kq_va, $kq_na)
    {
        if ($kq_va == "")
        {
            return $kq_va = "";
        }
        else
        {
            return $kq_va = ($kq_na . '=' . $kq_va . '&');
        }
    }
}