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

Route::redirect('/','login');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/penilaian', 'PenilaianController@index')->name('penilaian.index');

    Route::resource('/pegawai', 'PegawaiController');

    Route::post('/pegawai/{pegawai}/periode', 'PeriodeController@store')->name('periode.store');
    Route::get('/pegawai/{pegawai}/periode/{periode}', 'PeriodeController@show')->name('periode.show');
    Route::delete('/pegawai/{pegawai}/periode/{periode}', 'PeriodeController@destroy')->name('periode.destroy');

    Route::get('/input-penilaian', 'InputPenilaianController@index')->name('input.penilaian.index');
    Route::post('/input-penilaian', 'InputPenilaianController@store')->name('input.penilaian.store');

    Route::put('/nilai/{periode}', 'NilaiController@update')->name('nilai.update');

    Route::get('/master/aspek', 'AspekController@index')->name('aspek.index');
    Route::get('/master/aspek/create', 'AspekController@create')->name('aspek.create');
    Route::post('/master/aspek', 'AspekController@store')->name('aspek.store');
    Route::get('/master/aspek/{aspek}', 'AspekController@edit')->name('aspek.edit');
    Route::put('/master/aspek/{aspek}', 'AspekController@update')->name('aspek.update');
    Route::delete('/master/aspek/{aspek}', 'AspekController@destroy')->name('aspek.destroy');

    Route::get('/master/user', 'UsersController@index')->name('user.index');
    Route::get('/master/user/create', 'UsersController@create')->name('user.create');
    Route::get('/master/user/{user}', 'UsersController@show')->name('user.show');
    Route::get('/master/user/{user}/edit', 'UsersController@edit')->name('user.edit');
    Route::put('/master/user/{user}', 'UsersController@update')->name('user.update');
    Route::post('/master/user', 'UsersController@store')->name('user.store');

    Route::get('/master/group', 'RoleController@index')->name('role.index');
    Route::post('/master/group', 'RoleController@store')->name('role.store');
    Route::get('/master/group/create', 'RoleController@create')->name('role.create');
    Route::get('/master/group/{role}', 'RoleController@show')->name('role.show');
    Route::get('/master/group/{role}/edit', 'RoleController@edit')->name('role.edit');
    Route::put('/master/group/{role}', 'RoleController@update')->name('role.update');

    Route::post('/master/role/{role}/permission', 'RolePermissionsController@store')->name('role.permission.store');
    Route::delete('/master/role/{role}/permission/{permission}', 'RolePermissionsController@destroy')->name('role.permission.destroy');

    Route::post('/master/user/{user}/role', 'UserRolesController@store')->name('user.role.store');
    Route::delete('/master/user/{user}/role/{role}', 'UserRolesController@destroy')->name('user.role.destroy');

    Route::post('/master/user/{user}/permission', 'UserPermissionController@store')->name('user.permission.store');
    Route::delete('/master/user/{user}/permission/{permission}', 'UserPermissionController@destroy')->name('user.permission.destroy');
    
    Route::post('/verif/kabag/{periode}', 'VerifikasiController@kabag')->name('verif.kabag');
    Route::post('/verif/wadir/{periode}', 'VerifikasiController@wadir')->name('verif.wadir');

    Route::post('/report/{tipe}', 'ReportController')->name('report');

    Route::get('/login-as', 'LoginAsController@index')->name('login-as.index');
    Route::post('/login-as', 'LoginAsController@store')->name('login-as.store');
});
