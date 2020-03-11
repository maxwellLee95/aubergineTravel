<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Mall extends ORM
{
    Const TYPE_ID=202;
    public function deleteClear()
    {

        $rooms = ORM::factory('mall_sku')->where("mallid={$this->id}")->find_all()->as_array();
        foreach ($rooms as $room)
        {
            if ($room->id)
                $room->deleteClear();
        }
        /* Common::deleteRelativeImage($this->litpic);
         $piclist=explode(',',$this->piclist);
         foreach($piclist as $k=>$v)
         {
              $img_arr=explode('||',$v);
              Common::deleteRelativeImage($img_arr[0]);
         }*/
        $this->delete();
    }

    /*
     * 更新最低报价
     * */
    public static function updateMinPrice($mallid)
    {
        $sql = "SELECT MIN(price) as price FROM sline_mall_sku_price WHERE mallid='$mallid' and price>0 and day>=UNIX_TIMESTAMP()";
        $ar = DB::query(1, $sql)->execute()->as_array();
        $price = $ar[0]['price'] ? $ar[0]['price'] : 0;
        $model = ORM::factory('mall', $mallid);
        $model->price = $price;
        $model->update();
    }

    /**
     * 酒店克隆
     * @param $id 克隆的产品ID
     * @param $num 克隆基数
     */
    public function cloneMall($id, $num)
    {
        $arr = $this->where("id=$id")->find()->as_array();
        unset($arr['aid']);
        unset($arr['id']);
        for ($i = 1; $i <= $num; $i++)
        {
            //信息表
            $arr['addtime'] = $arr['modtime'] = time();
            $arr['aid'] = Common::getLastAid('sline_mall', 0);
            list($insertId, $row) = DB::insert('mall', array_keys($arr))->values(array_values($arr))->execute();
            //字段扩展表
            if ($row > 0)
            {
                $result = DB::select()->from('mall_extend_field')->where("productid={$id}")->execute()->current();
                if (!empty($result))
                {
                    unset($result['id']);
                    $result['productid'] = $insertId;
                    DB::insert('mall_extend_field', array_keys($result))->values(array_values($result))->execute();
                }
            }
        }
        return $insertId;
    }
}