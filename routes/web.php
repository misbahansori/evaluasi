<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::get('/pegawai', 'PegawaiController@index')->name('pegawai.index');
    Route::get('/pegawai/{pegawai}', 'PegawaiController@show')->name('pegawai.show');
    Route::get('/pegawai/{pegawai}/periode', 'PeriodeController@index')->name('periode.index');
    Route::get('/pegawai/{pegawai}/periode/create', 'PeriodeController@create')->name('periode.create');
    Route::post('/pegawai/{pegawai}/periode', 'PeriodeController@store')->name('periode.store');
    Route::get('/pegawai/{pegawai}/periode/{periode}', 'PeriodeController@show')->name('periode.show');
    Route::delete('/pegawai/{pegawai}/periode/{periode}', 'PeriodeController@destroy')->name('periode.destroy');
    Route::put('/nilai', 'NilaiController@update')->name('nilai.update');
    Route::get('/master/aspek', 'AspekController@index')->name('aspek.index');
    Route::get('/master/aspek/create', 'AspekController@create')->name('aspek.create');
    Route::post('/master/aspek', 'AspekController@store')->name('aspek.store');
    Route::get('/master/aspek/{aspek}', 'AspekController@edit')->name('aspek.edit');
    Route::put('/master/aspek/{aspek}', 'AspekController@update')->name('aspek.update');
    Route::delete('/master/aspek/{aspek}', 'AspekController@destroy')->name('aspek.destroy');
});
