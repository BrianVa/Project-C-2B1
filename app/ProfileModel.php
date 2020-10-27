<?php

namespace App;

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
}
