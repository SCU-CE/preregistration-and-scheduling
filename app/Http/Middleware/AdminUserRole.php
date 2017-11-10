<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->isStudent()){
            return redirect('student/home');
        }

        $user = Auth::user();
        $user->last_visit_time = Carbon::now();
        $user->save();

        return $next($request);
    }
}
