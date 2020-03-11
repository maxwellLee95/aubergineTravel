<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Line
 * 线路控制器
 */
class Controller_Flop extends Stourweb_Controller
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
        $nav=array(
            7=>"当季热门",
            8=>"休闲行摄",
            9=>"登山徒步",
            10=>"海岸海岛",
            11=>"骑行攀岩",
            3=>"香港专区",
            4=>"青少年成长",
        );
        $line_list=array();
        foreach ($nav as $id=>$v){
            $line_list[]=Model_Line::get_line_by_themeid(0,30,$id,Model_Line::LINE_TYPE_FLOP,false,true);
        }
        $this->assign('nav', $nav);
        $this->assign('line_list', $line_list);
        $this->assign('curnav', 'flop');
        $this->display('flop/index');
    }

    public function action_search(){

        $this->assign('keyword', Arr::get($_GET,'keyword',''));
        $this->display('flop/search');
    }

    public function action_ajax_dosearch(){
        $keyword=Arr::get($_POST,'keyword','');
        $res=array(
            'status'=>1,
            'data'=>array(),
        );
        $line_list=Model_Line::get_line_by_keyword($keyword,0,30,Model_Line::LINE_TYPE_FLOP);
        if ($line_list){
            foreach ($line_list as $item){
                $res['data'][]=array(
                    "id"=>$item['id'],
                    "title"=>$item['title'],
                    "sub_title"=>$item['sellpoint'],
                    "imageUrl"=>$item['litpic'],
                    "smallImageUrl"=>$item['litpic'],
                    "days"=>$item['lineday'],
                    "success_num"=>$item['number'],
                    "minPersonCount"=>$item['min_person_count'],
                    "difficultyDesc"=>Common::difficulty_desc($item['difficultylevel']),
                    "difficultyFactor"=>$item['difficultylevel'],
                    "url"=>$item['url']
                );
            }
        }
        echo json_encode($res);
    }


    public function action_show(){
        $id = Arr::get($_GET,'aid',0);

        //线路详情
        $info = Model_Line::detail($id);

        //点击率加一
        Product::update_click_rate($id, $this->_typeid);
        //seo
        $seoInfo = Product::seo($info);
        //出发城市
        $info['startcity'] = Model_Startplace::start_city($info['startcity']);
        $this->assign('info', $info);
        $this->assign('seoInfo', $seoInfo);
        $this->display('flop/show');
    }

    public function action_time(){

        $id = Arr::get($_GET,'aid',0);
        //线路详情
        $info = Model_Line::detail($id);

        //点击率加一
        Product::update_click_rate($id, $this->_typeid);
        //seo
        $seoInfo = Product::seo($info);
        //出发城市
        $info['startcity'] = Model_Startplace::start_city($info['startcity']);
        $suit=Model_Line_Suit_Price::get_all_suit_day($info['id'],1);
        $line_days=array();
        $suit_id=0;
        if ($suit){
            $suit_id=$suit[0]['suitid'];
            $line_days=Model_Line_Suit_Price::get_no_leader_suit_by_suitid($suit_id);
        }
        $calendar_data=array();
        $have_activitys_dates=array();
        if ($line_days && is_array($line_days)){
            foreach ($line_days as $row){
                $have_activitys_dates[]=date('Y-m-d',$row['day']);
                $calendar_data[]=array(
                    "id"=> date('Y-m-d',$row['day']),
                    "title"=> Common::price($row['adultprice']),
                    "start"=> date('Y-m-d',$row['day']),
                    "className"=> array("fc-day-content", "fc-day-content-".date('Y-m-d',$row['day']))
                );
            }
        }
//        Common::dd($calendar_data);
        $leader_ids=Model_Leader_Servicedate::get_leader_ids_by_date(date('Y-m-d'),$info['lineday']);
        $leader=Model_Leader::get_leaders($leader_ids);
        $this->assign('calendar_data', $calendar_data);
        $this->assign('have_activitys_dates',$have_activitys_dates);
        $this->assign('suit_id', $suit_id);
        $this->assign('leader', $leader);
        $this->assign('info', $info);
        $this->assign('seoInfo', $seoInfo);
        $this->display("flop/time");
    }


    public function action_get_leader(){
        $date=Arr::get($_POST,'date','');
        $line_day=Arr::get($_POST,'activityDays','');
        $leaderIds=Model_Leader_Servicedate::get_leader_ids_by_date($date,$line_day);
        $leader_list=Model_Leader::get_leaders($leaderIds);
        $leaders=array();
        foreach ($leader_list as $item){
            $leaders[]=array(
                'hikerId'=>$item['id'],
                'realName'=>$item['truename'],
                'nickname'=>$item['nickname'],
                'headImgUrl'=>Common::member_pic($item['litpic']),
            );
        }
        $res=array(
            "leaderIds"=> $leaderIds,
            "leaders"=> $leaders,
            "activityIds"=> array(),
            "joinUrl"=> "",
            "status"=> 1,
            "showDate"=> date('m月d日',strtotime($date)),
            "showEndDate"=> date('m月d日',strtotime($date)),
        );
        echo json_encode($res);
    }


    public static function action_createactivity(){
        $res=array(
            'status'=>0,
            'msg'=>'发起活动失败'
        );
        $lineid=Arr::get($_POST,'line_id');
        $suitid=Arr::get($_POST,'suitid');
        $leader_ids=Arr::get($_POST,'choiceLeaderIds');
        $start_time=Arr::get($_POST,'start_time');
        $line=Model_Line::detail($lineid);
        $day=strtotime($start_time);
        if ($line && $day && $leader_ids && is_array($leader_ids)){
            $suit=Model_Line_Suit_Price::get_price_by_suit_day($suitid,$day);
            if ($suit && empty($suit['leader_id'])){
                Model_Line_Suit_Price::update_leaders($suitid,$day,$leader_ids);
                Model_Leader_Servicedate::set_leader_status($leader_ids);
                $res=array(
                    'status'=>1,
                    'msg'=>'发起活动成功',
                    'joinPageUrl'=>Common::url("/line/book/id/{$lineid}?suitid={$suitid}&day={$day}")
                );
            }
        }
        echo json_encode($res);
    }





}