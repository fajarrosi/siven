<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stok_item;
use App\Item;
use App\Cond;
use App\Departement;
use Illuminate\Support\Facades\DB;
use Auth;


class Stok_ItemsController extends Controller
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
        

        $s = DB::table('stok_items as s')
        ->join('items as i','i.id','=','s.items_id')
        ->join('item_departement as id','s.items_id','=','id.item_id')
        ->join('departements as d','d.id','=','id.departement_id')
        ->select(DB::raw('i.name as item_name'),'s.total','s.id')
        ->where('d.id','=',$user->departements_id)
        ->get();
        // dd($s[3]->total);
        //detail item
        // $data = DB::table('item_details')
        // ->where('user_id',$user->id)
        // ->where('item_id',20)
        // ->count('item_id');
        // // dd($s,$data);
        return view('stok.index',compact('s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    // $user = Auth::user();

    //     $item = DB::table('item_departement as i')
    //     ->join('departements as d','d.id','=','i.departement_id')
    //     ->join('items as t','t.id','=','i.item_id')
    //     ->select('t.name','t.id')
    //     ->where('d.id','=',$user->departements_id)
    //     ->get();
    //     // dd($i);
    //     $cond = Cond::all();
    //     return view('stok.create',compact('item','cond'));
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
        $item = Stok_item::create([
            'items_id' =>$request->items_id,
            'total'=>$request->total,
            'conds_id'=>$request->conds_id
        ]);
        return redirect()->route('stok.index')->withStatus('stok berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stok_item $stok)
    {
        //

           session(['show_id' => $stok]);
       if(request()->ajax())
       {
        $user = Auth::user();
        $get_item_id = DB::table('stok_items')
        ->where('id',$stok->id)
        ->value('items_id');
           $data = DB::table('item_details as id')
           ->join('items as i','i.id','=','id.item_id')
           ->join('conds as c','c.id','=','id.cond_id')
           ->join('users as u','u.id','=','id.user_id')
           ->join('departements as d','d.id','=','u.departements_id')
           ->select(DB::raw('i.name as itemname'),'id.kode_item',DB::raw('c.name as kondisi'))
           ->where('d.id',$user->departements_id)
           ->where('id.item_id',$get_item_id)
           ->get();
           return datatables()->of($data)
           ->make(true);
       }

       return view('stok.detail');

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
        $user = Auth::user();

        $stok = Stok_item::findOrFail($id);
        $cond = Cond::all();
        $items = DB::table('item_departement as i')
        ->join('departements as d','d.id','=','i.departement_id')
        ->join('items as t','t.id','=','i.item_id')
        ->select('t.name','t.id')
        ->where('d.id','=',$user->departements_id)
        ->get();
        // dd($stok,$cond,$items);
        return view('stok.edit',compact('items','cond','stok'));
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
        $item = Stok_item::findOrFail($id);
        $item->update([
            'items_id' =>$request->item_id,
            'total'=>$request->total,
            'conds_id'=>$request->kondisi_id
        ]);
        return redirect()->route('stok.index')->withStatus('stok berhasil diupdate');

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
        $item = Stok_item::findOrFail($id);
        $item->delete();
        return redirect()->route('stok.index')->withStatus('stok berhasil dihapus');

    }
}
