<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequestNote;
use App\Models\Items;
use App\Models\Site;
use App\Models\RequestMaterials;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use \Exception;

class MaterialRequestNoteController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material_request_notes = MaterialRequestNote::with('materials')->get();
        return view('material_request_notes', ['material_request_notes' => $material_request_notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::where('is_active', '=', '1')->get();//->where('is_complete', '=', '0')
        $items = Items::with(['measuringUnit'])->get();
        return view('material_request_note_create', ['items' => $items, 'sites' => $sites]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'note_date'     => ['required'],
            'site'          => ['required'],
            'is_urgent'     => ['required'],
            'delivery_date' => ['required'],
            'item_id'       => ['required'],
            'quantity'      => ['required'],
            'cost'          => [],
            'description'   => []
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Item is not added!')
                    ->withErrors($validator)
                    ->withInputs();
        }else{
            try{
                DB::beginTransaction();

                $is_urgent = $request->input('is_urgent') == "yes" ? true : false;
                //dd($is_urgent);
                $note = array(
                    'note_date' => $request->input('note_date'),
                    'site_id'   => $request->input('site'),
                    'is_urgent' => $is_urgent,
                    'delivery_date' => $request->input('delivery_date') 
                );
                
                if (($request->has('note_id')) && ($request->filled('note_id'))) {
                    if( ($this->auth_user_object) ){
                        $note['updated_by_id'] = $this->auth_user_object->id;
                    }

                    $materialRequestNoteObject = MaterialRequestNote::find( $request->input('note_id') );
                    $materialRequestNoteObject->update( $note );
                }else{
                    if( ($this->auth_user_object) ){
                        $note['create_by_id'] = $this->auth_user_object->id;
                    }

                    $materialRequestNoteObject = MaterialRequestNote::create( $note );

                }


                unset($note);

                $item = array(
                    'item_id'     => $request->input('item_id'),
                    'quantity'    => $request->input('quantity'),
                    'cost'        => str_replace(",","",$request->input('cost')),
                    'description' => $request->input('description')
                );

                $itemObject = $materialRequestNoteObject->materials()->create($item);
                unset($item);

                DB::commit();
            }catch(Exception $e){
                DB::rollback();
                return redirect()
                    ->back()
                    ->withInputs()
                    ->with('error','Exception');
            }
            return redirect()->route('material_request_note.edit', ['note_id' => $materialRequestNoteObject->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialRequestNote  $materialRequestNote
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialRequestNote $materialRequestNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialRequestNote  $materialRequestNote
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MaterialRequestNote $materialRequestNote)
    {
        $rules = array(
            'note_id'    => ['required']
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error','Validation Error');
        }

        $note_id = $request->input('note_id');
        $note = MaterialRequestNote::where('id', '=', $note_id)->first();
        $materials = RequestMaterials::with(['item'])->where('note_id', '=', $note_id)->get();
        $sites = Site::where('is_active', '=', '1')->get();//->where('is_complete', '=', '0')
        $items = Items::with(['measuringUnit'])->get();
        return view('material_request_note_edit', [
                        'items'     => $items, 
                        'sites'     => $sites,
                        'materials' => $materials,
                        'note'   => $note
                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialRequestNote  $materialRequestNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialRequestNote $materialRequestNote)
    {
        if (($request->has('note_id')) && ($request->filled('note_id'))) {
            $note = array(
                'is_complete' => true
            );
            $materialRequestNoteObject = MaterialRequestNote::find( $request->input('note_id') );
            $materialRequestNoteObject->update( $note );
            unset($note);

            return redirect()
                    ->route('material_request_note.index')
                    ->with('success','SRN is successfully completed!');
        }else{
            return redirect()
                    ->route('material_request_note.edit', ['note_id' => $materialRequestNoteObject->id])
                    ->with('error','SRN is not completed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialRequestNote  $materialRequestNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialRequestNote $materialRequestNote)
    {
        //
    }
}
