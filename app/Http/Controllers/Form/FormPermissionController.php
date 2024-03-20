<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use DataTables;

class FormPermissionController extends Controller
{

    function __construct()
{
     $this->middleware('permission:form-permission-index', ['only' => ['index']]);
     $this->middleware('permission:form-permission-change', ['only' => ['changePermission']]);
}


    public function index(Request $request)
    {

        try {

            $data =Form::orderBy('id', 'desc');

            if ($request->ajax()) {
                return DataTables::of($data->select('id','title','sid','is_editable','created_by','updated_by')->get())
                ->addIndexColumn()
                ->addColumn('created_by', function ($row) {
                    return isset($row->created_form->name)?$row->created_form->name:"Not Found";
                    // return $created = !is_null($row->created_by)?$row->created_form->name:"Not Found";
                })
                ->addColumn('updated_by', function ($row) {
                    // return $row->updated_form->name;
                    return isset($row->updated_form->name)?$row->updated_form->name:"Not Updated";
                    // return $updated = !is_null($row->updated_by) ? $row->updated_form->name:"Not Updated";
                })
                ->addColumn('is_editable', function ($row) {

                    // return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center"/>';
                    if($row->is_editable == 0){
                        return '<i class="fa-solid fa-circle-check" style="color: #25a01c;"></i>';
                    }else{
                        return '<i class="fa-solid fa-circle-xmark" style="color: #fd0808;"></i>';
                    };
                })
                ->addColumn('action', function($row){
                    if(auth()->user()->hasRole(['SuperAdmin','Admin'])){
                        $btn = '
                        <div class="d-flex flex-row bd-highlight mb-3">
                        <div class="p-2 bd-highlight"><a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="edit" > <button class="btn btn-outline-primary btn-sm">
                        <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                        </button> </a></div>
                        <div class="p-2 bd-highlight"><a href="javascript:void(0)" title="Change Permission" data-toggle="tooltip" data-id="'.$row->id.'" class="change_permission" > <button class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-shield-halved" style="color: #ff600a;"></i>
                        </button> </a></div>
                        </div>
                        ';

                        return $btn;
                    }

                })->rawColumns(['action','is_editable','created_by','updated_by'])
                ->make(true);
            }

            return view('pages.role.formPermission');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function changePermission($id){
        $form = Form::find($id);
        if($form->is_editable == 1){
            $form->is_editable = 0;
            $form->save();
            return response()->json(['message'=>'Form is Editable']);
        }else{
            $form->is_editable = 1;
            $form->save();
            return response()->json(['message'=>'Form Can Not Be Editable Now']);
        }
    }


}
