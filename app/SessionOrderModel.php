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
            ['know_id', '=',$id]
        ])
        ->exists();
        if ($session == false) {
            $data = array(
                "user_id" => Auth::user()->id,
                "know_id" => $id,
                "sign_up_at" => new DateTime(),
            );
            $insert = DB::table($this->table)->insert($data);

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
}
