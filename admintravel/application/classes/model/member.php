<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member extends ORM {

    protected  $_primary_key = 'mid';

      /*
       * 检查是否存在相同数据
       * */
    public static function checkExist($field,$value,$mid='')
    {
        $flag = 'true';
        $model = ORM::factory('member')->where($field,'=',$value);
        if(!empty($mid))
        {
            $model->where('mid','!=',$mid);
        }
        else
        {

        }
        $model->find();
        if($model->loaded() && !empty($model->mid))
        {
            $flag = 'false';
        }
        return $flag  ;
    }

    /**
     * 学分处理
     * @param $mid
     * @param $jifen 学分
     * @param int $type 1：使用 2：获取
     * @return object
     */
    public static function operate_jifen($mid, $jifen, $type = 1)
    {
        if ($mid && $jifen){
            $jifen = $type == 1 ? -$jifen : $jifen;
            $sql = "UPDATE sline_member SET jifen=jifen+({$jifen}) ";
            $sql .= "WHERE mid={$mid}";
            $row = DB::query(Database::UPDATE, $sql)->execute();
            return $row;
        }
    }


    public static function addCommission($mid,$amount){
        if ($mid && $amount){
            $member=ORM::factory('member',$mid);
            if ($member){
                $member->commission=floatval($amount)+floatval($member->commission);
                $member->update();
                return true;
            }
        }
        return false;
    }

    public static function cutCommission($mid,$amount){
        if ($mid && $amount){
            $member=ORM::factory('member',$mid);
            if ($member){
                $commission=floatval($member->commission)-floatval($amount);
                if ($commission>=0){
                    $member->commission=$commission;
                    $member->update();
                    return true;
                }

            }


        }
        return false;
    }



}