<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfileModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    function ProfileView(){
        if(isset(Auth::user()->email)) {
            $profile = new ProfileModel();
            $data = $profile->getdata(Auth::user()->id);
            return view('profile/profile', [
                'data' => $data
            ]);
        }
        else{
            return redirect('/');
        }
    }

    function UpdateUserData(Request $request){
        $rules = array(
            "password" => "same:h_password",
            "h_password" => "same:password",
            "firstname" => "",
            "lastname" => "",
            "email" => "",
            "diet" => "max:255"
        );
        if($request->firstname != Auth::user()->firstnname){
            array_merge($rules, array(
                $rules["firstname"] = "min:3|max:100"
            ));
        }
        if ($request->lastname != Auth::user()->lastname){
            array_merge($rules, array(
                $rules["lastname"] = "min:3|max:100"
            ));
        }
        if ($request->email != Auth::user()->email){
            array_merge($rules, array(
                $rules["email"] = "email"
            ));
        }
        //print_r($rules);
        $validator = $request->validate($rules);

        if ($validator->fails()) {
           echo "whoops";
        } else {
            echo "yyeah";
        }
    }
}
