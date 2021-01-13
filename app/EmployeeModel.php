<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeModel extends Model
{
    protected $table = 'users';

    //deze functie haalt alle gebruikers op
    function GetUsers(){
        $user = DB::table($this->table)
            ->join('roles', 'users.role_id','=','roles.id')
            ->join('sex', 'users.sex_id','=','sex.id')
            ->select('sex.name as gender', 'roles.name as function', 'users.*')
            ->get();

        return $user;
    }
    //deze functie haalt 1 gebruiker op waar id matched
    function GetUser($id){
        $user = DB::table($this->table)
            ->join('roles', 'users.role_id','=','roles.id')
            ->join('sex', 'users.sex_id','=','sex.id')
            ->select('sex.name as gender', 'roles.name as function','users.id as user_id','users.*')
            ->where('users.id', $id)
            ->first();
        return $user;
    }
    // deze functie update de gegevens van een gebruiker met data van de controller
    function updateuser($request, $id){

        $data = array(
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "dietary" => $request->diet,
            "role_id" => $request->role
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

