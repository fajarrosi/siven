<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengajuan;
use App\Persetujuan;
use App\Stat;
use App\Item;
use App\Departement;
use Illuminate\Support\Facades\DB;
use Auth;



class PengajuansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();

        $data = DB::table('persetujuans as n')
        ->join('stats as st','st.id','=','n.stat_id')
        ->join('pengajuans as p','p.id','=','n.pngjuan_id')
        ->join('items as i','i.id','=','p.item_id')
        ->join('users as u','u.id','=','p.user_id')
        ->select(DB::raw('st.name as st_name'),DB::raw('i.name as item_name'),'p.total','p.id',DB::raw('st.id as st_id'),DB::raw('u.name as username'))
        ->where('u.departements_id','=',$user->departements_id)
        ->get();
        // dd($sender,$data);
        return view('pengajuan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $data = DB::table('item_departement as id')
        ->join('items as i','i.id','=','id.item_id')
        ->join('departements as d','d.id','=','id.departement_id')
        ->select('i.name','i.id')
        ->where('d.id','=',$user->departements_id)
        ->get();
        // dd($data);
        return view('pengajuan.create',compact('data'));
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
                //kpk
                if(Auth::user()->hasRole('kpk')){
                    if($request->barang_id == 'other'){
                        $barang = Item::create([
                            'name' =>$request->new
                        ]);
                        $d = Departement::findOrFail($user->departements_id);
                        $barang->departements()->attach($d);
                        $x = Pengajuan::create([
                            'user_id' =>$user->id,
                            'item_id' =>$barang->id,
                            'total' =>$request->total
                        ]);
                        $p = Pengajuan::findOrFail($x->id);
                        $stju = Persetujuan::create([
                            'stat_id'=>2,
                            'pngjuan_id'=>$x->id
                        ]);
                        $p->persetujuan()->save($stju); 
                    }else{
                     $pngjuan = Pengajuan::create([
                        'user_id' =>$user->id,
                        'item_id'=>$request->barang_id,
                        'total'=>$request->total
                    ]);
                     $p = Pengajuan::findOrFail($pngjuan->id);
                     $stju = Persetujuan::create([
                        'stat_id'=>2,
                        'pngjuan_id'=>$pngjuan->id
                    ]);
                     $p->persetujuan()->save($stju);  
                    }//end else
                //bukan kpk
                }else{
                     if($request->barang_id == 'other'){
                        $barang = Item::create([
                            'name' =>$request->new
                        ]);
                        $d = Departement::findOrFail($user->departements_id);
                        $barang->departements()->attach($d);
                        $x = Pengajuan::create([
                            'user_id' =>$user->id,
                            'item_id' =>$barang->id,
                            'total' =>$request->total
                        ]);
                        $p = Pengajuan::findOrFail($x->id);
                        $stju = Persetujuan::create([
                            'stat_id'=>1,
                            'pngjuan_id'=>$x->id
                        ]);
                        $p->persetujuan()->save($stju); 
                    }else{
                     $pngjuan = Pengajuan::create([
                        'user_id' =>$user->id,
                        'item_id'=>$request->barang_id,
                        'total'=>$request->total
                    ]);
                     $p = Pengajuan::findOrFail($pngjuan->id);
                     $stju = Persetujuan::create([
                        'stat_id'=>1,
                        'pngjuan_id'=>$pngjuan->id
                    ]);
                     $p->persetujuan()->save($stju);  
                     }//end else  
                }//endelse

        return redirect()->route('pngjuan.index')->withStatus('Pengajuan berhasil ditambah');
    } //end store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                $user = Auth::user();

        $x = Pengajuan::findOrFail($id);
        $y = DB::table('persetujuans')
        ->where('pngjuan_id',$x->id)
        ->update(['stat_id' => 2,'user_id' => $user->id]);
        // dd($x,$y);
        return back()->withStatus('Pengajuan berhasil disetujui');
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
        $pngjuan =Pengajuan::findOrFail($id);
        $item = DB::table('item_departement as id')
        ->join('items as i','i.id','=','id.item_id')
        ->join('departements as d','d.id','=','id.departement_id')
        ->select('i.name','i.id')
        ->where('d.id','=',$user->departements_id)
        ->get();
        // dd($pngjuan,$item);
        return view('pengajuan.edit',compact('pngjuan','item'));
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
        $pngjuan = Pengajuan::findOrFail($id);
        $pngjuan->update([
            'item_id'=>$request->item_id,
            'total'=>$request->total
        ]);
        return redirect()->route('pngjuan.index')->withStatus('Pengajuan berhasil diupdate');

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
        $p = Pengajuan::findOrFail($id);
        $p->delete();
        return redirect()->route('pngjuan.index')->withStatus('Pengajuan berhasil dihapus');

    }
}
