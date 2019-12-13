<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Domain\Master\Models\Formasi;

$factory->define(Formasi::class, function (Faker $faker) {
    return [
        'nama' => $faker->word,
    ];
});
