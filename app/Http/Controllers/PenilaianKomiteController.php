<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Master\Models\Aspek;
use App\Domain\Master\Models\Bulan;
use App\Domain\Master\Models\Komite;
use App\Http\Controllers\Controller;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
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
        if (!$request->bulan && !$request->tahun) {
            $request->request->add([
                'bulan' => date('n', strtotime("-1 month")),
                'tahun' => date('Y'),
            ]);
        }

        $listKomite = Komite::orderBy('nama')->get();

        $listPeriode = Periode::query()
            ->with('pegawai.komite', 'pegawai.unit', 'pegawai.formasi', 'nilai', 'bulan')
            ->whereBulanId($request->bulan)
            ->whereTahun($request->tahun)
            ->whereTipe(Periode::PENILAIAN_KOMITE)
            ->when($request->komite_id && $request->komite_id !== 'all', function($query) use ($request) {
                $query->whereKomiteId($request->komite_id);
            })
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
    public function create(Request $request)
    {
        if (!$request->bulan && !$request->tahun) {
            $request->request->add([
                'bulan' => date('n'),
                'tahun' => date('Y'),
            ]);
        }

        $listPegawai = Pegawai::query()
            ->whereNotNull('komite_id')
            ->whereDoesntHave('periode', function($query) use ($request) {
                $query->whereBulanId($request->bulan)
                    ->whereTahun($request->tahun)
                    ->whereTipe(Periode::PENILAIAN_KOMITE);
            })
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
    public function store(Request $request)
    {
        $listPegawai = Pegawai::findOrFail($request->pegawai);

        foreach ($listPegawai as $pegawai) {
            if ($pegawai->komite->aspekKomite->isEmpty()) {
                session()->flash('danger', 'Aspek komite ' . $pegawai->komite->nama . ' masih kosong.');
                return redirect()->back();
            }

            $periode = Periode::create([
                'pegawai_id' => $pegawai->id,
                'bulan_id' => $request->bulan,
                'tahun' => $request->tahun,
                'tipe' => Periode::PENILAIAN_KOMITE,
            ]);

            $pegawai->komite->aspekKomite->each(function($aspek) use ($periode) {
                Nilai::create([
                    'periode_id' => $periode->id,
                    'aspek' => $aspek->nama,
                    'kategori' => $aspek->kategori,
                ]);
            });

            session()->flash(
                'success', 
                array_merge(
                    (array) session()->get('success'), 
                    ["Penilaian bulan $request->bulan tahun $request->tahun $pegawai->nama berhasil ditambahkan."]
                )
            );
        }

        return redirect()
            ->route('penilaian-komite.index');
    }
}
