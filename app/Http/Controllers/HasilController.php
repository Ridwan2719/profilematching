<?php

namespace App\Http\Controllers;

use App\Hasil;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\Hasil::join('periodes', 'hasils.periode_id', '=', 'periodes.id')->join('penilaians', 'hasils.penilaian_id', '=', 'penilaians.id')->select("periodes.keterangan as tanggal", "penilaians.keterangan", "hasils.periode_id", "hasils.penilaian_id", "hasils.id",)->orderBy('hasils.id', 'desc')->groupBy('hasils.periode_id')->get();
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                    // 'url_edit'   => route('penilaian.edit', $q->id),
                    'url_hapus'  => route('hasil.destroy', $q->id),
                    'url_detail' => route('detailHasil2', ['periode' => $q->periode_id, 'penilaian' => $q->penilaian_id]),
                ]);
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function dataTables2($penilaian, $periode)
    {
        $table = (new \App\Hasil)->getTable();
        $select = \DB::raw("@i := coalesce(@i + 1, 1) ranking, {$table}.*");
        $query = \App\Hasil::where('penilaian_id',$penilaian)->where('periode_id',$periode)->with('atlet','penilaian')->select($select)->orderByDesc('nilai')->get();
        // return $users;
        // $query = \App\Hasil::withRowNumber()->get();//where('hasils.periode_id',$periode)->where('hasils.penilaian_id',$penilaian)->join('periodes','periodes.id','=','hasils.periode_id')->join('atlets','atlets.id','=','hasils.atlet_id')->orderBy('hasils.nilai','desc')->select( \DB::raw("hasils.atlet_id, atlets.nama, periodes.keterangan, hasils.nilai,  1+(SELECT count(*) from hasils a WHERE a.nilai > b.nilai) as RNK"))->get();
        // return $query;
        // $query = \DB::select("SELECT hasils.atlet_id, atlets.nama, periodes.keterangan, hasils.nilai, RANK() OVER(ORDER BY hasils.nilai DESC) AS 'Ranking' FROM `hasils` JOIN periodes ON periodes.id = hasils.periode_id JOIN atlets ON atlets.id = hasils.atlet_id  WHERE hasils.penilaian_id=" . $penilaian . " and hasils.periode_id=" . $periode);
       
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            // ->addColumn('action', function ($q) {
            //     //Kemudian kita menambahkan kolom baru , yaitu "action"
            //     return view('links', [
            //         //Kemudian dioper ke file links.blade.php
            //         'model'      => $q,
            //         // 'url_edit'   => route('penilaian.edit', $q->id),
            //         // 'url_hapus'  => route('bobot.destroy', $q->id),
            //         'url_detail' => route('detailHasil', ['periode' => $q->periode_id, 'penilaian' => $q->penilaian_id]),
            //     ]);
            // })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function index()
    {
        //
        return view('hasil.index');
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
     * @param  \App\Hasil  $hasil
     * @return \Illuminate\Http\Response
     */
    public function show(Hasil $hasil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hasil  $hasil
     * @return \Illuminate\Http\Response
     */
    public function edit(Hasil $hasil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hasil  $hasil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hasil $hasil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hasil  $hasil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $metaLink = \App\Hasil::find($id);
        $metaLink->delete();
        return $this->sendResponse($metaLink->toArray(), 'deleted successfully.');
    }
    public function datahasil(Request $request)
    { }
}
