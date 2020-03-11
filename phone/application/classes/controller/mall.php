<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Mall
 * @desc 酒店总控制器
 */
class Controller_Mall extends Stourweb_Controller
{

    public function before()
    {
        parent::before();
        $channelname = Model_Nav::get_channel_name(Model_Mall::TYPE_ID);
        $this->assign('typeid', Model_Mall::TYPE_ID);
        $this->assign('channelname', $channelname);
    }


    public function action_index()
    {
        $list=Model_Mall::get_goods_new(0,100,201);
        $member_cart=Common::init_mall_cart();
        $this->assign('cartNum',$member_cart->totalCount());
        $this->assign('list',$list);
        $this->display('mall/index');
    }


    public function action_attr_list()
    {
        $attr_id=207;
        $list=Model_Mall::get_goods_new(0,100,$attr_id);
        $member_cart=Common::init_mall_cart();
        $this->assign('cartNum',$member_cart->totalCount());
        $this->assign('list',$list);
        $this->display('mall/attr_list');
    }


    public function action_search()
    {
        $this->display('mall/search');
    }


    public function action_list()
    {
        //参数处理
        $urlParam = $this->request->param('params');
        $destPy = 'all';
        $destId = $rankId = $priceId = $sortType = $keyword = $attrId = 0;
        $params = explode('-', str_replace('/', '-', $urlParam));
        $count = count($params);
        switch ($count)
        {
            //目的地
            case 1:
                list($destPy) = $params;
                break;
            //关键字、属性
            case 7:
                list($destPy, $rankId, $priceId, $sortType, $keyword, $attrId, $page) = $params;
                break;
        }
        $keyword = Arr::get($_GET, 'keyword');
        $page = $page < 1 ? 1 : $page;
        $destname = $destPy != 'all' ? ORM::factory('destinations')->where("pinyin='$destPy'")->find()->get('kindname') : '目的地';
        //获取seo信息
        $seo = Model_Mall::search_seo($destPy,2);
        $this->assign('seoinfo', $seo);
        $this->assign('destpy', Common::remove_xss($destPy));
        $this->assign('destname', $destname);
        $this->assign('rankid', Common::remove_xss($rankId));
        $this->assign('sorttype', Common::remove_xss($sortType));
        $this->assign('keyword', Common::remove_xss($keyword));
        $this->assign('attrid', Common::remove_xss($attrId));
        $this->assign('priceid', Common::remove_xss($priceId));
        $this->assign('page', $page);
        $this->display('mall/list');
    }


    public function action_show()
    {
        $member_cart=Common::init_mall_cart();
        $aid = Common::remove_xss($this->request->param('aid'));

        $info=Model_Mall::get_detail_by_aid($aid);
        //点击率加一
        Product::update_click_rate($aid, Model_Mall::TYPE_ID);
        $info['piclist'] = Product::pic_list($info['piclist']);
        $info['price'] = Model_Mall::get_minprice($info['id']);
        $info['commentnum'] = Model_Comment::get_comment_num($info['id'], Model_Mall::TYPE_ID); //评论次数
        $info['satisfyscore'] = Model_Comment::get_score($info['id'], Model_Mall::TYPE_ID, $info['satisfyscore'], $info['commentnum']);//满意度
        $info['sellnum'] = Model_Member_Order_Product::getShowSellNum($info['id'],intval($info['bookcount']));//销售数量
        $goods_sku=Model_Mall_Sku::get_sku_list($info['id']);
        $this->assign('cartNum',$member_cart->totalCount());
        $this->assign('goods_sku', $goods_sku);
        $this->assign('info', $info);
        $this->display('mall/show');
    }


