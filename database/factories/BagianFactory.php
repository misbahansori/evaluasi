<?php

use Faker\Generator as Faker;
use App\Domain\Master\Models\Bagian;

$factory->define(Bagian::class, function (Faker $faker) {
    return [
        'nama' => $faker->word
    ];
});
