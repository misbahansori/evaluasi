<?php

use App\Models\Pegawai;
use Faker\Generator as Faker;

$factory->define(Pegawai::class, function (Faker $faker) {
    return [
        'nik' => $faker->nik,
        'nbm' => $faker->randomNumber(6),
        'nama' => $faker->name,
        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        'tempat_lahir' => $faker->city,
        'tanggal_lahir' => $faker->date('d-m-Y'),
        'alamat' => $faker->address,
        'no_hp' => $faker->phoneNumber,
        'provinsi' => $faker->state,
        'kabupaten' => $faker->city,
        'kecamatan' => $faker->cityname,
        'tanggal_masuk' => $faker->date('d-m-Y'),
        'bagian_id' => $faker->numberBetween(1,3),
        'unit_id' => $faker->numberBetween(1,13),
    ];
});
