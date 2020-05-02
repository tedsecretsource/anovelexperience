<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use App\EntryAuthor;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Entry::class, function (Faker $faker) {
    $author = EntryAuthor::all()->random();
    $ed = new Carbon($faker->dateTime);
    return [
        'novel_id' => 0,
        'entry_author_id' => $author->id,
        'source' => $faker->words(2, 6),
        'title' => $faker->words(2, 7),
        'entry_date' => $ed->toDateTimeString(),
        'entry' => $faker->paragraph(rand(3, 14), true)
    ];
});
