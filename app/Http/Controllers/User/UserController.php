<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['deleteUser']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name','!=','SuperAdmin')->orderBy('id','DESC')->get();
        return view('pages.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        $user->assignRole($request->input('roles'));
        return response()->json(["message" =>  "User Created Successfuly !"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::where('name','!=','SuperAdmin')->orderBy('id','DESC')->get();
        return view('pages.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'roles' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return response()->json(["message" =>  "User Updated Successfuly !"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUser(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    // public function assignRole(Request $request)
    // {
    //     dd($request->all());
    //     $request->validate([
    //         'role_id' => 'required',
    //         'user_id' => 'required'
    //     ]);

    //     $user = User::find($request->input('user_id'));
    //     $user->assignRole($request->input('roles'));
    //     return response()->json(["message" =>  "Role Assigned Successfuly !"]);
    // }



}
