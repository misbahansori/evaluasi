<?php

namespace App\Models;

use App\Models\Aspek;
use App\Models\Nilai;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'periode';

    /**
     * The table guarded attribute.
     *
     * @var string
     */
    protected $guarded = [];

    protected $dates = [
        'verif_kabag', 'verif_wadir'
    ];

    /**
     * Setiap Periode mempunyai Bulan
     */
    public function bulan()
    {
       return $this->belongsTo(Bulan::class);
    }

    /**
     * Setiap Periode dimiliki seorang pegawai
     */
    public function pegawai()
    {
       return $this->belongsTo(Pegawai::class);
    }

    /**
     * Setiap periode mempunyai banyak Aspek penilaian
     */
    public function aspek()
    {
       return $this->belongsToMany(Aspek::class, 'nilai');
    }

    /**
     * Setiap Periode punya banyak Nilai
     */
    public function nilai()
    {
       return $this->hasMany(Nilai::class);
    }

    /**
     * Set verif_kabag field to now()
     */
    public function verifKabag()
    {
       $this->update(['verif_kabag' => Carbon::now()]);
    }
    
    /**
     * Set verif_wadir field to now()
     */
    public function verifWadir()
    {
       $this->update(['verif_wadir' => Carbon::now()]);
    }

    /**
     * Mengecek Periode apakah unik dengan kombinasi tiga kolom
     *
     * @param Integer $pegawai
     * @param Integer $bulan
     * @param Integer $tahun
     */
    public function scopeUnique($query, $pegawai, $bulan, $tahun)
    {
        $query->wherePegawaiId($pegawai)
            ->whereBulanId($bulan)
            ->whereTahun($tahun);
    }
}
