<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Leader_Material extends ORM
{
    //对应数据库
    protected $_table_name = 'leader_material';




    public static function getListByLeaderid($id){
        if ($id){
            $sql="select a.*,b.name from sline_leader_material AS a left join sline_material AS b on a.material_id=b.id where a.leader_id={$id}";
            return DB::query(Database::SELECT,$sql)->execute()->as_array();
        }
    }


    public static function getItem($id){
        if ($id){
            $sql="select a.*,b.name from sline_leader_material AS a left join sline_material AS b on a.material_id=b.id where a.id={$id}";
            return DB::query(Database::SELECT,$sql)->execute()->current();
        }
    }






}
