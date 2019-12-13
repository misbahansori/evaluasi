<?php

namespace App\Domain\Pegawai\Presenters;

use Carbon\Carbon;

trait TanggalPresenter
{
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
}
