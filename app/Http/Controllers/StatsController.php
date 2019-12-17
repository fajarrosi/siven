<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stat;

class StatsController extends Controller
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
        $stats = Stat::all();
        return view('stat.index',compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('stat.create');
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
        $stat = Stat::create([
            'name' => $request->name
        ]);
           return redirect()->route('stat.index')->withStatus('stat berhasil dibuat');

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
        $stat = Stat::findOrFail($id);
        return view('stat.edit',compact('stat'));
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
        $stat = Stat::findOrFail($id);
        $stat->update([
            'name'=>$request->name
            ]);
           return redirect()->route('stat.index')->withStatus('stat berhasil diupdate');

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
        $stat = Stat::findOrFail($id);
        $stat->delete();
           return redirect()->route('stat.index')->withStatus('stat berhasil dihapus');

    }
}
