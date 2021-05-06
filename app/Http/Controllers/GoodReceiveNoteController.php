<?php

namespace App\Http\Controllers;

use App\Models\GoodReceiveNote;
use Illuminate\Http\Request;
use App\Models\MaterialRequestNote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use \Exception;

class GoodReceiveNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $materialRequestNoteObject = MaterialRequestNote::with(['goodReceiveNote'])->find( $request->input('note_id'));
        
        if(!isset($materialRequestNoteObject->goodReceiveNote)){
            $rules = array(
                'note_id' => ['required'],
                'received_date' => ['required', 'date'],
                'good_receive_note' => ['required']
            );
    
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()){
                return redirect()
                        ->back()
                        ->with('error', 'The good receive note is not created!')
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
                    $goodReceiveNote = array(
                        'note_id'         => $request->input('note_id'),
                        'received_date'   => $request->input('received_date'),
                        'description'     => $request->input('good_receive_note'),
                        'created_by_id'    => $auth_id
                    );
                   
                    $goodReceiveNoteObject = GoodReceiveNote::create( $goodReceiveNote );
                    unset($goodReceiveNote);
                     
                    DB::commit();
    
                }catch(Exception $e){
                    DB::rollback();
                    return redirect()
                        ->back()
                        ->with('error','Exception');
                }
                return redirect()->back()
                                    ->with('success', 'The good receive note is created successfully!');
                // return view('approve_notes_qs', ['material_request_notes' => $material_request_notes]);
            }
        }else{
            return redirect()->route('material_request_note.index_sk')
                            ->with('error', 'The good receive note was already created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodReceiveNote  $goodReceiveNote
     * @return \Illuminate\Http\Response
     */
    public function show(GoodReceiveNote $goodReceiveNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoodReceiveNote  $goodReceiveNote
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodReceiveNote $goodReceiveNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoodReceiveNote  $goodReceiveNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodReceiveNote $goodReceiveNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodReceiveNote  $goodReceiveNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodReceiveNote $goodReceiveNote)
    {
        //
    }
}
