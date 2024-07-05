<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
class FormOneController extends Controller
{
    public function index()
    {
        $data = [
            'date' => '10/11/23' ,
//            'organizationName' => 'Nahin Ahmed' ,
//            'country' => 'Dhaka, Bangladesh' ,
        ];

        return view('pages.editor-one',$data);
    }
    public function any($id)
    {   
        $form=Form::find($id);
        return view('pages.editor.editor', ['form'=>$form]);
    }
}
