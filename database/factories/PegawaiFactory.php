<?php


use Faker\Generator as Faker;
use App\Domain\Master\Models\Unit;
use App\Domain\Master\Models\Bagian;
use App\Domain\Master\Models\Komite;
use App\Domain\Master\Models\Status;
use App\Domain\Master\Models\Formasi;
use App\Domain\Pegawai\Models\Pegawai;

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
        'unit_id'       => factory(Unit::class)->create(),
        'formasi_id'    => factory(Formasi::class)->create(),
        'bagian_id'     => factory(Bagian::class)->create(),
        'status_id'     => factory(Status::class)->create(),
        'status_id'     => factory(Status::class)->create(),
        'komite_id'     => factory(Komite::class)->create(),
    ];
});