    public function action_book()
    {
        $userinfo = Common::session('member');
        Common::check_login($userinfo);
        /* //检查是否是登陆界面.
         if(empty($userinfo))
         {
             $this->request->redirect('member/login');
         }*/
        $productid = Common::remove_xss($this->params['id']);
        $info = ORM::factory('mall', $productid)->as_array();
        $info['price'] = Model_Mall::get_minprice($info['id']);
        $this->assign('info', $info);
        $this->assign('userinfo', $userinfo);
        $member = Common::session('member');
        if (!empty($member))
        {
            $this->assign('member', Model_Member::get_member_byid($member['mid']));
        }
        $this->display('mall/book');
    }

    /*
     * 创建订单
     * */
    public function action_ajax_create()
    {
        $res=array();
        $products = Arr::get($_POST, 'products');
        $contactId= Arr::get($_POST,'contactId');
        $express_id = Arr::get($_POST, 'express_id');
        $linkman=Model_Member_Linkman::detail($contactId);
        $res['status']=0;
        $res['msg']='未知错误，请联系客服';
        if (empty($linkman)){
            $res['msg']='请填写联系人';
            echo json_encode($res);exit;
        }
        if (!empty($products)){
            $products_price=0;
            $products_storage=0;
            $order_products=array();
            $all_productname=null;
            foreach ($products as $v){
                $suitid=$v['sku_id'];
                $product_id=$v['product_id'];
                $info=Model_Mall::get_detail($product_id);
                $count=$v['count'];
                if ($suitid && $product_id && $count){
                    $suit=Model_Mall_Sku::get_sku($product_id,$suitid);
                    if ($suit){
                        $suit['price'] = Currency_Tool::price($suit['price']);
                        $storage = intval($suit['number']);
                        $productname=$info['title'] . "({$suit['name']})";
                        $all_productname.='-'.$productname;
                        $all_productname=ltrim($all_productname,'-');
                        if ($storage != -1 && $storage <= $count)
                        {
                            $res['msg']="{$productname}库存不足";
                            echo json_encode($res);
                            exit;
                        }else{
                            $products_price+=Currency_Tool::price($suit['price'])*$count;
                            $products_storage+=$storage;
                            $order_products[]=array(
                                'suit_id'=>$suit['id'],
                                'product_id'=>$info['id'],
                                'product_name'=>$productname,
                                'product_price'=>$suit['price'],
                                'product_num'=>$count,
                                'product_image'=>$info['litpic'],
                                'prodcut_pay_price'=>$suit['price'],

                            );
                        }
                    }
                }
            }

            $express=Model_Mall_Delivery::getItem($express_id);
            //
            //express_id
            if ($order_products){
                $ordersn = Product::get_ordersn(Model_Mall::TYPE_ID);
                $order = array(
                    'ordersn' => $ordersn,
                    'webid' => 0,
                    'typeid' => Model_Mall::TYPE_ID,
                    'productautoid' => 0,
                    'productaid' => 0,
                    'productname' => $all_productname,
                    'litpic' =>$info['litpic'],
                    'price' => Currency_Tool::price($products_price)+Currency_Tool::price($express['price']),
                    'childprice' => 0,
                    'jifentprice' => 0,
                    'jifenbook' => 0,
                    'jifencomment' => 0,
                    'paytype' => 1,
                    'dingjin' =>0,
                    'usedate' => date('Y-m-d'),
                    'addtime' => time(),
                    'memberid' => null,
                    'dingnum' => 1,
                    'childnum' =>0,
                    'oldprice' => 0,
                    'oldnum' => 0,
                    'linkman' => $linkman['linkman'],
                    'linktel' => $linkman['mobile'],
                    'linkidcard' => $linkman['idcard'],
                    'linkaddress'=>$linkman['address'],
                    'suitid' => 0,
                    'remark' => null,
                    'status' => 1,
                    'usejifen' => 0,
                    'express_id'=>$express['id'],
                    'express_fee'=>Currency_Tool::price($express['price'])
                );
                if (Product::add_order($order))
                {
                    Model_Member_Order_Product::add_product($ordersn,$order_products);
                    $res['status']=1;
                    $res['payurl'] = Common::get_main_host() . "/payment/?ordersn={$ordersn}";
                }else{
                    $res['msg']='订单创建失败';
                }
            }

        }else{
            if (empty($linkman)){
                $res['msg']='商品不存在或者已经下架了';
            }
        }
        echo json_encode($res);
    }

