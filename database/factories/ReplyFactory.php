<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    $datetime = $faker->dateTimeThisMonth();
    return [
        'topic_id'   => rand(1, 100),
        'user_id'    => rand(1, 10),
        'content'    => $faker->sentence(),
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
