<?php

namespace App\Http\Controllers;

use App\BobotAwal;
use App\DataAwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $penilaian = new \App\DataAwal();
        $penilaian->atlet_id = $request->input('atlet_id');
        $penilaian->periode_id = $request->input('periode_id');
        $penilaian->kriteria_id = $request->input('kriteria_id');
        $penilaian->penilaian_id = $request->input('penilaian_id');
        $penilaian->nilai = $request->input('nilai');
        $penilaian->save();
        return $this->sendResponse($penilaian->toArray(), 'successfully.');
    }
    public function hitunggap()
    {
         $dataNilai = \App\DataAwal::where("periode_id", 1)->where("penilaian_id", 1)->get()->toArray();
         $hapus = \App\GAP::where("periode_id", 1)->where("penilaian_id", 1)->delete();
        //  $hapus->delete();
        //  return \App\Kriteria::where("id",$dataNilai[1])->first()->nilai;
        foreach ($dataNilai as $a => $b) {
            $gap = new \App\GAP();
            $gap->atlet_id = $b['atlet_id'];
            $gap->periode_id = $b['periode_id'];
            $gap->kriteria_id = $b['kriteria_id'];
            $gap->penilaian_id = $b['penilaian_id'];
            $gap->nilai = $b['nilai'] - \App\Kriteria::find($b['kriteria_id'])->first()->nilai;
            $gap->save();
        }
        return \App\GAP::all();
    }
    public function hitungNormalisasi(){
        $bobotAwal = DB::select("INSERT INTO `normaisasi_bobots`(  `atlet_id`, `periode_id`, `penilaian_id`, `kriteria_id`, `nilai`)SELECT g_a_p_s.atlet_id, g_a_p_s.periode_id, g_a_p_s.penilaian_id, g_a_p_s.kriteria_id, bobot_awals.nilai  FROM `g_a_p_s` JOIN kriterias ON kriterias.penilaian_id = g_a_p_s.kriteria_id JOIN penilaians ON penilaians.id = g_a_p_s.penilaian_id JOIN bobot_awals ON bobot_awals.jenisbobot_id = kriterias.jenisbobot_id WHERE g_a_p_s.periode_id = 1 AND g_a_p_s.penilaian_id = 1 AND g_a_p_s.nilai  BETWEEN bobot_awals.gap_a AND bobot_awals.gap_b  ORDER BY g_a_p_s.atlet_id LIMIT 0,1");

        return $bobotAwal;
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
