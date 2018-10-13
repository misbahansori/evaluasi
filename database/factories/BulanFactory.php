<?php

use App\Models\Bulan;
use Faker\Generator as Faker;

$factory->define(Bulan::class, function (Faker $faker) {
    $bulan = [
        [
            'id' => 1,
            'nama' => 'Januari',
            'nama_singkat' => 'Jan'
        ],
        [
            'id' => 2,
            'nama' => 'Februari',
            'nama_singkat' => 'Feb'
        ],
        [
            'id' => 3,
            'nama' => 'Maret',
            'nama_singkat' => 'Mar'
        ],
        [
            'id' => 4,
            'nama' => 'April',
            'nama_singkat' => 'Apr'
        ],
        [
            'id' => 5,
            'nama' => 'Mei',
            'nama_singkat' => 'Mei'
        ],
        [
            'id' => 6,
            'nama' => 'Juni',
            'nama_singkat' => 'Jun'
        ],
        [
            'id' => 7,
            'nama' => 'Juli',
            'nama_singkat' => 'Jul'
        ],
        [
            'id' => 8,
            'nama' => 'Agustus',
            'nama_singkat' => 'Agt'
        ],
        [
            'id' => 9,
            'nama' => 'September',
            'nama_singkat' => 'Sep'
        ],
        [
            'id' => 10,
            'nama' => 'Oktober',
            'nama_singkat' => 'Okt'
        ],
        [
            'id' => 11,
            'nama' => 'November',
            'nama_singkat' => 'Nov'
        ],
        [
            'id' => 12,
            'nama' => 'Desember',
            'nama_singkat' => 'Des'
        ],
    ];
    return $bulan[array_rand($bulan)];
});
