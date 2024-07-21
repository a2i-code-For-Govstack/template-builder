<?php
/*
namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;




class PDFController extends Controller{
    

    public function exportPdf(){

        $data = [
            'html' => request()->input('content') ,
    ];

        $pdf = PDF::loadView('export-pdf', $data);
        return $pdf->download('download.pdf');

    

}
}
*/
namespace App\Http\Controllers\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DomPDF; // Import the PDF facade

class PDFController extends Controller
{
    public function exportPdf(Request $request)
    {   /*
        // Fetch and render Blade view content
        $baseUrl=env('APP_URL');
        $Url=$baseUrl."/img/image1.webp";
        $html = view('pages.editor-any', compact('Url'))->render();
        // Generate PDF using barryvdh/laravel-dompdf
        
        $pdf = DomPDF::loadHTML( $html);

        // Download the generated PDF
        return $pdf->download('download.pdf');
        //return $Url;
        //return view('pages.editor-any', compact('Url'));
        */
        $cacheKey = 'unique-pdf-key';
        $cacheDuration = now()->addMinutes(60);

        $pdf = Cache::remember($cacheKey, $cacheDuration, function () use ($request){
            $content= $request->input('editor-div');
            //$data = ['content' => $content];
            //$pdf = DomPDF::loadView('pages.editor-any', $data);
            //return $pdf->output();
            return $content;
        });

        //return response($pdf)
           // ->header('Content-Type', 'application/pdf')
            //->header('Content-Disposition', 'inline; filename="generated.pdf"');
    
    
}
}