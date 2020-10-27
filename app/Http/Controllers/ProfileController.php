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
            "firstname" => "min:3|max:100|required",
            "lastname" => "min:3|max:100|required",
            "email" => "required|email",
            "diet" => "max:255"
        );

        if ($request->email != Auth::user()->email){
            array_merge($rules, array(
                $rules["email"] = "required|email|unique:users,email"
            ));
        }

        $this->validate($request, $rules);

        $profile = new ProfileModel();
        $result = $profile->updateuser($request,Auth::user()->id);

        if($result){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
