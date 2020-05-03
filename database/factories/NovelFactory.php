<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Novel;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Novel::class, function (Faker $faker) {
    $fed = new Carbon($faker->dateTime);
    $led = $fed->copy()->addDays(rand(12, 1000));
    return [
        'title' => $faker->words(rand(3, 8), true),
        'author' => $faker->firstName . ' ' . $faker->lastName,
        'amount' => 490,
        'published' => $faker->dateTime,
        'first_entry_date' => $fed->toDateTimeString(),
        'last_entry_date' => $led->toDateTimeString(),
        'summary' => $faker->sentences(3, true),
        'novel_emoji' => $faker->emoji
    ];
});

$factory->afterCreating(Novel::class, function ($novel, Faker $faker) {
    $fed = $novel->first_entry_date;
    $led = $novel->last_entry_date;
    $entries = rand(32, 105);
    for ($i = 0; $i < $entries; $i++) {
        $novel->entries()->save(
            factory(App\Entry::class)
                ->make(
                    [
                        'novel_id' => $novel->id,
                        'entry_date' => $faker->dateTimeBetween($fed, $led)
                    ]
                )
        );
    }
});
