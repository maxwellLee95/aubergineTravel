<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Line
 * 线路控制器
 */
class Controller_Line extends Stourweb_Controller
{
    private $_typeid = 1;   //产品类型

    public function before()
    {
        parent::before();
        $channelname = Model_Nav::get_channel_name($this->_typeid);
        $this->assign('typeid', $this->_typeid);
        $this->assign('channelname', $channelname);
    }

    /**
     * 线路首页
     */
    public function action_index()
    {
        $seoinfo = Model_Nav::get_channel_seo($this->_typeid);
        $this->assign('seoinfo', $seoinfo);
        $this->display('line/index');
    }

    /**
     * 线路搜索页
     */
    public function action_list()
    {
        //参数处理
        $urlParam = $this->request->param('params');
        $destPy = 'all';
        $dayId = $priceId = $sortType = $keyword = $attrId = $startcityId = 0;
        $params = explode('-', str_replace('/', '-', $urlParam));
        $count = count($params);
        switch ($count)
        {
            //目的地
            case 1:
                list($destPy) = $params;
                break;
            //关键字、属性
            case 8:
                list($destPy, $dayId, $priceId, $sortType, $keyword, $startcityId, $attrId, $page) = $params;
                break;
        }

        $keyword = Arr::get($_GET, 'keyword');
        $page = $page < 1 ? 1 : $page;

        $destname = $destPy != 'all' ? ORM::factory('destinations')->where("pinyin='$destPy'")->find()->get('kindname') : '目的地';
        //获取seo信息
        $seo = Model_Hotel::search_seo($destPy,1);
        $this->assign('seoinfo', $seo);
        $this->assign('destpy', Common::remove_xss($destPy));
        $this->assign('destname', $destname);
        $this->assign('dayid', Common::remove_xss($dayId));
        $this->assign('sorttype', Common::remove_xss($sortType));
        $this->assign('keyword', Common::remove_xss($keyword));
        $this->assign('attrid', Common::remove_xss($attrId));
        $this->assign('startcityid', Common::remove_xss($startcityId));
        $this->assign('priceid', Common::remove_xss($priceId));
        $this->assign('page', $page);
        $this->display('line/list');
    }

    /**
     * 线路搜索页(搜索初始页)
     */
    public function action_search()
    {
        $this->display('line/search');
    }

    /**
     * 线路预订
     */
    public function action_book()
    {
        $member = Common::session('member');
        Common::check_login($member);
        $suitid=Arr::get($_GET,'suitid');
        $day=Arr::get($_GET,'day');
        $suit = Model_Line_Suit_Price::get_price_by_suit_day($suitid,$day);
        if ($suit){
            $productid = $this->params['id'];
            $info = ORM::factory('line', $productid)->as_array();
            $info['marshal_point_list']=Model_Marshalpoint::get_list($info['marshal_point']);
            $info['startcity'] = Model_Startplace::start_city($info['startcity']);
            $info['price']=$suit['adultprice'];
            if(Common::isDeadLine($suit['day'],$info['linebefore'])){
                Common::message(array('message'=>'抱歉，该活动已截止报名','jumpUrl'=> $this->cmsurl));
            }
            $linkman=Model_Member_Linkman::_formatLinkMan($member['mid']);
            $userInfo = Model_Member::get_member_byid($member['mid']);
            $score_arr=$this->bookScore($userInfo['jifen'],$suit['jifentprice'],$GLOBALS['cfg_exchange_jifen']);
            $default_linkman=array();
            foreach ($linkman as $value){
                if ($value['isdefault']){
                    $default_linkman=$value;
                    break;
                }
            }
            $this->assign('distribution_id',Arr::get($_GET,'distribution_id',null));
            $this->assign('score_arr',$score_arr);
            $this->assign('default_linkman', $default_linkman);
            $this->assign('linkman', $linkman);
            $this->assign('suit', $suit);
            $this->assign('info', $info);
            $this->assign('member', $userInfo);
            $this->display('line/new_book');
//            $this->display('line/book');
        }else{
            Common::message(array('message'=>'抱歉，该活动的活动套餐不存在','jumpUrl'=> $this->cmsurl));
        }
    }


