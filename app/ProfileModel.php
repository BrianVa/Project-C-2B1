<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfileModel extends Model
{
    protected $table = 'users';


    function getdata($id){
        $user = DB::table($this->table)
            ->where('id', $id)
            ->get();
        return $user;
    }
}
