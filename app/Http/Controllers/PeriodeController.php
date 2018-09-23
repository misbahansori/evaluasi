<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Pegawai;
use App\Models\Periode;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pegawai $pegawai, Request $request)
    {
        $this->validate($request, [
            'bulan' => 'required|integer',
            'tahun' => 'required|integer|digits:4'
        ]);

        if (!$pegawai->bagian) {
            return back()
                ->with('danger', 'Pegawai tidak memiliki bagian');
        }

        $bulan = Bulan::find($request->bulan);

        if (Periode::unique($pegawai->id, $bulan->id, $request->tahun)->exists()) {
            return back()
                ->with('danger', "Periode $bulan->nama $request->tahun sudah ada.");
        }

        $periode = $pegawai->periode()->create([
            'bulan_id' => $request->bulan,
            'tahun' => $request->tahun
        ]);

        $pegawai->bagian->aspek->each(function ($item) use ($periode) {
            $periode->nilai()->create(['aspek' => $item->nama, 'kategori' => $item->kategori]);
        });

        return redirect()
            ->route('pegawai.show', $pegawai->id)
            ->with('success', "Periode $bulan->nama $periode->tahun berhasil ditambahkan");
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
        $periode->aspek()->detach();
        $periode->delete();

        return redirect()
            ->route('pegawai.show', $pegawai->id)
            ->with('success', 'Periode ' . $periode->bulan->nama . ' ' . $periode->tahun . ' berhasil dihapus');
    }
}
