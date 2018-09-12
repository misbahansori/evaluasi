<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Aspek::class, function (Faker $faker) {
    return [
        'nama' => $faker->sentence,
        'kategori' => $faker->randomElement(['Prestasi Kerja', 'Sikap Kerja', 'Profesi']),
        'bagian_id' => $faker->randomElement([1,2,3])
    ];
});
