<?php

use Faker\Generator as Faker;
use App\Models\Topic;

$factory->define(Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'title'       => $sentence,
        'body'        => $faker->text(),
        'excerpt'     => $sentence,
        'user_id'     => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'category_id' => $faker->randomElement([1, 2, 3, 4]),
        'updated_at'  => $updated_at,
        'created_at'  => $created_at,
    ];
});
