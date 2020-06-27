<?php

namespace App\Domain\Master\Models;

use Illuminate\Database\Eloquent\Model;

class AspekKomite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'aspek_komite';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the relation of the komite
     */
    public function komite()
    {
        return $this->belongsTo(Komite::class);
    }
}
