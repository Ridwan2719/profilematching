<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    //
    function laporanDetail($periodeID, $penilaianID)
    {
        $dataPenilaian = \App\Penilaian::find($penilaianID);
        $dataPeriode = \App\Periode::find($periodeID);
        $tableDataAwal = \App\DataAwal::where('periode_id', $periodeID)->where('penilaian_id', $penilaianID)->with('periode')->with('atlet')->with('penilaian')->with('kriteria')->get();
        $tableGaps  = \DB::select("SELECT atlets.nama, kriterias.keterangan, data_awals.nilai as nilaiawal, kriterias.nilai AS profilposisi, g_a_p_s.nilai AS nilaihasilgap FROM g_a_p_s JOIN kriterias ON kriterias.id = g_a_p_s.kriteria_id JOIN atlets ON atlets.id = g_a_p_s.atlet_id JOIN data_awals ON data_awals.periode_id = g_a_p_s.periode_id AND data_awals.penilaian_id = g_a_p_s.penilaian_id AND data_awals.atlet_id = g_a_p_s.atlet_id AND data_awals.kriteria_id = g_a_p_s.kriteria_id  WHERE g_a_p_s.penilaian_id=" . $penilaianID . " and g_a_p_s.periode_id=" . $periodeID);
        $tableNormalisasi = \DB::select("SELECT atlets.nama, kriterias.keterangan, g_a_p_s.nilai AS g_a_p_s, normaisasi_bobots.nilai AS normaisasi_bobots FROM normaisasi_bobots JOIN atlets ON atlets.id = normaisasi_bobots.atlet_id JOIN kriterias ON kriterias.id = normaisasi_bobots.kriteria_id JOIN g_a_p_s ON g_a_p_s.atlet_id = normaisasi_bobots.atlet_id AND g_a_p_s.kriteria_id = normaisasi_bobots.kriteria_id AND g_a_p_s.periode_id = normaisasi_bobots.periode_id AND g_a_p_s.penilaian_id = normaisasi_bobots.penilaian_id  WHERE normaisasi_bobots.penilaian_id=" . $penilaianID . " and normaisasi_bobots.periode_id=" . $periodeID);
        $tableCore = \DB::select("SELECT atlets.nama, kriterias.keterangan AS kriterias, normaisasi_bobots.nilai,jenis_kriterias.keterangan, jenis_kriterias.nilai AS presentase FROM `coresecondaries` JOIN atlets ON atlets.id = coresecondaries.atlet_id JOIN normaisasi_bobots ON normaisasi_bobots.periode_id = coresecondaries.periode_id AND normaisasi_bobots.penilaian_id = coresecondaries.penilaian_id AND normaisasi_bobots.atlet_id = coresecondaries.atlet_id JOIN kriterias ON kriterias.id = normaisasi_bobots.kriteria_id JOIN jenis_kriterias ON jenis_kriterias.id = kriterias.jenisbobot_id  WHERE coresecondaries.penilaian_id=" . $penilaianID . " and coresecondaries.periode_id=" . $periodeID . " group by atlets.nama, kriterias.keterangan");
        $table = (new \App\Hasil)->getTable();
        $select = \DB::raw("@i := coalesce(@i + 1, 1) ranking, {$table}.*,{$table}.atlet_id");
        // \DB::enableQueryLog();
        $tableHasil = \App\Hasil::where('penilaian_id', $penilaianID)->where('periode_id', $periodeID)->with('atlet', 'penilaian')->select($select)->orderByDesc('nilai')->get();
        // \App\Coresecondary::where("periode_id", $periodeID)->where("penilaian_id", $penilaianID)->groupBy('atlet_id')
        // ->selectRaw('*,sum(coresecondaries.hasil) as sum')
        // ->get();
        //         dd(\DB::getQueryLog());
        // dd($tableHasil);
        // $tableCore = \DB::select("select @i := coalesce(@i + 1, 1) ranking, hasils.*,hasils.atlet_id from `hasils` where `penilaian_id` = ".$penilaianID." and `periode_id` = ".$periodeID." order by `nilai` desc");
        $pdf = \PDF::loadView('pdf.detailHitung',  compact('tableHasil','tableCore', 'tableNormalisasi', 'tableGaps', 'tableDataAwal', 'periodeID', 'penilaianID', 'dataPenilaian', 'dataPeriode'));
        return $pdf->download(substr(md5(time()),0,6).".pdf");
        return view('pdf.detailHitung', compact('tableHasil','tableCore', 'tableNormalisasi', 'tableGaps', 'tableDataAwal', 'periodeID', 'penilaianID', 'dataPenilaian', 'dataPeriode'));
    }
}
