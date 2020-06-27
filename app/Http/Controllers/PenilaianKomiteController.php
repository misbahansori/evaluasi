<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Bulan;
use App\Domain\Master\Models\Komite;
use App\Http\Controllers\Controller;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Periode;

class PenilaianKomiteController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('permission:tambah penilaian komite');
    }
    
    /**
     * 
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
            ->when(auth()->user()->hasPermissionTo('verif wadir') && $request->terverifikasiKabag, function ($query) {
                return $query->terverifikasiKabag();
            })
            ->get();

        return view('admin.penilaian-komite.index', compact('listPeriode', 'listKomite'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listPegawai = Pegawai::query()
            ->whereNotNull('komite_id')
            ->with('bagian', 'unit', 'formasi', 'komite')
            ->get();

        $listBulan = Bulan::all();
        
        return view('admin.penilaian-komite.create', compact('listPegawai', 'listBulan'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
    }
}
