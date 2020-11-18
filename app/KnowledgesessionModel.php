<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        $now = new DateTime();
        #$query = "count(case when sessionorders.know_id = false then 1 else null end) as orders";
        #$query = "count(IF(sessionorders.cancelled = false, 1, NULL)) as orders";
        $query = 'COUNT(sessionorders.know_id) as orders';
        $select = [
            ['knowledgesessions.begin_date','>=', $now],
        ];
        if (Auth::user()->role_id == 2){
            array_merge($select, array(
                $select[1] = ['knowledgesessions.user_id','=', Auth::user()->id]
            ));
        }
        return DB::table($this->table)
            ->select(array('knowledgesessions.id as k_id', 'sessionorders.id as s_id', 'users.id as u_id', 'knowledgesessions.*', 'users.*', DB::raw($query)))
            ->Leftjoin('users', 'knowledgesessions.user_id','=','users.id')
            ->LeftJoin('sessionorders', 'sessionorders.know_id','=','knowledgesessions.id')
            ->where($select)
            ->groupBy('knowledgesessions.id')
            ->orderBy('knowledgesessions.begin_date', 'asc')
            ->get();

    }

    function getSessionDetails($id){

        return DB::table($this->table)
            ->join('users', 'knowledgesessions.user_id','=','users.id')
            ->select('knowledgesessions.id as know_id', 'knowledgesessions.*', 'users.*')
            ->where('knowledgesessions.id', $id)
            ->first();

    }
    function getUsers(){
        return DB::table('users')
            ->select('users.firstname','users.lastname','users.id')
            ->where('users.role_id','>',1)
            ->get();
    }

}
