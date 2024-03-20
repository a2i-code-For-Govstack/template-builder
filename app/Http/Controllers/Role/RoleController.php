<?php

namespace App\Http\Controllers\Role;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

use DataTables;

class RoleController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit', ['only' => ['index']]);
         $this->middleware('permission:role-create', ['only' => ['createRole','createPermission','role_permission']]);
         $this->middleware('permission:role-edit', ['only' => ['edit,update']]);
         $this->middleware('permission:role-delete', ['only' => ['role_delete','permission_delete']]);
         $this->middleware('permission:role-pemission-edit', ['only' => ['role_edit','permission_edit','role_update','permission_update']]);
    }

    public function createRole(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        return response()->json(["message" =>  "Role Created Successfuly !"]);
    }
    public function createPermission(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $role = Permission::create(['name' => $request->input('name')]);
        return response()->json(["message" =>  "Permission Created Successfuly !"]);
    }

    public function role_delete($id){
        $role = Role::find($id);
        $role->delete();
        return response()->json(["message" =>  "Role deleted Successfuly !"]);
    }

    public function permission_delete($id){
        $role = Permission::find($id);
        $role->delete();
        return response()->json(["message" =>  "Permission deleted Successfuly !"]);
    }
    public function role_edit($id){
        $role = Role::find($id);

        return response()->json(['role'=>$role]);
    }

    public function permission_edit($id){
        $permission = Permission::find($id);

        return response()->json(['permission'=>$permission]);

    }

    public function role_update(Request $request){

        $request->validate([
            'role_id'=>'required',
            'name' => 'required',
        ]);

        $role = Role::find($request->input('role_id'));
        $role->name = $request->input('name');
        $role->save();
        return response()->json(["message" =>  "Role Updated Successfuly !"]);
    }

    public function permission_update(Request $request){
        $request->validate([
            'permission_id'=>'required',
            'name' => 'required',
        ]);
        $role = Permission::find($request->input('permission_id'));
        $role->name = $request->input('name');
        $role->save();
        return response()->json(["message" =>  "Permission Updated Successfuly !"]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $permission = Permission::get();
        $rolePermissions = [];
        $roles = Role::orderBy('id','DESC')->get();

        $permissions = Permission::orderBy('id','DESC')->get();
        return view('pages.role.index',compact('roles','permissions','rolePermissions','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request): RedirectResponse
    // {

    //     // $this->validate($request, [
    //     //     'role_id' => 'required',
    //     //     'permission' => 'required',
    //     // ]);
    //     $id = $request->input('role_id');

    //     DB::table("role_has_permissions")->where("role_has_permissions.role_id",$request->input('role_id'))->delete();

    //     $role = Role::find($request->input('role_id'));
    //     $role->permissions()->sync($request->input('permission'));
    //     return redirect()->back();


    // // insert using loop


    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function role_permission(Request $request){
        $role_id = $request->input('role_id');
        $role = Role::find($role_id);
        if ($request->ajax()) {
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role_id)
            ->pluck('role_has_permissions.permission_id')
            ->all();
            return response()->json(['rolePermissions'=>$rolePermissions]);
        }

        $permission = Permission::get();
        return view('pages.role.role_permission',compact('role','permission','rolePermissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function edit($id)
     {
         $role = Role::find($id);
         $permission = Permission::get();
         $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
             ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
             ->all();

         return view('pages.role.edit',compact('role','permission','rolePermissions'));
        // return response()->json(['role'=>$role,'permissions'=>$permissions,'rolePermissions'=>$rolePermissions]);
     }

    //  public function update(Request $request, $id): RedirectResponse
    //  {
    //      $this->validate($request, [
    //          'name' => 'required',
    //          'permission' => 'required',
    //      ]);


    //      $role = Role::find($id);
    //      $role->name = $request->input('name');

    //      $role->save();

    //      // $role->syncPermissions($request->input('permission'));
    //      $role->permissions()->sync($request->input('permission'));

    //      return redirect()->back()
    //                      ->with('success','Role updated successfully');
    //  }


      public function update(Request $request, $id)
     {
        $this->validate($request, [
                    'role_id' => 'required',
                    'permission' => 'required',
                 ]);

         $role = Role::find($request->input('role_id'));
         $role->name = $role->name;
         $role->save();
         $role->permissions()->sync($request->input('permission'));
         return redirect()->back()
                         ->with('success','Role updated successfully');
     }




    //  public function updateroleper(){
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'permission' => 'required',
    //     ]);


    //     $role = Role::find($id);
    //     $role->name = $request->input('name');
    //     $role->save();

    //     // $role->syncPermissions($request->input('permission'));
    //     $role->permissions()->sync($request->input('permission'));

    //     return redirect()->back()
    //                     ->with('success','Role updated successfully');
    //  }

    public function roleTable(Request $request){
        $role = Role::orderBy('id','DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($role)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" id="edit_role" > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                </button> </a>';
                $btn =$btn.'<a href="javascript:void(0)" title="Delete Content" data-toggle="tooltip" data-id="'.$row->id.'" id="delete_role" > <button class="btn btn-outline-danger btn-sm">
                <i class="bx bx-trash-alt bx-flashing" style="color:#f30a0a" ></i>
                </button> </a>';
                return $btn;
            })->rawColumns(['action'])
              ->make(true);
        }

    }


    public function PermissionTable(Request $request){
        $permission = Permission::orderBy('id','DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($permission)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" title="Edit Content" data-toggle="tooltip" data-id="'.$row->id.'" id="edit_permission" > <button class="btn btn-outline-primary btn-sm">
                <i class="bx bxs-edit-alt bx-flashing" style="color:#0a36f3" ></i>
                </button> </a>';
                $btn =$btn.'<a href="javascript:void(0)" title="Delete Content" data-toggle="tooltip" data-id="'.$row->id.'" id="delete_permission" > <button class="btn btn-outline-danger btn-sm">
                <i class="bx bx-trash-alt bx-flashing" style="color:#f30a0a" ></i>
                </button> </a>';
                return $btn;
            })->rawColumns(['action'])
              ->make(true);
        }

    }




}
