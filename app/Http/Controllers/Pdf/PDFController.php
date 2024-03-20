<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;


class PDFController extends Controller{

    public function exportPdf(){

        $data = [
            'html' => request()->input('content') ,
    ];

        $pdf = PDF::loadView('export-pdf', $data);
        return $pdf->download('download.pdf');

    }

}
