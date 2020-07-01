<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Bulan;
use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Pegawai\ViewModels\PegawaiViewModel;
use App\Domain\Pegawai\Charts\PenilaianPegawaiChart;

class PegawaiController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('permission:tambah pegawai')->only('create', 'store');
        $this->middleware('permission:edit pegawai')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPegawai = Pegawai::query()
            ->milikUser()
            ->with('bagian', 'unit', 'formasi', 'status')
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
        return view('admin.pegawai.create', new PegawaiViewModel(new Pegawai()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $pegawai = Pegawai::create($request->validated());

        return redirect()
            ->route('pegawai.index')
            ->with('success', "Pegawai $pegawai->nama berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Pegawai\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pegawai $pegawai)
    {
        $this->authorize('view', $pegawai);
        
        $listBulan = Bulan::all();
        $tahunIni  = date('Y');

        $chart = new PenilaianPegawaiChart($request, $pegawai);

        return view('admin.pegawai.show', compact('pegawai', 'listBulan', 'tahunIni', 'pegawai', 'chart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Pegawai\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $this->authorize('view', $pegawai);

        return view('admin.pegawai.edit', new PegawaiViewModel($pegawai));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Pegawai\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        $this->authorize('update', $pegawai);

        $pegawai->update($request->validated());

        return redirect()
            ->route('pegawai.show', $pegawai->id)
            ->with('success', "Pegawai $pegawai->nama berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Pegawai\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
