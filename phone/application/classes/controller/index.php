<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Index extends Stourweb_Controller{

    public function before()
    {
        parent::before();
    }

    //首页
    public function action_index()
    {
        Common::check_login();
        //seo信息
        $seoinfo = array(
            'seotitle' => $GLOBALS['cfg_indextitle'],
            'keyword' => $GLOBALS['cfg_keywords'],
            'description' => $GLOBALS['cfg_description']
        );
        //获取栏目名称与开启状态
        $city_list=Model_Startplace::get_city_list();
        $channel = Model_Nav::get_all_channel_info();
        $indexmodule1=Model_Indexmodule::getRecommend(1,0,18);
        $indexmodule4=Model_Indexmodule::getDayTrip(0,3);
        $top_msg=Model_Member_Order::get_order(1,2);
        $this->assign('curnav', 'index');
        $this->assign('city_id',Arr::get($_GET,'cid',0));
        $this->assign('city_list',$city_list);
        $this->assign('top_msg',$top_msg);
        $this->assign('indexmoudle4',$indexmodule4);
        $this->assign('indexmodule1',$indexmodule1);
        $this->assign('channel',$channel);
        $this->assign('seoinfo',$seoinfo);
        $this->display('index');
    }

    public function action_ajax_gettabmoduledata()
    {
        $type=Arr :: get($_POST, 'id');
        $res=array(
            "status"=>1,
            "msg"=>"",
            'datas'=>array()
        );
        $data=Model_Indexmodule::getRecommend($type,0,18);
        if ($data && is_array($data)){
            foreach ($data as $v){
                $t=$v['status'];
                $t['city']=$v['startcity'];
                $t['city_id']=$v['startcity_id'];
                $t=array(
                    "id"=>$v['id'],
                    "title"=>$v['index_title'],
                    "imgUrl"=>$v['index_litpic'],
                    "url"=>$v['url'],
                    "sub_title"=>$v['index_sub_title'],
                    "count"=>$v['sellnum'],
                    "score"=>$v['stars'],
                    "stars"=>$v['stars'],
                    "start_time"=>Common::date_text_week($v['day']),
                    "status"=>$t,
                    "show_style"=>1,
                    "show_type"=>0
                );
                $res['datas'][]=$t;
            }
        }
        echo json_encode($res);
    }

    public function action_ajax_index_page(){
        $page=Arr :: get($_POST, 'page');
        $res=array(
            "status"=>1,
            "msg"=>"",
            'data'=>array()
        );
        if (!empty($page)){
            $modules=Model_Indexmodule::get_module_by_group($page);
            if (!empty($modules)){
                foreach ($modules as $module){
                    $line_list=Model_Indexmodule::getLine($module['id'],0,6);
                    $items=array();
                    switch ($module['type']){
                        case 27:
                        case 31:
                            if ($line_list){
                                foreach ($line_list as $v){
                                    $items[]=array(
                                        "id"=>$v['id'],
                                        "title"=>$v['index_title'],
                                        "imgUrl"=>$v['index_litpic'],
                                        "url"=>$v['url'],
                                        "sub_title"=>$v['index_sub_title'],
                                        "description"=>$v['description'],
                                        "count"=>$v['sellnum'],
                                        "score"=>$v['stars'],
                                        "stars"=>$v['stars'],
                                        "status"=>$v['status']
                                    );
                                }
                            }
                            break;
                        case 20:
                            if ($line_list){
                                foreach ($line_list as $v){
                                    $activitys=array();
                                    $activitys_list = Model_Line_Suit_Price::get_available_suit_day($v['id']);
                                    if ($activitys_list && is_array($activitys_list)){
                                        foreach ($activitys_list as $a){
                                            $activitys[]=array(
                                                'url'=>Common::_detail_url($v['aid'],$a['suitid'],$a['day']),
                                                "activityId"=>$a['suitid'],
                                                "startTime"=>date('m月d',$a['day']),
                                                "endTime"=>date('m月d',$a['day']+($v['lineday']*86400)),
                                                "name"=>$v['title'],
                                                "status"=>$a['status']
                                            );
                                        }
                                    }
                                    $line=array(
                                        "id"=>$v['id'],
                                        "position"=>"1",
                                        "title"=>$v['index_title'],
                                        "sub_title"=>$v['index_sub_title'],
                                        "imgUrl"=>$v['index_litpic'],
                                        "status"=>"1",
                                        "url"=>$v['url'],
                                        "activitys"=>$activitys,
                                        "score"=>$v['stars'],
                                        "stars"=>$v['stars'],
                                        "count"=>$v['sellnum']
                                    );
                                    $items[]=$line;
                                }
                            }
                    }

                    if ($items){
                        $res['data'][]=array(
                            "id"=>$module['id'],
                            "name"=>$module['name'],
                            "position"=>$module['position'],
                            "type"=>$module['type'],
                            "url"=>null,
                            "before_desc"=>null,
                            "after_desc"=>null,
                            "status"=>$module['status'],
                            "sub_title"=>$module['sub_name'],
                            "show_type"=>$module['show_type'],
                            "items"=>$items
                        );
                    }

                }


            }
        }

        echo json_encode($res);
    }

    public function action_ajax_looknew()
    {
        $page=Arr :: get($_POST, 'page');
        $res=array(
            "status"=>1,
            'items'=>array(),
            "page"=> $page,
            "lastPage"=> $page+1
        );
        $page=intval($page);
        $page=!empty($page)?$page:1;
        $size=10;
        $offset=($page-1)*$size;
        $data=Model_Indexmodule::getLine(Model_Indexmodule::I_LOOK,$offset,$size);
        if ($data && is_array($data)){
            foreach ($data as $v){
                $activitys=array();
                $activitys_list = Model_Line_Suit_Price::get_available_suit_day($v['id']);
//                Common::dd($v);
                $times=array();
                if ($activitys_list && is_array($activitys_list)){
                    foreach ($activitys_list as $a){
                        $activitys[]=array(
                            "activity_name"=> $v['index_title'],
                            "small_imageurl_s"=> $v['index_litpic'],
                            "imageurl_s"=> $v['index_litpic'],
                            "id"=> $a['suitid'],
                        );
                        $times[]=date('m月d',$a['day']);
                    }
                }
                $res['items'][]=array(
                    'activitys'=>$activitys,
                    'goNum'=>$v['sellnum'],
                    'score'=>$v['stars'],
                    'times'=>implode(",",$times),
                    'url'=>$v['url']
                );
            }
        }
        echo json_encode($res);
    }


}