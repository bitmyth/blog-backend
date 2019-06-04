<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name'     => $name,
        'slug'     => $name,
        'taxonomy' => 'category',
    ];
});
