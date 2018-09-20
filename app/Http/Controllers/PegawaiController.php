<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Bulan;
use App\Models\Bagian;
use App\Models\Formasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Requests\PegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPegawai = Pegawai::query()
            ->milikUser()
            ->with('bagian', 'unit')
            ->get();

        return view('admin.pegawai.index', compact('listPegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listUnit    = Unit::orderBy('nama')->get();
        $listFormasi = Formasi::orderBy('nama')->get();
        $listBagian  = Bagian::orderBy('nama')->get();
        
        return view('admin.pegawai.create', compact('listUnit', 'listFormasi', 'listBagian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $pegawai = $request->save();

        return redirect()
            ->route('pegawai.index')
            ->with('success', "Pegawai $pegawai->nama berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $listUnit    = Unit::orderBy('nama')->get();
        $listFormasi = Formasi::orderBy('nama')->get();
        $listBagian  = Bagian::orderBy('nama')->get();
        $listBulan   = Bulan::all();
        $tahunIni    = date('Y');
        
        return view('admin.pegawai.show', compact(
            'pegawai', 'listBulan', 'tahunIni', 'listUnit', 'listFormasi', 'listBagian'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        $request->update($pegawai);

        return back()
            ->with('success', "Pegawai $pegawai->nama berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
