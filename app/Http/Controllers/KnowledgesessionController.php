<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\KnowledgesessionModel;

class KnowledgesessionController extends Controller
{
    function KnowledgesessionView(){
        if(isset(Auth::user()->email))
        {
            $data = KnowledgesessionModel::all();
            return view('KnowledgeSession/overview', [
                'data' => $data
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
}
