<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Orderrefund extends Stourweb_Controller{


    /*
     * 订单总控制器
     *
     */
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);


    }

    /*
     * 订单列表
     * */
    public function action_index()
    {
        $action=$this->params['action'];
        $webid=Arr::get($_GET,'webid');
        if(empty($action))  //显示列表
        {
            $this->assign('position','订单');
            $this->assign('channelname','订单');
            $this->display('stourtravel/orderrefund/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');

            $order='order by a.addtime desc';
            $w = "where 1 ";

            if(!empty($keyword))
            {
                $w .=" and (a.ordersn like '%{$keyword}%')";
                $start = 0;
            }

            $sql="select a.*  from sline_member_order_refund as a $w $order limit $start,$limit";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_member_order_refund a $w ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
                $v['addtime'] = Common::myDate('Y-m-d H:i:s',$v['addtime']);
                $v['modtime'] = $v['modtime']?Common::myDate('Y-m-d H:i:s',$v['modtime']):null;
                $v['price']=number_format($v['refund_fee'],2);
                $v['statusname']=Model_Member_Order_Refund::getStatusName($v['status']);
                $v['platformname']=Model_Member_Order_Refund::getPlayFormName($v['platform']);
                $new_list[] = $v;
            }
            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$new_list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {

        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id)) //
            {
                $model=ORM::factory('member_order_refund',$id);
                $model->delete();
            }
        }
        else if($action=='update')//更新某个字段
        {

        }
    }


    /*
     * 查看订单信息
     * */
    public function action_edit()
    {
        $id = $this->params['id'];//订单id.
        $order_refund_model =  ORM::factory('member_order_refund')->where('id','=',$id)->find();
        $order_refund = $order_refund_model->as_array();
        $order_model =  ORM::factory('member_order')->where('ordersn','=',$order_refund['ordersn'])->find();
        $info = $order_model->as_array();
        $info['statusname']=Model_Member_Order::getStatusName($info['status']);

        $order_refund['addtime'] = Common::myDate('Y-m-d H:i:s',$order_refund['addtime']);
        $order_refund['modtime'] = $order_refund['modtime']?Common::myDate('Y-m-d H:i:s',$order_refund['modtime']):null;
        $order_refund['price']=number_format($order_refund['refund_fee'],2);
        $order_refund['platformname']=Model_Member_Order_Refund::getPlayFormName($order_refund['platform']);
        $this->assign('statusnames',Model_Member_Order_Refund::$statusNames);
        $templet='edit';
        if ($info['typeid']==202){
            $info['order_product']=Model_Member_Order_Product::geListByOrdersn($info['ordersn']);
            $templet='product_edit';
        }
        $this->assign('info',$info);
        $this->assign('order_refund',$order_refund);
        $this->display('stourtravel/orderrefund/'.$templet);
    }


    public function action_add()
    {
        $ordersn=Arr::get($_GET,'ordersn');
        $orderRefund=ORM::factory('member_order_refund')->where('ordersn','=',$ordersn)->find();
        $refund_url=null;
        if ($orderRefund->id){
            $refund_url="/admintravel/orderrefund/edit/id/".$orderRefund->id;
        }else{
            $orderInfo=Model_Member_Order::info($ordersn);
            if ($orderInfo['status']!=Model_Member_Order::STATUS_FINISH && $orderInfo['status']==Model_Member_Order::STATUS_PAY){
                $order_refund_data=ORM::factory('member_order_refund')->where("ordersn={$orderInfo['ordersn']}")->find()->as_array();
                if (!$order_refund_data['id']){
                    $orderRefund=ORM::factory('member_order_refund');
                    $orderRefund->ordersn=$orderInfo['ordersn'];
                    $orderRefund->platform=Model_Member_Order_Refund::PLATFORM_WXPAY;
                    $orderRefund->status=Model_Member_Order_Refund::STATUS_UNTREATED;
                    $orderRefund->refund_fee=$orderInfo['total'];
                    $orderRefund->addtime=time();
                    $orderRefund->memberid=$this->member['mid'];
                    $orderRefund->save();

                    if ($orderRefund->saved()){
                        $refund_url="/admintravel/orderrefund/edit/id/".$orderRefund->id;
                    }

                }
            }
        }
        if ($refund_url){
            header("Location:{$refund_url}");
            exit;
        }
    }

    /*
     * 保存
     * */
    public function action_ajax_save()
    {
        $status=false;
        $id = Arr::get($_POST,'id');
        if ($id){
            $post_status=Arr::get($_POST,'status');
            $model = ORM::factory('member_order_refund',$id);
            if ($model->status!=Model_Member_Order_Refund::STATUS_SUCCESS){
                if ($post_status==Model_Member_Order_Refund::STATUS_SUCCESS){
                    switch ($model->platform){
                        case Model_Member_Order_Refund::PLATFORM_WXPAY:
                            $this->wxpay_refund($model);
                            break;
                        case Model_Member_Order_Refund::PLATFORM_BACKSTAGE:
                            $model->status = $post_status;
                            $model->modtime = time();
                            $model->update();
                            break;
                    }
                }else{
                    $model->status = $post_status;
                    $model->modtime = time();
                    $model->update();
                }
                //通知
                Model_Msg::msgOrderRefund($model->ordersn,'用户申请退款，后台审核通过');
                $status = true;
            }

        }
        echo json_encode(array('status'=>$status));

    }


    public function wxpay_refund($model){
        $ch = curl_init();
        $url='http://www.168hike.com/payment/refund/wxpay_confirm?ordersn='.$model->ordersn;
        curl_setopt($ch, CURLOPT_URL, $url); // 需要获取的 URL 地址，也可以在 curl_init() 初始化会话的时候。
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HEADER, false); // 启用时会将头文件的信息作为数据流输出。
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 在尝试连接时等待的秒数。设置为 0，则无限等待。
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 允许 cURL 函数执行的最长秒数。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // TRUE 将 curl_exec() 获取的信息以字符串返回，而不是直接输出。
        $ret = curl_exec($ch);
        $ret=json_decode($ret,true);
        curl_close($ch);
    }




}