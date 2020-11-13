<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\MeasuringUnits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use \Exception;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::with(['measuringUnit'])->get();
        return view('items', ['items'=> $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $measuring_units = MeasuringUnits::where('is_visible', '=', true)->get();
        $Item_count = Items::count();
        return view('item_create', ['measuring_units' => $measuring_units, 'item_code' => ++$Item_count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = array(
            'name'              => 'required',
            'measuring_unit_id' => 'required',
            'price'             => 'required',
            'item_type'         => 'required'
        );

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Please check the required input fields')
                    ->withInputs()
                    ->withErrors();
        }else{
            try {
                DB::beginTransaction();
                
                $item_count = Items::count();
                $new_code = $item_count+1;

                if( $request->input('item_type') == 'consumable'){
                    $is_consumable = true;
                }else{
                    $is_consumable = false;
                }

                $item = array(
                    'code'              => $new_code,
                    'name'              => $request->input('name'),
                    'measuring_unit_id' => $request->input('measuring_unit_id'),
                    'price'             => $request->input('price'),
                    'is_consumable'     => $is_consumable,
                    'description'       => $request->input('description')
                );

                $itemObject = Items::create( $item );
                unset( $item );
                
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
                    ->with('success','The item was created successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items)
    {
        //
    }
}
