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
        $query = \App\Hasil::join('periodes', 'hasils.periode_id', '=', 'periodes.id')->join('penilaians', 'hasils.penilaian_id', '=', 'penilaians.id')->select("periodes.keterangan as tanggal", "penilaians.keterangan", "hasils.periode_id", "hasils.penilaian_id", "hasils.id",)->orderBy('hasils.id', 'desc')->groupBy('hasils.periode_id', 'hasils.penilaian_id')->get();
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
                    'url_print' => route('laporanDetailHitung', ['periode' => $q->periode_id, 'penilaian' => $q->penilaian_id]),
                ]);
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function dataTables2($penilaian, $periode)
    {
        $table = (new \App\Hasil)->getTable();
        $secondary = (new \App\Coresecondary())->getTable();
        // $select = \DB::raw("@i := coalesce(@i + 1, 1) ranking, {$table}.*");
        $select = \DB::raw("@i := coalesce(@i + 1, 1) ranking, {$table}.*, (select sum(hasil) as core  from {$secondary} where {$secondary}.jenisbobot_id=2 and {$secondary}.penilaian_id={$table}.penilaian_id and {$secondary}.periode_id={$table}.periode_id and {$secondary}.atlet_id={$table}.atlet_id  ) as SecondCore,(select sum(hasil) as core  from {$secondary} where {$secondary}.jenisbobot_id=1 and {$secondary}.penilaian_id={$table}.penilaian_id and {$secondary}.periode_id={$table}.periode_id and {$secondary}.atlet_id={$table}.atlet_id  ) as Core");

        $query = \App\Hasil::where('penilaian_id', $penilaian)->where('periode_id', $periode)->with('atlet', 'penilaian')->select($select)->orderByDesc('nilai')->get();
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

    public function dataTables3($penilaian, $periode)
    {


        $query = \App\DataAwal::where('periode_id', $periode)->where('penilaian_id', $penilaian)->with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();
        //return $users;
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

    public function dataTables4($penilaian, $periode)
    {


        //$query = \App\GAP::where('periode_id', $periode)->where('penilaian_id', $penilaian)->with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();
        //return $users;
        // $query = \App\Hasil::withRowNumber()->get();//where('hasils.periode_id',$periode)->where('hasils.penilaian_id',$penilaian)->join('periodes','periodes.id','=','hasils.periode_id')->join('atlets','atlets.id','=','hasils.atlet_id')->orderBy('hasils.nilai','desc')->select( \DB::raw("hasils.atlet_id, atlets.nama, periodes.keterangan, hasils.nilai,  1+(SELECT count(*) from hasils a WHERE a.nilai > b.nilai) as RNK"))->get();
        // return $query;
        $query = \DB::select("SELECT atlets.nama, kriterias.keterangan, data_awals.nilai as nilaiawal, kriterias.nilai AS profilposisi, g_a_p_s.nilai AS nilaihasilgap FROM g_a_p_s JOIN kriterias ON kriterias.id = g_a_p_s.kriteria_id JOIN atlets ON atlets.id = g_a_p_s.atlet_id JOIN data_awals ON data_awals.periode_id = g_a_p_s.periode_id AND data_awals.penilaian_id = g_a_p_s.penilaian_id AND data_awals.atlet_id = g_a_p_s.atlet_id AND data_awals.kriteria_id = g_a_p_s.kriteria_id  WHERE g_a_p_s.penilaian_id=" . $penilaian . " and g_a_p_s.periode_id=" . $periode);

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

    public function dataTables5($penilaian, $periode)
    {


        //$query = \App\GAP::where('periode_id', $periode)->where('penilaian_id', $penilaian)->with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();
        //return $users;
        // $query = \App\Hasil::withRowNumber()->get();//where('hasils.periode_id',$periode)->where('hasils.penilaian_id',$penilaian)->join('periodes','periodes.id','=','hasils.periode_id')->join('atlets','atlets.id','=','hasils.atlet_id')->orderBy('hasils.nilai','desc')->select( \DB::raw("hasils.atlet_id, atlets.nama, periodes.keterangan, hasils.nilai,  1+(SELECT count(*) from hasils a WHERE a.nilai > b.nilai) as RNK"))->get();
        // return $query;
        $query = \DB::select("SELECT atlets.nama, kriterias.keterangan, g_a_p_s.nilai AS g_a_p_s, normaisasi_bobots.nilai AS normaisasi_bobots FROM normaisasi_bobots JOIN atlets ON atlets.id = normaisasi_bobots.atlet_id JOIN kriterias ON kriterias.id = normaisasi_bobots.kriteria_id JOIN g_a_p_s ON g_a_p_s.atlet_id = normaisasi_bobots.atlet_id AND g_a_p_s.kriteria_id = normaisasi_bobots.kriteria_id AND g_a_p_s.periode_id = normaisasi_bobots.periode_id AND g_a_p_s.penilaian_id = normaisasi_bobots.penilaian_id  WHERE normaisasi_bobots.penilaian_id=" . $penilaian . " and normaisasi_bobots.periode_id=" . $periode);

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

    public function dataTables6($penilaian, $periode)
    {


        //$query = \App\GAP::where('periode_id', $periode)->where('penilaian_id', $penilaian)->with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();
        //return $users;
        // $query = \App\Hasil::withRowNumber()->get();//where('hasils.periode_id',$periode)->where('hasils.penilaian_id',$penilaian)->join('periodes','periodes.id','=','hasils.periode_id')->join('atlets','atlets.id','=','hasils.atlet_id')->orderBy('hasils.nilai','desc')->select( \DB::raw("hasils.atlet_id, atlets.nama, periodes.keterangan, hasils.nilai,  1+(SELECT count(*) from hasils a WHERE a.nilai > b.nilai) as RNK"))->get();
        // return $query;
        $query = \DB::select("SELECT atlets.nama, kriterias.keterangan AS kriterias, normaisasi_bobots.nilai, jenis_kriterias.keterangan as keterangan, jenis_kriterias.nilai as presentase FROM `normaisasi_bobots` JOIN  atlets ON atlets.id = normaisasi_bobots.atlet_id JOIN kriterias ON kriterias.id = normaisasi_bobots.kriteria_id JOIN jenis_kriterias ON jenis_kriterias.id = normaisasi_bobots.bobot_id  WHERE normaisasi_bobots.penilaian_id=" . $penilaian . " and normaisasi_bobots.periode_id=" . $periode );
        // $query = \DB::select("SELECT * FROM `coresecondaries`  WHERE coresecondaries.penilaian_id=" . $penilaian . " and coresecondaries.periode_id=" . $periode);

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
