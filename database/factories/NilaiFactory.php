<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Nilai::class, function (Faker $faker) {
    return [
        // 'periode_id' => factory(App\Models\Periode::class)->create(),
        'aspek' => $faker->sentence,
        'kategori' => $faker->word,
        'nilai' => $faker->numberBetween(1, 5),
    ];
});
