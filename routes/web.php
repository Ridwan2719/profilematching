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

        Route::resource('periode', 'PeriodeController');
        Route::get('tablePeriode', 'PeriodeController@dataTables')->name('tablePeriode');
    });
});
