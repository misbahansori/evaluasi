<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Domain\Penilaian\Models\Catatan;
use App\Domain\Penilaian\Models\Periode;

$factory->define(Catatan::class, function (Faker $faker) {
    return [
        'periode_id' => factory(Periode::class),
        'tipe'       => $faker->word,
        'isi'        => $faker->paragraph,
    ];
});
