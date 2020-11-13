<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MY_Controller extends Controller
{
    protected $data = array('title' => 'Title', 'text' => 'description', 'type' => 'success', 'timer' => 3000);
    protected $auth_user_object = null;
    
    public function __construct(){
        //
        //parent::__construct();
        $this->middleware( function( $request, $next ){
            if( auth()->check() ){
                $this->auth_user_object = auth()->user();
            }
            return $next( $request );
        });
    }
}
