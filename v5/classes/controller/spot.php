<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Spot
 * 景点/门票控制器
 */
class Controller_Spot extends Stourweb_Controller
{
    private $typeid = 5;
    private $_cache_key = '';
    public function before()
    {
        parent::before();
        //检查缓存
        $this->_cache_key = Common::get_current_url();
        $html = Common::cache('get',$this->_cache_key);
        $genpage = Common::remove_xss(Arr::get($_GET,'genpage'));
        if(!empty($html) && empty($genpage))
        {
            echo $html;
            exit;
        }
        $channelname = Model_Nav::get_channel_name($this->typeid);
        $this->assign('typeid', $this->typeid);
        $this->assign('channelname', $channelname);
    }

    /**
     * 首页
     */
    public function action_index()
    {
        $seoinfo = Model_Nav::get_channel_seo($this->typeid);
        $this->assign('seoinfo', $seoinfo);
        //首页模板
        $templet = Product::get_use_templet('spot_index');
        $templet = $templet ? $templet : 'spot/index';
        $this->display($templet);
        //缓存内容
        $content = $this->response->body();
        Common::cache('set',$this->_cache_key,$content);
    }

    /*
     * 搜索页
     */
    public function action_list()
    {

        //参数值获取
        $destPy = $this->request->param('destpy');
        $sign = $this->request->param('sign');

        $priceId = intval($this->request->param('priceid'));
        $sortType = intval($this->request->param('sorttype'));
        $attrId = $this->request->param('attrid');
        $p = intval($this->request->param('p'));
        $attrId = !empty($attrId) ? $attrId : 0;

        $destPy = $destPy ? $destPy : 'all';
        $pagesize = 12;


        $route_array = array(
            'controller' => $this->request->controller(),
            'action' => $this->request->action(),
            'destpy' => $destPy,
            'priceid'=> $priceId,
            'sorttype'=> $sortType,
            'attrid' => $attrId
        );
        //$start_time=microtime(true); //获取程序开始执行的时间
        $keyword = Common::remove_xss(Arr::get($_GET,'keyword'));

        $out = Model_Spot::search_result($route_array,$keyword,$p,$pagesize);
        $pager = Pagination::factory(
            array(

                'current_page' => array('source' => 'route', 'key' => 'p'),
                'view'=>'default/pagination/search',
                'total_items' => $out['total'],
                'items_per_page' => $pagesize,
                'first_page_in_url' => false,
            )
        );
        //配置访问地址 当前控制器方法

        $pager->route_params($route_array);
        $destId = $destPy=='all' ? 0 : ORM::factory('destinations')->where("pinyin='$destPy'")->find()->get('id');
        $destId = $destId ? $destId : 0;
        //目的地信息
        $destInfo = array();
        $preDest = array();
        if($destId)
        {
            $destInfo = ORM::factory('destinations',$destId)->as_array();
            $preDest = Model_Destinations::get_prev_dest($destId);
        }
        //$end_time=microtime(true);

        //$total=$end_time-$start_time; //计算差值



        $chooseitem = Model_Spot::get_selected_item($route_array);
        $searchTitle = Model_Spot::gen_seotitle($route_array);
        $this->assign('destid',$destId);
        $this->assign('destinfo',$destInfo);
        $this->assign('predest',$preDest);
        $this->assign('list',$out['list']);
        $this->assign('chooseitem',$chooseitem);
        $this->assign('searchtitle',$searchTitle);
        $this->assign('param',$route_array);
        $this->assign('currentpage',$p);
        $this->assign('pageinfo',$pager);
        $templet = Product::get_use_templet('spot_list');
        $templet = $templet ? $templet : 'spot/list';
        $this->display($templet);

        //缓存内容
        $content = $this->response->body();
        Common::cache('set',$this->_cache_key,$content);

    }


    /*
     * 预订
     * */
    public function action_book()
    {
        //会员信息
        $userInfo = Product::get_login_user_info();
        //要求预订前必须登陆
        if(empty($userInfo['mid']))
        {
            $this->request->redirect('/member/login/?redirecturl='.urlencode(Common::get_current_url()));
        }
        $productId = Common::remove_xss(Arr::get($_GET,'productid'));
        $suitId = Common::remove_xss(Arr::get($_GET,'suitid'));
        //防止空提交
        if(empty($productId) || empty($suitId))
        {
            $this->request->redirect($this->request->referrer());
        }
        //预订日期
        $useDate = Arr::get($_GET,'usedate');
        //套餐信息
        $suitInfo = Model_Spot_Suit::suit_info($suitId);
        //产品信息
        $info = ORM::factory('spot',$productId)->as_array();
        $info['price'] = Currency_Tool::price($info['price']);

        $info['usedate'] = $useDate;
        //产品编号
        $info['series'] = Product::product_number($info['id'], '05');

        //frmcode
        $code = md5(time());
        Common::session('code',$code);


        //积分抵现所需积分
        $needjifen = $GLOBALS['cfg_exchange_jifen'] * $suitInfo['jifentprice']; //所需积分

        $this->assign('info',$info);
        $this->assign('suitInfo',$suitInfo);
        $this->assign('userInfo',$userInfo);
        $this->assign('needjifen',$needjifen);
        $this->assign('frmcode',$code);
        $this->display('spot/book');
    }

    /*
     * 创建订单
     * */

