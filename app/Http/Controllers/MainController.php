<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use App\MainModel;
use App\Rules\CimsolutionEmail;
use App\SexModel;
use App\Mail\RegMail;
use Illuminate\support\Facades\Mail;

class MainController extends Controller
{
    function LoginView()
    {
        if(isset(Auth::user()->email))
        {
            return redirect('/dashboard');
        }
        else{
            $sexes = SexModel::all();
            return view('login/login', [
                'sexes' => $sexes
            ]);
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

    function register(Request $request){

        $this->validate($request, [
            "password" => "required|same:h_password",
            "h_password" => "required|same:password",
            "firstname" => "required|min:3|max:100",
            "lastname" => "required|min:3|max:100",
            "email" => [
                "required",
                "email",
                "unique:users",
                new CimsolutionEmail()
            ],
            "sex" => "required|gt:0",
            "diet" => "max:255"
        ]);

        $session = new MainModel();
        $result = $session->insertuser($request);

        if($result){
           // \Mail::to('0952635@hr.nl')->send(new RegMail($request));
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
