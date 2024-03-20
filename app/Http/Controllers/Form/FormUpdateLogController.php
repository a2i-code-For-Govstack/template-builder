<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Category;
use App\Models\FormUpdateLog;
use DataTables;
use Illuminate\Support\Collection;
use App\Orangebd\ServiceIdClass;
use Illuminate\Support\Facades\File;




class FormUpdateLogController extends Controller
{
    public function formUpdateLogList(Request $request,$id=null)
    {

        $form = Form::find($id);
        $formUpdateLogs = FormUpdateLog::where('sid', $form->sid)->orderBy('id', 'desc');
        if ($request->ajax()) {
            return DataTables::of($formUpdateLogs->select('id','title','sid')->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="edit" > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                </button> </a>';
                $btn =$btn.'<a href="javascript:void(0)" title="Set To Live" data-toggle="tooltip" data-id="'.$row->id.'" class="set_to_live" > <button class="btn btn-outline-secondary btn-sm">
                <i class="fa-brands fa-creative-commons-sampling" style="color: #03c700;"></i>
                </button> </a>';
                return $btn;
            })->rawColumns(['action'])
              ->make(true);
        }
        return view('pages.FormLog.index',compact('id'));
    }

    public function editformUpdateLogList($id)
    {
        $data = FormUpdateLog::find($id);
        $category = Category::all();
        $jsonData = ServiceIdClass::getServiceId();
        return view('pages.FormLog.editFormLog',compact('data','category','jsonData'));
    }

    public function updateformUpdateLogList(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'template_type' => 'required',
            'font_type' => 'required',
            'paper_size' => 'required',
            'page_type' => 'required',
            'category' => 'required',

        ]);

        $form = FormUpdateLog::find($id);


        if($form->is_editable == 0 || auth()->user()->hasRole('SuperAdmin') ){
            $form->title = $request->title;
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

    }

    public function formUpdateLogListSetlive($id)
    {
        $formUpdateLogs = FormUpdateLog::find($id);

        if(strpos($formUpdateLogs['content'], "{{Copier}}") !== false && strpos($formUpdateLogs['content'], "<div id=\"copier\">{{Copier}}</div>") === false){

            $formUpdateLogs['content'] = preg_replace('#<div id="copier">(.*?)<\/div>#', '',  $formUpdateLogs['content']);
            $formUpdateLogs['content'] = str_replace("{{Copier}}","<div id='copier'>{{Copier}}</div>",$formUpdateLogs['content']);

        }

        if(strpos($formUpdateLogs['content'], "{{Approver}}") !== false && strpos($formUpdateLogs['content'], '<div id="approver" class="approver">{{Approver}}</div>') === false){

            $formUpdateLogs['content'] = preg_replace('#<div id="approver" class="approver">(.*?)<\/div>#', '',  $formUpdateLogs['content']);
            $formUpdateLogs['content'] = str_replace("{{Approver}}",'<div id="approver" class="approver">{{Approver}}</div>',$formUpdateLogs['content']);
        }

        if(strpos($formUpdateLogs['content'], "{{Recipient}}") !== false && strpos($formUpdateLogs['content'], "<div id=\"recipient\">{{Recipient}}</div>") === false){
            $formUpdateLogs['content'] = preg_replace('#<div id="recipient">(.*?)<\/div>#', '',  $formUpdateLogs['content']);
            $formUpdateLogs['content'] = str_replace("{{Recipient}}","<div id='recipient'>{{Recipient}}</div>",$formUpdateLogs['content']);
        }

        if(strpos($formUpdateLogs['content'], "{{Attention}}") !== false && strpos($formUpdateLogs['content'], "<div id=\"attention\">{{Attention}}</div>") === false){
            $formUpdateLogs['content'] = preg_replace('#<div id="attention">(.*?)<\/div>#', '',  $formUpdateLogs['content']);
            $formUpdateLogs['content'] = str_replace("{{Attention}}","<div id='attention'>{{Attention}}</div>",$formUpdateLogs['content']);
        }

        if(strpos($formUpdateLogs['content'], "{{Sender}}") !== false && strpos($formUpdateLogs['content'], "<div id=\"sender\">{{Sender}}</div>") === false){
            $formUpdateLogs['content'] = preg_replace('#<div id="sender">(.*?)<\/div>#', '',  $formUpdateLogs['content']);
            $formUpdateLogs['content'] = str_replace("{{Sender}}","<div id='sender'>{{Sender}}</div>",$formUpdateLogs['content']);
        }


        $form = Form::where('sid', $formUpdateLogs->sid)->first();
        if($form->is_editable == 0 || auth()->user()->hasRole('SuperAdmin') ){

            $form->title = $formUpdateLogs->title;
            $form->template_type = $formUpdateLogs->template_type;
            $form->font_type = $formUpdateLogs->font_type;
            $form->paper_size = $formUpdateLogs->paper_size;
            $form->page_type = $formUpdateLogs->page_type;
            $form->category = $formUpdateLogs->category;
            $form->updated_by = auth()->user()->id;
            $form->content = $formUpdateLogs['content'];
            $form->background_image = $formUpdateLogs->background_image;
            $form->image_transparacy = $formUpdateLogs->image_transparacy;
            $form->save();
            return response()->json(["message" =>  "Form Updated Successfuly !"]);
        }else{
            return response()->json(["message" =>  "You don't have permission to edit this form !"]);
        }

        return response()->json(["message" =>  "Form Updated Successfuly !"]);
    }


}
