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
    });
});
