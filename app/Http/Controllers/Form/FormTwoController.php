<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormTwoController extends Controller
{
    public function index()
    {
        $data = [
            'date' => '10/11/23' ,
//            'organizationName' => 'Nahin Ahmed' ,
//            'country' => 'Dhaka, Bangladesh' ,
        ];
        return view('pages.editor-two',$data);
    }

 
}
