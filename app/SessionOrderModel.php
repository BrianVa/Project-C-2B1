<?php

namespace App;

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
                    "sign_up_at" => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
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
    function anuSession($know_id, $user_id){
        $update = DB::table($this->table)
            ->where([
                ["know_id", "=", $know_id],
                ["user_id", "=", $user_id]
            ])
            ->update(["cancelled" => 1]);

        if($update !== false){
            return true;
        }
        else{
            return false;
        }
    }

    function RemoveAttendee($know_id, $user_id){
        $result = DB::table($this->table)
            ->where([
                ["know_id", "=", $know_id],
                ["user_id", "=", $user_id],
                ["cancelled", "=", 1]
            ])
            ->delete();

        if($result !== false){
            return true;
        }
        else{
            return false;
        }
    }

    function GetApplicants($id){

        $test = array_map(function ($value) {
            return (array)$value;
        }, DB::table($this->table)
            ->select('user_id')
            ->where('know_id','=', $id)
            ->get()
            ->toArray());

        $users = DB::table('users')
            ->join('roles', 'users.role_id','=','roles.id')
            ->join('sex', 'users.sex_id','=','sex.id')
            ->select('sex.name as gender', 'roles.name as function', 'users.*')
            ->whereNotIn('users.id', $test)
            ->get();

        return $users;
    }

    function AddAttendee($know_id, $id){
        $session = DB::table($this->table)
            ->select()
            ->where([
                ['user_id', '=',$id],
                ['know_id', '=',$know_id],
                ['cancelled', '=',0]
            ])
            ->exists();
        if ($session == false) {

            $counters = DB::table($this->table)
                ->select(array('knowledgesessions.max_atendees', DB::raw('COUNT(sessionorders.know_id) as total')))
                ->leftJoin('knowledgesessions','knowledgesessions.id','=','sessionorders.know_id')
                ->where([
                    ['sessionorders.cancelled','=',0],
                    ['knowledgesessions.id','=',$know_id],
                    ['sessionorders.know_id','=',$know_id]
                ])
                ->first();
            if($counters->max_atendees == $counters->total){
                return false;
            }
            else{
                $data = array(
                    "user_id" => $id,
                    "know_id" => $know_id,
                    "sign_up_at" => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
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
}
