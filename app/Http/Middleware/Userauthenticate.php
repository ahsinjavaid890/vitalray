<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Userauthenticate
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
        if(Auth::check()){
            return $next($request);

            // if(Auth::user()->steps == 5)
            // {
                
            // }elseif(Auth::user()->steps == 4)
            // {
            //     return redirect('stepfive')->with('warning',"Please Complete Step Three");
            // }elseif(Auth::user()->steps == 3)
            // {
            //     return redirect('stepfour')->with('warning',"Please Complete Step Three");
            // }elseif(Auth::user()->steps == 2){
            //     return redirect('stepthree')->with('warning',"Please Complete Step Three");
            // }elseif(Auth::user()->steps == 1)
            // {
            //      return redirect('steptwo')->with('warning',"Please Complete Step Two");
            }
            
        
        return redirect('signin')->with('error',"You don't have admin access.");
    }
}
