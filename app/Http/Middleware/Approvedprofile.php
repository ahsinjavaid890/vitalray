<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Approvedprofile
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
        if(Auth::user()->approve_status == 'approved'){
            return $next($request);
        }
        return redirect()->back()->with('warning', 'Your Profile is Not Approved.');
    }
}
