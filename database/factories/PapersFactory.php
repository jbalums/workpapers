<?php

use Faker\Generator as Faker;

$factory->define(App\Papers::class, function (Faker $faker) {
    return [
        'reference_code' => $faker->unique()->word,
        'title' => $faker->word,
        'context' => $faker->sentence,
        'folder_id' => function () {
            return factory('App\Folders')->create()->id;
        } 
    ];
});
