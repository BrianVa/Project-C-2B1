<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\ProfileModel;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //deze functie laad het profiel van de gebruiker
    function ProfileView(){
        if(isset(Auth::user()->email)) {
            $profile = new ProfileModel();
            $data = $profile->getdata(Auth::user()->id);
            $sessionsnow = $profile->getsessionsorders(Auth::user()->id, 'now');
            $sessionsdone = $profile->getsessionsorders(Auth::user()->id, 'done');
            $sessionscan = $profile->getsessionsorders(Auth::user()->id, 'can');
            $soon = $profile->getsessionssoon(Auth::user()->id);
            return view('profile/profile', [
                'data' => $data,
                'sessionsnow' => $sessionsnow,
                'sessionsdone' => $sessionsdone,
                'sessionscan' => $sessionscan,
                'soon' => $soon
            ]);
        }
        else{
            return redirect('/');
        }
    }
    // deze functie valideert de update gegevens van de gebruiker en stuud ze naar de model
    function UpdateUserData(Request $request){
        $rules = array(
            "password" => "same:h_password",
            "h_password" => "same:password",
            "firstname" => "min:3|max:100|required",
            "lastname" => "min:3|max:100|required",
            "email" => "required|email",
            "diet" => "max:255",
            "image" => "mimes:jpeg,jpg,png|max:10000"
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
            return redirect()->back()->with('succesMessage', 'De gegevens zijn aangepast.');
        }else{
            return redirect()->back()->with('errorMessage', 'Er ging iets fout.');
        }
    }
}
