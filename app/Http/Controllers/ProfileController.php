<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\ProfileModel;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    function ProfileView(){
        if(isset(Auth::user()->email)) {
            $profile = new ProfileModel();
            $data = $profile->getdata(Auth::user()->id);
            $sessionsnow = $profile->getsessionsorders(Auth::user()->id, 'now');
            $sessionsdone = $profile->getsessionsorders(Auth::user()->id, 'done');
            $sessionscan = $profile->getsessionsorders(Auth::user()->id, 'can');
            return view('profile/profile', [
                'data' => $data,
                'sessionsnow' => $sessionsnow,
                'sessionsdone' => $sessionsdone,
                'sessionscan' => $sessionscan
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
            "diet" => "max:255",
            "image" => "mimes:jpeg,jpg,png|required|max:10000"
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
