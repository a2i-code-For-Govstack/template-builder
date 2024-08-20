<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class CollectionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function index()
    {
        $forms= Form::all();
        $searched="";
        return view('pages.collection.collection',['forms'=>$forms] ,['searched'=> $searched]);

    }
    public function search(Request $request)
    {   
        $categoryMappings = [
            'official' => 1,
            'advertisement' => 2,
            'resume' => 3,
            'invitation' => 4,
            'socialmedia'=>5,
            'certificate'=>6,
            'poster'=>7,
            'letter'=>8
        ];
        $query = $request->input('query');
        $category = $categoryMappings[strtolower($query)] ?? null;
        if ($category !== null) {
            $results = Form::where('category', $category)->get();
        } else {
            $results = collect(); // Return an empty collection if no match is found
        }
        $forms= Form::all();
        $searched=$query;
        return view('pages.collection.collection', ['results' => $results,'forms'=>$forms,'searched'=> $searched]);
        
    }
    public function select(Request $request, $id){
        $categoryMappings = [
            'official' => 1,
            'advertisement' => 2,
            'resume' => 3,
            'invitation' => 4,
            'socialmedia'=>5,
            'certificate'=>6,
            'poster'=>7,
            'letter'=>8
        ];
   
        $category = $categoryMappings[strtolower($id)] ?? null;
        if($id=='all'){
            $results = Form::all();
        }
        else if ($category !== null) {
            $results = Form::where('category', $category)->get();
        } 
        else {
            $results = collect(); // Return an empty collection if no match is found
        }
        $forms= Form::all();
        $searched=$id;
        return view('pages.collection.collection', ['results' => $results,'forms'=>$forms,'searched'=> $searched]);

    }
}
