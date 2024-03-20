<?php
namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Orangebd\ServiceIdClass;
use App\Models\Form;
use App\Models\TemplateData;
use App\Models\Category;
use App\Models\FormUpdateLog;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use PDF;
use mPDF;
use PhantomPDF;
use DomPDF;
use DataTables;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as newPDF;
use Mpdf\MpdfException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class FormController extends Controller
{


    /**
     * Display a listing of the resource.
     */

    // list show with yajra datatable
    // protected $isSuperAdmin;

    function __construct(){
        $this->middleware('permission:form-list|form-create|form-edit', ['only' => ['index']]);
        $this->middleware('permission:form-create', ['only' => ['create','store']]);
        $this->middleware('permission:form-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:form-delete', ['only' => ['deleteForm']]);
        $this->middleware('permission:log-index', ['only' => ['logIndex']]);
        $this->middleware('permission:log-show', ['only' => ['logShow']]);
        $this->middleware('permission:log-edit', ['only' => ['logEdit']]);
        $this->middleware('permission:log-update', ['only' => ['logUpdate']]);
        $this->middleware('permission:table-parse', ['only' => ['tableParse']]);
    }




    public function index(Request $request)
    {


        $data =Form::orderBy('id', 'desc');
        if ($request->ajax()) {
            return DataTables::of($data->select('id','title','sid')->get())
            ->addIndexColumn()
            ->addColumn('form_log', function($row){
                $form_log = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="see_logs text-black">
                '.$row->title.'
                 </a>';
                return $form_log;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="edit" > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                </button> </a>';
                $btn =$btn.'<a href="javascript:void(0)" title="preview Content" data-toggle="tooltip" data-id="'.$row->id.'" class="preview" > <button class="btn btn-outline-info btn-sm">
                <i class="fa-solid fa-eye"></i>
                </button> </a>';
                return $btn;
            })->rawColumns(['action','form_log'])
              ->make(true);
        }

        return view('pages.forms.index');
    }

// normal list show

    // public function index()
    // {
    //     $data = [
    //         'forms' => Form::orderBy('id', 'desc')->paginate(20),
    //     ];

    //     return view('pages.forms.index', $data);
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $jsonData = ServiceIdClass::getServiceId();
        return view('pages.forms.create',compact('category','jsonData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sid' => 'required',
            'template_type' => 'required',
            'font_type' => 'required',
            'paper_size' => 'required',
            'page_type' => 'required',
            'category' => 'required',
            'content' =>'required'
        ]);

        str_replace("{{Copier}}","<div id='copier'>{{Copier}}</div>",$request['content']);
        str_replace("{{Approver}}",'<div id="approver" class="approver">{{Approver}}</div>',$request['content']);

        str_replace("{{Recipient}}","<div id='recipient'>{{Recipient}}</div>",$request['content']);
        str_replace("{{Attention}}","<div id='attention'>{{Attention}}</div>",$request['content']);
        str_replace("{{Sender}}","<div id='sender'>{{Sender}}</div>",$request['content']);
        $image_path='';

        if ($request->hasFile('background_image')) {
            $request->validate([
                'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image_path = $request->file('background_image')->store('form_background_image', 'public');
        }

        $transparacy= (float)$request->image_transparacy;
        $data = Form::create([
            'title' => $request->title,
            'sid' => $request->sid,
            'template_type' => $request->template_type,
            'font_type' => $request->font_type,
            'paper_size' => $request->paper_size,
            'page_type' => $request->page_type,
            'category' => $request->category,
            'created_by' => auth()->user()->id,
            'is_editable' => 0,
            'content' =>$request['content'],
            'background_image'=>$image_path,
            'image_transparacy'=>$request->image_transparacy,
        ]);


        return response()->json(["message" =>  "Form Created Successfuly !"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Form::find($id);
        $category = Category::all();
        $jsonData = ServiceIdClass::getServiceId();
        return view('pages.forms.edit', compact('data','category','jsonData'));
    }

    /*public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'sid' => 'required',
            'template_type' => 'required',
            'font_type' => 'required',
            'paper_size' => 'required',
            'page_type' => 'required',
            'category' => 'required',

        ]);

        $form = Form::find($id);

        if(strpos($request['content'], "{{Copier}}") !== false && strpos($request['content'], "<div id=\"copier\">{{Copier}}</div>") === false){

            $request['content'] = preg_replace('#<div id="copier">(.*?)<\/div>#', '',  $request['content']);
            $request['content'] = str_replace("{{Copier}}","<div id='copier'>{{Copier}}</div>",$request['content']);

        }

        if(strpos($request['content'], "{{Approver}}") !== false && strpos($request['content'], '<div id="approver" class="approver">{{Approver}}</div>') === false){

            $request['content'] = preg_replace('#<div id="approver" class="approver">(.*?)<\/div>#', '',  $request['content']);
            $request['content'] = str_replace("{{Approver}}",'<div id="approver" class="approver">{{Approver}}</div>',$request['content']);
        }

        if(strpos($request['content'], "{{Recipient}}") !== false && strpos($request['content'], "<div id=\"recipient\">{{Recipient}}</div>") === false){
            $request['content'] = preg_replace('#<div id="recipient">(.*?)<\/div>#', '',  $request['content']);
            $request['content'] = str_replace("{{Recipient}}","<div id='recipient'>{{Recipient}}</div>",$request['content']);
        }

        if(strpos($request['content'], "{{Attention}}") !== false && strpos($request['content'], "<div id=\"attention\">{{Attention}}</div>") === false){
            $request['content'] = preg_replace('#<div id="attention">(.*?)<\/div>#', '',  $request['content']);
            $request['content'] = str_replace("{{Attention}}","<div id='attention'>{{Attention}}</div>",$request['content']);
        }

        if(strpos($request['content'], "{{Sender}}") !== false && strpos($request['content'], "<div id=\"sender\">{{Sender}}</div>") === false){
            $request['content'] = preg_replace('#<div id="sender">(.*?)<\/div>#', '',  $request['content']);
            $request['content'] = str_replace("{{Sender}}","<div id='sender'>{{Sender}}</div>",$request['content']);
        }

        if(auth()->user()->hasRole('SuperAdmin') ){
            $form->title = $request->title;
            $form->sid = $request->sid;
            $form->template_type = $request->template_type;
            $form->font_type = $request->font_type;
            $form->paper_size = $request->paper_size;
            $form->page_type = $request->page_type;
            $form->category = $request->category;
            $form->updated_by = auth()->user()->id;
            $form->content = $request['content'];
            if($request->hasFile('background_image')){
                $path='storage/'.$form->image;
                if(File::exists($path)) {
                    File::delete($path);
                }
                $image=$request->background_image;
                if($image){
                  $image_path = $request->file('background_image')->store('form_background_image', 'public');
                  $form->background_image = $image_path;
                }
              }
            $form->image_transparacy = $request->image_transparacy;
            $form->save();
            return response()->json(["message" =>  "Form Updated Successfuly !"]);
        }else{
            return response()->json(["message" =>  "You don't have permission to edit this form !"]);
        }

    }*/

    public function createFormUpdateLog(Request $request){
        $request->validate([
            'title' => 'required',
            'sid' => 'required',
            'template_type' => 'required',
            'font_type' => 'required',
            'paper_size' => 'required',
            'page_type' => 'required',
            'category' => 'required',
            'content' =>'required'
        ]);

        str_replace("{{Copier}}","<div id='copier'>{{Copier}}</div>",$request['content']);
        str_replace("{{Approver}}",'<div id="approver" class="approver">{{Approver}}</div>',$request['content']);

        str_replace("{{Recipient}}","<div id='recipient'>{{Recipient}}</div>",$request['content']);
        str_replace("{{Attention}}","<div id='attention'>{{Attention}}</div>",$request['content']);
        str_replace("{{Sender}}","<div id='sender'>{{Sender}}</div>",$request['content']);
        $image_path='';

        if ($request->hasFile('background_image')) {
            $request->validate([
                'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image_path = $request->file('background_image')->store('form_background_image', 'public');
        }

        $transparacy= (float)$request->image_transparacy;
        $data = FormUpdateLog::create([
            'title' => $request->title,
            'sid' => $request->sid,
            'template_type' => $request->template_type,
            'font_type' => $request->font_type,
            'paper_size' => $request->paper_size,
            'page_type' => $request->page_type,
            'category' => $request->category,
            'created_by' => auth()->user()->id,
            'is_editable' => 0,
            'content' =>$request['content'],
            'background_image'=>$image_path,
            'image_transparacy'=>$request->image_transparacy,
        ]);


        return response()->json(["message" =>  "Form Update Log Created Successfuly !"]);
    }


    public function logIndex(Request $request)
    {
        $data =TemplateData::orderBy('id', 'desc');
        if ($request->ajax()) {
            return DataTables::of($data->select('id','sid','aid','created_at','updated_at')->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="view" > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bx-show bx-rotate-180 bx-flashing" style="color:#2e4d96"></i>
                </button> </a>';
                // $btn =$btn.'<a href="javascript:void(0)" title="Delete Content" data-toggle="tooltip" data-id="'.$row->id.'" class="delete" > <button class="btn btn-outline-danger btn-sm">
                // <i class="bx bx-trash-alt bx-flashing" style="color:#f30a0a" ></i>
                // </button> </a>';
                return $btn;
            })->rawColumns(['action'])
              ->make(true);
        }
        return view('pages.template-data.log-info');
    }


    // public function logIndex()
    // {
    //     $data = [
    //         'logs' => TemplateData::orderBy('id', 'desc')->paginate(5),
    //     ];

    //     return view('pages.template-data.log-info', $data);
    // }

    public function logShow($id)
    {
        
        $logdata = TemplateData::find($id);
        $formData = Form::where('sid',$logdata->sid)->first();


        $content=$logdata->content;
        $pageMode = $formData->page_type;
        $pageFormat = $formData->paper_size;
        $watermarkImage = $formData->background_image;
        $imageTransparacy = $formData->image_transparacy;

        $data = [
            'content' => $logdata->content,
        ];
        if(!empty($watermarkImage)){
            $pdf = newPDF::loadView('pdf-generator.pdf',compact('data'), [],
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
            $pdf = newPDF::loadView('pdf-generator.pdf',compact('data'), [],
            [
                'format' => $pageFormat,
                'orientation' => $pageMode,

            ]);
        }

        // $pdf = newPDF::loadView('pdf-generator.pdf',compact('data'), [],
        // [
        //   'format' => $pageFormat,
        //   'orientation' => $pageMode,
        //   'show_watermark_image'       => true,
        //   'watermark_image_path'       => storage_path('app/public/'.$watermarkImage),
        //   'watermark_image_alpha'      => $imageTransparacy,
        //   'watermark_image_size'       => 'D',
        //   'watermark_image_position'   => 'p',

        // ]); //view file location
        // $mpdf->SetWatermarkImage(asset('path/to/image_file'));
        // $mpdf->showWatermarkImage = true;

        // $file_path = date('Y') . '/' . date('m') . '/' . date('d');
        // if (!Storage::exists($file_path)) {
        //     Storage::makeDirectory($file_path);
        // }
        // $fileName = time() . '.'.'pdf';
        // Storage::put($file_path.'/'.$fileName, $pdf->output());
        // // $pdf->output()->move(public_path('storage/app/' . $file_path), $fileName);
        // $attachment_info = array(["url" => $baseUrl.'/'.'storage/'. $file_path . '/' . $fileName]);
        // return response()->json(['data' => $attachment_info ]);

        $pdfData = $pdf->output();

        // Embed the PDF in the HTML using an iframe
        $pdfImage = '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="600px"></iframe>';
        return view('pages.template-data.log-show', compact('pdfImage'));

    }

    public function logEdit($id)
    {
        $logdata = TemplateData::find($id);

        return view('pages.forms.populated-form-show', compact('logdata'));

    }
    public function logUpdate($id, Request $request)
    {


        $logdata = TemplateData::find($id);
        $logdata->update([
            'title' => $request->title,
            'sid' => $request->sid,
            'content' => $request['content'],
        ]);


        dd('update');
    }

    public function tableParse(Request $request)
    {
        try {

            $sid=4147;
            $form = Form::where('sid',$sid)->first();

            $data= $form ->content;
            $dom = new \DOMDocument();
            @$dom->loadHTML($data);
            // $tableRow=$dom->getElementsByTagName('tr');
            // dd($dom->xml);
            $dom->preserveWhiteSpace = false;
            $tables = $dom->getElementsByTagName('table');
            dd($tables);
            $rows = $tables->item(1)->getElementsByTagName('tr');
            dd($rows);

            dd($tables->length);
            return "AAA";

            $rows = $tables->item(1)->getElementsByTagName('tr');
            dd($form->content);

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    // public function generatePDF(Request $request ,$id)
    // {
    //     $data = Form::find($id);

    //     $pdf = DomPDF::loadView('demo', ['content' => $data->content]);
    //     return $pdf->download('generated_pdf.pdf');
    // }


 public function qrScan(){
    $qrCodes = [];
        $qrCodes['simple'] = QrCode::size(120)->generate('https://www.binaryboxtuts.com/');
        $qrCodes['changeColor'] = QrCode::size(120)->color(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
        $qrCodes['changeBgColor'] = QrCode::size(120)->backgroundColor(255, 0, 0)->generate('https://www.binaryboxtuts.com/');

        $qrCodes['styleDot'] = QrCode::size(120)->style('dot')->generate('https://www.binaryboxtuts.com/');
        $qrCodes['styleSquare'] = QrCode::size(120)->style('square')->generate('https://www.binaryboxtuts.com/');
        $qrCodes['styleRound'] = QrCode::size(120)->style('round')->generate('https://www.binaryboxtuts.com/');



        return view('qr-scan', $qrCodes);
 }

 public function FormPdfShow($id){

    $formData = Form::find($id);
    // $formData = Form::where('sid',$logdata->sid)->first();


    $content=$formData->content;
    $pageMode = $formData->page_type;
    $pageFormat = $formData->paper_size;
    $watermarkImage = $formData->background_image;
    $imageTransparacy = $formData->image_transparacy;

    $data = [
        'content' => $formData->content,
    ];
    if(!empty($watermarkImage)){
        $pdf = newPDF::loadView('pdf-generator.pdf',compact('data'), [],
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
        $pdf = newPDF::loadView('pdf-generator.pdf',compact('data'), [],
        [
            'format' => $pageFormat,
            'orientation' => $pageMode,

        ]);
    }

   

    $pdfData = $pdf->output();

    
    $pdfImage = '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="600px"></iframe>';
    return view('pages.template-data.log-show', compact('pdfImage'));
 }

}
