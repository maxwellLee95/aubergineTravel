<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Model extends ORM
{
    /**
     * 查询指定模型
     */
    public static function all_model($id)
    {
        $sql = "SELECT * FROM sline_model ";
        $sql .= "WHERE id={$id}";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr[0];
    }

    public static function tongyoug_model()
    {
        $sql = "SELECT * FROM sline_model ";
        $sql .= "WHERE issystem=0";
        $arr = DB::query(1, $sql)->execute()->as_array();
        return $arr;
    }
    //获取可搜索的模块
    public static function get_search_model()
    {
        //排除7(保险),10(问答),11(结伴),14(私人定制)模块
        $arr = ORM::factory('model')
            ->where("id not in(7,10,11,14) and isopen=1")
            ->order_by('id','ASC')
            ->get_all();
        foreach($arr as &$r)
        {
            $corrent = $r['correct'] ? $r['correct'] : $r['pinyin'];
            $r['url'] = $r['issystem'] == 1 ? "/{$corrent}/" : '/'.$r['pinyin'].'/';
            $r['modulename'] = $r['id'] == 4 ? "攻略" : $r['modulename'];

        }
        return $arr;
    }

}