<?php

namespace App\Http\Middleware;

use Closure;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        /*$headers = [  
            'Access-Control-Allow-Methods'=> 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers'=> 'X-Requested-With, Content-Type, X-Auth-Token, Authorization, Origin'
        ];*/
        /*if($request->getMethod() == "OPTIONS") {
            return Response::make('OK', 200, $headers);
        }*/
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        /*foreach($headers as $key => $value){
            $response->header($key, $value);
        }*/
        return $response;
    }
}
