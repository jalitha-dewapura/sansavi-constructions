<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if( !auth()->user() ){
            return redirect()->back();
        }
        
        if( ($roles) && (!in_array( auth()->user()->user_role_id, $roles )) ){
            return redirect()->back();
        }
        
        return $next($request);
    }
}
