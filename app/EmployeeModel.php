<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    protected $table = 'users';

    function GetUsers(){
        $user = DB::table($this->table)
            ->join('roles', 'users.role_id','=','roles.id')
            ->join('sex', 'users.sex_id','=','sex.id')
            ->select('sex.name as gender', 'roles.name as function', 'users.*')
            ->get();
        return $user;
    }
}