        /**
     * 预定积分规则
     *
     * @return void
     */
    public function bookScore($userScore,$suitMaxScorePrice,$exchange){
        $isAvailableUse=0;
        $maxUseScore=$suitMaxScorePrice*$exchange;
        $availableUseScore=$userScore<=$maxUseScore?$userScore:$maxUseScore;
        $availablemaxUsePrice=$availableUseScore/$exchange;
        if ($availableUseScore
            && $userScore
            && $availablemaxUsePrice>=0.1){
                $isAvailableUse=1;
        }
        $scoreArr['isAvailableUse']=$isAvailableUse;//默认不可使用
        $scoreArr['exchange']=$exchange;
        $scoreArr['userScore']=$userScore;
        $scoreArr['maxUseScore']=$maxUseScore;
        $scoreArr['maxUsePrice']=$suitMaxScorePrice;
        $scoreArr['availableUseScore']=$availableUseScore;
        $scoreArr['availablemaxUsePrice']=$availablemaxUsePrice;
        return $scoreArr;

    }

    /**
     * 创建订单
     */
    public function action_create()
    {
        $member = Common::session('member');
        Common::check_login($member);
        $refer_url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : $this->cmsurl;
        $_POST['linkman']=$_POST['tourname'][0];
        $_POST['linktel']=$_POST['tourmobile'][0];
        $_POST['linkidcard']=$_POST['touridcard'][0];

        //套餐id
        $suitid = Arr::get($_POST, 'suitid');
        //联系人
        $linkman = Arr::get($_POST, 'linkman');
        //手机号
        $linktel = Arr::get($_POST, 'linktel');
        $linkidcard = Arr::get($_POST, 'linkidcard');
        //备注信息
        $remark = Arr::get($_POST, 'remark');
        //产品id
        $id = Arr::get($_POST, 'productid');
        //出行时间
        $startdate = Arr::get($_POST, 'startdate');


        //成人数量
        $dingnum = Arr::get($_POST, 'dingnum');
        //小孩数量
        $childnum = Arr::get($_POST, 'childnum');
        //老人数量
        $oldnum = Arr::get($_POST, 'oldnum');


        //验证部分
        $validataion = Validation::factory($_POST);
        $validataion->rule('linktel', 'not_empty');
        $validataion->rule('linktel', 'phone');
        $validataion->rule('linkman', 'not_empty');

        if (!$validataion->check())
        {
            $error = $validataion->errors();
            $keys = array_keys($validataion->errors());
            Common::message(array('message' => __("error_{$keys[0]}_{$error[$keys[0]][0]}"), 'jumpUrl' => $refer_url));
            exit();
        }

        $info = ORM::factory('line')->where("id=$id")->find()->as_array();
        $suitArr = ORM::factory('line_suit')
            ->where("id=:suitid")
            ->param(':suitid', $suitid)
            ->find()
            ->as_array();
        $suitArr['dingjin'] = Currency_Tool::price($suitArr['dingjin']);
        $priceArr = ORM::factory('line_suit_price')->where("day=" . strtotime($startdate) . " and suitid=" . $suitid)->find()->as_array();

        $priceArr['adultprice'] = Currency_Tool::price($priceArr['adultprice']);
        $priceArr['childprice'] = Currency_Tool::price( $priceArr['childprice']);
        $priceArr['oldprice'] = Currency_Tool::price($priceArr['oldprice']);

        //库存判断
        $totalnum = $dingnum + $childnum + $oldnum;
        $storage = intval($priceArr['number']);
        if ($storage != -1 && $storage < $totalnum)
        {
            Common::message(array('message' => __("error_no_storage"), 'jumpUrl' => $refer_url));
            exit;
        }
        if ($suitArr['paytype'] == '3')//这里补充一个当为二次确认时,修改订单为未处理状态.
        {
            $info['status'] = 0;
        } else
        {
            $info['status'] = 1;
        }
        $info['name'] = $info['title'] . "({$suitArr['suitname']})";
        $info['paytype'] = $suitArr['paytype'];
        $info['dingjin'] = doubleval($suitArr['dingjin']);
        $info['jifentprice'] = intval($suitArr['jifentprice']);
        $info['jifenbook'] = intval($suitArr['jifenbook']);
        $info['jifencomment'] = intval($suitArr['jifencomment']);
        $info['ourprice'] = doubleval($priceArr['adultprice']);
        $info['childprice'] = doubleval($priceArr['childprice']);
        $info['oldprice'] = doubleval($priceArr['oldprice']);
        $info['usedate'] = $startdate;
        $ordersn = Product::get_ordersn('01');
        $arr = array(
            'ordersn' => $ordersn,
            'webid' => 0,
            'typeid' => $this->_typeid,
            'productautoid' => $id,
            'productaid' => $info['aid'],
            'productname' => $info['name'],
            'litpic' => $info['litpic'],
            'price' => $info['ourprice'],
            'childprice' => $info['childprice'],
            'jifentprice' => $info['jifentprice'],
            'jifenbook' => $info['jifenbook'],
            'jifencomment' => $info['jifencomment'],
            'paytype' => $info['paytype'],
            'dingjin' => $info['dingjin'],
            'usedate' => $info['usedate'],
            'departdate' => $info['departdate'],
            'addtime' => time(),
            'memberid' => null,
            'dingnum' => $dingnum,
            'childnum' => $childnum,
            'oldprice' => $info['oldprice'],
            'oldnum' => $oldnum,
            'linkman' => $linkman,
            'linktel' => $linktel,
            'linkidcard' => $linkidcard,
            'suitid' => $suitid,
            'remark' => $remark,
            'status' => $info['status'] ? $info['status'] : 0,
            'usejifen' => $_POST['usejifen'] != 0 ? 1 : 0, //积分抵现
            'marshal_point_id'=>$_POST['marshal_point'],
        );
        //添加订单
        if (Product::add_order($arr))
        {

            $orderInfo = Model_Member_Order::get_order_by_ordersn($ordersn);
            Model_Member_Order::add_tourer($orderInfo['id'], $_POST);
            $msg="您好，您的订单已创建，订单号为：{$ordersn},请及时付款，感谢您的支持";
            Model_Member_Message::add_message($member['mid'],"订单:{$ordersn}-创建成功",$msg);
            if ($arr['price']==0){
                $model=ORM::factory('member_order')->where('id','=',$orderInfo['id'])->find();
                $model->status=Model_Member_Order::STATUS_PAY;
                $model->update();
                $msg="您好，您的订单已付款成功，订单号为：{$ordersn}";
                Model_Member_Message::add_message($member['mid'],"订单:{$ordersn}-付款成功",$msg);
                $url = Common::get_web_url($info['webid']) . '/pub/paystatus/?sign=11';
                $this->request->redirect($url);
            }


            //如果是立即支付则执行支付操作,否则跳转到产品详情页面
            if ($info['status'] == 1)
            {
                $html = Common::payment_from(array('ordersn' => $ordersn));
                if ($html)
                {
                    echo $html;
                }
            } else
            {
                $url = Common::get_web_url($info['webid']) . '/pub/paystatus/?sign=13';
                $this->request->redirect($url);
            }

        }else{
            Common::message(array('message' => '下单异常，请联系客服', 'jumpUrl' => $refer_url));
        }
    }


