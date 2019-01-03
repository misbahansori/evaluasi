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
    public function createPeriode(Request $request)
    {
        if (! $this->bagian) {
            return redirect()
                ->route('input.penilaian.index')
                ->with('danger', 'Pegawai "' . $this->nama .'" tidak memiliki bagian. Harap periksa kembali biodata pegawai.');
        }
        
        $bulan = Bulan::find($request->bulan);
    
        if (Periode::unique($this->id, $bulan->id, $request->tahun)->exists()) {
            return redirect()
                ->route('input.penilaian.index')
                ->with('danger', "Tidak dapat menambah penilaian. Pegawai $this->nama, Periode $bulan->nama $request->tahun sudah ada.");
        }

        $periode = $this->periode()->create([
            'bulan_id' => $request->bulan,
            'tahun' => $request->tahun
        ]);

        $this->bagian->aspek->each(function ($item) use ($periode) {
            $periode->nilai()->create([
                'aspek' => $item->nama, 
                'kategori' => $item->kategori
            ]);
        });

        return redirect()
            ->route('pegawai.show', $this->id)
            ->with('success', "Periode $bulan->nama $request->tahun berhasil ditambahkan");
    }
}
