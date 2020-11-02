<?php

namespace App\Domain\Master\Models;

use App\Domain\Pegawai\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const PEGAWAI_TETAP = 1;
    const CALON_PEGAWAI = 2;
    const PEGAWAI_KONTRAK = 3;
    const PEGAWAI_MAGANG = 4;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Pegawai relationship
     */
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
