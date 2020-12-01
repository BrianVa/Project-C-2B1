<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionOrderModel extends Model
{
    protected $table = 'sessionorders';

    function SetOrder($id){

        $session = DB::table($this->table)
        ->select()
        ->where([
            ['user_id', '=',Auth::user()->id],
            ['know_id', '=',$id],
            ['cancelled', '=',0]
        ])
        ->exists();
        if ($session == false) {

            $counters = DB::table($this->table)
                ->select(array('knowledgesessions.max_atendees', DB::raw('COUNT(sessionorders.know_id) as total')))
                ->leftJoin('knowledgesessions','knowledgesessions.id','=','sessionorders.know_id')
                ->where([
                    ['sessionorders.cancelled','=',0],
                    ['knowledgesessions.id','=',$id],
                    ['sessionorders.know_id','=',$id]
                ])
                ->first();
            if($counters->max_atendees == $counters->total){
                return false;
            }
            else{
                $data = array(
                    "user_id" => Auth::user()->id,
                    "know_id" => $id,
                    "sign_up_at" => new DateTime(),
                );
                $insert = DB::table($this->table)->insertGetId($data);

                if($insert){
                    return $insert;
                }
                else{
                    return 0;
                }
            }
        }
        else{
            return false;
        }
    }
    function CancelSession($id){
        $data = array(
            "cancelled" => 1

        );
        $update = DB::table($this->table)
            ->where('id', $id)
            ->update($data);

        if($update !== false){
            return true;
        }
        else{
            return false;
        }
    }
    function GetSessionById($id){
        return DB::table($this->table)
            ->select()
            ->join('users', 'sessionorders.user_id','=','users.id')
            ->join('knowledgesessions', 'sessionorders.know_id','=','knowledgesessions.id')
            ->where('sessionorders.id','=',1)
            ->first();
    }
}
