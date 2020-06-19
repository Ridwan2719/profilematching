<?php

namespace App\Http\Controllers;

use App\Jenisbobot;
use Illuminate\Http\Request;

class JenisbobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\Jenisbobot::orderBy('id', 'desc');
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
        return view('jenisbobot.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jenisbobot.create');
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
        $penilaian = new \App\Jenisbobot();
        $penilaian->keterangan = $request->input('keterangan');
       
        $penilaian->save();
        return  redirect()->route('jenisbobot.index')
            ->with('success', 'Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenisbobot  $jenisbobot
     * @return \Illuminate\Http\Response
     */
    public function show(Jenisbobot $jenisbobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jenisbobot  $jenisbobot
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenisbobot $jenisbobot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jenisbobot  $jenisbobot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenisbobot $jenisbobot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenisbobot  $jenisbobot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenisbobot $jenisbobot)
    {
        //
    }
}
