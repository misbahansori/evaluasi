<?php

use App\Models\Pegawai;
use App\Models\Periode;
use Faker\Generator as Faker;

$factory->define(Periode::class, function (Faker $faker) {
    return [
        'pegawai_id' => function() {
            return factory(Pegawai::class)->create();
        },
        'bulan_id'   => $faker->numberBetween(1, 12),
        'tahun'      => $faker->year(),
        'tipe'       => 'bulanan'
    ];
});
