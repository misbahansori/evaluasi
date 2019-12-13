<?php

use Faker\Generator as Faker;
use App\Domain\Pegawai\Models\Pegawai;
use App\Domain\Penilaian\Models\Periode;

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
