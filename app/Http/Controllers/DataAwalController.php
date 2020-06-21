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
    public function hitunggap(Request $request, $penilaian, $periode)
    {

        $penilaianID = (int)$penilaian;
        $periodeID = (int)$periode;

        $dataNilai = \App\DataAwal::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->get();
        // dd($dataNilai);
        \App\GAP::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->delete();
        \App\NormaisasiBobot::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->delete();
        \App\Coresecondary::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->delete();
        \App\Hasil::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->delete();
        //  $hapus->delete();
        //  return \App\Kriteria::where("id",$dataNilai[1])->first()->nilai;
        foreach ($dataNilai as $a => $b) {
            $gap = new \App\GAP();
            $gap->atlet_id = $b['atlet_id'];
            $gap->periode_id = $b['periode_id'];
            $gap->kriteria_id = $b['kriteria_id'];
            $gap->penilaian_id = $b['penilaian_id'];
            $gap->nilai = $b['nilai'] - \App\Kriteria::where('id', $b['kriteria_id'])->first()->nilai;
            $gap->save();
        }
       // DB::select("INSERT INTO `g_a_p_s`(`atlet_id`, `kriteria_id`, `nilai`, `periode_id`, `penilaian_id`) SELECT data_awals.atlet_id, data_awals.kriteria_id,  data_awals.nilai - kriterias.nilai AS Hasil, data_awals.periode_id, data_awals.penilaian_id FROM `data_awals` JOIN kriterias ON kriterias.id = data_awals.kriteria_id WHERE data_awals.periode_id =" . $periodeID . " AND data_awals.penilaian_id =" . $penilaianID);
        DB::select("INSERT INTO `normaisasi_bobots`(`penilaian_id`, `atlet_id`, `periode_id`, `kriteria_id`, `nilai`,`bobot_id`) SELECT g_a_p_s.penilaian_id, g_a_p_s.atlet_id, g_a_p_s.periode_id, g_a_p_s.kriteria_id, bobot_awals.nilai, kriterias.jenisbobot_id FROM `g_a_p_s` JOIN penilaians ON penilaians.id = g_a_p_s.penilaian_id JOIN jenisbobots ON jenisbobots.id = penilaians.bobot JOIN bobot_awals ON bobot_awals.jenisbobot_id = jenisbobots.id JOIN kriterias on kriterias.id = g_a_p_s.kriteria_id  WHERE g_a_p_s.penilaian_id=" . $penilaianID . " and g_a_p_s.periode_id=" . $periodeID . " and g_a_p_s.nilai BETWEEN bobot_awals.gap_b AND bobot_awals.gap_b");
        //DB::select("INSERT INTO `coresecondaries`( `penilaian_id`, `periode_id`, `atlet_id`, `core`, `second`)SELECT normaisasi_bobots.penilaian_id, normaisasi_bobots.periode_id, normaisasi_bobots.atlet_id, SUM(IF(kriterias.jenisbobot_id = 1, normaisasi_bobots.nilai, 0)) AS Core, SUM(IF(kriterias.jenisbobot_id = 2, normaisasi_bobots.nilai, 0)) AS Secondary FROM `normaisasi_bobots` JOIN kriterias ON kriterias.id = normaisasi_bobots.kriteria_id JOIN jenis_kriterias ON jenis_kriterias.id = kriterias.jenisbobot_id WHERE normaisasi_bobots.penilaian_id=" . $penilaianID . " and normaisasi_bobots.periode_id=" . $periodeID);
        //DB::select("INSERT INTO `hasils`(`atlet_id`, `penilaian_id`, `nilai`, `periode_id`)SELECT coresecondaries.atlet_id, coresecondaries.penilaian_id,((coresecondaries.core*60/100)/2) + ((coresecondaries.second*40/100)/2) AS Hasil, coresecondaries.periode_id Hasil FROM `coresecondaries` WHERE coresecondaries.periode_id = " . $penilaianID . " AND coresecondaries.penilaian_id = " . $penilaianID);
        $data = \App\NormaisasiBobot::where("normaisasi_bobots.periode_id", $periodeID)->where("normaisasi_bobots.penilaian_id", $penilaianID)
            ->join('kriterias', "kriterias.id", "=", 'kriteria_id')->join('jenis_kriterias', "kriterias.jenisbobot_id", "=", 'jenis_kriterias.id')->groupBy('bobot_id', 'atlet_id')
            ->selectRaw('*, count(normaisasi_bobots.bobot_id) as count,sum(normaisasi_bobots.nilai) as sum,((sum(normaisasi_bobots.nilai)*jenis_kriterias.nilai/100)/count(normaisasi_bobots.bobot_id)) AS Hasil')
            ->get();
        foreach ($data as $a => $b) {
            $core = new \App\Coresecondary();
            $core->penilaian_id = $b['penilaian_id'];
            $core->periode_id = $b['periode_id'];
            $core->atlet_id = $b['atlet_id'];
            $core->jenisbobot_id = $b['jenisbobot_id'];
            $core->hasil = $b['Hasil'];
            $core->save();
        }
        $data = \App\Coresecondary::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->groupBy('atlet_id')
            ->selectRaw('*,sum(coresecondaries.hasil) as sum')
            ->get();
        foreach ($data as $a => $b) {
            $hasil = new \App\Hasil();
            $hasil->penilaian_id = $b['penilaian_id'];
            $hasil->periode_id = $b['periode_id'];
            $hasil->atlet_id = $b['atlet_id'];
            $hasil->nilai = $b['sum'];
            $hasil->save();
        }
        // $collection = DB::select('SELECT *,
        // -- IF (@score=s.nilai, @rank:=@rank, @rank:=@rank+1) rank,
        // -- @score:=s.nilai score
        // -- FROM hasils s,
        // -- (SELECT @score:=0, @rank:=0) r
        // -- -- ORDER BY nilai DESC');
        // $data       = $collection->all();
        // $detail = \DB::select("SELECT hasils.periode_id,hasils.penilaian_id, penilaians.keterangan as penilaian, periodes.keterangan as periode FROM `hasils` JOIN periodes ON periodes.id = hasils.periode_id JOIN penilaians ON penilaians.id = hasils.penilaian_id  WHERE hasils.penilaian_id=" . $penilaianID . " and hasils.periode_id=" . $periodeID." LIMIT 0,1");
        // dd($detail);
        // return $collection;
        //    return $collection;
        $detail = \App\Hasil::join('penilaians', 'penilaians.id', "=", 'hasils.penilaian_id')->join('periodes', 'periodes.id', "=", 'hasils.periode_id')->where('hasils.penilaian_id', $penilaianID)->where('hasils.periode_id', $periodeID)->groupBy('hasils.periode_id')->select('penilaians.keterangan as penilaian', 'hasils.*', 'periodes.keterangan as tanggal')->first();
        // dd($detail);
        return view('hasil.detail',compact("periodeID","penilaianID"));
    }
    public function hitungNormalisasi()
    {
        $bobotAwal = "";
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

    public function dataAwalTable($periode, $penilaian)
    {
        $dataTable = \App\DataAwal::where('periode_id', $periode)->where('penilaian_id', $penilaian)->with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();

        return \Yajra\Datatables\Datatables::of($dataTable)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {

                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model'      => $q,
                    // 'url_edit'   => route('penilaian.edit', $q->id),
                    'url_hapus'  => route('deletedatawal', $q->id),
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
    public function destroy(DataAwal $dataAwal, $id)
    {
        //
        \App\DataAwal::where("id", $id)->delete();

        $dataAwal->delete();
        return $this->sendResponse($dataAwal->toArray(), 'deleted successfully.');
    }
}
