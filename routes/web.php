<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
Route::get('hitung12', 'DataAwalController@hitunggap')->name('hitung');
Route::get('hitung123', 'DataAwalController@hitungNormalisasi')->name('hitung');

Route::group(['middleware' => 'auth'], function () {
    // Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    //     \UniSharp\LaravelFilemanager\Lfm::routes();
    // });
    Route::prefix('/home')->group(function () {


        Route::resource('penilaian', 'PenilaianController');
        Route::get('datatablepenilaian', 'PenilaianController@dataTables')->name('datatablepenilaian');

        Route::resource('jenisbobot', 'JenisbobotController');
        Route::get('tableJenisbobot', 'JenisbobotController@dataTables')->name('tableJenisbobot');

        Route::resource('bobot', 'BobotAwalController');
        Route::get('tableBobot', 'BobotAwalController@dataTables')->name('tableBobot');

        Route::resource('jeniskriteria', 'JenisKriteriaController');
        Route::get('tablejeniskriteria', 'JenisKriteriaController@dataTables')->name('tablejeniskriteria');

        Route::resource('kriteria', 'KriteriaController');
        Route::get('tableKriteria', 'KriteriaController@dataTables')->name('tableKriteria');
        Route::POST('get/data/kriteria', 'KriteriaController@dataDropdown')->name('dataDropdown');

        Route::resource('periode', 'PeriodeController');
        Route::get('tablePeriode', 'PeriodeController@dataTables')->name('tablePeriode');

        Route::resource('kelasatlet', 'KelasatletController');
        Route::get('tablekelasatlet', 'KelasatletController@dataTables')->name('tablekelasatlet');

        Route::resource('atlet', 'AtletController');
        Route::get('tableAtlet', 'AtletController@dataTables')->name('tableAtlet');
        Route::get('tableDetail/{atlet}', 'AtletController@dataTables2')->name('detailAtlet');

        Route::resource('hasil', 'HasilController');
        Route::get('tableHasil', 'HasilController@dataTables')->name('tableHasil');
        // Route::get('hasiledelete/{}', 'HasilController@destory')->name('hasiledelete');
        Route::get('tableHasildetail/{periode}/{penilaian}', 'HasilController@dataTables2')->name('tableHasildetail');
        Route::get('tableDataawal/{periode}/{penilaian}', 'HasilController@dataTables3')->name('tableDataawal');
        Route::get('tableGaps/{periode}/{penilaian}', 'HasilController@dataTables4')->name('tableGaps');
        Route::get('tableNormalisasi/{periode}/{penilaian}', 'HasilController@dataTables5')->name('tableNormalisasi');
        Route::get('tableCoresecondary/{periode}/{penilaian}', 'HasilController@dataTables6')->name('tableCoresecondary');
        Route::get('detailHasil/{periode}/{penilaian}', 'DataAwalController@hitunggap')->name('detailHasil');
        Route::get('laporan/detail/{penilaian}/{periode}', 'DataAwalController@detailHitung')->name('detailHasil2');
        Route::get('pdf/laporan/hitung-detail/{periode}/{penilaian}', 'PdfController@laporanDetail')->name('laporanDetailHitung');
       
        Route::resource('hitung', 'DataAwalController');
        Route::get('tableHitung', 'DataAwalController@dataTables')->name('tableHitung');
        Route::get('deletedatawal/{id}', 'DataAwalController@destroy')->name('deletedatawal');
        Route::get('dataTableInsert/{periode}/{penilaian}', 'DataAwalController@dataAwalTable')->name('dataTableInsert');
    });
});
