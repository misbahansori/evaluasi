<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Komite;
use App\Http\Controllers\Controller;
use App\Domain\Penilaian\Models\Periode;

class PenilaianKomiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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

        $listKomite = Komite::orderBy('nama')->get();

        $listPeriode = Periode::query()
            ->with('pegawai.unit', 'pegawai.formasi', 'nilai', 'bulan')
            ->whereBulanId($request->bulan)
            ->whereTahun($request->tahun)
            ->whereTipe(Periode::PENILAIAN_KOMITE)
            ->milikUser()
            ->when(auth()->user()->hasPermissionTo('verif wadir') && $request->terverifikasiKabag, function ($query) {
                return $query->terverifikasiKabag();
            })
            ->get();

        return view('admin.penilaian-komite.index', compact('listPeriode', 'listKomite'));
    }
}
