<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        foreach ($request->except('_token', 'datatable_length', 'bulan', 'tahun') as $id) {
            Pegawai::findOrFail($id)->createPeriode($request);
        }

        return redirect()
            ->route('penilaian.index');
    }
}