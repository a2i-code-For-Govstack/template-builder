<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;


class CategoryController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit', ['only' => ['index']]);
         $this->middleware('permission:category-create', ['only' => ['createCategory']]);
         $this->middleware('permission:category-edit', ['only' => ['editCategory','updateCategory']]);
        //  $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    // listing all category data using yajra datatable

    public function index(Request $request){
        $data =Category::query()->orderBy('id', 'desc');
        if ($request->ajax()) {
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#updateModal" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="edit_category " > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                </button> </a>';
                // $btn =$btn.'<a href="javascript:void(0)" title="Delete Content" data-toggle="tooltip" data-id="'.$row->id.'" class="delete_category" > <button class="btn btn-outline-danger btn-sm">
                // <i class="bx bx-trash-alt bx-flashing" style="color:#f30a0a" ></i>
                // </button> </a>';
                return $btn;
            })->rawColumns(['action'])
              ->make(true);
        }

        return view('pages.category.index');
    }


    // creating category data with ajax
    public function createCategory(Request $request) {
        $request->validate(
            ['name' => 'required']
        );

       $category = new Category();
       $category->name=$request->name;
       $category->created_by=auth()->user()->id;
       $category->save();
       return response()->json(["message" =>  "Category Added Successfuly !"]);
    }

    // editing category data

    public function editCategory( Request $request ){
        $id=$request->category_id;
        $data=Category::find($id);
        return response()->json($data);

     }

    //  update the selected category data
     public function updateCategory(Request $request) {
        $request->validate(
            ['name' => 'required']
        );
        $id=$request->id;
        $data=Category::find($id);
        $data->name=$request->name;
        $data->updated_by=auth()->user()->id;
        $data->save();
        return response()->json(["message" =>  "Category Updated Successfuly !"]);
    }

    // delete the category data
    // public function deleteCategory( Request $request ){
    //     $id=$request->category_id;
    //     $data=Category::find($id);
    //     $data->delete();
    //     return response()->json([
    //      'status' => 'success',
    //     ]);

    //  }


}
