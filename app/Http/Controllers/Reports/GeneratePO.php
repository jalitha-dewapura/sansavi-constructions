<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaterialRequestNote;
use App\Models\RequestMaterials;
use App\Models\Site;
use App\Models\Items;

class GeneratePO extends Controller
{
    public function generate(Request $request) {
        $note_id = $request->note_id;
        //get material_request_note collection where note_id = request->note id
        $material_request_note = MaterialRequestNote::with('materials', 'site')->where('id', '=', $note_id)->first();
        
        if($material_request_note != null and $material_request_note->is_approved == "Approved"){
            $materials = RequestMaterials::with('item')->where('note_id', '=', $note_id)->get();
            $items = Items::with(['measuringUnit'])->get();
            $site_id = $material_request_note->site_id;
            $site = Site::with('stockKeeper')->where('id', '=', $site_id)->first();

            $fileName = 'Purchase_Order_'. $note_id .'.pdf';
            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 30,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 20,
                'margin_header' => 10,
                'margin_bottom' => 10
            ]); 

            $html = \View::make('reports.generate_po')->with('material_request_note', $material_request_note)->with('materials', $materials)->with('site', $site)->with('items', $items);
            // return view('reports.generate_po', ['material_request_note' => $material_request_note, 'materials' => $materials]);
            $html = $html->render();
            
            // $stylesheet = file_get_contents(url('/css/mpdf.css'));
            // $mpdf->WriteHTML($stylesheet, 1);

            $mpdf->WriteHTML($html);
            $mpdf->Output($fileName, 'I');
        }else{
            return redirect()->route('dashboard.index');
        }

        
    }
}
