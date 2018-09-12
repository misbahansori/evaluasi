<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'aspek';

    /**
    * Disable timestamps attribute.
    *
    * @var string
    */
    public $timestamps = false;

    /**
    * bagian relationship
    */
    public function bagian()
    {
       return $this->belongsTo(Bagian::class);
    }
}
