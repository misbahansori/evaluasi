<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Periode;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $listBulan = Bulan::all();
        $tahunIni = date('Y');

        if (!$request->bulan && !$request->tahun) {
            $request->request->add([
                'bulan' => date('n'),
                'tahun' => date('Y')
            ]);
        }

        $listPeriode = Periode::query()
            ->with('pegawai.unit', 'pegawai.formasi', 'nilai', 'bulan')
            ->whereBulanId($request->bulan)
            ->whereTahun($request->tahun)
            ->get();

        return view('admin.penilaian.index', compact('listPeriode', 'listBulan', 'tahunIni'));
    }
}