    /**
     * 线路内容页
     */
    public function action_show()
    {
        $member = Common::session('member');
        Common::check_login($member);
        $id = Common::remove_xss($this->request->param('aid'));
        $day = Common::remove_xss(Arr :: get($_GET, 'day'));
        $suitid = Common::remove_xss(Arr :: get($_GET, 'suitid'));
        $distribution_id = Common::remove_xss(Arr :: get($_GET, 'distribution_id'));
        $info = Model_Line::getItem($id,$suitid,$day);
       
        $activitys = Model_Line_Suit_Price::get_suit_day($id,20,1,false);
        $jssdk=array();
        if (Common::isWeChat()){
            $jssdk=Common::getJSSDKParam();
        }

        if (empty($info) && $activitys){
            Common::head302($activitys[0]['url']);
        }

        if (empty($info)){
            Common::message(array('message'=>'抱歉，该活动不存在或者下架啦','jumpUrl'=> $this->cmsurl));
        }
        // Common::dd($info);


        $info['marshal_point_list']=Model_Marshalpoint::get_list($info['marshal_point']);
        $info['initialSlide']=0;
        if (!empty($activitys)){
            if ($suitid && $day ){
                foreach ($activitys as $k=>$v){
                    if ($v['suitid']==$suitid && $day==$v['day']){
                        $info['status']=$v['status'];
                        $info['initialSlide']=$k;
                        break;
                    }
                }
            }
        }

        $use_order=array();
        if ($member){
            $where="memberid={$member['mid']} AND productaid={$id} AND usedate='".date('Y-m-d',$info['day'])."'";
            $use_order=ORM::factory('member_order')->where($where)->find();
        }
       
        Product::update_click_rate($id, $this->_typeid);
        $seoInfo = Product::seo($info);
        $info['price']=$info['adultprice'];
        $info['suit_tourer']=Model_Member_Order::get_line_suit_tourer($info['id'],$info['suitid'],$info['day'],10);
        $info['sell_numm']=Model_Member_Order::get_suit_sell_num($id,Model_Line::TYPE_ID,$info['suitid'],$info['day']);
        $info['attrlist'] = Model_Line::line_attr($info['attrid']);
        $info['startcity'] = Model_Startplace::start_city($info['startcity']);
        $info['leader']=Model_Leader::get_leader($info['leader_id']);
        $info['share_url']=$info['url']."&distribution_id={$member['distribution_id']}";

        $leaders=Model_Leader::get_leaders(Model_Leader::format_ids($info));

        $uri="line/book/id/{$info['id']}?suitid={$info['suitid']}&day={$info['day']}&distribution_id={$distribution_id}";
        $bookUrl=Common::url($uri);

        $signUpBtnStatus=true;
        $signUpBtnText='立即报名';
        $signUpTips='';
        if($info['status']['status']==3 || empty($info['number'])){
            $signUpBtnStatus=false;
            $signUpBtnText='已满员';
            $signUpTips='本次活动人数已满员，无法报名';
        }elseif($use_order->id){
            $signUpBtnStatus=true;
            $signUpBtnText='已报名';       
        }elseif ($info['day']<Common::day_time()) {
            $signUpBtnStatus=false;
            $signUpBtnText='已过期';
            $signUpTips='该活动日期已过';
        }elseif (Common::isDeadLine($info['day'],$info['linebefore'])) {
            $signUpBtnStatus=false;
            $signUpBtnText='已截止';
            $signUpTips='该活动已过报名时间';
        }elseif (empty($info['leader_id'])) {
            $signUpBtnStatus=false;
            $signUpBtnText='无领队';
            $signUpTips='该活动未设置领队';
        }
        
        $info['bookUrl']=$bookUrl;
        $info['signUpBtnStatus']=$signUpBtnStatus;
        $info['signUpBtnText']=$signUpBtnText;
        $info['signUpTips']=$signUpTips;

        $this->assign('customize_qrcode',Common::img($GLOBALS['cfg_customize_qrcode']));
        $this->assign('jssdk',$jssdk);
        $this->assign('member', $member);
        $this->assign('activitys', $activitys);
        $this->assign('use_order', $use_order);
        $this->assign('leaders', $leaders);
        $this->assign('info', $info);
        $this->assign('seoInfo', $seoInfo);
        $this->display('line/show');

    }


