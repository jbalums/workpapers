<?php

use Faker\Generator as Faker;

$factory->define(App\Folders::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->randomLetter,
        'name' => $faker->word
    ];
});

