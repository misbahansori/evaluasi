<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Penilaian\Models\Periode;

class PenilaianPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->bulan && !$request->tahun && !$request->tipe) {
            $request->request->add([
                'bulan' => date('n', strtotime("-1 month")),
                'tahun' => date('Y'),
                'tipe' => 'bulanan'
            ]);
        }

        $listPeriode = Periode::query()
            ->with('pegawai.unit', 'pegawai.formasi', 'nilai', 'bulan')
            ->whereBulanId($request->bulan)
            ->whereTahun($request->tahun)
            ->whereTipe($request->tipe)
            ->milikUser()
            ->when(auth()->user()->hasPermissionTo('verif wadir') && $request->terverifikasiKabag, function($query) {
                return $query->terverifikasiKabag();
            })
            ->get();

        return view('admin.penilaian-pegawai.index', compact('listPeriode'));
    }
}
