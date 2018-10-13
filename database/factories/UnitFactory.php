<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Unit::class, function (Faker $faker) {
    return [
        'name'       => $faker->word,
        'guard_name' => 'web'
    ];
});
