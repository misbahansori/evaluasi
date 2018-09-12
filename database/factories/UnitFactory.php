<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Unit::class, function (Faker $faker) {
    return [
        'nama' => $faker->word
    ];
});
