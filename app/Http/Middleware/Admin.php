<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id >= 4){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
