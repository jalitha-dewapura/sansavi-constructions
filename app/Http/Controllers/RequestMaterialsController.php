<?php

namespace App\Http\Controllers;

use App\Models\RequestMaterials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use \Exception;

class RequestMaterialsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestMaterials  $requestMaterials
     * @return \Illuminate\Http\Response
     */
    public function show(RequestMaterials $requestMaterials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestMaterials  $requestMaterials
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestMaterials $requestMaterials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestMaterials  $requestMaterials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'quantity'      => ['required', 'numeric'],
            'description'   => []
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Item is not updated!');
        }else{
            TRY{
                DB::beginTransaction();

                $material = array(
                    'quantity'    => $request->input('quantity'),
                    'description' => $request->input('description')
                );

                $requestMaterials = RequestMaterials::find( $request->input('material_id') );
                $requestMaterials->update($material);
                unset($material);

                DB::commit();

        }catch(Exception $e){
            DB::rollback();
            return redirect()
                ->back()
                ->with('error','Exception');
                
        }
        return redirect()
            ->back()
            ->with('success','Material is updated successfully.!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestMaterials  $requestMaterials
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestMaterials $requestMaterials)
    {
        //
    }
}
