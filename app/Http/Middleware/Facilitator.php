<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Facilitator
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id >= 2){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
