<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Bagian::class, function (Faker $faker) {
    return [
        'nama' => $faker->word
    ];
});
