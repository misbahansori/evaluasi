<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Pegawai;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Http\Requests\PeriodeRequest;

class PeriodeController extends Controller
{
    /**
    * Construct method
    */
    public function __construct()
    {
        $this->middleware('permission:tambah periode')->only('create');
        $this->middleware('permission:hapus periode')->only('destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PeriodeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pegawai $pegawai, PeriodeRequest $request)
    {           
        $bulan = $request->cekPegawaiMempunyaiBagian()
                         ->cekPeriodeUnique();

        $request->persist();

        return redirect()
            ->route('pegawai.show', $pegawai->id)
            ->with('success', "Periode $bulan->nama $request->tahun berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai, Periode $periode)
    {
        $this->authorize('view', $pegawai);
        
        return view('admin.periode.show', compact('pegawai', 'periode'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai, Periode $periode)
    {
        $this->authorize('view', $pegawai);

        $periode->aspek()->detach();
        $periode->delete();

        return redirect()
            ->route('pegawai.show', $pegawai->id)
            ->with('success', 'Periode ' . $periode->bulan->nama . ' ' . $periode->tahun . ' berhasil dihapus');
    }
}
