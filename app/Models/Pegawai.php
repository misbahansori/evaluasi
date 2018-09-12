<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'pegawai';

    /**
    * unit relationship
    */
    public function unit()
    {
       return $this->belongsTo(Unit::class);
    }

    /**
    * bagian relationship
    */
    public function bagian()
    {
       return $this->belongsTo(Bagian::class);
    }

    /**
    * periode relationship
    */
    public function periode()
    {
       return $this->hasMany(Periode::class)->with('bulan');
    }
}
