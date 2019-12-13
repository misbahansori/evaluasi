<?php

use Faker\Generator as Faker;
use App\Domain\Penilaian\Models\Nilai;
use App\Domain\Penilaian\Models\Periode;

$factory->define(Nilai::class, function (Faker $faker) {
    return [
        'periode_id' => function() {
            return factory(Periode::class)->create();
        },
        'aspek' => $faker->sentence,
        'kategori' => $faker->word,
        'nilai' => $faker->numberBetween(1, 5),
    ];
});
