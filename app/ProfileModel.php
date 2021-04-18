<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileModel extends Model
{
    protected $table = 'users';

    // deze functie haalt de gegevens op van de ingelogde gebruiker
    function getdata($id){
        $user = DB::table($this->table)
            ->join('roles', 'users.role_id','=','roles.id')
            ->join('sex', 'users.sex_id','=','sex.id')
            ->select('sex.name as gender', 'roles.name as function', 'users.*')
            ->where('users.id', $id)
            ->first();
        return $user;
    }
    //deze functie update de gegevens op van de ingelogde gebruiker
    function updateuser($request, $id){

        $data = array(
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "dietary" => $request->diet,

        );
        if($request->image) {

            if(Auth::user()->avatar!='profile.png')
            {
                File::delete(public_path('img\profile\images\\'.Auth::user()->avatar));
            }

            $data["avatar"] = $request->image->hashName();
            $request->image->store('images', 'public');
        }

        if($request->password){
            array_merge($data, array(
                $data["password"] = Hash::make(trim($request->password))
            ));
        }

        $update = DB::table($this->table)
            ->where('id', $id)
            ->update($data);


        if($update !== false){
            if($request->image) {
                Auth::user()->avatar = $request->image->hashName();
            }
            return true;
        }
        else{
            return false;
        }
    }
    // deze functie haalt de sessies van de gebruiker op die ingeloged is
    function getsessionsorders($id, $type){
        if($type == 'now'){

            $session = DB::table("sessionorders")
                ->join('knowledgesessions', 'sessionorders.know_id','=','knowledgesessions.id')
                ->join('users', 'knowledgesessions.user_id','=','users.id')
                ->select('knowledgesessions.id as k_id', 'sessionorders.id as s_id', 'users.id as u_id' ,'knowledgesessions.*', 'sessionorders.*', 'users.*')
                ->where([
                    ['sessionorders.user_id', '=', $id],
                    ['sessionorders.cancelled', '=', false]
                ])
                ->whereDate('knowledgesessions.begin_date', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                ->get();

            return $session;
        }
        elseif($type == 'done'){

            $session = DB::table("sessionorders")
                ->join('knowledgesessions', 'sessionorders.know_id','=','knowledgesessions.id')
                ->join('users', 'knowledgesessions.user_id','=','users.id')
                ->select('knowledgesessions.id as k_id', 'sessionorders.id as s_id', 'users.id as u_id' ,'knowledgesessions.*', 'sessionorders.*', 'users.*')
                ->where([
                    ['sessionorders.user_id', '=', $id],
                    ['sessionorders.cancelled', '=', false]
                ])
                ->whereDate('knowledgesessions.begin_date', '<', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                ->get();

            return $session;

        }
        elseif($type == 'can'){

            $session = DB::table("sessionorders")
                ->join('knowledgesessions', 'sessionorders.know_id','=','knowledgesessions.id')
                ->join('users', 'knowledgesessions.user_id','=','users.id')
                ->select('knowledgesessions.id as k_id', 'sessionorders.id as s_id', 'users.id as u_id' ,'knowledgesessions.*', 'sessionorders.*', 'users.*')
                ->where([
                    ['sessionorders.user_id', '=', $id],
                    ['sessionorders.cancelled', '=', true]
                ])
                ->get();

            return $session;
        }
    }
    // deze functie haald de sessie van deze maand op
    function getsessionssoon($id){
        $now = Carbon::now();
        $session = DB::table("sessionorders")
            ->join('knowledgesessions', 'sessionorders.know_id','=','knowledgesessions.id')
            ->join('users', 'users.id','=','knowledgesessions.user_id')
            ->select('knowledgesessions.id as k_id', 'sessionorders.id as s_id', 'users.id as u_id' ,'knowledgesessions.*', 'sessionorders.*', 'users.*')
            ->where([
                ['sessionorders.user_id', '=', $id],
                ['sessionorders.cancelled', '=', true],
            ])
            ->whereMonth('knowledgesessions.begin_date', $now->month)
            ->limit(4)
            ->get();

        return $session;
    }
}
