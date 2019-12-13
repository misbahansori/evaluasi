<?php

use Faker\Generator as Faker;
use App\Domain\Master\Models\Unit;

$factory->define(Unit::class, function (Faker $faker) {
    return [
        'name'       => $faker->word,
        'guard_name' => 'web'
    ];
});
