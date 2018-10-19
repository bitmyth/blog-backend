<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Term::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => $name,
        'taxonomy' => $faker->randomElement(['tag','category'])
    ];
});
