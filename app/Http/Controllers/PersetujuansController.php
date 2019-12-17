<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengajuan;
use App\Persetujuan;
use App\Departement;
use Auth;
use DB;
class PersetujuansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //               $data = DB::table('persetujuans as n')
        // ->join('stats as st','st.id','=','n.stat_id')
        // ->join('pengajuans as p','p.id','=','n.pngjuan_id')
        // ->join('items as i','i.id','=','p.item_id')
        // ->join('users as u','u.id','=','p.user_id')
        // ->select(DB::raw('st.name as st_name'),DB::raw('i.name as item_name'),'p.total','p.id',DB::raw('st.id as st_id'))
        // ->orderBy('n.id')
        // ->get();
        // dd($data);
    if(request()->ajax())
     {
      if(!empty($request->departement))
      {
        $data = DB::table('persetujuans as n')
        ->join('stats as st','st.id','=','n.stat_id')
        ->join('pengajuans as p','p.id','=','n.pngjuan_id')
        ->join('items as i','i.id','=','p.item_id')
        ->join('users as u','u.id','=','p.user_id')
        ->join('departements as d','d.id','=','u.departements_id')
        ->select(DB::raw('st.name as st_name'),DB::raw('i.name as item_name'),'p.total','n.id',DB::raw('st.id as st_id'))
        ->orderBy('n.id')
        ->where('d.name',$request->departement)
        ->where('deleted_at',NULL)
        ->get();
      }
      else
      {
       $data = DB::table('persetujuans as n')
        ->join('stats as st','st.id','=','n.stat_id')
        ->join('pengajuans as p','p.id','=','n.pngjuan_id')
        ->join('items as i','i.id','=','p.item_id')
        ->join('users as u','u.id','=','p.user_id')
        ->where('deleted_at',NULL)
        ->select(DB::raw('st.name as st_name'),DB::raw('i.name as item_name'),'p.total','n.id',DB::raw('st.id as st_id'))
        ->orderBy('n.id')
        ->get();
      }

      return datatables()->of($data)->addColumn('action',function($data){
       
                $button = '<button type="button" name=delete id="'.$data->id.'" class="delete btn btn-primary btn-sm">Setuju</button>';
                return $button;     
                
            })->rawColumns(['action'])->make(true);
     }//request ajax
    $departement = DB::table('departements')
    ->select('name')
    ->get();
    return view('persetujuan.index',compact('departement'));



    }//end index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = Auth::user();
        $data = Persetujuan::findOrFail($id);
        $data->update([
            'stat_id' => 3,
            'user_id' =>$user->id
        ]);
        $data->delete();
        return back();
        // dd($id);
    }
}
