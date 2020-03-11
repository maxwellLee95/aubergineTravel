<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Member_Linkman
 * 常用联系人
 */
class Controller_Member_Linkman extends Stourweb_Controller
{
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
        $row = Model_Member_Linkman::get_list($this->member['mid']);
        foreach ($row as &$v)
        {
            $v['url'] = $this->cmsurl . "member/linkman/update?action=edit&id={$v['id']}";
        }
        $this->assign('data', $row);
        $this->display('member/linkman_index');
    }

    /**
     * 添加、修改联系人
     */
    public function action_update()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        $listUrl = $this->cmsurl . 'member/linkman/';
        switch ($action)
        {
            //编辑
            case 'edit':
                $info = Model_Member_Linkman::detail(Common::remove_xss($_GET['id']));
                $info['action'] = '修改';
                $this->assign('info', $info);
                $this->display('member/linkman_edit');
                break;
            //添加
            case 'add':
                $info['action'] = '添加';
                $info['isadd'] = true;
                $this->assign('info', $info);
                $this->display('member/linkman_edit');
                break;
            //删除
            case 'delete':
                $data['bool'] = 0;
                $id = Common::remove_xss($_GET['id']);
                $rows = DB::delete('member_linkman')->where("id={$id}")->execute();
                if ($rows > 0)
                {
                    $data['bool'] = 1;
                    $data['url'] = $listUrl;
                    $data['msg'] = __('success_delete');
                } else
                {
                    $data['msg'] = __('error_delete');
                }
                echo json_encode($data);
                break;
            //新增或更新数据
            case 'save':
                $data['bool'] = 0;
                $_POST = Common::remove_xss($_POST);
                if (empty($_POST['id']))
                {
                    $_POST['memberid'] = $this->member['mid'];
                    list(, $rows) = DB::insert('member_linkman', array_keys($_POST))->values(array_values($_POST))->execute();
                    if ($rows > 0)
                    {
                        $data['bool'] = 1;
                        $data['url'] = $listUrl;
                        $data['msg'] = __('success_add');
                    } else
                    {
                        $data['msg'] = __('error_add');
                    }
                } else
                {
                    $id = $_POST['id'];
                    unset($_POST['id']);
                    $rows = DB::update('member_linkman')->set($_POST)->where("id={$id}")->execute();
                    if ($rows > 0)
                    {
                        $data['bool'] = 1;
                        $data['url'] = $listUrl;
                        $data['msg'] = __('success_edit');
                    } else
                    {
                        $data['msg'] = __('error_edit');
                    }
                }
                echo json_encode($data);
                break;
        }
    }

    /**
     * 检测身份证、电话号码是否存在
     */
    public function action_ajax_check()
    {
        $_POST = Common::remove_xss($_POST);
        if (count($_POST) != 1)
        {
            exit('false');
        }
        $key = array_keys($_POST);
        $key = $key[0];
        $val = $key == 'idcard' ? "'{$_POST[$key]}'" : $_POST[$key];
        $result = DB::select()->from('member_linkman')->where("{$key}=$val and memberid=" . $this->member['mid'])->execute()->as_array();
        empty($result) ? exit('true') : exit('false');
    }

    /**
     * 添加、修改联系人
     */
    public function action_ajax_save()
    {
        $_POST = Common::remove_xss($_POST);
        $post_data['id']=$_POST['newContactId'];
        $post_data['linkman']=$_POST['newContactName'];
        $post_data['idcard']=$_POST['newContactIdentity'];
        $post_data['mobile']=$_POST['newContactTel'];
        $post_data['sex']=Common::get_sex_by_car($_POST['newContactIdentity']);

        $post_data['cardtype']='身份证';
        $res=array(
            'status'=>0,
            'data'=>array(),
            'isEdit'=>false,
            'msg'=>'更新失败'
        );
        $res_data=Model_Member_Linkman::_format($post_data);
        $where=" and id!={$post_data['id']}";
        $idcard_sql="select * from sline_member_linkman WHERE  idcard='{$post_data['idcard']}'";
        $idcard_sql.=$post_data['id']?$where:'';
        $idcardModel=DB::query(Database::SELECT,$idcard_sql)->execute()->current();
        $mobile_sql="select * from sline_member_linkman WHERE  mobile='{$post_data['mobile']}'";
        $mobile_sql.=$post_data['id']?$where:'';
        $mobileModel=DB::query(Database::SELECT,$mobile_sql)->execute()->current();
        if ($idcardModel){
            $res['status']=0;
            $res['msg']='身份证已存在';
            echo json_encode($res);exit;
        }
        if ($mobileModel){
            $res['status']=0;
            $res['msg']='手机号已存在';
            echo json_encode($res);exit;
        }
        if (empty($post_data['id']))
        {
            unset($post_data['id']);
            $post_data['memberid'] = $this->member['mid'];
            list(, $rows) = DB::insert('member_linkman', array_keys($post_data))->values(array_values($post_data))->execute();
            $res['status']=1;
            $res['data']=$res_data;
        } else
        {
            $id = $post_data['id'];
            unset($post_data['id']);
            $rows = DB::update('member_linkman')->set($post_data)->where("id={$id}")->execute();
            $res['status']=1;
            $res['data']=$res_data;
            $res['isEdit']=true;
        }
        echo json_encode($res);
    }


    /**
     * 添加、修改联系人
     */
    public function action_ajax_mall_contact_save()
    {
        $_POST = Common::remove_xss($_POST);
        $post_data['id']=$_POST['contactId'];
        $post_data['linkman']=$_POST['realname'];
        $post_data['mobile']=$_POST['telephone'];
//        $post_data['province']=$_POST['province'];
//        $post_data['city']=$_POST['city'];
//        $post_data['district']=$_POST['district'];
        $post_data['address']=$post_data['province'].$_POST['city'].$_POST['district'].$_POST['address'];
        $res=array(
            'status'=>0,
            'contact'=>array(),
            'contacts'=>array(),
            'isEdit'=>false,
        );
        $res_data=Model_Member_Linkman::_format($post_data);
        if (empty($post_data['id']))
        {
            unset($post_data['id']);
            $post_data['memberid'] = $this->member['mid'];
            list(, $rows) = DB::insert('member_linkman', array_keys($post_data))->values(array_values($post_data))->execute();
            if ($rows > 0)
            {
                $res['status']=1;
                $res['contacts']=Model_Member_Linkman::_formatLinkMan($this->member['mid']);
                $res['contact']=$res_data;
            }
        } else
        {
            $id = $post_data['id'];
            unset($post_data['id']);
            $rows = DB::update('member_linkman')->set($post_data)->where("id={$id} AND memberid={$this->member['mid']} ")->execute();
            if ($rows > 0)
            {
                $res['status']=1;
                $res['contact']=$res_data;
                $res['contacts']=Model_Member_Linkman::_formatLinkMan($this->member['mid']);
                $res['isEdit']=true;
            }
        }
        echo json_encode($res);
    }


    public function action_ajax_contact_del()
    {
        $_POST = Common::remove_xss($_POST);
        $id=$_POST['contactId'];
        if ($id){
            Model_Member_Linkman::deleteByMemberID( $this->member['mid'],$id);
            echo json_encode(array('status'=>1,'msg'=>'删除成功'));
        }
    }

    public function action_ajax_contact_default(){
        $_POST = Common::remove_xss($_POST);
        $id=$_POST['contactId'];
        if ($id){
            $clear_sql="update sline_member_linkman set isdefault=0 where memberid={$this->member['mid']} ";
            DB::query(Database::UPDATE,$clear_sql)->execute();
            $model=ORM::factory('member_linkman',$id);
            $model->isdefault=1;
            $model->save();
            echo json_encode(array('status'=>1,'msg'=>'设置默认成功'));
        }
    }


}