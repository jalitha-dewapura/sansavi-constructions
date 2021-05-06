<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use \Exception;
use Illuminate\Support\Facades\Hash;


use App\Models\UserRole;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_roles = UserRole::all();
        return view('user_create', ['user_roles' => $user_roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation 
        $rule = array(
            'user_role_id'  => 'required',
            'name'          => 'required',
            'username'      => 'required',
            'email'         => ['required', 'unique:users'],
            'phone'         => 'required',
            'password'      => 'required'
        );

        $validator = Validator::make($request->all(), $rule);
        
        if($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Please check the required input fields');
        }else{
            try {
                DB::beginTransaction();
                // create user array with $request inputs
                $user = array(
                    'user_role_id'  => $request->input('user_role_id'),
                    'name'          => $request->input('name'),
                    'username'      => $request->input('username'),
                    'email'         => $request->input('email'),
                    'phone'         => $request->input('phone'),
                    'password'      => Hash::make($request->input('password'))
                );

                $userObject = User::create( $user );
                
                unset( $user );
                
                DB::commit();
            }catch(Exception $e){
                DB::rollback(); 
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error','Exception');
            }
            return redirect()
                    ->back()
                    ->with('success','User was created successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();
        return response()->json( $user );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validation 
        $rule = array(
            'user_id_edit'  => 'required',
            'name_edit'     => 'required',
            'phone_edit'    => 'required',
            'email_edit'    => 'required'
        );
        

        $validator = Validator::make($request->all(), $rule);
        
        if($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Please check the required input fields');
        }else{
            
            

            try {
                DB::beginTransaction();
                // create user array with $request inputs
                $user = array(
                    'name'          => $request->input('name_edit'),
                    'email'         => $request->input('email_edit'),
                    'phone'         => $request->input('phone_edit')
                );

                $user_id = $request->input('user_id_edit');
                $userPbject = User::where('id', '=', $user_id)->update( $user );
                
                unset( $user );
                
                DB::commit();
            }catch(Exception $e){
                DB::rollback(); 
                return redirect()
                    ->back()
                    ->with('error','Exception');
            }
            return redirect()
                    ->back()
                    ->with('success','Your profile was updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userObject = User::find($id);
        $userObject->delete();
        return redirect()
            ->back()
            ->with('success', 'User was deleted successfully!'); 
    }
}
