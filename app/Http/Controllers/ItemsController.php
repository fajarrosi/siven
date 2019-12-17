<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Departement;
use Auth;
use Illuminate\Support\Facades\DB;



class ItemsController extends Controller
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
    $user = Auth::user();

        $items = DB::table('item_departement as i')
        ->join('departements as d','d.id','=','i.departement_id')
        ->join('items as t','t.id','=','i.item_id')
        ->select('t.name','t.id')
        ->where('d.id','=',$user->departements_id)
        ->get();
        // $items = Item::all();
        return view('item.index',compact('items'));
        // dd($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('item.create');
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
    $user = Auth::user();

        $item = Item::create([
            'name' =>$request->name,
        ]);
        $d = Departement::findOrFail($user->departements_id);
        $item->departements()->attach($d);
        // dd($item->id);
           return redirect()->route('item.index')->withStatus('Item berhasil ditambahkan');

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
        $item = Item::findOrFail($id);
        return view('item.edit',compact('item'));
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
        $item = Item::findOrFail($id);
        $item->update([
            'name'=>$request->name
        ]);
           return redirect()->route('item.index')->withStatus('Item berhasil diupdate');

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
        $item = Item::findOrFail($id);
        $item->delete();
           return redirect()->route('item.index')->withStatus('Item berhasil dihapus');

    }
}
