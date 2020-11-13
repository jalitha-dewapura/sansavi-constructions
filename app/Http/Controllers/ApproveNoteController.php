<?php

namespace App\Http\Controllers;

use App\Models\ApproveNote;
use Illuminate\Http\Request;
use App\Models\MaterialRequestNote;

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
        return view('approve_notes_po', ['material_request_notes' => $material_request_notes]);
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
}
