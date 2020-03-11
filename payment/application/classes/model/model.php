<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Model extends ORM
{
    /**
     * 获取模型拼音标识
     * @param $id
     * @return mixed
     */
    static function pinyin_by_id($id,$ismsg)
    {
        $sql = "select pinyin,correct from sline_model where id={$id}";
        $arr = DB::query(Database::SELECT, $sql)->execute()->current();
        $py = empty($arr['correct']) ? $arr['pinyin'] : $arr['correct'];
        return $ismsg==true ? $arr['pinyin'] : $py;
    }
}