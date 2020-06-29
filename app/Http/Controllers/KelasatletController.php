<?php

namespace App\Http\Controllers;

use App\Kelasatlet;
use Illuminate\Http\Request;

class KelasatletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTables()
    {
        $query = \App\Kelasatlet::join('atlets','atlets.id','=','kelasatlets.atlet_id')->join('penilaians','penilaians.id','=','kelasatlets.penilaian_id')->orderBy('kelasatlets.id', 'desc')->select('kelasatlets.*','penilaians.keterangan','atlets.nama')->get();
        // dd($query);
        //$query mempunyai isi semua data di table users, dan diurutkan dari data yang terbaru
        return \Yajra\Datatables\Datatables::of($query)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                     'url_edit'   => route('kelasatlet.edit', $q->id),
                   'url_hapus'  => route('kelasatlet.destroy', $q->id),
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
        return view('kelasatlet.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kelasatlet.create');
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
            'penilaian_id' => 'required',
        ]);
        $penilaian = new \App\Kelasatlet;
        $penilaian->atlet_id = $request->input('atlet_id');
        $penilaian->penilaian_id = $request->input('penilaian_id');
        $penilaian->save();
        return  redirect()->route('kelasatlet.index')
            ->with('success', 'Berhasil Di Simpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelasatlet  $kelasatlet
     * @return \Illuminate\Http\Response
     */
    public function show(Kelasatlet $kelasatlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelasatlet  $kelasatlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelasatlet $kelasatlet)
    {
        //

        return view("kelasatlet.edit", compact('kelasatlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelasatlet  $kelasatlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelasatlet $kelasatlet)
    {
        //
        $validatedData = $request->validate([
            'atlet_id' => 'required',
            'penilaian_id' => 'required',
        ]);
        $penilaian = \App\Kelasatlet::find($kelasatlet->id);
        $penilaian->atlet_id = $request->input('atlet_id');
        $penilaian->penilaian_id = $request->input('penilaian_id');
        $penilaian->save();
        return  redirect()->route('kelasatlet.index')
            ->with('success', 'Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelasatlet  $kelasatlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelasatlet $kelasatlet)
    {
        //
        // \App\Kelasatlet::where("id", $id)->delete();

        $kelasatlet->delete();
        return $this->sendResponse($kelasatlet->toArray(), 'deleted successfully.');
    }
}
