<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class MainModel extends Model
{
    // deze functie zet een gebruiker in de database
    function insertuser($request, $code){
        $data = array(
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "dietary" => $request->diet,
            "password" => Hash::make(trim($request->password)),
            "dateofbirth" => new DateTime($request->dateofbirth),
            "verification_code" => $code,
            "sex_id" => $request->sex,
            "role_id" => 1,
            "created_at" => new DateTime(),
            "updated_at" => new DateTime()
        );

        $insert = DB::table("users")->insert($data);

        if($insert !== false){
            return true;
        }
        else{
            return false;
        }
    }
    // deze functie verifieerd je account
    function verifyAccount($code){
        $check = DB::table('users')
            ->select('verification_code')
            ->where('verification_code','=',$code)
            ->first();

        if($check != null){
            $update = DB::table('users')
                ->where('verification_code','=',$code)
                ->update(["verified" => 1]);

            if($update !== false){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }
}
