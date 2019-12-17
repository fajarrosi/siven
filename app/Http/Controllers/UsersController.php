<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;
use  App\Role;
use  App\Permission;
use App\Departement;
use Hash;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
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
        // $users = User::all();
        $users = DB::table('users as u')
        ->join('departements as d','d.id','=','u.departements_id')
        ->join('role_user as ru','ru.user_id','=','u.id')
        ->join('roles as r','r.id','=','ru.role_id')
        ->select('u.name',DB::raw('d.name as dname'),'u.email',DB::raw('r.name as role'),'u.id')
        ->get();


        // return response()->json($users);
        // dd($users);
        return view('user.index',compact('users'));
        //compact('users') == ['users' => $users]

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $roles= Role::all();
        $departements = Departement::all();
        return view('user.create',compact('roles','departements'));
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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'departements_id' =>$request->departement,
        ]);
        $user->attachRole($request->role_id);
        return redirect()->route('user.index')->withStatus([
            'message' => 'Data berhasil ditambahkan',
             'color' => 'success'
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $Departement = Departement::all();
        $d = DB::table('departements')
        ->join('users','departements.id','=','users.departements_id')
        ->where('users.id','=',$user->id)
        ->value('departements.name');

        return view('user.detail',compact('user','Departement','d'));
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
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit',['user' => $user,'roles' => $roles]);
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
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
                        $roles = $user->roles;

                foreach ($roles as $key => $value) {
                    $user->detachRole($value);
                }

                $role = Role::find($request->input('role_id'));

                $user->attachRole($role);
            // $user->attachRole($request->role);
             return redirect()->route('user.index')->withStatus([
            'message' => 'Data berhasil diupdate',
             'color' => 'success'
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if (auth()->user() == $user){
        return back()->withStatus([
            'message' => 'anda tidak dapat menghapus',
             'color' => 'danger'
         ]);

        }
        $user->delete();
        return redirect()->route('user.index')->withStatus([
            'message' => 'Data berhasil dihapus',
             'color' => 'success'
         ]);
    }
}
