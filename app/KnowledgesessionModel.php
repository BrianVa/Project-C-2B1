<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KnowledgesessionModel extends Model
{
    protected $table = "knowledgesessions";
    function insertsession($request, $id){
        $data = array(
            "title" => $request->title,
            "desc" => $request->desc,
            "min_atendees" => $request->min_aten,
            "max_atendees" => $request->max_aten,
            "begin_date" => new DateTime($request->begin_time),
            "end_date" => new DateTime($request->end_time),
            "user_id" => $id

        );
        $insert = DB::table($this->table)->insert($data);


        if($insert !== false){
            return true;
        }
        else{
            return false;
        }
    }
    function GetSessions(){

        $results = DB::select('select *, k.id as k_id, u.id as u_id from knowledgesessions k inner join users u ON k.user_id = u.id');
        return $results;
    }

}
