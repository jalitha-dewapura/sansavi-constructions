<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\MaterialRequestNote;
use App\Models\RequestMaterials;
use App\Models\Items;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportAnnualCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_year = now()->year;
        // dd($current_year);
        return view('report_annual_cost', ['current_year' => $current_year]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $rule = array(
            'year' => 'required'
        );

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->with('error', 'Please check the required input fields');
        }else{
            $year = $request->input('year');
            $material_request_notes = MaterialRequestNote::with(['site', 'materials'])->where('is_approved', '=', 'Approved')->get();
            $items = Items::with(['measuringUnit'])->get();
            $notes = collect();
            foreach($material_request_notes as $note)
            {
                if(substr($note->note_date, 0,4) == $year)
                {
                    $total_cost = 0;
                    foreach($note->materials as $material)
                    {
                        $total_cost += $material->cost;
                    }
                    $notes = $notes->concat([['site_name' => $note->site->name, 'note_date' => $note->note_date, 'cost' => $total_cost]]);
                }
            }
        
            $fileName = 'Annual_Report_' . $year . '.pdf';
            
            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 30,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 20,
                'margin_header' => 10,
                'margin_bottom' => 10
            ]); 

            $html = \View::make('reports.generate_annual_report')->with('notes', $notes)->with('year', $year);

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
