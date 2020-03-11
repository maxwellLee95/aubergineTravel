<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Member_Order
 * 订单管理
 */
class Controller_Member_Order extends Stourweb_Controller
{
    /**
     * 订单管理前置操作
     */
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }

    /**
     * 订单列表
     */
    public function action_list()
    {
        $page = 1;
        $page_size = 30;
        //STATUS_UNTREATED STATUS_ACCEPTANCE STATUS_PAY
        $line_paid = Model_Member_Order::order_list($this->member['mid'], $page, $page_size, Model_Line::TYPE_ID, array(
            Model_Member_Order::STATUS_UNTREATED, Model_Member_Order::STATUS_ACCEPTANCE, Model_Member_Order::STATUS_PAY
        ));
        //STATUS_FINISH
        $line_complete = Model_Member_Order::order_list($this->member['mid'], $page, $page_size, Model_Line::TYPE_ID, array(
            Model_Member_Order::STATUS_FINISH
        ));
        //STATUS_REFUNDED STATUS_CANCEL
        $line_refund = Model_Member_Order::order_list($this->member['mid'], $page, $page_size, Model_Line::TYPE_ID, array(
            Model_Member_Order::STATUS_REFUNDED, Model_Member_Order::STATUS_CANCEL
        ));
        $mall_all = Model_Member_Order::order_list($this->member['mid'], $page, $page_size, Model_Mall::TYPE_ID);
        $order_list['line_paid'] = self::get_data_initialization($line_paid);
        $order_list['line_complete'] = self::get_data_initialization($line_complete);
        $order_list['line_refund'] = self::get_data_initialization($line_refund);
        $order_list['mall_all'] = self::get_data_initialization($mall_all);
        $user = Model_Member::get_member_byid($this->member['mid']);
        $user['rank'] = Common::member_rank($this->member['mid'], array('return' => 'name'));
        $user['fans_count'] = Model_Member_Fans::getFansCount($this->member['mid']);
        $user['attention_count'] = Model_Member_Fans::getAttentionCount($this->member['mid']);
        $this->assign('curnav', 'my');
        $this->assign('user', $user);
        $this->assign('order_list', $order_list);
        $this->display('member/order_list');
    }

    /**
     * 获取订单列表
     * @return mixed
     */
    private function get_list()
    {
        $row = Model_Member_Order::order_list($this->member['mid']);
        $row = self::get_data_initialization($row);
        return $row;
    }
    /**
     * 订单列表 查看更多
     */
    public function action_ajax_order_more()
    {
        $page = Common::remove_xss(intval($_GET['page']));
        $page = $page < 1 ? 1 : $page;
        $row = Model_Member_Order::order_list($this->member['mid'], $page);
        $row = self::get_data_initialization($row);
        echo (Product::list_search_format($row, $page));
    }

    /**
     * 订单列表数据处理
     * @param $data
     * @return mixed
     */
    private function get_data_initialization($data)
    {
        foreach ($data as &$v) {
            //订单详情
            $v['url'] = Common::get_web_url($v['webid']) . "/member/order/show?id={$v['id']}";
            //支付url
            $v['payurl'] = Common::get_main_host() . "/payment/?ordersn={$v['ordersn']}";
            //评论url
            $v['commenturl'] = Common::get_web_url($v['webid']) . "/member/comment/index?id={$v['id']}";

            $v['delurl'] = Common::get_web_url($v['webid']) . "/member/order/del?orderid={$v['id']}";
            $v['cancelurl'] = Common::get_web_url($v['webid']) . "/member/order/cancel?orderid={$v['id']}";
            $v['refundurl'] = Common::get_web_url($v['webid']) . "/member/order/refund?ordersn={$v['ordersn']}";


            $v['lineurl'] = Common::_detail_url($v['productaid']);

            //产品缩略图
            $v['litpic'] = Common::img($v['litpic']);
            //下单时间
            $v['addtime'] = date('Y-m-d H:i', $v['addtime']);
            //分割订单产品名称
            $tempArr = array_filter(preg_split('`[\(\)]`', $v['productname']));
            $v['subname'] = count($tempArr) > 1 ? $tempArr[count($tempArr) - 1] : '';
            $v['productname'] = str_replace("({$v['subname']})", '', $v['productname']);
            //全额支付
            $v['price'] = $v['price'] * $v['dingnum'] + $v['childprice'] * $v['childnum'] + $v['oldprice'] * $v['oldnum'];
            //支付方式
            switch ($v['paytype']) {
                case '1':
                    $v['paytype'] = '全款支付';
                    break;
                case '2':
                    $v['paytype'] = '定金支付';
                    $v['price'] = ($v['dingnum'] + $v['childnum'] + $v['oldnum']) * $v['dingjin'];
                    break;
                default:
                    $v['paytype'] = '线下支付';
                    break;
            }
            //1元学分兑换
            $v['exchange'] = $GLOBALS['cfg_exchange_jifen'];
        }
        return $data;
    }
    /**
     * 订单详情
     */
    public function action_show()
    {
        $id = Common::remove_xss($_GET['id']);
        $row = Model_Member_Order::get_order_detail($id);
        if ($row['memberid'] == $this->member['mid']) {
            //分割订单产品名称
            $tempArr = array_filter(preg_split('`[\(\)]`', $row['productname']));
            $row['subname'] = count($tempArr) > 1 ? $tempArr[count($tempArr) - 1] : '';
            $row['productname'] = str_replace("({$row['subname']})", '', $row['productname']);
            //支付金额
            $row['total'] = $row['paytype'] == 2 ? ($row['dingnum'] + $row['childnum'] + $row['oldnum']) * $row['dingjin'] : $row['price'] * $row['dingnum'] + $row['childprice'] * $row['childnum'] + $row['oldprice'] * $row['oldnum'];
            //预订人数
            $num = array();
            if ($row['dingnum'] > 0) {
                array_push($num, "成人{$row['dingnum']}个");
            }
            if ($row['childnum'] > 0) {
                array_push($num, "小孩{$row['childnum']}个");
            }
            if ($row['oldnum'] > 0) {
                array_push($num, "老人{$row['oldnum']}个");
            }
            $row['num'] = implode('，', $num);
            //评论
            $comment = Model_Comment::get_comment($row['ordersn']);
            $order_linkman = Model_Member_Order_Tourer::get_order_tourer($row['id']);
            $order_refund = Model_Member_Order_Refund::get_item($row['ordersn']);
            $row['payurl'] = Common::get_main_host() . "/payment/?ordersn={$row['ordersn']}";
            $templet='order_show';
            if($row['typeid']==202)
            {
                $order_product=Model_Member_Order_Product::geListByOrdersn($row['ordersn']);
                $templet='order_mall_show';
            }
            $leader_comment = Model_Comment::get_comments($row['ordersn'],Model_Leader::TYPE_ID);
            if ($leader_comment){
                foreach ($leader_comment as &$item){
                    $item['leader']=Model_Leader::get_leader($item['articleid']);
                }
            }
            $activity=Model_Line_Suit_Price::get_price_by_suit_day($row['suitid'],strtotime($row['usedate']));
            $leaders=Model_Leader::get_leaders(Model_Leader::format_ids($activity));
            $this->assign('leaders', $leaders);
            $this->assign('leader_comment', $leader_comment);
            $this->assign('order_product', $order_product);
            $this->assign('order_refund', $order_refund);
            $this->assign('order_linkman', $order_linkman);
            $this->assign('info', $row);
            $this->assign('comment', $comment);
            $this->assign('member', $this->member);
            $this->display('member/'.$templet);
        } else {
            Common::head404();
        }

    }

    public function action_del()
    {
        $orderid = Common::remove_xss(Arr::get($_GET, 'orderid', ''));
        $jumpUrl = $this->cmsurl . 'member/order/list';
        if ($orderid) {
            $m = ORM::factory('member_order', $orderid);
            if ($m && $this->member['mid'] == $m->memberid) {
                if ($m->status != Model_Member_Order::STATUS_FINISH && $m->status != Model_Member_Order::STATUS_PAY) {
                    DB::delete('member_order')->where("id=$orderid AND memberid={$this->member['mid']}")->execute();
                    Common::message(array('message' => '删除成功', 'jumpUrl' => $jumpUrl));
                } else {
                    Common::message(array('message' => '不可删除-订单状态不合法', 'jumpUrl' => $jumpUrl));
                }
            } else {
                Common::message(array('message' => '该用户的订单不存在', 'jumpUrl' => $jumpUrl));
            }
        } else {
            Common::message(array('message' => '缺少必要参数', 'jumpUrl' => $jumpUrl));
        }
    }

    public function action_cancel()
    {
        $orderId = Common::remove_xss(Arr::get($_GET, 'orderid'));
        $jumpUrl = $this->cmsurl . 'member/order/list';
        if ($orderId) {
            $m = ORM::factory('member_order', $orderId);
            if ($m && $this->member['mid'] == $m->memberid) {
                if ($m->status != Model_Member_Order::STATUS_FINISH && $m->status != Model_Member_Order::STATUS_PAY) {
                    $m->status = Model_Member_Order::STATUS_CANCEL;//取消订单
                    $m->save();
                    if ($m->saved()) {
                        Model_Member_Order::refundStorage($orderId, 'plus');//订单取消,增加库存
                        Model_Msg::msgOrderCancel($m->id,'用户主动取消');
                        Model_Distributionrecord::cancelDistributionByOrder($orderId);
                        Common::message(array('message' => '取消成功', 'jumpUrl' => $jumpUrl));

                    } else {
                        Common::message(array('message' => '取消失败', 'jumpUrl' => $jumpUrl));
                    }
                } else {
                    Common::message(array('message' => '不可取消-订单状态不合法', 'jumpUrl' => $jumpUrl));
                }
            } else {
                Common::message(array('message' => '该用户的订单不存在', 'jumpUrl' => $jumpUrl));
            }

        } else {
            Common::message(array('message' => '缺少必要参数', 'jumpUrl' => $jumpUrl));
        }
    }


    public function action_refund()
    {
        $ordersn = Common::remove_xss(Arr::get($_GET, 'ordersn'));
        $jumpUrl = $this->cmsurl . 'member/order/list';
        if ($ordersn) {
            $orderInfo = Model_Member_Order::info($ordersn);
            if ($orderInfo && $this->member['mid'] == $orderInfo['memberid']) {
                if ($orderInfo['status'] != Model_Member_Order::STATUS_FINISH && $orderInfo['status'] == Model_Member_Order::STATUS_PAY) {
                    $order_refund_data = ORM::factory('member_order_refund')->where("ordersn={$orderInfo['ordersn']}")->find()->as_array();
                    if (!$order_refund_data['id']) {
                        $orderRefund = ORM::factory('member_order_refund');
                        $orderRefund->ordersn = $orderInfo['ordersn'];
                        $orderRefund->platform = $orderInfo['paysource']=='微信支付(移动)'?Model_Member_Order_Refund::PLATFORM_WXPAY:Model_Member_Order_Refund::PLATFORM_BACKSTAGE;
                        $orderRefund->status = Model_Member_Order_Refund::STATUS_UNTREATED;
                        $orderRefund->refund_fee = $orderInfo['total'];
                        $orderRefund->addtime = time();
                        $orderRefund->memberid = $this->member['mid'];
                        $orderRefund->save();
                        if ($orderRefund->saved()) {
                            Common::message(array('message' => '申请退款成功，请等待后台人员审核，', 'jumpUrl' => $jumpUrl));
                        }
                    } else {
                        Common::message(array('message' => '您已经申请过退款啦，相关人员正在处理', 'jumpUrl' => $jumpUrl));
                    }
                } else {
                    Common::message(array('message' => '订单必须是未完成而且已经付款', 'jumpUrl' => $jumpUrl));
                }
            } else {
                Common::message(array('message' => '该用户的订单不存在', 'jumpUrl' => $jumpUrl));
            }

        } else {
            Common::message(array('message' => '缺少必要参数', 'jumpUrl' => $jumpUrl));
        }
    }





}