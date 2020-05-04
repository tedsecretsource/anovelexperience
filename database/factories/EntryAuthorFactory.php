<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EntryAuthor;
use Faker\Generator as Faker;
use App\Traits\Fonts;


$factory->define(EntryAuthor::class, function (Faker $faker) {
    if (!class_exists('TempClassForFonts')) {
        class TempClassForFonts
        {
            use Fonts;
        }
    }
    $fonts = new TempClassForFonts;
    $all_fonts = $fonts->get_fonts();
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'font' => array_rand($all_fonts)
    ];
});
