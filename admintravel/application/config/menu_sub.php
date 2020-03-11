<?php

return array(
    'newproduct' => array(
        'line' => array(
            'name' => '线路',
            'url' => 'line/line/parentkey/product/itemid/1',
            'itemid' => '1',
            'flag' => 'line',
            'order' => 'order/index/parentkey/order/itemid/1/typeid/1',
            'add' => 'line/add/parentkey/product/itemid/1'
        ),
        'mall' => array(
            'name' => '装备商城',
            'url' => 'mall/mall/parentkey/product/itemid/'.Model_Mall::TYPE_ID,
            'itemid' => Model_Mall::TYPE_ID,
            'flag' => 'mall',
            'order' => 'order/index/parentkey/order/itemid/202/typeid/202',
            'add' => 'line/add/parentkey/product/itemid/1'
        ),
        'leader' => array(
            'name' => '领队',
            'url' => 'leader/list/parentkey/product/itemid/'.Model_Leader::TYPE_ID,
            'itemid' => Model_Leader::TYPE_ID,
            'flag' => 'leader',
            'order' => 'order/index/parentkey/order/itemid/303/typeid/303',
            'add' => 'line/add/parentkey/product/itemid/1'
        ),
//        'hotel' => array(
//            'name' => '酒店',
//            'url' => 'hotel/hotel/parentkey/product/itemid/2',
//            'flag' => 'hotel',
//            'itemid' => '2',
//            'order' => 'order/index/parentkey/order/itemid/2/typeid/2',
//            'add' => 'hotel/add/parentkey/product/itemid/2'
//
//        ),
//        'car' => array(
//            'name' => '租车',
//            'url' => 'car/car/parentkey/product/itemid/3',
//            'itemid' => '3',
//            'flag' => 'car',
//            'order' => 'order/index/parentkey/order/itemid/3/typeid/3',
//            'add' => 'car/add/parentkey/product/itemid/3'
//
//        ),
//        'spot' => array(
//            'name' => '门票',
//            'url' => 'spot/spot/parentkey/product/itemid/4',
//            'itemid' => '4',
//            'flag' => 'spot',
//            'order' => 'order/index/parentkey/order/itemid/5/typeid/5',
//            'add' => 'spot/add/parentkey/product/itemid/4'
//
//        ),
//        'visa' => array(
//            'name' => '签证',
//            'url' => 'visa/visa/parentkey/product/itemid/5',
//            'itemid' => '5',
//            'flag' => 'visa',
//            'order' => 'order/index/parentkey/order/itemid/8/typeid/8',
//            'add' => 'visa/add/parentkey/product/itemid/5'
//
//        ),
//        'tuan' => array(
//            'name' => '团购',
//            'url' => 'tuan/tuan/parentkey/product/itemid/6',
//            'itemid' => '6', 'flag' => 'tuan',
//            'order' => 'order/index/parentkey/order/itemid/13/typeid/13',
//            'add' => 'tuan/add/parentkey/product/itemid/6'
//        ),
//        'insurance' => array(
//            'name' => '保险',
//            'url' => 'insurance/index/parentkey/product/itemid/9',
//            'itemid' => '7', 'flag' => 'insurance',
//            'order' => 'insurance/book/parentkey/order/itemid/7/typeid/7',
//        )
    ),
    'product' => array(
        'line' => array('name' => '线路', 'url' => 'line/line/parentkey/product/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-46.png'),
        'mall' => array('name' => '装备商城', 'url' => 'mall/mall/parentkey/product/itemid/'.Model_Mall::TYPE_ID, 'itemid' => Model_Mall::TYPE_ID, 'ico' => ''),
        'leader' => array('name' => '领队', 'url' => 'leader/list/parentkey/product/itemid/'.Model_Leader::TYPE_ID, 'itemid' =>Model_Leader::TYPE_ID, 'ico' => 'chindren-ico-46.png'),
//        'hotel' => array('name' => '酒店', 'url' => 'hotel/hotel/parentkey/product/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-18.png'),
//        'car' => array('name' => '租车', 'url' => 'car/car/parentkey/product/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-58.png'),
//        'spot' => array('name' => '门票', 'url' => 'spot/spot/parentkey/product/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-21.png'),
//        'visa' => array('name' => '签证', 'url' => 'visa/visa/parentkey/product/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-27.png'),
//        'tuan' => array('name' => '团购', 'url' => 'tuan/tuan/parentkey/product/itemid/6', 'itemid' => '6', 'ico' => 'chindren-ico-36.png'),
//        'ticket' => array('name' => '机票', 'url' => 'ticket/ctrip/parentkey/product/itemid/7', 'itemid' => '7', 'ico' => 'chindren-ico-jp.png'),
//        'jieban' => array('name' => '结伴', 'url' => 'jieban/index/parentkey/product/itemid/8', 'itemid' => '8', 'ico' => 'jieban.png'),
//        'baoxian' => array('name' => '保险', 'url' => 'jieban/index/parentkey/product/itemid/9', 'itemid' => '9', 'ico' => 'jieban.png')

    ),
    'article' => array(
//        'article' => array('name' => '攻略', 'url' => 'article/article/parentkey/article/itemid/1', 'itemid' => '1', 'ico' => 'wz-ico.png'),
//        'spot2' => array('name' => '景点', 'url' => 'spot/spot/parentkey/article/itemid/2', 'itemid' => '2', 'ico' => 'jd-ico.png'),
        'notes' => array('name' => '游记', 'url' => 'notes/index/parentkey/article/itemid/3', 'itemid' => '3', 'ico' => 'yj-ico.png'),
//        'jieban' => array('name' => '结伴', 'url' => 'jieban/index/parentkey/article/itemid/9', 'itemid' => '9', 'ico' => 'jb-ico.png'),
        'zhuanti' => array('name' => '专题', 'url' => 'zhuanti/list/parentkey/article/itemid/8', 'itemid' => '8', 'ico' => 'zt-ico.png'),
        'photo' => array('name' => '相册', 'url' => 'photo/photo/parentkey/article/itemid/4', 'itemid' => '4', 'ico' => 'xc-ico.png'),
        'question' => array('name' => '问答', 'url' => 'question/index/parentkey/article/itemid/5', 'itemid' => '5', 'ico' => 'wd-ico.png'),
        'pinlun' => array('name' => '评论', 'url' => 'comment/index/parentkey/article/itemid/6', 'itemid' => '6', 'ico' => 'pl-ico.png'),
//        'help' => array('name' => '帮助', 'url' => 'help/list/parentkey/article/itemid/7', 'itemid' => '7', 'ico' => 'bz-ico.png'),
    ),
    'order' => array(
        'lineorder' => array('name' => '线路订单', 'url' => 'order/index/parentkey/order/itemid/1/typeid/1', 'itemid' => '1', 'ico' => 'chindren-ico-46.png'),
        'orderrefund' => array('name' => '退款订单', 'url' => 'orderrefund/index', 'itemid' => '0', 'ico' => 'chindren-ico-46.png'),
//        'hotelorder' => array('name' => '酒店订单', 'url' => 'order/index/parentkey/order/itemid/2/typeid/2', 'itemid' => '2', 'ico' => 'chindren-ico-18.png'),
//        'carorder' => array('name' => '租车订单', 'url' => 'order/index/parentkey/order/itemid/3/typeid/3', 'itemid' => '3', 'ico' => 'chindren-ico-58.png'),
//        'spotorder' => array('name' => '门票订单', 'url' => 'order/index/parentkey/order/itemid/4/typeid/5', 'itemid' => '4', 'ico' => 'chindren-ico-21.png'),
//        'visaorder' => array('name' => '签证订单', 'url' => 'order/index/parentkey/order/itemid/5/typeid/8', 'itemid' => '5', 'ico' => 'chindren-ico-27.png'),
//        'tuanorder' => array('name' => '团购订单', 'url' => 'order/index/parentkey/order/itemid/6/typeid/13', 'itemid' => '6', 'ico' => 'chindren-ico-36.png'),
        'dzorder' => array('name' => '定制订单', 'url' => 'order/dz/parentkey/order/itemid/7/', 'itemid' => '7', 'ico' => 'chindren-ico-48.png'),
//        'xyorder' => array('name' => '自定义订单', 'url' => 'order/xy/parentkey/order/itemid/8/', 'itemid' => '8', 'ico' => 'chindren-ico-61.png'),
//        'insorder' => array('name' => '保险订单', 'url' => 'insurance/book/parentkey/order/itemid/9/', 'itemid' => '9')
        'mallrder' => array('name' => '商城订单', 'url' => 'order/index/parentkey/order/itemid/202/typeid/202', 'itemid' => '202', 'ico' => 'chindren-ico-48.png'),
        'leadercounty' => array('name' => '领队赏金', 'url' => 'order/index/parentkey/order/itemid/303/typeid/303', 'itemid' => '303', 'ico' => 'chindren-ico-48.png'),

    ),
    'basic' => array(
//        'nav' => array('name' => '主导航', 'url' => 'config/mainnav/parentkey/basic/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-56.png'),
//        'usernav' => array('name' => '自定义导航', 'url' => 'app/topusernav/parentkey/basic/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-63.png'),
//        'footernav' => array('name' => '底部导航', 'url' => 'footernav/index/parentkey/basic/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-06.png'),
//        'footer' => array('name' => '网页底部', 'url' => 'config/footer/parentkey/basic/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-37.png'),
//        'logo' => array('name' => 'logo设置', 'url' => 'config/logo/parentkey/basic/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-59.png'),
//        'index' => array('name' => '首页设置', 'url' => 'config/base/parentkey/basic/itemid/6', 'itemid' => '6', 'ico' => 'chindren-ico-30.png'),
//        'gonggao' => array('name' => '公告设置', 'url' => 'config/gonggao/parentkey/basic/itemid/7', 'itemid' => '7', 'ico' => 'chindren-ico-10.png'),
//        'kefu' => array('name' => '客服设置', 'url' => 'kefu/phone/parentkey/basic/itemid/8', 'itemid' => '8', 'ico' => 'chindren-ico-19.png'),
//        'webico' => array('name' => '网站头像', 'url' => 'config/webico/parentkey/basic/itemid/9', 'itemid' => '9', 'ico' => 'chindren-ico-68.png'),
//        'flink' => array('name' => '友情链接', 'url' => 'friendlink/list/parentkey/basic/itemid/10', 'itemid' => '10', 'ico' => 'chindren-ico-50.png'),
//        'advertise' => array('name' => '广告策略', 'url' => 'advertise/index/parentkey/basic/itemid/11', 'itemid' => '12', 'ico' => 'chindren-ico-13.png'),
//        'tongji' => array('name' => '统计代码', 'url' => 'config/tongji/parentkey/basic/itemid/13', 'itemid' => '13', 'ico' => 'chindren-ico-34.png'),
//        'templet' => array('name' => '模板管理', 'url' => 'templet/index/parentkey/basic/itemid/14', 'itemid' => '14', 'ico' => 'chindren-ico-22.png'),
//        'module' => array('name' => '模块管理', 'url' => 'module/index/parentkey/basic/itemid/15', 'itemid' => '15', 'ico' => 'chindren-ico-24.png')
    ),
    //分类设置
    'kind' => array(
        'destination' => array('name' => '目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-04.png'),
        'startplace' => array('name' => '出发地', 'url' => 'startplace/index/parentkey/kind/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-25.png'),
//        'line' => array('name' => '线路分类', 'url' => 'line/price/parentkey/kind/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-46.png'),
//        'hotel' => array('name' => '酒店分类', 'url' => 'hotel/rank/parentkey/kind/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-18.png'),
//        'car' => array('name' => '租车分类', 'url' => 'car/price/parentkey/kind/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-58.png'),
//        'spot' => array('name' => '门票分类', 'url' => 'spot/price/parentkey/kind/itemid/6', 'itemid' => '6', 'ico' => 'chindren-ico-21.png'),
//        'visa' => array('name' => '签证分类', 'url' => 'visa/visatype/parentkey/kind/itemid/7', 'itemid' => '7', 'ico' => 'chindren-ico-27.png'),
//        'tuan' => array('name' => '团购分类', 'url' => 'attrid/list/parentkey/kind/itemid/8/typeid/13', 'itemid' => '8', 'ico' => 'chindren-ico-36.png'),
//        'article' => array('name' => '文章分类', 'url' => 'attrid/list/parentkey/kind/itemid/9/typeid/4', 'itemid' => '9', 'ico' => 'chindren-ico-40.png'),
        'photo' => array('name' => '相册', 'url' => 'attrid/list/parentkey/kind/itemid/10/typeid/6', 'itemid' => '10', 'ico' => 'chindren-ico-47.png'),
//        'helpkind1' => array('name' => '帮助分类', 'url' => 'help/kind/parentkey/kind/itemid/11', 'itemid' => '11', 'ico' => 'chindren-ico-02.png'),
//        'supplier' => array('name' => '供应商分类', 'url' => 'supplier/kind/parentkey/kind/itemid/12', 'itemid' => '12', 'ico' => 'chindren-ico-02.png'),
//        'jieban' => array('name' => '结伴分类', 'url' => 'attrid/list/parentkey/kind/itemid/13/typeid/11', 'itemid' => '13', 'ico' => 'chindren-ico-02.png')
    ),
    'kindright' => array(
        'destination' => array('name' => '目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-04.png'),
        'startplace' => array('name' => '出发地', 'url' => 'startplace/index/parentkey/kind/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-25.png')
    ),

    'hotelkind' => array(
//        'hotelrank' => array('name' => '酒店星级', 'url' => 'hotel/rank/parentkey/kind/itemid/4', 'itemid' => '4'),
//        'hotelprice' => array('name' => '价格分类', 'url' => 'hotel/price/parentkey/kind/itemid/4', 'itemid' => '4'),
//        'hotelattr' => array('name' => '属性分类', 'url' => 'attrid/list/parentkey/kind/itemid/4/typeid/2', 'itemid' => '4'),
//        'hoteljieshao' => array('name' => '内容介绍', 'url' => 'attrid/content/parentkey/kind/itemid/4/typeid/2', 'itemid' => 4),
//        'hoteldest' => array('name' => '酒店目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/2', 'itemid' => 1),
//        'hotelextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/4/typeid/2', 'itemid' => 4)
    ),
    'linekind' => array(
//        'lineprice' => array('name' => '价格分类', 'url' => 'line/price/parentkey/kind/itemid/3', 'itemid' => '3'),
//        'lineday' => array('name' => '天数分类', 'url' => 'line/day/parentkey/kind/itemid/3', 'itemid' => '3'),
        'lineattr' => array('name' => '属性分类', 'url' => 'attrid/list/parentkey/kind/itemid/3/typeid/1', 'itemid' => '3'),
//        'linejieshao' => array('name' => '内容介绍', 'url' => 'attrid/content/parentkey/kind/itemid/3/typeid/1', 'itemid' => 3),
//        'linedest' => array('name' => '线路目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/1', 'itemid' => 1),
//        'lineextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/3/typeid/1', 'itemid' => 3)

    ),
    'carkind' => array(
//        'carprice' => array('name' => '价格分类', 'url' => 'car/price/parentkey/kind/itemid/5', 'itemid' => '5'),
//        'cartype' => array('name' => '车型分类', 'url' => 'car/kind/parentkey/kind/itemid/5', 'itemid' => '5'),
//        'carattr' => array('name' => '属性分类', 'url' => 'attrid/list/parentkey/kind/itemid/5/typeid/3', 'itemid' => '5'),
//        'carjieshao' => array('name' => '内容介绍', 'url' => 'attrid/content/parentkey/kind/itemid/5/typeid/3', 'itemid' => '4'),
//        'cardest' => array('name' => '租车目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/3', 'itemid' => '1'),
//        'carextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/5/typeid/3', 'itemid' => '5')
    ),
    'spotkind' => array(
//        'spotprice' => array('name' => '门票价格分类', 'url' => 'spot/price/parentkey/kind/itemid/6', 'itemid' => '6'),
//        'spotattr' => array('name' => '门票属性分类', 'url' => 'attrid/list/parentkey/kind/itemid/6/typeid/5', 'itemid' => '6'),
//        'spotjieshao' => array('name' => '内容介绍', 'url' => 'attrid/content/parentkey/kind/itemid/6/typeid/5', 'itemid' => 6,),
//        'spotdest' => array('name' => '景点目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/5', 'itemid' => 1),
//        'spotextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/6/typeid/5', 'itemid' => 6)
    ),
    'spotticketkind' => array(
//        'ticketlist' => array('name' => '门票列表', 'url' => 'spot/ticket/parentkey/kind/itemid/6', 'itemid' => '6'),
//        'tickettype' => array('name' => '门票类型', 'url' => 'spot/tickettype/parentkey/kind/itemid/6', 'itemid' => '6')
    ),

    'visakind' => array(
//        'visatype' => array('name' => '签证类型', 'url' => 'visa/visatype/parentkey/kind/itemid/7', 'itemid' => '7'),
//        'visaarea' => array('name' => '签证区域', 'url' => 'visa/visaarea/parentkey/kind/itemid/7', 'itemid' => '7'),
//        'visacity' => array('name' => '签发城市', 'url' => 'visa/visacity/parentkey/kind/itemid/7', 'itemid' => '7'),
//        'visajieshao' => array('name' => '内容介绍', 'url' => 'attrid/content/parentkey/kind/itemid/6/typeid/8', 'itemid' => 7),
//        'visaextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/7/typeid/8', 'itemid' => 7)

    ),

    'tuankind' => array(
//        'tuanattr' => array('name' => '团购属性', 'url' => 'attrid/list/parentkey/kind/itemid/8/typeid/13', 'itemid' => '8'),
//        'tuandest' => array('name' => '团购目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/13', 'itemid' => 1),
//        'tuanjieshao' => array('name' => '内容介绍', 'url' => 'attrid/content/parentkey/kind/itemid/8/typeid/13', 'itemid' => 8),
//        'tuanextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/8/typeid/13', 'itemid' => 8)
    ),
    'articlekind' => array(
        'articleattr' => array('name' => '文章属性', 'url' => 'attrid/list/parentkey/kind/itemid/9/typeid/4', 'itemid' => '9'),
        'articledest' => array('name' => '文章目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/4', 'itemid' => 1),
        'articleextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/9/typeid/4', 'itemid' => 9)
    ),
    'photokind' => array(
        'photoattr' => array('name' => '相册属性', 'url' => 'attrid/list/parentkey/kind/itemid/10/typeid/6', 'itemid' => '10'),
//        'photodest' => array('name' => '相册目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/6', 'itemid' => 1),
//        'photoextend' => array('name' => '扩展字段', 'url' => 'attrid/extendlist/parentkey/kind/itemid/10/typeid/6', 'itemid' => 10)
    ),
    'helpkind' => array(
//        'helpattr' => array('name' => '帮助分类', 'url' => 'help/kind/parentkey/kind/itemid/11', 'itemid' => '11')
    ),
    'kefukind' => array(
//        'phone' => array('name' => '客服电话', 'url' => 'kefu/phone/parentkey/basic/itemid/8', 'itemid' => '8'),
//        'hotelprice' => array('name' => 'QQ客服', 'url' => 'kefu/qq/parentkey/basic/itemid/8', 'itemid' => '8'),
//        'hotelattr' => array('name' => '第三方客服', 'url' => 'kefu/other/parentkey/basic/itemid/8', 'itemid' => '8'),
    ),
    'jiebankind' => array(
//        'jiebanattr' => array('name' => '结伴主题', 'url' => 'attrid/list/parentkey/kind/itemid/13/typeid/11', 'itemid' => '13', 'selected' => 1),
//        'jiebandest' => array('name' => '结伴目的地', 'url' => 'destination/destination/parentkey/kind/itemid/1/typeid/11', 'itemid' => 1),
    ),
    'mallkind' => array(
//        'hotelrank' => array('name' => '酒店星级', 'url' => 'mall/rank/parentkey/kind/itemid/'.Model_Mall::TYPE_ID, 'itemid' => Model_Mall::TYPE_ID),
        'hotelattr' => array('name' => '属性分类', 'url' => 'attrid/list/parentkey/kind/itemid/'.Model_Mall::TYPE_ID.'/typeid/'.Model_Mall::TYPE_ID, 'itemid' => Model_Mall::TYPE_ID),
    ),
    'member' => array(
        'member' => array('name' => '会员管理', 'url' => 'member/index/parentkey/member/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-14.png'),
        'membergrade' => array('name' => '会员等级', 'url' => 'membergrade/index/parentkey/member/itemid/2', 'itemid' => 2, 'ico' => 'chindren-ico-14.png'),
        'lineapply' => array('name' => '自主发布', 'url' => 'lineapply/list', 'itemid' => 3, 'ico' => 'chindren-ico-14.png'),
//        'supplier' => array('name' => '供应商管理', 'url' => 'supplier/index/parentkey/member/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-11.png'),
//        'user' => array('name' => '管理员权限', 'url' => 'user/list/parentkey/member/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-62.png'),
        'exchange' => array('name' => '学分策略', 'url' => 'exchange/set/parentkey/member/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-67.png'),
    ),
    'interface' => array(
        'pay' => array('name' => '支付接口', 'url' => 'config/payset/parentkey/interface/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-52.png'),
//        'msg' => array('name' => '短信接口', 'url' => 'sms/index/parentkey/interface/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-42.png'),
//        'email' => array('name' => '邮箱接口', 'url' => 'email/index/parentkey/interface/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-40.png'),
        'thirdpart' => array('name' => '第三方登陆', 'url' => 'config/thirdpart/parentkey/interface/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-29.png'),
//        'jipiao' => array('name' => '机票接口', 'url' => 'ticket/ctrip/parentkey/interface/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-52.png'),
//        'insurance' => array('name' => '保险接口', 'url' => 'insurance/huizhe/parentkey/interface/itemid/6', 'itemid' => '6', 'ico' => 'chindren-ico-52.png'),
//        'ucenter' => array('name' => 'ucenter配置', 'url' => 'config/ucenter/parentkey/interface/itemid/7', 'itemid' => '7', 'ico' => 'chindren-ico-66.png'),
    ),
    'system' => array(
//        'payment' => array('name' => '签约流程', 'url' => 'config/payment/parentkey/system/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-26.png'),
//        'ordermail' => array('name' => '订单提醒', 'url' => 'config/ordermail/parentkey/system/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-41.png'),
//        'weibo' => array('name' => '微信微博', 'url' => 'config/wx/parentkey/system/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-38.png'),
//        'icon' => array('name' => '图标管理', 'url' => 'icon/index/parentkey/system/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-35.png'),
//        'water' => array('name' => '水印设置', 'url' => 'config/watermark/parentkey/system/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-33.png'),
//        'nophoto' => array('name' => '无图设置', 'url' => 'config/nopic/parentkey/system/itemid/6', 'itemid' => '6', 'ico' => 'chindren-ico-43.png'),
        'sys' => array('name' => '系统参数', 'url' => 'config/syspara/parentkey/system/itemid/7', 'itemid' => '7', 'ico' => 'chindren-ico-44.png'),
//        'databack' => array('name' => '数据备份', 'url' => 'databackup/index/parentkey/system/itemid/8', 'itemid' => '8', 'ico' => 'chindren-ico-31.png'),
//        'htaccess' => array('name' => '伪静态配置', 'url' => 'config/htaccess/parentkey/system/itemid/9', 'itemid' => '9', 'ico' => 'weijingtai.png'),
//        'model' => array('name' => '扩展产品', 'url' => 'model/index/parentkey/system/itemid/10', 'itemid' => '10', 'ico' => 'moxing.png'),
        'image' => array('name' => '图片管理', 'url' => 'image/index/parentkey/system/itemid/11', 'itemid' => '11', 'ico' => 'N_03.gif'),
        'examquestions' => array('name' => '题库管理', 'url' => 'examquestions/list/parentkey/system/itemid/17', 'itemid' => '17', 'ico' => 'N_03.gif'),
//        'partversionmanage' => array('name' => '版本管理', 'url' => 'systemparts/index/parentkey/system/itemid/12', 'itemid' => '12', 'ico' => 'N_03.gif', 'flag' => "new"),
//        'currency' => array('name' => '汇率管理', 'url' => 'currency/config/parentkey/system/itemid/13', 'itemid' => '13', 'ico' => 'chindren-ico-51.png'),
//        'site' => array('name' => '子站管理', 'url' => 'site/index/parentkey/system/itemid/14', 'itemid' => '14', 'ico' => 'chindren-ico-51.png'),
//        'authright' => array('name' => '授权管理', 'url' => 'config/authright/parentkey/system/itemid/15', 'itemid' => '15', 'ico' => 'chindren-ico-51.png'),
//        'log' => array('name' => '操作日志', 'url' => 'userlog/index/parentkey/system/itemid/16', 'itemid' => '16', 'ico' => 'chindren-ico-03.png')
    ),
    'application' => array(
//        'upgrade' => array('name' => '系统升级', 'url' => 'upgrade/index/parentkey/application/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-45.png'),
//        'contact' => array('name' => '服务合同', 'url' => 'app/other/parentkey/application/itemid/2/type/contract', 'itemid' => '2', 'ico' => 'chindren-ico-09.png'),
//        'templetmall' => array('name' => '模板商城', 'url' => 'app/other/parentkey/application/itemid/3/type/moban', 'itemid' => '3', 'ico' => 'chindren-ico-23.png'),
//        'mall' => array('name' => '应用商城', 'url' => 'mall/index/parentkey/mall/itemid/5', 'itemid' => '5','ico' => 'N_03.gif', 'flag' => "new"),
//        'myapp'=> array('name' => '我的应用', 'url' => 'mall/app/parentkey/mall/itemid/1', 'itemid' => '1','ico' => 'N_03.gif', 'flag' => "new"),
//        'seoservice' => array('name' => '营销服务', 'url' => 'app/other/parentkey/application/itemid/4/type/seo', 'itemid' => '4', 'ico' => 'chindren-ico-49.png')
    ),
    'mall' => array(
//        'index' => array('name' => '应用商城', 'url' => 'mall/index/parentkey/mall/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-49.png'),
//        'myapp'=> array('name' => '我的应用', 'url' => 'mall/app/parentkey/mall/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-49.png'),
    ),
    'tool' => array(
//        'robots' => array('name' => 'robots设置', 'url' => 'config/robots/parentkey/tool/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-60.png'),
//        'keyword' => array('name' => '关键词统计', 'url' => 'keyword/index/parentkey/tool/itemid/2', 'itemid' => '2', 'ico' => 'chindren-ico-12.png'),
//        'seolink' => array('name' => '智能内链', 'url' => 'toollink/index/parentkey/tool/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-54.png'),
//        'mutititle' => array('name' => '批量Title', 'url' => 'app/mutititle/parentkey/tool/itemid/4', 'itemid' => '4', 'ico' => 'chindren-ico-64.png'),
//        'tagword' => array('name' => 'Tag管理', 'url' => 'tagword/index/parentkey/tool/itemid/5', 'itemid' => '5', 'ico' => 'chindren-ico-01.png'),
//		'tagword' => array('name' => '<script src="http://s19.cnzz.com/stat.php?id=4297110&web_id=4297110" language="JavaScript"></script>', 'url' => 'tagword/index/parentkey/tool/itemid/5', 'itemid' => '10', 'ico' => 'chindren-ico-01.png'),
//        'ourtj' => array('name' => '来源分析', 'url' => 'visit/index/parentkey/tool/itemid/6', 'itemid' => '6', 'ico' => 'chindren-ico-55.png'),
//        'sitemap' => array('name' => 'Sitemap', 'url' => 'sitemap/index/parentkey/tool/itemid/7', 'itemid' => '7', 'ico' => 'chindren-ico-53.png'),
//        'dielink' => array('name' => '死链排查', 'url' => 'sitemap/errorlink/parentkey/tool/itemid/8', 'itemid' => '8', 'ico' => 'chindren-ico-65.png'),
//        'hotsearch' => array('name' => '热搜词分析', 'url' => 'hotsearch/index/parentkey/tool/itemid/9', 'itemid' => '9', 'ico' => 'chindren-ico-28.png'),
    ),
    'mobile' => array(
//        'm_sys' => array('name' => '移动参数', 'url' => 'mobile/sys/parentkey/mobile/itemid/1', 'itemid' => '1', 'ico' => 'chindren-ico-14.png'),
        'm_ad' => array('name' => '移动广告', 'url' => 'advertise5x/index/parentkey/mobile/itemid/2/ismobile/1', 'itemid' => '2', 'ico' => 'chindren-ico-11.png'),
//        'm_nav' => array('name' => '移动导航', 'url' => 'mobile/nav/parentkey/mobile/itemid/3', 'itemid' => '3', 'ico' => 'chindren-ico-62.png'),
//        'm_foot_nav' => array('name' => '底部导航', 'url' => 'footernav/index/parentkey/mobile/itemid/4/ismobile/1', 'itemid' => '4', 'ico' => 'chindren-ico-62.png'),
//        'm_templet' => array('name' => '移动模板', 'url' => 'templet/index/parentkey/mobile/itemid/5/ismobile/1', 'itemid' => '5', 'ico' => 'chindren-ico-62.png')
    ),
    'userdefined' => include(APPPATH . 'config/menu_userdefined.php')
);