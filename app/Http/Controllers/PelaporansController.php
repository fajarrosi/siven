<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
class PelaporansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = DB::table('persetujuans as ps')
        ->join('pengajuans as pj','pj.id','=','ps.pngjuan_id')
        ->join('items as i','i.id','=','pj.item_id')
        ->join('item_departement as id','id.item_id','=','pj.item_id')
        ->select('i.name','pj.total',DB::raw('DATE_FORMAT(ps.updated_at, "%d-%b-%Y") as updated_at'))
        ->where('ps.stat_id',3)
        ->where('ps.user_id',1)
        ->where('id.departement_id',$user->departements_id)
        ->get();
        // dd($data);
        return view('laporan.index',compact('data'));
    }

    public function generatePdf(){
        $user = Auth::user();

        $data = DB::table('persetujuans as ps')
        ->join('pengajuans as pj','pj.id','=','ps.pngjuan_id')
        ->join('items as i','i.id','=','pj.item_id')
        ->join('item_departement as id','id.item_id','=','pj.item_id')
        ->select('i.name','pj.total','ps.updated_at')
        ->where('ps.stat_id',3)
        ->where('ps.user_id',1)
        ->where('id.departement_id',$user->departements_id)
        ->get();

        $pdf = PDF::loadView('laporan.print',compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan.pdf');

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
    }

    public function generatePdfByDateRange($input1,$input2)
    {
        $user = Auth::user();
        $date1 = date("Y-m-d",strtotime($input1));
        $date2 = date("Y-m-d",strtotime($input2));

        $data = DB::table('persetujuans as ps')
        ->join('pengajuans as pj','pj.id','=','ps.pngjuan_id')
        ->join('items as i','i.id','=','pj.item_id')
        ->join('item_departement as id','id.item_id','=','pj.item_id')
        ->select('i.name','pj.total','ps.updated_at')
        ->where('ps.stat_id',3)
        ->where('ps.user_id',1)
        ->where('id.departement_id',$user->departements_id)
        ->whereBetween('ps.updated_at',[$date1." 00:00:00",$date2." 00:00:00"])
        ->get();
         $pdf = PDF::loadView('laporan.print',compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan.pdf');

        // dd($data);
    }

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
        //
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
    }
}
