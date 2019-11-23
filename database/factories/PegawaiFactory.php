<?php

use App\Models\Unit;
use App\Models\Bagian;
use App\Models\Status;
use App\Models\Formasi;
use App\Models\Pegawai;
use Faker\Generator as Faker;

$factory->define(Pegawai::class, function (Faker $faker) {
    return [
        'nik'           => $faker->nik,
        'nbm'           => (string) $faker->randomNumber(6),
        'nama'          => $faker->name,
        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        'tempat_lahir'  => $faker->city,
        'tanggal_lahir' => $faker->date('d-m-Y'),
        'alamat'        => $faker->address,
        'no_hp'         => $faker->phoneNumber,
        'provinsi'      => $faker->state,
        'kabupaten'     => $faker->city,
        'kecamatan'     => $faker->cityname,
        'tanggal_masuk' => $faker->date('d-m-Y'),
        'unit_id'       => function() { return factory(Unit::class)->create(); },
        'formasi_id'    => function() { return factory(Formasi::class)->create(); },
        'bagian_id'     => function() { return factory(Bagian::class)->create(); },
        'status_id'     => function() { return factory(Status::class)->create(); }
    ];
});
