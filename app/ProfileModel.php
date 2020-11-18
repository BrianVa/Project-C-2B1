<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileModel extends Model
{
    protected $table = 'users';


    function getdata($id){
        $user = DB::table($this->table)
            ->join('roles', 'users.role_id','=','roles.id')
            ->join('sex', 'users.sex_id','=','sex.id')
            ->select('sex.name as gender', 'roles.name as function', 'users.*')
            ->where('users.id', $id)
            ->first();
        return $user;
    }
    function updateuser($request, $id){

        $data = array(
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "dietary" => $request->diet,

        );

        if($request->password){
            array_merge($data, array(
                $data["password"] = Hash::make(trim($request->password))
            ));
        }

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
    function getsessionsorders($id, $type){
        $now = new DateTime();
        $select = array();

        if($type == 'now'){
            $select = [
                ['sessionorders.user_id', '=', $id],
                ['knowledgesessions.begin_date', '>=', $now],
                ['sessionorders.cancelled', '=', false]
            ];
        }
        elseif($type == 'done'){
            $select = [
                ['sessionorders.user_id', '=', $id],
                ['knowledgesessions.begin_date', '<', $now],
                ['sessionorders.cancelled', '=', false]
            ];

        }
        elseif($type == 'can'){
            $select = [
                ['sessionorders.user_id', '=', $id],
                ['sessionorders.cancelled', '=', true]
            ];
        }

        $session = DB::table("sessionorders")
            ->join('knowledgesessions', 'sessionorders.know_id','=','knowledgesessions.id')
            ->join('users', 'knowledgesessions.user_id','=','users.id')
            ->select('knowledgesessions.id as k_id', 'sessionorders.id as s_id', 'users.id as u_id' ,'knowledgesessions.*', 'sessionorders.*', 'users.*')
            ->where($select)
            ->get();

        return $session;
    }
}
