<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session as Session;
use \Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    public function index(){
        if( auth()->check() ){
            return redirect()->route('dashboard.index');////need to change
        }
        
        return view('login'); 
    }

    public function login(Request $request){
        $rules = array(
            'email'    => ['required', 'email'],
            'password' => ['required']
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput( $request->except(['password']) );
        }else{
            $email    = $request->input('email');
            $password = $request->input('password');
            $remember = false;
            $credentials = array(
                'email'     => $email,
                'password'  => $password
            );
            
            auth()->attempt( $credentials );
            if( auth()->check() ){
                return redirect()->route('dashboard.index');//need to change
            }else{
                return redirect()
                    ->back()
                    ->with('error', 'Username or Password is invalid!')
                    ->withInput( $request->except(['password']) );
            }
        }
    }

    public function logout(Request $request){
        //
        auth()->logout();
        Session::flush();
        return redirect()->route('login.index', []);
    }
}