    /**
     * ajax请求 加载更多
     */
    public function action_ajax_line_more()
    {
        $urlParam = $this->request->param('params');
        $keyword = Arr::get($_GET, 'keyword') ? Arr::get($_GET, 'keyword') : '';
        $data = Model_Line::search_result($urlParam, $keyword);
        echo($data);
    }

    public function action_ajax_commnet(){
        $res=array(
            "status"=> 1,
        );
        $lineid = Arr::get($_GET, 'atid');
        if ($lineid){
            $page = Arr::get($_GET, 'page',1);
            $pagesize = Arr::get($_GET, 'pagesize',10);
            $pl=Model_Line::get_comment($lineid,$page,$pagesize);
            if ($pl){
                $sumScore=0;
                $score_1=0;
                $score_2=0;
                $score_3=0;
                $score_4=0;
                $score_5=0;
                foreach ($pl as $key => $v)
                {
                    $sumScore+=floatval($v['level']);
                    $memberinfo = Model_Member::get_member_byid($v['memberid']);
                    $t=array(
                        'score'=>$v['level'],
                        'comment'=>$v['content'],
                        'replyHiker'=>null,
                        'replyComment'=>null,
                    );
                    $t_num=intval($v['level'])?intval($v['level']):1;
                    $t['stars']=$t_num;
                    switch ($t_num){
                        case 1:
                            $score_1+=1;
                            break;
                        case 2:
                            $score_2+=1;
                            break;
                        case 3:
                            $score_3+=1;
                            break;
                        case 4:
                            $score_4+=1;
                            break;
                        case 5:
                            $score_5+=1;
                            break;
                    }
                    $score_list[]=$t_num;
                    $t['hiker']=Common::line_hiker($memberinfo);
                    $t['activity']=array();
//                    $t['activity']=array(
//                        "date"=> "08-19",
//                        "name"=> "【户外美食专列】登高明茶山，品柴火鸡",
//                        "activityId"=> "27225",
//                        "leader_name_str"=> "℡木易,末白,小小苏"
//                    );
                    $res['comment']['coments'][]=$t;
                }
                $count=count($pl);
                $averScore=round($sumScore/$count,1);
                $res['comment']['stars']=array(
                    array(
                        "rel"=>1,
                        "title"=>"非常好，给5星",
                        "name"=>"五星",
                        "percent"=>round(floatval($score_5/$count)*100,1),
                    ),
                    array(
                        "rel"=>2,
                        "title"=>"很好，给4星",
                        "name"=>"四星",
                        "percent"=>round(floatval($score_4/$count)*100,1),
                    ),
                    array(
                        "rel"=>3,
                        "title"=>"一般般，给3星",
                        "name"=>"三星",
                        "percent"=>round(floatval($score_3/$count)*100,1),
                    ),
                    array(
                        "rel"=>4,
                        "title"=>"很差，给2星",
                        "name"=>"二星",
                        "percent"=>round(floatval($score_2/$count)*100,1),
                    ),
                    array(
                        "rel"=>5,
                        "title"=>"特别差，给1星",
                        "name"=>"一星",
                        "percent"=>round(floatval($score_1/$count)*100,1),
                    )
                );
                $res['comment']['hasmove']=1;
                $res['comment']['count']=$count;
                $res['comment']['sumScore']=$sumScore;
                $res['comment']['averScore']=$averScore;
                echo json_encode($res);
            }

        }


    }


