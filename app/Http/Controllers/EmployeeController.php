<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeModel;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    function EmployeeView(){
        if(isset(Auth::user()->email)) {
            $Employee = new EmployeeModel();
            $users = $Employee->GetUsers();
            return view('employee/overview', [
                'users' => $users
            ]);
        }else{
            return redirect('/');
        }
    }
}
