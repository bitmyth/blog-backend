<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(range(1, 12)),
        'post_id' => $faker->randomElement(range(1, 12)),
        'content' => $faker->text,
        'parent' => 0,
    ];
});
