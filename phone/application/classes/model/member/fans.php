<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 */
class Model_Member_Fans extends ORM
{


    public static function getFansItem($to_mid,$form_mid)
    {
        if ($to_mid && $form_mid){
            $sql = "SELECT * from  sline_member_fans where to_mid={$to_mid} AND form_mid={$form_mid}  ";
            return DB::query(1, $sql)->execute()->current();
        }
    }

    public static function getFansCount($mid){
        if ($mid){
            $sql = "SELECT count(*) As total from sline_member_fans where to_mid={$mid}";
            $data=DB::query(1, $sql)->execute()->current();
            return !empty($data['total'])?$data['total']:0;
        }
    }

    public static function getAttentionCount($mid){
        if ($mid){
            $sql = "SELECT count(*) As total from sline_member_fans where form_mid={$mid}";
            $data=DB::query(1, $sql)->execute()->current();
            return !empty($data['total'])?$data['total']:0;
        }
    }


}