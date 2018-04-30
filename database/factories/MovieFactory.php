<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'description' => $faker->paragraphs(rand(1, 3), true),
        'genre' => $faker->word(),
        'release_date' => $faker->date('Y-m-d', 'now'),
        'director' => $faker->lastName(),
        'running_time' => $faker->numberBetween(30, 180),
        'rating' => $faker->numberBetween(0, 5)
    ];
});
