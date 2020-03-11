<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Line
 * 线路分类控制器
 */
class Controller_Linecate extends Stourweb_Controller
{

    /**
     * 线路首页
     */
    public function action_index()
    {
        //别问我为啥不按父类取，详情请看view
        $category_id=array(
            45=>'classList',
            84=>'difficultyList',
            91=>'dayList'
        );
        $category=array();
        foreach ($category_id as $id=>$type){
            $data=Model_Line_Attr::get_sub_by_pid($id);
            if (!empty($data) && !empty($type)){
                foreach ($data as $item){
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
        //别问我为啥不按父类取，详情请看view
        $destinations_is=array(
            36=>'inlandList',
            37=>'international'
        );
        $destinations=array();
        foreach ($destinations_is as $id=>$type){
            $data=Model_Destinations::get_sub_by_pid($id);
            if (!empty($data) && !empty($type)){
                foreach ($data as $item){
                    $destinations[$type][]=array(
                        "id"=> $item['id'],
                        "title"=> $item['kindname'],
                        "img"=> Common::img($item['litpic'],185,120),
                        "share_title"=> "茄子户外运动·{$item['kindname']}路线",
                        "share_desc"=> "点击本链接可查看全部{$item['kindname']}的路线哦 (*\/ω＼*)\n",
                        "status"=> "1",
                        "search"=> $item['kindname']
                    );
                }
            }
        }
        $this->assign('curnav', 'cate');
        $this->assign('category', $category);
        $this->assign('destinations', $destinations);
        $this->assign('seoinfo', array());
        $this->display('linecate/index');
    }


    public function action_ajax_classify(){
        $id=Arr :: get($_POST, 'id');
        $res=array(
            "status"=> 1,
            "fanpai_list"=> array(),
            'list'=>array(),
            'old_list'=>array()
        );
        if ($id){
            $line=Model_Line::get_line_by_attr($id,0,20);
            foreach ($line as $v){
                $activitys_list = Model_Line_Suit_Price::get_available_suit_day($v['id']);
//                Common::dd($v);
                $times=array();
                if ($activitys_list && is_array($activitys_list)){
                    foreach ($activitys_list as $a){
                        $times[]=$a['day'];
                    }
                }
                $res['list'][]=array(
                    "activity_name"=> $v['title'],
                    "small_imageurl_s"=> $v['litpic'],
                    "money_f"=> Common::price($v['price']),
                    "imageurl_s"=> $v['litpic'],
                    "id"=> $v['id'],
                    "name"=> $v['title'],
                    "url"=> $v['url'],
                    "times"=> $times
                );
            }
        }
        echo json_encode($res);
    }

    public function action_ajax_line_by_city(){
        $res=array(
            "status"=> 1,
            "fanpai_list"=> array(),
            'list'=>array(),
            'old_list'=>array()
        );
        $id=Arr :: get($_POST, 'id');
        if ($id){
            $line=Model_Line::get_line_by_city($id,0,20);
            foreach ($line as $v){
                $activitys_list = Model_Line_Suit_Price::get_available_suit_day($v['id']);
//                Common::dd($v);
                $times=array();
                if ($activitys_list && is_array($activitys_list)){
                    foreach ($activitys_list as $a){
                        $times[]=$a['day'];
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
                    "times"=> $times
                );
            }
        }
        echo json_encode($res);
    }



}