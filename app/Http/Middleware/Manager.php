<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manager
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id >= 3){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
