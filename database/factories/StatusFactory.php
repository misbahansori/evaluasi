<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Domain\Master\Models\Status;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'nama' => $faker->word,
    ];
});
