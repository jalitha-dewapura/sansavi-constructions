<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Province;
use App\Models\District;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use \Exception;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::with(['province', 'district', 'purchasingOfficer', 'projectManager', 'quantitySurveyor', 'StockKeeper'])->get();
        $provinces = Province::all();
        $districts = District::all();
        $purchasing_officers = User::where('user_role_id', '=', '2')->get();
        $project_managers = User::where('user_role_id', '=', '3')->get();
        $quantity_surveyors = User::where('user_role_id', '=', '4')->get();
        $stock_keepers = User::where('user_role_id', '=', '5')->get();
        return view('sites', [
            'sites'=> $sites,
            'provinces' => $provinces,
            'districts' => $districts,
            'purchasing_officers' => $purchasing_officers,
            'project_managers' => $project_managers,
            'quantity_surveyors' => $quantity_surveyors,
            'stock_keepers' => $stock_keepers
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $site_count = Site::count();
        $provinces = Province::all();
        $districts = District::all();
        $purchasing_officers = User::where('user_role_id', '=', '2')->get();
        $project_managers = User::where('user_role_id', '=', '3')->get();
        $quantity_surveyors = User::where('user_role_id', '=', '4')->get();
        $stock_keepers = User::where('user_role_id', '=', '5')->get();
        return view('site_create', [
            'site_code' => $site_count+1,
            'provinces' => $provinces,
            'districts' => $districts,
            'purchasing_officers' => $purchasing_officers,
            'project_managers' => $project_managers,
            'quantity_surveyors' => $quantity_surveyors,
            'stock_keepers' => $stock_keepers
        ]);
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
            'name'          => 'required',
            'province'      => 'required',
            'district'      => 'required',
            'started_date'  => 'required|date'
        );

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withInputs()
                    ->with('error', 'Please check the required input fields')
                    ->withErrors();
        }else{
            try{
                DB::BeginTransaction();
                
                $site = array(
                    'name'        => $request->input('name'),
                    'province_id' => $request->input('province'),
                    'district_id' => $request->input('district'),
                    'started_date'=> $request->input('started_date'),
                    'po_id'       => $request->input('po_id'),
                    'pm_id'       => $request->input('pm_id'),
                    'qa_id'       => $request->input('qa_id'),
                    'sk_id'       => $request->input('sk_id'),
                );
                $sitObject = Site::create($site);
                unset($site);
                DB::commit();
            }catch(Exception $e){
                DB::rollback();
                return redirect()
                        ->back()
                        ->with('error', 'Exception')
                        ->withInputs()
                        ->withErrors();
            }
            return redirect()
                    ->back()
                    ->with('success', 'The site was created successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }
}
