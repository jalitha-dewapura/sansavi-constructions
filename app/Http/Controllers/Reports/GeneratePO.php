<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaterialRequestNote;
use App\Models\RequestMaterials;

class GeneratePO extends Controller
{
    public function generate() {
        $material_request_note = MaterialRequestNote::with('materials', 'site')->where('id', '=', '1')->first();
        $materials = RequestMaterials::with('item')->where('note_id', '=', '1')->get();

        $fileName = 'Purchase_Order.pdf';
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_bottom' => 10
        ]);

        $html = \View::make('reports.generate_po')->with('material_request_note', $material_request_note)->with('materials', $materials);
        // return view('reports.generate_po', ['material_request_note' => $material_request_note, 'materials' => $materials]);
        $html = $html->render();
        
        $stylesheet = file_get_contents(url('/css/mpdf.css'));
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }
}
