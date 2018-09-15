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

    public function verifKabag()
    {
       $this->update(['verif_kabag' => Carbon::now()]);
    }
    
    public function verifWadir()
    {
       $this->update(['verif_wadir' => Carbon::now()]);
    }
}
