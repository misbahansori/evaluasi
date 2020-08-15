<?php

namespace App\Domain\Penilaian\Models;

use Illuminate\Support\Carbon;
use App\Domain\Master\Models\Role;
use App\Domain\Master\Models\Bulan;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Nilai;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Penilaian\Models\Catatan;

class Periode extends Model
{
    const PENILAIAN_BULANAN = 'bulanan';
    const PENILAIAN_TAHUNAN = 'tahunan';
    const PENILAIAN_KOMITE = 'komite';

    const KATEGORI_KEISLAMAN = 'Ke-islaman';
    const KATEGORI_KEMUHAMMADIYAHAN = 'Ke-muhammadiyahan';
    
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

    public function catatan()
    {
        return $this->hasMany(Catatan::class);
    }

    /**
     * Filter penilaian berdasarkan kategori Keislaman dan Kemuhammadiyahan
     */
    public function nilaiAik()
    {
        return $this->hasMany(Nilai::class)
            ->whereIn('kategori', [Periode::KATEGORI_KEISLAMAN, Periode::KATEGORI_KEMUHAMMADIYAHAN]);
    }

    public function nilaiBiasa()
    {
        return $this->hasMany(Nilai::class)
            ->whereNotIn('kategori', [Periode::KATEGORI_KEISLAMAN, Periode::KATEGORI_KEMUHAMMADIYAHAN]);
    }

    /**
     * setBulanAttribute
     *
     * @param mixed $value
     * @return void
     */
    public function setBulanAttribute($value)
    {
        $this->attributes['bulan_id'] = $value;
    }

    public function getNamaBulanAttribute()
    {
        return Carbon::createFromFormat('m', $this->bulan_id)->formatLocalized('%B');
    }
    
    /**
     * Total nilai per periode
     */
    public function totalNilai()
    {
        return $this->nilai->sum('nilai');
    }

    /**
     * Total nilai per periode
     */
    public function totalNilaiAik()
    {
        return $this->nilai
            ->whereIn('kategori', ['Ke-islaman', 'Ke-muhammadiyahan'])
            ->sum('nilai');
    }

    /**
     * Total nilai per periode
     */
    public function totalNilaiBiasa()
    {
        return $this->nilai
            ->whereNotIn('kategori', ['Ke-islaman', 'Ke-muhammadiyahan'])
            ->sum('nilai');
    }

    /**
     * Rata - rata nilai per periode
     */
    public function rataNilai()
    {
        if ($this->nilai->count() === 0) {
            return 0;
        }
        return round($this->totalNilai() / $this->nilai->count(), 2);
    }

    /**
     * Rata - rata nilai Aik per periode
     */
    public function rataNilaiAik()
    {
        if ($this->nilaiAik->count() === 0) {
            return 0;
        }
        return round($this->totalNilaiAik() / $this->nilaiAik->count(), 2);
    }

    /**
     * Rata - rata nilai Aik per periode
     */
    public function rataNilaiBiasa()
    {
        return round($this->totalNilaiBiasa() / $this->nilaiBiasa->count(), 2);
    }

    /**
     * Jumlah yang dikerjakan jika periode adalah penilaian komite.
     */
    public function jumlahDikerjakan()
    {
        if ($this->nilai->count() === 0) {
            return 0;
        }
        return $this->nilai->filter(function($nilai) {
            return $nilai->nilai;
        })->count();
    }
    /**
     * umlah yang dikerjakan jika periode adalah penilaian komite.
     */
    public function jumlahTidakDikerjakan()
    {
        if ($this->nilai->count() === 0) {
            return 0;
        }
        return $this->nilai->filter(function($nilai) {
            return !$nilai->nilai;
        })->count();
    }

    /**
     * Rata - rata nilai Aik per periode
     */
    public function persentase()
    {
        if ($this->nilai->count() === 0) {
            return 0;
        }
        return round($this->totalNilai() / $this->nilai->count(), 2) * 100;
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
     * Set verif_wadir field to now()
     */
    public function verifDirektur()
    {
        $this->update(['verif_direktur' => Carbon::now()]);
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

    /**
     * Memfilter Periode yang sudah terverifikasi direktur
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerverifikasiDirektur($query)
    {
        $query->whereNotNull('verif_direktur');
    }

    /**
     * Memfilter Periode yang sudah terverifikasi Wakil direktur
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereKomiteId($query, $komite_id)
    {
        $query->whereHas('pegawai', function($query) use ($komite_id) {
            $query->whereKomiteId($komite_id);
        });
    }

    public function bisaDiedit()
    {
        // Jika sudah di verifikasi kabag dan user bukan kabag atau wadir
        if ($this->verif_kabag && ! auth()->user()->hasAnyPermission(['verif kabag', 'verif wadir'])) {
            return false;
        }
        // jika belum di verif kabag dan user adalah wadir
        if (! $this->verif_kabag && auth()->user()->hasPermissionTo('verif wadir')) {
            return false;
        } 
        // jika sudah di verif wadir dan user bukan wadir
        if ($this->verif_wadir && ! auth()->user()->hasPermissionTo('verif wadir')) {
            return false;
        } 
        // jika belum di verif wadir dan adalah direktur
        if (! $this->verif_wadir && auth()->user()->hasPermissionTo('verif direktur')) {
            return false;
        } 
        // jika sudah di verif wadir dan user bukan direktur atau admin
        if ($this->verif_direktur && ! auth()->user()->hasRole([Role::ADMIN, Role::DIREKTUR])) {
            return false;
        }
        return true;
    }
}
