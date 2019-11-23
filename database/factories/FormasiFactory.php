<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Formasi;
use Faker\Generator as Faker;

$factory->define(Formasi::class, function (Faker $faker) {
    return [
        'nama' => $faker->word,
    ];
});
