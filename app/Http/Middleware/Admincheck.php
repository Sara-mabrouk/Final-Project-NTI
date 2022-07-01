<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admincheck
{
    public function handle(Request $request, Closure $next)
    {

        if(auth()->check()){
        return $next($request);
        }else{
            return redirect(url('/Login'));
        }
    }
}
