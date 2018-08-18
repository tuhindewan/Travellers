<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckStatus
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
        $response = $next($request);
        //If the status is not approved redirect to login 
        if(Auth::check() && Auth::user()->verifiedstatus == 0){
            return redirect('/users/account-verification/'.Auth::user()->_id);
        }
        return $response;
    }
}
