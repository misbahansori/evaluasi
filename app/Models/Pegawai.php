<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
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
     * Pegawai punya banyak Periode penilaian
     */
    public function periode()
    {
        return $this->hasMany(Periode::class)
            ->with('bulan')
            ->orderBy('created_at');
    }

    /**
     * Set tanggal lahir berdasarkan format
     *
     * @param  string  $value
     * @return void
     */
    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = date('Y-m-d', strtotime($value));
    }

    /**
     * Set tanggal masuk berdasarkan format
     *
     * @param  string  $value
     * @return void
     */
    public function setTanggalMasukAttribute($value)
    {
        $this->attributes['tanggal_masuk'] = date('Y-m-d', strtotime($value));
    }

    /**
     * Get Tanggal Masuk attribute
     *
     * @return string
     */
    public function getTanggalMasukAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_masuk'])->format('d-m-Y');
    }
    
    /**
     * Get Tanggal Lahir attribute
     *
     * @return string
     */
    public function getTanggalLahirAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_lahir'])->format('d-m-Y');
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
            $q->whereIn('nama', auth()->user()->getRoleNames());
        });
    }
}
