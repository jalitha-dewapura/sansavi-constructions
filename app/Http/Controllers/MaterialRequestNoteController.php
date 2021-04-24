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
    //show all material requests
    public function index()
    {
        //for only quantity surveyors
        $material_request_notes = MaterialRequestNote::where('is_complete', '=', 1)->with('materials')->get();
        return view('material_request_notes_qs', ['material_request_notes' => $material_request_notes]);
        //for only stock keepers
        //  $material_request_notes = MaterialRequestNote::with('materials')->get();
        //  return view('material_request_notes_sk', ['material_request_notes' => $material_request_notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //create new material request
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
    //show new material request or existing material request
    public function store(Request $request)
    {
        $rules = array(
            'note_date'     => ['required', 'date'],
            'site'          => ['required'],
            'is_urgent'     => ['required'],
            'delivery_date' => ['required', 'date'],
            'item_id'       => ['required'],
            'quantity'      => ['required', 'numeric'],
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
                    'note_date'     => $request->input('note_date'),
                    'site_id'       => $request->input('site'),
                    'is_urgent'     => $is_urgent,
                    'delivery_date' => $request->input('delivery_date'),
                    'is_approved'   => "Pending"
                );
                //If the note is already created
                if (($request->has('note_id')) && ($request->filled('note_id'))) {
                    if( (auth()->user()) ){
                        $note['updated_by_id'] = auth()->user()->id;
                    }

                    $materialRequestNoteObject = MaterialRequestNote::find( $request->input('note_id') );
                    $materialRequestNoteObject->update( $note );
                }else{//if the not is not created yet
                    if( (auth()->user()) ){
                        $note['create_by_id'] = auth()->user()->id;
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
    //View option of material request
    public function show(Request $request)
    {
        $rules = array(
            'note_id' => ['required']
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return redirect()
                ->back();
        }
        $note_id = $request->note_id;
        $note = MaterialRequestNote::where('id', '=', $note_id)->with(['materials', 'approveNote', 'site'])->first();
        $materials = RequestMaterials::with(['item'])->where('note_id', '=', $note_id)->get();
        if($note == null){
            return view('dashboard.index');
        }
        return view('material_request_note_show', ['note' => $note, 'materials' => $materials]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialRequestNote  $materialRequestNote
     * @return \Illuminate\Http\Response
     */
    //When the edit option of material request is clicked and the request is not completed yet.
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
        if( $note->is_complete ){
            return redirect()
                ->back();
        }
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
    //when the material request is completed
    public function update(Request $request)
    {
        if (($request->has('note_id')) && ($request->filled('note_id'))) {
            $note_id = $request->input('note_id');
            $materialRequestNoteObject = MaterialRequestNote::where('id','=',$note_id)->with(['materials'])->first();
            if($materialRequestNoteObject->materials->isNotEmpty() && $materialRequestNoteObject->is_complete == 0){
                $materialRequestNoteObject->update(['is_complete' => true]);
                return redirect()
                    ->route('material_request_note.index')
                    ->with('success','SRN is successfully completed!');
            }else{
                return redirect()
                    ->route('material_request_note.edit', ['note_id' => $materialRequestNoteObject->id])
                    ->with('error','SRN is not completed!');
            }
        }else{
            $material_request_notes = MaterialRequestNote::with('materials')->get();
            return redirect()
                ->route('material_request_notes', ['material_request_notes' => $material_request_notes])
                ->with('error','SRN is not completed!');
        }

        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialRequestNote  $materialRequestNote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materialRequestNote = MaterialRequestNote::find($id);
        $materialRequestNote->delete();
        return redirect()
            ->back()
            ->with('success', 'Material request is deleted successfully!');
    }
}