    public function action_line_suit_tourer(){
        $id = Common::remove_xss(Arr :: get($_GET, 'aid'));
        $day = Common::remove_xss(Arr :: get($_GET, 'day'));
        $suitid = Common::remove_xss(Arr :: get($_GET, 'suitid'));
        if ($id && $day  && $suitid){
            $info['suit_tourer']=Model_Member_Order::get_line_suit_tourer($id,$suitid,$day);
            $info['activity'] = Model_Line_Suit_Price::get_price_by_day($suitid,$day);
            $info['leaders']=Model_Leader::get_leaders(Model_Leader::format_ids($info['activity']));
            $this->assign('info', $info);
            $this->display('line/suit_tourer');
        }

    }



    public function action_short(){
        $theme_id=Common::_theme_short();
        $category_id=array(
            45=>'classList',
            84=>'difficultyList',
            91=>'dayList'
        );
        $category=array();
        $cate_sub_data=array();
        foreach ($category_id as $id=>$type){
            $data=Model_Line_Attr::get_sub_by_pid($id);
            if (!empty($data) && !empty($type)){
                foreach ($data as $item){
                    if ($id==45){
                        $line=Model_Line::get_line_by_themeid_attr($theme_id,$item['id'],0,6);
                        $cate_sub_data[]=array(
                            'title'=>  $item['attrname'],
                            'list'=>$line
                        );
                    }
                    $category[$type][]=array(
                        "id"=> $item['id'],
                        "title"=> $item['attrname'],
                        "img"=> Common::img($item['litpic'],185,120),
                        "share_title"=> "茄子户外运动·{$item['attrname']}路线",
                        "share_desc"=> "点击本链接可查看全部{$item['attrname']}的路线哦 (*\/ω＼*)\n",
                        "status"=> "1",
                        "search"=> $item['attrname']
                    );
                }
            }
        }
        $hot_line=array();
        $hot_line_data=Model_Line::get_line_hot_by_theme_id(0,10,$theme_id);
        if ($hot_line_data){
            foreach ($hot_line_data as &$v){
                $activity_list = Model_Line_Suit_Price::get_available_suit_day($v['id']);
                $times=array();
                if ($activity_list && is_array($activity_list)){
                    foreach ($activity_list as $a){
                        $times[]=$a['day'];
                    }
                }
                $v['times']=$times;
                $hot_line[]=$v;
            }
        }
        $this->assign('hot_line', $hot_line);
        $this->assign('cate_sub_data', $cate_sub_data);
        $this->assign('category', $category);
        $this->display('line/short');
    }

