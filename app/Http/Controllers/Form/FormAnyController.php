<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class FormAnyController extends Controller
{
    //
    public function index(){
        $form=Form::find(1);
        return view('pages.editor.editor', ['form'=>$form]);
    }
    public function any($id)
    {   
        $form=Form::find($id);
        return view('pages.editor.editor', ['form'=>$form]);
    }
}