    public function action_create()
    {
        $frmCode = Arr::get($_POST,'frmcode');
        $checkCode = strtolower(Arr::get($_POST,'checkcode'));
        //验证码验证
        if(!Captcha::valid($checkCode)||empty($checkCode))
        {
            exit();
        }
        //安全校验码验证
        $orgCode = Common::session('code');
        if($orgCode!=$frmCode)
        {
            exit();
        }
        $userInfo = Product::get_login_user_info();
        $memberId = $userInfo ? $userInfo['mid'] : 0;//会员id
        $webid = intval(Arr::get($_POST,'webid'));//网站id
        $dingNum = intval(Arr::get($_POST,'dingnum'));//数量
        $suitId = intval(Arr::get($_POST,'suitid')) ;
        $productId = intval(Arr::get($_POST,'productid'));//产品id
        $useDate = Arr::get($_POST,'usedate');//使用日期

        $linkMan = Arr::get($_POST,'linkman');//联系人姓名
        $linkTel = Arr::get($_POST,'linktel');//联系人电话
        $linkEmail = Arr::get($_POST,'linkemail');//联系人邮箱
        $remark = Arr::get($_POST,'remark');//订单备注


        $payType = Arr::get($_POST,'paytype');//支付方式
        $useJifen = intval(Arr::get($_POST,'usejifen'));//是否使用积分

        //产品信息
        $info = ORM::factory('spot',$productId)->as_array();

        //套餐信息
        $suitInfo = Model_Spot_Suit::suit_info($suitId);
        $orderSn = Product::get_ordersn('05');

        //判断积分使用是否满足需求.
        $needJifen = 0;
        if($useJifen)
        {
            $needJifen = $GLOBALS['cfg_exchange_jifen'] * $info['jifentprice']; //所需积分
            if($userInfo['jifen']<$needJifen)
            {
                $useJifen = 0;
            }
        }
        //订单状态(全款支付,定金支付,二次确认)
        $status = $suitInfo['paytype'] !=3 ? 1 : 0;

        $arr = array(
            'ordersn'=>$orderSn,
            'webid'=>$webid,
            'typeid'=>$this->typeid,
            'productautoid'=>$info['id'],
            'productaid'=>$info['aid'],
            'productname'=>$info['title'],
            'price'=>$suitInfo['ourprice'],
            'usedate'=>$useDate,
            'dingnum'=>$dingNum,
            'departdate'=>'',
            'linkman'=>$linkMan,
            'linktel'=>$linkTel,
            'linkemail'=>$linkEmail,
            'jifentprice'=>$suitInfo['jifentprice'],
            'jifenbook'=>$suitInfo['jifenbook'],
            'jifencomment'=>$suitInfo['jifencomment'],
            'addtime'=>time(),
            'memberid'=>$memberId,
            'dingjin'=>$suitInfo['dingjin'],
            'paytype'=>$suitInfo['paytype'],
            'suitid'=>$suitId,
            'usejifen'=>$useJifen,
            'needjifen'=>$needJifen,
            'status'=>$status,
            'remark'=>$remark,
            'isneedpiao'=>0

        );

        //添加订单
        if(Product::add_order($arr))
        {


            //$orderInfo = Model_Member_Order::get_order_by_ordersn($orderSn);


            //这里作判断是跳转到订单查询页面
            if($suitInfo['paytype']!=3)
            {
                $payurl = "{$GLOBALS['cfg_basehost']}/payment/?ordersn=".$orderSn;
                $this->request->redirect($payurl);
            }
            else
            {
                $this->request->redirect("/member");
            }


        }


















    }

    /*
     * 内容页
     */
    public function action_show()
    {
        $aid = Common::remove_xss($this->request->param('aid'));
        //详情
        $info = Model_Spot::spot_detail($aid);
        //seo
        $seoInfo = Product::seo($info);
        //产品图片
        $info['piclist'] = Product::pic_list($info['piclist']);
        //属性列表
        $info['attrlist'] = Model_Spot::spot_attr($info['attrid']);
        //最低价
        $price = Model_Spot::get_minprice($info['id']);
        $info['price'] = $price['ourprice'];
        $info['sellprice'] = $price['sellprice'];
        //点评数
        $info['commentnum'] = Model_Comment::get_comment_num($info['id'], $this->typeid);
        //销售数量
        $info['sellnum'] = Model_Member_Order::get_sell_num($info['id'], $this->typeid) + intval($info['bookcount']);
        //产品编号
        $info['series'] = Product::product_number($info['id'], '05');
        //产品图标
        $info['iconlist'] = Product::get_ico_list($info['iconlist']);
        //支付方式
        $paytypeArr=explode(',',$GLOBALS['cfg_pay_type']);
        //满意度
        $info['score'] = $info['satisfyscore'] ? $info['satisfyscore'].'%' : mt_rand(90,98).'%';
        //是否有门票
        $info['hasticket'] = Model_Spot::has_ticket($info['id']);

        //目的地上级
        if($info['finaldestid']>0)
        {
            $predest = Product::get_predest($info['finaldestid']);
        }



        //扩展字段信息
        $extend_info = Model_Spot::get_minprice($info['id']);

        $this->assign('seoinfo', $seoInfo);
        $this->assign('info', $info);
        $this->assign('paytypeArr',$paytypeArr);
        $this->assign('extendinfo',$extend_info);
        $this->assign('predest',$predest);
        $this->display('spot/show');
        Product::update_click_rate($info['aid'], $this->typeid);
        //缓存内容
        $content = $this->response->body();
        Common::cache('set',$this->_cache_key,$content);
    }


    /*
    * 首页ajax请求获取景点
    * */
    public function action_ajax_index_spot()
    {
        $destid = Arr::get($_GET,'destid');
        $pagesize = Arr::get($_GET,'pagesize');
        $offset = 0;
        $list = Model_Spot::get_spot_bymdd($destid,$pagesize,$offset);
        echo json_encode(array('list'=>$list));

    }






}