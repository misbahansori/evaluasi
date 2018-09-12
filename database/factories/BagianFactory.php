<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Bagian::class, function (Faker $faker) {
    $bagian = [
        [
            'id' => 1,
            'nama' => 'Umum'
        ], 
        [
            'id' => 2,
            'nama' => 'Medis'
        ], 
        [
            'id' => 3,
            'nama' => 'Penunjang Medis'
        ]
    ];

    return $bagian[array_rand($bagian)];
});
