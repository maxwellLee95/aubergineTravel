<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Member_Photo extends Stourweb_Controller
{
    public $member=null;
    /**
     * 前置操作
     */
    public function before()
    {
        parent::before();
        $this->member = Common::session('member');
        Common::check_login($this->member);
    }


    public function action_list()
    {
        $list=Model_Photo::get_photo_by_mid($this->member['mid']);
        $photo=array();
        if (!empty($list)){
            foreach ($list as $item){
                $photo[]= $this->_photo($item);
            }
        }
        $this->assign('photo',$photo);
        $this->display('member/photo/list');
    }


    public function _photo($item){
        $t=array(
            "id"=>$item['id'],
            'url'=>Common::get_web_url(0)."/photos/show_{$item['id']}.html",
            "title"=>$item['title'],
            "imgs"=>array(),
            "date"=>date('Y-m-d H:i',$item['modtime']),
            'litpic'=>$item['litpic']
        );
        $photo_list=Model_Photo::photo_picture($item['id'],3);
        if (!empty($photo_list)){
            foreach ($photo_list as $v){
                $t['imgs'][]=$v['litpic'];
            }
        }
        return $t;
    }




}