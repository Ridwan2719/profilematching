<?php

namespace App\Http\Controllers;

use App\Atlet;
use Illuminate\Http\Request;

class AtletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\Atlet::orderBy('id', 'desc');
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                 //   'url_edit'   => route('atlet.edit', $q->id),
                //    'url_hapus'  => route('atlet.destroy', $q->id),
                    'url_detail' => route('atlet.show', $q->id),
                    // 'url_detail' => route('penilaian.show', $q->id),
                ]);
            })

            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }

    public function dataTables2($atlet)
    {
        $query = \App\Hasil::where('atlet_id',$atlet)->join('periodes', 'hasils.periode_id', '=', 'periodes.id')->join('penilaians', 'hasils.penilaian_id', '=', 'penilaians.id')->select("periodes.keterangan as tanggal", "penilaians.keterangan", "hasils.periode_id", "hasils.penilaian_id", "hasils.id",)->orderBy('hasils.id', 'desc')->groupBy('hasils.periode_id')->get();
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                    // 'url_edit'   => route('penilaian.edit', $q->id),
                 //   'url_hapus'  => route('hasil.destroy', $q->id),
                    'url_detail' => route('detailHasil2', ['periode' => $q->periode_id, 'penilaian' => $q->penilaian_id]),
                 //   'url_print' => route('laporanDetailHitung', ['periode' => $q->periode_id, 'penilaian' => $q->penilaian_id]),
                ]);
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function index()
    {
        //
        return view("atlet.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('atlet.create');
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
            'nama' => 'required',
            'kelas' => 'required',
            'umur' => 'required',
        ]);
        $penilaian = new \App\Atlet();
        $penilaian->umur = $request->input('umur');
        $penilaian->kelas = $request->input('kelas');
        $penilaian->nama = $request->input('nama');
        $penilaian->save();
        return  redirect()->route('atlet.index')
            ->with('success', 'Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function show(Atlet $atlet)
    {
        // 
        return view('atlet.detail', compact('atlet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Atlet $atlet)
    {
        //
        return view('atlet.edit',compact('atlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atlet $atlet)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'umur' => 'required',
        ]);
        $penilaian = \App\Atlet::find($atlet->id);
        $penilaian->umur = $request->input('umur');
        $penilaian->kelas = $request->input('kelas');
        $penilaian->nama = $request->input('nama');
        $penilaian->save();
        return  redirect()->route('atlet.index')
            ->with('success', 'Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atlet  $atlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $metaLink = Atlet::find($id);
        $metaLink->delete();
        return $this->sendResponse($metaLink->toArray(), 'deleted successfully.');
    }
}
