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
        $forms= Form::all();
        $isContent=true;
        return view('pages.editor.editor', ['form'=>$form,'isContent'=>$isContent,'forms'=>$forms]);
    }
    public function any($id)
    {   $isContent=true;
        $forms= Form::all();
        $form=Form::find($id);
        return view('pages.editor.editor', ['form'=>$form,'isContent'=>$isContent,'forms'=>$forms]);
    }
    public function background($id){
        $form=Form::find($id);
        $isContent=false;
        $forms= Form::all();
        return view('pages.editor.editor', ['form'=>$form,'isContent'=>$isContent,'forms'=>$forms]);
    }
    
}
