<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KnowledgesessionModel extends Model
{
    protected $table = "knowledgesessions";
    //deze functie insert een nieuwe sessie in de database
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
    //deze functie haalt alle sessie op van een organisator
    function getFacSessions(){
        $select = [];
        if (Auth::user()->role_id == 2){
            array_merge($select, array(
                $select[0] = ['knowledgesessions.user_id','=', Auth::user()->id]
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
            foreach ($sessions as $session){
                foreach ($orders as $order){
                    if ($session->k_id == $order->know_id) {
                        $session->orders = $order->orders;
                    } else {
                        if(isset($session->orders) < 1){
                            $session->orders = 0;
                        }
                    }
                }
            }
        }
        return $sessions;
    }

    //deze functie haalt alle sessies op waar je nog voor kan aanmelden
    function GetSessions(){

        $sessions = DB::table($this->table)
            ->select(array('knowledgesessions.id as k_id', 'users.id as u_id', 'knowledgesessions.*', 'users.*'))
            ->Leftjoin('users', 'knowledgesessions.user_id','=','users.id')
            ->whereDate('knowledgesessions.begin_date', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
            ->groupBy('knowledgesessions.id')
            ->orderBy('knowledgesessions.begin_date', 'asc')
            ->get();

        $orders = DB::table('sessionorders')
            ->select(array('sessionorders.know_id',DB::raw('COUNT(sessionorders.id) as orders')))
            ->where('sessionorders.cancelled','=',0)
            ->groupBy('sessionorders.know_id')
            ->get();

        // deze aangemelden sessies worden gemerged
        if ($orders->isEmpty()) {
            foreach ($sessions as $session){
                $session->orders = 0;
            }
        }
        else{
            foreach ($sessions as $session){
                foreach ($orders as $order){
                    if ($session->k_id == $order->know_id) {
                        $session->orders = $order->orders;
                    } else {
                       if(isset($session->orders) < 1){
                           $session->orders = 0;
                       }
                    }
                }
            }
        }
        return $sessions;
    }
    //deze functie haalt een sessie op met al zijn gebruikers
    function getSessionUsers($id){
        return DB::table('sessionorders')
            ->join('users', 'sessionorders.user_id','=','users.id')
            ->select('sessionorders.id as ses_id', 'users.id as user_id', 'sessionorders.*', 'users.*')
            ->where('sessionorders.know_id', $id)
            ->get();
    }
    //deze functie haalt een sessie op waar het id matched
    function getSessionDetails($id){

        return DB::table($this->table)
            ->join('users', 'knowledgesessions.user_id','=','users.id')
            ->select('knowledgesessions.id as know_id', 'users.id as user_id', 'knowledgesessions.*', 'users.*')
            ->where('knowledgesessions.id', $id)
            ->first();

    }
    // deze functie haalt user details op voor een sessie
    function getUsers(){
        return DB::table('users')
            ->select('users.firstname','users.lastname','users.id')
            ->where('users.role_id','>',1)
            ->get();
    }
    //deze functie update een kennissessie in de database
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
    //deze functie checked of een gebruik zich all aangemeld heeft voor een sessie en meld zich aan is dat niet zo
    function checkOrder($id){
        $order = DB::table('sessionorders')
            ->select('sessionorders.id')
            ->where([
                ['sessionorders.know_id','=' ,$id],
                ['sessionorders.user_id','=' ,Auth::user()->id],
                ['sessionorders.cancelled','=' ,0]
            ])
            ->get();
        if ($order->isEmpty()) {
            return 0;
        }else{
            return 1;
        }
    }
    //deze functie verwijdert een kennissessie uit de database
    function DeleteSession($k_id){
        DB::table('sessionorders')->where('know_id', '=', $k_id)->delete();
        $result = DB::table('knowledgesessions')->where('id', '=', $k_id)->delete();

        if($result){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    //deze functie zet de feedback data in de database
    function SaveEvaluation($request){

        $data = new \stdClass();
        $data->training = $request->training;
        $data->training_radio = $request->training_radio;
        $data->speed = $request->speed;
        $data->speed_radio = $request->speed_radio;
        $data->performance = $request->performance;
        $data->performance_radio = $request->performance_radio;
        $data->cases = $request->cases;
        $data->cases_radio = $request->cases_radio;
        $data->time = $request->time;
        $data->time_radio = $request->time_radio;
        $data->learn = $request->learn;
        $data->learn_radio = $request->learn_radio;
        $data->knowledge = $request->knowledge;
        $data->knowledge_radio = $request->knowledge_radio;
        $data->learned = $request->learned;
        $data->learned_radio = $request->learned_radio;
        $data->missed = $request->missed;
        $data->strong = $request->strong;
        $data->weak = $request->weak;
        $json=json_encode($data);

        $data = array(
            "user_id" => Auth::user()->id,
            "know_id" => $request->session_id,
            "data" => $json,
        );
        $check  = DB::table('sessionsevaluation')
            ->select()
            ->where([
                ['sessionsevaluation.know_id','=',$request->session_id],
                ['sessionsevaluation.user_id', '=',Auth::user()->id]
            ])
            ->get()
            ->first();

        if($check == null){
            $insert = DB::table('sessionsevaluation')->insert($data);
            if($insert !== false){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    // deze functie zet een gebruiker aanwezig
    function attendUser($sid){
        echo $sid;
        $update = DB::table('sessionorders')
            ->where("id", "=", $sid)
            ->update(["attended" => 1]);

        if($update !== false){
            return true;
        }
        else{
            return false;
        }
    }
    //deze functie haalt alle feedback op van een sessie
    function getFeedBack($id){
        return DB::table('sessionsevaluation')
            ->select()
            ->join('users', 'sessionsevaluation.user_id','=','users.id')
            ->join('knowledgesessions', 'knowledgesessions.id', '=', 'sessionsevaluation.know_id')
            ->where('know_id', '=', $id)
            ->get();

    }

}
