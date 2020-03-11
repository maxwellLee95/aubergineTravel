<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Photo 相册
 */
class Controller_Photo extends Stourweb_Controller
{
    private $_typeid = 6;   //产品类型

    public function before()
    {
        parent::before();
        $channelname = Model_Nav::get_channel_name($this->_typeid);
        $this->assign('typeid', $this->_typeid);
        $this->assign('channelname', $channelname);
    }

    /**
     * 相册首页
     */
    public function action_index()
    {

        $seoinfo = Model_Nav::get_channel_seo($this->_typeid);
        $this->assign('seoinfo', $seoinfo);
        $this->assign('destpy', 'all');
        $this->assign('destname','目的地');
        $this->assign('attrid', '');
        $this->assign('page', 1);
        $this->assign('sorttype', 0);
        $this->display('photo/list');
    }

    /**
     * 相册列表
     */
    public function action_list()
    {
        $data['offset'] =0;
        $data['order']=2;
        $list = Model_Photo::photo_list($data);
        $photo=array();
        if (!empty($list)){
            foreach ($list as $item){
                $photo[]= $this->_photo($item);
            }
        }
        $this->assign('photo',$photo);
        $this->display('photo/list');
    }

    /**
     * ajax请求 加载更多
     */
    public function action_ajax_photo_more()
    {
        $params = Common::remove_xss($this->request->param('params'));
        $params = explode('-', $params);
        list($destPy, $attr, $p,$order) = $params;
        if(strlen($order)==0){
            $order=0;
        }
        echo $this->list_data($destPy, $attr, $p,$order);
    }

    /**
     * 获取list 数据
     * @param $destPy
     * @param $attr
     * @param $p
     * @param bool|false $order
     * @return mixed
     */
    private function list_data($destPy, $attr, $page, $order)
    {
        $data = array();
        //目的地
        if ($destPy != all)
        {
            $destArr = Model_Destinations::get_dest_bypinyin($destPy);
            if (!empty($destArr['id']))
            {
                $data['kindlist'] = $destArr['id'];
            }
        }
        //属性
        if (!empty($attr))
        {
            $data['attrid'] = explode('_', $attr);
        }
        //分页
        $page = empty($page) ? 1 : $page;
        $data['offset'] = ($page - 1) * 10;
        //排序
        $data['order']=$order;
        $data = Model_Photo::photo_list($data);
        foreach ($data as &$v)
        {
            $v['litpic'] = Common::img($v['litpic'], 246, 182);
            $v['url'] = Common::get_web_url($v['webid']) . "/photos/show_{$v['aid']}.html";
            $v['description'] = Common::cutstr_html($v['description'],120);
        }
        return Product::list_search_format($data, $page);
    }

    /**
     * 相册详情
     */
    public function action_show()
    {
        $aid = Common::remove_xss($this->request->param('aid'));
        //子站内容显示
        if(isset($_GET[webid])){
            $GLOBALS['sys_webid'] = Common::remove_xss(Arr::get($_GET,'webid'));
        }
        $row = Model_Photo::photo_detail($aid);
        //点击率加一
        Product::update_click_rate($aid, $this->_typeid);
        //picture
        $piclist = Model_Photo::photo_picture($row['id']);
        foreach ($piclist as &$v)
        {
            if (empty($v['description']))
            {
                $v['description'] = $row['content'];
            }
        }
        $row['piclist'] = $piclist;
        $seoInfo = Product::seo($row);
        $this->assign('info', $row);
        $this->assign('seoinfo', $seoInfo);
        $this->display('photo/show');
    }


    public function action_ajax_get_list(){
        $res=array();

        $page=Arr::get($_POST,'page',2);
        //分页
        $page = empty($page) ? 1 : $page;
        $data['offset'] = ($page - 1) * 10;
        //排序
        $data['order']=2;
        $list = Model_Photo::photo_list($data);
        if (!empty($list)){
            $res['status']=1;
            foreach ($list as $item){
                $res['datas']['items'][]= $this->_photo($item);
            }
        }
        echo json_encode($res);
    }

    public function _photo($item){
        $t=array(
            "id"=>$item['id'],
            'url'=>Common::get_web_url(0)."/photos/show_{$item['id']}.html",
            "title"=>$item['title'],
            "imgs"=>array(),
            "date"=>date('Y-m-d H:i',$item['modtime']),
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