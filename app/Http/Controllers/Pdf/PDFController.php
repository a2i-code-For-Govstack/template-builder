<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;


class PDFController extends Controller{
    

    public function downloadPdf(Request $request)
    {
        $content = $request->input('content');
        $html="
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                
                .pdf-container {
                    
                    position: relative;
                    width: 100%;
                    height: 98%;
                    border:2px solid black;
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                }
            </style>
        </head>
        <body>
            <div class='pdf-container'>
                    {$content}
                
            </div>
        </body>
       
        </html>
        ";
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('baseDir', realpath(public_path())); 
        $dompdf = new Dompdf($options);
        //$dompdf = new Dompdf();
        //echo $html;
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A5', 'portrait');
        $dompdf->render();
        return $dompdf->stream('test.pdf');
        
    }

    

}

/*
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
        
        $cacheKey = 'unique-pdf-key';
        $cacheDuration = now()->addMinutes(60);

        $pdf = Cache::remember($cacheKey, $cacheDuration, function () use ($request){
            $content= $request->input('content');
            //$data = ['content' => $content];
            //$pdf = DomPDF::loadView('pages.editor-any', $data);
            //return $pdf->output();
            return $content;
        });

        //return response($pdf)
           // ->header('Content-Type', 'application/pdf')
            //->header('Content-Disposition', 'inline; filename="generated.pdf"');
    
    
}
}*/