<?php

namespace App\Http\Controllers;

use App\EmployeeModel;
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
            return view('KnowledgeSession/publicoverview', [
                'data' => $sessions
            ]);
        }
        else{
            return redirect('/');
        }
    }
    function KnowledgesessionBeheer(){
        if(isset(Auth::user()->email))
        {
            $data = new KnowledgesessionModel();
            $sessions = $data->getFacSessions();
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
            return redirect()->back()->with('succesMessage', 'Je hebt een kennissessie aangemaakt!');
        }else{
            return redirect()->back();
        }
    }


    function SessionUserView(Request $request){

        if(isset(Auth::user()->email))
        {
            $session = new KnowledgesessionModel();
            $applicant = new SessionOrderModel();
            $data = $session->getSessionDetails($request->route('id'));
            $users = $session->getSessionUsers($request->route('id'));
            $applicants = $applicant->GetApplicants($request->route('id'));
            $data->checked = $session->checkOrder($request->route('id'));

            return view('KnowledgeSession/userview', [
                'data' => $data,
                'users' => $users,
                'applicants' => $applicants
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
           // \Mail::to('0952635@hr.nl')->send(new SignUpSession($session->GetSessionById($request->route($data))));
            return redirect()->back()->with('succesMessage', 'Je bent aangemeld voor deze kennissessie!');
        }else{
            return redirect()->back();
        }
    }
    function CancelSession(Request $request){
        if(isset(Auth::user()->email))
        {
            $session = new SessionOrderModel();
            if($session->CancelSession($request->route('id'))){
               // \Mail::to('0952635@hr.nl')->send(new CancelSession($session->GetSessionById($request->route('id'))));
                return redirect()->back()->with('succesMessage', 'Je bent afgemeld voor deze kennissessie!');
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
            return view('KnowledgeSession/sessionview', [
                'data' => $session->getSessionDetails($request->route('id')),
                'gebruikers' => $session->getUsers()
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
            return redirect()->back()->with('succesMessage', 'Je hebt de kennissessie aangepast');
        }else{
            return redirect()->back();
        }
    }
    function anusession(Request $request){
        $session = new SessionOrderModel();
        if($session->anuSession($request->route('know_id'), $request->route('user_id'))){
//doesnt work need to fix the id!!!!!!
            // \Mail::to('0952635@hr.nl')->send(new CancelledByFac($session->GetSessionById($request->route('id'))));
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    function DeleteSession(Request $request){
        if(isset(Auth::user()->email))
        {
            $session = new KnowledgesessionModel();
            $data = $session->DeleteSession($request->route('id'));


            if($data){
            //    $d = $session->DeleteSession($request->route('id'));
                // \Mail::to('0952635@hr.nl')->send(new CancelSession($d));
                return redirect()->back()->with('succesMessage', 'Je hebt een kennissessie verwijderd!');
            }else{
                return redirect()->back();
            }
        }
        else {
            return redirect('/');
        }
    }

    function removeAttendee(Request $request){
        $session = new SessionOrderModel();
        if($session->RemoveAttendee($request->route('know_id'), $request->route('user_id'))){

            return redirect()->back()->with('succesMessage', 'Je hebt een deelnemer verwijderd');
        }else{
            return redirect()->back();
        }
    }

    function addAttendee(Request $request){
        $session = new SessionOrderModel();
        $data = $session->AddAttendee($request->route('know_id'), $request->route('id'));

        if($data > 0){
            // \Mail::to('0952635@hr.nl')->send(new SignUpSession($session->GetSessionById($request->route($data))));
            return redirect()->back()->with('succesMessage', 'Je hebt een deelnemer toegevoegd');
        }else{
            return redirect()->back();
        }
    }

}
