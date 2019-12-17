<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemDetail;
use App\Stok_item;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use App\Item;
use App\Departement;
class ItemDetailsController extends Controller
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
        if(request()->ajax())
        {
            $user = Auth::user();
            $data = DB::table('item_details as id')
            ->join('items as i','i.id','=','id.item_id')
            ->join('conds as c','c.id','=','id.cond_id')
            ->join('users as u','u.id','=','id.user_id')
            ->join('departements as d','d.id','=','u.departements_id')
            ->select('id.id',DB::raw('i.name as itemname'),'id.kode_item',DB::raw('c.name as kondisi'))
            ->where('d.id',$user->departements_id)
            ->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $item = DB::table('item_departement as i')
        ->join('departements as d','d.id','=','i.departement_id')
        ->join('items as t','t.id','=','i.item_id')
        ->select('t.name','t.id')
        ->where('d.id','=',$user->departements_id)
        ->get();
        $kondisi = DB::table('conds')
        ->select('name','id')
        ->get();
        return view('itemdetail.index',compact('item','kondisi'));
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
        $rules = array(
            'kode_item'    =>  'required|integer'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $user = Auth::user();
        if($request->item_id == 'other'){
            $barang = Item::create([
                            'name' =>$request->new
                        ]);
            $d = Departement::findOrFail($user->departements_id);
                        $barang->departements()->attach($d);
                $data = ItemDetail::create([
                'kode_item' =>$request->kode_item,
                'item_id' => $barang->id,
                'user_id' => $user->id,
                'cond_id' => $request->cond_id
            ]);
            $stok = Stok_item::firstOrNew(
                ['items_id' => $barang->id],
            );
            $stok->total = ($stok->total + 1);
            $stok->save();
        return response()->json(['success' => 'Status File Upload berhasil ditambahkan']);

        }else{

            $data = ItemDetail::create([
                'kode_item' =>$request->kode_item,
                'item_id' => $request->item_id,
                'user_id' => $user->id,
                'cond_id' => $request->cond_id
            ]);
            $stok = Stok_item::firstOrNew(
                ['items_id' => $request->item_id],
            );
            $stok->total = ($stok->total + 1);
            $stok->save();
        return response()->json(['success' => 'Status File Upload berhasil ditambahkan']);
        }

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
        if(request()->ajax())
        {
            $data = ItemDetail::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user = Auth::user();
        $data = ItemDetail::findOrFail($request->hidden_id);
        $data->update([
            'kode_item' =>$request->kode_item,
            'item_id' => $request->item_id,
            'user_id' => $user->id,
            'cond_id' => $request->cond_id
        ]);

        return response()->json(['success' => 'barang berhasil di update']);
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

        // $w= json_decode(json_encode($id),true);

        $itemdetail = ItemDetail::findOrFail($id);

        
        $stok = DB::table('stok_items as si')
        ->join('item_details as id','id.item_id','=','si.items_id')
        ->where('id.id',$id)
        ->decrement('total');
        $itemdetail->delete();
        // dd($id);
        // $itemdetail->delete();
        // $v = Stok_item::whereItems_id($new);
        // $v->total = ($v->total - 1);
        // $v->save();
        // return response()->json(['success' => 'data berhasil dihapus' ]);


    }
}
