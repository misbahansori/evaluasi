<?php

namespace App\Domain\Penilaian\Models;

use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catatan';

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * User Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
