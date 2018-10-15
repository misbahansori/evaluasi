<?php

use App\Models\Periode;
use Faker\Generator as Faker;

$factory->define(Periode::class, function (Faker $faker) {
    return [
        'pegawai_id' => factory(App\Models\Pegawai::class)->create(),
        'bulan_id' => $faker->numberBetween(1, 12),
        'tahun' => $faker->year()
    ];
});
