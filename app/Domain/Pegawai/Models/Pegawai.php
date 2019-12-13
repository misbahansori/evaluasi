<?php

namespace App\Domain\Pegawai\Models;

use App\Domain\Master\Models\Unit;
use App\Domain\Master\Models\Bagian;
use App\Domain\Master\Models\Status;
use App\Domain\Master\Models\Formasi;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Penilaian\Models\Periode;
use App\Domain\Pegawai\Presenters\TanggalPresenter;


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
}
