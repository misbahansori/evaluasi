<?php

namespace App\Models;

use App\Models\Aspek;
use App\Models\Nilai;
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
    * bulan relationship
    */
    public function bulan()
    {
       return $this->belongsTo(Bulan::class);
    }

    /**
    * pegawai relationship
    */
    public function pegawai()
    {
       return $this->belongsTo(Pegawai::class);
    }

    /**
    * aspek relationship
    */
    public function aspek()
    {
       return $this->belongsToMany(Aspek::class, 'nilai');
    }

    /**
    * nilai relationship
    */
    public function nilai()
    {
       return $this->hasMany(Nilai::class);
    }
}
