<?php defined('SYSPATH') or die('No direct script access.');

/*
    * 日历显示
    * */

class Controller_Linecalendar extends Stourweb_Controller
{

    public function action_index()
    {
        $list = Model_Line::get_line_by_month(date('Y-m'), 0, 30);
        $list=$this->_get_line($list);
        $after_time=$this->_format_time(Model_Line_Suit_Price::get_after_day());
        $before_time=$this->_format_time(Model_Line_Suit_Price::get_before_day());
        $this->assign('before_time', $before_time);
        $this->assign('after_time', $after_time);
        $this->assign('list', $list);
        $this->display('linecalendar/index');
    }

    public function _format_time(array $data){
        $res=array();
        if ($data){
            foreach ($data as $k=>$v){
                $res[$k]=date('Y-m-d',$v['day']);
            }
        }
        return json_encode($res);
    }

    public function action_get_holidays(){
        $data=array(
            "errcode"=> 0,
            "errmsg"=> "成功",
            "data"=> array(
                "20170101"=> "元旦",
                "20170102"=> "休",
                "20170122"=> "班",
                "20170127"=> "除夕",
                "20170128"=> "春节",
                "20170129"=> "休",
                "20170130"=> "休",
                "20170131"=> "休",
                "20170201"=> "休",
                "20170202"=> "休",
                "20170204"=> "班",
                "20170401"=> "班",
                "20170402"=> "休",
                "20170403"=> "休",
                "20170404"=> "清明",
                "20170429"=> "休",
                "20170430"=> "休",
                "20170501"=> "劳动节",
                "20170527"=> "班",
                "20170528"=> "休",
                "20170529"=> "休",
                "20170530"=> "端午",
                "20170930"=> "班",
                "20171001"=> "国庆节",
                "20171002"=> "休",
                "20171003"=> "休",
                "20171004"=> "中秋",
                "20171005"=> "休",
                "20171006"=> "休",
                "20171007"=> "休",
                "20171008"=> "休",
                "20171230"=> "休",
                "20171231"=> "休",
                "20180101"=> "元旦",
                "20180215"=> "除夕",
                "20180216"=> "春节",
                "20180217"=> "休",
                "20180218"=> "休",
                "20180219"=> "休",
                "20180220"=> "休",
                "20180221"=> "休",
                "20180224"=> "班",
                "20180405"=> "清明",
                "20180406"=> "休",
                "20180407"=> "休",
                "20180408"=> "班",
                "20180428"=> "班",
                "20180429"=> "休",
                "20180430"=> "休",
                "20180501"=> "劳动节",
                "20180616"=> "休",
                "20180617"=> "休",
                "20180618"=> "端午",
                "20180922"=> "休",
                "20180923"=> "休",
                "20180924"=> "中秋",
                "20180929"=> "班",
                "20180930"=> "班",
                "20181001"=> "国庆节",
                "20181002"=> "休",
                "20181003"=> "休",
                "20181004"=> "休",
                "20181005"=> "休",
                "20181006"=> "休",
                "20181007"=> "休"
            )
        );
        echo json_encode($data);
    }


    public function action_ajax_get_day_activitys()
    {
        $res = array(
            "status" => 1,
        );
        $day = Arr::get($_POST, 'day', '');
        if ($day){
            $line_list = Model_Line::get_line_by_day($day, 0, 30);
            $res['data']=$this->_get_line($line_list);
            echo json_encode($res, true);
        }

    }

    public function action_ajax_get_month_activitys()
    {
        $res = array(
            "status" => 1,
        );
        $day = Arr::get($_POST, 'day', '');
        if ($day){
            $line_list = Model_Line::get_line_by_month($day, 0, 30);
            $res['data']=$this->_get_line($line_list);
            echo json_encode($res, true);
        }

    }

    public function _get_line($line_list){
        $data=array();
        if (!empty($line_list)) {
            foreach ($line_list as $item) {
                $member = Model_Leader::get_leader($item['leader_id']);
                $data[] = array(
                    "activityId" => $item['id'],
                    "leaderHikerId" => $item['leader_id'],
                    "name" => $item['title'],
                    "sub_title" => $item['sellpoint'],
                    "smallImageUrl" => $item['litpic'],
                    "imageUrl" => $item['litpic'],
                    "banners" => array(),
                    "money" => $item['price'],
                    "minPersonCount" => $item['min_person_count'],
                    "personCount" => $item['person_count'],
                    "startDate" => date('m月d日', $item['day']),
                    "hiker" => Common::line_hiker($member),
                    "status" => Common::line_status($item['person_count'],$item['min_person_count'],$item['lineid'],$item['suitid'],$item['day']),
                    "day" => $item['lineday'],
                    "aurl" => $item['url'],
                );
            }
        }
        return $data;
    }

}