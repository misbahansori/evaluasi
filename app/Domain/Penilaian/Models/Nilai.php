<?php

namespace App\Domain\Penilaian\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Penilaian\Models\Periode;

class Nilai extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'nilai';

    /**
    * The table guarded attribute.
    *
    * @var string
    */
    protected $guarded = [];

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['periode'];

    /**
     * Periode relationship
     *
     * @return \App\Domain\Penilaian\Models\Periode
     */
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
