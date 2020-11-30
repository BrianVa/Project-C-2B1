<?php

namespace App\Http\Controllers;

use App\Mail\CancelSession;
use App\Mail\SignUpSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\KnowledgesessionModel;
use App\SessionOrderModel;
use Illuminate\support\Facades\Mail;


class KnowledgesessionController extends Controller
{
    function KnowledgesessionView(){
        if(isset(Auth::user()->email))
        {
            $data = new KnowledgesessionModel();
            $sessions = $data->getSessions();
            return view('KnowledgeSession/overview', [
                'data' => $sessions
            ]);
        }
        else{
            return redirect('/');
        }
    }

    function addView(){
        if(isset(Auth::user()->email))
        {
            $data = new KnowledgesessionModel();
            $gebruikers = $data->getUsers();
            return view('KnowledgeSession/add', [
                'gebruikers' => $gebruikers
            ]);
        }
        else{
            return redirect('/');
        }
    }

    function addSession(Request $request){
        $rules = [
            "title" => "required",
            "desc" => "required",
            "min_aten" => "required|numeric",
            "max_aten" => "required|numeric|gte:min_aten",
            "begin_time" => "required",
            "end_time" => "required|after:begin_time"
        ];
        if (Auth::user()->role_id > 1){
            array_merge($rules, array(
                $rules["Sessionleader"] = "required"
            ));
        }
        $this->validate($request,$rules);

        $session = new KnowledgesessionModel();
        if (Auth::user()->role_id > 1) {
            $result = $session->insertsession($request, intval($request->Sessionleader));

        }
        else {
            $result = $session->insertsession($request, Auth::user()->id);
        }

        if($result){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }


    function SessionUserView(Request $request){

        if(isset(Auth::user()->email))
        {
            $session = new KnowledgesessionModel();
            $data = $session->getSessionDetails($request->route('id'));
            $users = $session->getSessionUsers($request->route('id'));
            return view('KnowledgeSession/userview', [
                'data' => $data,
                'users' => $users
            ]);
        }
        else {
            return redirect('/');
        }
    }
    function SignupSession(Request $request){

        $session = new SessionOrderModel();
        $data = $session->SetOrder($request->route('id'));

        if($data > 0){
            \Mail::to('brianvaartjes@gmail.com')->send(new SignUpSession($session->GetSessionById($request->route($data))));
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    function CancelSession(Request $request){
        if(isset(Auth::user()->email))
        {
            $session = new SessionOrderModel();
            $data = $session->CancelSession($request->route('id'));

            if($data){
                $d = $session->GetSessionById($request->route('id'));
                \Mail::to('brianvaartjes@gmail.com')->send(new CancelSession($d));
                return redirect()->back();
            }else{
                return redirect()->back();
            }

        }
        else {
            return redirect('/');
        }
    }

    function SessionView(Request $request){
        if(isset(Auth::user()->email))
        {
            $session = new KnowledgesessionModel();
            $data = $session->getSessionDetails($request->route('id'));
            $gebruikers = $session->getUsers();
            return view('KnowledgeSession/sessionview', [
                'data' => $data,
                'gebruikers' => $gebruikers
            ]);
        }
        else{
            return redirect('/');
        }
    }

    function updateSession(Request $request){

        $rules = [
            "title" => "required",
            "desc" => "required",
            "min_aten" => "required|numeric",
            "max_aten" => "required|numeric|gte:min_aten",
            "begin_time" => "required",
            "end_time" => "required|after:begin_time",
            "Sessionleader" => "required"
        ];

        $this->validate($request,$rules);
        $session = new KnowledgesessionModel();
        $result = $session->updatesession($request);

        if($result){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
