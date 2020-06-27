<?php

namespace App\Domain\Master\Models;

use Illuminate\Database\Eloquent\Model;

class Komite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'komite';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];

    /**
     * Get the relation of the aspekKomite
     */
    public function aspekKomite()
    {
        return $this->hasMany(AspekKomite::class);
    }
}
