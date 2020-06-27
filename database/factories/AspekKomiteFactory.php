<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Domain\Master\Models\Komite;
use App\Domain\Master\Models\AspekKomite;

$factory->define(AspekKomite::class, function (Faker $faker) {
    return [
        'komite_id' => factory(Komite::class),
        'nama' => $faker->sentence(),
        'kategori' => $faker->randomElement(['Prestasi Kerja', 'Sikap Kerja', 'Profesi']),
    ];
});
