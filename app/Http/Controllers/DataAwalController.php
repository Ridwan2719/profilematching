<?php

namespace App\Http\Controllers;

use App\DataAwal;
use Illuminate\Http\Request;

class DataAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\DataAwal::orderBy('id', 'desc');
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            // ->addColumn('action', function ($q) {
            //Kemudian kita menambahkan kolom baru , yaitu "action"
            // return view('links', [
            //Kemudian dioper ke file links.blade.php
            // 'model'      => $q,
            // 'url_edit'   => route('penilaian.edit', $q->id),
            // 'url_hapus'  => route('bobot.destroy', $q->id),
            // 'url_detail' => route('penilaian.show', $q->id),
            // ]);
            // })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function index()
    {
        //
        return view('hitung.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('hitung.create');
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
        $validatedData = $request->validate([
            'atlet_id' => 'required',
            'periode_id' => 'required',
            'nilai' => 'required',
            'kriteria_id' => 'required',
            'penilaian_id' => 'required',
        ]);
        $dataNilai = \App\Kriteria::find($request->input('kriteria_id'))->first()->nilai * $request->input('nilai');
        // dd($dataNilai);
        $penilaian = new \App\DataAwal();
        $penilaian->atlet_id = $request->input('atlet_id');
        $penilaian->periode_id = $request->input('periode_id');
        $penilaian->kriteria_id = $request->input('kriteria_id');
        $penilaian->penilaian_id = $request->input('penilaian_id');
        $penilaian->nilai = $dataNilai;
        $penilaian->save();
        // $dataTable = \App\DataAwal::with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();

        // return \Yajra\Datatables\Datatables::of($dataTable)
        //     //$query di masukkan kedalam Datatables
        //     // ->addColumn('action', function ($q) {
        //     //Kemudian kita menambahkan kolom baru , yaitu "action"
        //     // return view('links', [
        //     //Kemudian dioper ke file links.blade.php
        //     // 'model'      => $q,
        //     // 'url_edit'   => route('penilaian.edit', $q->id),
        //     // 'url_hapus'  => route('bobot.destroy', $q->id),
        //     // 'url_detail' => route('penilaian.show', $q->id),
        //     // ]);
        //     // })
        //     ->addIndexColumn()
        //     // ->rawColumns(['other-columns'])
        //     ->make(true);
        return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataAwal  $dataAwal
     * @return \Illuminate\Http\Response
     */
    public function show(DataAwal $dataAwal)
    {
        //

    }

    public function dataAwalTable(Request $request, $id)
    {
        $dataTable = \App\DataAwal::with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();
        return \Yajra\Datatables\Datatables::of($dataTable)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                    // 'url_edit'   => route('penilaian.edit', $q->id),
                    'url_hapus'  => route('hitung.destroy', $q->id),
                    // 'url_detail' => route('penilaian.show', $q->id),
                ]);
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataAwal  $dataAwal
     * @return \Illuminate\Http\Response
     */
    public function edit(DataAwal $dataAwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataAwal  $dataAwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataAwal $dataAwal)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataAwal  $dataAwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataAwal $dataAwal)
    {
        //
        $dataAwal->delete();
        return $this->sendResponse($dataAwal->toArray(), 'deleted successfully.');
    }
}
