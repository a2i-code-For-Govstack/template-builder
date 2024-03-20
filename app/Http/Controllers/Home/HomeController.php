<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Form;
use App\Models\TemplateData;
use App\Models\Category;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:home-index', ['only' => ['usersrole']]);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {

        $total_form = Form::count();
        $total_template_log =TemplateData::count();
        $total_category = Category::count();
        $total_user = User::count();
        return view('home',compact('total_form','total_template_log','total_category','total_user'));
    }

    public function usersrole(Request $request){

        $user = User::orderBy('id','DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('role', function($row){
                $role = '';
                 foreach ($row->getRoleNames() as $roleName ) {
                    $role='<span class="badge badge-success">'. $roleName. '</span>';
                }
                return $role;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" class="edit" > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                </button> </a>';
                $btn =$btn.'<a href="javascript:void(0)" title="Delete Content" data-toggle="tooltip" data-id="'.$row->id.'" class="delete" > <button class="btn btn-outline-danger btn-sm">
                <i class="bx bx-trash-alt bx-flashing" style="color:#f30a0a" ></i>
                </button> </a>';
                return $btn;
            })->rawColumns(['action','role'])
              ->make(true);
        }
        return view('pages.role.usersrole');
    }


}
