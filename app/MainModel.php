<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class MainModel extends Model
{
    function insertuser($request){
        $data = array(
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "dietary" => $request->diet,
            "password" => Hash::make(trim($request->password)),
            "dateofbirth" => new DateTime($request->begin_time),
            "sex_id" => $request->sex,
        );

        $insert = DB::table("users")->insert($data);

        if($insert !== false){
            return true;
        }
        else{
            return false;
        }
    }
}
