<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cannotDeleteExpiredTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $url = $request->path();
        $id =  filter_var($url, FILTER_SANITIZE_NUMBER_INT);
        $currentTime = Carbon::now();

        $task_data = DB::table('tasks')->find($id);
        if ($task_data->end_date > $currentTime) {
            return $next($request);
        } else {
            session()->flash('Message', "Can't Delete Tasks After Date .. ");
            return redirect(url('Task'));
        }
    }
}
