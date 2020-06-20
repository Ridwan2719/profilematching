<?php

namespace App\Http\Controllers;

use App\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\Kriteria::with('JenisKriteria')->with('Penilaian')->orderBy('id', 'desc');
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
        return view('kriteria.index');
    }
    public function dataDropdown(Request $request)
    {
        $data = \App\Kriteria::where("penilaian_id",$request->id)->get();
        $data2 = "";
        foreach($data as $a=>$b){
            $data2 .= "<option value='".$b['id']."'>".$b["keterangan"]."</option>";
        }
        return $this->sendResponse($data2, 'successfully.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kriteria.create');
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
            'keterangan' => 'required',
        ]);
        $penilaian = new \App\Kriteria;
        $penilaian->penilaian_id = $request->input('penilaian_id');
        $penilaian->jenisbobot_id = $request->input('jenisbobot_id');
        $penilaian->keterangan = $request->input('keterangan');
        $penilaian->nilai = $request->input('nilai');
        $penilaian->save();
        return  redirect()->route('kriteria.index')
            ->with('success', 'Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {
        //
    }
}
