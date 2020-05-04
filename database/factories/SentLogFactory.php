<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SentLog;
use Faker\Generator as Faker;

$factory->define(SentLog::class, function (Faker $faker) {
    return [
        'novel_id' => 0,
        'subscription_id' => 0,
        'user_id' => 0,
        'entry_id' => 0
    ];
});
