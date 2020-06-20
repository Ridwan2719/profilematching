<?php

namespace App\Http\Controllers;

use App\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\Penilaian::with('Jenisbobot')->orderBy('id', 'desc');
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                    // 'url_edit'   => route('penilaian.edit', $q->id),
                    'url_hapus'  => route('penilaian.destroy', $q->id),
                    // 'url_detail' => route('penilaian.show', $q->id),
                ]);
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function index()
    {
        //
        return view('penilaian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('penilaian.create');
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
        $penilaian = new \App\Penilaian;
        $penilaian->keterangan = $request->input('keterangan');
        $penilaian->bobot = $request->input('bobot');
        $penilaian->save();
        return  redirect()->route('penilaian.index')
            ->with('success', 'Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        //
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        //
        $validatedData = $request->validate([
            'keterangan' => 'required',
        ]);
        $penilaian = \App\Penilaian::find($penilaian->id);
        $penilaian->keterangan = $request->input('keterangan');
        $penilaian->bobot = $request->input('bobot');
        $penilaian->save();
        return  redirect()->route('penilaian.index')
            ->with('success', 'Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
        $penilaian->delete();
        return $this->sendResponse($penilaian->toArray(), 'penilaian deleted successfully.');
    }
}
