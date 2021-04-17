<?php

namespace App\Http\Controllers;

use App\Models\ApproveNote;
use Illuminate\Http\Request;
use App\Models\MaterialRequestNote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use \Exception;


class ApproveNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material_request_notes = MaterialRequestNote::where('is_complete','=','1')->with(['approveNote', 'site', 'materials'])->get();
        return view('approve_notes_qs', ['material_request_notes' => $material_request_notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApproveNote  $approveNote
     * @return \Illuminate\Http\Response
     */
    public function show(ApproveNote $approveNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApproveNote  $approveNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ApproveNote $approveNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApproveNote  $approveNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApproveNote $approveNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApproveNote  $approveNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApproveNote $approveNote)
    {
        //
    }

    public function approve(Request $request)
    {  
        $materialRequestNoteObject = MaterialRequestNote::find( $request->input('approve_note_id') );
        
        if($materialRequestNoteObject->is_approved == "Pending"){
            $rules = array(
                'approve_note' => ['required']
            );
    
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()){
                return redirect()
                        ->back()
                        ->with('error', 'The material request is not approved!')
                        ->withErrors($validator)
                        ->withInputs();
            }else{
                try{
                    DB::beginTransaction();
                    if( (auth()->user()) ){
                        $auth_id = auth()->user()->id;
                    }else{
                        $auth_id = null;
                    }
                    
                    $approveNote = array(
                        'note_id'         => $request->input('approve_note_id'),
                        'description'     => $request->input('approve_note'),
                        'is_approved'     => true,
                        'create_by_id'    => $auth_id
                    );
                   
                    $approveNoteObject = ApproveNote::create( $approveNote );
                    unset($approveNote);
                    
                    $note = array(
                        'is_approved' => "Approved"
                    );
                    $materialRequestNoteObject->update( $note );
                    unset($note);
                    
    
                    DB::commit();
    
                }catch(Exception $e){
                    DB::rollback();
                    return redirect()
                        ->back()
                        ->with('error','Exception');
                }
                return redirect()->back()
                                    ->with('success', 'The material request was approved successfully!');
                // return view('approve_notes_qs', ['material_request_notes' => $material_request_notes]);
            }
        }else{
            return redirect()->route('material_request_note.index')
                            ->with('error', 'The material request was already approved!');
        }
        
    }

    public function decline(Request $request)
    {
        $materialRequestNoteObject = MaterialRequestNote::find( $request->input('decline_note_id') );

        if($materialRequestNoteObject->is_approved == "Pending"){
            $rules = array(
                'decline_note' => ['required']
            );
    
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()){
                return redirect()
                        ->back()
                        ->with('error', 'The material request is not declined!')
                        ->withErrors($validator)
                        ->withInputs();
            }else{
                try{
                    DB::beginTransaction();
                    if( (auth()->user()) ){
                        $auth_id = auth()->user()->id;
                    }else{
                        $auth_id = null;
                    }
                    
                    $approveNote = array(
                        'note_id'         => $request->input('decline_note_id'),
                        'description'     => $request->input('decline_note'),
                        'is_approved'     => false,
                        'create_by_id'    => $auth_id
                    );
                   
                    $approveNoteObject = ApproveNote::create( $approveNote );
                    unset($approveNote);
                    
                    $note = array(
                        'is_approved' => "Declined"
                    );
                    $materialRequestNoteObject->update( $note );
                    unset($note);
                    
    
                    DB::commit();
    
                }catch(Exception $e){
                    DB::rollback();
                    return redirect()
                        ->back()
                        ->with('error','Exception');
                }
                return redirect()->back()
                                    ->with('success', 'The material request was declined successfully!');
                // return view('approve_notes_qs', ['material_request_notes' => $material_request_notes]);
            }
        }else{
            return redirect()->route('material_request_note.index')
                            ->with('error', 'The material request was already declined!');
        }
    }
}
