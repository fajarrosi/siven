<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cond;

class CondsController extends Controller
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
        $conds = Cond::all();
        return view('cond.index',compact('conds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cond.create');
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
        $cond = Cond::create([
            'name'=> $request->name
        ]);

           return redirect()->route('cond.index')->withStatus('kondisi berhasil ditambahkan');

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
        $cond = Cond::findOrFail($id);
        return view('cond.edit',compact('cond'));
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
        $cond = Cond::findOrFail($id);
        $cond->update([
                'name'=>$request->name
            ]);
           return redirect()->route('cond.index')->withStatus('kondisi berhasil diupdate');

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
        $cond = Cond::findOrFail($id);
        $cond->delete();
           return redirect()->route('cond.index')->withStatus('kondisi berhasil dihapus');

    }
}
