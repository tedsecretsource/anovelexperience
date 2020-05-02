<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'user_id' => 0,
        'novel_id' => 0,
        'subscribed' => $faker->dateTime,
        'type' => App\SubscriptionType::all()->random()->type,
        'status' => App\SubscriptionStatus::all()->random()->status,
        'first_entry_date' => $faker->dateTime,
        'pace' => rand(1, 5)
    ];
});
