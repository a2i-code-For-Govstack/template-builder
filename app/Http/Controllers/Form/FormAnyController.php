<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class FormAnyController extends Controller
{
    //
    public function editor(){
        $form=Form::find(1);
        $isContent=true;
        return view('pages.editor.editor', ['form'=>$form,'isContent'=>$isContent]);
    }
    public function any($id)
    {   $isContent=true;
        $form=Form::find($id);
        return view('pages.editor.editor', ['form'=>$form,'isContent'=>$isContent]);
    }
    public function background($id){
        $form=Form::find($id);
        $isContent=false;
        return view('pages.editor.editor', ['form'=>$form,'isContent'=>$isContent]);
    }
}
