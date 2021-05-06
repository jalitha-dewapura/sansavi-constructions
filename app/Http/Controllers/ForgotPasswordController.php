<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index(){
        if( auth()->check() ){
            return redirect()->route('dashboard.index');////need to change
        }
        
        return view('forgot_password'); 
    }

    public function forgot(Request $request) {
        $rules = array(
            'email'    => ['required', 'email'],
        );
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors( $validator )
            ->withInput();
        }else{
            $status = Password::sendResetLink(
                $request->only('email')
            );

            dd($status);
            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);

            // $email = $request->email;
            // $user = User::where('email', '=', $email)->first();
            // $credentials = array(
            //     'email'     => $email
            // );
            // Password::sendResetLink($credentials);

            // return redirect()
            //     ->route('login.index')
            //     ->with('success', 'Reset password link is sent to your email.');
        }
    }
}
