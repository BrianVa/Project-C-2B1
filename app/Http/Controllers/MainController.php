<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    function LoginView()
    {
        if(isset(Auth::user()->email))
        {
            return redirect('/dashboard');
        }
        else{
            return view('login/login');
        }

    }

    function DashboardView()
    {
        if(isset(Auth::user()->email))
        {
            return view('dashboard/panel');
        }
        else{
            return redirect('/');
        }
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
            ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
        {

            return redirect('/dashboard');
        }
        else
        {
            return back()->with('error', 'Verkeerde login gegevens');
        }
    }

    function logout(){

        Auth::logout();
        return redirect('/');
    }
}
