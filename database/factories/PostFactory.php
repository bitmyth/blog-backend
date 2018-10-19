<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => 1,
        'title' => $title,
        'name' => str_slug($title),
        'status' => 'publish',
        'excerpt' => $faker->sentence,
        'content' => $faker->text,
    ];
});
