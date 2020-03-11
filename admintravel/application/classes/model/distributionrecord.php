<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Distributionrecord extends ORM
{

    const STATUS_USED=2;
    const STATUS_CANCEL=1;
    const STATUS_UNUSED=0;

    protected $_table_name = 'distribution_record';

    public static function addRecord($distributionID,$orderid,$isSendMsg=true){
        $form_member=Model_Member::getMemberByDistributionID($distributionID);
        if ($form_member && $distributionID && $orderid ){
            $member=Common::session('member');
            $order=ORM::factory('member_order',$orderid);
            if ($order && $member['distribution_id']!=$distributionID){
                $distribution=ORM::factory('distributionrecord')->where("order_id='{$orderid}' and distribution_id='{$distributionID}'")->find();
                if (empty($distribution->id) && $order && $order->price){
                    $commission_rate=$GLOBALS['cfg_commission_rate'];
                    if ($commission_rate){
                        $time=time();
                        $commission=floatval($order->price)*($commission_rate/100);
                        $model=ORM::factory('distributionrecord');
                        $model->distribution_id=$distributionID;
                        $model->order_id=$order->id;
                        $model->commission=$commission;
                        $model->commission_rate=$commission_rate;
                        $model->order_price=$order->price;
                        $model->add_time=$time;
                        $model->form_memberid=$form_member['mid'];
                        $model->to_memberid=$member['mid'];
                        $model->create();
                    }

                }
            }

        }
    }

    public static function statueName(){
        return array(
            self::STATUS_USED=>'已返现',
            self::STATUS_UNUSED=>'待返现',
            self::STATUS_CANCEL=>'已取消',
        );
    }

    public static function getStatusName($key){
        $list=self::statueName();
        return isset($list[$key])?$list[$key]:'';
    }


    public static function useDistributionByOrder($orderid){
        $distribution=ORM::factory('distributionrecord')->where("order_id='{$orderid}'")->find();
        if ($distribution->id){
            self::useDistribution($distribution->form_memberid,$distribution->id);
        }
    }

    public static function cancelDistributionByOrder($orderid){
        if ($orderid){
            $distribution=ORM::factory('distributionrecord')->where("order_id='{$orderid}'")->find();
            if ($distribution->id){
                self::cancelDistribution($distribution->id);
            }
        }
    }


    public static function useDistribution($mid,$id){
        if ($id){
            $model=ORM::factory('distributionrecord',$id);
            $member=ORM::factory('member',$mid);

            if ($member && $model->status!=self::STATUS_USED){
                $model->status=self::STATUS_USED;
                $model->up_time=time();
                $model->update();
                Model_Member::addCommission($mid,$model->commission);
            }
        }

    }

    public static function cancelDistribution($id){
        if ($id){
            $model=ORM::factory('distributionrecord',$id);
            if ($model->status=self::STATUS_UNUSED){
                $model->status=self::STATUS_CANCEL;
                $model->up_time=time();
                $model->update();
            }
        }
    }

    public function deleteClear()
    {
        if($this->id)
        {
            DB::delete('distribution_record')->where("id={$this->id}")->execute();
            $this->delete();

        }

    }



}