    public function action_ajax_line(){
        $class = Arr::get($_POST, 'name',0);
        $difficult = Arr::get($_POST, 'difficult',0);
        $day = Arr::get($_POST, 'day',0);
        $theme_id = Arr::get($_POST, 'theme_id',0);

        $res=array(
            "status"=> 1,
            "fanpai_list"=> array(),
            'list'=>array(),
            'old_list'=>array()
        );
        if (empty($class) && empty($difficult) &&  empty($day) ){
            $line=Model_Line::get_line_by_themeid(0,50,$theme_id);
        }else{
            $line=Model_Line::get_line_by_themeid_attr($theme_id,$class.'_'.$difficult.'_'.$day,0,50);
        }

        foreach ($line as $v){
            $activitys_list = Model_Line_Suit_Price::get_available_suit_day($v['id']);
            $activitys=array();
            if ($activitys_list && is_array($activitys_list)){
                foreach ($activitys_list as $a){
                    $leader=Model_Leader::get_leader($a['leader_id']);
                    $activitys[]=array(
                        "activityId"=>$a['suitid'],
                        "startTime"=>date('m月d',$a['day']),
                        "endTime"=>date('m月d',$a['day']+($v['lineday']*86400)),
                        "name"=>$v['title'],
                        "starttime_i"=>$a['day'],
                        "status"=>Common::line_status($v['person_count'],$v['min_person_count'],$a['lineid'],$a['suitid'],$a['day']),
                        'url'=>Common::_detail_url($v['aid'],$a['suitid'],$a['day']),
                        'day_i'=>$v['lineday'],
                        'money_f'=>$v['price'],
                        'leader'=>array(
                            "hikerId"=>$leader['id'],
                            "nickname"=>$leader['nickname'],
                            "headImgUrl"=>$leader['litpic'] ? $leader['litpic'] : Common::member_nopic(),
                        ),
                    );
                }
            }
            $highlights=array();
            if (!empty($v['attrlist'])){
                foreach ($v['attrlist'] as $item){
                    if ($item['pid']==151){
                        $highlights[]=array(
                            'id'=>$item['id'],
                            'name'=>$item['attrname'],
                            'icon'=>$item['litpic']
                        );
                    }
                }
            }
            $res['list'][]=array(
                "activity_name"=> $v['title'],
                "small_imageurl_s"=> $v['litpic'],
                "money_f"=> $v['price'],
                "imageurl_s"=> $v['litpic'],
                "id"=> $v['id'],
                "name"=> $v['title'],
                "url"=> $v['url'],
                "day_i"=> $v['lineday'],
                'person_count'=>$v['sellnum'],
                'satisfyscore'=>$v['satisfyscore'],
                'stars'=>$v['stars'],
                "times"=> $activitys,
                'highlights'=>$highlights,
                'tips'=>array(),
            );
        }
        echo json_encode($res);
    }

