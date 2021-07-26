<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'item_name' => $faker->realText($maxNbChars = rand(20, 40)),
        'item_amount' => rand(100, 9999),
        'item_number' => rand(1, 10),
        'item_img' => $faker->imageUrl($width = 160, $height = 160),
        'published' => Carbon::today()->subDays(rand(1, 100))->format("Y-m-d"),
        'item_category' => rand(1, 3),
    ];
});