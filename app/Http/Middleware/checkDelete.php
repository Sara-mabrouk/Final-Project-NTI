<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkDelete
{

    public function handle(Request $request, Closure $next)
    {


        if (auth()->user()->id == $request->id) {
            session()->flash('Message', "Can't Remove Your Account .. ");
            return redirect(url('Admin'));
        } else {
            return $next($request);
        }
    }
}