    /**
     * ajax请求 加载更多
     */
    public function action_ajax_mall_more()
    {
        $urlParam = $this->request->param('params');
        $keyword = Arr::get($_GET, 'keyword') ? Arr::get($_GET, 'keyword') : '';
        $data = Model_Mall::search_result($urlParam, $keyword);
        echo($data);
    }

    /*
     * 获取房型进店和离店日期价格
     * */
    public function action_ajax_range_price()
    {
        $startdate = Arr::get($_GET, 'startdate');
        $enddate = Arr::get($_GET, 'leavedate');
        $suitid = Arr::get($_GET, 'suitid');
        $dingnum = Arr::get($_GET, 'dingnum');
        $price = Model_Mall::suit_range_price($suitid, $startdate, $enddate, $dingnum);
        $price = $price * $dingnum;
        echo json_encode(array('price' => $price));
    }

    /**
     *
     * 获取套餐可预订的最小日期.
     *
     */
    public function action_ajax_mindate_book()
    {
        $suitid = Arr::get($_GET, 'suitid');
        $day = Model_Mall::suit_mindate_book($suitid);
        echo json_encode(array(
            'startdate' => date('Y-m-d', $day),
            'enddate' => date('Y-m-d', strtotime("+1 day", $day))
        ));
    }

    /**
     *
     * 检测库存是否能够预订
     */
    public function action_ajax_check_storage()
    {
        $startdate = Arr::get($_POST, 'startdate');
        $enddate = Arr::get($_POST, 'enddate');
        $dingnum = Arr::get($_POST, 'dingnum');
        $suitid = Arr::get($_POST, 'suitid');
        $flag = Model_Mall::check_suit_storage($suitid, $startdate, $enddate, $dingnum);
        echo json_encode(array('status' => $flag));
    }

    public function action_ajax_productinventory(){
        $res=array(
            "errcode"=>1,
            "errmsg"=>'error',
        );
        $productId=Arr::get($_POST,'productId',0);
        $optionIds=Arr::get($_POST,'optionIds',0);
        $suitId=$optionIds[0];
        if ($productId && $suitId){
            $info=Model_Mall::get_detail($productId);

            if ($info){
                $sku=Model_Mall_Sku::get_sku($productId,$suitId);
//                print_r($sku);
//                Common::dd($info);
                if ($sku){
                    $res=array(
                        "errcode"=> 0,
                        "errmsg"=> "success",
                        "data"=> null,
                        "count"=> $sku['number'],
                        "min_price"=> $sku['price'],
                        "min_discount_price"=> "0",
                        "max_price"=> $sku['price'],
                        "max_discount_price"=> "0",
                        "productSkus"=> array(
                            array(
                                "id"=> $sku['id'],
                                "product_id"=> $sku['mallid'],
                                "count"=> $sku['number'],
                                "price"=> $sku['price'],
                            )
                        ),
                        "haveInventorySizeIds"=> array(
                        ),
                        "status"=> 1
                    );
                }
            }
        }
        echo json_encode($res);
    }


    public function action_ajax_addcart(){
        $member_cart=Common::init_mall_cart();
        $productId=Arr::get($_POST,'productId');
        $optionIds=Arr::get($_POST,'optionIds');
        $sku_id=$optionIds[0];
        $count=Arr::get($_POST,'count');
        $info=Model_Mall::get_detail($productId);
        if ($info && $sku_id){
            $sku_price=Model_Mall_Sku::get_sku($productId,$sku_id);
            if ($sku_price['price']){
                $cart=array(
                    $sku_price['id'],
                    $info['title'],
                    $info['price'],
                    intval($count),
                );
                $member_cart->add($cart);
                echo json_encode(array('status'=>1));
            }
        }
    }

