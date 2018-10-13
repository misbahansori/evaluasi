<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'roles';

    /**
    * The table associated with the model.
    *
    * @var string
    */
    public $timestamps = false;

    /**
    * The table garded attribute
    *
    * @var string
    */
    protected $guarded = [];
}
