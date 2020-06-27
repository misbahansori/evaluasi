<?php

namespace App\Domain\Master\Models;

use App\Domain\Master\Models\Aspek;
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];

    /**
    * aspek relationship
    */
    public function aspek()
    {
       return $this->hasMany(Aspek::class)->orderBy('nama');
    }
}
