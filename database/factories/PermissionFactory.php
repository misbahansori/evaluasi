<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Spatie\Permission\Models\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name'       => $faker->word,
        'guard_name' => 'web'
    ];
});
