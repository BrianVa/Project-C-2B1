<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Employee
{

    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id >= 1){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
