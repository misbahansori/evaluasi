<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Bulan;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Presenters\TanggalPresenter;

class Pegawai extends Model
{
    use TanggalPresenter;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawai';

    /**
     * Setiap Pegawai mempunyai satu Unit
     */
    public function unit()
    {
       return $this->belongsTo(Unit::class);
    }

    /**
     * Setiap Pegawai punya satu Formasi
     */
    public function formasi()
    {
       return $this->belongsTo(Formasi::class);
    }

    /**
     * Setiap Pegawai mempunyai satu Bagian
     */
    public function bagian()
    {
       return $this->belongsTo(Bagian::class);
    }

    /**
     * Setiap Pegawai mempunyai satu Bagian
     */
    public function status()
    {
       return $this->belongsTo(Status::class);
    }

    /**
     * Pegawai punya banyak Periode penilaian
     */
    public function periode()
    {
        return $this->hasMany(Periode::class)
            ->whereTipe('bulanan')
            ->with('bulan')
            ->orderBy('tahun')
            ->orderBy('bulan_id');
    }
    /**
     * 
     * Pegawai punya banyak Periode penilaian
     */
    public function periodeTahunan()
    {
        return $this->hasMany(Periode::class)
            ->whereTipe('tahunan')
            ->with('bulan')
            ->orderBy('tahun')
            ->orderBy('bulan_id');
    }

    /**
     * Memfilter Pegawai berdasarkan user() Role/Unit
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMilikUser($query)
    {
        $query->whereHas('unit', function($q) {
            $q->whereIn('name', auth()->user()->getRoleNames());
        });
    }

    /**
     * createPeriode
     *
     * @param Request $request
     * @return void
     */
    public function createPeriode(Request $request, $tipe)
    {
        // Cek pegawai memiliki bagian
        if (! $this->bagian) {
            session()->flash('danger', array_merge((array) session()->get('danger'), ['Pegawai "' . $this->nama .'" tidak memiliki bagian. Harap periksa kembali biodata pegawai.']));
            
            return;
        }
        
        // Cek periode pegawai belum ada
        $bulan = Bulan::find($request->bulan);
    
        if (Periode::unique($this->id, $bulan->id, $request->tahun, $tipe)->exists()) {
            session()->flash('danger', array_merge((array) session()->get('danger'), ["Tidak dapat menambah penilaian. Pegawai $this->nama, Periode $bulan->nama $request->tahun sudah ada."]));
            
            return;
        }

        // Buat periode penilaian
        $periode = $this->periode()->create([
            'bulan_id' => $request->bulan,
            'tahun' => $request->tahun,
            'tipe' => $tipe
        ]);

        $this->bagian->load(['aspek' => function($query) use ($tipe) {
            $query->whereTipe($tipe);
        }]);

        // Copy aspek penilaian ke periode 
        $this->bagian->aspek->each(function ($item) use ($periode) {
            $periode->nilai()->create([
                'aspek' => $item->nama, 
                'kategori' => $item->kategori
            ]);
        });

        session()->flash('success', array_merge((array) session()->get('success'), ["Pegawai $this->nama, Periode $bulan->nama $request->tahun berhasil ditambahkan"]));
        
        
        return;
    }
}
