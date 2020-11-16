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

    function EmployeeDetails(Request $request)
    {
        $userid = $request->route('id');
        $Employee = new EmployeeModel();
        $users = $Employee->GetUser($userid);
        return view('employee/employee', [
            'employee' => $users
        ]);
    }

    function UpdateEmployee(Request $request)
    {
        $rules = array(
            "password" => "same:h_password",
            "h_password" => "same:password",
            "firstname" => "min:3|max:100|required",
            "lastname" => "min:3|max:100|required",
            "email" => "required|email",
            "diet" => "max:255"
        );

        if ($request->email != $request->oldemail){
            array_merge($rules, array(
                $rules["email"] = "required|email|unique:users,email"
            ));
        }
        $this->validate($request, $rules);
        $Employee = new EmployeeModel();
        $result = $Employee->updateuser($request, intval($request->userid));

        if($result){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
