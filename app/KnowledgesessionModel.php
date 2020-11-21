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
        $select = [
            ['knowledgesessions.begin_date','>=', $now],
        ];
        if (Auth::user()->role_id == 2){
            array_merge($select, array(
                $select[1] = ['knowledgesessions.user_id','=', Auth::user()->id]
            ));
        }
        $sessions = DB::table($this->table)
            ->select(array('knowledgesessions.id as k_id', 'users.id as u_id', 'knowledgesessions.*', 'users.*'))
            ->Leftjoin('users', 'knowledgesessions.user_id','=','users.id')
            ->where($select)
            ->groupBy('knowledgesessions.id')
            ->orderBy('knowledgesessions.begin_date', 'asc')
            ->get();

        $orders = DB::table('sessionorders')
            ->select(array('sessionorders.know_id',DB::raw('COUNT(sessionorders.id) as orders')))
            ->where('sessionorders.cancelled','=',0)
            ->groupBy('sessionorders.know_id')
            ->get();

        if ($orders->isEmpty()) {
            foreach ($sessions as $session){
                $session->orders = 0;
            }
        }
        else{
            foreach ($orders as $order) {
                foreach ($sessions as $session) {
                    if ($order->know_id == $session->k_id) {
                        $session->orders = $order->orders;
                    } else {
                        $session->orders = 0;
                    }
                }
            }
        }
        return $sessions;
    }

    function getSessionDetails($id){

        return DB::table($this->table)
            ->join('users', 'knowledgesessions.user_id','=','users.id')
            ->select('knowledgesessions.id as know_id', 'users.id as user_id', 'knowledgesessions.*', 'users.*')
            ->where('knowledgesessions.id', $id)
            ->first();

    }
    function getUsers(){
        return DB::table('users')
            ->select('users.firstname','users.lastname','users.id')
            ->where('users.role_id','>',1)
            ->get();
    }

    function updatesession($request){
        $data = array(
            "title" => $request->title,
            "desc" => $request->desc,
            "min_atendees" => $request->min_aten,
            "max_atendees" => $request->max_aten,
            "begin_date" => new DateTime($request->begin_time),
            "end_date" => new DateTime($request->end_time),
            "user_id" => intval($request->Sessionleader)
        );

        $update = DB::table($this->table)
            ->where('id', intval($request->knowid))
            ->update($data);

        if($update !== false){
            return true;
        }
        else{
            return false;
        }
    }
}
