<?php

namespace App\Http\Controllers;

use App\BobotAwal;
use Illuminate\Http\Request;

class BobotAwalController extends Controller
{
    public function dataTables()
    {
        $query = \App\BobotAwal::with('jenisbobot')->orderBy('id', 'desc');
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("bobot.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("bobot.create");
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
            'gap_a' => 'required',
            'gap_b' => 'required',
            'nilai' => 'required',
        ]);
        $penilaian = new \App\BobotAwal;
        $penilaian->keterangan = $request->input('keterangan');
        $penilaian->gap_a = $request->input('gap_a');
        $penilaian->gap_b = $request->input('gap_b');
        $penilaian->nilai = $request->input('nilai');
        $penilaian->jenisbobot_id = $request->input('jenis_bobot_id');
        $penilaian->save();
        return  redirect()->route('bobot.index')
            ->with('success', 'Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BobotAwal  $bobotAwal
     * @return \Illuminate\Http\Response
     */
    public function show(BobotAwal $bobotAwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BobotAwal  $bobotAwal
     * @return \Illuminate\Http\Response
     */
    public function edit(BobotAwal $bobotAwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BobotAwal  $bobotAwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BobotAwal $bobotAwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BobotAwal  $bobotAwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BobotAwal $bobotAwal)
    {
        //
        $bobotAwal->delete();
        return $this->sendResponse($bobotAwal->toArray(), 'penilaian deleted successfully.');
    }
}
