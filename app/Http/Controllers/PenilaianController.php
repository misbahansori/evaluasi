<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Periode;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listBulan = Bulan::all();
        $tahunIni = date('Y');

        if (!$request->bulan && !$request->tahun) {
            $request->request->add([
                'bulan' => date('n', strtotime("-1 month")),
                'tahun' => date('Y')
            ]);
        }

        $listPeriode = Periode::query()
            ->with('pegawai.unit', 'pegawai.formasi', 'nilai', 'bulan')
            ->whereBulanId($request->bulan)
            ->whereTahun($request->tahun)
            ->milikUser()
            ->when(auth()->user()->hasPermissionTo('verif wadir') && $request->terverifikasiKabag, function($query) {
                return $query->terverifikasiKabag();
            })
            ->get();

        return view('admin.penilaian.index', compact('listPeriode', 'listBulan', 'tahunIni'));
    }
}
