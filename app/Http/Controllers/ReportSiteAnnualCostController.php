<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\MaterialRequestNote;
use App\Models\RequestMaterials;
use App\Models\Items;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportSiteAnnualCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sites = Site::where('is_active', '=', '1')->get();
        $current_year = now()->year;
        // dd($current_year);
        return view('report_site_annual_cost', ['sites' => $sites, 'current_year' => $current_year]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $rule = array(
            'site' => 'required',
            'year' => 'required'
        );

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Please check the required input fields');
        }else{
            $site_id = $request->input('site');
            $year = $request->input('year');
            $material_request_notes = MaterialRequestNote::where('site_id', '=', $site_id)->where('is_approved', '=', 'Approved')->get();
            $items = Items::with(['measuringUnit'])->get();
            $materials = collect();
            foreach($material_request_notes as $note)
            {
                $materials = $materials->concat(RequestMaterials::with('item')->where('note_id', '=', $note->id)->get());             
            }

            //calculating the total cost of the site
            $total_cost = 0;
            foreach($materials as $material)
            {   
                if($material->updated_at->format('Y') == $year)
                {
                    $total_cost +=  $material->cost;     
                }
            }

            $site = Site::with('stockKeeper')->where('id','=',$site_id)->first();
            $site_name = $site->name;
            
            $fileName = 'Site_Annual_Report_' . $site_name . '_' . $year . '.pdf';
            
            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 30,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 20,
                'margin_header' => 10,
                'margin_bottom' => 10
            ]); 

            $html = \View::make('reports.generate_site_annual_report')->with('materials', $materials)->with('site', $site)->with('year', $year)->with('items', $items)->with('total_cost', $total_cost);

            $html = $html->render();

            $mpdf->WriteHTML($html);
            $mpdf->Output($fileName, 'I');
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
