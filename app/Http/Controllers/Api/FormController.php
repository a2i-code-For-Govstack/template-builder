<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\TemplateData;
use Carbon\Carbon;
use PDF;
use PhantomPDF;
use SebastianBergmann\Template\Template;
use App\Orangebd\Utility;

// use Dompdf\Dompdf;
// use Dompdf\Options;

use DomPDF;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as mPDF;
use Mpdf\MpdfException;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormController extends Controller
{
    public function getList()
    {
        try {
            //$forms = Form::select('id', 'title', 'sid')->get();
            $forms = Form::all();
            return response()->json($forms);
        } 
        catch (\Throwable $th) {
            throw $th;
        }

    }

    public function showContent(Request $request)
    {
        $sid = $request->input('sid');


        $form = Form::where('sid',$sid)->first();
        $content = str_replace(array("\r", "\n"), '', $form->content);
        return response()->json(['content' => $content], 200, [], JSON_UNESCAPED_SLASHES);

    }

    public function storeInfo(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'content' => 'required|string',
            'sid' => 'required|integer',
            'aid' => 'required|string',
            'userInfo' => 'required|string',
            'formID' => 'nullable|string'
        ]);

        // Create a new TemplateData instance and save it to the database
        $templateData = new TemplateData();
        $templateData->content = $validatedData['content'];
        $templateData->sid = $validatedData['sid'];
        $templateData->aid = $validatedData['aid'];
        $templateData->userInfo = $validatedData['userInfo'];
        $templateData->formID = $validatedData['formID'];
        $templateData->save();

        // Return a JSON response indicating success
        //        return response()->json(['message' => 'Data saved successfully.']);

        $data = [
            'html' => request()->input('content') ,
        ];

        $pdf = PDF::loadView('export-pdf', $data);
        return $pdf->download('download.pdf');

    }
    //update on feedback WIP


    /* ---------------------- Create Template Based On Sid ---------------------- */
    public function createTemplate(Request $request){

        try {

            $request->validate([
                'aid' => 'required',
                'sid' => 'required',
            ]);

            $sid = $request->sid;
            $aid = $request->aid;

            $request->request->remove('aid');
            $request->request->remove('sid');

            // $totalTableRow=0;

            // foreach ($request->all() as $requestKey =>  $requestvalue) {
            //     if (str_contains( $requestKey, 'sl_no_01')) {
            //         ++$totalTableRow;
            //     }
            // }

            if(isset($request->type) && $request->type == "LETTER"){
                $form = Form::where([['sid',0],['id',$request->id]])->first();
                // $form = Form::where([['sid',$sid],['id',$request->id]])->first();
            }else{
                $form = Form::where('sid',$sid)->first();
            }



            if ($form) {
                $content = str_replace(array("\r", "\n"), '', $form->content);
            } else {
                return response()->json(['error' => 'Form not found'], 404);
            }

            foreach ($request->all() as $requestKey =>  $requestvalue) {
                $search="{{".$requestKey."}}";

                if (strpos($content, $search) !== false) {
                    $content = str_replace($search, $requestvalue, $content);
                } else {
                    $content = str_replace($search, '', $content);
                }
            }

            $currentDate="{{currentDate}}";
            if (strpos($content, $currentDate) !== false) {
                $content = str_replace($currentDate, date('d/m/Y') , $content);
            }

            $currentDate="{{currentDateEn}}"; // 29-09-2023
            if (strpos($content, $currentDate) !== false) {
                $content = str_replace($currentDate, date('d/m/Y') , $content);
            }

            $currentDate="{{currentDateEnMonth}}"; // 29-September-2023
            if (strpos($content, $currentDate) !== false) {
                $dateData = Utility::getFullMonthTodayDateEn();
                $content = str_replace($currentDate, $dateData , $content);
            }

            $currentDate="{{currentDateEnBn}}";  //২৯-০৯-২০২৩
            if (strpos($content, $currentDate) !== false) {
                $dateData = Utility::getTodayDateEnToBn();
                $content = str_replace($currentDate, $dateData , $content);
            }

            $currentDate="{{currentDateEnBnMonth}}";  //২৯-সেটম্বের-২০২৩
            if (strpos($content, $currentDate) !== false) {
                $dateData = str_replace(',','',bangla_date(time(),"en"));
                $content = str_replace($currentDate, $dateData , $content);
            }

            $currentDate="{{currentDateBn}}"; //১২-শ্রাবন-১৪২৩
            if (strpos($content, $currentDate) !== false) {
                $dateData = str_replace(',','',bangla_date(time(),"bn"));
                $content = str_replace($currentDate, $dateData , $content);
            }

            $currentYear="{{currentYearEn2D}}";
            if (strpos($content, $currentYear) !== false) {
                $currentYearData = date('y');
                $content = str_replace($currentYear, $currentYearData , $content);
            }

            $currentMonth="{{currentMonthEn}}";
            if (strpos($content, $currentMonth) !== false) {
                $currentMonthData = date('M');
                $content = str_replace($currentMonth, $currentMonthData , $content);
            }


            $dom = new \DOMDocument();
            //@$dom->loadHTML($content);
            @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

            $dom->preserveWhiteSpace = false;
            $thirdTable = $dom->getElementsByTagName('table')->item(0);

            if(isset($thirdTable)){
                foreach($thirdTable->getElementsByTagName('tr') as $tr)
                {
                    $textInfo=$tr->childNodes->item(0)->textContent;
                    if(strpos($textInfo, "{{") !== false){
                        // $tr->parentNode->removeChild($tr);
                        // $tr->setAttribute('style', 'display:none');
                        $tr->setAttribute('class', 'discard_item');
                    }
                }
                $content=$dom->saveHTML();
            }

            $content = preg_replace('#<tr class="discard_item">(.*?)</tr>#', '', $content);

            do {
                $tmp = $content;
                $content = preg_replace( '#<([^ >]+)[^>]*>([[:space:]]|&nbsp;)*</\1>#', '', $content );
            } while ( $content !== $tmp );



            $id = TemplateData::create([
                'content' =>$content,
                'sid' =>$sid,
                'aid' => $aid,
                'created_by' => auth()->user()->id,
            ])->id;

            $returnUrl =  env('APP_URL').'/log-edit/'.$id;
            $created_content = TemplateData::select('content')->where('id',$id)->first();

            $data = [
                'url' => $returnUrl,
                'logId' => $id,
                'content' => str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">','',$created_content->content)
                // 'content' =>  $content
            ];
            $status = [
                'status' => 'success'
            ];

            // return $created_content->content;
            // return json_encode($data['content']);

            return response()->json(['data' => $data, 'status' => $status]);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    //Munir
    public function logUpdateApi(Request $request)
    {
        $logdata = TemplateData::find($request->id);

        $logdata->update([
            'content' => $request['content'],
        ]);

        $content  =str_replace("height:","_height:",$logdata->content );
        // return $logdata->sid;


        // English New Romman
        if($logdata->sid==5093 || $logdata->sid== 5096){
            $html = [
                'html' => $content ,

            ];
            $pdf = DomPDF::loadView('pdf_data',$html);
            return $pdf->stream('test_data.pdf')->header('Content-Type','application/pdf');
        }

        //Bangla PDF

        if($logdata->sid==5126 || $logdata->sid==2402){
            PhantomPDF::useScript(public_path().'/js/pdf/landscape.js');
        }

        // if($logdata->sid==5093 || $logdata->sid== 5096){
        //     return PhantomPDF::createFromView(view('pdf-generator.loi-nov',compact(['content'])), 'filename.pdf');
        // }

        return PhantomPDF::createFromView(view('pdf',compact(['content'])), 'filename.pdf');

        // $pdf = new PhantomPDF;
        // // $pdf->useScript(public_path().'/js/pdf/custom.js');
        // return $pdf->createFromView(view('pdf',compact(['content'])), 'filename.pdf');

    }
    //Munir

    public function _logUpdateApi(Request $request)
    {

        $logdata = TemplateData::find($request->id);
        $logdata->update([
            'content' => $request['content'],
        ]);


        // $logdata->content .= '<style>td{ height:auto !important}</style>';
        $logdata->content  =str_replace("height:","_height:",$logdata->content );
        $html = [
            'html' => $logdata->content ,
        ];

        // $fontDirectory = storage_path("fonts");

        // $options = new Options();
        // $options->setChroot($fontDirectory);

        // $pdf = new Dompdf($options);
        // $pdf->getFontMetrics()->registerFont(
        //     ['family' => 'kalpurush', 'style' => 'italic', 'weight' => 'normal'],
        //     $fontDirectory . '/kalpurush.ttf'
        // );


        // $data=" প্রিগোজিন রাশিয়ার সামরিক বাহিনীর ‘সদরদপ্তরে’, দাবি ভিডিওতে ";
        // $data=" AAA BBB ";

        // $pdf->loadHtml($data);
        // $pdf->render();

        // return $pdf->output();
        // // return $pdf->download('download.pdf');
        // header("Content-type:application/pdf");
        // echo $pdf->output();

        // $pdf->stream("pdf_filename_".rand(10,1000).".pdf", array("Attachment" => true));

        // $file_to_save = 'output.pdf';
        // //save the pdf file on the server
        // file_put_contents($file_to_save, $pdf->output());
        // //print the pdf file to the screen for saving
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="file.pdf"');
        // header('Content-Transfer-Encoding: binary');
        // header('Content-Length: ' . filesize($file_to_save));
        // header('Accept-Ranges: bytes');
        // readfile($file_to_save);

        // return $pdf->stream();

        // return  file_put_contents('output.pdf', $pdf->output());

        // $html = [
        //     'html' => $data,
        // ];

        // PDF::setOption(['dpi' => 150, 'defaultFont' => 'kalpurush']);
        // $pdf = PDF::loadView('export-pdf', $html);
        // return $pdf->download('download.pdf');
        // $data= 'html';

        // $html = [
        //     'data' => $data,
        // ];

        $pdf = PDF::loadView('pdf_data',$html);

        // return view('pdf_data',compact($data));
        return $pdf->stream('test_data.pdf')->header('Content-Type','application/pdf');

        // return $pdf->download('business_permit_'.$traking.'.pdf')->header('Content-Type','application/pdf');

    }

    public function testPDFData(Request $request)
    {
        $logdata = TemplateData::find($request->id);

        $logdata->update([
            'content' => $request['content'],
        ]);

        $content  =str_replace("height:","_height:",$logdata->content );
        // $content =$logdata->content;

        // $pdf->setPaper('A4', 'landscape');

        // return $pdfData=PhantomPDF::createFromView(view('pdf',compact(['content'])), 'filename.pdf');

        // $html = [
        //     'content' => $logdata->content ,
        // ];
        // return $pdf = PhantomPDF::createFromView('pdf',$html);
        // return view('pdf_data',compact($data));
        // return $pdf->stream('test_data.pdf')->header('Content-Type','application/pdf');
        // $pdf = new PdfGenerator;
        // return  $pdf;
        // return public_path().'/js/pdf/custom.js';

        return PhantomPDF::createFromView(view('pdf',compact(['content'])), 'filename.pdf');

        $pdf = new PhantomPDF;
        // $pdf->useScript(public_path().'/js/pdf/custom.js');
        return $pdf->createFromView(view('pdf',compact(['content'])), 'filename.pdf');

    }

    public function getLastUpdatedLog(Request $request)
    {
        try {

            if(isset($request->id)){

                $request->validate([
                    'id' => 'required|numeric'
                ]);
                $templateData = TemplateData::select('id','content')
                ->where([['id',$request->id]])
                ->orderBy('id','DESC')->first();
                $templateData->content = str_replace(array("\r", "\n"), '', $templateData->content);
                return  $templateData;

            }else{

                $request->validate([
                    'aid' => 'required|string',
                    'sid' => 'required|string',
                ]);

                $templateData = TemplateData::select('id','content')
                ->where([['sid',$request->sid],['aid',$request->aid]])
                ->orderBy('id','DESC')->first();
                $templateData->content = str_replace(array("\r", "\n"), '', $templateData->content);
                return  $templateData;

            }

            return $request->all();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getLetterList(Request $request)
    {
        try {
            return Form::select("id","title")->where('sid',0)
            //->orderBy('id','DESC')
            ->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function newlogUpdateApi( Request $request ){

        $baseUrl =env('APP_URL') ;//$request->root();

        $this->validate($request, [
            'id' => 'required',
            'previewContent' => 'required_without:content',
            'content' => 'required_without:previewContent',
        ]);
        $logdata = TemplateData::find($request->id);

        if(isset($request['content'])){
            $content = $request['content'];
            $logdata->content = $content;
            $logdata->updated_by = auth()->user()->id;
            $logdata->save();
        }

       


        $content  =str_replace("height:","_height:",$logdata->content );


      
        if($logdata->sid==5093 || $logdata->sid==5767){
            // $qrCodes=QrCode::encoding('UTF-8')->size(250)->generate('A basic example of QR code!');
            $qrCodes = QrCode::format('svg')->size(45)->generate(env('WORKFLOW_URL')."/qr-code-verification?qrCode=".$logdata->aid);
            $qrCodes=str_replace('<?xml version="1.0" encoding="UTF-8"?>',"",$qrCodes); //replace to empty
            $qrCodes = str_replace("\n","",$qrCodes);
        }else{
            // $qrCodes=QrCode::encoding('UTF-8')->size(250)->generate('A basic example of QR code!');
            $qrCodes = QrCode::format('svg')->size(45)->generate(env('WORKFLOW_URL')."/qr-code-verification?qrCode=".$logdata->aid);
            $qrCodes=str_replace('<?xml version="1.0" encoding="UTF-8"?>',"",$qrCodes); //replace to empty
            $qrCodes = str_replace("\n","",$qrCodes);
        }


        $content = str_replace("{{qrCode}}",$qrCodes, $content);
        $currentDate="{{currentDate}}"; //29-09-2023
        if (strpos($content, $currentDate) !== false) {
            // $dateData = Utility::getTodayDateEnToBnMonth(); // 	২৪ সের	২০২৩
            // $dateData = Utility::getTodayDateEnToBn(); // ২৪-০৯-২০২৩
            // $dateData = Utility::getTodayBanglaDate();
            // $dateData = str_replace(',','',bangla_date(time(),"bn")); //৯	আিন, ১৪৩০
            // $dateData = str_replace(',','',bangla_date(time(),"en"));
            // $content = str_replace($currentDate,$dateData, $content);
            $content = str_replace($currentDate, date('d/m/Y'), $content);
        }

        $currentDate="{{currentDateEn}}"; // 29-09-2023
        if (strpos($content, $currentDate) !== false) {
            $content = str_replace($currentDate, date('d/m/Y') , $content);
        }

        $currentDate="{{currentDateEnMonth}}"; // 29-September-2023
        if (strpos($content, $currentDate) !== false) {
            $dateData = Utility::getFullMonthTodayDateEn();
            $content = str_replace($currentDate, $dateData , $content);
        }

        $currentDate="{{currentDateEnBn}}";  //২৯-০৯-২০২৩
        if (strpos($content, $currentDate) !== false) {
            $dateData = Utility::getTodayDateEnToBn();
            $content = str_replace($currentDate, $dateData , $content);
        }

        $currentDate="{{currentDateEnBnMonth}}";  //২৯-সেটম্বের-২০২৩
        if (strpos($content, $currentDate) !== false) {
            $dateData = str_replace(',','',bangla_date(time(),"en"));
            $content = str_replace($currentDate, $dateData , $content);
        }

        $currentDate="{{currentDateBn}}"; //১২-শ্রাবন-১৪২৩
        if (strpos($content, $currentDate) !== false) {
            $dateData = str_replace(',','',bangla_date(time(),"bn"));
            $content = str_replace($currentDate, $dateData , $content);
        }

        $currentYear="{{currentYearEn2D}}";
        if (strpos($content, $currentYear) !== false) {
            $currentYearData = date('y');
            $content = str_replace($currentYear, $currentYearData , $content);
        }

        $currentMonth="{{currentMonthEn}}";
        if (strpos($content, $currentMonth) !== false) {
            $currentMonthData = date('M');
            $content = str_replace($currentMonth, $currentMonthData , $content);
        }

        $formData = Form::where('sid',$logdata->sid)->first();
        $pageMode = $formData->page_type;
        $pageFormat = $formData->paper_size;
        $watermarkImage = $formData->background_image;
        $imageTransparacy = $formData->image_transparacy;
        $data = [
            'content' => $content,
        ];





          if(!empty($watermarkImage)){
            $pdf = mPDF::loadView('pdf-generator.pdf',compact('data'), [],
            [
                'format' => $pageFormat,
                'orientation' => $pageMode,
                'show_watermark_image'       => true,
                'watermark_image_path'       => storage_path('app/public/'.$watermarkImage),
                'watermark_image_alpha'      => $imageTransparacy,
                'watermark_image_size'       => 'D',
                'watermark_image_position'   => 'p',

              ]);
        }else{
            $pdf = mPDF::loadView('pdf-generator.pdf',compact('data'), [],            [
                'format' => $pageFormat,
                'orientation' => $pageMode,

            ]);
        }

          //view file location
        // return $pdf->stream('test_data.pdf')->header('Content-Type','application/pdf');
        $file_path = date('Y') . '/' . date('m') . '/' . date('d');
        if (!Storage::exists($file_path)) {
            Storage::makeDirectory($file_path);
        }

        $fileName = time() . '.'.'pdf';
        Storage::put($file_path.'/'.$fileName, $pdf->output());
        // $pdf->output()->move(public_path('storage/app/' . $file_path), $fileName);
        // return $pdf->stream('test_data.pdf');
        return $baseUrl.'/'.'storage/'. $file_path . '/' . $fileName;
        $attachment_info = array(["url" => $baseUrl.'/'.'storage/'. $file_path . '/' . $fileName]);
        return $pdf->stream();
        // return response()->json(array("url" => $baseUrl.'/'.'storage/'. $file_path . '/' . $fileName));

    }


}
