<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 */
class Model_Notes_Like extends ORM
{


    public static function getItem($note_id,$member_id)
    {
        if ($note_id && $member_id){
            $sql = "SELECT * from  sline_notes_like where note_id={$note_id} AND member_id={$member_id}  ";
            return DB::query(1, $sql)->execute()->current();
        }
    }

    public static function getCount($note_id){
        if ($note_id){
            $sql = "SELECT count(*) As total from sline_notes_like where note_id={$note_id}";
            $data=DB::query(1, $sql)->execute()->current();
            return !empty($data['total'])?$data['total']:0;
        }
    }


}