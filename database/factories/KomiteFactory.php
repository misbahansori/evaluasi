<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Domain\Master\Models\Komite;

$factory->define(Komite::class, function (Faker $faker) {
    return [
        'nama' => $faker->word()
    ];
});
