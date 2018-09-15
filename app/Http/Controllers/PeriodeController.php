<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pegawai $pegawai)
    {
        return view('admin.periode.index',compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pegawai $pegawai)
    {
        $listBulan = Bulan::all();
        $year = Carbon::now()->year;
        
        return view('admin.periode.create', compact('listBulan', 'year', 'pegawai'));
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

        $bulan = Bulan::find($request->bulan);

        if ($pegawai->periode()->where(['pegawai_id' => $pegawai->id, 'bulan_id' => $bulan->id, 'tahun' => $request->tahun])->exists()) {
            return redirect()
                ->back()
                ->with('danger', "Periode $bulan->nama $request->tahun sudah ada.")
                ->withInput();
        }

        $periode = $pegawai->periode()->create([
            'bulan_id' => $request->bulan,
            'tahun' => $request->tahun
        ]);

        $pegawai->bagian->aspek->each(function($item) use ($periode) {
            $periode->nilai()->create(['aspek' => $item->nama, 'kategori' => $item->kategori]);
        });
        
        return redirect()->route('pegawai.show', $pegawai->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai, Periode $periode)
    {
        return view('admin.periode.show', compact('pegawai', 'periode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        //
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

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Periode '.$periode->bulan->nama .' '. $periode->tahun.' berhasil dihapus');
    }
}
