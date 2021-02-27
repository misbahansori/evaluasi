<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Periode;
use App\Domain\Penilaian\Actions\CreatePeriodeAction;

class PeriodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:tambah periode')->only('create');
        $this->middleware('permission:hapus periode')->only('destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pegawai $pegawai, CreatePeriodeAction $createPeriodeAction)
    {         
        $createPeriodeAction->execute($pegawai);

        return redirect()
            ->route('pegawai.show', $pegawai->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai, Periode $periode)
    { 
        abort_if($periode->pegawai_id != $pegawai->id, 404);
        
        $this->authorize('view', $pegawai);

        if (auth()->user()->hasPermissionTo('penilaian biasa dan aik')) {
            $penilaian = $periode->nilai;
        } else if (auth()->user()->hasPermissionTo('penilaian aik')) {
            $penilaian = $periode->nilaiAik->groupBy('kategori')->sortKeys();
        } else {
            $penilaian = $periode->nilaiKompetensi->groupBy('kategori')->sortKeys();
        }
        
        return view('admin.periode.show', compact('pegawai', 'periode', 'penilaian'));
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

        $periode->nilai()->delete();
        $periode->delete();

        return redirect()
            ->route('pegawai.show', $pegawai->id)
            ->with('success', 'Periode ' . $periode->namaBulan . ' ' . $periode->tahun . ' berhasil dihapus');
    }
}
