<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Bulan;
use App\Http\Controllers\Controller;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Actions\CreatePeriodeAction;

class InputPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPegawai = Pegawai::query()
            ->with('bagian', 'unit', 'formasi', 'status')
            ->get();

        $listBulan = Bulan::all();
        $tahunIni = date('Y');

        return view('admin.input-penilaian.index', compact('listPegawai', 'listBulan', 'tahunIni'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreatePeriodeAction $createPeriodeAction)
    {
        $request->validate([
            'bulan'   => 'required|integer|min:1|max:12',
            'tahun'   => 'required|integer',
            'tipe'    => 'required',
            'pegawai' => 'required'
        ]);

        foreach ($request->pegawai as $pegawai_id) {
            $createPeriodeAction->execute(Pegawai::findOrFail($pegawai_id));
        }

        return redirect()
            ->route('penilaian-pegawai.index');
    }
}