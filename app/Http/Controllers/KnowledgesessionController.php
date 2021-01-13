<?php

namespace App\Http\Controllers;

use App\EmployeeModel;
use App\Mail\CancelledByFac;
use App\Mail\CancelSession;
use App\Mail\SignUpSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\KnowledgesessionModel;
use App\SessionOrderModel;
use Illuminate\support\Facades\Mail;


class KnowledgesessionController extends Controller
{
    //deze functie laad de view pagina van de algemene kennissessies
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
    //deze functie laad die view pagina van de organisator kennisessies
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

    //deze functie laad die view pagina van de kennissessie toevoegpagina
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

    //deze functie valideerd de data van de toegevoegde kennis sessie en stuurd de data naar de model als hij goed is
    function addSession(Request $request){
        $rules = [
            "title" => "required",
            "desc" => "required",
            "min_aten" => "required|numeric|min:1",
            "max_aten" => "required|numeric|gte:min_aten|max:500",
            "begin_time" => "required",
            "end_time" => "required|after:begin_time"
        ];
        if (Auth::user()->role_id == 4){
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
            return redirect()->back()->with('errorMessage', 'er ging iets fout');
        }
    }

    //deze functie haal alles op voor het kennissessie beheer van de admin en de organisator
    function SessionUserView(Request $request){

        if(isset(Auth::user()->email))
        {
            $session = new KnowledgesessionModel();
            $applicant = new SessionOrderModel();
            $data = $session->getSessionDetails($request->route('id'));
            $users = $session->getSessionUsers($request->route('id'));
            $applicants = $applicant->GetApplicants($request->route('id'));
            $data->checked = $session->checkOrder($request->route('id'));
            $feedback = $session->getFeedBack($request->route('id'));

            return view('KnowledgeSession/userview', [
                'data' => $data,
                'users' => $users,
                'applicants' => $applicants,
                'feedback' => $feedback
            ]);
        }
        else {
            return redirect('/');
        }
    }
    //deze functie is voor het aanmelden van een kennissessie
    function SignupSession(Request $request){

        $session = new SessionOrderModel();
        $data = $session->SetOrder($request->route('id'));

        if($data > 0){
          //  \Mail::to(Auth::user()->email)->send(new SignUpSession($session->GetSessionById($request->route($data))));
            return redirect()->back()->with('succesMessage', 'Je bent aangemeld voor deze kennissessie! ');
        }else{
            return redirect()->back()->with('errorMessage', 'er ging iets fout');
        }
    }
    //deze functie is voor het afmelden van een kennissessie
    function CancelSession(Request $request){
        if(isset(Auth::user()->email))
        {
            $session = new SessionOrderModel();
            if($session->CancelSession($request->route('id'))){
               // \Mail::to(Auth::user()->email)->send(new CancelSession($session->GetSessionById($request->route('id'))));
                return redirect()->back()->with('succesMessage', 'Je bent afgemeld voor deze kennissessie!');
            }else{
                return redirect()->back()->with('errorMessage', 'er ging iets fout');
            }
        }
        else {
            return redirect('/');
        }
    }
    //deze functie laad de view pagina van de
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
    // deze functie valideerd de nieuwe kennissessie data en stuurd deze data naar de model
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
            return redirect()->back()->with('errorMessage', 'er ging iets fout');
        }
    }
    // deze functie anuleerd een kennissessie
    function anusession(Request $request){
        $session = new SessionOrderModel();
        if($session->anuSession($request->route('know_id'), $request->route('user_id'))){
            // \Mail::to(Auth::user()->email)->send(new CancelledByFac($session->GetSessionById($request->route('id'))));
            return redirect()->back()->with('succesMessage', 'Je hebt de kennissessie geannuleerd');
        }else{
            return redirect()->back()->with('errorMessage', 'er ging iets fout');
        }
    }

    // deze functie verwijdert een sessie die niet meer gebruikt word
    function DeleteSession(Request $request){
        if(isset(Auth::user()->email))
        {
            $session = new KnowledgesessionModel();
            $data = $session->DeleteSession($request->route('id'));

            if($data){
               //  \Mail::to(Auth::user()->email)->send(new CancelSession($data));
                return redirect()->back()->with('succesMessage', 'Je hebt een kennissessie verwijderd!');
            }else{
                return redirect()->back()->with('errorMessage', 'er ging iets fout');
            }
        }
        else {
            return redirect('/');
        }
    }
    // deze functie verwijdert een gebruiker die aangemeld is voor een kennissesie
    function removeAttendee(Request $request){
        $session = new SessionOrderModel();
        if($session->RemoveAttendee($request->route('know_id'), $request->route('user_id'))){

            return redirect()->back()->with('succesMessage', 'Je hebt een deelnemer verwijderd');
        }else{
            return redirect()->back()->with('errorMessage', 'er ging iets fout');
        }
    }

    // deze functie voegt een gebruiker toe aan een kennissessie
    function addAttendee(Request $request){
        $session = new SessionOrderModel();
        $data = $session->AddAttendee($request->route('know_id'), $request->route('id'));

        if($data > 0){
            // \Mail::to(Auth::user()->email)->send(new SignUpSession($session->GetSessionById($request->route($data))));
            return redirect()->back()->with('succesMessage', 'Je hebt een deelnemer toegevoegd');
        }else{
            return redirect()->back()->with('errorMessage', 'er ging iets fout');
        }
    }
    //deze functie valideerd het feedback formulier een stuurd de data naar de model
    function EvaluateSession(Request $request){
        $rules = [
            "training" => "required",
            "training_radio" => "required",
            "speed" => "required",
            "speed_radio" => "required",
            "performance" => "required",
            "performance_radio" => "required",
            "cases" => "required",
            "cases_radio" => "required",
            "time" => "required",
            "time_radio" => "required",
            "learn" => "required",
            "learn_radio" => "required",
            "knowledge" => "required",
            "knowledge_radio" => "required",
            "learned" => "required",
            "missed" => "required",
            "strong" => "required",
            "weak" => "required"
        ];

        $this->validate($request,$rules);
        $session = new KnowledgesessionModel();
        $result = $session->SaveEvaluation($request);

        if($result){
            return redirect()->back()->with('succesMessage', 'Je hebt de sessie geevalueerd');
        }else{
            return redirect()->back()->with('errorMessage', 'Er ging iets fout. u mag de sessie maar 1 keer evalueren');
        }
    }
    //deze functie zet een gebruiker aanwezig voor een kennis sessie
    function attendUser(Request $request){

        $session = new KnowledgesessionModel();
        $result = $session->attendUser($request->route('ses_id'));

        if($result){
            return redirect()->back()->with('succesMessage', 'De gebruiker is aanwezig gezet.');
        }else{
            return redirect()->back()->with('errorMessage', 'Er ging iets fout.');
        }
    }
}
