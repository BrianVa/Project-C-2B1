<?php

namespace App\Http\Controllers;

use App\KnowledgesessionModel;
use Illuminate\Http\Request;
use App\EmployeeModel;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    function EmployeeView(){
        if(isset(Auth::user()->email)) {
            $data = KnowledgesessionModel::all();
            return view('employee/overview', [
                'users' => $data
            ]);
        }else{
            return redirect('/');
        }
    }
}
