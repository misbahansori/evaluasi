<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @return \App\Models\Periode
     */
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
