<?php

namespace App\Actions;

use App\Models\Bulan;
use App\Models\Pegawai;
use App\Models\Periode;
use Illuminate\Http\Request;

class CreatePeriodeAction 
{
    protected $request;

    /**
    * Instantiate a new class instance.
    *
    * @return void
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function execute(Pegawai $pegawai)
    {
        // Cek pegawai memiliki bagian
        if (! $pegawai->bagian) {
            $this->flash('danger', 'Pegawai "' . $pegawai->nama .'" tidak memiliki bagian. Harap periksa kembali biodata pegawai.');
            return;
        }
        
        // Cek periode pegawai belum ada
        $bulan = Bulan::find($this->request->bulan);
        
        if (Periode::unique($pegawai->id, $bulan->id, $this->request->tahun, $this->getTipe())->exists()) {
            $this->flash('danger', "Tidak dapat menambah penilaian. Pegawai $pegawai->nama, Periode $bulan->nama " . $this->request->tahun . " sudah ada.");
            return;
        }

        // Buat periode penilaian
        $periode = $pegawai->periode()->create([
            'bulan_id' => $this->request->bulan,
            'tahun' => $this->request->tahun,
            'tipe' => $this->getTipe()
        ]);

        $pegawai->bagian->load(['aspek' => function($query) {
            $query->whereTipe($this->getTipe());
        }]);

        // Copy aspek penilaian ke periode 
        $pegawai->bagian->aspek->each(function ($item) use ($periode) {
            $periode->nilai()->create([
                'aspek' => $item->nama, 
                'kategori' => $item->kategori
            ]);
        });        

        $this->flash('success', "Pegawai $pegawai->nama, Periode $bulan->nama " . $this->request->tahun . " berhasil ditambahkan");
        
        return;
    }

    public function getTipe()
    {
        return $this->request->tipe ?? 'bulanan';
    }

    public function flash($type, $message)
    {
        session()->flash($type, array_merge((array) session()->get($type), [$message]));
    }
    
}