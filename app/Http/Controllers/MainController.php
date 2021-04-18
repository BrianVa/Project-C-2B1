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
use phpDocumentor\Reflection\Types\Collection;

class MainController extends Controller
{
    // deze functie laad de login pagina
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

    // deze functie laad het dashboard
    function DashboardView()
    {
        if(isset(Auth::user()->email))
        {
            return redirect('/profiel');
        }
        else{
            return redirect('/');
        }
    }
    // deze functie checkt of de gebruiker die wil inloggen ok kan en of mag inloggen
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
            if(Auth::user()->verified != 1){
                Auth::logout();
                return redirect('/')->with('errorMessage', 'uw account is niet geverifieerd. Bekijk uw email om de activatiemail te vinden!');
            }else {
                return redirect('/dashboard');
            }
        }
        else
        {
            return back()->with('error', 'Verkeerde logingegevens.');
        }
    }
    // deze functie in voor het uitloggen
    function logout(){

        Auth::logout();
        return redirect('/');
    }
    // deze functie valideert de gegevens van een nieuwe gebruiker en stuurd de data naar de model
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
                //new CimsolutionEmail()
            ],
            "sex" => "required|gt:0",
            "diet" => "max:255"
        ]);

        $session = new MainModel();
        $code = sha1(time());
        $result = $session->insertuser($request, $code);

        if($result){
            $collection = collect(['firstname' => $request->firstname, 'lastname' => $request->lastname, 'ver_code' => $code]);
            \Mail::to($request->email)->send(new RegMail($collection));
            return redirect()->back()->with('succesMessage', 'Succes! Uw account is aangemaakt. Verifieer uw email om te kunnen inloggen.');
        }else{
            return redirect()->back()->with('errorMessage', 'Er ging iets fout, probeer het opnieuw.');
        }

    }
    // deze functie checked of de activatie mail goed is
    function verifyAccount(Request $request){
        $main = new MainModel();
        $result = $main->verifyAccount(\Illuminate\Support\Facades\Request::get('code'));

        if($result){
            return redirect('/')->with('succesMessage', 'Succes! Uw account is geverifieerd. U kunt nu inloggen.');
        }else{
            return redirect('/')->with('errorMessage', 'Er ging iets fout, probeer het opnieuw.');
        }
    }
}
