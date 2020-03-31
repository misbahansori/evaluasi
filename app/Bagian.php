<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bagian';

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
}
