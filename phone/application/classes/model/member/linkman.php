<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Linkman extends ORM
{
    /**
     * 常用联系人
     * @return mixed
     */
    public static function get_list($mid)
    {
        $sql = "SELECT * FROM sline_member_linkman ";
        $sql .= "WHERE memberid ={$mid} ";
        $sql .= "ORDER BY id desc";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
    }

    /**
     * 单个联系人
     * @param $id
     */
    public static function detail($id)
    {
        $sql = "SELECT * FROM sline_member_linkman ";
        $sql .= "WHERE id={$id}";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr[0];
    }

    public static function _format($data){

        $birthday=!empty($data['idcard'])?Common::get_birth_by_car($data['idcard']):null;
        $sex=!empty($data['idcard'])?Common::get_sex_by_car($data['idcard']):null;
        $birthday_str=$birthday?date('Y-m-d',strtotime($birthday)):null;
        $data=array(
            'contactId'=>$data['id'],
            'realName'=>$data['linkman'],
            'identity_type'=>1,
            'identity'=>$data['idcard'],
            'telephone'=>$data['mobile'],
            'isdefault'=>$data['isdefault'],
            'passType'=>null,
            'passNum'=>null,
            'passAddr'=>null,
            'birthday'=>$birthday,
            'sex'=>$sex,
            'sexName'=>!empty($sex)?'男':'女',
            'identity_type_name'=>'身份证',
            'birthday_str'=>$birthday_str,
            'province'=>$data['province'],
            'city'=>$data['city'],
            'district'=>$data['district'],
            'address'=>$data['address'],
        );
        return $data;
    }


    public static function _formatLinkMan($mid){
        $linkmanlist=self::get_list($mid);
        $linkman=array();
        if ($linkmanlist){
            foreach ($linkmanlist as $v){
                $linkman[$v['id']]=self::_format($v);
            }
        }
        return $linkman;
    }

    public static function deleteByMemberID($member_id,$id)
    {
        if ($member_id && $id){
            DB::delete('member_linkman')->where("id={$id} AND memberid={$member_id}")->execute();

        }
    }

}