    public function action_cart(){
        $member_cart=Common::init_mall_cart();
        $cart_list=$member_cart->getCart();
        $list=array();
        if ($cart_list){
            foreach ($cart_list as $item){
                $sku=Model_Mall_Sku::get_sku_by_id($item['ID']);
                if ($sku){
                    $info=Model_Mall::get_detail($sku['mallid']);
                    if ($info){
                        $num=$item['count']>$sku['number']?$sku['number']:$item['count'];
                        $list[]=array(
                            'product_id'=>$sku['mallid'],
                            'price'=>$sku['price'],
                            'product_name'=>$info['title'],
                            'stock'=>$sku['number'],
                            'sku_name'=>$sku['name'],
                            'sku_id'=>$sku['id'],
                            'num'=>$num,
                            'total_price'=>$num*$sku['price'],
                            'product_pic'=>$info['litpic'],
                            'detail_url'=>Common::get_web_url($info['webid']) . "/malls/show_{$info['aid']}.html",
                        );
                    }
                }


            }
        }
        $this->assign('list',$list);
        $this->display('mall/cart');
    }

    public function action_ajax_skucount(){
        $sku_id=Arr::get($_POST,'skuId',0);
        if ($sku_id){
            $sku_price=Model_Mall_Sku::get_sku_by_id($sku_id);
            echo  json_encode(array('count'=>$sku_price['number'],'status'=>1));
        }
    }

    public function action_ajax_delcart(){
        $sku_id=Arr::get($_POST,'cartId',0);
        if ($sku_id){
            $member_cart=Common::init_mall_cart();
            $member_cart->remove($sku_id);
            echo json_encode(array('status'=>1));
        }
    }

    /**
    cart[5][sku_id]: 5
    cart[5][payNum]: 1
     */

    public function action_confirm_order(){
        $cart_list=Arr::get($_POST,'cart',0);
        $member = Common::session('member');
        if (empty($member)){
            Common::head404();
        }
        $total_price=0;
        if ($cart_list){
            $shop_list=array();
            foreach ($cart_list as $item){
                $sku=Model_Mall_Sku::get_sku_by_id($item['sku_id']);
                if ($sku){
                    $info=Model_Mall::get_detail($sku['mallid']);
                    $sku_price=Model_Mall_Sku::get_sku_by_id($sku['id']);
                    if ($info && $sku_price){
                        $num=$item['payNum']>$sku_price['number']?$sku_price['number']:$item['payNum'];
                        if ($num>0){
                            $sku_total_price=$num*$sku_price['price'];
                            $total_price+=$sku_total_price;
                            $shop_list[]=array(
                                'product_id'=>$sku_price['mallid'],
                                'price'=>$sku_price['price'],
                                'product_name'=>$info['title'],
                                'stock'=>$sku_price['number'],
                                'sku_name'=>$sku['name'],
                                'sku_id'=>$sku_price['id'],
                                'num'=>$num,
                                'total_price'=>$sku_total_price,
                                'product_pic'=>$info['litpic'],
                                'detail_url'=>Common::get_web_url($info['webid']) . "/malls/show_{$info['aid']}.html",
                            );
                        }

                    }
                }
            }
            $linkmanlist=Model_Member_Linkman::get_list($member['mid']);
            $linkman=array();
            if ($linkmanlist){
                foreach ($linkmanlist as $v){
                    $linkman[$v['id']]=Model_Member_Linkman::_format($v);
                }
            }
            $linkman=Model_Member_Linkman::_formatLinkMan($member['mid']);
            $delivery=Model_Mall_Delivery::getList();
            $this->assign('total_price',$total_price);
            $this->assign('linkman', $linkman);
            $this->assign('shop_list',$shop_list);
            $this->assign('delivery',$delivery);
            $this->display('mall/confirm_order');
        }else{
            Common::message(array('message'=>'数据过期或者无效，该页面不允许刷新页面','jumpUrl'=> $this->cmsurl.'malls'));
        }

    }




}