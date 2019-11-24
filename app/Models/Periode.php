<?php

namespace App\Models;

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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
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
     * Setiap Periode punya banyak Nilai
     */
    public function nilai()
    {
       return $this->hasMany(Nilai::class);
    }

    /**
     * Total nilai per periode
     */
    public function totalNilai()
    {
        return $this->nilai->sum('nilai');
    }

    /**
     * Rata - rata nilai per periode
     */
    public function rataNilai()
    {
        return round($this->totalNilai() / $this->nilai->count(), 2);
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
     * Mengecek Periode apakah unik dengan kombinasi empat kolom
     *
     * @param Integer $pegawai
     * @param Integer $bulan
     * @param Integer $tahun
     */
    public function scopeUnique($query, $pegawai, $bulan, $tahun, $tipe)
    {
        $query->wherePegawaiId($pegawai)
            ->whereBulanId($bulan)
            ->whereTahun($tahun)
            ->whereTipe($tipe);
    }

    /**
     * Memfilter Periode berdasarkan Pegawai unit
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMilikUser($query)
    {
        $query->whereHas('pegawai.unit', function($q) {
            $q->whereIn('name', auth()->user()->getRoleNames());
        });
    }

    /**
     * Memfilter Periode yang sudah terverifikasi Kepala Bagian
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerverifikasiKabag($query)
    {
        $query->whereNotNull('verif_kabag');
    }

    /**
     * Memfilter Periode yang sudah terverifikasi Wakil direktur
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerverifikasiWadir($query)
    {
        $query->whereNotNull('verif_wadir');
    }

    public function tidakBisaDiedit()
    {
        // Jika sudah di verifikasi kabag dan user bukan kabag atau wadir
        if ($this->verif_kabag && ! auth()->user()->hasAnyPermission(['verif kabag', 'verif wadir'])) {
            return true;
        }
        // jika sudah di verif wadir dan user bukan wadir
        if ($this->verif_wadir && ! auth()->user()->hasPermissionTo('verif wadir')) {
            return true;
        } 
        // jika belum di verif kabag dan user adalah wadir
        if (! $this->verif_kabag && auth()->user()->hasPermissionTo('verif wadir')) {
            return true;
        } 
        return false;
    }
}
