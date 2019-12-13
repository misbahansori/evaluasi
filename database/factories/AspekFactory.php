<?php


use Faker\Generator as Faker;
use App\Domain\Master\Models\Aspek;
use App\Domain\Master\Models\Bagian;

$factory->define(Aspek::class, function (Faker $faker) {
    return [
        'bagian_id' => function() {
            return factory(Bagian::class)->create();
        },
        'nama'     => $faker->sentence,
        'kategori' => $faker->randomElement(['Prestasi Kerja', 'Sikap Kerja', 'Profesi']),
        'tipe'     => 'bulanan'
    ];
});
