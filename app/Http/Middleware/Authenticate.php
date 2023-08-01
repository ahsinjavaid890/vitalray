<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Redirect;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {   

        if(Auth::check()){
            if(Auth::user()->email_verify == 1)
            {
                return $next($request);    
            }else{
                $url = url('verifyemail');
                return Redirect::to($url);
            }
        }else{
            return route('user.signin');
        }
    }
}