    public function action_domestic(){
        $this->display('line/domestic');
    }

    public function action_overseas(){
        $this->display('line/overseas');
    }

    public function action_hk(){
        $this->display('line/hk');
    }

    public function action_child(){
        $this->display('line/child');
    }

    public function action_newcomer(){
        $this->display('line/newcomer');
    }


    /**
     * 创建订单
     */
    public function action_ajax_create()
    {

        $res=array();
        $member = Common::session('member');
        $user=Model_Member::get_member_byid($member['mid']);
        if ($user){
            $_POST['startdate']=date('Y-m-d',$_POST['startdate']);
            $_POST['linkman']=$user['nickname'];
            $_POST['linktel']=$user['mobile'];
            $_POST['linkidcard']=$user['cardid'];

            $_POST['usejifen']=$_POST['useScore']!=0?1:0;
            $people_num=0;
            for ($i=0;$i<=30;$i++){
                if (Arr::get($_POST,'idcard'.$i,array())){
                    $name=Arr::get($_POST,'realname'.$i,'');
                    $tel=Arr::get($_POST,'tel'.$i,'');
                    $idcard=Arr::get($_POST,'idcard'.$i,'');
                    $_POST['tourname'][]=$name;
                    $_POST['tourmobile'][]=$tel;
                    $_POST['touridcard'][]=$idcard;
                    $people_num++;
                }
            }

            //套餐id
            $suitid = Arr::get($_POST, 'suitid');
            //联系人
            $linkman = Arr::get($_POST, 'linkman');
            //手机号
            $linktel = Arr::get($_POST, 'linktel');
            $linkidcard = Arr::get($_POST, 'linkidcard');
            //备注信息
            $remark = Arr::get($_POST, 'remark');
            //产品id
            $id = Arr::get($_POST, 'productid');
            //出行时间
            $startdate = Arr::get($_POST, 'startdate');

            //成人数量
            $dingnum = $people_num;
            $childnum=0;
            $oldnum=0;

            $info = ORM::factory('line')->where("id=$id")->find()->as_array();
            $suitArr = ORM::factory('line_suit')
                ->where("id=:suitid")
                ->param(':suitid', $suitid)
                ->find()
                ->as_array();
            $suitArr['dingjin'] = Currency_Tool::price($suitArr['dingjin']);
            $priceArr = ORM::factory('line_suit_price')->where("day=" . strtotime($startdate) . " and suitid=" . $suitid)->find()->as_array();

            $priceArr['adultprice'] = Currency_Tool::price($priceArr['adultprice']);
            $priceArr['childprice'] = Currency_Tool::price( $priceArr['childprice']);
            $priceArr['oldprice'] = Currency_Tool::price($priceArr['oldprice']);

            //库存判断
            $totalnum = $dingnum + $childnum + $oldnum;
            $storage = intval($priceArr['number']);
            if ($storage != -1 && $storage < $totalnum)
            {
                $res['errcode']=1;
                $res['errmsg']='抱歉，已经满人了';
                echo json_encode($res);exit;
            }
            if ($suitArr['paytype'] == '3')//这里补充一个当为二次确认时,修改订单为未处理状态.
            {
                $info['status'] = 0;
            } else
            {
                $info['status'] = 1;
            }
            $info['name'] = $info['title'] . "({$suitArr['suitname']})";
            $info['paytype'] = $suitArr['paytype'];
            $info['dingjin'] = doubleval($suitArr['dingjin']);
            $info['jifentprice'] = intval($suitArr['jifentprice']);
            $info['jifenbook'] = intval($suitArr['jifenbook']);
            $info['jifencomment'] = intval($suitArr['jifencomment']);
            $info['ourprice'] = doubleval($priceArr['adultprice']);
            $info['childprice'] = doubleval($priceArr['childprice']);
            $info['oldprice'] = doubleval($priceArr['oldprice']);
            $info['usedate'] = $startdate;
            $ordersn = Product::get_ordersn('01');
            $arr = array(
                'ordersn' => $ordersn,
                'webid' => 0,
                'typeid' => $this->_typeid,
                'productautoid' => $id,
                'productaid' => $info['aid'],
                'productname' => $info['name'],
                'litpic' => $info['litpic'],
                'price' => $info['ourprice'],
                'childprice' => $info['childprice'],
                'jifentprice' => $info['jifentprice'],
                'jifenbook' => $info['jifenbook'],
                'jifencomment' => $info['jifencomment'],
                'paytype' => $info['paytype'],
                'dingjin' => $info['dingjin'],
                'usedate' => $info['usedate'],
                'departdate' => $info['departdate'],
                'addtime' => time(),
                'memberid' => null,
                'dingnum' => $dingnum,
                'childnum' => $childnum,
                'oldprice' => $info['oldprice'],
                'oldnum' => $oldnum,
                'linkman' => $linkman,
                'linktel' => $linktel,
                'linkidcard' => $linkidcard,
                'suitid' => $suitid,
                'remark' => $remark,
                'status' => $info['status'] ? $info['status'] : 0,
                'usejifen' => $_POST['usejifen'], //学分抵现
                'marshal_point_id'=>$_POST['marshal_point'],
            );
            //添加订单
            if (Product::add_order($arr))
            {
                $orderInfo = Model_Member_Order::get_order_by_ordersn($ordersn);
                Model_Member_Order::add_tourer($orderInfo['id'], $_POST);
                $msg="您好，您的订单已创建，订单号为：{$ordersn},请及时付款，感谢您的支持";
                Model_Member_Message::add_message($member['mid'],"订单:{$ordersn}-创建成功",$msg);

                if (!empty($_POST['distribution_id'])){
                    Model_Distributionrecord::addRecord($_POST['distribution_id'],$orderInfo['id'],true);
                }
                if ($arr['price']>0){

                    $res['errcode']=0;
                    $res['errmsg']='订单创建成功，待付款';
                    $res['redirecturl'] = Common::get_main_host() . "/payment/?ordersn={$ordersn}";
                }else{
                    $model=ORM::factory('member_order')->where('id','=',$orderInfo['id'])->find();
                    $model->status=Model_Member_Order::STATUS_PAY;
                    $model->update();
                    $msg="您好，您的订单已付款成功，订单号为：{$ordersn}";
                    Model_Member_Message::add_message($member['mid'],"订单:{$ordersn}-付款成功",$msg);
                    $url = Common::get_web_url($info['webid']) . '/pub/paystatus/?sign=11';
                    $res['errcode']=0;
                    $res['errmsg']='订单创建成功，并已自动付款';
                    $res['redirecturl'] = $url;

                    Model_Msg::msgOrderPay($orderInfo['id']);



                }
            }else{
                $res['errcode']=1;
                $res['errmsg']='创建订单异常';
            }
        }else{
            $res['errcode']=1;
            $res['errmsg']='请先登录';
        }
        echo json_encode($res);exit;


    }




}