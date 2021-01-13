<?php

namespace App\Http\Controllers;

use App\EmployeeModel;
use App\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // deze functie laad de view in van het gebruikers overzicht
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
    //deze functie laad de gebruikers pagina op
    function EmployeeDetails(Request $request)
    {
        $userid = $request->route('id');
        $Employee = new EmployeeModel();
        $users = $Employee->GetUser($userid);
        $roles = RoleModel::all();
        return view('employee/employee', [
            'employee' => $users,
            'roles' => $roles
        ]);
    }
    // deze functie valideerd de update gegevens van een gebruiker een stuurd de data op naar de model
    function UpdateEmployee(Request $request)
    {
        $rules = array(
            "password" => "same:h_password",
            "h_password" => "same:password",
            "firstname" => "min:3|max:100|required",
            "lastname" => "min:3|max:100|required",
            "email" => "required|email",
            "diet" => "max:255",
            "role" => "required"
        );

        if ($request->email != $request->oldemail){
            array_merge($rules, array(
                $rules["email"] = "required|email|unique:users,email"
            ));
        }
        $this->validate($request, $rules);
        $Employee = new EmployeeModel();
        $result = $Employee->updateuser($request, intval($request->userid));

        // Zorgt ervoor dat gebruiker een melding krijgt van de hem of haar doorgevoerde gegevens.
        if($result){
            return redirect()->back()->with('succesMessage', 'De gegevens zijn aangepast.');
        }else{
            return redirect()->back()->with('errorMessage', 'Er ging iets fout.');
        }
    }
}
