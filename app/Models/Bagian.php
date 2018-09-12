<?php

namespace App\Models;

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
    * The table associated with the model.
    *
    * @var string
    */
    public $timestamps = false;

    /**
    * aspek relationship
    */
    public function aspek()
    {
       return $this->hasMany(Aspek::class);
    }
}
