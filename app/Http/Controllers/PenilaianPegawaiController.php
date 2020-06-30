<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Bulan;
use App\Http\Controllers\Controller;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Periode;
use App\Domain\Penilaian\Actions\CreatePeriodeAction;

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
            ->when(auth()->user()->hasPermissionTo('verif wadir') && $request->terverifikasiKabag, function ($query) {
                return $query->terverifikasiKabag();
            })
            ->get();

        return view('admin.penilaian-pegawai.index', compact('listPeriode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listPegawai = Pegawai::query()
            ->with('bagian', 'unit', 'formasi', 'status')
            ->get();

        $listBulan = Bulan::all();
        $tahunIni = date('Y');

        return view('admin.penilaian-pegawai.create', compact('listPegawai', 'listBulan', 'tahunIni'));
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
