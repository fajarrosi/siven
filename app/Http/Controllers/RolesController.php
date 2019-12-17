<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Role;
use  App\Permission;
use Illuminate\Support\Facades\DB;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('role.create',compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
           $role = Role::create([
                'name' => $request->name,
                'display_name' =>$request->display_name,
            ]);
           $role->attachPermissions($request->p);
           
           return redirect()->route('role.index')->withStatus('Role berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $roles = Role::findOrFail($id);
        return view('role.detail',compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $role_permission = $role->permissions()->get()->pluck('id')->toArray();

        return view('role.edit',compact('role','permissions','role_permission'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'display_name'=> $request->display_name
        ]);
        DB::table("permission_role")->where("permission_role.role_id", $id)->delete();
            // Attach permission to role
           $role->attachPermissions($request->p);

           return redirect()->route('role.index')->withStatus('Role berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $role = Role::find($id);
        $role->delete();
           return redirect()->route('role.index')->withStatus('Role berhasil dihapus');

    }
}
