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
            $data = '1';
            return view('profile/profile', [
                'data' => $data
            ]);
        }
        else{
            return redirect('/');
        }
    }
}
