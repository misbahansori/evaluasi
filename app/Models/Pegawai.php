<?php

namespace App\Models;

use Carbon\Carbon;
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
}
