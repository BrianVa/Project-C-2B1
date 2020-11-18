<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\KnowledgesessionModel;
use App\SessionOrderModel;

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
            $data = "1";
            return view('KnowledgeSession/add', [
                'data' => $data
            ]);
        }
        else{
            return redirect('/');
        }
    }

    function addSession(Request $request){

        $this->validate($request, [
            "title" => "required",
            "desc" => "required",
            "min_aten" => "required|numeric",
            "max_aten" => "required|numeric|gte:min_aten",
            "begin_time" => "required",
            "end_time" => "required"
        ]);

        $session = new KnowledgesessionModel();
        $result = $session->insertsession($request,Auth::user()->id);

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
            return view('KnowledgeSession/userview', [
                'data' => $data
            ]);
        }
        else {
            return redirect('/');
        }
    }
    function SignupSession(Request $request){

        $session = new SessionOrderModel();
        $data = $session->SetOrder($request->route('id'));

        if($data){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    function CancelSession(Request $request){

    }
}
