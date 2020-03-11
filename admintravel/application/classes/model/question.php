<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Question extends ORM {

    protected  $_table_name = 'question';
    public static $channeltable=array(
        1=>'line',
        2=>'hotel',
        3=>'car',
        4=>'article',
        5=>'spot',
        6=>'photo',
        8=>'tuan',
        11=>'jieban',
        13=>'tuan',
        101=>'notes',
        202=>'mall',
        303=>'leader'
    );
    //获取产品名称
    public function getProductName($id,$typeid)
    {

        $tablename = 'sline_'.self::$channeltable[$typeid];
        $fields=array(
            '1'=>array('field'=>'title','link'=>'lines'),
            '2'=>array('field'=>'title','link'=>'hotels'),
            '3'=>array('field'=>'title','link'=>'cars'),
            '4'=>array('field'=>'title','link'=>'raiders'),
            '5'=>array('field'=>'title','link'=>'spots'),
            '6'=>array('field'=>'title','link'=>'photos'),
            '8'=>array('field'=>'title','link'=>'visa'),
            '11'=>array('field'=>'title','link'=>'jieban'),
            '13'=>array('field'=>'title','link'=>'tuan'),
            '101'=>array('field'=>'title','link'=>'notes'),
            '202'=>array('field'=>'title','link'=>'mall'),
            '303'=>array('field'=>'name','link'=>'leader')
        );
        $field = $fields[$typeid]['field'];
        $link =$fields[$typeid]['link'];
        $module_info = Model_Model::getModuleInfo($typeid);
        if(intval($module_info['issystem'])==0) //通用模块
        {

            $tablename = "sline_model_archive";
            $field = 'title';
            $link = $module_info['pinyin'];
        }

        switch ($typeid){
            case Model_Notes::TYPE_ID:
            case 11:
                $sql = "select id as aid,{$field} as title from {$tablename} where id='$id'";
                break;
            case Model_Leader::TYPE_ID:
                $sql = "select id As aid,b.nickname as title from sline_leader as a left join sline_member as b on a.mid=b.mid where a.id={$id}";
                break;
            default:
                $sql = "select aid,{$field} as title from {$tablename} where id='$id'";
        }

        $row = DB::query(Database::SELECT,$sql)->execute();


//        $out = "<a href=\"/{$link}/show_{$row[0]['aid']}.html\" class='product-title' target=\"_blank\">{$row[0]['title']}</a>";
        $out = "{$row[0]['title']}";

        return $out;

    }
}