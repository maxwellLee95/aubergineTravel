<?php defined('SYSPATH') or die('No direct script access.');

/**
 */
class Controller_Theme extends Stourweb_Controller
{

    public function before()
    {
        parent::before();
    }

    public function _theme($list){
        $articles=array();
        if ($list){
            foreach ($list as $v){
                $articles[]=array(
                    'title'=>$v['ztname'],
                    'id'=>$v['id'],
                    'img'=>$v['logo'],
                    'date'=>date('Y-m-d',$v['modtime']),
                    'url'=>Common::get_web_url(0).'/theme/show?id='.$v['id'],
                    'read'=>$v['shownum'],
                    'first_enable_date'=>date('Y-m-d',$v['modtime']),
                );
            }
        }

        return $articles;
    }

    public function action_list(){
        $this->display('theme/list');
    }

    public function action_ajax_getlist(){
        $page=Arr::get($_POST,'page',1);
        $res=array(
            "errcode"=>0,
            "errmsg"=>"ok",
            "data"=>array(),
        );
        $res['data']['items']=$this->_theme(Model_Theme::list_new($page));
        $res['data']['total_pages']=count( $res['data']['items']);
        echo json_encode($res);
    }

    /**
     * 详细页
     */
    public function action_show()
    {
        $id=Common::remove_xss(Arr::get($_GET,'id'));
        $info=Model_Theme::get_detail($id);
        if ($info){
            $this->assign('curnav','notes');
            $this->assign('info',$info);
            $this->display('theme/show');
        }

    }



}