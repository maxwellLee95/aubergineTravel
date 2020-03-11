<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Leader_Leaderboard extends Stourweb_Controller
{

    public $leader=array();

    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }

    /**
     * 首页
     */
    public function action_index()
    {
        $this->display('leader/leaderboard/index');
    }

    public function action_line(){
        $sql="SELECT a.productaid,a.productname,a.litpic "
                    .",group_concat(DISTINCT id) AS orderids"
                    .",group_concat(DISTINCT concat_ws('#',b.lineid,b.suitid,b.day,concat_ws('*',leader_id,leader_id2,leader_id3,leader_id4,leader_id5))) AS suitinfos"
                ." ,( SELECT COUNT(DISTINCT usedate) FROM sline_member_order "
                ." WHERE productaid = a.productaid AND date_format(usedate, '%Y-%m') = date_format(now(), '%Y-%m') AND status=".Model_Member_Order::STATUS_FINISH
                ." ) AS line_total "
                ." ,( SELECT SUM(dingnum) FROM sline_member_order "
                ." WHERE productaid = a.productaid AND date_format(usedate, '%Y-%m') = date_format(now(), '%Y-%m') AND status=".Model_Member_Order::STATUS_FINISH
                ." ) AS people_total "
            ." FROM sline_member_order AS a "
            ." LEFT JOIN sline_line_suit_price as b"
            ." ON a.productaid=b.lineid and a.suitid=b.suitid and a.usedate=from_unixtime(b.day,'%Y-%m-%d')"
            ." WHERE 1 "
            ." AND date_format(usedate, '%Y-%m') = date_format(now(), '%Y-%m') "
            ." AND typeid = 1 "
            ." AND status=".Model_Member_Order::STATUS_FINISH
            ." GROUP BY productaid "
            ." ORDER BY "
                ."( SELECT COUNT(DISTINCT usedate) FROM sline_member_order "
                ." WHERE productaid = a.productaid AND date_format(usedate, '%Y-%m') = date_format(now(), '%Y-%m')) AND status=".Model_Member_Order::STATUS_FINISH
            ." DESC"
            ." LIMIT 30";
        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
        if ($list){
            foreach ($list as $key=>&$item){
                $tLeaderList=array();
                $suitInfoList=explode(",",$item['suitinfos']);
                if ($suitInfoList){
                    foreach ($suitInfoList as $suitInfo){
                        $s=explode("#",$suitInfo);
                        //计算每次活动的领队次数
                        $tLeaders=explode("*",$s[3]);
                        if ($tLeaders){
                            foreach ($tLeaders as $v){
                                if ($v){
                                    if (isset($tLeaderList[$v])){
                                        $tLeaderList[$v]=$tLeaderList[$v]+1;
                                    }else{
                                        $tLeaderList[$v]=1;
                                    }
                                }
                            }
                        }
                    }
                }
                //排序
                arsort($tLeaderList);
                $leaders=array_keys($tLeaderList);
                if ($leaders){
                    $item['leaders']=Model_Leader::get_leaders(array_slice($leaders,0,3));
                }
                $Comment=Model_Comment::getStatByOrderids(explode(",",$item['orderids']));
                $item['score']=round($Comment['score_total']/$Comment['total'],1);
//                $item['score']=!empty($item['score'])?$item['score']:5;
            }
        }
        $this->assign('list',$list);
        $this->display('leader/leaderboard/line');
    }

    public function action_bounty(){
        $sql="SELECT  leaderid,SUM(amount) AS total "
            ." FROM  sline_leader_bounty "
//            ." WHERE date_format(addtime, '%Y-%m') = date_format(now(), '%Y-%m')  "
            ." GROUP BY leaderid "
            ." ORDER BY SUM(amount) DESC "
            ." limit 30 ";
        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
        if ($list){
            foreach ($list as &$item){
                $t=Model_Leader::get_leader($item['leaderid']);
                if ($t){
                    $item['leader']=Model_Leader::get_leader($item['leaderid']);
                }
            }
        }
        $this->assign('list',$list);
        $this->display('leader/leaderboard/bounty');
    }

    public function action_integral(){
        $sql="SELECT  leader_id,sum(integral) AS total "
            ." FROM  sline_leader_integral_log "
//            ." WHERE date_format(addtime, '%Y-%m') = date_format(now(), '%Y-%m')  "
            ." GROUP BY leader_id "
            ." ORDER BY SUM(integral) DESC "
            ." limit 30 ";
        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
        if ($list){
            foreach ($list as &$item){
                $t=Model_Leader::get_leader($item['leader_id']);
                if ($t){
                    $item['leader']=Model_Leader::get_leader($item['leader_id']);
                }
            }
        }
        $this->assign('list',$list);
        $this->display('leader/leaderboard/integral');
    }




    public function action_ajax_data()
    {
        $limit=10;
        $page = intval($_GET['current']);
        $type = intval($_GET['type']);
        switch ($type){
            case 0:
                $sql="SELECT  articleid AS leaderid,COUNT(score1) AS total "
                    ." FROM sline_comment "
//                    ." WHERE YEARWEEK(from_unixtime(addtime,'%Y-%m-%d')) = YEARWEEK(now()) AND typeid=1 "
                    ." GROUP BY articleid "
                    ." ORDER BY COUNT(score1) DESC "
                    ." limit {$page},{$limit} ";
                break;
            case 2:
                $sql="SELECT  leaderid,COUNT(amount) AS total  "
                    ." FROM  sline_leader_bounty "
                    ." WHERE YEARWEEK(from_unixtime(addtime,'%Y-%m-%d')) = YEARWEEK(now()) "
                    ." GROUP BY leaderid "
                    ." ORDER BY COUNT(amount) DESC"
                    ." limit {$page},{$limit} ";
                break;
            case 1:
                $sql="SELECT  leader_id AS leaderid,COUNT(integral) AS total "
                    ." FROM sline_leader_integral_log "
                    ." WHERE YEARWEEK(from_unixtime(addtime,'%Y-%m-%d')) = YEARWEEK(now()) "
                    ." GROUP BY leader_id "
                    ." ORDER BY COUNT(integral) DESC"
                    ." limit {$page},{$limit} ";
                break;
        }
        $list=array();
        if (!empty($sql)){
            $tlist=DB::query(Database::SELECT,$sql)->execute()->as_array();
            if ($tlist){
                foreach ($tlist as $item){
                    $t=Model_Leader::get_leader($item['leaderid']);
                    if ($t){
                        $item['leader']=Model_Leader::get_leader($item['leaderid']);
                        $list[]=$item;
                    }
                }
            }
        }

        echo json_encode(array('status' => $list ? true : false, 'list' => $list, 'page' => $list ? ++$page : $page));
    }



}