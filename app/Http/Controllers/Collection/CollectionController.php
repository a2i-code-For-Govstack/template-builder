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
        return view('pages.collection.collection', compact('forms'));

    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $forms= Form::all();
        $results = Form::where('category', 'LIKE', "%{$query}%")->get();
        return view('pages.collection.collection', ['results' => $results],['forms'=>$forms]);
    }
}
